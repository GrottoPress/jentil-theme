<?php
declare (strict_types = 1);

namespace My\Theme\Setups\ThemeMods;

use GrottoPress\Jentil\Setups\AbstractSetup;

/*
|----------------------------------------------------------------------
| Footer Theme Mod Setup
|----------------------------------------------------------------------
|
| Filter Jentil's Footer theme mods utility here, to add our own
| theme's footer setting id and default.
|
| This is possible via the filter hook `jentil_footer_mod_id`
|
| @see GrottoPress\Jentil\Utilities\ThemeMods\Footer
|
*/

final class Footer extends AbstractSetup
{
    public function run()
    {
        \add_filter('jentil_footer_mod_id', [$this, 'addLogoId'], 10, 2);
        \add_filter(
            'jentil_footer_mod_default',
            [$this, 'addLogoDefault'],
            10,
            2
        );
    }

    /**
     * @filter jentil_footer_mod_id
     */
    public function addLogoId(string $id, string $setting): string
    {
        if ('logo' !== $setting) {
            return $id;
        }

        return "footer_logo";
    }

    /**
     * @filter jentil_footer_mod_default
     */
    public function addLogoDefault($default, string $setting)
    {
        if ('logo' !== $setting) {
            return $default;
        }

        return 0;
    }
}
