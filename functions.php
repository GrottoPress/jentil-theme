<?php

/**
 * Functions
 *
 * @package Jentil\Theme
 */

declare (strict_types = 1);

/**
 * Autoloader
 */
require __DIR__.'/vendor/autoload.php';

/**
 * Run this theme.
 *
 * @action after_setup_theme
 */
\add_action('after_setup_theme', function () {
    \Theme()->run();
}, 2);
