<?php
declare (strict_types = 1);

namespace My\Theme\Setups\Views;

use My\Theme\AbstractTestCase;
use GrottoPress\Jentil\AbstractChildTheme;
use Codeception\Util\Stub;
use tad\FunctionMocker\FunctionMocker;

class HeaderTest extends AbstractTestCase
{
    public function testRun()
    {
        $add_action = FunctionMocker::replace('add_action');

        $header = new Header(Stub::makeEmpty(AbstractChildTheme::class));

        $header->run();

        $add_action->wasCalledTimes(2);

        $add_action->wasCalledWithOnce([
            'jentil_inside_header',
            [$header, 'renderLogo'],
            8
        ]);

        $add_action->wasCalledWithOnce([
            'jentil_after_after_header',
            [$header, 'renderSample'],
            8
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
