<?php

defined('ABSPATH') || exit;

function mekatron_custom_script_menu_view()
{
    wp_enqueue_style('mekatron-custom-scripts-styles', MEKATRON_CUSTOM_SCRIPT_URL.'styles.css', false, '1.0', 'all');
    include(MEKATRON_CUSTOM_SCRIPT_DIR . 'content.html');
//    include(MEKATRON_CUSTOM_SCRIPT_ADMIN_MENUS . 'settings.php');
}

function mekatron_custom_script_submenu_html()
{
    wp_enqueue_style('mekatron-custom-scripts-styles', MEKATRON_CUSTOM_SCRIPT_URL.'styles.css', false, '1.0', 'all');

    $notice_html = false;

    if(isset($_POST['text-custom-html'])){
        $script_html = trim($_POST['text-custom-html']);
        $saved_html = update_option('mekatron_custom_html', $script_html);
        if($saved_html) {
            $notice_html = [
                'type' => 'success',
                'message' => '<b>HTML script saved successfully!</b>'
            ];
        }
        else {
            $notice_html = [
                'type' => 'warning',
                'message' => '<b>HTML script not changed!</b>'
            ];
        }
    }

    $custom_script_html = get_option('mekatron_custom_html','');

    include(MEKATRON_CUSTOM_SCRIPT_DIR . 'custom-html.html');
}

function mekatron_custom_script_submenu_css()
{
    wp_enqueue_style('mekatron-custom-scripts-styles', MEKATRON_CUSTOM_SCRIPT_URL.'styles.css', false, '1.0', 'all');

    $notice_css = false;

    if(isset($_POST['text-custom-css'])){
        $style_css = trim($_POST['text-custom-css']);
        $saved_css = update_option('mekatron_custom_css', $style_css);
        if($saved_css) {
            $notice_css = [
                'type' => 'success',
                'message' => '<b>CSS style saved successfully!</b>'
            ];
        }
        else {
            $notice_css = [
                'type' => 'warning',
                'message' => '<b>CSS style not changed!</b>'
            ];
        }
    }

    $custom_style_css = get_option('mekatron_custom_css','');

    include(MEKATRON_CUSTOM_SCRIPT_DIR . 'custom-css.html');
}


function mekatron_custom_script_submenu_js()
{
    wp_enqueue_style('mekatron-custom-scripts-styles', MEKATRON_CUSTOM_SCRIPT_URL.'styles.css', false, '1.0', 'all');

    $notice_js = false;

    if(isset($_POST['text-custom-js'])){
        $script_js = trim($_POST['text-custom-js']);
        $saved_js = update_option('mekatron_custom_js', $script_js);
        if($saved_js) {
            $notice_js = [
                'type' => 'success',
                'message' => '<b>JSS script saved successfully!</b>'
            ];
        }
        else {
            $notice_js = [
                'type' => 'warning',
                'message' => '<b>JSS script not changed!</b>'
            ];
        }
    }

    $custom_script_js = get_option('mekatron_custom_js','');

    include(MEKATRON_CUSTOM_SCRIPT_DIR . 'custom-js.html');
}


