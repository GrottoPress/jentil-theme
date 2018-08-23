<?php
declare (strict_types = 1);

namespace Jentil\Theme\Setups\Customizer\Footer\Controls;

use Jentil\Theme\Setups\Customizer;
use GrottoPress\Jentil\Setups\Customizer\AbstractControl as Control;

abstract class AbstractControl extends Control
{
    public function __construct(Customizer $customizer)
    {
        parent::__construct($customizer);

        $this->args['section'] = $this->customizer->app
            ->parent->setups['Customizer']->sections['Footer']->id;
    }
}
