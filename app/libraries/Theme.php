<?php
declare (strict_types = 1);

namespace My;

use My\Theme\Setups;
use My\Theme\Utilities;
use GrottoPress\Jentil\AbstractChildTheme;

/*
|---------------------------------------------------------------
| Main theme class
|---------------------------------------------------------------
|
| This is where you create your setup instances, ready for running
| in your theme's function.php
|
| @see GrottoPress\Jentil\AbstractChildTheme
| @see GrottoPress\Jentil
|
*/

final class Theme extends AbstractChildTheme
{
    /**
     * @var Utilities
     */
    private $utilities;

    /**
     * @var string[string]
     */
    private $meta;

    protected function __construct()
    {
        $this->setUpMisc();
        $this->setUpTranslations();
        // $this->setUpThemeMods();
        $this->setUpMetaBoxes();
        // $this->setUpThumbnails();
        $this->setUpStyles();
        $this->setUpScripts();
        // $this->setUpSidebars();
        // $this->setUpPostTypeTemplates();
        $this->setUpViews();
    }

    protected function getUtilities(): Utilities
    {
        return $this->utilities = $this->utilities ?: new Utilities($this);
    }

    /**
     * @return string[string]
     */
    protected function getMeta(): array
    {
        return $this->meta = $this->meta ?: $this->meta();
    }

    private function setUpMisc()
    {
        $this->setups['Customizer'] = new Setups\Customizer($this);
        // $this->setups['Background'] = new Setups\Background($this);
        // $this->setups['FeaturedImage'] = new Setups\FeaturedImage($this);
        $this->setups['Logo'] = new Setups\Logo($this);
    }

    private function setUpTranslations()
    {
        $this->setups['Translations\Core'] =
            new Setups\Translations\Core($this);
    }

    private function setUpThemeMods()
    {
        $this->setups['ThemeMods\Footer'] = new Setups\ThemeMods\Footer($this);
    }

    private function setUpMetaBoxes()
    {
        // $this->setups['MetaBoxes\Sample'] =
        //     new Setups\MetaBoxes\Sample($this);
        $this->setups['MetaBoxes\Featured'] =
            new Setups\MetaBoxes\Featured($this);
    }

    private function setUpThumbnails()
    {
        $this->setups['Thumbnails\Micro'] = new Setups\Thumbnails\Micro($this);
        $this->setups['Thumbnails\Small'] = new Setups\Thumbnails\Small($this);
    }

    private function setUpStyles()
    {
        $this->setups['Styles\Core'] = new Setups\Styles\Core($this);
        $this->setups['Styles\Gutenberg'] = new Setups\Styles\Gutenberg($this);
    }

    private function setUpScripts()
    {
        $this->setups['Scripts\Core'] = new Setups\Scripts\Core($this);
        $this->setups['Scripts\CustomizePreview'] =
            new Setups\Scripts\CustomizePreview($this);
    }

    private function setUpSidebars()
    {
        $this->setups['Sidebars\Tertiary'] =
            new Setups\Sidebars\Tertiary($this);
        $this->setups['Sidebars\Secondary'] =
            new Setups\Sidebars\Secondary($this);
    }

    private function setUpPostTypeTemplates()
    {
        $this->setups['PostTypeTemplates\Sample'] =
            new Setups\PostTypeTemplates\Sample($this);
        $this->setups['PostTypeTemplates\PageBuilderBlank'] =
            new Setups\PostTypeTemplates\PageBuilderBlank($this);
    }

    private function setUpViews()
    {
        $this->setups['Views\Header'] = new Setups\Views\Header($this);
        $this->setups['Views\Page'] = new Setups\Views\Page($this);
        $this->setups['Views\Footer'] = new Setups\Views\Footer($this);
    }

    /**
     * @return string[string]
     */
    private function meta(): array
    {
        $meta = \array_map('sanitize_text_field', \get_file_data(
            $this->getUtilities()->fileSystem->themeDir('path', '/style.css'),
            [
                'name' => 'Theme Name',
                'theme_uri' => 'Theme URI',
                'description' => 'Description',
                'author' => 'Author',
                'author_uri' => 'Author URI',
                'version' => 'Version',
                'license' => 'License',
                'license_uri' => 'License URI',
                'tags' => 'Tags',
                'text_domain' => 'Text Domain',
                'domain_path' => 'Domain Path',
                'documents_uri' => 'Documents URI',
            ],
            'theme'
        ));

        $meta['slug'] = \sanitize_title($meta['name']);

        return $meta;
    }
}
