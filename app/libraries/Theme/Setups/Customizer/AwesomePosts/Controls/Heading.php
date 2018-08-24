<?php
declare (strict_types = 1);

namespace My\Theme\Setups\Customizer\AwesomePosts\Controls;

use My\Theme\Setups\Customizer\AwesomePosts;

final class Heading extends AbstractControl
{
    public function __construct(AwesomePosts $awesome_posts)
    {
        parent::__construct($awesome_posts);

        $this->id = $awesome_posts->settings['Heading']->id;

        $this->args['type'] = 'text';
        $this->args['label'] = \esc_html__('Heading', 'my-theme');
    }
}
