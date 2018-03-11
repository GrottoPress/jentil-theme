<?php
declare (strict_types = 1);

namespace Jentil\Theme\Utilities;

use Jentil\Theme\Theme;
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

final class Utilities
{
    use GetterTrait;

    /**
     * @var Theme
     */
    private $app;

    /**
     * @var SampleUtility
     */
    // private $sampleUtility;

    public function __construct(Theme $theme)
    {
        $this->app = $theme;
    }

    private function getApp(): Theme
    {
        return $this->app;
    }

    // private function getSampleUtility(): SampleUtility
    // {
    //     if (null === $this->sampleUtility) {
    //         $this->sampleUtility = new SampleUtility($this);
    //     }

    //     return $this->sampleUtility;
    // }

    // public function anotherSampleUtility(array $args): AnotherSampleUtility
    // {
    //     return new AnotherSampleUtility($this, $args);
    // }
}
