<?php
declare (strict_types = 1);

namespace My\Theme\Setups\Scripts;

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

        $this->id = "{$this->app->theme->stylesheet}-customize-preview";
    }

    public function run()
    {
        // \add_action('after_setup_theme', [$this, 'dequeue']);
        \add_action('customize_preview_init', [$this, 'enqueue']);
        \add_action('customize_preview_init', [$this, 'addInlineScript']);
    }

    /**
     * This is only an example. You probably don't want to
     * dequeue this.
     *
     * @action after_setup_theme
     */
    public function dequeue()
    {
        \remove_action('customize_preview_init', [
            $this->app->parent->setups['Scripts\CustomizePreview'],
            'enqueue'
        ]);

        // OR
        // @action wp_enqueue_scripts Use priority > 10 (eg: 20)
        // \wp_dequeue_script(
        //    $this->app->parent->setups['Scripts\CustomizePreview']->id
        // );

        \remove_action('customize_preview_init', [
            $this->app->parent->setups['Scripts\CustomizePreview'],
            'addInlineScript'
        ]);

        \remove_action('wp_enqueue_scripts', [
            $this->app->parent->setups['Scripts\CustomizePreview'],
            'addFrontEndInlineScript'
        ]);
    }

    /**
     * @action customize_preview_init
     */
    public function enqueue()
    {
        $file = '/dist/scripts/customize-preview.min.js';

        \wp_enqueue_script(
            $this->id,
            $this->app->utilities->fileSystem->themeDir('url', $file),
            ['customize-preview'],
            \filemtime(
                $this->app->utilities->fileSystem->themeDir('path', $file)
            ),
            true
        );
    }

    /**
     * @action customize_preview_init
     */
    public function addInlineScript()
    {
        $script = 'var myThemeAwesomePostsHeadingModId = "'.
            $this->app->setups['Customizer']
                ->sections['AwesomePosts']
                ->settings['Heading']->id.
        '";';

        \wp_add_inline_script($this->id, $script, 'before');
    }
}
