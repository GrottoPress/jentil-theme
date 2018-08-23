<?php
declare (strict_types = 1);

namespace Jentil\Theme\Setups\Customizer\AwesomePosts\Settings;

use Jentil\Theme\Setups\Customizer\AwesomePosts;

final class AfterTitle extends AbstractSetting
{
    public function __construct(AwesomePosts $awesome_posts)
    {
        parent::__construct($awesome_posts);

        $theme_mod = $this->themeMod('after_title');

        $this->id = $theme_mod->id;

        $this->args['default'] = $theme_mod->default;
        $this->args['sanitize_callback'] = 'sanitize_text_field';
    }
}
