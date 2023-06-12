<?php
namespace My\Theme\Setups\Customizer;

use My\Theme\Setups\Customizer;
use GrottoPress\Jentil\Setups\Customizer\AbstractPanel;
use WP_Customize_Manager as WPCustomizer;

final class SamplePanel extends AbstractPanel
{
    public function __construct(Customizer $customizer)
    {
        parent::__construct($customizer);

        $this->id = 'sample_panel';

        $this->args['title'] = \esc_html__('Sample Panel', 'jentil-theme');
    }

    public function add(WPCustomizer $wp_customizer)
    {
        $this->sections['SampleSection'] = new SamplePanel\SampleSection($this);

        parent::add($wp_customizer);
    }
}
