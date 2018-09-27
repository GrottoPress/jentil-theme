/// <reference path='./global.d.ts' />

((_wp: WP, $: JQueryStatic): void => {
    'use strict'

    const { customize } = _wp

    customize(myThemeAwesomePostsHeadingModId, (from: () => void): void => {
        from.bind((to: string): void => {
            $('#awesome-posts .heading').html(to)
        })
    })

    /**
     * You may need these, if your theme adds 'custom-background'
     * support.
     *
     * Corresponds to PHP method: `Setups\Background::addBodyClasses()`
     */

    // customize('background_color', (from: () => void): void => {
    //     from.bind((to: string): void => {
    //         if (-1 === ['#fff', '#ffffff'].indexOf(to)) {
    //             $('body').removeClass('no-background-color').addClass('has-background-color')
    //         } else {
    //             $('body').removeClass('has-background-color').addClass('no-background-color')
    //         }
    //     })
    // })

    // customize('background_image', (from: () => void): void => {
    //     from.bind((to: string): void => {
    //         if (to) {
    //             $('body').removeClass('no-background-image').addClass('has-background-image')
    //         } else {
    //             $('body').removeClass('has-background-image').addClass('no-background-image')
    //         }
    //     })
    // })
})(wp, jQuery)
