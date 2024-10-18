<?php

/**
 * Theme static files
 *
 * @package Iqconnetik
 * @since 0.0.1
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

/**
 * Enqueue scripts and styles.
 */
//front end styles and scripts
if (!function_exists('iqconnetik_enqueue_static')) :
	function iqconnetik_enqueue_static()
	{

		$min = iqconnetik_option('assets_min') ? 'min/' : '';

		//main theme css file
		wp_enqueue_style('iqconnetik-style', IQCONNETIK_THEME_URI . '/assets/css/' . $min . 'style.css', array(), IQCONNETIK_THEME_VERSION);

		$iqconnetik_colors_string = iqconnetik_get_root_colors_inline_styles_string();
		if (!empty($iqconnetik_colors_string)) :
			wp_add_inline_style(
				'iqconnetik-style',
				wp_kses(
					':root{' . $iqconnetik_colors_string . '}',
					false
				)
			);
		endif;

		$footer_menu_logo = iqconnetik_option('custom_logo');
		if (!empty($footer_menu_logo)) :
			wp_add_inline_style(
				'iqconnetik-style',
				wp_kses(
					'.widget_nav_menu.horizontal-menu.with-logo-img li.menu-item-home a::before{background-image:url(' . esc_url(wp_get_attachment_image_src($footer_menu_logo, 'full')[0]) . ') !important;}',
					false
				)
			);
		endif;

		$footer_menu_logo_inverse = iqconnetik_option('logo_image_inverse', '');
		if (!empty($footer_menu_logo_inverse)) :
			wp_add_inline_style(
				'iqconnetik-style',
				wp_kses(
					'.i .widget_nav_menu.horizontal-menu.with-logo-img li.menu-item-home a::before{background-image:url(' . esc_url($footer_menu_logo_inverse) . ') !important;}',
					false
				)
			);
		endif;

		$header_button_image = iqconnetik_option('header_button_image', '');
		if (!empty($header_button_image)) :
			wp_add_inline_style(
				'iqconnetik-style',
				wp_kses(
					'.header-button::before{
						content: ""; 
						display: inline-block; 
						width: 1em; 
						height: 1em; 
						margin-right: 10px; 
						position: relative; 
						top: 1px; 
						mask-image: url(' . esc_url($header_button_image) . '); 
						mask-repeat: no-repeat; 
						mask-size: cover;
					}',
					false
				)
			);
		endif;

		wp_enqueue_style('font-awesome', IQCONNETIK_THEME_URI . '/assets/css/' . $min . 'all.css', array(), IQCONNETIK_THEME_VERSION);
		wp_enqueue_style('icomoon', IQCONNETIK_THEME_URI . '/assets/css/' . $min . 'icomoon.css', array(), IQCONNETIK_THEME_VERSION);
		wp_enqueue_style('specicons', IQCONNETIK_THEME_URI . '/assets/css/' . $min . 'specicons.css', array(), IQCONNETIK_THEME_VERSION);

		//Woo styles
		if (class_exists('WooCommerce')) {
			wp_enqueue_style('iqconnetik-shop-style', IQCONNETIK_THEME_URI . '/assets/css/' . $min . 'shop.css', array(), IQCONNETIK_THEME_VERSION);
		}

		//getting theme skin number
		$skin = iqconnetik_option('color_skin', '');
		if (!empty($skin)) {
			wp_enqueue_style('iqconnetik-skin', IQCONNETIK_THEME_URI . '/assets/css/' . esc_attr($skin) . '.css', array(), IQCONNETIK_THEME_VERSION);
		}

		//custom Google fonts css file and inline styles if option is enabled
		// based on:
		// https://gist.github.com/kailoon/e2dc2a04a8bd5034682c
		// http://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/
		$iqconnetik_font_body     = json_decode(iqconnetik_option('font_body', '{"font":"","variant": [],"subset":[]}'));
		$iqconnetik_font_headings = json_decode(iqconnetik_option('font_headings', '{"font":"","variant": [],"subset":[]}'));
		//TODO subsets can exists even if no font selected
		if (!empty($iqconnetik_font_body->font) || !empty($iqconnetik_font_headings->font)) {
			/*
			Translators: If there are characters in your language that are not supported
			by chosen font(s), translate this to 'off'. Do not translate into your own language.
			*/

			if ('off' !== esc_html_x('on', 'Google font: on or off', 'iqconnetik')) {
				$iqconnetik_body_subsets  = array();
				$iqconnetik_font_body_font = '';
				if (!empty($iqconnetik_font_body->font)) {
					$iqconnetik_font_body_font = $iqconnetik_font_body->font;
					if (!empty($iqconnetik_font_body->variant)) {
						$iqconnetik_font_body->font .= ':' . implode(',', $iqconnetik_font_body->variant);
					}
					$iqconnetik_body_subsets  = $iqconnetik_font_body->subset;
				}

				$iqconnetik_headings_subsets  = array();
				$iqconnetik_font_headings_font = '';
				if (!empty($iqconnetik_font_headings->font)) {
					$iqconnetik_font_headings_font = $iqconnetik_font_headings->font;
					if (!empty($iqconnetik_font_headings->variant)) {
						$iqconnetik_font_headings->font .= ':' . implode(',', $iqconnetik_font_headings->variant);
					}
					$iqconnetik_headings_subsets  = $iqconnetik_font_headings->subset;
				}

				$iqconnetik_fonts    = array(
					'body'     => $iqconnetik_font_body->font,
					'headings' => $iqconnetik_font_headings->font,
				);
				$iqconnetik_subsets  = array(
					'body'     => implode(',', $iqconnetik_body_subsets),
					'headings' => implode(',', $iqconnetik_headings_subsets),
				);
				//'Montserrat|Bowlby One|Quattrocento Sans';
				$iqconnetik_fonts_string    = implode('|', array_filter($iqconnetik_fonts));
				$iqconnetik_subsets_string  = implode(',', array_filter($iqconnetik_subsets));

				$iqconnetik_query_args = array(
					'family' => urlencode($iqconnetik_fonts_string),
				);
				if (!empty($iqconnetik_subsets_string)) {
					$iqconnetik_query_args['subset'] = urlencode($iqconnetik_subsets_string);
				}
				$iqconnetik_query_args['display'] = 'swap';
				$iqconnetik_font_url = add_query_arg(
					$iqconnetik_query_args,
					'//fonts.googleapis.com/css'
				);

				//no need to provide anew version for Google fonts link
				wp_enqueue_style('iqconnetik-google-fonts-style', $iqconnetik_font_url, array(), '1.0.0');
				//printing header styles

				$iqconnetik_body_style = (!empty($iqconnetik_font_body_font)) ? 'body, button, input, select, textarea, .wp-block-calendar table caption{font-family:"' . $iqconnetik_font_body_font . '";}' : '';

				$iqconnetik_secondary_selectors = array(
					'h1',
					'h2',
					'h3',
					'h4',
					'h5',
					'h6',
					'.logo-text',
				);

				$iqconnetik_headings_style = (!empty($iqconnetik_font_headings_font)) ? join(',', $iqconnetik_secondary_selectors) . '{font-family: "' . $iqconnetik_font_headings_font . '"}' : '';

				wp_add_inline_style(
					'iqconnetik-google-fonts-style',
					wp_kses(
						$iqconnetik_body_style . $iqconnetik_headings_style,
						false
					)
				);
			}
		}

		//admin-bar styles for front end
		if (is_admin_bar_showing()) {
			//Add Frontend admin styles
			wp_enqueue_style(
				'iqconnetik-admin-bar-style',
				IQCONNETIK_THEME_URI . '/assets/css/admin-frontend.css',
				array(),
				IQCONNETIK_THEME_VERSION
			);
		}

		//superfish
		wp_enqueue_script('superfish', IQCONNETIK_THEME_URI . '/assets/js/vendor/superfish.js', array('jquery'), IQCONNETIK_THEME_VERSION, true);

		//particles
		wp_enqueue_script('particles', IQCONNETIK_THEME_URI . '/assets/js/vendor/particles.min.js', array('jquery'), IQCONNETIK_THEME_VERSION, true);

		//flexslider
		wp_enqueue_script('flexslider', IQCONNETIK_THEME_URI . '/assets/js/vendor/jquery.flexslider-min.js', array('jquery'), IQCONNETIK_THEME_VERSION, true);

		//owl-carousel
		wp_enqueue_script('owl-carousel', IQCONNETIK_THEME_URI . '/assets/js/vendor/owl.carousel.min.js', array('jquery'), IQCONNETIK_THEME_VERSION, true);

		//jquery-numerator
		wp_enqueue_script('jquery-numerator', IQCONNETIK_THEME_URI . '/assets/js/vendor/jquery-numerator.min.js', array('jquery'), IQCONNETIK_THEME_VERSION, true);

		//jquery-twentytwenty
		wp_enqueue_script('twentytwenty', IQCONNETIK_THEME_URI . '/assets/js/vendor/jquery.twentytwenty.js', array('jquery'), IQCONNETIK_THEME_VERSION, true);

		//jquery-event-move
		wp_enqueue_script('event-move', IQCONNETIK_THEME_URI . '/assets/js/vendor/jquery.event.move.js', array('jquery'), IQCONNETIK_THEME_VERSION, true);

		//always load masonry
		wp_enqueue_script('masonry', '', array('imagesloaded'), '', true);

		//photoswipe
		if (is_singular()) {
			wp_enqueue_style(
				'photoswipe',
				IQCONNETIK_THEME_URI . '/assets/vendor/photoswipe/photoswipe.css',
				array(),
				IQCONNETIK_THEME_VERSION
			);
			wp_enqueue_style(
				'photoswipe-skin',
				IQCONNETIK_THEME_URI . '/assets/vendor/photoswipe/default-skin/default-skin.css',
				array('photoswipe'),
				IQCONNETIK_THEME_VERSION
			);
			wp_enqueue_script('photoswipe', IQCONNETIK_THEME_URI . '/assets/vendor/photoswipe/photoswipe.min.js', array(), IQCONNETIK_THEME_VERSION, true);
			wp_enqueue_script('photoswipe-ui', IQCONNETIK_THEME_URI . '/assets/vendor/photoswipe/photoswipe-ui-default.js', array('photoswipe'), IQCONNETIK_THEME_VERSION, true);
		}

		//glightbox
		wp_enqueue_style(
			'glightbox',
			IQCONNETIK_THEME_URI . '/assets/vendor/glightbox/glightbox.min.css',
			array(),
			IQCONNETIK_THEME_VERSION
		);

		wp_enqueue_script('glightbox', IQCONNETIK_THEME_URI . '/assets/vendor/glightbox/glightbox.min.js', array(), IQCONNETIK_THEME_VERSION, true);

		$min_js = !IQCONNETIK_DEV_MODE ? 'min/' : '';
		//main theme script
		wp_enqueue_script('iqconnetik-init-script', IQCONNETIK_THEME_URI . '/assets/js/' . $min_js . 'init.js', array('jquery'), IQCONNETIK_THEME_VERSION, true);

		//animation scripts and styles
		if (iqconnetik_option('animation_enabled', false)) :
			wp_enqueue_script('iqconnetik-animation-script', IQCONNETIK_THEME_URI . '/assets/js/' . $min_js . 'animation.js', array(), IQCONNETIK_THEME_VERSION, true);
			wp_enqueue_style('iqconnetik-animate', IQCONNETIK_THEME_URI . '/assets/css/' . $min . 'animate.css', array(), IQCONNETIK_THEME_VERSION);
		endif;

		//comments script
		if (is_singular() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}

		//move jQuery scripts to the footer if customizer option is active and if not user logged in
		if (iqconnetik_option('jquery_to_footer', false) && !is_user_logged_in()) :
			wp_scripts()->add_data('jquery', 'group', 1);
			wp_scripts()->add_data('jquery-core', 'group', 1);
			wp_scripts()->add_data('jquery-migrate', 'group', 1);
		endif;

		//customizer preview
		if (is_customize_preview()) {
			wp_enqueue_script('iqconnetik-customize-preview-script', IQCONNETIK_THEME_URI . '/assets/js/' . $min_js . 'customize-preview.js', array('jquery', 'customize-selective-refresh'), IQCONNETIK_THEME_VERSION, true);
		}
	}
