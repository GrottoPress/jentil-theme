<?php

/**
 * Background
 *
 * @package Jentil\Theme\Setups
 */

declare (strict_types = 1);

namespace Jentil\Theme\Setups;

use GrottoPress\Jentil\Setups\AbstractSetup;

/**
 * Background
 */
final class Background extends AbstractSetup
{
    /**
     * Run setup
     */
    public function run()
    {
        \add_action('after_setup_theme', [$this, 'addSupport']);
    }

    /**
     * Add theme support
     *
     * @action after_setup_theme
     */
    public function addSupport()
    {
        \add_theme_support('custom-background', [
            'default-color' => '#f1f1f1',
        ]);
    }
}
