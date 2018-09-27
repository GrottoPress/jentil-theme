<?php
declare (strict_types = 1);

namespace My\Theme\Utilities;

use My\Theme\Utilities;
use My\Theme\AbstractTestCase;
use GrottoPress\Jentil\AbstractChildTheme;
use GrottoPress\Jentil\AbstractTheme;
use GrottoPress\Jentil\Utilities as JUtilities;
use GrottoPress\Jentil\Utilities\FileSystem as JFileSystem;
use Codeception\Util\Stub;
use tad\FunctionMocker\FunctionMocker;

class FileSystemTest extends AbstractTestCase
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
        FunctionMocker::replace(
            'get_stylesheet_directory',
            '/var/www/themes/my-theme'
        );

        FunctionMocker::replace(
            'get_stylesheet_directory_uri',
            'http://my.site/themes/my-theme'
        );

        $theme = new class extends AbstractChildTheme {
            public $parent;

            function __construct()
            {
            }
        };

        $theme->parent = new class ($parent_is) extends AbstractTheme {
            private $mode;

            function __construct($mode)
            {
                $this->mode = $mode;
            }

            function is(string $mode): bool
            {
                return ($this->mode === $mode);
            }
        };

        $theme->parent->utilities = Stub::makeEmpty(JUtilities::class);
        $theme->parent->utilities->fileSystem = Stub::makeEmpty(
            JFileSystem::class,
            ['themeDir' => (
                'path' === $type ?
                "/var/www/my-theme{$append}" :
                "http://my.site/my-theme{$append}"
            )]
        );

        $utilities = Stub::makeEmpty(Utilities::class);
        $utilities->app = $theme;

        $fileSystem = new FileSystem($utilities);

        $this->assertSame($expected, $fileSystem->themeDir($type, $append));
    }

    public function themeDirProvider(): array
    {
        return [
            'parent is package, type is path' => [
                'path',
                '/hi',
                'package',
                '/var/www/my-theme/hi',
            ],
            'parent is theme, type is path' => [
                'path',
                '/hi',
                'theme',
                '/var/www/themes/my-theme/hi',
            ],
            'parent is package, type is url' => [
                'url',
                '/hello',
                'package',
                'http://my.site/my-theme/hello',
            ],
            'parent is theme, type is url' => [
                'url',
                '/hello',
                'theme',
                'http://my.site/themes/my-theme/hello',
            ]
        ];
    }
}
