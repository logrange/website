# Go client 
Logrange is written in Golang, so "native" go client can be used for accessing Logrange from programs written in Golang. To get Logrange use:

```
go get -u -v github.com/logrange/logrange
```

The public API can be found in [github.com/logrange/lograne/api](https://godoc.org/github.com/logrange/logrange/api) package. Only one implementation available for accessing Logrange could be found in [github.com/logrange/lograne/api/rpc](https://github.com/logrange/logrange/tree/master/api/rpc). Logrange uses its own RPC implementation which works over TCP or TLS transport. More widely used [gRPC](https://grpc.io/) and HTTP based REST API implementations are in our plans as well. 

## Creating client
To create the client just call `rpc.NewClient()`: 

```golang
import "github.com/logrange/logrange/api/rpc"
import 	"github.com/logrange/range/pkg/transport"
...
   client, err := rpc.NewClient(transport.Config{
		ListenAddr: "127.0.0.1:9966",
	})
```

The client expects transport configuration, which is defined in  [github.com/logrange/range/pkg/transport](https://github.com/logrange/range/blob/master/pkg/transport/transport.go#L27) package.

If `TlsEnabled` is not `true` then TLS will not be enabled, so only `ListenAddr` is expected.

## Writing data
To write data into Logrange `Write` function of the client should be used. For example:

```golang
...
    // preparing records
	recs := []*api.LogEvent{
		{
			Timestamp: time.Now().UnixNano(),
			Message:   "Hello Logrange, first message",
		}, {
			Timestamp: time.Now().UnixNano(),
			Message:   "Hello Logrange, second message",
		},
	}

	// Ingesting the recs into the partition with one tag 
	// "partition=testWrite", and apply the fields values "custField=test" 
	// to all records from the recs
	var wr api.WriteResult
	err = client.Write(context.Background(), "partition=testWrite", "custField=test",
		recs, &wr)
...
```
The `Write` allows to persist data into Logrange. It expects tags for the partition where records should be written to. The write operation will be done to the partition which contans ALL and ONLY the tags provided. If there is no such partition, it will be created. 

Fields (only one field `custField=test` in the example above) will be applied to all LogEvents in the write operaion. The Write operation ignores individual records fields, but apply the same fields to all the records. 

## Reading data
To read data from one or many parition, `Query` function should be used:
```golang
...
    var qr api.QueryResult
	err = client.Query(context.Background(), 
	    &api.QueryRequest{Query: "SELECT FROM partition=testWrite", Limit: 100}, 
	    &qr)
...
```
To form the query parameters the [api.QueryRequest](https://github.com/logrange/logrange/blob/master/api/querier.go#L41) should be used. Only `SELECT` statements are accepted in the `Query()`. Fields from `api.QueryRequest` like `Limit`, `Offset`, `Pos` etc. will overwrite the parameters from the `Query` field text, so they have to be provided explicitly (`Limit` is set to 100 in the example above, if we don't do this, the result will be empty).

Result of the query execution is returned via parameter `qr`, a pointer to the variable with type [api.QueryResult](https://github.com/logrange/logrange/blob/master/api/querier.go#L73). Among the resulting records, the result contains `NextQueryRequest` field which could be used for accessing next portion of records followed by the result. 

## Streaming records
There is a helper function, which allows "to stream" records from Logrange, sending the records into a "hook" function. The "hook" function will receive a portion of the records from the stream and the new portion will be received as soon as the current one is handled. If the stream doesn't have records, it will wait for new ones. Use [api.Select()](https://github.com/logrange/logrange/blob/master/api/client.go#L43) for the functionality:
```golang
	// The select below will read data from the partition with tag 
	// "partition=testWrite" until it is interrupted or a communication error happens
	cnt := 0
	err = api.Select(
	    context.Background(), 
	    client, 
	    &api.QueryRequest{Query: "SELECT FROM partition=testWrite", Limit: 100, WaitTimeout: 10}, 
	    true,
		func(qr *api.QueryResult) {
			for _, ev := range qr.Events {
				ts := time.Unix(0, ev.Timestamp)
				fmt.Println(cnt, ": ts=", ts, ", msg=", ev.Message)
				cnt++
			}
		},
	)
```

In the example above records will be read from the partition tagged by `partition=testWrite`, by portions of 100 records in each. The received records just simply printed into standard output. If the end of the stream is reached, the `Select` function will wait for new records and call the function again, as soon as the new data is available. 

## Code examples
The [read-write](https://github.com/logrange/logrange/blob/master/examples/read-write/readwrite.go) example demonstrates how the write and read operations described above work together.<br/>
The [streaming](https://github.com/logrange/logrange/blob/master/examples/streaming-read/streaming.go) records example shows how the records could be read in streaming mode.

To build the examples just type the following commands from the source directory of `github.com/logrange/logrange` on your local machine:

```bash
go build -o read-write ./examples/read-write
go build -o streaming-read ./examples/streaming-read
```

Use the 2 executables `read-write` and `streaming-read` to see how it works. You need to have Logrange server unning in its default configuration for listening clients requests on `127.0.0.1:9966`. 
