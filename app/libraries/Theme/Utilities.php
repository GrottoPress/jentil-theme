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
        return $this->fileSystem = $this->fileSystem ?:
            new Utilities\FileSystem($this);
    }

    private function getThemeMods(): Utilities\ThemeMods
    {
        return $this->themeMods = $this->themeMods ?:
            new Utilities\ThemeMods($this);
    }

    private function getSample(): Utilities\Sample
    {
        return $this->sample = $this->sample ?: new Utilities\Sample($this);
    }

    private function getAwesomePosts(): Utilities\AwesomePosts
    {
        return $this->awesomePosts = $this->awesomePosts ?:
            new Utilities\AwesomePosts($this);
    }

    private function getFooter(): Utilities\Footer
    {
        return $this->footer = $this->footer ?: new Utilities\Footer($this);
    }

    /**
     * @param array<string, mixed> $args
     */
    public function metaBox(array $args): MetaBox
    {
        return $this->app->parent->utilities->metaBox($args);
    }
}
