<?php
declare (strict_types = 1);

namespace Jentil\Theme\Setups\Scripts;

use Codeception\Util\Stub;
use Jentil\Theme\AbstractTestCase;
use GrottoPress\Jentil\AbstractChildTheme;
use tad\FunctionMocker\FunctionMocker;

class ScriptTest extends AbstractTestCase
{
    public function testRun()
    {
        $add_action = FunctionMocker::replace('add_action');

        $scripts = new Script(Stub::makeEmpty(AbstractChildTheme::class));

        $scripts->run();

        $add_action->wasCalledOnce();

        $add_action->wasCalledWithOnce([
            'wp_enqueue_scripts',
            [$scripts, 'enqueue']
        ]);
    }

    public function testEnqueue()
    {
        $wp_enqueue_script = FunctionMocker::replace('wp_enqueue_script');
        $template_uri = FunctionMocker::replace(
            'get_template_directory_uri',
            'http://my.site/themes/my-theme'
        );

        $scripts = new Script(Stub::makeEmpty(AbstractChildTheme::class));

        $scripts->enqueue();

        $wp_enqueue_script->wasCalledOnce();

        $wp_enqueue_script->wasCalledWithOnce([
            'jentil-theme',
            'http://my.site/themes/my-theme/dist/scripts/theme.min.js',
            ['jquery'],
            '',
            true
        ]);
    }
}
