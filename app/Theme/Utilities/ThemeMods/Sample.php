<?php
declare (strict_types = 1);

namespace My\Theme\Utilities\ThemeMods;

use My\Theme\Utilities\ThemeMods;
use GrottoPress\Jentil\Utilities\ThemeMods\AbstractThemeMod;

class Sample extends AbstractThemeMod
{
    /**
     * @var ThemeMods
     */
    protected $themeMods;

    /**
     * @var string
     */
    private $section;

    /**
     * @var string
     */
    private $setting;

    public function __construct(
        ThemeMods $theme_mods,
        string $section,
        string $setting
    ) {
        $this->themeMods = $theme_mods;

        $this->section = \sanitize_key($section);
        $this->setting = \sanitize_key($setting);

        $this->id = "sample_{$this->section}_{$this->setting}";
        $this->default = $this->defaults()[$this->setting] ?? '';
    }

    /**
     * @return array<string, mixed>
     */
    private function defaults(): array
    {
        $defaults = [
            'text' => \esc_html('Text', 'jentil-theme'),
            'color' => '#ffeedd',
            'image' => '',
            'select' => 1,
        ];

        // if ('sample_section' === $this->section) {
        //     $defaults['color'] = '#f0f0f0';
        // }

        return $defaults;
    }
}
