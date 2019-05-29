`CREATE PIPE` statement has the follwoing syntax:

```
    CREATE PIPE <pipe name> 
        [FROM ({<tags>}|<tags expression)] 
        [WHERE <fields expression>]
```

`CREATE PIPE` allows to create a new pipe. Pipe is a hook on a write records to a partition operation. Pipes allow to write some hooked records into  a piped partition, what could be helpful for further processing them out of there. An obvious example could be to collect ALL records that contains "ERROR" word to a special partition. All records that meet the pipe criteria ("ERROR" word in the message) will be also written in the piped partition, where they can be easily find later.

`FROM` statement allows to specify filter for piped partitions by the the tags criteria, which syntax is described [here](lql_select.md#selecting-partitions)<br/> 
__Default value__: empty, what corresponds to any partition.

`WHERE` condition allows to set up a filter for records that should be piped. The syntax for the filter same as for [SELECT](lql_select.md#filtering-records)<br/>
__Default value__: empty condition, which means any record. 

The piped partition has the tag `{logrange.pipe=<pipe name>}`. It contains ONLY records which were written after the pipe had been created.

Pipe feature is not completed and it doesn't yet allow to chaining writes. Suggestions are welcome.

## Examples

`create pipe forwarder` creates the new pipe with name `forwarder` which allows to write all records that will be written in any partition to write to the piped partition as well.

`CREATE Pipe app1Errs FROM name="app1" WHERE msg contains "ERROR"` creates pipe "app1Errs", which will contain error messages from the partitions tagged by `name="app1"`   

