<?php

/*
Plugin Name: Mekatron Custom Script
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: Custom HTML/CSS/JS Script
Version: 1.0
Author: Muhammmad Reza Heidary
Author URI: https://mekatronik.ir/
License: MIT
*/

defined('ABSPATH') || exit;

define('MEKATRON_CUSTOM_SCRIPT_DIR', plugin_dir_path(__FILE__) . 'libs/');
define('MEKATRON_CUSTOM_SCRIPT_URL', plugins_url('libs/', __FILE__));
define('MEKATRON_CUSTOM_IMAGES_DIR', plugin_dir_url(__FILE__) . 'assets/images/');
define('MEKATRON_CUSTOM_SCRIPT_ADMIN_MENUS', plugin_dir_path(__FILE__) . 'admin/');

if (is_admin()) {
    include(MEKATRON_CUSTOM_SCRIPT_ADMIN_MENUS . 'menus.php');
    include(MEKATRON_CUSTOM_SCRIPT_ADMIN_MENUS . 'settings.php');
}
else {
    add_action('wp_head', function () {
        $saved_css = get_option('mekatron_custom_css', '');
        printf('<style>%s</style>', $saved_css);
    });
    add_action('wp_footer', function () {
        $saved_js = get_option('mekatron_custom_js', '');
        printf('<script>%s</script>', $saved_js);
    });
}
include(MEKATRON_CUSTOM_SCRIPT_ADMIN_MENUS . 'menubar.php');
