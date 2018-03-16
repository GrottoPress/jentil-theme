<?php
declare (strict_types = 1);

namespace Jentil\Theme\Utilities;

/*
|------------------------------------------------------------------------
| File System Utility
|------------------------------------------------------------------------
|
| @see GrottoPress\Jentil\Utilities\FileSystem
|
*/

class FileSystem
{
    /**
     * @var Utilities
     */
    private $utilities;

    public function __construct(Utilities $utilities)
    {
        $this->utilities = $utilities;
    }

    public function themeDir(string $type, string $append = ''): string
    {
        $parent = $this->utilities->app->parent;

        if ($parent->is('package')) {
            return $parent->utilities->fileSystem->themeDir($type, $append);
        }

        $stylesheet = $type === 'path'
            ? \get_stylesheet_directory()
            : \get_stylesheet_directory_uri();

        return $stylesheet.$append;
    }
}
