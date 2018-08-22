<?php
declare (strict_types = 1);

namespace Jentil\Theme\Utilities\ThemeMods;

use Jentil\Theme\Utilities\Utilities;

class ThemeMods
{
    /**
     * @var Utilities
     */
    private $utilities;

    public function __construct(Utilities $utilities)
    {
        $this->utilities = $utilities;
    }

    public function samplePanel(string $section, string $setting): SamplePanel
    {
        return new SamplePanel($this, $section, $setting);
    }
}
