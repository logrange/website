# Logrange Concepts
This document contains main concepts which are essential to understand how Logrange works. 
 
## Data record
Data record is an array of bytes. The size of record (number of bytes in the array) could be in the range `[0..16384]` (up to 16KB). A record could be 0 length.
 
## Stream of records
Logrange works with streams of records. Stream is an ordered, immutable sequence of records. Records could be appended to a stream:

```
 +--------------------------------------+      +----+
 | R0 | R1 | R2 | R3 | R4 | R5  R6 | R7 |   <- | R8 |
 +--------------------------------------+      +----+
```
 
Records in the stream, could be read, but not updated. New records are always added to the end of the stream, so any stream has FIFO (First-In, First-Out) record access method. 
 
### Record Position
Each record in a stream has its position, so any record could be addressed by the record position. The position is encoded into text and usually seems like senseless for human read. The examples could be `0000AB12FD093413` or `479ADF00EC938:123409EEE0091` etc. 
 
The records positions could be copy-pasted to be used in different queries to start reading from the position. They must not be modified by user and provided by Logrange for referring to a record in a stream. 
 
## Tags 
Tag is a key-value pair with text representation for both key and the value. A tag could be written by `name=application1` or better to quote the value like `name="application number 1"`
 
Tags are comma-separated tag values e.g. `name="app1",ip="27.3.2.1"`. Logrange often requires to provide tags in curly braces, so Tags are written in the following form `{name="app1",ip="27.3.2.1"}`
 
Tags are used for naming streams, partitions.
 
## Partition
_Partition_ is a persisted stream of records with unique combination tags applied to it. An analogy of partition could be a table of records in a relational database or collection of records in an NoSQL database. 
 
In Logrange every partition has unique combination of tags. For instance, this 3 combinations of tags are unique, even some tags could be same, or one combination is a subset of an another one:
```
{name="app1",ip="27.3.2.1"}
{name="app1"}
{ip="27.3.2.1"}
```
So this 3 combinations of tags are unique, so each of them can address a specific partition.
 
## Write operation
Write operation is a process of appending one or more records into ONE partition. Write always specifies the target partition where the records to be appended to. Write operation has the following attributes:
- _partition tags_ - which uniquely identify the destination of the records
- _records_ - a set of the records which should be written to the partition

If the partition with the combination of tags doesn't exist, it will be created by the write operation. 

In case of multiple writes happen to the same partition at the same time, the records could be shuffled. 
 
Example. Two operations `W1` and `W2` applied simultaneously for a partition `P`:
```
1. Before writes: P=[R0, R1, R2, R3]
2. Two writes happened at the same time: W1=[A0, A1, A2], W2=[B0, B1, B2, B3] 
3. After the writes, one of the possible result: P=[R0, R1, R2, R3, B0, A0, A1, B1, B2, B3, A2]  
```
Logrange guarantees that in the result of a batch write operation `W`: 
1. All the records from W will be appended after the all records from the partition, which were there before the write operation. 
2. The records from the write operation W will appear in the partition in the same order as they were written there. 
 
## Pipe
_Pipe_ is a mechanism by which records from a write operation could be also written to another partition.
 
A Pipe has the following attributes:
- _Name_. A pipe unique name provided by user. 
- _Source filter_. This is a condition, which will be applied to tags of a write operation. In case of the condition is true, the pipe operation will be triggered. 
- _Records filter_. This is a condition which will be applied to every record from write operation. Only records that meet the criteria, will be written into the destination pipe. 

Every write operation to any partition is checked against knonwn pipes. A pipe is triggered if its _source filter_ matches tags from the write operation `W`. The triggered pipe allows to write one or all records from `W` to the partition tagged by `{logrange.pipe=<pipe name>}`

Example. Let's suppose that we have the pipe configured (JSON format is used here for visualization purposes):
```
Pipe: {
    Name:"pipe1", 
    SrcFilter: "name != '' ",
    RecordsFilter: ""
}
```
For the example the pipe will duplicate any operation `W`, which is applied to a partition with a non-empty `name` tag. All records from `W` will be written to the partition tagged by `{logrange.pipe=<pipe name>}` as well. 
 
 ## Write request example
 The following picture visualize data writing process:
 ![](assets/concepts1.png)
 On the picture the following steps are depicted:
 1. A Write operation request is sent by a client
 2. Partition Controller parses the request and looks for partition tagged by `{name="app1",ip="1.2.3.4"}`. In the example the partition already exists and contains some data. If the partition doesn't exist the Partition Controller will create it.
 3. Partition Controller writes records from the request into the partition. It also notifies Pipe Controller about the write operation. Pipe Controller checks whether there is a pipe for duplicating the write operation into another partition.
 4. Pipe Controller has found a pipe which requires to duplicate the write operation into another partition `{logrange.pipe="app1"}`. Pipe Controller initiate the writing process.
 5. The portion of the data written into partition `{name="app1",ip="1.2.3.4"}` is copied to the partition `{logrange.pipe="app1"}`

 