/// <reference path='./module.d.ts' />

import { Base } from './base'

export class BackgroundColor extends Base
{
    constructor(j: JQueryStatic, wp: WP)
    {
        super(j, wp, ['background_color'])
    }

    protected update(): void
    {
        this._wp.customize(this._mod_ids[0], (from: () => void): void => {
            from.bind((to: string): void => {
                if (-1 === ['#fff', '#ffffff'].indexOf(to)) {
                    this._j('body').removeClass('no-background-color')
                        .addClass('has-background-color')
                } else {
                    this._j('body').removeClass('has-background-color')
                        .addClass('no-background-color')
                }
            })
        })
    }
}
