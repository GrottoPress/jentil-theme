<?php
declare (strict_types = 1);

namespace Jentil\Theme\Setups\Styles;

use Jentil\Theme\AbstractTestCase;
use Jentil\Theme\Utilities;
use Jentil\Theme\Utilities\FileSystem;
use GrottoPress\Jentil\AbstractChildTheme;
use GrottoPress\Jentil\AbstractTheme;
use Codeception\Util\Stub;
use tad\FunctionMocker\FunctionMocker;

class StyleTest extends AbstractTestCase
{
    public function testRun()
    {
        $add_action = FunctionMocker::replace('add_action');

        $style = new Style(Stub::makeEmpty(AbstractChildTheme::class));

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

        $theme = Stub::makeEmpty(AbstractChildTheme::class, [
            'utilities' => Stub::makeEmpty(Utilities::class),
            'parent' => Stub::makeEmpty(AbstractTheme::class, [
                'setups' => ['Styles\Style' => new class {
                    public $id;
                }],
            ]),
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
