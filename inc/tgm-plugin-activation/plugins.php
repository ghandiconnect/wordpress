<?php

/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Iqconnetik for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Plugin:
 * require_once dirname( __FILE__ ) . '/path/to/class-tgm-plugin-activation.php';
 */

require_once IQCONNETIK_THEME_PATH . '/inc/tgm-plugin-activation/class-tgm-plugin-activation.php';

//required plugins arrays - default and additional for different demos
if (!function_exists('iqconnetik_get_required_plugins_array')) :
	function iqconnetik_get_required_plugins_array($iqconnetik_index = 'default', $iqconnetik_all = false, $iqconnetik_all_flat = false)
	{
		$iqconnetik_required_plugins_array = array(
			//Following plugins are required for all demo contents:
			'default' => array(
				array(
					'name'     => esc_html__('Theme Widgets', 'iqconnetik'),
					'slug'     => 'mwt-widgets',
					'source'   => esc_url('http://webdesign-finder.com/remote-demo-content/iqconnetik-v2/plugins/mwt-widgets.zip'),
					'required' => true,
					'version'  => '0.0.1',
				),
				array(
					'name'     => esc_html__('Iqconnetik Options for Theme', 'iqconnetik'),
					'slug'     => 'iqconnetik-options-for-theme',
					'source'   => esc_url('http://webdesign-finder.com/remote-demo-content/iqconnetik-v2/plugins/mwt-fields.zip'),
					'required' => true,
					'version'  => '0.0.1',
				),
				array(
					'name'     => esc_html__('MWT Addons for Elementor', 'iqconnetik'),
					'slug'     => 'mwt-addons-for-elementor',
					'source'   => esc_url('http://webdesign-finder.com/remote-demo-content/common-plugins-original/mwt-addons-for-elementor.zip'),
					'required' => true,
					'version'  => '1.0.9',
				),
				array(
					'name'     => esc_html__('UBackup', 'iqconnetik'),
					'slug'     => 'ubackup',
					'source'   => esc_url('http://webdesign-finder.com/remote-demo-content/common-plugins-original/ubackup.zip'),
					'required' => true,
				),
				array(
					'name'             => esc_html__('MailChimp', 'iqconnetik'),
					'slug'             => 'mailchimp-for-wp',
					'required'         => true,
				),
				array(
					'name'             => esc_html__('Classic Widgets', 'iqconnetik'),
					'slug'             => 'classic-widgets',
					'required'         => true,
				),
				array(
					'name'        => esc_html__('WordPress SEO by Yoast', 'iqconnetik'),
					'slug'        => 'wordpress-seo',
					'is_callable' => 'wpseo_init',
				),
				array(
					'name'     => esc_html__('Envato Market', 'iqconnetik'),
					'slug'     => 'envato-market',
					'required' => true, // please do not turn to false!
					'source'   => esc_url('https://envato.github.io/wp-envato-market/dist/envato-market.zip'),
				),
				array(
					'name'             => esc_html__('Widget CSS Classes', 'iqconnetik'),
					'slug'             => 'widget-css-classes',
					'required'         => true,
				),
				array(
					'name'             => esc_html__('Contact Form 7', 'iqconnetik'),
					'slug'             => 'contact-form-7',
					'required'         => true,
				),
				array(
					'name'             => esc_html__('Elementor', 'iqconnetik'),
					'slug'             => 'elementor',
					'required'         => true,
				),
				array(
					'name'     => esc_html__('Simply Schedule Appointments', 'iqconnetik'),
					'slug'     => 'simply-schedule-appointments',
					'required' => true,
				),
			),
			'shop'    => array(
				array(
					'name' => esc_html__('WooCommerce', 'iqconnetik'),
					'slug' => 'woocommerce',
				),
			),
		);
		if (!empty($iqconnetik_all_flat)) {
			$iqconnetik_required_plugins_array_all = array();
			foreach ($iqconnetik_required_plugins_array as $key => $plugins) {
				foreach ($plugins as $plugin) {
					$iqconnetik_required_plugins_array_all[$plugin['slug']] = $plugin;
				}
			}
			return $iqconnetik_required_plugins_array_all;
		} elseif (!empty($iqconnetik_all)) {
			return $iqconnetik_required_plugins_array;
		} else {
			return $iqconnetik_required_plugins_array[$iqconnetik_index];
		}
	}
