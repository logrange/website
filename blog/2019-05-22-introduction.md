# What is Logrange?
Logrange is an open-source platform intended to persist streaming data from thousands of sources. The streaming data is produced in forms of application logs, system metrics, audit logs and other time-based parameters that could be recorded. Logrange allows to persist the information in real-time for further processing later. That is why we call it streaming database.

__There are plenty of tools that allow to aggregate application logs, metrics and other streaming data. what does make Logrange different?__ 
Logrange uses another philosophy, which could be expressed by: 

> _to persist the data first to have a chance to work with it later_. 

In comparision to many existing tools, that use another concept 

> _to filter data first to persist only essential one for working with it later_

Logrange is going to be the game changer. Why? Let's try to look into some details. 

# Streaming data and why it should be stored.
To understand why the streaming data should be stored and analyzed let's look at distributed informational systems, which produce a lot of streaming data and why the data should be analyzed at all.

__What is the streaming data in the informational systems?__ 
Application logs, audit logs, real-time metrics like CPU consumtption, RAM and disk usages recorded in time - are all of the examples of streaming data. The streaming data is data that is generated continuously by thousands of data sources, which typically sent in the data records simultaneously, and in small sizes.

Despite of the fact that the records are small, due to the number of records the streaming data has very significant volume, which could be counted in hundred of megabytes per second(!)

This data needs to be processed sequentially and incrementally on a record-by-record basis or over sliding time windows, and used for a wide variety of analytics including correlations, aggregations, filtering, and sampling.

__Why should we care about streaming data?__ 
Modern distributed informational systems consist of hundreds or even thoursands of components (applications). Every such application has its own logic and behavioral specific which contributes into the whole system state. A distributed system behaviour is more complex than the behavior of any of components it consists from. 

When one or many components deviate from their normal behavior it can affect the system health in a whole. An application anomaly can bring the distributed system to some unpleasant states. Such states can cause the system performance degradation or even the service interrupttion. So, it is extemely important to monitor the system components states, to catch unpleasant trends to react on them on time. 

The main sources, where the information about a component state could be obtained, are the application logs, audit logs, various system metrics and real-time resource consumption metrics. Collecting and analyzing such kind of information would help to understand the distributed system health.

So as the number of such system components can be significant and the amount of the information can be tremendously big, the collecting and persisting of such big amount of information could be a problem.

> To understand the distributed system behavior we have to work with streaming data effectively

## What are the problems to work the streaming data effectively?
There are 2 problems:
1. Data aggregation. It becomes a problem when the amount of the streaming data is big enough (hundreds or thoursands megabytes per second). System, which aggregates the data should be fast enough to be able to persist it in real-time.
2. Data analyzying. So as the data is produced by different distributed system components, to find a correlation between streaming data received from different components could be a problem due to their nature difference.

__What do existing solutions propose?__ 
There are plenty of products on the market that offer various solutions by collecting and managing the streaming data. There are different classes of products. Some of them allow to collect application logs, another ones offer monitoring resources or some application metrics. There are class of tools that analyze and predict system behavior based on some information collected. What unite all of the tools is the concept:

> Persisting filtered data which seems to be useful. All other should be dropped.

The concept dictates the approach that engineers should clearly understand what problems they will face with the distributed system and what kind of streaming data should be collected to reveal them. 

The working with such kind of systems suppose to make the following steps:
1. Understanding what kind of problems can happen
2. Understanding what kind of streaming data will be helpful
3. Building data filters and strucutre your data for further analysis
4. Store only filtered structured data, dropping all the rest 

Unfortunately, the reality is not perfect as we imagine it, so the approach turns into the following on practice:
1. Most of streaming data is not stored or disregarded by a number of reasons. Popular ones are: cost of data processing is too high or the data was considered like inessential.
2. Different tools store different type of streaming data and they are not linked each other for further processing.

# Why Logrange?
Logrange is built with another philosophy, which is expressed by the following concept: __To persist the data first to work with already persisted data later__. 

Logrange supposes to have the following steps to work with streamind data:
1. Store any data you system produce, to have it persisted in one place
2. Having the data persisted, we can use different approaches for analyzing it. The various methods will use different sub-sets of persisted data.

This approach flips "traditional" one, which is dictated by the cost of handling a record of streming data. Logrange tries to reduce the write operation cost. Applying to the application logs storage, Logrange doesn't try to build index the data, it just stores it. The data could be indexed later and only in case if it makes sense, cause different methods require different data handling.

Persisting streamind data from different sources in one database allows to apply different analysis to the data later. This also gives significant benefits comparing to tradictional approach when engineers should make a decision which data should be persisted based on the methods they are going to used later. Different methods of analyzis could be used later cause the data is persisted and there was no need to filter it before.

# Conclustion
Logrange has been building with using following philosophy:
1. To persist streaming data first, analyze and process it after.
2. Streaming data persistence should be cheap, to save whatever is written
2. To collect unstructured data from different sources in one place.
3. Oepn source and secure
4. Be deployed in cloud or on premises.







