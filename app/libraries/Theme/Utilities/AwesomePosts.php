<?php
declare (strict_types = 1);

namespace Jentil\Theme\Utilities;

use Jentil\Theme\Utilities;
use Jentil\Theme\Utilities\ThemeMods\AwesomePosts as AwesomePostsMod;

class AwesomePosts
{
    /**
     * @var Utilities
     */
    private $utilities;

    public function __construct(Utilities $utilities)
    {
        $this->utilities = $utilities;
    }

    public function render(): string
    {
        $out = '';

        if (($number = $this->themeMod('number')->get()) < 1) {
            return $out;
        }

        $args = [
            // 'id' => '',
            'class' => 'layout-grid',
            'title' => [
                'tag' => 'h3',
                'position' => 'side',
                'length' => 12,
                'after' => [
                    'types' => \explode(
                        ',',
                        $this->themeMod('after_title')->get()
                    ),
                    'separator' => $this->themeMod('after_title_sep')->get(),
                ],
            ],
            'excerpt' => [
                'length' => ($this->themeMod('excerpt')->get() ? 16 : 0),
                'more_text' => $this->themeMod('more_text')->get(),
            ],
            'wp_query' => [
                'posts_per_page' => $number,
                'ignore_sticky_posts' => 1,
                'no_found_rows' => true,
                'post_type' => $this->themeMod('post_type')->get(),
                'meta_query' => [
                    [
                        'key' => $this->id(),
                        'value' => 1,
                        'type' => 'UNSIGNED',
                    ],
                ],
            ],
        ];

        if ('page' === $args['wp_query']['post_type']) {
            $args['wp_query']['orderby']['menu_order'] = 'ASC';
        }

        $parent = $this->utilities->app->parent;

        $posts = $parent->utilities->posts($args)->render();

        if (!$posts && !$parent->utilities->page->is('customize_preview')) {
            return $out;
        }

        if (($heading = $this->themeMod('heading')->get()) ||
            $parent->utilities->page->is('customize_preview')
        ) {
            $out .= '<h2 class="posts-heading heading" itemprop="name">'.
                $heading.
            '</h2>';
        }

        return '<div id="awesome-posts" class="inner">'
            .$out.$posts.
        '</div>';
    }

    public function themeMod(string $setting): AwesomePostsMod
    {
        return $this->utilities->themeMods->awesomePosts($setting);
    }

    public function id(): string
    {
        return '_jentil-theme-awesome-posts';
    }

    public function where(): bool
    {
        $page = $this->utilities->app->parent->utilities->page;

        return ($page->is('front_page') /*&& $page->is('page')*/);
    }

    /**
     * @return string[string]
     */
    public function postTypes(): array
    {
        $types = \get_post_types(['public' => true], 'objects');

        $return = \array_combine(
            \array_map(function ($type): string {
                return $type->name;
            }, $types),
            \array_map(function ($type): string {
                return $type->labels->singular_name;
            }, $types)
        );

        return \array_filter($return, function (string $type): bool {
            return \post_type_supports($type, 'thumbnail');
        }, ARRAY_FILTER_USE_KEY);
    }
}
