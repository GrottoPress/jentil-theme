<?php
declare (strict_types = 1);

namespace Jentil\Theme\Setups;

use Codeception\Util\Stub;
use Jentil\Theme\AbstractTestCase;
use GrottoPress\Jentil\AbstractChildTheme;
use GrottoPress\Jentil\AbstractTheme;
use tad\FunctionMocker\FunctionMocker;

class ThumbnailsTest extends AbstractTestCase
{
    public function testRun()
    {
        $add_action = FunctionMocker::replace('add_action');

        $thumbnails = new Thumbnails(Stub::makeEmpty(AbstractChildTheme::class));

        $thumbnails->run();

        $add_action->wasCalledOnce();

        $add_action->wasCalledWithOnce([
            'after_setup_theme',
            [$thumbnails, 'addSizes']
        ]);
    }

    public function testRemoveSizes()
    {
        $remove_action = FunctionMocker::replace('remove_action');

        $theme = Stub::makeEmpty(AbstractChildTheme::class, [
            'parent' => Stub::makeEmpty(AbstractTheme::class, [
                'setups' => ['Thumbnails' => true],
            ]),
        ]);

        $thumbnails = new Thumbnails($theme);

        $thumbnails->removeSizes();

        $remove_action->wasCalledOnce();
        $remove_action->wasCalledWithOnce([
            'after_setup_theme',
            [$theme->parent->setups['Thumbnails'], 'setSize']
        ]);
    }

    public function testSetSize()
    {
        $set_thumb_size = FunctionMocker::replace('set_post_thumbnail_size');

        $thumbnails = new Thumbnails(Stub::makeEmpty(AbstractChildTheme::class));

        $thumbnails->setSize();

        $set_thumb_size->wasCalledOnce();
        $set_thumb_size->wasCalledWithOnce([700, 350, true]);
    }

    public function testAddSizes()
    {
        $add_size = FunctionMocker::replace('add_image_size');

        $thumbnails = new Thumbnails(Stub::makeEmpty(AbstractChildTheme::class));

        $thumbnails->addSizes();

        $add_size->wasCalledTimes(3);
        $add_size->wasCalledWithOnce(['large-thumb', 240, 200, true]);
        $add_size->wasCalledWithOnce(['medium-thumb', 200, 150, true]);
        $add_size->wasCalledWithOnce(['small-thumb', 150, 150, true]);
    }
}
