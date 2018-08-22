<?php
declare (strict_types = 1);

namespace Jentil\Theme\Setups\Customizer\SamplePanel\Settings;

use Jentil\Theme\Setups\Customizer\SamplePanel\AbstractSection;
use Jentil\Theme\Utilities\ThemeMods\SamplePanel as SamplePanelMod;
use GrottoPress\Jentil\Setups\Customizer\AbstractSetting as Setting;

abstract class AbstractSetting extends Setting
{
    /**
     * @var AbstractSection
     */
    protected $section;

    public function __construct(AbstractSection $section)
    {
        $this->section = $section;

        parent::__construct($this->section->customizer);
    }

    protected function themeMod(string $setting): SamplePanelMod
    {
        return $this->customizer->app->utilities->themeMods->samplePanel(
            $this->section->id,
            $setting
        );
    }
}
