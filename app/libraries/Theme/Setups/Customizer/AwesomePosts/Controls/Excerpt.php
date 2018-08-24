<?php
declare (strict_types = 1);

namespace My\Theme\Setups\Customizer\AwesomePosts\Controls;

use My\Theme\Setups\Customizer\AwesomePosts;

final class Excerpt extends AbstractControl
{
    public function __construct(AwesomePosts $awesome_posts)
    {
        parent::__construct($awesome_posts);

        $this->id = $awesome_posts->settings['Excerpt']->id;

        $this->args['type'] = 'checkbox';
        $this->args['label'] = \esc_html__('Show excerpt?', 'my-theme');
    }
}
