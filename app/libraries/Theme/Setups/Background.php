<?php
declare (strict_types = 1);

namespace My\Theme\Setups;

use GrottoPress\Jentil\Setups\AbstractSetup;

/*
|-------------------------------------------------------------------------
| Background Setup
|-------------------------------------------------------------------------
|
|
|
*/

final class Background extends AbstractSetup
{
    const DEFAULT_COLOR = 'f1f1f1';

    public function run()
    {
        \add_action('after_setup_theme', [$this, 'addSupport']);
        \add_filter('body_class', [$this, 'addBodyClasses']);
    }

    /**
     * @action after_setup_theme
     */
    public function addSupport()
    {
        \add_theme_support('custom-background', [
            'default-color' => '#'.self::DEFAULT_COLOR,
        ]);
    }

    /**
     * @filter body_class
     * @param string[int] $classes
     * @return string[int]
     */
    public function addBodyClasses(array $classes): array
    {
        if (\sanitize_key(\get_theme_mod('background_image'))) {
            $classes[] = 'has-background-image';
        } else {
            $classes[] = 'no-background-image';
        }

        if (\in_array(\sanitize_key(\get_theme_mod(
            'background_color',
            self::DEFAULT_COLOR
        )), ['fff', 'ffffff'])) {
            $classes[] = 'no-background-color';
        } else {
            $classes[] = 'has-background-color';
        }

        return $classes;
    }
}
