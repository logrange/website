# Logrange Query Language 
The Logrange Query Language is used to communicate with Logrange database. The LQL syntax looks like [SQL](https://en.wikipedia.org/wiki/SQL) and has similar goals as SQL has: to be used for requesting data from a database and managing its structures.

To understand LQL it is good to know the Logrange [concepts](concepts.md)

## Record encoding
LQL supposes that every record in database has 2 mandatory fields:
- _ts_ - record timestamp
- _msg_ - record message. A text field which contains message associated with the record

A record may contain optional fields, chich could be specified in key-value form. For example `field1="abc"`

## Statements
LQL has the following basic commands:

[SELECT](lql_select.md) - reading records from the database<br/>
[SHOW PARTITIONS](lql_show_partitions.md) - showing list of partitions in the database<br/>
[DESCRIBE PARITION](lql_describe_partition.md) - providing details about a partition<br/>
[TRUNCATE](lql_truncate.md) - deleting information from the database<br/>
[SHOW PIPES](lql_show_pipes.md) - show list of known pipes  
[CREATE PIPE](lql_create_pipe.md) - creating new pipe<br/>
[DESCRIBE PIPE](lql_describe_pipe.md) - providing details about a pipe<br/>
[DELETE PIPE](lql_delete_pipe.md) - deleting pipe<br/>

