<?php
declare (strict_types = 1);

namespace My\Theme\Setups\Customizer\Footer\Controls;

use My\Theme\Setups\Customizer;
use WP_Customize_Cropped_Image_Control as CroppedImageControl;
use WP_Customize_Manager as WPCustomizer;

final class Logo extends AbstractControl
{
    public function __construct(Customizer $customizer)
    {
        parent::__construct($customizer);

        $this->id = $customizer->settings['Footer\Settings\Logo']->id;

        $this->args['label'] = \esc_html__('Logo', 'jentil-theme');
        $this->args['width'] = 200;
        $this->args['height'] = 60;
    }

    public function add(WPCustomizer $wp_customizer)
    {
        $this->object = new CroppedImageControl(
            $wp_customizer,
            $this->id,
            $this->args
        );

        parent::add($wp_customizer);
    }
}
