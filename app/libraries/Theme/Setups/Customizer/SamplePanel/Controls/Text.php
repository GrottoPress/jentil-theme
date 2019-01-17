<?php
declare (strict_types = 1);

namespace My\Theme\Setups\Customizer\SamplePanel\Controls;

use My\Theme\Setups\Customizer\SamplePanel\AbstractSection;
use WP_Customize_Color_Control as ColorControl;
use WP_Customize_Manager as WPCustomizer;

final class Text extends AbstractControl
{
    public function __construct(AbstractSection $section)
    {
        parent::__construct($section);

        $this->id = $section->settings['Text']->id;

        $this->args['type'] = 'text';
        $this->args['label'] = \esc_html__('Text', 'jentil-theme');
    }
}
