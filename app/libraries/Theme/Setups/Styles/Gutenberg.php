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

        $this->id = 'my-theme-gutenberg';
    }

    public function run()
    {
        \add_action('enqueue_block_editor_assets', [$this, 'enqueue']);
    }

    /**
     * @action enqueue_block_editor_assets
     */
    public function enqueue()
    {
        if (\is_rtl()) {
            $file = '/dist/styles/gutenberg-rtl.min.css';
        } else {
            $file = '/dist/styles/gutenberg.min.css';
        }

        \wp_enqueue_style(
            $this->id,
            $this->app->utilities->fileSystem->themeDir('url', $file),
            [$this->app->parent->setups['Styles\Gutenberg']->id],
            \filemtime(
                $this->app->utilities->fileSystem->themeDir('path', $file)
            )
        );
    }
}
