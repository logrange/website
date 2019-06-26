# Linker: small library for big projects
[Linker](https://github.com/logrange/linker) is a Golang library which allows to build clean code in big projects. Linker reduces the code complexity in big projects with many packages, multi-level modules hierarchy, with complicated dependencies. The library encourages to use design principles like [Dependency Injection]() and [Inversion of Control]() for building well-formed project architecture.

Linker is a part of [Logrange](https://logrange.io) project, and the Logrange database uses it as the main component for controlling the application life-cycle. Nevertheless Linker can be used as a framework for any other project, cause it offers design principles, but not a project specific functionalities.

Linker provides:
- components registry
- dependency injection
- circular dependency detection
- post-construction (injection) initialization
- automatic prioritization for components initialization
- automatic prioritization for components shutdown

Let's take a look, what Linker offers in details.

## A component registry
Linker works with components. A component of an application could be any object with simple type or a structure. All components, Linker works with, should be registered in it. Linker doesn't create new components, but use already created ones. So all registered components must be created before the registration. 

The main Linker component is `Injector` struct. The following example shows how some application components could be registered in the `Injector`:
```golang
import (
     "github.com/logrange/linker"
)
...
func main() {
    // 1st step is to create the injector
    inj := linker.New()
	
    // 2nd step is to register components
    inj.Register(
		linker.Component{Name: "dba", Value: &MySQLAccessService{}},
		linker.Component{Name: "", Value: &BigDataService{}},
		linker.Component{Name: "mySqlConns", Value: int(23)},
		...
	)
...
}
```
In the example 3 components are registered in the injector `inj`, which is created by the `linker.New()` call. One of the 3 components is registered anonymously, the component with `*BigDataService` is registered with empty name. Also, components could have a different types, the component with name "mySqlConns" has type `int`, another two looks like pointers to objects with structure types.

## Dependency Injection 


