<?php
declare (strict_types = 1);

namespace Jentil\Theme\Setups\Customizer\SamplePanel\Settings;

use Jentil\Theme\Setups\Customizer\SamplePanel\AbstractSection;

final class Image extends AbstractSetting
{
    public function __construct(AbstractSection $section)
    {
        parent::__construct($section);

        $theme_mod = $this->themeMod('image');

        $this->id = $theme_mod->id;

        $this->args['default'] = $theme_mod->default;
        $this->args['sanitize_callback'] = 'esc_url_raw';
    }
}