endif; //iqconnetik_get_required_plugins_array

add_action('tgmpa_register', 'iqconnetik_register_required_plugins');
if (!function_exists('iqconnetik_register_required_plugins')) :
	/**
	 * Register the required plugins for this theme.
	 *
	 * The variables passed to the `tgmpa()` function should be:
	 * - an array of plugin arrays;
	 * - optionally a configuration array.
	 * If you are not changing anything in the configuration array, you can remove the array and remove the
	 * variable from the function call: `tgmpa( $iqconnetik_plugins );`.
	 * In that case, the TGMPA default settings will be used.
	 *
	 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
	 */
	function iqconnetik_register_required_plugins()
	{
		/*
		* Array of plugin arrays. Required keys are name and slug.
		* If the source is NOT from the .org repo, then source is also required.
		*/
		//we need this to install different plugins for different demos
		if (!empty($_POST['iqconnetik_all_plugins'])) {
			$iqconnetik_plugins = iqconnetik_get_required_plugins_array('', false, true);
		} else {
			$iqconnetik_plugins = iqconnetik_get_required_plugins_array();
		}
		tgmpa(
			$iqconnetik_plugins,
			array(
				'domain'       => 'iqconnetik',
				'dismissable'  => true,
				'is_automatic' => false,
			)
		);
	}
endif;

//demo content installing
//disable branding
add_filter('pt-ocdi/disable_pt_branding', '__return_true');

if (!function_exists('iqconnetik_ocdi_get_required_demo_plugins')) :
	function iqconnetik_ocdi_get_required_demo_plugins($iqconnetik_demo_number = 'default')
	{
		//get TGMPA instance
		//$iqconnetik_tgmpa = $GLOBALS['tgmpa'];
		$iqconnetik_tgmpa = call_user_func(array(get_class($GLOBALS['tgmpa']), 'get_instance'));

		//get all plugins - different plugins for different demo as keys
		$iqconnetik_plugins = iqconnetik_get_required_plugins_array('', true);

		$iqconnetik_plugins_to_install_and_activate = array(
			'all'      => array(), // Meaning: all plugins which still have open actions.
			'install'  => array(),
			'update'   => array(),
			'activate' => array(),
		);

		if (empty($iqconnetik_plugins[$iqconnetik_demo_number])) {
			return $iqconnetik_plugins_to_install_and_activate;
		}

		//registering all plugins if they are not in the default stack
		foreach ($iqconnetik_plugins[$iqconnetik_demo_number] as $iqconnetik_plugin) {
			$iqconnetik_tgmpa->register($iqconnetik_plugin);
		}

		foreach ($iqconnetik_plugins[$iqconnetik_demo_number] as $iqconnetik_plugin) {
			if (!$iqconnetik_tgmpa->can_plugin_activate($iqconnetik_plugin['slug']) && $iqconnetik_tgmpa->is_plugin_installed($iqconnetik_plugin['slug']) && false === $iqconnetik_tgmpa->does_plugin_have_update($iqconnetik_plugin['slug'])) {
				//following will cause theme check error - is_plugin_active
				// if ( $iqconnetik_tgmpa->is_plugin_active( $iqconnetik_plugin['slug'] ) && false === $iqconnetik_tgmpa->does_plugin_have_update( $iqconnetik_plugin['slug'] ) ) {
				// No need to display plugins if they are installed, up-to-date and active.
				continue;
			}
			if (!$iqconnetik_tgmpa->is_plugin_installed($iqconnetik_plugin['slug'])) {
				$iqconnetik_plugins_to_install_and_activate['install'][$iqconnetik_plugin['slug']] = $iqconnetik_plugin;
			} else {
				if (false !== $iqconnetik_tgmpa->does_plugin_have_update($iqconnetik_plugin['slug'])) {
					$iqconnetik_plugins_to_install_and_activate['update'][$iqconnetik_plugin['slug']] = $iqconnetik_plugin;
				}

				if ($iqconnetik_tgmpa->can_plugin_activate($iqconnetik_plugin['slug'])) {
					$iqconnetik_plugins_to_install_and_activate['activate'][$iqconnetik_plugin['slug']] = $iqconnetik_plugin;
				}
			}
		}

		return $iqconnetik_plugins_to_install_and_activate;
	}
