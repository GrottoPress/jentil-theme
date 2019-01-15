/// <reference path='./global.d.ts' />

namespace MyTheme
{
    export class Customizer
    {
        public constructor(
            private readonly _j: JQueryStatic,
            private readonly _wp: WP,
            private readonly _awesomePostsHdModId: string,
        ) {
        }

        public run(): void
        {
            this.updateAwesomePostsHeading()
            // this.updateBackgroundColor()
            // this.updateBackgroundImage()
        }

        private updateAwesomePostsHeading(): void
        {
            this._wp.customize(
                this._awesomePostsHdModId,
                (from: () => void): void => {
                    from.bind((to: string): void => {
                        this._j('#awesome-posts .heading').html(to)
                    })
                }
            )
        }

        private updateBackgroundColor(): void
        {
            this._wp.customize('background_color', (from: () => void): void => {
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

        private updateBackgroundImage(): void
        {
            this._wp.customize('background_image', (from: () => void): void => {
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
}

new MyTheme.Customizer(
    jQuery,
    wp,
    myThemeAwesomePostsHeadingModId
).run()
