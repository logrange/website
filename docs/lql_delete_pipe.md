`DELETE PIPE` removes the pipe and stops writing to the piped partition:

```
    DELETE PIPE <pipe name>
```

The operation doesn't affect the target partition (tagged by  `{logrange.pipe=<pipe name>}`), but just removes the pipe. 