endif;
add_action('wp_enqueue_scripts', 'iqconnetik_enqueue_static');

//enqueue masonry for grid layout
if (!function_exists('iqconnetik_enqueue_masonry')) :
	function iqconnetik_enqueue_masonry()
	{
		wp_enqueue_script('masonry', '', array('imagesloaded'), '', true);
	}
endif;
//enqueue masonry for grid layout action
if (!function_exists('iqconnetik_enqueue_masonry_action')) :
	function iqconnetik_enqueue_masonry_action()
	{
		add_action('wp_enqueue_scripts', 'iqconnetik_enqueue_masonry');
	}
endif;


//Gutenberg script
//https://developer.wordpress.org/block-editor/tutorials/javascript/loading-javascript/
if (!function_exists('iqconnetik_action_enqueue_block_editor_assets')) :
	function iqconnetik_action_enqueue_block_editor_assets($iqconnetik_page)
	{

		$min = !IQCONNETIK_DEV_MODE ? 'min/' : '';

		$deps = array(
			'lodash',
			'wp-i18n',
			'wp-element',
			'wp-components',
			'wp-data',
			'wp-plugins',
			'wp-blocks',
			'wp-dom-ready',
		);
		//v 5.8 has block editor on widgets and throws error when 'edit post' scripts are loaded as a dependency
		$screen = function_exists('get_current_screen') ? get_current_screen() : false;
		if ($screen) {
			if ('widgets' !== $screen->id) {
				$deps[] = 'wp-edit-post';
				$deps[] = 'wp-editor';

				//animation scripts and styles
				if (iqconnetik_option('animation_enabled', false) && empty(iqconnetik_option('animation_disable_for_gutenberg', false))) :
					wp_enqueue_script(
						'gutenberg-animation',
						IQCONNETIK_THEME_URI . '/assets/js/' . $min . 'gutenberg-animation.js',
						$deps,
						IQCONNETIK_THEME_VERSION
					);
				endif;
			}
		}
		wp_enqueue_script(
			'gutenberg',
			IQCONNETIK_THEME_URI . '/assets/js/' . $min . 'gutenberg.js',
			$deps,
			IQCONNETIK_THEME_VERSION
		);
	}
