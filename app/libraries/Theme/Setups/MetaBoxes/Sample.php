<?php
declare (strict_types = 1);

namespace My\Theme\Setups\MetaBoxes;

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

        $this->id = 'my-theme-sample';
        $this->context = 'side';
    }

    public function run()
    {
        \add_action('add_meta_boxes', [$this, 'add'], 10, 2);
        \add_action('save_post', [$this, 'save']);
        \add_action('edit_attachment', [$this, 'save']);
    }

    /**
     * @return mixed[string]
     */
    protected function box(WP_Post $post): array
    {
        if (!\current_user_can('edit_others_posts')) {
            return [];
        }

        if ('post' !== $post->post_type) {
            return [];
        }

        return [
            'id' => $this->id,
            'context' => $this->context,
            'title' => \esc_html__('Sample Meta Box', 'my-theme'),
            'priority' => 'default',
            'callbackArgs' => ['__block_editor_compatible_meta_box' => true],
            'fields' => [
                [
                    'id' => 'sample-text-field',
                    'type' => 'text',
                    'label' => \esc_html__('Type anything', 'my-theme'),
                    'labelPos' => 'before_field',
                ],
                [
                    'id' => 'sample-select-field',
                    'type' => 'select',
                    'choices' => ['a' => 'A', 'b' => 'B', 'c' => 'C'],
                    'label' => \esc_html__('Select any', 'my-theme'),
                    'labelPos' => 'before_field',
                ],
            ],
            'notes' => '<p>'.\esc_html__(
                'This is just an example meta box.',
                'my-theme'
            ).'</p>',
        ];
    }
}
