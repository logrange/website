---
title: Announcing Logrange v0.1.0 
author: Dmitry Spasibenko
---
![](https://raw.githubusercontent.com/logrange/website/master/blog/assets/Logrange-Logo-S.png)

[Logrange](https://github.com/logrange/logrange) is an open-source streaming database intended for aggegating application logs, metrics, audit logs and other streaming data from thousands of sources. Logrange allows to persist the information in real-time for further processing later. 

Logrange is built around the idea that every piece of data is essential. Streaming data such as application logs could be used for different type of analysis, so it should not be dropped just becuase it seems like a garbage, or because it is too big for the pre-preocessing. 

Also, collecting different types of data and persisting it in one database can signifcantly improve analysis by searching correlation between differnt types of events.

Logrange is going to be the game changer in distributed systems analytics. Why? Let's try to look into some details. 

### Distributed System health and its analysis
Modern distributed informational systems consist of hundreds or even thoursands of components (applications). Every such application has its own logic and behavioral specific which contributes into the whole system state. A distributed system behaviour is more complex than the behavior of any of the components it consists from. 

When one or many components deviate from their expected behavior it can affect the system health in a whole. Usually we call this deviations as application faults. Components' faults can bring the distributed system to some unpleasant states. Such states can cause the system performance degradation or even the service interrupttion, or the whole system failure. So, it is extemely important to monitor the system components states, to catch unpleasant trends to react on them on time. 

> The main sources, where the information about a component state could be obtained, are the application logs, audit logs, various system metrics and real-time resource consumption metrics. All of this are examples of so-called _streaming data_.

The **streaming data** is data that is generated continuously by thousands of data sources, which typically sent in the data records simultaneously, and in small sizes.

Despite of the fact that the records are small, due to the number of records the streaming data has very significant volume, which could be counted in hundred of megabytes per second(!)

This data needs to be processed sequentially and incrementally on a record-by-record basis or over sliding time windows, and used for a wide variety of analytics including correlations, aggregations, filtering, and sampling.

To analyze a distributed system with a purpose to understand whether it is doing well or something goes wrong with it, there are 2 steps should to be done:
1. _Streaming data_ from different system components should be collected.
2. Collected information should be analyzed to reveal componnts faults and to build a picture about the system health. 

On practice this 2 steps turn into two problems, which should be solved to analyze the distributed system health successfully. 

### Data aggregation problem.
The biggest issue with data aggregation is the amount of streaming data that should be saved. Due to the real-time data specific, number of components and the amount of the data produced persisting it becomes a challenge. 

For example, a distributed system can consists of hundreds of servers, and each of them can produce several gigabytes of logs per hour. The amount could easily reach several terabytes per day. 

Most of log aggregation solutions offer powerful tools like full-text search, so they do some data processing like indexing. To index the tremendous amound of data requires significant resources and often it doesn't makes sense at all, so the modern approach is to ask for less logs, to make the tool works. 

Filtering application logs before they will be saved seems to be error prone approach. There is a chance for sure to disregard important information, which can be considered unessential by a mistake.

> So, the common practice is to filter unessential information, persisting only essential one. The problem here is we loose information, which could be important for further analysis. 

Logrange intends to solve the problem.

### Data analysis problem.
There are different types of streaming data, so there are different tools that intend for collectiong special type of the data as well. Some tools indended to collect system metrics, another ones monitor application resources, third ones collect application logs etc.

It would quite make sense to bring all data from the tools together for further analysis, but the reality looks different. In production systems we could see dozens monitoring tools with a full stack of tools intended to work with the data for a specific domain. One tool monitors and sends some alerts for CPU consumption, another one collects users activity. But for understanding the root cause of high-CPU usage it is not enough to send an alert about it. May be it needs to look into the users activity, but the tool, which collects system metrics, has zero idea about what the users activity is. Practically this is done by humans, but can be done by machine.

In other words:
> There are plenty of tools which collet different streaming data, but the data is not put together for comprehensive analysis, so only the data domain specific alerting and analysis is available.

Logrange is about to solve the problem as well.

### What does Logrange offer?
Logrange offers a method by working with big amount of streaming data. Logrange doesn't try to reduce the amount of data to be persisted, it tries to reduce the amount of data which should be processed in a specific way. 

#### Persisting everything
Instead of trying to persist only essential data, Logrange offers to persist all the data. It will be possible if Logrange doesn't try to pre-process data, but just saves it.  Actually what it does. Having all the data persisted, different types of processing for different data sub-sets can be applied. This allows to apply countless methods of data analysis, buidling diffrerent models and gradually approach to understanding the system behavior. 

#### Working with the data sub-sets.
Logrange allows to store different type of streaming data in one database what gives an advantage by structuring it and building various correlations and data analysis on top of the database. For example, Logrange can keep system metrics, application and business logs or any other metrics in it's database. Different types of analysis can be applied. It doesn't make sense to build full-text search index on top of system metrics. But aggregation functions quite make sense.

### Conclusion
Logrange strives to achieve the following goals:
- Persisting streaming data should be cheap. All data is important, so it should be persisted to for later processing.
- To provide an API for uniform access to the data from thousands of different sources. All data is in one database.
- To provide tools for the aggregated data further learining and analysis to build an advanced features like AI for the distributed system health.
- Logrange is open-source and secure, to meet high quality standards for transferring, saving and processing data.
- Could be run everywhere either in Cloud or on Premises configurations.
- Easy to run and configure

Logrange is data-centric tool. We, Logrnage's developers, believe that the key component for successful distributed system behavior understanding is streaming data, collected from different part of the system. We believe that they key component of such systems not the method we apply for the data analysis, but have an ability to apply different methods on stored data. We believe, that everything should be stored first and only after that we can afford to apply different data analysis on the stored data sets - building full-text search indexes, aggregations, deep-learining models or even remove a garbage. But before all of this the data must be saved.
