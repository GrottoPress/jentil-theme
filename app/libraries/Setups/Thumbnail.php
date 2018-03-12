<?php
declare (strict_types = 1);

namespace Jentil\Theme\Setups;

use GrottoPress\Jentil\Setups\AbstractSetup;

/*
|-----------------------------------------------------------------
| Thumbnails Setup
|-----------------------------------------------------------------
|
| Set post thumbnail (featured image) size here, and add new
| thumbnail sizes for your theme.
|
| You may remove sizes added by Jentil that you do not need here.
|
| @see GrottoPress\Jentil\Setups\Thumbnail
|
*/

final class Thumbnail extends AbstractSetup
{
    public function run()
    {
        // \add_action('init', [$this, 'removeSizes']);
        // \add_action('after_setup_theme', [$this, 'setSize']);
        \add_action('after_setup_theme', [$this, 'addSizes']);
    }

    /**
     * @action init
     */
    public function removeSizes()
    {
        \remove_action(
            'after_setup_theme',
            [$this->app->parent->setups['Thumbnail'], 'setSize']
        );
    }

    /**
     * @action after_setup_theme
     */
    public function setSize()
    {
        \set_post_thumbnail_size(700, 350, true);
    }

    /**
     * @action after_setup_theme
     */
    public function addSizes()
    {
        \add_image_size('large-thumb', 240, 200, true);
        \add_image_size('medium-thumb', 200, 150, true);
        \add_image_size('small-thumb', 150, 150, true);
    }
}
