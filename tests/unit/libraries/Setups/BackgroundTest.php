<?php
declare (strict_types = 1);

namespace Jentil\Theme\Setups;

use Codeception\Util\Stub;
use Jentil\Theme\AbstractTestCase;
use GrottoPress\Jentil\AbstractChildTheme;
use tad\FunctionMocker\FunctionMocker;

class BackgroundTest extends AbstractTestCase
{
    public function testRun()
    {
        $add_action = FunctionMocker::replace('add_action');

        $background = new Background(Stub::makeEmpty(AbstractChildTheme::class));

        $background->run();

        $add_action->wasCalledOnce();

        $add_action->wasCalledWithOnce([
            'after_setup_theme',
            [$background, 'addSupport']
        ]);
    }

    public function testAddSupport()
    {
        $add_theme_support = FunctionMocker::replace('add_theme_support');

        $background = new Background(Stub::makeEmpty(AbstractChildTheme::class));

        $background->addSupport();

        $add_theme_support->wasCalledOnce();

        $add_theme_support->wasCalledWithOnce(['custom-background', [
            'default-color' => '#f1f1f1',
        ]]);
    }
}
