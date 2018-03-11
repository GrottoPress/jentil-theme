<?php
declare (strict_types = 1);

use Jentil\Theme\Theme;

function Theme(): Theme
{
    return Theme::getInstance();
}
