<?php
declare (strict_types = 1);

namespace My\Theme\Setups\Thumbnails;

use GrottoPress\Jentil\AbstractChildTheme;
use GrottoPress\Jentil\Setups\Thumbnails\AbstractThumbnail;

/*
|-----------------------------------------------------------------
| Thumbnails Setup
|-----------------------------------------------------------------
|
| Set post thumbnail sizes here, and add new thumbnail sizes for your theme.
|
| You may remove sizes added by Jentil that you do not need here.
|
| @see GrottoPress\Jentil\Setups\Thumbnails\
|
*/

final class Small extends AbstractThumbnail
{
    public function __construct(AbstractChildTheme $theme)
    {
        parent::__construct($theme);

        $this->id = "{$this->app->meta['slug']}-small";
    }

    public function run()
    {
        \add_action('after_setup_theme', [$this, 'addSize']);
    }

    /**
     * @action after_setup_theme
     */
    public function addSize()
    {
        \add_image_size($this->id, 150, 150, true);
    }
}
