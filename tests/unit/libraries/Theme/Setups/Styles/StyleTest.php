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

class StyleTest extends AbstractTestCase
{
    public function testRun()
    {
        $add_action = FunctionMocker::replace('add_action');

        $theme = new class extends AbstractChildTheme {
            function __construct()
            {
            }

            function get()
            {
                return new class {
                    public $stylesheet;
                };
            }
        };

        $style = new Style($theme);

        $style->run();

        $add_action->wasCalledOnce();

        $add_action->wasCalledWithOnce([
            'wp_enqueue_scripts',
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

        $theme = new class extends AbstractChildTheme {
            public $parent;

            function __construct()
            {
            }

            function get()
            {
                return new class {
                    public $stylesheet = 'my-theme';
                };
            }
        };

        $theme->utilities = Stub::makeEmpty(Utilities::class);
        $theme->parent = Stub::makeEmpty(AbstractTheme::class, [
            'setups' => ['Styles\Style' => new class {
                public $id;
            }],
        ]);

        $theme->utilities->fileSystem = Stub::makeEmpty(FileSystem::class, [
            'themeDir' => function (string $type, string $append): string {
                return "http://my.site/themes/my-theme{$append}";
            }
        ]);

        $style = new Style($theme);

        $style->enqueue();

        $is_rtl->wasCalledOnce();
        $wp_enqueue_style->wasCalledOnce();
        $wp_enqueue_style->wasCalledWithOnce([
            $style->id,
            ($rtl ?
            'http://my.site/themes/my-theme/dist/styles/theme-rtl.min.css'
            : 'http://my.site/themes/my-theme/dist/styles/theme.min.css'),
            [$theme->parent->setups['Styles\Style']->id]
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
