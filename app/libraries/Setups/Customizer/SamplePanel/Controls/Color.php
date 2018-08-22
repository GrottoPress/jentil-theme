<?php
declare (strict_types = 1);

namespace Jentil\Theme\Setups\Customizer\SamplePanel\Controls;

use Jentil\Theme\Setups\Customizer\SamplePanel\AbstractSection;
use WP_Customize_Color_Control as ColorControl;
use WP_Customize_Manager as WPCustomizer;

final class Color extends AbstractControl
{
    public function __construct(AbstractSection $section)
    {
        parent::__construct($section);

        $this->id = $section->settings['Color']->id;

        $this->args['label'] = \esc_html__('Color', 'jentil-theme');

        // if ('sample_section' === $section->context) {
        //     $this->args['active_callback'] = function (): bool {
        //         return !$this->customizer->app->utilities->someUtility->where();
        //     };
        // }
    }

    public function add(WPCustomizer $wp_customizer)
    {
        $this->object = new ColorControl(
            $wp_customizer,
            $this->id,
            $this->args
        );

        parent::add($wp_customizer);
    }
}
