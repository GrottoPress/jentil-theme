/// <reference path='./module.d.ts' />

export abstract class Base {
    constructor(protected readonly _j: JQueryStatic) { }

    abstract run(): void
}
