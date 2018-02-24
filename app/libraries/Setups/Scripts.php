<?php

/**
 * Scripts (JavaScript)
 *
 * @package Jentil\Theme\Setups
 *
 * @see GrottoPress\Jentil\Setups\Scripts
 */

declare (strict_types = 1);

namespace Jentil\Theme\Setups;

use GrottoPress\Jentil\Setups\AbstractSetup;

/**
 * Scripts (JavaScript)
 */
final class Scripts extends AbstractSetup
{
    /**
     * Run setup
     */
    public function run()
    {
        \add_action('wp_enqueue_scripts', [$this, 'enqueue']);
    }

    /**
     * Enqueue Styles
     *
     * @action wp_footer
     */
    public function enqueue()
    {
        \wp_enqueue_script(
            'jentil-theme',
            \get_template_directory_uri().'/dist/scripts/theme.min.js',
            ['jquery'],
            '',
            true
        );
    }
}
