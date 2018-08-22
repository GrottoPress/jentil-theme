<?php
declare (strict_types = 1);

namespace Jentil\Theme\Setups\Customizer\SamplePanel\Controls;

use Jentil\Theme\Setups\Customizer\SamplePanel\AbstractSection;
use WP_Customize_Color_Control as ColorControl;
use WP_Customize_Manager as WPCustomizer;

final class Select extends AbstractControl
{
    public function __construct(AbstractSection $section)
    {
        parent::__construct($section);

        $this->id = $section->settings['Select']->id;

        $this->args['type'] = 'select';
        $this->args['label'] = \esc_html__('Select', 'jentil-theme');
        $this->args['choices'] =
            $this->customizer->app->utilities->sample->dropdown();
    }
}
