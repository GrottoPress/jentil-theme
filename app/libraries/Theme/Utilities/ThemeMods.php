<?php
declare (strict_types = 1);

namespace Jentil\Theme\Utilities;

use Jentil\Theme\Utilities;

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

    public function samplePanel(
        string $section,
        string $setting
    ): ThemeMods\SamplePanel {
        return new ThemeMods\SamplePanel($this, $section, $setting);
    }

    public function awesomePosts(string $setting): ThemeMods\AwesomePosts
    {
        return new ThemeMods\AwesomePosts($this, $setting);
    }
}
