<?php
declare (strict_types = 1);

use My\Theme;

function MyTheme(): Theme
{
    return Theme::getInstance();
}
