<?php
declare (strict_types = 1);

namespace My\Theme\Utilities\ThemeMods;

use My\Theme\Utilities\ThemeMods;
use GrottoPress\Jentil\Utilities\ThemeMods\AbstractThemeMod;

class AwesomePosts extends AbstractThemeMod
{
    /**
     * @var ThemeMods
     */
    protected $themeMods;

    /**
     * @var string
     */
    private $setting;

    public function __construct(ThemeMods $theme_mods, string $setting)
    {
        $this->themeMods = $theme_mods;
        $this->setting = \sanitize_key($setting);

        $this->id = "awesome_posts_{$this->setting}";
        $this->default = $this->defaults()[$this->setting] ?? null;
    }

    /**
     * @return array<string, mixed>
     */
    private function defaults(): array
    {
        return [
            'number' => 3,
            'heading' => \esc_html__('Awesome Posts', 'jentil-theme'),
            'excerpt' => 1,
            'post_type' => 'post',
            'after_title' => '',
            'after_title_sep' => '|',
            'more_text' => \esc_html__('Read more &raquo;', 'jentil-theme'),
        ];
    }
}
