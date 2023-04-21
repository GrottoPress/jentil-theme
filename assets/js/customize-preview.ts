/// <reference path='./customize-preview/module.d.ts' />

import { Base } from './customize-preview/base'
import { AwesomePostsHeading } from './customize-preview/awesome-posts-heading'
import { BackgroundColor } from './customize-preview/background-color'
import { BackgroundImage } from './customize-preview/background-image'

const previews = [
    new AwesomePostsHeading(jQuery, wp, myThemeAwesomePostsHeadingModId),
    // new BackgroundColor(jQuery, wp),
    // new BackgroundImage(jQuery, wp),
]

jQuery.each(previews, (_, preview: Base): void => preview.run())
