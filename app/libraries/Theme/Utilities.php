<?php
declare (strict_types = 1);

namespace Jentil\Theme;

use Jentil\Theme;
use Jentil\Theme\Utilities\ThemeMods;
use GrottoPress\Getter\GetterTrait;

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
     * @var Sample
     */
    private $sample;

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
        if (null === $this->fileSystem) {
            $this->fileSystem = new Utilities\FileSystem($this);
        }

        return $this->fileSystem;
    }

    private function getThemeMods(): Utilities\ThemeMods
    {
        if (null === $this->themeMods) {
            $this->themeMods = new Utilities\ThemeMods($this);
        }

        return $this->themeMods;
    }

    private function getSample(): Utilities\Sample
    {
        if (null === $this->sample) {
            $this->sample = new Utilities\Sample($this);
        }

        return $this->sample;
    }
}
