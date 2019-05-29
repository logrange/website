`TRUNCATE` allows to remove part or ALL data from one or many partitions:
```
TRUNCATE 
    [DRYRUN] 
    [({<tags>}|<tags expression)]
    [MINSIZE <size>]
    [MAXSIZE <size>]
    [BEFORE <timestamp>]
    [MAXDBSIZE <size>]
```

Logrange partitions consist of chunks, so when a partition is truncated one or many chunks are removed from the partition. There is no way to remove only one record, unless the removed chunk contains only one record. The partition's chunks are ordered - oldest chunks come first. A partition, if it is truncated, always lost oldest chunks. The parameters of the `TRUNCATE` command define which chunks should be deleted

### Specifying sizes
The `<size>` parameter can be provided in bytes (1000000) or in a human readable short form like kilobytes (1000k), megabytes (1M), gigabytes etc.notations could be used as well.

### Dryrun mode
`DRYRUN` flag allows to run truncation in test mode without actual truncation. The flag is helpful to see which data will be actually removed if the flag is not provided.<br/>
__Default value__ is FALSE (!)

### Selecting partitions
`({<tags>}|<tags expression)` allows to specify the condition which partitions will be affected. The default value is empty string, what means ALL partitions. The rules by building of the tags are same as for [SELECT](lql_select.md#selecting-partitions)

### Specifying minimum partition size
`MINSIZE` allows to set the bar to minimum partition size. The flag value does not allow to truncate a partion which will follow to the partition size less than the value provided. For example if the initial partition size is `100G` and the flag is set to `50G` the partition cannot be truncated less than the size `50G`.<br/>
__Default value__: 0

### Specifying maximum partition size
`MAXSIZE` allows to set the parition(s) size to be be considered. A partition must be at least the `MAXSIZE` provided to be truncated. <br/>
__Default value__: 0

### Filtering chunks by records timestamp
`BEFORE` allows to specify the timestamp of chunk records to be truncated. Only chunks where ALL records timestamped before the provided value, could be removed.<br/> 
__Default value__: 0

### Truncating by database size condition
`MAXDBSIZE` allows to limit the total partitions size. If the existing partitions' size exceeds the value, some or all partitions will be deleted completely. The partitions will be sorted by latest write time and deleted until the limit is reached.<br/>
__Default value__: unlimited

**Note**. `TRUNCATE` with using both `MAXSIZE` and `BEFORE` flags provided, are composed by
logical OR condition. It means that a partition's chunks will be removed either they
meet `MAXSIZE` or `BEFORE` criteria, but NOT BOTH OF THEM.

## Examples
`TRUNCATE DRYRUN MAXSIZE 10M` prints information about truncating all partitions which size exceeds 10M

`TRUNCATE MINSIZE 50M MAXSIZE 10G ` truncates all partitions which size exceeds `10G`, leaving at least `50M` of data in each partition.

`TRUNCATE name prefix "cust_app" BEFORE "-15d" ` truncate all partitions with tag `name` which value starts from "cust_app". Only records that are older 15 days from now could be removed. 