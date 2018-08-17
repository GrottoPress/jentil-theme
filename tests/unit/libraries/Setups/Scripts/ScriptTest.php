<?php
declare (strict_types = 1);

namespace Jentil\Theme\Setups\Scripts;

use Codeception\Util\Stub;
use Jentil\Theme\AbstractTestCase;
use Jentil\Theme\Utilities\Utilities;
use Jentil\Theme\Utilities\FileSystem;
use GrottoPress\Jentil\AbstractChildTheme;
use GrottoPress\Jentil\AbstractTheme;
use tad\FunctionMocker\FunctionMocker;

class ScriptTest extends AbstractTestCase
{
    public function testRun()
    {
        $add_action = FunctionMocker::replace('add_action');

        $script = new Script(Stub::makeEmpty(AbstractChildTheme::class));

        $script->run();

        $add_action->wasCalledOnce();

        $add_action->wasCalledWithOnce([
            'wp_enqueue_scripts',
            [$script, 'enqueue']
        ]);
    }

    public function testEnqueue()
    {
        $wp_enqueue_script = FunctionMocker::replace('wp_enqueue_script');

        $theme = Stub::makeEmpty(AbstractChildTheme::class, [
            'utilities' => Stub::makeEmpty(Utilities::class),
            'parent' => Stub::makeEmpty(AbstractTheme::class, [
                'setups' => ['Scripts\Script' => new class {
                    public $id;
                }],
            ]),
        ]);

        $theme->utilities->fileSystem = Stub::makeEmpty(FileSystem::class, [
            'themeDir' => function (string $type, string $append): string {
                return "http://my.site/themes/my-theme{$append}";
            }
        ]);

        $script = new Script($theme);

        $script->enqueue();

        $wp_enqueue_script->wasCalledOnce();
        $wp_enqueue_script->wasCalledWithOnce([
            $script->id,
            'http://my.site/themes/my-theme/dist/scripts/theme.min.js',
            ['jquery'],
            '',
            true
        ]);
    }
}
