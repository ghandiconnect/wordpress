<?php

/**
 * Theme setup function and sidebars registering
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Iqconnetik
 * @since 0.0.1
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}


if (!function_exists('iqconnetik_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */

	function iqconnetik_setup()
	{

		//remove_theme_support('widgets-block-editor');
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on this theme, use a find and replace
		 * to change 'iqconnetik' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('iqconnetik', IQCONNETIK_THEME_PATH . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails', array('post'));
		set_post_thumbnail_size(1500, 750, true);

		if (!isset($content_width)) {
			$content_width = 1170;
		}

		//image sizes - cropped
		add_image_size('iqconnetik-square', 600, 600, true);
		add_image_size('iqconnetik-default-post', 1500, 750, true);
		add_image_size('iqconnetik-full-width', 1170, 780, true);
		add_image_size('iqconnetik-small-width', 630, 700, true);
		add_image_size('iqconnetik-large-width', 625, 855, true);
		add_image_size('iqconnetik-service-width', 1170, 400, true);

		//Post formats
		add_theme_support('post-formats', array('image', 'aside', 'video', 'gallery', 'chat', 'quote', 'link', 'status'));

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style'));

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		$iqconnetik_custom_header_logo = array(
			'height'      => 60,
			'width'       => 150,
			'flex-width'  => true,
			'flex-height' => true,
		);

		add_theme_support('custom-logo', $iqconnetik_custom_header_logo);

		//Background image for header and title sections
		$iqconnetik_custom_header_args = array(
			'width'       => 1920,
			'height'      => 800,
			'header-text' => false,
		);
		add_theme_support('custom-header', $iqconnetik_custom_header_args);

		add_theme_support('custom-background');

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		// Gutenberg block editor
		add_theme_support(
			'editor-color-palette',
			array(
				// colorLight
				// colorFont
				// colorFontDark
				// colorBackground
				// colorBorder
				// colorBorderDark
				// colorDark
				// colorDarkGrey
				// colorGrey
				// colorMain
				// colorMain2
				// colorMain3
				// colorMain4
				array(
					'name'  => esc_html__('Light', 'iqconnetik'),
					'slug'  => 'light',
					'color' => 'var(--colorLight)',
				),
				array(
					'name'  => esc_html__('Font', 'iqconnetik'),
					'slug'  => 'font',
					'color' => 'var(--colorFont)',
				),
				array(
					'name'  => esc_html__('Font Dark', 'iqconnetik'),
					'slug'  => 'font-dark',
					'color' => 'var(--colorFontDark)',
				),
				array(
					'name'  => esc_html__('Background', 'iqconnetik'),
					'slug'  => 'background',
					'color' => 'var(--colorBackground)',
				),
				array(
					'name'  => esc_html__('Border', 'iqconnetik'),
					'slug'  => 'border',
					'color' => 'var(--colorBorder)',
				),
				array(
					'name'  => esc_html__('Dark Border', 'iqconnetik'),
					'slug'  => 'border-dark',
					'color' => 'var(--colorBorderDark)',
				),
				array(
					'name'  => esc_html__('Dark', 'iqconnetik'),
					'slug'  => 'dark',
					'color' => 'var(--colorDark)',
				),
				array(
					'name'  => esc_html__('Dark Grey', 'iqconnetik'),
					'slug'  => 'dark-grey',
					'color' => 'var(--colorDarkGrey)',
				),
				array(
					'name'  => esc_html__('Grey', 'iqconnetik'),
					'slug'  => 'grey',
					'color' => 'var(--colorGrey)',
				),
				array(
					'name'  => esc_html__('Accent', 'iqconnetik'),
					'slug'  => 'main',
					'color' => 'var(--colorMain)',
				),
				array(
					'name'  => esc_html__('Accent 2', 'iqconnetik'),
					'slug'  => 'main-2',
					'color' => 'var(--colorMain2)',
				),
				array(
					'name'  => esc_html__('Accent 3', 'iqconnetik'),
					'slug'  => 'main-3',
					'color' => 'var(--colorMain3)',
				),
				array(
					'name'  => esc_html__('Accent 4', 'iqconnetik'),
					'slug'  => 'main-4',
					'color' => 'var(--colorMain4)',
				),
			)
		);

		// Add support for Block Styles.
		// add_theme_support( 'wp-block-styles' );
		// 'wp-block-library-theme' - loads in the backend even if not defined here

		// Add support for full and wide align images.
		add_theme_support('align-wide');

		// Enqueue editor styles.
		add_theme_support('editor-styles');
		$min = get_theme_mod('assets_min') ? 'min/' : '';
		add_editor_style('assets/css/' . $min . 'editor-style.css');

		// Add support for responsive embedded content.
		// It will add JS file to the footer
		// add_theme_support( 'responsive-embeds' );

		//Yoast breadcrumbs support
		add_theme_support('yoast-seo-breadcrumbs');

		//WooCommerce
		add_theme_support('woocommerce');
		add_theme_support('wc-product-gallery-lightbox');
		add_theme_support('wc-product-gallery-slider');

		// This theme uses wp_nav_menu() in four locations.
		register_nav_menus(
			array(
				'primary'   => esc_html__('Main Menu', 'iqconnetik'),
				'copyright' => esc_html__('Copyright Menu', 'iqconnetik'),
			)
		);
	}
endif;
add_action('after_setup_theme', 'iqconnetik_setup');


if (!function_exists('iqconnetik_widgets_init')) :
	/**
	 * Register widget area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	function iqconnetik_widgets_init()
	{

		register_sidebar(
			array(
				'name'          => esc_html__('Main', 'iqconnetik'),
				'id'            => 'sidebar-1',
				'description'   => esc_html__('Add widgets here to appear in your sidebar.', 'iqconnetik'),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__('Footer Top', 'iqconnetik'),
				'id'            => 'sidebar-footer-top',
				'description'   => esc_html__('Add widgets here to appear in your footer top.', 'iqconnetik'),
				'before_widget' => '<div id="%1$s" class="grid-item widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__('Footer', 'iqconnetik'),
				'id'            => 'sidebar-footer',
				'description'   => esc_html__('Add widgets here to appear in your footer.', 'iqconnetik'),
				'before_widget' => '<div id="%1$s" class="grid-item widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__('Footer - Three equal columns (first column)', 'iqconnetik'),
				'id'            => 'sidebar-footer-1',
				'description'   => esc_html__('Add widgets here to appear in your footer.', 'iqconnetik'),
				'before_widget' => '<div id="%1$s" class="%2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__('Footer - Three equal columns (second column)', 'iqconnetik'),
				'id'            => 'sidebar-footer-2',
				'description'   => esc_html__('Add widgets here to appear in your footer.', 'iqconnetik'),
				'before_widget' => '<div id="%1$s" class="%2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__('Footer - Three equal columns (third column)', 'iqconnetik'),
				'id'            => 'sidebar-footer-3',
				'description'   => esc_html__('Add widgets here to appear in your footer.', 'iqconnetik'),
				'before_widget' => '<div id="%1$s" class="%2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__('For Toggle Menu Side', 'iqconnetik'),
				'id'            => 'sidebar-toggle-menu-side',
				'description'   => esc_html__('Add widgets here to appear in your header.', 'iqconnetik'),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__('Home page above columns', 'iqconnetik'),
				'id'            => 'sidebar-home-before-columns',
				'description'   => esc_html__('These widgets will appear on "Home" page above columns.', 'iqconnetik'),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__('Home page above content', 'iqconnetik'),
				'id'            => 'sidebar-home-before-content',
				'description'   => esc_html__('These widgets will appear on "Home" page above content', 'iqconnetik'),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__('Home page main sidebar', 'iqconnetik'),
				'id'            => 'sidebar-home-main',
				'description'   => esc_html__('These widgets will appear on "Home" page in main sidebar.', 'iqconnetik'),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__('Home page below content', 'iqconnetik'),
				'id'            => 'sidebar-home-after-content',
				'description'   => esc_html__('These widgets will appear on "Home" page below main content', 'iqconnetik'),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__('Home page below columns', 'iqconnetik'),
				'id'            => 'sidebar-home-after-columns',
				'description'   => esc_html__('These widgets will appear on "Home" page below columns', 'iqconnetik'),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__('Employers', 'iqconnetik'),
				'id'            => 'sidebar-employers',
				'description'   => esc_html__('Add widgets here to appear in your sidebar.', 'iqconnetik'),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			)
		);

		//WooCommerce sidebar
		if (class_exists('WooCommerce')) {
			register_sidebar(
				array(
					'name'          => esc_html__('Shop', 'iqconnetik'),
					'id'            => 'shop',
					'description'   => esc_html__('This sidebar will appear on shop pages', 'iqconnetik'),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h3 class="widget-title"><span>',
					'after_title'   => '</span></h3>',
				)
			);
		}
	}
endif;
add_action('widgets_init', 'iqconnetik_widgets_init');


//copy parent theme mods on first child theme activation
if (!function_exists('iqconnetik_switch_theme_update_mods')) :
	function iqconnetik_switch_theme_update_mods($iqconnetik_new_theme)
	{

		if (is_child_theme()) {
			$iqconnetik_new_theme_mods = get_theme_mods();

			//if is child theme and current theme mods are empty - set theme mods from parent theme
			if (empty($iqconnetik_new_theme_mods) || 1 === count($iqconnetik_new_theme_mods) || 2 === count($iqconnetik_new_theme_mods)) {
				$iqconnetik_mods = get_option('theme_mods_' . get_template());

				if (!empty($iqconnetik_mods)) {
					foreach ((array) $iqconnetik_mods as $iqconnetik_mod => $iqconnetik_mod_value) {
						// if ( 'sidebars_widgets' !== $iqconnetik_mod )
						set_theme_mod($iqconnetik_mod, $iqconnetik_mod_value);
					}
				}
			}
		}
	}
endif;
add_action('after_switch_theme', 'iqconnetik_switch_theme_update_mods');

// wrap two widgets in custom footer
add_filter('dynamic_sidebar_params', 'iqconnetik_wrap_for_custom_footer');
function iqconnetik_wrap_for_custom_footer($params)
{
	if (get_theme_mod('footer') == '8') {
		static $widget_counter;
		$total_widgets = wp_get_sidebars_widgets();
		$sidebar_widgets = count($total_widgets['sidebar-footer']);
		if ($sidebar_widgets > 4) {
			if ($params[0]['id'] == 'sidebar-footer') {

				if ($widget_counter == 2) {
					$params[0]['before_widget'] = '<div class="grid-item several-widgets">' . $params[0]['before_widget'];
				}
				if ($widget_counter == 3) {
					$params[0]['after_widget'] = '</div></div>';
				}
				$widget_counter++;
			}
		}
	}
	return $params;
}

// registration form
if (!function_exists('iqconnetik_registration_form')) :
	function iqconnetik_registration_form()
	{
?>
		<?php
		$user_login = '';
		$user_email = '';
		$user_password = '';
		$registration_redirect = !empty($_REQUEST['redirect_to']) ? $_REQUEST['redirect_to'] : '';
		$redirect_to = apply_filters('registration_redirect', $registration_redirect);
		?>

		<form name="registerform" id="registerform" action="<?php echo esc_url(site_url('wp-login.php?action=register', 'login_post')); ?>" method="post" novalidate="novalidate">
			<p>
				<input type="text" name="user_login" id="user_login_modal" placeholder="<?php esc_attr_e('Full name', 'iqconnetik'); ?>" class="input" value="<?php echo esc_attr(wp_unslash($user_login)); ?>" size="20" autocapitalize="off" />
			</p>
			<p>
				<input type="email" name="user_email" id="user_email" placeholder="<?php esc_attr_e('Email address', 'iqconnetik'); ?>" class="input" value="<?php echo esc_attr(wp_unslash($user_email)); ?>" size="25" />
			</p>
			<p>
				<input type="password" name="pwd" id="user_password" placeholder="<?php esc_attr_e('Password', 'iqconnetik'); ?>" class="input" value="<?php echo esc_attr(wp_unslash($user_password)); ?>" size="25" />
			</p>
			<?php
			/**
			 * Fires following the 'Email' field in the user registration form.
			 *
			 * @since 2.1.0
			 */
			do_action('register_form');
			?>
			<br class="clear" />
			<input type="hidden" name="redirect_to" value="<?php echo esc_attr($redirect_to); ?>" />
			<p class="submit"><button type="submit" name="wp-submit" id="wp-submit-modal" class="wp-submit"><?php esc_html_e('Sign up', 'iqconnetik'); ?></button></p>
		</form>
<?php
		return;
	}
endif; //function_exists
add_action('user_registration_form', 'iqconnetik_registration_form');
