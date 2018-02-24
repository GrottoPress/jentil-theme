<?php

/**
 * Helper functions
 *
 * @package Jentil\Theme
 */

declare (strict_types = 1);

use Jentil\Theme\Theme;

/**
 * Theme
 */
function Theme(): Theme
{
    return Theme::getInstance();
}
