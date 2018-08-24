<?php
declare (strict_types = 1);

use My\Theme;

function Theme(): Theme
{
    return Theme::getInstance();
}
