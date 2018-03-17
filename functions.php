<?php
declare (strict_types = 1);

require __DIR__.'/vendor/autoload.php';

\add_action('after_setup_theme', function () {
    \Theme()->run();
}, 2);
