<?php
declare (strict_types = 1);

namespace My\Theme\Setups;

use GrottoPress\Jentil\Setups\Customizer\AbstractCustomizer;
use WP_Customize_Manager as WPCustomizer;

/*
|---------------------------------------------------------------------
| Customizer Setup
|---------------------------------------------------------------------
|
| This is where you add your own setting, sections, panels to the
| theme customizer.
|
| Jentil provides a handy API for setting these up. It comes with
| `AbstractCustomizer`, `AbstractPanel`, `AbstractSection`,
| `AbstractSetting` which your own classes can inherit.
|
| @see GrottoPress\Jentil\Setups\Customizer for how
| Jentil's own customizer is set up.
|
*/

final class Customizer extends AbstractCustomizer
{
    public function run()
    {
        \add_action('customize_register', [$this, 'register']);
        // \add_action('customize_register', [$this, 'removeItems'], 20);
        \add_action('customize_register', [$this, 'hideItems'], 20);
    }

    /**
     * @action customize_register
     */
    public function removeItems(WPCustomizer $wp_customizer)
    {
        $this->app->parent->setups['Customizer']
            ->panels['Posts']->sections['Sticky_post']
            ->remove($wp_customizer);

        $this->app->parent->setups['Customizer']
            ->sections['Title']->controls['PostType_post']
            ->remove($wp_customizer);

        $this->app->parent->setups['Customizer']
            ->sections['Title']->settings['PostType_post']
            ->remove($wp_customizer);

        $this->app->parent->setups['Customizer']
            ->sections['Footer']/*->settings['colophon']*/
            ->remove($wp_customizer);
    }

    /**
     * @action customize_register
     */
    public function hideItems(WPCustomizer $wp_customizer)
    {
        $parent = $this->app->parent;

        $single_page_active_cb = $parent->setups['Customizer']
            ->panels['Posts']
            ->sections['Singular_page']
            ->get($wp_customizer)
            ->active_callback;

        $related_page_active_cb = $parent->setups['Customizer']
            ->panels['Posts']
            ->sections['Related_page']
            ->get($wp_customizer)
            ->active_callback;

        $parent->setups['Customizer']
            ->panels['Posts']
            ->sections['Singular_page']
            ->get($wp_customizer)
            ->active_callback =
                function () use ($single_page_active_cb, $parent): bool {
                    if ('page' === \get_option('show_on_front')) {
                        return $parent->utilities->page->is('page') &&
                            !$parent->utilities->page->is('front_page');
                    }

                    return (bool)$single_page_active_cb();
                };

        $parent->setups['Customizer']
            ->panels['Posts']
            ->sections['Related_page']
            ->get($wp_customizer)
            ->active_callback =
                function () use ($related_page_active_cb, $parent): bool {
                    if ('page' === \get_option('show_on_front')) {
                        return $parent->utilities->page->is('page') &&
                            !$parent->utilities->page->is('front_page');
                    }

                    return (bool)$related_page_active_cb();
                };
    }

    /**
     * @action customize_register
     */
    public function register(WPCustomizer $wp_customizer)
    {
        $this->panels['SamplePanel'] = new Customizer\SamplePanel($this);

        $this->sections['AwesomePosts'] = new Customizer\AwesomePosts($this);

        $this->settings['Footer\Settings\Logo'] =
            new Customizer\Footer\Settings\Logo($this);
        $this->controls['Footer\Controls\Logo'] =
            new Customizer\Footer\Controls\Logo($this);

        parent::register($wp_customizer);
    }
}
