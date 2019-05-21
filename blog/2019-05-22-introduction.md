---
title: Announcing Logrange v0.1.0 
author: Dmitry Spasibenko
---
![](https://raw.githubusercontent.com/logrange/website/master/blog/assets/Logrange-Logo-S.png)

### What is Logrange?
[Logrange](https://github.com/logrange/logrange) is an open-source streaming database intended for aggregating application logs, metrics, audit logs and other streaming data from thousands of sources. Logrange allows to persist the information in real-time for further processing later.

Logrange is built around the idea that every piece of data is essential. Streaming data such as application logs could be used for different type of analysis, so it should be stored in a full amount.

Logrange allows to store any machine-generated data, not applications logs only. Streaming data like system metrics, application logs, audit and business metrics can be placed into one database. So the different types of the data can be analyzed in complex. In addition to streaming data processing features, this allows to build deep learning analytical tools like Anomalies Prediction and hidden problems alerting.

Logrange is the game changer in distributed systems analytics. Why? Let's try to look into some details.
 
### Distributed System health and its analysis
Modern distributed information systems consist of hundreds or even thousands of components (applications). Every such application has its own logic and behavioral specific which contributes into the whole system state. A distributed system behaviour is more complex than the behavior of any of the components it consists from.

Each of such components generates some information in form of application logs. Also there are some metrics can be monitored and recorded in real-time. 

The **streaming data** is generated continuously by thousands of data sources, which typically sent in the data records simultaneously, and in small sizes. Despite of the fact that the records are small, due to the number of records the streaming data has very significant volume, which could be counted in hundred of megabytes per second(!)

There are 2 key steps, that should be done to to understand a distributed system health or behavior:
1. Collecting and store the machine-generated data from the system components. So it could be analyzed later either by humans or automatic tools.
2. To analyze the collected data for a problem investigation or for building an understanding about the distributed system health.

Practically this steps turn into the Data Aggregation and the Data Analysis problems.

### Data aggregation problem.
Data aggregation is a challenge due to the amount of the machine-generated data.

Most of log aggregating solutions offer powerful tools like full-text search, which requires data preprocessing (indexing). Data indexing is resource-costly process, so to make the tool be able to work at all, it is asked to reduce amount of the logs to be stored. The full-text search may be not needed at all, but the logs were cut for indexing. Yeah, it doesn’t seem very reasonable...

> So, the common practice is to filter the information, which seems to be “unnecessary”  for further analysis. 

This could make sense if the system is determined and methods of its analysis are known and clear. Unfortunately it is not true, the reality is different, so we are not absolutely sure whether the dropped information is unessential.

Logrange intends to solve the problem by trying not to ignore anything prematurely.

### Data analysis problem.
On the market, there are plenty of tools that work with specific type of the streaming data. Some log aggregation solutions focus on colleting, indexing, persisting application logs providing such useful features like search. Another tools are focused on working with system metrics, which collect, persisting and handling the resources consumption metrics. Alerting on hiting some parameters threshold are very useful features.

All of this tools are focused on "full-stack" functionality which includes data collection, pre-processing, persisting and features providing end user useful functionality. 

The problem with such kind of tools is that they work with some specific verticals and they often don't have an idea about other type of machine-generated data rather than they work with. Such kind of approach for working with the machine-generated data complicates the comprehansive system analysis, due to the integration problem between diffent databases.

### What does Logrange offer?
Logrange offers a method by working with big amount of streaming data. Logrange doesn't try to reduce the amount of data to be persisted, it tries to reduce the amount of data which should be processed in a specific way. 

#### Persisting everything
Instead of trying to persist only "essential" (we actually never know) data, Logrange offers to persist all the data. Logrange doesn't try to pre-process data, but just saves it. Having all the data persisted, different types of processing for different data subsets can be applied. This allows to apply countless methods of data analysis, building different models and gradually approach to understanding the system behavior. The cost of saving is cheap, so if data is really not needed it could be removed.

#### Working with the data subsets.
Logrange allows to store different type of streaming data in one database what gives an advantage by structuring it and building various correlations and data analysis on top of the database. For example, Logrange can keep system metrics, application and business logs or any other metrics in it's database. Different types of analysis can be applied. It doesn't make sense to build full-text search index on top of system metrics. But aggregation functions quite make sense.

### Conclusion
Logrange strives to achieve the following goals:
- Persisting streaming data should be cheap. All data is important, so it should be persisted to for later processing.
- To provide an API for uniform access to the data from thousands of different sources. All data is in one database.
- To provide tools for the aggregated data further learning and analysis to build an advanced features like AI for the distributed system health.
- Logrange is open-source and secure, to meet high quality standards for transferring, saving and processing data.
- Could be run everywhere either in Cloud or On-Premise configurations.
- Easy to run and configure.

Lograng is data-centric. The key component of analytical systems is data and the ability to run analytical tools against it. Everything should be stored first and only after that different data analysis on the stored data sets can be applied - building full-text search indexes, aggregation, correlation, deep-learining and other type of data analysis. To remove unnecessary data at least.
