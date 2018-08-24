<?php
declare (strict_types = 1);

namespace My\Theme\Setups\PostTypeTemplates;

use GrottoPress\Jentil\Setups\PostTypeTemplates\AbstractTemplate;
use GrottoPress\Jentil\AbstractChildTheme;
use WP_Theme;

/*
|-------------------------------------------------------------------------
| Sample Post Type Template Setup
|-------------------------------------------------------------------------
|
| Template slug/filename should be relative to the `app/templates` directory.
|
| REMEMBER to add the template file in `app/templates` directory
|
| @see GrottoPress\Jentil\Setups\PostTypeTemplates\
|
*/

final class Sample extends AbstractTemplate
{
    public function __construct(AbstractChildTheme $theme)
    {
        parent::__construct($theme);

        $this->slug = 'template-file-name-here.php';
    }

    public function run()
    {
        \add_action('wp_loaded', [$this, 'load']);
    }

    /**
     * @action wp_loaded
     */
    public function load()
    {
        $post_types = \get_post_types(['public' => true, 'show_ui' => true]);

        foreach ($post_types as $post_type) {
            \add_filter("theme_{$post_type}_templates", [$this, 'add'], 10, 4);
        }
    }

     /**
     * @param \WP_Post $post
     * @param string[int] $templates
     *
     * @filter theme_{$post_type}_templates
     *
     * @return string[int]
     */
    public function add(
        array $templates,
        WP_Theme $theme = null,
        $post,
        string $post_type
    ): array {
        $templates[$this->slug] = \esc_html__(
            'Sample Template',
            'my-theme'
        );

        return $templates;
    }
}
