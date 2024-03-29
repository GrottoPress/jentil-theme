<?php
declare (strict_types = 1);

namespace My\Theme\Setups\MetaBoxes;

use GrottoPress\Jentil\Setups\MetaBoxes\AbstractMetaBox;
use GrottoPress\Jentil\AbstractChildTheme;
use WP_Post;

final class Featured extends AbstractMetaBox
{
    public function __construct(AbstractChildTheme $theme)
    {
        parent::__construct($theme);

        $this->id = "{$this->app->meta['slug']}-featured";
        $this->context = 'side';
    }

    public function run()
    {
        \add_action('add_meta_boxes', [$this, 'add'], 10, 2);
        \add_action('save_post', [$this, 'save']);
        \add_action('edit_attachment', [$this, 'save']);
    }

    /**
     * @return array<string, mixed>
     */
    protected function box(WP_Post $post): array
    {
        if (!\current_user_can('edit_others_posts')) {
            return [];
        }

        if ((int)$post->ID === (int)\get_option('page_on_front') &&
            'page' === \get_option('show_on_front')
        ) {
            return [];
        }

        $fields = [];
        $utilities = $this->app->utilities;

        if ($post->post_type ===
            $utilities->themeMods->awesomePosts('post_type')->get()
        ) {
            $fields[] = [
                'id' => $utilities->awesomePosts->id(),
                'type' => 'checkbox',
                'label' => \esc_html__('Add to Awesome Posts', 'jentil-theme'),
            ];
        }

        if ($fields) {
            return [
                'id' => $this->id,
                'context' => $this->context,
                'title' => \esc_html__('Featured', 'jentil-theme'),
                'priority' => 'default',
                'callbackArgs' => ['__block_editor_compatible_meta_box' => true],
                'fields' => $fields,
            ];
        }

        return [];
    }
}
