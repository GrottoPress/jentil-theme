<?php
declare (strict_types = 1);

namespace Jentil\Theme\Setups\Styles;

use GrottoPress\Jentil\Setups\Styles\AbstractStyle;
use GrottoPress\Jentil\AbstractChildTheme;

/*
|----------------------------------------------------------------------
| Main Theme Style Setup
|----------------------------------------------------------------------
|
| Enqueue your theme's main style sheet here.
|
| @see GrottoPress\Jentil\Setups\Styles
|
*/

final class Style extends AbstractStyle
{
    public function __construct(AbstractChildTheme $theme)
    {
        parent::__construct($theme);

        $this->id = 'jentil-theme';
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
        if (\is_rtl()) {
            $style = 'theme-rtl.min.css';
        } else {
            $style = 'theme.min.css';
        }

        \wp_enqueue_style(
            $this->id,
            \get_template_directory_uri()."/dist/styles/${style}",
            [$this->app->parent->setups['Styles\Style']->id]
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
            [$this->app->parent->setups['Styles\Style'], 'enqueue']
        );

        // OR
        // @action wp_enqueue_scripts Use priority > 10 (eg: 20)
        // \wp_dequeue_style($this->app->parent->setups['Styles\Style']->id);
    }
}
