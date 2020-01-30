<?php

/**
 * NOTE: Keep code in this file compatible with PHP 5.2
 */

define('MY_THEME_MIN_PHP', '7.0');
define('MY_THEME_MIN_WP', '4.7');

if (version_compare(PHP_VERSION, MY_THEME_MIN_PHP, '<') ||
    version_compare(get_bloginfo('version'), MY_THEME_MIN_WP, '<')
) {
    add_action('admin_notices', 'printMyThemeReqNotice');

    deactivateMyTheme();
} else {
    require __DIR__.'/vendor/autoload.php';

    add_action('after_setup_theme', 'runMyTheme', 2);
}

function runMyTheme()
{
    MyTheme()->run();
}

function printMyThemeReqNotice()
{
    echo '<div class="notice notice-error">
        <p>'.
        sprintf(
            esc_html__(
                '%1$s theme has been deactivated as it requires PHP >= %2$s and WordPress >= %3$s',
                'jentil-theme'
            ),
            '<code>jentil-theme</code>',
            '<strong>'.MY_THEME_MIN_PHP.'</strong>',
            '<strong>'.MY_THEME_MIN_WP.'</strong>'
        ).
        '</p>
    </div>';
}

function deactivateMyTheme()
{
    $themes = wp_get_themes(['allowed' => true]);
    unset($themes['jentil-theme'], $themes['jentil']);

    $theme = reset($themes);
    $name = null === key($themes) ? '' : $theme->get_stylesheet();
    $parent = $name ? $theme->get_template() : '';

    update_option('stylesheet', $name);
    update_option('template', $parent);
}
