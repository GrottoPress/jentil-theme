/// <reference path='./global.d.ts' />

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
| Try it; you would love it!
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

namespace MyTheme
{
    export class App
    {
        public constructor(private readonly _j: JQueryStatic)
        {
        }

        public run(): void
        {
            // this.doSomething()
        }

        private doSomething(): void
        {
            this._j('body').slideDown()
        }
    }
}

new MyTheme.App(jQuery).run()
