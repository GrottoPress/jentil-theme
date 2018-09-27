<?php
declare (strict_types = 1);

namespace My\Theme;

use My\Theme;
use My\Theme\Utilities\ThemeMods;
use GrottoPress\Getter\GetterTrait;
use GrottoPress\WordPress\MetaBox;

/*
|------------------------------------------------------------------------
| Utilities
|------------------------------------------------------------------------
|
| Create single instances of utilities you would need throughout your
| theme here, or define public methods for creating instances for
| utilities that may need more than one instance, or utilities that
| accept args via their constructor.
|
| They should be accessible from other objects via:
|   `$this->app->utilities->sampleUtiltity` or
|   `$this->app->utilities->anotherSampleUtility($args...)`,
|       for utilities that take args.
|
| @see GrottoPress\Jentil\Utilities
|
*/

class Utilities
{
    use GetterTrait;

    /**
     * @var Theme
     */
    private $app;

    /**
     * @var Utilities\FileSystem
     */
    private $fileSystem;

    /**
     * @var Utilities\ThemeMods
     */
    private $themeMods;

    /**
     * @var Utilities\Sample
     */
    private $sample;

    /**
     * @var Utilities\AwesomePosts
     */
    private $awesomePosts;

    /**
     * @var Utilities\Footer
     */
    private $footer;

    public function __construct(Theme $theme)
    {
        $this->app = $theme;
    }

    private function getApp(): Theme
    {
        return $this->app;
    }

    private function getFileSystem(): Utilities\FileSystem
    {
        $this->fileSystem = $this->fileSystem ?:
            new Utilities\FileSystem($this);

        return $this->fileSystem;
    }

    private function getThemeMods(): Utilities\ThemeMods
    {
        $this->themeMods = $this->themeMods ?: new Utilities\ThemeMods($this);

        return $this->themeMods;
    }

    private function getSample(): Utilities\Sample
    {
        $this->sample = $this->sample ?: new Utilities\Sample($this);

        return $this->sample;
    }

    private function getAwesomePosts(): Utilities\AwesomePosts
    {
        $this->awesomePosts = $this->awesomePosts ?:
            new Utilities\AwesomePosts($this);

        return $this->awesomePosts;
    }

    private function getFooter(): Utilities\Footer
    {
        $this->footer = $this->footer ?: new Utilities\Footer($this);

        return $this->footer;
    }

    /**
     * @param mixed[string] $args
     */
    public function metaBox(array $args): MetaBox
    {
        return $this->app->parent->utilities->metaBox($args);
    }
}
