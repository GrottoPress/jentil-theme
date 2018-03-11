<?php
declare (strict_types = 1);

namespace Jentil\Theme\Setups\Customizer;

use GrottoPress\Jentil\Setups\Customizer\AbstractCustomizer;
use WP_Customize_Manager as WPCustomizer;

/*
|---------------------------------------------------------------------
| Customizer Setup
|---------------------------------------------------------------------
|
| @see GrottoPress\Jentil\Setups\Customizer\Customizer
|
*/

final class Customizer extends AbstractCustomizer
{
    public function run()
    {
        // \add_action('customize_register', [$this, 'register']);
        \add_action('customize_register', [$this, 'removeComponents'], 12);
        // \add_action('customize_preview_init', [$this, 'enqueueScript']);
    }

    /**
     * @action customize_register
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
     * @action customize_register
     */
    public function register(WPCustomizer $WPCustomizer)
    {
        // $this->panels['SamplePanel\SamplePanel'] =
        //     new SamplePanel\SamplePanel($this);

        // $this->sections['SampleSection\SampleSection'] =
        //     new SampleSection\SampleSection($this);

        parent::register($WPCustomizer);
    }
}
