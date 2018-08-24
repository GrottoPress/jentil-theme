<?php
declare (strict_types = 1);

namespace My\Theme\Setups\Customizer\SamplePanel\Settings;

use My\Theme\Setups\Customizer\SamplePanel\AbstractSection;

final class Select extends AbstractSetting
{
    public function __construct(AbstractSection $section)
    {
        parent::__construct($section);

        $theme_mod = $this->themeMod('select');

        $this->id = $theme_mod->id;

        $this->args['default'] = $theme_mod->default;
        $this->args['sanitize_callback'] = 'absint';
    }
}
