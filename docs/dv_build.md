# Building Logrange
To build Logrange from sources you need to have [Golang](https://golang.org/doc/install) installed on your local machine. Building logrange is pretty straight-forward process.

If $GOPATH is not configured, do `export GOPATH="$HOME/go"`
Add the bin path to $PATH: `export PATH=$PATH:$GOPATH/bin`

Get logrange sources and its dependencies:
```bash
go get -u -v github.com/logrange/logrange
cd $GOPATH/src/github.com/logrange/logrange
go get ./...
```
If you run into `modules disabled by GO111MODULE=auto`, do `export GO111MODULE=on`

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

If you are on a Mac and denied permission to `/opt/logrange`, manually change permission of `/opt`
recursively in the Mac Finder rather than using `sudo` access to start the server. Using `chmod` may not work.

To connect to the server from another terminal window type:
```bash
lr shell
```
