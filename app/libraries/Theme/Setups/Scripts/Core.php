<?php
declare (strict_types = 1);

namespace My\Theme\Setups\Scripts;

use GrottoPress\Jentil\Setups\Scripts\AbstractScript;
use GrottoPress\Jentil\AbstractChildTheme;

/*
|-----------------------------------------------------------------
| Main theme script setup
|-----------------------------------------------------------------
|
| @see GrottoPress\Jentil\Setups\Scripts\Core
|
*/

final class Core extends AbstractScript
{
    public function __construct(AbstractChildTheme $theme)
    {
        parent::__construct($theme);

        $this->id = $this->app->theme->stylesheet;
    }

    public function run()
    {
        // \add_action('after_setup_theme', [$this, 'dequeue']);
        \add_action('wp_enqueue_scripts', [$this, 'enqueue']);
    }

    /**
     * @action wp_enqueue_scripts
     */
    public function enqueue()
    {
        $file = '/dist/scripts/core.min.js';

        \wp_enqueue_script(
            $this->id,
            $this->app->utilities->fileSystem->themeDir('url', $file),
            ['jquery'],
            \filemtime(
                $this->app->utilities->fileSystem->themeDir('path', $file)
            ),
            true
        );
    }

    /**
     * This is only an example. You probably do not
     * want to dequeue Jentil's script.
     *
     * @action after_setup_theme
     */
    public function dequeue()
    {
        \remove_action(
            'wp_enqueue_scripts',
            [$this->app->parent->setups['Scripts\Core'], 'enqueue']
        );

        // OR
        // @action wp_enqueue_scripts Use priority > 10 (eg: 20)
        // \wp_dequeue_script($this->app->parent->setups['Scripts\Core']->id);
    }
}