endif;
add_action('enqueue_block_editor_assets', 'iqconnetik_action_enqueue_block_editor_assets');


//login page styles
if (!function_exists('iqconnetik_action_login_enqueue_static')) :
	function iqconnetik_action_login_enqueue_static($iqconnetik_page)
	{
		wp_enqueue_style(
			'iqconnetik-login-page-style',
			IQCONNETIK_THEME_URI . '/assets/css/login-page.css',
			array(),
			IQCONNETIK_THEME_VERSION
		);
		$iqconnetik_colors_string = iqconnetik_get_root_colors_inline_styles_string();
		if (!empty($iqconnetik_colors_string)) :
			wp_add_inline_style(
				'iqconnetik-login-page-style',
				wp_kses(
					':root{' . $iqconnetik_colors_string . '}',
					false
				)
			);
		endif;
	}
endif;
add_action('login_enqueue_scripts', 'iqconnetik_action_login_enqueue_static');

//customizer panel
if (!function_exists('iqconnetik_customizer_js')) :
	function iqconnetik_customizer_js()
	{
		wp_enqueue_style(
			'iqconnetik-customizer-style',
			IQCONNETIK_THEME_URI . '/assets/css/customizer.css',
			array(),
			IQCONNETIK_THEME_VERSION
		);
		$min = !IQCONNETIK_DEV_MODE ? 'min/' : '';
		wp_register_script(
			'iqconnetik-customize-controls',
			IQCONNETIK_THEME_URI . '/assets/js/' . $min . 'customize-controls.js',
			array(),
			IQCONNETIK_THEME_VERSION,
			true
		);
		wp_localize_script('iqconnetik-customize-controls', 'mwtGoogleFonts', iqconnetik_get_google_fonts_array());

		//customizer redirect helpers
		$blog_url = get_post_type_archive_link('post');
		$post     = wp_get_recent_posts(
			array(
				'numberposts' => 1,
				'post_status' => 'publish',
			)
		);
		wp_reset_postdata();
		$post_url   = (!empty($post[0])) ? get_permalink($post[0]['ID']) : $blog_url;
		$search_url = home_url('/') . '?s=';
		$shop_url = esc_html(home_url('/'));
		$checkout_url = esc_html(home_url('/'));
		if (class_exists('WooCommerce')) {
			$shop_url = wc_get_page_permalink('shop');
			$checkout_url = wc_get_page_permalink('checkout');
		}
		$error404_url = home_url('/') . '404';
		wp_localize_script(
			'iqconnetik-customize-controls',
			'iqconnetikCustomizerObject',
			array(
				'homeUrl'     => esc_url_raw(home_url()),
				'blogUrl'     => esc_url_raw($blog_url),
				'postUrl'     => esc_url_raw($post_url),
				'searchUrl'   => esc_url_raw($search_url),
				'shopUrl'     => esc_url_raw($shop_url),
				'checkoutUrl' => esc_url_raw($checkout_url),
				'themeUrl'    => esc_url_raw(IQCONNETIK_THEME_URI),
				'error404Url' => esc_url_raw($error404_url),
			)
		);

		wp_enqueue_script('iqconnetik-customize-controls');

		wp_register_script(
			'vue-runtime',
			IQCONNETIK_THEME_URI . '/assets/js/vendor/vue.min.js',
			array(),
			IQCONNETIK_THEME_VERSION,
			true
		);
		wp_enqueue_script('vue-runtime');
	}
