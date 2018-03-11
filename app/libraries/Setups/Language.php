<?php
declare (strict_types = 1);

namespace Jentil\Theme\Setups;

use GrottoPress\Jentil\Setups\AbstractSetup;

/*
|------------------------------------------------------------------------
| Language Setup
|------------------------------------------------------------------------
|
| @see GrottoPress\Jentil\Setups\Language
|
*/

final class Language extends AbstractSetup
{
    public function run()
    {
        \add_action('after_setup_theme', [$this, 'loadTextDomain' ]);
    }

    /**
     * @action after_setup_theme
     */
    public function loadTextDomain()
    {
        \load_theme_textdomain(
            'jentil-theme',
            \get_template_directory().'/languages'
        );
    }
}
