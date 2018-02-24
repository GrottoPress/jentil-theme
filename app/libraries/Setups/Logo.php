<?php

/**
 * Custom Logo
 *
 * @package Jentil\Theme\Setups
 *
 * @see GrottoPress\Jentil\Setups\Logo
 */

declare (strict_types = 1);

namespace Jentil\Theme\Setups;

use GrottoPress\Jentil\Setups\AbstractSetup;

/**
 * Custom Logo
 */
final class Logo extends AbstractSetup
{
    /**
     * Run setup
     */
    public function run()
    {
        \add_action('after_setup_theme', [$this, 'addSupport']);
    }

    /**
     * Add theme support.
     *
     * @action after_setup_theme
     */
    public function addSupport()
    {
        \add_theme_support('custom-logo', [
            'height' => 30,
            'width' => 160,
            'flex-width' => false,
            'flex-height' => false,
        ]);
    }
}
