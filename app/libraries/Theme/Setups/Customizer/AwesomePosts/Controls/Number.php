<?php
declare (strict_types = 1);

namespace My\Theme\Setups\Customizer\AwesomePosts\Controls;

use My\Theme\Setups\Customizer\AwesomePosts;

final class Number extends AbstractControl
{
    public function __construct(AwesomePosts $awesome_posts)
    {
        parent::__construct($awesome_posts);

        $this->id = $awesome_posts->settings['Number']->id;

        $this->args['type'] = 'select';
        $this->args['label'] = \esc_html__('Number or posts', 'my-theme');
        $this->args['choices'] = \array_combine(($num = \range(0, 6, 1)), $num);
    }
}
