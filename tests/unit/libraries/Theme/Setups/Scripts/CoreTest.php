<?php
declare (strict_types = 1);

namespace My\Theme\Setups\Scripts;

use My\Theme\AbstractTestCase;
use My\Theme\Utilities;
use My\Theme\Utilities\FileSystem;
use GrottoPress\Jentil\AbstractChildTheme;
use GrottoPress\Jentil\AbstractTheme;
use Codeception\Util\Stub;
use tad\FunctionMocker\FunctionMocker;

class CoreTest extends AbstractTestCase
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

        $script = new Core($theme);

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

        $test_js = \codecept_data_dir('scripts/test.js');

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
        $theme->parent = Stub::makeEmpty(AbstractTheme::class);

        $theme->utilities->fileSystem = Stub::makeEmpty(FileSystem::class, [
            'themeDir' => function (
                string $type,
                string $append
            ) use ($test_js): string {
                return 'path' === $type ? $test_js : "http://my.url/test.js";
            },
        ]);

        $script = new Core($theme);

        $script->enqueue();

        $wp_enqueue_script->wasCalledOnce();
        $wp_enqueue_script->wasCalledWithOnce([
            $script->id,
            'http://my.url/test.js',
            ['jquery'],
            \filemtime($test_js),
            true
        ]);
    }
}
