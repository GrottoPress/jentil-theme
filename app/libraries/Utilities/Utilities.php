<?php

/**
 * Utilities
 *
 * @package Jentil\Theme\Utilities
 *
 * @see GrottoPress\Jentil\Utilities\Utilities
 */

declare (strict_types = 1);

namespace Jentil\Theme\Utilities;

use Jentil\Theme\Theme;
use GrottoPress\Getter\Getter;

/**
 * Utilities
 */
final class Utilities
{
    use Getter;

    /**
     * App
     *
     * @var Theme
     */
    private $app;

    /**
     * Sample utility
     *
     * @var SampleUtility
     */
    // private $sampleUtility;

    /**
     * Constructor
     *
     * @var Theme $theme
     */
    public function __construct(Theme $theme)
    {
        $this->app = $theme;
    }

    /**
     * Get app
     */
    private function getApp(): Theme
    {
        return $this->app;
    }

    /**
     * Get sample utility
     */
    // private function getSampleUtility(): SampleUtility
    // {
    //     if (null === $this->sampleUtility) {
    //         $this->sampleUtility = new SampleUtility($this);
    //     }

    //     return $this->sampleUtility;
    // }
}