endif;
add_action('customize_controls_enqueue_scripts', 'iqconnetik_customizer_js');

//admin styles
if (!function_exists('iqconnetik_action_load_custom_wp_admin_style')) :
	function iqconnetik_action_load_custom_wp_admin_style()
	{
		wp_register_style('iqconnetik-custom-wp-admin-css', IQCONNETIK_THEME_URI . '/assets/css/admin-backend.css', false, IQCONNETIK_THEME_VERSION);
		wp_enqueue_style('iqconnetik-custom-wp-admin-css');
		$iqconnetik_colors_string = iqconnetik_get_root_colors_inline_styles_string();
		if (!empty($iqconnetik_colors_string)) :
			wp_add_inline_style(
				'iqconnetik-custom-wp-admin-css',
				wp_kses(
					':root{' . $iqconnetik_colors_string . '}',
					false
				)
			);
		endif;
	} //iqconnetik_action_load_custom_wp_admin_style()
endif;
add_action('admin_enqueue_scripts', 'iqconnetik_action_load_custom_wp_admin_style');

//comment_date
add_filter('get_comment_date', 'iqconnetik_comment_date');
function iqconnetik_comment_date($date)
{
	$date = date("F d, Y");
	return $date;
}

//demo content on remote hosting
/**
 * @param FW_Ext_Backups_Demo[] $demos
 *
 * @return FW_Ext_Backups_Demo[]
 */
