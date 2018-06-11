<?php
declare (strict_types = 1);

namespace Jentil\Theme\Setups;

use Codeception\Util\Stub;
use Jentil\Theme\AbstractTestCase;
use GrottoPress\Jentil\AbstractChildTheme;
use GrottoPress\Jentil\AbstractTheme;
use tad\FunctionMocker\FunctionMocker;

class ThumbnailTest extends AbstractTestCase
{
    public function testRun()
    {
        $add_action = FunctionMocker::replace('add_action');

        $thumbnails = new Thumbnail(Stub::makeEmpty(AbstractChildTheme::class));

        $thumbnails->run();

        $add_action->wasCalledOnce();
        $add_action->wasCalledWithOnce([
            'after_setup_theme',
            [$thumbnails, 'addSizes']
        ]);
    }

    public function testAddSizes()
    {
        $add_size = FunctionMocker::replace('add_image_size');

        $thumbnails = new Thumbnail(Stub::makeEmpty(AbstractChildTheme::class));

        $thumbnails->addSizes();

        $add_size->wasCalledTimes(3);
        $add_size->wasCalledWithOnce(['large-thumb', 240, 200, true]);
        $add_size->wasCalledWithOnce(['medium-thumb', 200, 150, true]);
        $add_size->wasCalledWithOnce(['small-thumb', 150, 150, true]);
    }
}
