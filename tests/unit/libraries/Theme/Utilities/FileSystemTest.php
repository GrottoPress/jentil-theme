<?php
declare (strict_types = 1);

namespace My\Theme\Utilities;

use My\Theme\AbstractTestCase;
use GrottoPress\Jentil\AbstractChildTheme;
use GrottoPress\Jentil\AbstractTheme;
use GrottoPress\Jentil\Utilities as JUtilities;
use GrottoPress\Jentil\Utilities\FileSystem as JFileSystem;
use Codeception\Util\Stub;
use tad\FunctionMocker\FunctionMocker;

class LanguageTest extends AbstractTestCase
{
    /**
     * @dataProvider themeDirProvider
     */
    public function testThemeDir(
        string $type,
        string $append,
        string $parent_is,
        string $expected
    ) {
        $this->markTestSkipped();

        FunctionMocker::replace(
            'get_stylesheet_directory',
            '/var/www/themes/my-theme'
        );

        FunctionMocker::replace(
            'get_stylesheet_directory_uri',
            'http://my.site/themes/my-theme'
        );

        $utilities = Stub::makeEmpty(Utilities::class);
        $utilities->app = Stub::makeEmpty(AbstractChildTheme::class, [
            'parent' => Stub::makeEmpty(AbstractTheme::class, [
                'utilities' => Stub::makeEmpty(JUtilities::class, [
                    'fileSystem' => Stub::makeEmpty(JFileSystem::class, [
                        'themeDir' => (
                            'path' === $type ?
                            "/var/www/my-theme{$append}" :
                            "http://my.site/my-theme{$append}"
                        ),
                    ]),
                ]),
                'is' => function (string $mode) use ($parent_is): bool {
                    return ($parent_is === $mode);
                }
            ]),
        ]);

        $fileSystem = new FileSystem($utilities);

        $this->assertSame($expected, $fileSystem->themeDir($type, $append));
    }

    public function themeDirProvider()
    {
        return [
            'parent is package, type is path' => [
                'path',
                '/hi',
                'package',
                '/var/www/my-theme/hi',
            ]
        ];
    }
}
