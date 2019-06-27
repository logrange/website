# Linker: small library for controlling big projects components
_June 27 2019 by Dmitry Spasibenko_

[Linker](https://github.com/logrange/linker) is a Golang library which helps to build clean code in big projects. Linker reduces the code complexity in projects with many packages, multi-level modules hierarchy, and complicated dependencies. The library encourages to use design principles like [Dependency Injection](https://en.wikipedia.org/wiki/Dependency_injection) and [Inversion of Control](https://en.wikipedia.org/wiki/Inversion_of_control) for building well-formed project architecture.

Linker is a part of [Logrange](https://logrange.io) project, and the Logrange database uses it as the main component for controlling the application life-cycle. Nevertheless Linker can be used as a framework for any other project, because it offers design principles, but not a project specific functionalities.

Linker provides:
- components registry
- dependency injection
- circular dependency detection
- post-construction (injection) initialization
- automatic prioritization for components initialization
- automatic prioritization for components shutdown

Let's take a look, what Linker offers in details.

## Components registry
Linker works with components. A component of an application could be any object with basic type or a structure. All components, Linker works with, should be registered in it. Linker doesn't create new components, but use already created ones. So all registered components must be created before the registration. 

The main Linker component is [Injector](https://github.com/logrange/linker/blob/5dbea0d87b81a70e721f6c359d5f28dc1a01e080/inject.go#L59). The following example shows how the injector is created and some application components could be registered in it:
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
In the example 3 components are registered in the injector `inj`, which is created by the `linker.New()` call. One of the 3 components is registered anonymously, the component with `*BigDataService` type is registered with empty name. Also, components could have a different type, the component with "mySqlConns" name has type `int`, another two are pointers to the objects with structure types.

A component name should be unique, if it is not empty. Multiple components with different types could be registered anonymously (empty name). No 2 or more components of the same type could be registered anonymously. 

The restrictions above are needed for proper Dependency Injection process and avoid any ambiguity.

## Dependency Injection 
In Linker [Dependency Injection](https://en.wikipedia.org/wiki/Dependency_injection) is a process of assigning fields of a registered components by values of other registered compoents. For understanding, which fields of components should be injected, Linker expects the fields be annotated special way. Also, The fields should have public visibility. For example:

```golang
// MySQLAccessService implements DatabaseAccessService
type MySQLAccessService struct {
	// Conns uses field's tag to specify injection param name(mySqlConns)
	// or sets-up the default value(32), if the param with "mySqlConns" name is not provided 
    Conns int `inject:"mySqlConns, optional:32"`
}

type BigDataService struct {
	// DBa has DatabaseAccessService type which value will be injected.
	// Injection will fail if there is no appropriate component with "dba" name
	// was registered...
    DBa DatabaseAccessService `inject:"dba"`
}
```
The injection process is started by calling `Init()` function of the injector object. The property injection process continues until all registered components are injected or an error is happened.

Linker detects circular dependencies, the situation when a component has a dependency on another one, but the second one has a dependency from the first one. The circular dependency can be detected with more than 2 components involvement. For example Component `A` depends on component `B`, `B` depends on `C` and the component `C` depends on `A` again. Linker doesn't accept circular dependencies and it requires to resolve the situation through the components refactoring.

Also, Linker can inject components via interface and the process could fail in case of an ambiguity is detected. For example, let's say a field has an interface type `I` and the annotation is anonymous. This case Linker will select between the registered components, which implement the interface. If more than one is found, Linker will issue an error, cause an ambiguity happens. etc.

If Linker would be able to resolve dependencies in the all registered components sucessfully, it will switch to "Post Construction" phase.

## Post Construction
The “Post Construction” is a procedure by notifying some of registered components when all components dependencies have been resolved successfully. The procedure is executed in context of `Init()` call in the injector. During the procedure injector will call function `PostConstruct()` of all components that implement [PostConstructor](https://github.com/logrange/linker/blob/5dbea0d87b81a70e721f6c359d5f28dc1a01e080/inject.go#L74) interface. The order of calling `PostConstruct()` function for registered components is not defined. Linker guarantees that they will be called after dependency injection, but before the components initialization phase.

## Components initialization
The "Components Initialization" follows by "Post Construction" phase. Linker orders all registered components the way, that components with a dependency of another ones will be initialized after their dependencies. For example if a component `A` depends on `B`, but `B` depends on component `C`, then the initialization order will be `C`, `B`, `A`. 

Component initialization supposes calling function `Init()` for all components that implement [Initializer](https://github.com/logrange/linker/blob/5dbea0d87b81a70e721f6c359d5f28dc1a01e080/inject.go#L90) interface. If the function returns an error the initialization process is rolled back. The rollback supposes calling `Shutdown()` function for all components which were initialized successfully (`Init()` returns `nil`)

Initialization is executed in one go-routine, so order of `Init()` calls is guaranteed. Also Linker automatically prioritizes components initialization, so it guarantees that component will not be initialized before its dependencies.

When all components are initialized, the `Init()` function of the Linker injector is over. If any error happens inside of the injector `Init()` call, it will be handled properly and a `panic` will take place. Linker panicking because any error within the initialization is considered like the program design issues, rather than a real-time error. So it is considered fatal and the following program execution doesn't make any sense.

## Shutting the components down
The `Injector` struct provides `Shutdown()` function to de-initialize all component that were initialized before. De-initialization happens in back-initialization order e.g. component that were initialized last will be de-initialized first. During this phase all components that implement [Shutdowner](https://github.com/logrange/linker/blob/5dbea0d87b81a70e721f6c359d5f28dc1a01e080/inject.go#L108) interface, will be invoked. 

Linker guarantees that all initialized components will be de-initialies (`Shutdown()` will be called) even any error or a panic happens in one of the call-backs. 

## Putting all things together
In general, process of using Linker injector is quite straight forward process:

```golang
func main() {
    // 1st step is to create the injector
    inj := linker.New()
	
    // 2nd step is to register components
    inj.Register(
		linker.Component{Name: "dba", Value: &MySQLAccessService{}},
		linker.Component{Name: "", Value: &BigDataService{}},
		linker.Component{Name: "mySqlConns", Value: int(msconns)},
		...
	)
	
	// 3rd step is to inject dependecies and initialize the registered components
	inj.Init(ctx)
	
	// the injector fails-fast, so if no panic everything is good so far.
	
	...
	// 4th de-initialize all compoments properly
	inj.Shutdown()
}
```
The real code example could be found [here](https://github.com/logrange/logrange/blob/be1cc8dc0ae8fa9154eec91bea33cd2105509e11/server/server.go#L53)

## Conclusion
Linker is very simple, but powerful IoC and DI library with straight-forward components life-cycle control. Linker is a part of [Logrange](https://logrange.io) project. If you want to learn more how Linker is used take a look at [Logrnage code on github](https://github.com/logrange/logrange). 

Should you have any comments or suggestions, please do not hesitate to [contact us](https://www.logrange.io/#contact-us) or send us an email (mail@logrange.io).

Stay tuned!