if (!function_exists('iqconnetik_filter_theme_fw_ext_backups_demos')) :

	function iqconnetik_filter_theme_fw_ext_backups_demos($demos)
	{
		$secret_demo_id = IQCONNETIK_REMOTE_DEMO_ID; // as example: '12345678'

		$demo_version_suffix = '-v' . IQCONNETIK_REMOTE_DEMO_VERSION; // '-v1.0.0' (Only for main demo)
		if (class_exists('FW_Ext_Backups_Demo')) :
			$demos_array = array(
				'iqconnetik-demo' . $demo_version_suffix => array(
					'title'        => esc_html__('Iqconnetik Demo', 'iqconnetik'),
					'screenshot'   => esc_url('//webdesign-finder.com/remote-demo-content/iqconnetik-v2/demo/screenshot.png'),
					'preview_link' => esc_url('//webdesign-finder.com/iqconnetik-v2/'),
				),
			);

			// Demo ( Colorized )
			$demo_colorized_id = 'iqconnetik-demo-colorized-' . $secret_demo_id;
			if ($secret_demo_id) {
				$demos_array[$demo_colorized_id] = array(
					'title'        => esc_html__('Iqconnetik Demo (Colorized)', 'iqconnetik'),
					'screenshot'   => esc_url('//webdesign-finder.com/remote-demo-content/iqconnetik-v2/demo/screenshot.png'),
					'preview_link' => esc_url('//webdesign-finder.com/iqconnetik-v2'),
				);
			}

			$download_url = esc_url('http://webdesign-finder.com/remote-demo-content/iqconnetik-v2/demo/');

			foreach ($demos_array as $id => $data) {
				$demo = new FW_Ext_Backups_Demo($id, 'piecemeal', array(
					'url'     => $download_url,
					'file_id' => $id,
				));
				$demo->set_title($data['title']);
				$demo->set_screenshot($data['screenshot']);
				$demo->set_preview_link($data['preview_link']);

				$demos[$demo->get_id()] = $demo;

				unset($demo);
			}

			return $demos;

		endif; //class_exists
	} //iqconnetik_filter_theme_fw_ext_backups_demos()
