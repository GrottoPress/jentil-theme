<?php
declare (strict_types = 1);

namespace My\Theme\Setups\Customizer\SamplePanel\Controls;

use My\Theme\Setups\Customizer\SamplePanel\AbstractSection;
use GrottoPress\Jentil\Setups\Customizer\AbstractControl as Control;

abstract class AbstractControl extends Control
{
    public function __construct(AbstractSection $section)
    {
        parent::__construct($section->customizer);

        $this->args['section'] = $section->id;
    }
}
