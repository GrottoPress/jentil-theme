/// <reference path='./module.d.ts' />

import { Base } from './base'

export class SomeClass extends Base {
    run(): void {
        // this.doSomething()
    }

    private doSomething(): void {
        this._j('body').html('Doing something')
    }
}
