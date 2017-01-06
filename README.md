Notes
===
* PHP 7.x as the runtime interpreted language
* Composer for dependency management of:
    * rollbar (hosted error tracking software)
        * Exceptions thrown (of any type) will report the error to rollbar, which is an online error tracking platform.
    * phpunit (@todo)
* Coding style PSR1/2

Demonstration of
===
* Scope
* Abstraction
* Inheritance
* Interfaces
* Late static binding
* Type-hinting
* Return type declarations
* Library/cloud services usage
* Dependency management tooling
* Unit testing (@todo)

To-do
===
* Implement a set of standardized validators. Right now we just have very basic type checks on the setters and no validation on returned JSON. This was written quickly!
* Implement character & movie models with links to each other.
* Write unit tests.