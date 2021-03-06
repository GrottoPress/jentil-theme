<?php
declare (strict_types = 1);

namespace My\Theme\Setups\Styles;

use My\Theme\AbstractTestCase;
use My\Theme\Utilities;
use My\Theme\Utilities\FileSystem;
use GrottoPress\Jentil\AbstractChildTheme;
use GrottoPress\Jentil\AbstractTheme;
use Codeception\Util\Stub;
use tad\FunctionMocker\FunctionMocker;

class GutenbergTest extends AbstractTestCase
{
    public function testRun()
    {
        $add_action = FunctionMocker::replace('add_action');

        $style = new Gutenberg(Stub::makeEmpty(AbstractChildTheme::class, [
            'meta' => ['slug' => 'theme'],
        ]));

        $style->run();

        $add_action->wasCalledOnce();

        $add_action->wasCalledWithOnce([
            'enqueue_block_editor_assets',
            [$style, 'enqueue'],
            20
        ]);
    }

    /**
     * @dataProvider enqueueProvider
     */
    public function testEnqueue(bool $rtl)
    {
        $is_rtl = FunctionMocker::replace('is_rtl', $rtl);
        $wp_enqueue_style = FunctionMocker::replace('wp_enqueue_style');

        $test_css = \codecept_data_dir('styles/test.css');

        $theme = new class extends AbstractChildTheme {
            public $utilities;
            public $parent;
            public $meta = ['slug' => 'theme'];

            function __construct()
            {
                $this->utilities = Stub::makeEmpty(Utilities::class);
                $this->parent = Stub::makeEmpty(AbstractTheme::class, [
                    'setups' => ['Styles\Gutenberg' => new class {
                        public $id;
                    }],
                ]);
            }
        };

        $theme->utilities->fileSystem = Stub::makeEmpty(FileSystem::class, [
            'themeDir' => function (
                string $type,
                string $append
            ) use ($test_css): string {
                return 'path' === $type ? $test_css : "http://my.url{$append}";
            },
        ]);

        $style = new Gutenberg($theme);

        $style->enqueue();

        // $is_rtl->wasCalledOnce();
        $wp_enqueue_style->wasCalledOnce();
        $wp_enqueue_style->wasCalledWithOnce([
            $style->id,
            (
                $rtl ?
                'http://my.url/dist/styles/gutenberg-rtl.min.css' :
                'http://my.url/dist/styles/gutenberg.min.css'
            ),
            [$theme->parent->setups['Styles\Gutenberg']->id],
            \filemtime($test_css),
        ]);
    }

    public function enqueueProvider()
    {
        return [
            'is RTL' => [true],
            'is LTR' => [false],
        ];
    }
}
