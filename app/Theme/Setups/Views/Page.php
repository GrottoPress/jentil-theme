<?php
declare (strict_types = 1);

namespace My\Theme\Setups\Views;

use GrottoPress\Jentil\Setups\AbstractSetup;

final class Page extends AbstractSetup
{
    public function run()
    {
        \add_action('jentil_before_content', [$this, 'renderAwesomePosts']);
    }

    /**
     * @action jentil_before_content
     */
    public function renderAwesomePosts()
    {
        $utility = $this->app->utilities->awesomePosts;

        if (!$utility->where()) {
            return;
        }

        echo $utility->render();
    }
}
