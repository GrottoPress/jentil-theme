<?php
declare (strict_types = 1);

namespace My\Theme\Setups\Customizer;

use My\Theme\Setups\Customizer;
use GrottoPress\Jentil\Setups\Customizer\AbstractSection;
use WP_Customize_Manager as WPCustomizer;

final class AwesomePosts extends AbstractSection
{
    public function __construct(Customizer $customizer)
    {
        parent::__construct($customizer);

        $this->id = 'awesome_posts';

        $this->args['title'] = \esc_html__('Awesome Posts', 'my-theme');
        $this->args['panel'] = $this->customizer->app->parent
            ->setups['Customizer']->panels['Posts']->id;
        $this->args['active_callback'] = function (): bool {
            return $this->customizer->app->utilities->awesomePosts->where();
        };
    }

    public function add(WPCustomizer $wp_customizer)
    {
        $this->settings['Number'] = new AwesomePosts\Settings\Number($this);
        $this->controls['Number'] = new AwesomePosts\Controls\Number($this);

        $this->settings['Heading'] = new AwesomePosts\Settings\Heading($this);
        $this->controls['Heading'] = new AwesomePosts\Controls\Heading($this);

        $this->settings['PostType'] = new AwesomePosts\Settings\PostType($this);
        $this->controls['PostType'] = new AwesomePosts\Controls\PostType($this);

        $this->settings['Excerpt'] = new AwesomePosts\Settings\Excerpt($this);
        $this->controls['Excerpt'] = new AwesomePosts\Controls\Excerpt($this);

        $this->settings['MoreText'] = new AwesomePosts\Settings\MoreText($this);
        $this->controls['MoreText'] = new AwesomePosts\Controls\MoreText($this);

        $this->settings['AfterTitle'] =
            new AwesomePosts\Settings\AfterTitle($this);
        $this->controls['AfterTitle'] =
            new AwesomePosts\Controls\AfterTitle($this);

        $this->settings['AfterTitleSep'] =
            new AwesomePosts\Settings\AfterTitleSep($this);
        $this->controls['AfterTitleSep'] =
            new AwesomePosts\Controls\AfterTitleSep($this);

        parent::add($wp_customizer);
    }
}
