/// <reference path='./module.d.ts' />

import { Base } from './base'

export class AnotherClass extends Base
{
    run(): void
    {
        // this.doAnotherThing()
    }

    private doAnotherThing(): void
    {
        this._j('body').html('Doing another thing')
    }
}