endif; //iqconnetik_ocdi_get_required_demo_plugins

if (!function_exists('iqconnetik_ocdi_get_demo_install_notice_html')) :
	function iqconnetik_ocdi_get_demo_install_notice_html($iqconnetik_demo_number = 0)
	{
		$iqconnetik_plugins       = iqconnetik_ocdi_get_required_demo_plugins($iqconnetik_demo_number);
		$iqconnetik_notice_html   = '';
		$iqconnetik_data_install  = array();
		$iqconnetik_data_activate = array();
		if (!empty($iqconnetik_plugins['install']) || !empty($iqconnetik_plugins['activate'])) {
			$iqconnetik_notice_html .= '<div class="iqconnetik-ocdi-required-plugins"><strong>' . esc_html__('Required plugins:', 'iqconnetik') . '</strong></div>';
			foreach ($iqconnetik_plugins['install'] as $iqconnetik_plugin) {
				if (empty($iqconnetik_plugin['name'])) {
					continue;
				}
				$iqconnetik_notice_html   .= '<div class="iqconnetik-ocdi-plugin-install">' . esc_html($iqconnetik_plugin['name']) . ' - <span class="iqconnetik-ocdi-' . esc_attr($iqconnetik_plugin['slug']) . '">' . esc_html__('Install', 'iqconnetik') . '</span></div>';
				$iqconnetik_data_install[] = $iqconnetik_plugin['slug'];
			}
			foreach ($iqconnetik_plugins['activate'] as $iqconnetik_plugin) {
				if (empty($iqconnetik_plugin['name'])) {
					continue;
				}
				$iqconnetik_notice_html    .= '<div class="iqconnetik-ocdi-plugin-activate">' . esc_html($iqconnetik_plugin['name']) . ' - <span class="iqconnetik-ocdi-' . esc_attr($iqconnetik_plugin['slug']) . '">' . esc_html__('Activate', 'iqconnetik') . '</span></div>';
				$iqconnetik_data_activate[] = $iqconnetik_plugin['slug'];
			}
			$iqconnetik_notice_html .= '<br><div class="iqconnetik-ocdi-button-wrap"><button class="iqconnetik-ocdi-install-plugins-button button button-primary"' .
				' data-install="' . esc_attr(join(',', $iqconnetik_data_install)) . '"' .
				' data-activate="' . esc_attr(join(',', $iqconnetik_data_activate)) . '"' .
				' data-demo="' . esc_attr($iqconnetik_demo_number) . '">' .
				esc_html__('Install and Activate plugins', 'iqconnetik') .
				'</button><span class="spinner"></span></div>';
		}

		return $iqconnetik_notice_html;
	}
endif; //iqconnetik_ocdi_get_demo_install_notice_html

// http://proteusthemes.github.io/one-click-demo-import/#basic-import-setup
if (!function_exists('iqconnetik_ocdi_import_files')) :
	function iqconnetik_ocdi_import_files()
	{
		return array(
			array(
				'import_file_name'             => esc_html__('Default', 'iqconnetik'),
				'local_import_file'            => IQCONNETIK_THEME_PATH . '/assets/demo-content/default/demo-content.xml',
				'local_import_widget_file'     => IQCONNETIK_THEME_PATH . '/assets/demo-content/default/widgets.wie',
				'local_import_customizer_file' => IQCONNETIK_THEME_PATH . '/assets/demo-content/default/customizer.dat',
				'import_preview_image_url'     => IQCONNETIK_THEME_URI . '/screenshot.jpg',
				'import_notice'                => iqconnetik_ocdi_get_demo_install_notice_html('default'),
				'preview_url'                  => '//demo.iqconnetik-wordpress-theme.com/blog/',
			),
		);
	}
