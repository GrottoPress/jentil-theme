<?php
declare (strict_types = 1);

/**
 * This is for plugins that use their own template loaders,
 * thereby bypassing the `{$type}_template_hierarchy` filter.
 */
if (\MyTheme()->parent->utilities->page->is('singular')) {
    \MyTheme()->parent->utilities->loader->loadTemplate('singular');
} else {
    \MyTheme()->parent->utilities->loader->loadTemplate('index');
}
