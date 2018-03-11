<?php
declare (strict_types = 1);

namespace Jentil\Theme\Setups\MetaBoxes;

use GrottoPress\Jentil\Setups\MetaBoxes\AbstractMetaBox;
use GrottoPress\Jentil\AbstractChildTheme;
use WP_Post;

/*
|------------------------------------------------------------
| Sample Meta Box Setup
|------------------------------------------------------------
|
| @see GrottoPress\Jentil\Setups\Metaboxes\
|
*/

final class Sample extends AbstractMetaBox
{
    public function __construct(AbstractChildTheme $theme)
    {
        parent::__construct($theme);

        $this->id = 'jentil-theme-sample-meta-box';
        $this->context = 'side';
    }

    public function run()
    {
        \add_action('add_meta_boxes', [$this, 'add'], 10, 2);
        \add_action('save_post', [$this, 'save']);
        \add_action('edit_attachment', [$this, 'save']);
    }

    /**
     * @action add_meta_boxes
     */
    public function add(string $post_type, WP_Post $post)
    {
        if (!($box = $this->box($post))) {
            return;
        }

        $this->app->parent->utilities->metaBox($box)->add();
    }

    /**
     * @action save_post
     * @action edit_attachment
     */
    public function save(int $post_id)
    {
        if (!($box = $this->box(\get_post($post_id)))) {
            return;
        }

        $this->app->parent->utilities->metaBox($box)->save($post_id);
    }

    private function box(WP_Post $post): array
    {
        if (!\current_user_can('edit_others_posts')) {
            return [];
        }

        if ('post' !== $post->post_type) {
            return [];
        }

        return [
            'id' => 'sample-meta-box',
            'title' => \esc_html__('Sample Meta Box', 'jentil-theme'),
            'context' => 'side',
            'priority' => 'default',
            'callback' => '',
            'fields' => [
                [
                    'id' => 'sample-text-field',
                    'type' => 'text',
                    'label' => \esc_html__('Type anything', 'jentil-theme'),
                    'labelPos' => 'before_field',
                ],
                [
                    'id' => 'sample-select-field',
                    'type' => 'select',
                    'choices' => ['a' => 'A', 'b' => 'B', 'c' => 'C'],
                    'label' => \esc_html__('Select any', 'jentil-theme'),
                    'labelPos' => 'before_field',
                ],
            ],
            'notes' => '<p>'.\esc_html__(
                'This is just an example meta box.',
                'jentil-theme'
            ).'</p>',
        ];
    }
}
