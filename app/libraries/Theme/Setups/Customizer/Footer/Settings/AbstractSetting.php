<?php
declare (strict_types = 1);

namespace My\Theme\Setups\Customizer\Footer\Settings;

use My\Theme\Setups\Customizer;
use GrottoPress\Jentil\Utilities\ThemeMods\Footer as FooterMod;
use GrottoPress\Jentil\Setups\Customizer\AbstractSetting as Setting;

abstract class AbstractSetting extends Setting
{
    public function __construct(Customizer $customizer)
    {
        parent::__construct($customizer);
    }

    protected function themeMod(string $setting): FooterMod
    {
        return $this->customizer->app->parent->utilities->themeMods->footer(
            $setting
        );
    }
}
