<?php

/**
 * Customizer
 *
 * @package Jentil\Theme\Setups\Customizer
 *
 * @see GrottoPress\Jentil\Setups\Customizer\Customizer
 */

declare (strict_types = 1);

namespace Jentil\Theme\Setups\Customizer;

use GrottoPress\Jentil\Setups\Customizer\AbstractCustomizer;
use WP_Customize_Manager as WPCustomizer;

/**
 * Customizer
 */
final class Customizer extends AbstractCustomizer
{
    /**
     * Run setup
     */
    public function run()
    {
        parent::run();

        \add_action('customize_register', [$this, 'removeComponents'], 12);
        // \add_action('customize_preview_init', [$this, 'enqueueScript']);
    }

    /**
     * Remove unneeded components
     */
    public function removeComponents(WPCustomizer $WPCustomizer)
    {
        $this->app->parent->setups['Customizer\Customizer']
            ->panels['Posts\Posts']->sections['Sticky_post']
            ->remove($WPCustomizer);

        $this->app->parent->setups['Customizer\Customizer']
            ->sections['Title\Title']->settings['PostType_post']
            ->remove($WPCustomizer);

        $this->app->parent->setups['Customizer\Customizer']
            ->sections['Colophon\Colophon']/*->settings['colophon']*/
            ->remove($WPCustomizer);
    }

    /**
     * Register theme customizer
     */
    public function register(WPCustomizer $WPCustomizer)
    {
        // $this->panels['SamplePanel\SamplePanel'] =
        //     new SamplePanel\SamplePanel($this);

        // $this->sections['SampleSection\SampleSection'] =
        //     new SampleSection\SampleSection($this);

        parent::register($WPCustomizer);
    }

    /**
     * Enqueue script
     *
     * @action customize_preview_init
     */
    public function enqueueScript()
    {
        \wp_enqueue_script(
            'jentil-theme-customizer',
            \get_template_directory_uri().
                '/dist/scripts/customize-preview.min.js',
            ['jquery', 'customize-preview'],
            '',
            true
        );
    }
}
