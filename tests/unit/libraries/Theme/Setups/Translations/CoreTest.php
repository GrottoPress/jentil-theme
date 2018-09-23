<?php
declare (strict_types = 1);

namespace My\Theme\Setups\Translations;

use My\Theme\AbstractTestCase;
use My\Theme\Utilities;
use My\Theme\Utilities\FileSystem;
use GrottoPress\Jentil\AbstractChildTheme;
use Codeception\Util\Stub;
use tad\FunctionMocker\FunctionMocker;

class CoreTest extends AbstractTestCase
{
    public function testRun()
    {
        $add_action = FunctionMocker::replace('add_action');

        $translation = new Core(Stub::makeEmpty(AbstractChildTheme::class, [
            'theme' => new class {
                function get()
                {
                    return 'my-theme';
                }
            }
        ]));

        $translation->run();

        $add_action->wasCalledOnce();

        $add_action->wasCalledWithOnce([
            'after_setup_theme',
            [$translation, 'loadTextDomain']
        ]);
    }

    public function testLoadTextDomain()
    {
        $load = FunctionMocker::replace('load_theme_textdomain');

        $theme = Stub::makeEmpty(AbstractChildTheme::class, [
            'utilities' => Stub::makeEmpty(Utilities::class),
            'theme' => new class {
                function get()
                {
                    return 'my-theme';
                }
            }
        ]);

        $theme->utilities = Stub::makeEmpty(Utilities::class);
        $theme->utilities->fileSystem = Stub::makeEmpty(FileSystem::class, [
            'themeDir' => function (string $type, string $append) {
                return "/var/www/themes/my-theme{$append}";
            }
        ]);

        $translation = new Core($theme);

        $translation->loadTextDomain();

        $load->wasCalledOnce();
        $load->wasCalledWithOnce([
            $translation->textDomain,
            '/var/www/themes/my-theme/lang'
        ]);
    }
}
