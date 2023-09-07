<?php

defined('ABSPATH') || exit;


add_action('admin_bar_menu', function ($wp_admin_bar){
    $title = "";
    if (is_admin()) {
        $title = sprintf('<img src="%sicon.png" style="width: 18px; margin-left: 5px; position: relative; top: 4px;" width="24px" height="24px">Custom Script', MEKATRON_CUSTOM_IMAGES_DIR);
    }
    else {
        $title = sprintf('<img src="%sicon.png" style="width: 18px; margin-left: 5px; position: relative; top: 0px;" width="24px" height="24px">Custom Script', MEKATRON_CUSTOM_IMAGES_DIR);
    }

    wp_enqueue_style('mekatron-custom-scripts-styles', MEKATRON_CUSTOM_SCRIPT_URL.'styles.css', [], '1.0', 'all');

    $wp_admin_bar->remove_menu('wp-logo');      //Remove a menu like logo

    $wp_admin_bar->add_group([
        'id'        => 'custom-script-bar-group'
    ]);

    $wp_admin_bar->add_menu([
//        'parent'       => 'top-secondary',
//        'parent'      => 'site-name',
//        'parent'      => 'view-site',
        'parent'    => 'custom-script-bar-group',
        'id'        => 'custom-script-bar',
        'title'     => $title,
        'href'      => admin_url('admin.php?page=mekatron-custom-HTML'),
        'meta'      => [
//            'html'      => '<div class="mekatron-custom-style-dropdown">Custom HTML/CSS/JS</div>',
            'class'     => 'class-mka class-mkb',
            'rel'       => 'noopener',
//            'onclick'   => 'console.log("OK!");return false;',
            'target'    => '_blank',
            'title'     => 'Description for Custom Scripts'
        ]
    ]);

    $wp_admin_bar->add_menu([
        'parent'    => 'custom-script-bar',
        'id'        => 'custom-script-html',
        'title'     => 'HTML',
        'href'      => admin_url('admin.php?page=mekatron-custom-HTML'),
        'meta'      => [
            'target'    => '_blank',
        ]
    ]);

    $wp_admin_bar->add_menu([
        'parent'    => 'custom-script-bar',
        'id'        => 'custom-script-css',
        'title'     => 'CSS',
        'href'      => admin_url('admin.php?page=mekatron-custom-CSS'),
        'meta'      => [
            'target'    => '_blank',
        ]
    ]);

    $wp_admin_bar->add_menu([
        'parent'    => 'custom-script-bar',
        'id'        => 'custom-script-js',
        'title'     => 'JS',
        'href'      => admin_url('admin.php?page=mekatron-custom-JS'),
        'meta'      => [
            'target'    => '_blank',
        ]
    ]);

    $wp_admin_bar->add_menu([
        'parent'    => 'custom-script-bar',
        'id'        => 'custom-script-settings',
        'title'     => 'Settings',
        'href'      => admin_url('options-general.php?page=mekatron-custom-script-settings'),
        'meta'      => [
            'target'    => '_blank',
        ]
    ]);
},99);
