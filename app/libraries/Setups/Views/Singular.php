<?php

/**
 * Singular
 *
 * @package Jentil\Theme\Setups\Views
 *
 * @see GrottoPress\Jentil\Setups\Views\Singular
 */

declare (strict_types = 1);

namespace Jentil\Theme\Setups\Views;

use GrottoPress\Jentil\Setups\AbstractSetup;

/**
 * Singular
 */
final class Singular extends AbstractSetup
{
    /**
     * Run setup
     */
    public function run()
    {
        \add_action('init', [$this, 'removeComponents']);
        \add_action(
            'jentil_after_after_content',
            [$this, 'renderTertiarySidebar']
        );
    }

    /**
     * Remove components
     *
     * @action init
     */
    public function removeComponents()
    {
        \remove_action(
            'jentil_after_content',
            [$this->app->parent->setups['Views\Singular'], 'renderRelatedPosts']
        );
    }

    /**
     * Render tertiary widget area
     *
     * @action jentil_after_after_content
     */
    public function renderTertiarySidebar()
    {
        if (!$this->app->parent->utilities->page->is('singular')) {
            return;
        }

        if (!\is_active_sidebar('tertiary-widget-area')) {
            return;
        } ?>

        <aside id="tertiary-widget-area" class="widget-area">
            <?php \dynamic_sidebar('tertiary-widget-area'); ?>
        </aside><!-- .widget-area -->
    <?php }
}
