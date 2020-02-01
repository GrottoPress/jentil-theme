/// <reference path='./module.d.ts' />

export abstract class Base
{
    constructor(
        protected readonly _j: JQueryStatic,
        protected readonly _wp: WP,
        protected readonly _mod_ids: string[],
    ) {
    }

    run(): void
    {
        this.update()
    }

    abstract update(): void
}
