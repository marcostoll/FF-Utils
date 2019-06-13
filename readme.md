FF\Utils | Fast Forward Components Collection
===============================================================================

by Marco Stoll

- <marco.stoll@rocketmail.com>
- <http://marcostoll.de>
- <https://github.com/marcostoll>
- <https://github.com/marcostoll/FF-Utils>
------------------------------------------------------------------------------------------------------------------------

# What is the Fast Forward Components Collection?
The Fast Forward Components Collection, in short **Fast Forward** or **FF**, is a loosely coupled collection of code 
repositories each addressing common problems while building web application. Multiple **FF** components may be used 
together if desired. And some more complex **FF** components depend on other rather basic **FF** components.

**FF** is not a framework in and of itself and therefore should not be called so. 
But you may orchestrate multiple **FF** components to build an web application skeleton that provides the most common 
tasks.

# Introduction

The Utils component provides generic functionality used by many other **FF** components. You seldom want to require
this library by itself. In most cases you will get it by requiring one of the more complex **FF** components.

# The Utils

The Utils classes each provide a bunch of static methods to deal with the namesake data or object type. The classes
only contain methods used by other **FF** components relying on the **Utils** component.

# Road map

The extend of the **Utils** component is solely defined by the needs of other **FF** components, so not concrete 
features are planned at this time. The component surely will grow as other **FF** components require additional logic 
that is not part of their domain.