endif;
//demo content only on demo page or only when ajax happens - for not load and not displayed ALL required plugins by all demos
if ((!empty($_GET['page']) && ('pt-one-click-demo-import' === $_GET['page'] || 'one-click-demo-import' === $_GET['page'])) || wp_doing_ajax()) {
	add_filter('pt-ocdi/import_files', 'iqconnetik_ocdi_import_files');
}

//setting cropped default image sizes
if (!function_exists('iqconnetik_ocdi_before_content_import')) :
	function iqconnetik_ocdi_before_content_import($selected_import)
	{
		update_option('medium_crop', '1');
		update_option('large_crop', '1');
	}
endif;
add_action('pt-ocdi/before_content_import', 'iqconnetik_ocdi_before_content_import');

//setting menus, main and blog pages and special cats after demo import
if (!function_exists('iqconnetik_ocdi_after_import_setup')) :
	function iqconnetik_ocdi_after_import_setup($selected_import)
	{

		//different operations depending on different demos
		//https://github.com/awesomemotive/one-click-demo-import#how-to-handle-different-after-import-setups-depending-on-which-predefined-import-was-selected

		// Assign menus to their locations.
		$iqconnetik_menus        = array(
			'topline'   => 'footer_menu_1',
			'primary'   => 'main_menu',
			/*
			side menu will be placed with widget, not with the menu
			'side'      => 'Side Menu',
			*/
			'copyright' => 'footer_menu_1',
		);
		$iqconnetik_menus_to_set = array();
		foreach ($iqconnetik_menus as $iqconnetik_position => $iqconnetik_name) {
			$iqconnetik_menu = get_term_by('name', $iqconnetik_name, 'nav_menu');
			if (!empty($iqconnetik_menu)) {
				$iqconnetik_menus_to_set[$iqconnetik_position] = $iqconnetik_menu->term_id;
			}
		}
		if (!empty($iqconnetik_menus_to_set)) {
			set_theme_mod('nav_menu_locations', $iqconnetik_menus_to_set);
		}

		//set reusable block with inline subscribe form as a theme mod
		$inline_subscribe_block = get_page_by_title('Inline Subscribe', OBJECT, 'wp_block');
		if (!empty($inline_subscribe_block)) {
			set_theme_mod('footer_top_shortcode', '[reblex id="' . $inline_subscribe_block->ID . '"]');
		}

		//set default items count for feed
		update_option('posts_per_page', '12');

		//hide Hello World post
		$iqconnetik_hello_world_post = get_page_by_path('hello-world', OBJECT, 'post');
		if (!empty($iqconnetik_hello_world_post)) {
			$iqconnetik_hello_world_post->post_status = 'draft';
			wp_update_post($iqconnetik_hello_world_post);
		}

		//set page as front page for demo with a static homepage
		// Assign front page and posts page (blog page).
		$iqconnetik_front_page_id = get_page_by_title('Home');
		$iqconnetik_blog_page_id  = get_page_by_title('Blog');

		update_option('show_on_front', 'page');
		update_option('page_on_front', $iqconnetik_front_page_id->ID);
		update_option('page_for_posts', $iqconnetik_blog_page_id->ID);

		//set shop page as front page for shop demo content
		//		if ( 'Shop' === $selected_import['import_file_name'] ) {
		// Assign front page - Shop, and posts page (blog page).
		$iqconnetik_front_page_id = get_page_by_title('Home');
		$iqconnetik_blog_page_id  = get_page_by_title('Blog');
		// Other Woo pages
		$iqconnetik_cart_page_id     = get_page_by_title('Cart');
		$iqconnetik_checkout_page_id = get_page_by_title('Checkout');
		$iqconnetik_account_page_id  = get_page_by_title('My account');

		update_option('show_on_front', 'page');
		update_option('page_on_front', $iqconnetik_front_page_id->ID);
		update_option('page_for_posts', $iqconnetik_blog_page_id->ID);

		//Woo
		update_option('woocommerce_cart_page_id', $iqconnetik_cart_page_id->ID);
		update_option('woocommerce_checkout_page_id', $iqconnetik_checkout_page_id->ID);
		update_option('woocommerce_myaccount_page_id', $iqconnetik_account_page_id->ID);
		//customizer
		update_option('woocommerce_catalog_columns', '3');

		//set home page link in menus in demos where home page is a post archive
		if ('Blog' === $selected_import['import_file_name']) {
			$menu_items = wp_get_nav_menu_items('Main Menu');
			if (!empty($menu_items)) {
				foreach ($menu_items as $menu_item_post_object) {
					if ('Home' === $menu_item_post_object->post_title) {
						update_post_meta($menu_item_post_object->ID, '_menu_item_url', get_site_url());
						break;
					}
				}
			}
			$menu_items = wp_get_nav_menu_items('Side Menu');
			if (!empty($menu_items)) {
				foreach ($menu_items as $menu_item_post_object) {
					if ('Home' === $menu_item_post_object->post_title) {
						$menu_item_post_object->url = get_site_url();
						update_post_meta($menu_item_post_object->ID, '_menu_item_url', get_site_url());
						break;
					}
				}
			}
		}
		//set permalinks structure
		{
			global $wp_rewrite;

			//Write the rule
			$wp_rewrite->set_permalink_structure('/%postname%/');

			//Set the option
			update_option("rewrite_rules", FALSE);

			//Flush the rules and tell it to write htaccess
			$wp_rewrite->flush_rules(true);
		}

		//change hardcoded URLs in pages, reusable blocks and nav menus
		$find = 'http://webdesign-finder.com/iqconnetik';
		$replace = get_site_url();
		$query = new WP_Query(
			array(
				'post_type' => 'wp_block',
				'posts_per_page' => -1,
			)
		);
		foreach ($query->posts as $post) :
			$post->guid = str_replace($find, $replace, $post->guid);
			$post->post_content = str_replace($find, $replace, $post->post_content);
			wp_update_post($post);
		endforeach;

		$query = new WP_Query(
			array(
				'post_type' => 'page',
				'posts_per_page' => -1,
			)
		);
		foreach ($query->posts as $post) :
			$post->guid = str_replace($find, $replace, $post->guid);
			$post->post_content = str_replace($find, $replace, $post->post_content);
			wp_update_post($post);
		endforeach;
	}
