<?php

/**
 * Sample Post Type Template
 *
 * @package Jentil\Theme\Setups\PostTypeTemplates
 */

declare (strict_types = 1);

namespace Jentil\Theme\Setups\PostTypeTemplates;

use GrottoPress\Jentil\Setups\PostTypeTemplates\AbstractTemplate;
use WP_Theme;

/**
 * Sample Post Type Template
 */
final class SamplePostTypeTemplate extends AbstractTemplate
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
        /**
         * @todo REMEMBER to add the template file in `app/templates` dir
         */

        $templates['template-file-name-here.php'] = \esc_html__(
            'Sample Template',
            'jentil-theme'
        );

        return $templates;
    }
}
