<?php

/**
 * NOTE: Keep code in this file compatible with PHP 5.2
 */

define('THEME_SLUG', 'my-theme'); // Update as appropriate
define('MINIMUM_PHP', '7.0');
define('MINIMUM_WP', '4.7');

if (version_compare(PHP_VERSION, MINIMUM_PHP, '<') ||
    version_compare(get_bloginfo('version'), MINIMUM_WP, '<')
) {
    add_action('admin_notices', 'printJentilThemeReqNotice');

    deactivateJentilTheme();
} else {
    require __DIR__.'/vendor/autoload.php';

    add_action('after_setup_theme', 'runJentilTheme', 2);
}

function runJentilTheme()
{
    Theme()->run();
}

function printJentilThemeReqNotice()
{
    echo '<div class="notice notice-error">
        <p>'.
        sprintf(
            __(
                '%1$s theme has been deactivated as it requires PHP >= %2$s and WordPress >= %3$s'
            ),
            '<code>'.THEME_SLUG.'</code>',
            '<strong>'.MINIMUM_PHP.'</strong>',
            '<strong>'.MINIMUM_WP.'</strong>'
        ).
        '</p>
    </div>';
}

function deactivateJentilTheme()
{
    $themes = wp_get_themes(['allowed' => true]);
    unset($themes[THEME_SLUG]);

    $theme = reset($themes);
    $name = null === key($themes) ? '' : $theme->get_stylesheet();
    $parent = $name ? $theme->get_template() : '';

    update_option('stylesheet', $name);
    update_option('template', $parent);
}
