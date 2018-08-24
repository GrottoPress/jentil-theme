<?php
declare (strict_types = 1);

namespace My\Theme\Setups\Customizer\AwesomePosts\Controls;

use My\Theme\Setups\Customizer\AwesomePosts;

final class AfterTitle extends AbstractControl
{
    public function __construct(AwesomePosts $awesome_posts)
    {
        parent::__construct($awesome_posts);

        $this->id = $awesome_posts->settings['AfterTitle']->id;

        $this->args['type'] = 'text';
        $this->args['label'] = \esc_html__('After title', 'my-theme');
        $this->args['description'] = \esc_html__('Comma-separated', 'my-theme');
    }
}
