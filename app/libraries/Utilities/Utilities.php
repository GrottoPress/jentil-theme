<?php
declare (strict_types = 1);

namespace Jentil\Theme\Utilities;

use Jentil\Theme\Theme;
use Jentil\Theme\Utilities\ThemeMods\ThemeMods;
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
| @see GrottoPress\Jentil\Utilities\Utilities
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
     * @var FileSystem
     */
    private $fileSystem;

    /**
     * @var ThemeMods
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

    private function getFileSystem(): FileSystem
    {
        if (null === $this->fileSystem) {
            $this->fileSystem = new FileSystem($this);
        }

        return $this->fileSystem;
    }

    private function getThemeMods(): ThemeMods
    {
        if (null === $this->themeMods) {
            $this->themeMods = new ThemeMods($this);
        }

        return $this->themeMods;
    }

    private function getSample(): Sample
    {
        if (null === $this->sample) {
            $this->sample = new Sample($this);
        }

        return $this->sample;
    }
}
