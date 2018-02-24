<?php

/**
 * Metaboxes
 *
 * @package Jentil\Theme\Setups
 *
 * @see GrottoPress\Jentil\Setups\Metaboxes
 */

declare (strict_types = 1);

namespace Jentil\Theme\Setups;

use GrottoPress\Jentil\Setups\AbstractSetup;
use GrottoPress\WordPress\Metaboxes\MetaboxesTrait;
use WP_Post;

/**
 * Metaboxes
 */
final class Metaboxes extends AbstractSetup
{
    use MetaboxesTrait;

    /**
     * Run setup
     *
     * @since 0.1.0
     * @access public
     */
    public function run()
    {
        $this->setup();
    }

    /**
     * Meta boxes
     *
     * @param WP_Post $post
     *
     * @return array
     */
    private function metaboxes(WP_Post $post): array
    {
        $boxes = [];

        if ($sample = $this->sampleMetabox($post)) {
            $boxes[] = $sample;
        }

        /**
         * @filter jentil_metaboxes
         *
         * @var Metaboxes[] $boxes Metaboxes.
         * @var WP_Post $post Post.
         */
        return \apply_filters('jentil_theme_metaboxes', $boxes, $post);
    }

    /**
     * Sample metabox
     *
     * @param WP_Post $post
     *
     * @return array
     */
    private function sampleMetabox(WP_Post $post): array
    {
        if (!\current_user_can('edit_others_posts')) {
            return [];
        }

        if ('post' !== $post->post_type) {
            return [];
        }

        return [
            'id' => 'sample-metabox',
            'title' => \esc_html__('Sample Metabox', 'jentil-theme'),
            'context' => 'side',
            'priority' => 'default',
            'callback' => '',
            'fields' => [
                [
                    'id' => 'sample-text-field',
                    'type' => 'text',
                    'label' => \esc_html__('Type anything', 'jentil-theme'),
                    'label_pos' => 'before_field',
                ],
                [
                    'id' => 'sample-select-field',
                    'type' => 'select',
                    'choices' => ['a' => 'A', 'b' => 'B', 'c' => 'C'],
                    'label' => \esc_html__('Select any', 'jentil-theme'),
                    'label_pos' => 'before_field',
                ],
            ],
            'notes' => '<p>'.\esc_html__(
                'This is just an example metabox.',
                'jentil-theme'
            ).'</p>',
        ];
    }
}
