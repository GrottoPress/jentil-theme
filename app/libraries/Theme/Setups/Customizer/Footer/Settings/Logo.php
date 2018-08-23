<?php
declare (strict_types = 1);

namespace Jentil\Theme\Setups\Customizer\Footer\Settings;

use Jentil\Theme\Setups\Customizer;

final class Logo extends AbstractSetting
{
    public function __construct(Customizer $customizer)
    {
        parent::__construct($customizer);

        $theme_mod = $this->themeMod('logo');

        $this->id = $theme_mod->id;

        $this->args['default'] = $theme_mod->default;
        $this->args['sanitize_callback'] = 'absint';
    }
}
