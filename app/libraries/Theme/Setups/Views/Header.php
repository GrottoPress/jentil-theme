<?php
declare (strict_types = 1);

namespace Jentil\Theme\Setups\Views;

use GrottoPress\Jentil\Setups\AbstractSetup;

/*
|----------------------------------------------------------------------
| Header Setup
|----------------------------------------------------------------------
|
| @see GrottoPress\Jentil\Setups\Views\Header
|
*/

final class Header extends AbstractSetup
{
    public function run()
    {
        // \add_action('after_setup_theme', [$this, 'removeMenu']);
        \add_action('jentil_inside_header', [$this, 'renderLogo'], 8);
        \add_action('jentil_after_after_header', [$this, 'renderSample'], 8);
    }

    /**
     * @action after_setup_theme
     */
    public function removeMenu()
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
     * @action jentil_inside_header
     */
    public function renderLogo()
    {
        \the_custom_logo();
    }

    /**
     * @action jentil_after_after_header
     */
    public function renderSample()
    {
        $utility = $this->app->utilities->sample;

        if (!$utility->where()) {
            return;
        }

        echo $utility->render();
    }
}