endif;
add_filter('fw:ext:backups-demo:demos', 'iqconnetik_filter_theme_fw_ext_backups_demos');

//SSA Google Fonts
add_action('ssa_booking_head', 'iqconnetik_appointment_get_google_fonts');
//SSA root colors
add_action('ssa_booking_head', 'iqconnetik_appointment_get_root_colors_inline_styles_string');

if (!function_exists('iqconnetik_appointment_get_google_fonts')) :
	function iqconnetik_appointment_get_google_fonts()
	{
		$iqconnetik_font_body     = json_decode(iqconnetik_option('font_body', '{"font":"","variant": [],"subset":[]}'));
		$iqconnetik_font_headings = json_decode(iqconnetik_option('font_headings', '{"font":"","variant": [],"subset":[]}'));
		//TODO subsets can exists even if no font selected
		if (!empty($iqconnetik_font_body->font) || !empty($iqconnetik_font_headings->font)) {
			/*
			Translators: If there are characters in your language that are not supported
			by chosen font(s), translate this to 'off'. Do not translate into your own language.
			*/

			if ('off' !== esc_html_x('on', 'Google font: on or off', 'iqconnetik')) {
				$iqconnetik_body_subsets  = array();
				if (!empty($iqconnetik_font_body->font)) {
					if (!empty($iqconnetik_font_body->variant)) {
						$iqconnetik_font_body->font .= ':' . implode(',', $iqconnetik_font_body->variant);
					}
					$iqconnetik_body_subsets  = $iqconnetik_font_body->subset;
				}

				$iqconnetik_headings_subsets  = array();
				if (!empty($iqconnetik_font_headings->font)) {
					if (!empty($iqconnetik_font_headings->variant)) {
						$iqconnetik_font_headings->font .= ':' . implode(',', $iqconnetik_font_headings->variant);
					}
					$iqconnetik_headings_subsets  = $iqconnetik_font_headings->subset;
				}

				$iqconnetik_fonts    = array(
					'body'     => $iqconnetik_font_body->font,
					'headings' => $iqconnetik_font_headings->font,
				);
				$iqconnetik_subsets  = array(
					'body'     => implode(',', $iqconnetik_body_subsets),
					'headings' => implode(',', $iqconnetik_headings_subsets),
				);
				//'Montserrat|Bowlby One|Quattrocento Sans';
				$iqconnetik_fonts_string    = implode('|', array_filter($iqconnetik_fonts));
				$iqconnetik_subsets_string  = implode(',', array_filter($iqconnetik_subsets));

				$iqconnetik_query_args = array(
					'family' => urlencode($iqconnetik_fonts_string),
				);
				if (!empty($iqconnetik_subsets_string)) {
					$iqconnetik_query_args['subset'] = urlencode($iqconnetik_subsets_string);
				}
				$iqconnetik_query_args['display'] = 'swap';
				$iqconnetik_font_url = add_query_arg(
					$iqconnetik_query_args,
					'//fonts.googleapis.com/css'
				);
			}
		}
		echo ('<link rel="stylesheet" id="iqconnetik-google-fonts-style-css" href="' . $iqconnetik_font_url . '&ver=1.0.0" media="all">');
	}
endif;

if (!function_exists('iqconnetik_appointment_get_root_colors_inline_styles_string')) :
	function iqconnetik_appointment_get_root_colors_inline_styles_string()
	{
		$iqconnetik_colors_string = iqconnetik_get_root_colors_inline_styles_string();
		if (!empty($iqconnetik_colors_string)) {
			echo ('<style id="iqconnetik-ssa-style-inline-css"> :root{' . $iqconnetik_colors_string . '} </style>');
		}
	}
endif;
