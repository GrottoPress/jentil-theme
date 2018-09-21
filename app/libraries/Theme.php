<?php
declare (strict_types = 1);

namespace My;

use My\Theme\Setups;
use My\Theme\Utilities;
use GrottoPress\Jentil\AbstractChildTheme;
use WP_Theme;

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
    private $utilities = null;

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
        if (null === $this->utilities) {
            $this->utilities = new Utilities($this);
        }

        return $this->utilities;
    }

    public function get(): WP_Theme
    {
        return \wp_get_theme('my-theme');
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
}
