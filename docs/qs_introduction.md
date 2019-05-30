## What is Logrange?
Logrange is an [open-source](https://github.com/logrange/logrange) streaming database for aggregating application logs, metrics, audit logs and other machine-generated data from thousands of sources.

Logrange is built upon the following principles:
- Every piece of data has its value
- Writing data is inexpensive, regardless of volume It’s convenient to have
- One place for storing data(logs, metrics, audit, etc.)
- Store first, process later

Logrange infrastructure includes the database and its clients. Database is one or a group of servers run as a cluster. Clients intend for writing data into the database or read it out of there. [LQL](lql.md) language is used for reading data from the database.

## What do I need to run it?
Logrange executables are available for Linux and MacOs, it takes about 5 minutes to [try it out](qs_try_logrange.md) on your local machine to see how it works. 

Logrange solutions could be deployed in cloud, on-premise, in VM or in a container, everywhere where Linux runs.

Logrange is written in Golang, so it probably could be build for Windows platform, but we don't see a strong reasons to do it at this moment, so, never tried. 

## Solutions
At this moment Logrange has some tools for building a log aggregation. 