function add_admin_menu_separator($position) {
    global $menu;
    $index = 1000;
    foreach($menu as $offset => $section) {
        if (substr($section[2],0,9) == 'separator')
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
    add_admin_menu_separator(57);

    $mekatron_custom_menu_suffix = add_menu_page(
        'mekatron-custom-script',
        'Custom Scripts',
//        'read',
        'manage_options',
        'mekatron-custom-script',
        'mekatron_custom_script_menu_view',
//        MEKATRON_CUSTOM_IMAGES_DIR.'html-js-css.png', // direct url
        'none', // use png with css (add_action -> wp_head)
//        MEKATRON_CUSTOM_IMAGES_DIR.'icon.svg', // use svg
//        'some bas64 data',// use base64
//        'dashicons-media-code', // use dash icons of wordpress
        58
    );

    // hook suffix acts after menu loaded
    add_action('load-'.$mekatron_custom_menu_suffix , function () {
        // do sth
    });

    $mekatron_custom_submenu_html_suffix = add_submenu_page(
        'mekatron-custom-script',
        'mekatron-custom-HTML',
        'HTML',
        'manage_options',
        'mekatron-custom-HTML',
        'mekatron_custom_script_submenu_html',
        1
    );

    // hook suffix acts after submenu loaded
    add_action('load-'.$mekatron_custom_submenu_html_suffix , function () {
        // do sth
    });

    $mekatron_custom_submenu_css_suffix = add_submenu_page(
        'mekatron-custom-script',
        'mekatron-custom-CSS',
        'CSS',
        'manage_options',
        'mekatron-custom-CSS',
        'mekatron_custom_script_submenu_css',
        2
    );

    // hook suffix acts after submenu loaded
    add_action('load-'.$mekatron_custom_submenu_css_suffix , function () {
        // do sth
    });

    $mekatron_custom_submenu_js_suffix = add_submenu_page(
        'mekatron-custom-script',
        'mekatron-custom-JS',
        'JS',
        'manage_options',
        'mekatron-custom-JS',
        'mekatron_custom_script_submenu_js',
        3
    );

    // hook suffix acts after submenu loaded
    add_action('load-'.$mekatron_custom_submenu_js_suffix , function () {
        // do sth
    });

}

add_action('admin_menu', 'mekatron_custom_script_menu');

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

function mekatron_get_menu_position($slug, $menu) {
    /*
     [5] => Array
        (
            [0] => نوشته‌ها
            [1] => edit_posts
            [2] => edit.php
            [3] =>
            [4] => menu-top menu-icon-post open-if-no-js
            [5] => menu-posts
            [6] => dashicons-admin-post
        )
     */
    foreach ($menu as $menu_array_index => $menu_item) {
        if($menu_item[2] == $slug) {
            return $menu_array_index;
        }
    }
    return false;
}

function mekatron_manage_menus() {
    global $menu;
//    print_r($menu);
//    exit;
    $comment_menu_position = mekatron_get_menu_position('edit-comments.php', $menu);
    $post_menu_position = mekatron_get_menu_position('edit.php', $menu);

    if($comment_menu_position === false ||
        $post_menu_position === false) {
        return false;
    }
    $comment_menu_backup = $menu[$comment_menu_position];
    $menu[$comment_menu_position] = $menu[$post_menu_position];
    $menu[$post_menu_position] = $comment_menu_backup;
}

function mekatron_manage_submenus() {
    global $submenu;
//    print_r($submenu);
//    exit;
    $upload_menu = $submenu['upload.php'];
    if(!$upload_menu) {
        return false;
    }
    $upload_submenu_position = mekatron_get_menu_position('upload.php', $upload_menu);
    $media_new_submenu_position = mekatron_get_menu_position('media-new.php', $upload_menu);

    if($upload_submenu_position === false ||
        $media_new_submenu_position === false) {
        return false;
    }
    $upload_submenu_backup = $upload_menu[$upload_submenu_position];
    $upload_menu[$upload_submenu_position] = $upload_menu[$media_new_submenu_position];
    $upload_menu[$media_new_submenu_position] = $upload_submenu_backup;
    $submenu['upload.php'] = $upload_menu;
}

add_action('admin_menu', 'mekatron_manage_menus', 999);
add_action('admin_menu', 'mekatron_manage_submenus', 999);

function mekatron_remove_menus() {
    global $pagenow;
    remove_menu_page('upload.php');
    if($pagenow == 'upload.php' || $pagenow == 'media-new.php') {
        wp_die('PAGE NOT ACCESSIBLE!');
    }

//    remove_menu_page('mekatron-custom-script');
//    if($pagenow == 'admin.php'
//        && isset($_GET['page'])
//        && (
//            $_GET['page'] == 'mekatron-custom-script' ||
//            $_GET['page'] == 'mekatron-custom-HTML' ||
//            $_GET['page'] == 'mekatron-custom-CSS' ||
//            $_GET['page'] == 'mekatron-custom-JS'
//        )) {
//        wp_die('PAGE NOT ACCESSIBLE!');
//    }

//    global $menu;
//    $custom_script_position = mekatron_get_menu_position('mekatron-custom-script', $menu);
//    if($custom_script_position === false) {
//        return false;
//    }
//    $menu[$custom_script_position][1] = 'some-undefined-slug-to-remove-whole-menu';
}

function mekatron_remove_submenus() {
    global $pagenow;
    remove_submenu_page('tools.php', 'export.php');
    remove_submenu_page('mekatron-custom-script', 'mekatron-custom-script');
    if($pagenow == 'export.php') {
        wp_die('PAGE NOT ACCESSIBLE!');
    }
    if($pagenow == 'admin.php'
        && isset($_GET['page'])
        && $_GET['page'] == 'mekatron-custom-script') {
        wp_die('PAGE NOT ACCESSIBLE!');
    }
}
add_action('admin_init', 'mekatron_remove_menus', 1000);
add_action('admin_init', 'mekatron_remove_submenus', 1000);