endif; //iqconnetik_ocdi_after_import_setup
add_action('pt-ocdi/after_import', 'iqconnetik_ocdi_after_import_setup');

//load plugins install script
if (!function_exists('iqconnetik_ocdi_admin_enqueue_scripts')) :
	function iqconnetik_ocdi_admin_enqueue_scripts($hook)
	{
		if ('appearance_page_pt-one-click-demo-import' === $hook || 'appearance_page_one-click-demo-import' === $hook) {
			$min = !IQCONNETIK_DEV_MODE ? 'min/' : '';
			wp_enqueue_script('iqconnetik-ocdi-plugins-install-script', IQCONNETIK_THEME_URI . '/assets/js/' . $min . 'ocdi.js', array('jquery'), IQCONNETIK_THEME_VERSION, true);
			wp_localize_script(
				'iqconnetik-ocdi-plugins-install-script',
				'iqconnetik_ocdi',
				array(
					'tgm_plugin_nonce' => array(
						'update'  => wp_create_nonce('tgmpa-update'),
						'install' => wp_create_nonce('tgmpa-install'),
					),
					'tgm_bulk_url'     => admin_url('themes.php?page=tgmpa-install-plugins'),
					'ajaxurl'          => admin_url('admin-ajax.php'),
					'wpnonce'          => wp_create_nonce('iqconnetik_ocdi_nonce'),
					'text_done'        => esc_html__('Done', 'iqconnetik'),
					'text_installing'  => esc_html__('Installing...', 'iqconnetik'),
					'text_activating'  => esc_html__('Activating...', 'iqconnetik'),
					'text_fail'        => esc_html__('Ajax error', 'iqconnetik'),
					'text_fail_tgm'    => esc_html__('TGMPA Ajax error', 'iqconnetik'),
				)
			);
		}
	}
