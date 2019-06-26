`SELECT` is used for reading records from a Logrange database. `SELECT` statement has the following syntax:

```
	SELECT [<format string>] 
		[FROM ({<tags>}|<tags expression)] 
        [RANGE (<timePoint>|[<timePoint>:<timePoint>])]
		[WHERE <fields expression>] 
		[POSITION (head|tail|<specific pos>)] 
		[OFFSET <number>]
		[LIMIT <number>]

```

`SELECT` statement allows to read records from one or multiple partitions. The records will appear in the result stream in the order, they were appended to the partition(s). If the result stream contains records from multiple partitions the meging procedure will be applied:
1. repeat until at least one non-empty partition
2. current record timestamp from a partition is compared with a current record of any other partition
2. record from the partition with the lowest current record timestamp is selected and placed to result stream. Next record for the partition becomes current. Go to the Step#1

Records from the result stream could be filtered. Also, the `SELECT` statement allows to specify starting read position and the number of records expected to be in the result stream.

### Formatting records 
The `<format string>` is a template for formatting records in the result. The template should be placed in double quotes with variables placed in curly braces. The curly braces `{` and `}` could be escaped by `{{` for `{` and `{}` for `}`.
 
For example, the template `"Record content: {msg}\n"` will put the prefix `"Record content: "` before each record's message. The following variables could be used in the template string:
	
