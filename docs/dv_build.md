# Building Logrange
To build Logrange from sources you need to have [Golang](https://golang.org/doc/install) installed on your local machine. Building logrange is pretty straight-forward process. 

Get logrange sources and its dependencies:
```bash
go get -u -v github.com/logrange/logrange
cd $GOPATH/src/github.com/logrange/logrange
go get ./...
```

To build logrange type:
```bash
go build -v ./...
``` 

you can run tests to be sure everything is fine:
```bash
go test -v ./...
``` 

install executables:
```bash
go install -v ./...
``` 

To run the server locally with default settings just type:
```bash
logrange start
``` 

To connect to the server from another terminal window type:
```bash
lr shell
```



