<?php
declare (strict_types = 1);

namespace My\Theme\Setups\Sidebars;

use GrottoPress\Jentil\Setups\AbstractSetup;

/*
|-----------------------------------------------------------------
| Just an example sidebar setup
|-----------------------------------------------------------------
|
| In this case, we're removing the secondary sidebar added by
| Jentil.
|
| @see GrottoPress\Jentil\Setups\Sidebars\Secondary
|
*/

final class Secondary extends AbstractSetup
{
    public function run()
    {
        \add_action('after_setup_theme', [$this, 'remove']);
    }

    /**
     * @action after_setup_theme
     */
    public function remove()
    {
        \remove_action(
            'widgets_init',
            [$this->app->parent->setups['Sidebars\Secondary'], 'register']
        );

        // OR
        // @action widgets_init Use priority > 10 (eg: 20)
        // \unregister_sidebar(
        //     $this->app->parent->setups['Sidebars\Secondary']->id
        // );
    }
}
