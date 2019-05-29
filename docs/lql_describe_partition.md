`DESCRIBE PARTITION` command prints detailed information about a partition. Partition is identified by the tags provided:
```
DESCRIBE PARTITION {<tags>}
```

The tags should be in curly braces. Requested partition must have the set of `tags`

### Example
`DESCRIBE PARTITION {name="nginx"}` describe partition which contains only the tag `name="nginx"`
