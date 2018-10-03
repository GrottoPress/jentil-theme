<?php
declare (strict_types = 1);

namespace My\Theme\Setups\Styles;

use GrottoPress\Jentil\Setups\Styles\AbstractStyle;
use GrottoPress\Jentil\AbstractChildTheme;

final class Gutenberg extends AbstractStyle
{
    public function __construct(AbstractChildTheme $theme)
    {
        parent::__construct($theme);

        $this->id = "{$this->app->theme->stylesheet}-gutenberg";
    }

    public function run()
    {
        \add_action('enqueue_block_editor_assets', [$this, 'enqueue'], 20);
    }

    /**
     * @action enqueue_block_editor_assets
     */
    public function enqueue()
    {
        $file_system = $this->app->utilities->fileSystem;

        $file = \is_rtl() ?
            '/dist/styles/gutenberg-rtl.min.css' :
            '/dist/styles/gutenberg.min.css';

        \wp_enqueue_style(
            $this->id,
            $file_system->themeDir('url', $file),
            [$this->app->parent->setups['Styles\Gutenberg']->id],
            \filemtime($file_system->themeDir('path', $file))
        );
    }
}
