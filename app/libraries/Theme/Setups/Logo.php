<?php
declare (strict_types = 1);

namespace My\Theme\Setups;

use GrottoPress\Jentil\Setups\AbstractSetup;

/*
|--------------------------------------------------------------------
| Logo Setup
|--------------------------------------------------------------------
|
| 
|
*/

final class Logo extends AbstractSetup
{
    public function run()
    {
        \add_action('after_setup_theme', [$this, 'addSupport']);
    }

    /**
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
