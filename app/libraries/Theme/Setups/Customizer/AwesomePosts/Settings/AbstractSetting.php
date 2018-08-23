<?php
declare (strict_types = 1);

namespace Jentil\Theme\Setups\Customizer\AwesomePosts\Settings;

use Jentil\Theme\Setups\Customizer\AwesomePosts;
use Jentil\Theme\Utilities\ThemeMods\AwesomePosts as AwesomePostsMod;
use GrottoPress\Jentil\Setups\Customizer\AbstractSetting as Setting;

abstract class AbstractSetting extends Setting
{
    public function __construct(AwesomePosts $awesome_posts)
    {
        parent::__construct($awesome_posts->customizer);
    }

    protected function themeMod(string $setting): AwesomePostsMod
    {
        return $this->customizer->app->utilities->themeMods->awesomePosts(
            $setting
        );
    }
}
