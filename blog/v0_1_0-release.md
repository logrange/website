## Introducing Logrange v0.1.0
We are excited to announce our first official release of [Logrange](https://www.github.com/logrange/logrange). This release introduces the Logrange database along with tools for collecting, aggregating and forwarding application logs.

### What is Logrange?
[Logrange](https://github.com/logrange/logrange) is an open-source streaming database for aggregating application logs, metrics, audit logs and other machine-generated data from an unlimited number of sources.

Logrange is built upon the following principles:
- Every piece of data has its value
- Writing data is inexpensive, regardless of volume It’s convenient to have
- One place for storing data(logs, metrics, audit, etc.)
- Store first, process later

### What's in this release
The release contains the following components:
- _logrange database_ is a backend component which provides an API to serve client's read, write data requests.
- _log collector_ allows the collecting of data from log files on a host-machine(s) and transfer to the Logrange database. 
- _log shell_ is a Logrange CLI tool, that allows clients to make requests to the database using  [LQL](link) (Logrange Query Language)
- _log forwarder_ allows clients to send data from the Logrange database to a 3rd party system using the _Rsyslog_ protocol

Logrange is available in the following configurations:
- _Standalone_. In this configuration all components are run manually or using init scripts. Try [quick start](https://github.com/logrange/logrange#quick-start) to see how it works.
- _Kubernetes_. Logrange can be deployed as a log-aggregation system into a Kubernetes cluster. Learn how to run Logrange in Kubernetes [here](https://github.com/logrange/k8s).

Logrange binaries are available for Linux and MacOs platforms on our [Download](link) page. You can run Logrange components either in a cloud or on-premises using hosted, virtualized, containerized solutions or a mix of them.

Of course, you can build it from [source](https://github.com/logrange/logrange)

### Gravitational starts to use Logrange for Gravity!
[Gravitational Inc.](https://gravitational.com/) announced it is shipping Logrange for serving cluster logs in their flagship product [Gravity](https://gravitational.com/gravity/)! Logrange's components are deployed into the Gravity cluster for aggregating the application logs and providing an interface for working with them. There are 2 main use-cases Logrange addresses for Gravity:
1. Aggergating logs from the applications, that run in the Gravity cluster. Providing an interface for search and downloading collected logs.
2. Forwarding aggregated logs to a 3rd party system using [Rsyslog](https://en.wikipedia.org/wiki/Rsyslog) protocol.

Here is what Sasha Klizhentas (CTO of Gravitational Inc.) says about it:

> [Gravity](https://gravitational.com/gravity) uses Logrange to collect and aggregate log data in the most restricted environments and provides
> our customers with ability to search, retain and forward logs to external log storage without compromising on security or storage.

### The future
Logrange is under active development. Our plan is to continue working on adding the following items:
- High availability across our systems
- Integration with data visualizations tools
- Integration with 3rd party data storages
- High security standards
- Deep learning and data analytics tools like "Anomalies Prediction", "hidden correlations" etc.

### Contact us if ...
- ...you’re having difficulty building machine-generated data aggregation infrastructure.
- ...you’re thinking of using your system logs for security and analytics.
- ...if you have any questions or suggestions regarding Logrange.

Feel free to send us a message through our [web site form](https://www.logrange.io#contact-us) or just e-mail us at mail@logrange.io 
