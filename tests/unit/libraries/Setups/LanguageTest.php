<?php
declare (strict_types = 1);

namespace Jentil\Theme\Setups;

use Codeception\Util\Stub;
use Jentil\Theme\AbstractTestCase;
use GrottoPress\Jentil\AbstractChildTheme;
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
        $template_dir = FunctionMocker::replace(
            'get_template_directory',
            '/var/www/themes/my-theme'
        );

        $language = new Language(Stub::makeEmpty(AbstractChildTheme::class));

        $language->loadTextDomain();

        $load->wasCalledOnce();

        $load->wasCalledWithOnce([
            'jentil-theme',
            '/var/www/themes/my-theme/languages'
        ]);
    }
}
