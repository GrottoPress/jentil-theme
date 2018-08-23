<?php
declare (strict_types = 1);

namespace Jentil;

use Jentil\Theme\Setups;
use Jentil\Theme\Utilities;
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
    private $utilities = null;

    protected function __construct()
    {
        $this->setUpMisc();
        // $this->setUpThemeMods();
        $this->setUpMetaBoxes();
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

    private function setUpMisc()
    {
        $this->setups['Language'] = new Setups\Language($this);
        $this->setups['Customizer'] = new Setups\Customizer($this);
        // $this->setups['Background'] = new Setups\Background($this);
        $this->setups['Thumbnail'] = new Setups\Thumbnail($this);
        $this->setups['Logo'] = new Setups\Logo($this);
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

    private function setUpStyles()
    {
        $this->setups['Styles\Style'] = new Setups\Styles\Style($this);
    }

    private function setUpScripts()
    {
        $this->setups['Scripts\Script'] = new Setups\Scripts\Script($this);
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