`ts` - record timestamp<br/>
`ts.format(<format>)` - record timestamp formatted according the `<format>` (see [GoLang time parsing conventions](https://golang.org/pkg/time/#Parse))<br/>
`msg` - record message (`msg` field value)<br/>
`msg.json` - record message escaped and placed in double quotes<br/>
`vars` - record tags and optional fields put together<br/>
`vars:<name>` - record _field_ or _tag_ value given by the name provided<br/>

__Example__: `"{ts.format(2006-01-02)} {vars:source} {{{msg}{}"`<br/>
__Default value__: `"{msg}\n"`

### Selecting partitions
The `FROM` statement allows to define partitions where records will be read from. The `FROM` statement contains a _tags condition_ is a logical expression which is executed for every partition. Partitions for which tags the condition has `true` result, will be selected. The condition could be written in one of the following 2 forms:
1. Simple form
2. Logical expression form

__Simple form__
In this form the list of tags, that must be in a partition tags is provided. For example the expression `{name="app1",ip="57.43.3.4"}` means - all partition with both tags `name="app1"` AND `ip="57.43.3.4"`. So partition tagged by `{name="app1",pod="1234",ip="57.43.3.4"}` matches the condition, but the partition with tags `{name="app1",pod="1234"}` does not.

__Logical expression__
This form allows to specify an expression using boolean `AND`, `OR` and `NOT` conditions. For tags matching logical expressions and some glob comparisons are available. For example, the condition `name like "app*" OR pod="1234"` allows to select all partitions, which have tag `name` with value started from "app", OR a partition with tag `pod="1234"` value.

__Tag logical operations__
The following operations are allowed to check a tag value: `<`, `>`, `<=`, `>=`, `!=`, `=`, `LIKE`, and `CONTAINS`.

`LIKE` uses [Glob conventions](https://golang.org/pkg/path/filepath/#Match) to test a tag value. 
`CONTAINS` is used for testing whether the tag value contains provided text or not.

__Example__: `name Like "application*" OR name = "app1"`<br/>
__Default value__: `` - empty string, which means to select ALL partitions.

### Specifying time-interval
The `RANGE` statement allows to define the time-range from which records will be selected. The `RANGE` statement is a special type of time filtering, which allows to utilize time index for records selection. For streams with monotonically increased timestamp _ts_ field value this kind of requests could be very effective. 

Range defines the time interval with 2 values, which identify the time interval. The interval's time-points, could be specified in a _relative form_ or an _absolute one_.

__Relative form__ is a negative number of minutes, hours, days etc. to the current time. It should be placed in qoutes. For example: `"-10m"` means ten minutes ago (from now), `"-3.5h"` means 3 and a half hours ago etc.  The form allows the letters `m` for minutes, `h` for hours and `d` for days. 

Also, the time point can be one of the words wihout any digits: `"minute"`, `"hour"`, `"day"` and `"week"` which mean beginning of last minute, hour, day or week correspondingly. 

__Absolute time__ point could be specified in the form `"2019-05-03 15:43:55 -0700"` which contains date, time and timezone, or it could be just time of the current date `"07:15:23"` etc. 

The `RANGE` could be specified in one of 2 forms. First one is short, which allows to specify only start time point like `RANGE "-1.5h"`. The second form allows to specify both time points like `RANGE ["-1h":"-0.5h"]` or only the end one like `RANGE [:"-1.5h"]` 

__Default value__: `` - empty string, accepting all values of _ts_.

### Filtering records
The `WHERE` statement allows to define an exression to filter records. The `WHERE` statement can contain mandatory record fields `ts` and `msg` or an optional record field, which should have `fields:` prefix. For example: ` ... WHERE msg CONTAINS 'ERROR' OR fields.source LIKE 'system*' ... `. 

__timestamp conditions__
The following operations allowed to be used with _ts_ field value: `<`, `>`, `<=`, `>=`. The time value can be written in the form described in [RANGE](#specifying-time-interval). For example `ts > "-10m"` means consider records with the timestamp greater than time 10 minutes ago or less.

__msg conditions__
The following operations allowed to be used with _msg_ field value: 
`CONTAINS` tests whether _msg_ contains the text provided  
`PREFIX`  tests whether _msg_ starts with the text provided  
`SUFFIX`  tests whether _msg_ ends with the text provided  
`LIKE` uses [Glob conventions](https://golang.org/pkg/path/filepath/#Match) to test the _msg_ value

__other fields conditions__
The following operations allowed to be used with optional record fields values:
`CONTAINS` tests whether the field contains the text provided  
`PREFIX`  tests whether the field starts with the text provided  
`SUFFIX`  tests whether the field ends with the text provided  
`LIKE` uses [Glob conventions](https://golang.org/pkg/path/filepath/#Match) to test the  the field value  
`=` the filed value is equal to the text provided  
`!=` the filed value is not equal to the text provided  
`<` the filed value is less than the text provided  
`>` the filed value is greater than the text provided  
`>=` the filed value is equal or greater than the text provided  
`<=` the filed value is equal or less than the text provided  

__field transformation functions__<br/>
There are 2 functions available to transform text fields _msg_ and _fields:field-name_ values:<br/>
`Upper()` - returns all Unicode letters in upper case<br/>
`Lower()` - returns all Unicode letters in lower case<br/>

__Example__: <br/>
`WHERE msg contains "ERROR" or fields:id="1234"`<br/>
`WHERE Lower(msg) contains "error"`<br/>

__Default value__: `` - empty string. It means no filter applied, so it accepting all records.

### Specifying the start position 
The `POSITION` part defines the starting position where records should be read from 
It could be `head`, `tail` or a string which could be received from previous 
requests. 

__Default value__: `head` 

### Skipping records from the start position
The `OFFSET` statement allows to skip the `<number>` of records from the _start position_, berfore placing them into the result stream. The `<number>` could be negative, what means skip the absolute number of records towards to the head of stream before starting to read them. 

__Example__: `... POSITION tail OFFSET -10 ...` literally means the following - to set position to the tail of the stream; then, to skip 10 records shifting the start position towards to the head and to start read from there... In short  - to read last 10 records from the stream.<br/>
__Default value__: 0 - no offset

### Limiting result 
The `LIMIT` allows to specify the number of records to be placed in the result stream. Result stream can contain less, if the total number of records is less than the number

__Default value__: 50 records

## Examples
`SELECT FROM name="app1" LIMIT 1000` - to read 1000 records from head, merging all partitions with tag `name="app1"`

`SELECT FROM name="app1" POSITION tail OFFSET -10` - to read 10 last records, merging all partitions with tag `name="app1"`

`SELECT FROM name="app1" WHERE upper(msg) contains "ERROR" LIMIT 1000` - to read 1000 records, that contain word "ERROR", starting from head, merging all partitions with tag `name="app1"`<br/>

