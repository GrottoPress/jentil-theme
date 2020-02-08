/// <reference path='./module.d.ts' />

import { Base } from './base'

export class AwesomePostsHeading extends Base
{
    constructor(
        j: JQueryStatic,
        wp: WP,
        mod_id: string
    ) {
        super(j, wp, [mod_id])
    }

    update(): void
    {
        this._wp.customize(this._mod_ids[0], (from: () => void): void => {
            from.bind((to: string): void => {
                this._j('#awesome-posts .heading').html(to)
            })
        })
    }
}
