<?php

/**
 * Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Iqconnetik
 * @since 0.0.1
 */

/**
 * Remove the sidebar in all Events Calendar pages
 * @return full-width, full-screen
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!function_exists('iqconnetik_action_flush_rewrite_rules')) :
    function iqconnetik_action_flush_rewrite_rules()
    {
        flush_rewrite_rules();
        if (class_exists('\Elementor\Utils')) {
            \Elementor\Utils::replace_urls('http://your-old-url.com', site_url());
        }
    }
endif;
add_action('fw:ext:backups:tasks:finish:id:demo-content-install', 'iqconnetik_action_flush_rewrite_rules');

//del <p> and <br/> form
add_filter('wpcf7_autop_or_not', '__return_false');

//remove render block
remove_action('render_block', 'wp_render_layout_support_flag', 10, 2);

define('IQCONNETIK_THEME_VERSION', wp_get_theme()->get('Version'));

//https://developer.wordpress.org/themes/basics/linking-theme-files-directories/#linking-to-theme-directories
define('IQCONNETIK_THEME_URI', get_parent_theme_file_uri());
define('IQCONNETIK_THEME_PATH', get_parent_theme_file_path());


// You may request this 'IQCONNETIK_REMOTE_DEMO_ID' value from this theme author to get a colorized demo content.
// See the Theme support service contacts information.
define('IQCONNETIK_REMOTE_DEMO_ID', ''); // as example: '12345678'
define('IQCONNETIK_REMOTE_DEMO_VERSION', '1.0.0');
define('IQCONNETIK_DEV_MODE', false);

//comments theme template
require_once IQCONNETIK_THEME_PATH . '/inc/customizer/class-mwt-theme-comments-walker.php';

//THEME SETUP
//theme support
//image sizes
//register menus
//register sidebars
require_once IQCONNETIK_THEME_PATH . '/inc/setup.php';

//THEME OPTIONS helpers and default options
require_once IQCONNETIK_THEME_PATH . '/inc/options.php';

//STATIC ASSETS
require_once IQCONNETIK_THEME_PATH . '/inc/static.php';

//HTML OUTPUT FILTERS
require_once IQCONNETIK_THEME_PATH . '/inc/output-filters.php';

//WooCommerce support
if (class_exists('WooCommerce')) {
    require_once IQCONNETIK_THEME_PATH . '/inc/woocommerce.php';
}

//only for front end

//TEMPLATE HELPERS
require_once IQCONNETIK_THEME_PATH . '/inc/template-helpers.php';


//only for admin
if (is_admin()) {

    //TGM plugin activation and demo-content
    require_once IQCONNETIK_THEME_PATH . '/inc/tgm-plugin-activation/plugins.php';
}

//only for customizer
if (is_customize_preview() || IQCONNETIK_DEV_MODE) {

    //CUSTOMIZER INIT
    require_once IQCONNETIK_THEME_PATH . '/inc/customizer/google-fonts.php';
    require_once IQCONNETIK_THEME_PATH . '/inc/customizer.php';
}

if (IQCONNETIK_DEV_MODE) :
    require_once IQCONNETIK_THEME_PATH . '/dev/extensions/functions.php';
endif;
