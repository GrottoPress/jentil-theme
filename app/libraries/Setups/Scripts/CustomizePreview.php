<?php
declare (strict_types = 1);

namespace Jentil\Theme\Setups\Scripts;

use GrottoPress\Jentil\Setups\Scripts\AbstractScript;
use GrottoPress\Jentil\AbstractChildTheme;

/*
|-----------------------------------------------------------------
| Customize Preview Script Setup
|-----------------------------------------------------------------
|
| @see GrottoPress\Jentil\Setups\Scripts\CustomizePreview
|
*/

final class CustomizePreview extends AbstractScript
{
    public function __construct(AbstractChildTheme $theme)
    {
        parent::__construct($theme);

        $this->id = 'jentil-theme-customize-preview';
    }

    public function run()
    {
        // \add_action('after_setup_theme', [$this, 'dequeue']);
        \add_action('customize_preview_init', [$this, 'enqueue']);
    }

    /**
     * @action customize_preview_init
     */
    public function enqueue()
    {
        \wp_enqueue_script(
            $this->id,
            $this->app->utilities->fileSystem->themeDir(
                'url',
                '/dist/scripts/customize-preview.min.js'
            ),
            ['jquery', 'customize-preview'],
            '',
            true
        );
    }

    /**
     * This is only an example. You probably don't want to
     * dequeue this.
     *
     * @action after_setup_theme
     */
    public function dequeue()
    {
        \remove_action(
            'customize_preview_init',
            [$this->app->parent->setups['Scripts\CustomizePreview'], 'enqueue']
        );

        // OR
        // @action wp_enqueue_scripts Use priority > 10 (eg: 20)
        // \wp_dequeue_script(
        //    $this->app->parent->setups['Scripts\CustomizePreview']->id
        // );
    }
}
