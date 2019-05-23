---
title: Announcing Logrange v0.1.0 
author: Dmitry Spasibenko 
---


### Introducing Logrange v0.1.0
We are excited to announce our first official release of [Logrange](https://www.github.com/logrange/logrange). This release introduces the Logrange database along with tools for collecting, aggregating and forwarding application logs.

### What is Logrange?
[Logrange](https://github.com/logrange/logrange) is an open-source streaming database for aggregating application logs, metrics, audit logs and other machine-generated data from an unlimited number of sources.

Logrange is built around the following ideas:
- Every piece of data is valuable
- Writing data is cheap no matter the amount
- One place to store all the data(logs, metrics, audit, etc.)
- Persisting first, processing later

### What's in this release
The release contains the following components:
- _logrange database_ is a backend component which provides API to serve client's read, write data requests.
- _log collector_ allows to collect data from log-files on a host-machine(s) and send it to Logrange database. 
- _log shell_ is Logrange's CLI tool, which allows to make requests to the database using  [LQL](link) (Logrange Query Language)
- _log forwarder_ allows to send data from Logrange database into a 3rd party system using _Rsyslog_ protocol

Logrange is available in the following configurations:
- _Standalone_. In this configuration all components are run manually or using init scripts. Try [quick start](https://github.com/logrange/logrange#quick-start) to see how it works.
- _Kubernetes_. Logrange can be deployed as a log-aggregation system into a Kubernetes cluster. You can find how to run Logrange in Kubernetes [here](https://github.com/logrange/k8s).

Logrange binaries are available for Linux and MacOs platforms on our [Download](link) page. You can run Logrange components either in a cloud or on-premises using hosted, virtualized,r containerized solutions or a mix of them.

Of course, you can build it from [source](https://github.com/logrange/logrange)

### Gravitational starts to use Logrange for Gravity!
[Gravitational Inc.](https://gravitational.com/) announced it is shipping Logrange for serving cluster logs in their flagship product [Gravity](https://gravitational.com/gravity/)! Logrange's components are deployed into the Gravity cluster for aggregating the application logs and providing an interface for working with them. There are 2 main use-cases Logrange addresses for Gravity:
1. Aggergating logs from the applications, that run in the Gravity cluster. Providing an interface for search and downloading collected logs.
2. Forwarding aggregated logs to a 3rd party system using [Rsyslog](https://en.wikipedia.org/wiki/Rsyslog) protocol.

Here is what Sasha Klizhentas (CTO of Gravitational Inc.) says about it:

> [Gravity](https://gravitational.com/gravity) uses Logrange to collect and aggregate log data in the most restricted environments and provides
> our customers with ability to search, retain and forward logs to external log storage without compromising on security or storage.

### The future
Logrange is under active development. Our plan is to continue working on the following items:
- To support HA (High Availability)
- To work on integrations with data visualizations tools
- To work on integrations with 3rd party data storages
- To meet high-end security standards
- To work on deep-learning and data-analytics tools like "Anomalies Prediction", "hidden correlations" etc.

### Contact us
- Should you have problems with building a machine-generated data aggregation infrastructure? 
- Do you consider to use your system logs for security and analytics? 
- May you have any question or suggestion regarding the project? 

Feel free to send us a message either via [web site form](https://www.logrange.io#contact-us) or shoot us an e-mail to mail@logrange.io 
