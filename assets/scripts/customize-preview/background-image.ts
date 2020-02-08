/// <reference path='./module.d.ts' />

import { Base } from './base'

export class BackgroundImage extends Base
{
    constructor(
        j: JQueryStatic,
        wp: WP
    ) {
        super(j, wp, ['background_image'])
    }

    update(): void
    {
        this._wp.customize(this._mod_ids[0], (from: () => void): void => {
            from.bind((to: string): void => {
                if (to) {
                    this._j('body').removeClass('no-background-image')
                        .addClass('has-background-image')
                } else {
                    this._j('body').removeClass('has-background-image')
                        .addClass('no-background-image')
                }
            })
        })
    }
}
