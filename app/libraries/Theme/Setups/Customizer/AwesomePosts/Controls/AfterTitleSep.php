<?php
declare (strict_types = 1);

namespace Jentil\Theme\Setups\Customizer\AwesomePosts\Controls;

use Jentil\Theme\Setups\Customizer\AwesomePosts;

final class AfterTitleSep extends AbstractControl
{
    public function __construct(AwesomePosts $awesome_posts)
    {
        parent::__construct($awesome_posts);

        $this->id = $awesome_posts->settings['AfterTitleSep']->id;

        $this->args['type'] = 'text';
        $this->args['label'] = \esc_html__('After title separator', 'jentil-theme');
    }
}
