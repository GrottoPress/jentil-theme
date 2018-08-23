<?php
declare (strict_types = 1);

namespace Jentil\Theme\Utilities;

use Jentil\Theme\Utilities;
use GrottoPress\Jentil\Utilities\ThemeMods\Footer as FooterMod;

/*
|------------------------------------------------------------------------
| Footer Utility
|------------------------------------------------------------------------
|
|
*/

class Footer
{
    /**
     * @var Utilities
     */
    private $utilities;

    public function __construct(Utilities $utilities)
    {
        $this->utilities = $utilities;
    }

    public function renderLogo(): string
    {
        return \wp_get_attachment_image(
            $this->themeMod('logo')->get(),
            'full',
            true,
            ['class' => 'footer-logo', 'itemprop' => 'image']
        );
    }

    public function themeMod(string $setting): FooterMod
    {
        return $this->utilities->app->parent
            ->utilities->themeMods->footer($setting);
    }
}
