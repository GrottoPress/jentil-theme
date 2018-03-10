<?php
declare (strict_types = 1);

namespace Jentil\Theme\Setups;

use Codeception\Util\Stub;
use Jentil\Theme\AbstractTestCase;
use GrottoPress\Jentil\AbstractChildTheme;
use tad\FunctionMocker\FunctionMocker;

class StylesTest extends AbstractTestCase
{
    public function testRun()
    {
        $add_action = FunctionMocker::replace('add_action');

        $styles = new Styles(Stub::makeEmpty(AbstractChildTheme::class));

        $styles->run();

        $add_action->wasCalledOnce();

        $add_action->wasCalledWithOnce([
            'wp_enqueue_scripts',
            [$styles, 'enqueue'],
            20
        ]);
    }

    /**
     * @dataProvider enqueueProvider
     */
    public function testEnqueue(bool $isRTL)
    {
        $is_rtl = FunctionMocker::replace('is_rtl', $isRTL);
        $wp_enqueue_style = FunctionMocker::replace('wp_enqueue_style');
        $template_uri = FunctionMocker::replace(
            'get_template_directory_uri',
            'http://my.site/themes/my-theme'
        );

        $styles = new Styles(Stub::makeEmpty(AbstractChildTheme::class));

        $styles->enqueue();

        $is_rtl->wasCalledOnce();
        $wp_enqueue_style->wasCalledOnce();

        $wp_enqueue_style->wasCalledWithOnce([
            'jentil-theme',
            ($isRTL ?
            'http://my.site/themes/my-theme/dist/styles/theme-rtl.min.css'
            : 'http://my.site/themes/my-theme/dist/styles/theme.min.css'),
            ['jentil']
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
