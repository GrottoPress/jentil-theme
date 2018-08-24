<?php
declare (strict_types = 1);

namespace My\Theme\Setups\Views;

use GrottoPress\Jentil\Setups\AbstractSetup;

/*
|----------------------------------------------------------------------
| Footer Setup
|----------------------------------------------------------------------
|
| @see GrottoPress\Jentil\Setups\Views\Footer
|
*/

final class Footer extends AbstractSetup
{
    public function run()
    {
        \add_action('jentil_inside_footer', [$this, 'renderLogo']);
    }

    /**
     * @action jentil_inside_footer
     */
    public function renderLogo()
    {
        echo $this->app->utilities->footer->renderLogo();
    }
}
