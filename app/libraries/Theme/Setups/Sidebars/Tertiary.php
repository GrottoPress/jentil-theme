<?php
declare (strict_types = 1);

namespace My\Theme\Setups\Sidebars;

use GrottoPress\Jentil\Setups\Sidebars\AbstractSidebar;
use GrottoPress\Jentil\AbstractChildTheme;

/*
|-----------------------------------------------------------------
| Just an example sidebar setup
|-----------------------------------------------------------------
|
| @see GrottoPress\Jentil\Setups\Sidebars\
|
*/

final class Tertiary extends AbstractSidebar
{
    public function __construct(AbstractChildTheme $theme)
    {
        parent::__construct($theme);

        $this->id = 'tertiary-widget-area';
    }

    public function run()
    {
        \add_action('widgets_init', [$this, 'register']);
    }

    /**
     * @action widgets_init
     */
    public function register()
    {
        \register_sidebar([
            'name'          => \esc_html__('Tertiary', 'my-theme'),
            'id'            => $this->id,
            'description'   => \esc_html__(
                'Tertiary widget area',
                'my-theme'
            ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ]);
    }
}
