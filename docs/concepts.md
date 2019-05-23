# Logrange Concepts
This document contains main concepts which are essential to understand how Logrange works. 
 
## Data record
Data record is an array of bytes of length N, which is called _size_ of record. The Size of record could be in the range `[0..16384]` (up to 16KB). Record, which contain 0 bytes has Size `N=0`
 
## Stream of records
Logrange works with stream of records. Stream is an ordered, immutable sequence of records. Records could be appended to a stream:

```
 +--------------------------------------+      +----+
 | R0 | R1 | R2 | R3 | R4 | R5  R6 | R7 |   <- | R8 |
 +--------------------------------------+      +----+
```
 
Records in the stream, could be read, but not updated. New records are always added to the end of the stream, so any stream has FIFO (First-In, First-Out) specific. 
 
### Record Position
Each record in a stream has its position, so it could be read by the record position. The position is encoded into text and usually seems like senseless for human read. The examples could be `0000AB12FD093413` or `479ADF00EC938:123409EEE0091` etc. 
 
The records positions could be copy-pasted to be used in different queries to start reading from the position. They must not be modified by user and provided by Logrange for referring to a record in a stream. 
 
## Event
_Event_ is a record, which payload could be decoded into the object with consists of a list of _fields_. _Field_ is the key-value pair. Event can contain 2 mandatory fields and 0 or more optional ones. The mandatory fields are:
- _ts (timestamp)_ - the field contains a date-time point which associated with the event.
- _msg (message)_ - a text field, which contains a text with 0 or more characters
 
Optional fields are text fields. The name of an optional field could not be `ts` or `msg`.
 
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
Write operation is a process of appending one or more records into ONE partition. Write always specifies the target partitions where the records could be appended to. In case of multiple writes happens at the same time, the records could be shaffled and there is no guarantee which record comes first. 
 
Example. Two operations W1 and W2 applied simultaneously for a partition P:
```
1. Before writes: P=[R0, R1, R2, R3]
2. Two writes happened at the same time: W1=[A0, A1, A2], W2=[B0, B2, B3, B4] 
3. After the writes: P=[R0, R1, R2, R3, B0, A0, A1, B2, B3, B4, A2]
```
Logrange guarantees that in the result of a batch write operation W: 
1. All the records from W will be appended after the all records from the partition, which were there before the write operation. 
2. The records from the write operation W will appear in the partition in same order as they were written there. 
 
## Pipe
_Pipe_ is a mechanism by which records from a write operation W could be also written to another partition.
 
A Pipe has the following attributes:
- _Name_. A pipe unique name which provided by user. 
- _Source filter_. This is a condition, which will be applied to tags of a write operation W. In case of the condition is true, the pipe operation will be triggered
- _Destination Tags_. A tags combination which uniquely identify resulted partition
- _Records filter_. This is a condition which will be applied to every record from W. Only records that meet the criteria, will be written into the destination pipe. 
 
Example. Let's suppose that we have the pipe configured (JSON format is used here for visualization purposes):
```
Pipe: {
    Name:"duplicate for names", 
    SrcFilter: "name != '' ",
    DstTags: "{pipe_with_names=1}",
    RecordsFilter: ""
}
```
For the example the pipe will duplicate any operation W, which made to a partition with a non-empty `name` tag, to write all of the records from W into the partition tagged by `{pipe_with_names=1}`. Due to the pipe records from W can appear in 2 partitions, the initial one, where the W has been made to and the "piped" one, if the operation W meets the pipe criteria.
 
 
 
 
 

