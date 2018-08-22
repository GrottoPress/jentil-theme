<?php
namespace Jentil\Theme\Setups\Customizer\SamplePanel;

use Jentil\Theme\Setups\Customizer\Customizer;
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
        $this->sections['SampleSection'] = new SampleSection($this);

        parent::add($wp_customizer);
    }
}
