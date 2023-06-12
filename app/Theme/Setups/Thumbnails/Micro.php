<?php
declare (strict_types = 1);

namespace My\Theme\Setups\Thumbnails;

use GrottoPress\Jentil\Setups\AbstractSetup;

/*
|-----------------------------------------------------------------
| Thumbnail Setup
|-----------------------------------------------------------------
|
| @see GrottoPress\Jentil\Setups\Thumbnails\Micro
|
*/

final class Micro extends AbstractSetup
{
    public function run()
    {
        \add_action('after_setup_theme', [$this, 'removeSize'], 8);
    }

    /**
     * @action after_setup_theme
     */
    public function removeSize()
    {
        \remove_action(
            'after_setup_theme',
            [$this->app->parent->setups['Thumbnails\Micro'], 'addSize']
        );
    }
}
