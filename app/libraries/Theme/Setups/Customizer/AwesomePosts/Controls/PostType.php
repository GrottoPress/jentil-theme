<?php
declare (strict_types = 1);

namespace Jentil\Theme\Setups\Customizer\AwesomePosts\Controls;

use Jentil\Theme\Setups\Customizer\AwesomePosts;

final class PostType extends AbstractControl
{
    public function __construct(AwesomePosts $awesome_posts)
    {
        parent::__construct($awesome_posts);

        $this->id = $awesome_posts->settings['PostType']->id;

        $this->args['type'] = 'select';
        $this->args['label'] = \esc_html__('Post type', 'jentil-theme');
        $this->args['choices'] = $this->customizer->app
            ->utilities->awesomePosts->postTypes();
    }
}
