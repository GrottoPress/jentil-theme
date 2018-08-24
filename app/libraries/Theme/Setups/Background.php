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
    public function run()
    {
        \add_action('after_setup_theme', [$this, 'addSupport']);
    }

    /**
     * @action after_setup_theme
     */
    public function addSupport()
    {
        \add_theme_support('custom-background', [
            'default-color' => '#f1f1f1',
        ]);
    }
}
