<?php

/**
 * Theme
 *
 * @package Jentil\Theme
 *
 * @see GrottoPress\Jentil\Jentil
 * @see GrottoPress\Jentil\AbstractChildTheme
 */

declare (strict_types = 1);

namespace Jentil\Theme;

use Jentil\Theme\Utilities\Utilities;
use GrottoPress\Jentil\AbstractChildTheme;

/**
 * Theme
 */
final class Theme extends AbstractChildTheme
{
    /**
     * Utilities
     *
     * @var Utilities
     */
    private $utilities = null;

    /**
     * Constructor
     */
    protected function __construct()
    {
        $this->setups['Language'] = new Setups\Language($this);
        // $this->setups['Background'] = new Setups\Background($this);
        $this->setups['Styles'] = new Setups\Styles($this);
        $this->setups['Scripts'] = new Setups\Scripts($this);
        $this->setups['Thumbnails'] = new Setups\Thumbnails($this);
        $this->setups['Logo'] = new Setups\Logo($this);
        // $this->setups['Customizer\Customizer'] =
        //     new Setups\Customizer\Customizer($this);
        // $this->setups['Metaboxes'] = new Setups\Metaboxes($this);

        // $this->setups['Sidebars\Tertiary'] =
        //     new Setups\Sidebars\Tertiary($this);

        // $this->setups['PostTypeTemplates\SamplePostTypeTemplate'] =
        //     new Setups\PostTypeTemplates\SamplePostTypeTemplate($this);

        // $this->setups['PostTypeTemplates\PageBuilderBlank'] =
        //     new Setups\PostTypeTemplates\PageBuilderBlank($this);

        $this->setups['Views\Header'] = new Setups\Views\Header($this);
        // $this->setups['Views\Singular'] = new Setups\Views\Singular($this);
    }

    /**
     * Get utilities
     */
    protected function getUtilities(): Utilities
    {
        if (null === $this->utilities) {
            $this->utilities = new Utilities($this);
        }

        return $this->utilities;
    }
}
