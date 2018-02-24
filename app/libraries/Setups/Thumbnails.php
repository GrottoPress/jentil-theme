<?php

/**
 * Thumbnails (Featured Images)
 *
 * @package Jentil\Theme\Setups
 *
 * @see GrottoPress\Jentil\Setups\Thumbnails
 */

declare (strict_types = 1);

namespace Jentil\Theme\Setups;

use GrottoPress\Jentil\Setups\AbstractSetup;

/**
 * Thumbnails (Featured Images)
 */
final class Thumbnails extends AbstractSetup
{
    /**
     * Run setup
     */
    public function run()
    {
        // \add_action('init', [$this, 'removeSizes']);
        // \add_action('after_setup_theme', [$this, 'setSize']);
        \add_action('after_setup_theme', [$this, 'addSizes']);
    }

    /**
     * Remove sizes
     *
     * @action init
     */
    public function removeSizes()
    {
        \remove_action(
            'after_setup_theme',
            [$this->app->parent->setups['Thumbnails'], 'setSize']
        );
    }

    /**
     * Set post thumbnail size
     *
     * @action after_setup_theme
     */
    public function setSize()
    {
        \set_post_thumbnail_size(700, 350, true);
    }

    /**
     * Add/set thumbnail sizes.
     *
     * @action after_setup_theme
     */
    public function addSizes()
    {
        \add_image_size('large-thumb', 240, 200, true);
        \add_image_size('medium-thumb', 200, 150, true);
        \add_image_size('small-thumb', 150, 150, true);
    }
}
