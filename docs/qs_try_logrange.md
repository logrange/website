## Try Logrange
This guide helps to build a quick understanding how Logrange works, and it should not take longer than 5 minutes. You will run logrange server on your local machine, ingest logs from /var/log folder into the database, open shell and make several requests to the database to read the data. All the data will be stored into one folder, so no worries about hidden places and configs around your filesystem....

This guide should work on Linux or MaxOs, just follow steps below:

### Step 1. Put everything into one dir
Make a directory and change the current one to the just created `lrquick`:
```bash
mkdir lrquick
cd lrquick
```

### Step 2. Install logrange server and run it
```bash
curl -s http://get.logrange.io/install | bash -s logrange -d ./bin
./bin/logrange start --base-dir=./data --daemon
```
Normally, you have to see something like `Started. pid=12345`. This is good sign, so go ahead.

### Step 3. Install logrange client and start collecting logs from the machine
```bash
curl -s http://get.logrange.io/install | bash -s lr -d ./bin
./bin/lr collect --storage-dir=./collector --daemon
```
The command above runs collector in background. It will send logs found in `/var/log` folder to the logrange server started in step 2. 

### Step 4. Connect to the server, using CLI tool.
```bash
./bin/lr shell
...
```

In the logrange shell, you can try `select` to retrieve collected data: 
```
lr> select limit 10
```

Or try `help` to find out which commands are available.

For example, `show partitions` will show the list of partitions (tables of records), that were created as a result of ingesting records from different files of your local machine:

```bash
lr>show partitions
17 partitions (starting with offset=0):

      SIZE        RECORDS  TAGS
----------  -------------  ----
     23 MB       146,457  file=install.log
...
----------  -------------
     42 MB        323,307

total: 17 sources match the criteria
lr>
```

You can try [SELECT](sql_select.md) statement to retrieve the data from one or many paritions. For example:
```bash
lr>select from file=install.log position tail offset -10 
...
total: 10, exec. time 4.988447ms

lr>
```

You can leave the shell by pressing `Ctrl-C` or just type `quit` command.

## Cleaning up
From the logrange folder `lrquick` type the following commands to stop collector and the logrange server:
```bash
./bin/lr stop-collect --storage-dir=./collector
./bin/logrange stop --base-dir=./data
```

Now, to clean up, just remove the `lrquick` folder:
```bash
cd ..
rm -rf ./lrquick/
```