endif; //iqconnetik_ocdi_admin_enqueue_scripts
add_action('admin_enqueue_scripts', 'iqconnetik_ocdi_admin_enqueue_scripts');

//process ajax call to install plugins
add_action('wp_ajax_iqconnetik_install_and_activate_plugins', 'iqconnetik_wp_ajax_install_and_activate_plugins');
if (!function_exists('iqconnetik_wp_ajax_install_and_activate_plugins')) :
	function iqconnetik_wp_ajax_install_and_activate_plugins()
	{
		if (!check_ajax_referer('iqconnetik_ocdi_nonce', 'wpnonce')) {
			wp_send_json_error(
				array(
					'error'   => 1,
					'message' => esc_html__('Forbidden', 'iqconnetik'),
				)
			);
		}
		if (empty($_POST['slug']) || (empty($_POST['plugins_activate']) && empty($_POST['plugins_install']))) {
			wp_send_json_error(
				array(
					'error'   => 1,
					'message' => esc_html__('No Plugins to Process', 'iqconnetik'),
				)
			);
		}

		$plugins = array();
		// send back some json we use to hit up TGM
		if (isset($_POST['plugins_activate'])) {
			$plugins['activate'] = array_map('sanitize_title', $_POST['plugins_activate']);
		} else {
			$plugins['activate'] = array();
		}
		if (isset($_POST['plugins_install'])) {
			$plugins['install'] = array_map('sanitize_title', $_POST['plugins_install']);
		} else {
			$plugins['install'] = array();
		}
		// what are we doing with this plugin?
		//activating - is default
		$json = array(
			'url'             => admin_url('themes.php?page=tgmpa-install-plugins'),
			'plugin'          => array_filter($plugins['activate']),
			'tgmpa-page'      => 'tgmpa-install-plugins',
			'plugin_status'   => 'all',
			'_wpnonce'        => wp_create_nonce('bulk-plugins'),
			'action'          => 'tgmpa-bulk-activate',
			'action2'         => -1,
			'message'         => esc_html__('Activating Plugin...', 'iqconnetik'),
			//load all plugins, not only default
			'iqconnetik_all_plugins' => 1,
		);
		//every plugin to install is separate call
		//override activation here
		foreach ($plugins['install'] as $slug) {
			if ($slug === $_POST['slug']) {
				$json = array(
					'url'             => admin_url('themes.php?page=tgmpa-install-plugins'),
					'plugin'          => array($slug),
					'tgmpa-page'      => 'tgmpa-install-plugins',
					'plugin_status'   => 'all',
					'_wpnonce'        => wp_create_nonce('bulk-plugins'),
					'action'          => 'tgmpa-bulk-install',
					'action2'         => -1,
					'message'         => esc_html__('Installing Plugin...', 'iqconnetik'),
					//load all plugins, not only default
					'iqconnetik_all_plugins' => 1,
				);
				break;
			}
		}

		if ($json) {
			$json['hash'] = md5(serialize($json)); // used for checking if duplicates happen, move to next plugin
			wp_send_json($json);
		} else {
			wp_send_json(
				array(
					'done'    => 1,
					'message' => esc_html__('Success', 'iqconnetik'),
				)
			);
		}
		wp_die();
	}
endif; //iqconnetik_wp_ajax_install_and_activate_plugins
