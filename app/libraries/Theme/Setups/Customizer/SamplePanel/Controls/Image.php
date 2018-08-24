<?php
declare (strict_types = 1);

namespace My\Theme\Setups\Customizer\SamplePanel\Controls;

use My\Theme\Setups\Customizer\SamplePanel\AbstractSection;
use WP_Customize_Image_Control as ImageControl;
use WP_Customize_Manager as WPCustomizer;

final class Image extends AbstractControl
{
    public function __construct(AbstractSection $section)
    {
        parent::__construct($section);

        $this->id = $section->settings['Image']->id;

        $this->args['label'] = \esc_html__('Image', 'my-theme');
    }

    public function add(WPCustomizer $wp_customizer)
    {
        $this->object = new ImageControl(
            $wp_customizer,
            $this->id,
            $this->args
        );

        parent::add($wp_customizer);
    }
}
