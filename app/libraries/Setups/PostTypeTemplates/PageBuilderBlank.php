<?php

/**
 * Page builder (blank)
 *
 * An example of how to remove a post type template added
 * by Jentil. In this case, we're removing the
 * `page-builder-blank.php` template.
 *
 * @package Jentil\Theme\Setups\PostTypeTemplates
 */

declare (strict_types = 1);

namespace Jentil\Theme\Setups\PostTypeTemplates;

use GrottoPress\Jentil\Setups\PostTypeTemplates\AbstractTemplate;
use WP_Theme;

/**
 * Page builder (blank)
 */
final class PageBuilderBlank extends AbstractTemplate
{
    /**
     * Add template
     *
     * @param array $templates
     * @param WP_Theme $theme
     * @param \WP_Post $post
     * @param string $post_type
     *
     * @filter theme_{$post_type}_templates
     */
    public function add(
        array $templates,
        WP_Theme $theme = null,
        $post,
        string $post_type
    ): array {
        unset($templates['page-builder-blank.php']);

        return $templates;
    }
}
