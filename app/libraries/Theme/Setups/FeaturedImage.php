<?php
declare (strict_types = 1);

namespace My\Theme\Setups;

use GrottoPress\Jentil\Setups\AbstractSetup;

/*
|-----------------------------------------------------------------
| Featured Image Setup
|-----------------------------------------------------------------
|
| @see GrottoPress\Jentil\Setups\FeaturedImage
|
*/

final class Thumbnail extends AbstractSetup
{
    public function run()
    {
        // \add_action('after_setup_theme', [$this, 'unsetSize']);
        \add_action('after_setup_theme', [$this, 'setSize']);
    }

    /**
     * @action after_setup_theme
     */
    public function unsetSize()
    {
        \remove_action(
            'after_setup_theme',
            [$this->app->parent->setups['FeaturedImage'], 'setSize']
        );
    }

    /**
     * @action after_setup_theme
     */
    public function setSize()
    {
        \set_post_thumbnail_size(700, 350, true);
    }
}
