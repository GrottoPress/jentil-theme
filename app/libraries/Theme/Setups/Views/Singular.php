<?php
declare (strict_types = 1);

namespace My\Theme\Setups\Views;

use GrottoPress\Jentil\Setups\AbstractSetup;

/*
|----------------------------------------------------------------------------
| Example Singular Setup
|----------------------------------------------------------------------------
|
| @see GrottoPress\Jentil\Setups\Views\Singular
|
*/

final class Singular extends AbstractSetup
{
    public function run()
    {
        // \add_action('after_setup_theme', [$this, 'removeRelatedPosts']);
        \add_action(
            'jentil_after_after_content',
            [$this, 'renderTertiarySidebar']
        );
    }

    /**
     * @action after_setup_theme
     */
    public function removeRelatedPosts()
    {
        \remove_action(
            'jentil_after_content',
            [$this->app->parent->setups['Views\Singular'], 'renderRelatedPosts']
        );
    }

    /**
     * @action jentil_after_after_content
     */
    public function renderTertiarySidebar()
    {
        if (!$this->app->parent->utilities->page->is('singular')) {
            return;
        }

        if (!\is_active_sidebar(
            $id = $this->app->setups['Sidebars\Tertiary']->id
        )) {
            return;
        } ?>

        <aside id="tertiary-widget-area" class="widget-area">
            <?php \dynamic_sidebar($id); ?>
        </aside><!-- .widget-area -->
    <?php }
}
