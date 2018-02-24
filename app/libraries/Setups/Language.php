<?php

/**
 * Language
 *
 * @package Jentil\Theme\Setups
 *
 * @see GrottoPress\Jentil\Setups\Language
 */

declare (strict_types = 1);

namespace Jentil\Theme\Setups;

use GrottoPress\Jentil\Setups\AbstractSetup;

/**
 * Language
 */
final class Language extends AbstractSetup
{
    /**
     * Run setup
     */
    public function run()
    {
        \add_action('after_setup_theme', [$this, 'loadTextDomain' ]);
    }

    /**
     * Load text domain.
     *
     * @action after_setup_theme
     */
    public function loadTextDomain()
    {
        \load_theme_textdomain(
            'jentil-theme',
            \get_template_directory().'/languages'
        );
    }
}
