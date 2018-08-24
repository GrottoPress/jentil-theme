<?php
declare (strict_types = 1);

namespace My\Theme\Setups\Customizer\SamplePanel;

use My\Theme\Setups\Customizer\SamplePanel;
use GrottoPress\Jentil\Setups\Customizer\AbstractSection as Section;
use WP_Customize_Manager as WPCustomizer;

abstract class AbstractSection extends Section
{
    public function __construct(SamplePanel $sample_panel)
    {
        parent::__construct($sample_panel->customizer);

        $this->args['panel'] = $sample_panel->id;
    }

    public function add(WPCustomizer $wp_customizer)
    {
        $this->setSettings();

        parent::add($wp_customizer);
    }

    protected function setSettings()
    {
        $this->settings['Text'] = new Settings\Text($this);
        $this->controls['Text'] = new Controls\Text($this);

        $this->settings['Select'] = new Settings\Select($this);
        $this->controls['Select'] = new Controls\Select($this);

        $this->settings['Color'] = new Settings\Color($this);
        $this->controls['Color'] = new Controls\Color($this);

        $this->settings['Image'] = new Settings\Image($this);
        $this->controls['Image'] = new Controls\Image($this);
    }
}
