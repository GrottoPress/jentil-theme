<?php
declare (strict_types = 1);

namespace My\Theme\Utilities;

use My\Theme\Utilities;

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

    public function sample(string $section, string $setting): ThemeMods\Sample
    {
        return new ThemeMods\Sample($this, $section, $setting);
    }

    public function awesomePosts(string $setting): ThemeMods\AwesomePosts
    {
        return new ThemeMods\AwesomePosts($this, $setting);
    }
}
