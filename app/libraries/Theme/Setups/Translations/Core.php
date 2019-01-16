<?php
declare (strict_types = 1);

namespace My\Theme\Setups\Translations;

use GrottoPress\Jentil\AbstractChildTheme;
use GrottoPress\Jentil\Setups\Translations\AbstractTranslation;

/*
|------------------------------------------------------------------------
| Translation Setup
|------------------------------------------------------------------------
|
| @see GrottoPress\Jentil\Setups\Translations\Core
|
*/

final class Core extends AbstractTranslation
{
    public function __construct(AbstractChildTheme $theme)
    {
        parent::__construct($theme);

        $this->textDomain = $this->app->meta['text_domain'];
    }

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
            $this->textDomain,
            $this->app->utilities->fileSystem->themeDir(
                'path',
                $this->app->meta['domain_path']
            )
        );
    }
}
