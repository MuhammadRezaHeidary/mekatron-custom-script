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
define('MEKATRON_CUSTOM_SCRIPT_URL', plugins_url('libs/',__FILE__));
define('MEKATRON_CUSTOM_IMAGES_DIR', plugin_dir_url(__FILE__) . 'assets/images/');

function mekatron_custom_script_menu_view()
{
    wp_enqueue_style('mekatron-cstom-scripts-styles', MEKATRON_CUSTOM_SCRIPT_URL.'styles.css', false, '1.0', 'all');
    include(MEKATRON_CUSTOM_SCRIPT_DIR . 'content.html');
}

function add_admin_menu_separator($position) {
    global $menu;
    $index = 0;
    foreach($menu as $offset => $section) {
        if (substr($section[2],0,9)=='separator')
            $index++;
        if ($offset>=$position) {
            $menu[$position] = array('','read',"separator{$index}",'','wp-menu-separator');
            break;
        }
    }
    ksort( $menu );
}

function mekatron_custom_script_menu()
{
    add_admin_menu_separator(58);
    add_menu_page(
        'mekatron-custom-script',
        'Custom Scripts',
//        'read',
        'manage_options',
        'mekatron-custom-script',
        'mekatron_custom_script_menu_view',
//        MEKATRON_CUSTOM_IMAGES_DIR.'html-js-css.png', // direct url
//        'none', // use png with css (add_action -> wp_head)
//        MEKATRON_CUSTOM_IMAGES_DIR.'icon.svg', // use svg
//        'some bas64 data',// use base64
     'dashicons-media-code', // use dash icons of wordpress
    58
    );

}

add_action('admin_menu', 'mekatron_custom_script_menu');

/*
add_action('admin_head', function () {
    ?>
    <style type="text/css">
        a.toplevel_page_mekatron-custom-script .wp-menu-image {
            background: url('<?php echo MEKATRON_CUSTOM_IMAGES_DIR;?>icon.png') no-repeat center;
            background-size: 75%;
        }
    </style>
    <?php
});
*/