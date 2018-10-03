<?php
declare (strict_types = 1);

namespace My\Theme\Setups\Styles;

use GrottoPress\Jentil\Setups\Styles\AbstractStyle;
use GrottoPress\Jentil\AbstractChildTheme;

/*
|----------------------------------------------------------------------
| Main Theme Style Setup
|----------------------------------------------------------------------
|
| Enqueue your theme's main style sheet here.
|
| @see GrottoPress\Jentil\Setups\Styles\Core
|
*/

final class Core extends AbstractStyle
{
    public function __construct(AbstractChildTheme $theme)
    {
        parent::__construct($theme);

        $this->id = $this->app->theme->stylesheet;
    }

    public function run()
    {
        \add_action('wp_enqueue_scripts', [$this, 'enqueue'], 20);
        // \add_action('after_setup_theme', [$this, 'dequeue']);
    }

    /**
     * @action wp_enqueue_scripts
     */
    public function enqueue()
    {
        $file_system = $this->app->utilities->fileSystem;

        $file = \is_rtl() ?
            '/dist/styles/core-rtl.min.css' :
            '/dist/styles/core.min.css';

        \wp_enqueue_style(
            $this->id,
            $file_system->themeDir('url', $file),
            [$this->app->parent->setups['Styles\Core']->id],
            \filemtime($file_system->themeDir('path', $file))
        );
    }

    /**
     * This is only an example. You probably do not
     * want to dequeue Jentil's style.
     *
     * @action after_setup_theme
     */
    public function dequeue()
    {
        \remove_action(
            'wp_enqueue_scripts',
            [$this->app->parent->setups['Styles\Core'], 'enqueue']
        );

        // OR
        // @action wp_enqueue_scripts Use priority > 10 (eg: 20)
        // \wp_dequeue_style($this->app->parent->setups['Styles\Core']->id);
    }
}
