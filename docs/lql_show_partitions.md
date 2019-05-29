`SHOW PARTITIONS` allows to list all partitions by tags expression. The partitions will be ordered by their size, so paging is available:
```
SHOW PARTITIONS [
    ({<tags>}|<tags expression)]
    [OFFSET <number>]
    [LIMIT <number>]
]
```

__tags expression__ is specified the same way, like it is desribed [here](lql_select.md#selecting-partitions)

`OFFSET` allows to skip a number of partitions from the top of the list. Default
value is 0. Non-negative numbers are expected.

`LIMIT` sets the number of partitions that should be shown. Default value is 
infinity, so all partitions will be shown.

## Examples
`SHOW PARTITIONS` displays all known partitions
`SHOW PARTITIONS LIMIT 10` displays first 10 partitions
`SHOW PARTITIONS name like "app*"` displays all partitions with tag `name` which starts from "app"