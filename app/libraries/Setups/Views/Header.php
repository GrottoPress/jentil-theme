<?php

/**
 * Header
 *
 * @package Jentil\Theme\Setups\Views
 *
 * @see GrottoPress\Jentil\Setups\Views\Header
 */

declare (strict_types = 1);

namespace Jentil\Theme\Setups\Views;

use GrottoPress\Jentil\Setups\AbstractSetup;

/**
 * Header
 */
final class Header extends AbstractSetup
{
    /**
     * Run setup
     */
    public function run()
    {
        // \add_action('init', [$this, 'removeComponents']);
        \add_action('jentil_inside_header', [$this, 'renderLogo'], 8);
    }

    /**
     * Remove components
     *
     * @action init
     */
    public function removeComponents()
    {
        \remove_action(
            'jentil_inside_header',
            [$this->app->parent->setups['Views\Header'], 'renderMenu']
        );

        \remove_action(
            'jentil_inside_header',
            [$this->app->parent->setups['Views\Header'], 'renderMenuToggle']
        );
    }

    /**
     * Render logo
     *
     * @action jentil_inside_header
     */
    public function renderLogo()
    {
        \the_custom_logo();
    }
}
