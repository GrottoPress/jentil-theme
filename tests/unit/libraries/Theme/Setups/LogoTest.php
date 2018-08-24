<?php
declare (strict_types = 1);

namespace My\Theme\Setups;

use My\Theme\AbstractTestCase;
use GrottoPress\Jentil\AbstractChildTheme;
use Codeception\Util\Stub;
use tad\FunctionMocker\FunctionMocker;

class LogoTest extends AbstractTestCase
{
    public function testRun()
    {
        $add_action = FunctionMocker::replace('add_action');

        $logo = new Logo(Stub::makeEmpty(AbstractChildTheme::class));

        $logo->run();

        $add_action->wasCalledOnce();

        $add_action->wasCalledWithOnce([
            'after_setup_theme',
            [$logo, 'addSupport']
        ]);
    }

    public function testAddSupport()
    {
        $add_theme_support = FunctionMocker::replace('add_theme_support');

        $logo = new Logo(Stub::makeEmpty(AbstractChildTheme::class));

        $logo->addSupport();

        $add_theme_support->wasCalledOnce();

        $add_theme_support->wasCalledWithOnce(['custom-logo', [
            'height' => 30,
            'width' => 160,
            'flex-width' => false,
            'flex-height' => false,
        ]]);
    }
}
