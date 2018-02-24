<?php

/**
 * Tertiary sidebar
 *
 * @package Jentil\Theme\Setups\Sidebars
 *
 * @see GrottoPress\Jentil\Setups\Sidebars\Primary
 */

declare (strict_types = 1);

namespace Jentil\Theme\Setups\Sidebars;

use GrottoPress\Jentil\Setups\AbstractSetup;

/**
 * Tertiary sidebar
 */
final class Tertiary extends AbstractSetup
{
    /**
     * Run setup
     */
    public function run()
    {
        \add_action('widgets_init', [$this, 'register']);
    }

    /**
     * Register widget area
     *
     * @action widgets_init
     */
    public function register()
    {
        \register_sidebar([
            'name'          => \esc_html__('Tertiary', 'jentil-theme'),
            'id'            => 'tertiary-widget-area',
            'description'   => \esc_html__(
                'Tertiary widget area',
                'jentil-theme'
            ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ]);
    }
}
