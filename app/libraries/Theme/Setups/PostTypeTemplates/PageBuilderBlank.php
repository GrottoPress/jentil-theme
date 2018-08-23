<?php
declare (strict_types = 1);

namespace Jentil\Theme\Setups\PostTypeTemplates;

use GrottoPress\Jentil\Setups\PostTypeTemplates\AbstractTemplate;

/*
|---------------------------------------------------------------------
| Example Post Type Template Setup
|---------------------------------------------------------------------
|
| In this case, we are removing Jentil's page-builder-blank.php
| template setup.
|
| 
| @see GrottoPress\Jentil\Setups\PostTypeTemplates\PageBuilderBlank
*/

final class PageBuilderBlank extends AbstractTemplate
{
    public function run()
    {
        \add_action('after_setup_theme', [$this, 'remove']);
    }

    public function remove()
    {
        \remove_action(
            'wp_loaded',
            [
                $this->app->parent->setups['PostTypeTemplates\PageBuilderBlank'],
                'load'
            ]
        );
    }
}
