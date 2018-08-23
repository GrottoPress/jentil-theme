<?php
declare (strict_types = 1);

namespace Jentil\Theme\Utilities;

use Jentil\Theme\Utilities;
use Jentil\Theme\Utilities\ThemeMods\SamplePanel as SamplePanelMod;

/*
|------------------------------------------------------------------------
| Sample Utility
|------------------------------------------------------------------------
|
| @see Jentil\Theme\Setups\Customizer\SamplePanel
| @see Jentil\Theme\Utilities\ThemeMods\SamplePanel
|
*/

class Sample
{
    /**
     * @var Utilities
     */
    private $utilities;

    public function __construct(Utilities $utilities)
    {
        $this->utilities = $utilities;
    }

    public function render(): string
    {
        $sample_image = $this->themeMod('sample_section', 'image')->get();
        // $another_image = $this->themeMod('another_section', 'image')->get();

        return \wp_get_attachment_image(
            \attachment_url_to_postid($sample_image),
            'full',
            false,
            ['class' => 'sample-image', 'itemprop' => 'image']
        );
    }

    public function themeMod(string $section, string $setting): SamplePanelMod
    {
        return $this->utilities->themeMods->samplePanel($section, $setting);
    }

    /**
     * @return string[string]
     */
    public function dropdown(): array
    {
        return \array_combine(($num = \range(0, 5)), $num);
    }

    public function where(): bool
    {
        return $this->utilities->app->parent->utilities->page->is('front_page');
    }
}
