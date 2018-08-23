<?php
declare (strict_types = 1);

namespace Jentil\Theme\Setups\Customizer\AwesomePosts\Controls;

use Jentil\Theme\Setups\Customizer\AwesomePosts;
use GrottoPress\Jentil\Setups\Customizer\AbstractControl as Control;

abstract class AbstractControl extends Control
{
    public function __construct(AwesomePosts $awesome_posts)
    {
        parent::__construct($awesome_posts->customizer);

        $this->args['section'] = $awesome_posts->id;
    }
}
