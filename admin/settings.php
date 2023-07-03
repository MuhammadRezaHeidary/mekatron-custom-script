<?php

defined('ABSPATH') || exit;

//global $menu;
//if(isset($_GET['menulist'])) {
//    print_r($menu);
//    exit;
//}

function mekatron_custom_script_settings_submenu()
{
    wp_enqueue_style('mekatron-custom-scripts-styles', MEKATRON_CUSTOM_SCRIPT_URL.'styles.css', false, '1.0', 'all');
    include(MEKATRON_CUSTOM_SCRIPT_DIR . 'custom-settings.html');
}

function mekatron_custom_script_settings() {
//    $mekatron_custom_submenu_custom_script_settings_suffix = add_submenu_page(
//        'options-general.php',
//        'mekatron-custom-script-settings',
//        'Custom Scripts',
//        'manage_options',
//        'mekatron-custom-script-settings',
//        'mekatron_custom_script_settings_submenu',
//        99
//    );

    $mekatron_custom_submenu_custom_script_settings_suffix = add_options_page(
        'mekatron-custom-script-settings',
        'Custom Scripts',
        'manage_options',
        'mekatron-custom-script-settings',
        'mekatron_custom_script_settings_submenu',
        99
    );

// hook suffix acts after submenu loaded
    add_action('load-'.$mekatron_custom_submenu_custom_script_settings_suffix , function () {
        // do sth
        echo ''?>
        <form style="direction: ltr; padding: 25px" id="hello-form" action="#">
            <h3>Enter company name</h3>
            <div>
                <label class="control-label" for="companyName">Company:</label>
                <input id="companyName" name="companyName" type="text">
            </div>
            <div style="padding-top: 10px">
                <button>Submit</button>
            </div>
        </form>
        <?php ;
    });

}

add_action('admin_menu', 'mekatron_custom_script_settings');
