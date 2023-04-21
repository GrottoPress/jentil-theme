/// <reference path='./core/module.d.ts' />

/*
|-----------------------------------------------------------------------
| About Typescript
|-----------------------------------------------------------------------
|
| Typescript is a statically-typed language developed by Microsoft,
| as a superset of JavaScript. This means you can go ahead and paste
| regular JS code here, and they should work OK.
|
| Typescript adds classical object oriented features on top of JS, eg:
| classes, abstract classes, interfaces and the like.
|
| It compiles to plain JavaScript. You could write your code using the
| latest JS features (think ES6), and it should compile down to a more
| compatible version of JS.
|
| Try it; you will love it!
|
| Read more: https://www.typescriptlang.org
|
*/

/*
|----------------------------------------------------------------------
| Build and watch
|----------------------------------------------------------------------
|
| Build assets with:
|   `npm run build`
|
| Watch assets to automatically build whenever you make changes with:
|   `npm run watch`
|
*/

import { Base } from './core/base'
import { SomeClass } from './core/some-module'
import { AnotherClass } from './core/another-module'

const cores = [new SomeClass(jQuery), new AnotherClass(jQuery)]

jQuery.each(cores, (_, core: Base): void => core.run())
