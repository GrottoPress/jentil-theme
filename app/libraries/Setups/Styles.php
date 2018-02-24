<?php

/**
 * Stylesheets
 *
 * @package Jentil\Theme\Setups
 *
 * @see GrottoPress\Jentil\Setups\Styles
 */

declare (strict_types = 1);

namespace Jentil\Theme\Setups;

use GrottoPress\Jentil\Setups\AbstractSetup;

/**
 * Stylesheets
 */
final class Styles extends AbstractSetup
{
    /**
     * Run setup
     */
    public function run()
    {
        \add_action('wp_enqueue_scripts', [$this, 'enqueue'], 20);
    }

    /**
     * Enqueue Styles
     *
     * @action wp_enqueue_scripts
     */
    public function enqueue()
    {
        if (\is_rtl()) {
            $style = 'theme-rtl.min.css';
        } else {
            $style = 'theme.min.css';
        }

        \wp_enqueue_style(
            'jentil-theme',
            \get_template_directory_uri()."/dist/styles/${style}",
            ['jentil']
        );
    }
}
