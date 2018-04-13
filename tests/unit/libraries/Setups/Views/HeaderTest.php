<?php
declare (strict_types = 1);

namespace Jentil\Theme\Setups\Views;

use Codeception\Util\Stub;
use Jentil\Theme\AbstractTestCase;
use Jentil\Theme\Setups\Views\Header;
use GrottoPress\Jentil\AbstractChildTheme;
use tad\FunctionMocker\FunctionMocker;

class HeaderTest extends AbstractTestCase
{
    public function testRun()
    {
        $add_action = FunctionMocker::replace('add_action');

        $header = new Header(Stub::makeEmpty(AbstractChildTheme::class));

        $header->run();

        $add_action->wasCalledOnce();

        $add_action->wasCalledWithOnce([
            'jentil_inside_header',
            [$header, 'renderLogo']
        ]);
    }

    public function testRenderLogo()
    {
        $the_custom_logo = FunctionMocker::replace('the_custom_logo');

        $header = new Header(Stub::makeEmpty(AbstractChildTheme::class));

        $header->renderLogo();

        $the_custom_logo->wasCalledOnce();
    }
}
