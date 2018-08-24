<?php
declare (strict_types = 1);

namespace My\Theme\Setups;

use My\Theme\AbstractTestCase;
use My\Theme\Utilities;
use My\Theme\Utilities\FileSystem;
use GrottoPress\Jentil\AbstractChildTheme;
use Codeception\Util\Stub;
use tad\FunctionMocker\FunctionMocker;

class LanguageTest extends AbstractTestCase
{
    public function testRun()
    {
        $add_action = FunctionMocker::replace('add_action');

        $language = new Language(Stub::makeEmpty(AbstractChildTheme::class));

        $language->run();

        $add_action->wasCalledOnce();

        $add_action->wasCalledWithOnce([
            'after_setup_theme',
            [$language, 'loadTextDomain']
        ]);
    }

    public function testLoadTextDomain()
    {
        $load = FunctionMocker::replace('load_theme_textdomain');

        $theme = Stub::makeEmpty(AbstractChildTheme::class, [
            'utilities' => Stub::makeEmpty(Utilities::class),
        ]);

        $theme->utilities->fileSystem = Stub::makeEmpty(FileSystem::class, [
            'themeDir' => function (string $type, string $append) {
                return "/var/www/themes/my-theme{$append}";
            }
        ]);

        $language = new Language($theme);

        $language->loadTextDomain();

        $load->wasCalledOnce();
        $load->wasCalledWithOnce([
            'my-theme',
            '/var/www/themes/my-theme/languages'
        ]);
    }
}
