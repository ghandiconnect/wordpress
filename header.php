<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Iqconnetik
 * @since 0.0.1
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

$iqconnetik_body_itemtype = iqconnetik_get_body_schema_itemtype();

//light or dark version
$iqconnetik_main_version = iqconnetik_option('main_version');

?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js-disabled<?php echo is_customize_preview() ? ' customize-preview' : ''; ?>">

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>

<body id="body" <?php body_class(); ?> itemtype="https://schema.org/<?php echo esc_attr($iqconnetik_body_itemtype); ?>" itemscope="itemscope" <?php iqconnetik_animated_elements_markup(); ?>>
	<?php
	if (function_exists('wp_body_open')) {
		wp_body_open();
	}

	get_template_part('template-parts/header/header-preloader');

	/**
	 * Fires at the top of whole web page before the header.
	 *
	 * @since WBPlank 0.0.1
	 */
	do_action('iqconnetik_action_before_header');

	?>
	<div id="search_dropdown">
		<?php
		if (class_exists('WooCommerce')) :
			get_product_search_form();
		else :
			get_search_form();
		endif;
		?>
	</div><!-- #search_dropdown -->
	<button id="search_modal_close" class="nav-btn" aria-controls="search_dropdown" aria-expanded="true" aria-label="<?php esc_attr_e('Search Toggler', 'iqconnetik'); ?>">
		<span></span>
	</button>
	<div id="login_dropdown" class="modalLoginWrap">
		<?php
		$iqconnetik_logo_background     = iqconnetik_option('header_logo_background', '');
		$iqconnetik_logo_modal_text     = !empty(iqconnetik_option('header_logo_modal_text')) ? iqconnetik_option('header_logo_modal_text') : 'Register';
		?>
		<div class="modal modal-login active">
			<div class="img-section i" <?php echo (!empty($iqconnetik_logo_background)) ? 'style="background-image: url(' . esc_url($iqconnetik_logo_background) . ');"' : ''; ?>>
				<h5><?php echo esc_html__($iqconnetik_logo_modal_text) ?></h5>
				<button class="btn btn-gradient btn-big btn-wide" data-toggle="modal-registration"><?php echo esc_html__('Sign up', 'iqconnetik') ?></button>
			</div>
			<div class="form-section l">
				<h5><?php echo  esc_html__('Sign in', 'iqconnetik'); ?></h5>
				<?php
				if (!is_user_logged_in()) :
					wp_login_form(array(
						'label_username' => esc_html__('Email address', 'iqconnetik'),
						'label_password' => esc_html__('Password', 'iqconnetik'),
						'label_remember' => esc_html__('Remember Me', 'iqconnetik'),
						'label_log_in' => esc_html__('Log in', 'iqconnetik'),
						'remember' => esc_html__('Remember me', 'iqconnetik'),
					));

				else :
					$html = '<a href="' . esc_url(wp_logout_url()) . '" class="btn btn-gradient btn-big btn-wide">' . esc_html__('Log out', 'iqconnetik') . '</a>';
					if (current_user_can('read')) {
						$html .= ' <a href="' . admin_url() . '" class="btn btn-gradient btn-big btn-wide">' . esc_html__('Site Admin', 'iqconnetik') . '</a>';
					}
					echo wp_kses_post($html);
				endif; //is_user_logged_in
				?>
				<?php if (!is_user_logged_in()) : ?>
					<a class="mt-2" href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e('Lost your password?', 'iqconnetik'); ?></a>
				<?php endif; ?>
			</div>
		</div>
		<div class="modal modal-registration">
			<div class="form-section l">
				<h5><?php echo esc_html__('Registration', 'iqconnetik') ?></h5>
				<?php
				do_action('user_registration_form');
				?>
			</div>
			<div class="img-section i" <?php echo (!empty($iqconnetik_logo_background)) ? 'style="background-image: url(' . esc_url($iqconnetik_logo_background) . ');"' : ''; ?>>
				<h5><?php echo esc_html__('Log in', 'iqconnetik') ?></h5>
				<button class="btn btn-gradient btn-big btn-wide" data-toggle="modal-login"><?php echo esc_html__('Sign in', 'iqconnetik') ?></button>
			</div>
		</div>
	</div><!-- #search_dropdown -->
	<button id="login_modal_close" aria-controls="login_dropdown" class="nav-btn" aria-expanded="true" aria-label="<?php esc_attr_e('Login Toggler', 'iqconnetik'); ?>">
		<span></span>
	</button>
	<?php
	$iqconnetik_box_fade_in_class = iqconnetik_option('box_fade_in', '') ? 'box-fade-in' : 'box-normal';
	$iqconnetik_boxed = iqconnetik_option('boxed', '') ? 'boxed' : '';
	?>
	<div id="box" class="<?php echo esc_attr($iqconnetik_box_fade_in_class . ' ' . $iqconnetik_boxed); ?>">
		<?php

		//topline, header and title here:
		get_template_part('template-parts/header/header-top');

		//not opening container for 404 page or for full-width page template
		if (!is_page_template('page-templates/full-width.php') && !is_404() && !is_page_template('page-templates/home.php')) :
			if (function_exists('is_woocommerce') && is_woocommerce() && !empty(iqconnetik_option('shop_sidebar_width', ''))) :
				$iqconnetik_main_sidebar_width   = iqconnetik_option('shop_sidebar_width', '');
				$iqconnetik_main_gap_width       = iqconnetik_option('shop_gap_width', 'default');
			else :
				$iqconnetik_main_sidebar_width   = iqconnetik_option('main_sidebar_width', '');
				$iqconnetik_main_gap_width       = iqconnetik_option('main_gap_width', 'default');
			endif;
			$iqconnetik_extra_padding_top    = iqconnetik_option('main_extra_padding_top', '');
			$iqconnetik_extra_padding_bottom = iqconnetik_option('main_extra_padding_bottom', '');
			$iqconnetik_font_size            = iqconnetik_option('main_font_size', '');
			$iqconnetik_main_css_classes     = iqconnetik_get_page_main_section_css_classes();
			$iqconnetik_css_classes          = iqconnetik_get_layout_css_classes();

			if (empty($iqconnetik_extra_padding_top) && !iqconnetik_is_title_section_is_shown()) {
				$iqconnetik_extra_padding_top = 'pt-5';
			}
			//no top padding for page template without title and padding
			if (
				is_page_template('page-templates/no-sidebar-no-title.php')
				||
				is_page_template('page-templates/no-sidebar-no-padding.php')
				||
				is_page_template('page-templates/home.php')
			) {
				$iqconnetik_extra_padding_top    = 'pt-0';
				$iqconnetik_extra_padding_bottom = 'pb-0';
			}
		?>
			<div id="main" class="main <?php echo esc_attr('sidebar-' . $iqconnetik_main_sidebar_width . ' sidebar-gap-' . $iqconnetik_main_gap_width . ' ' . $iqconnetik_main_css_classes . ' ' . $iqconnetik_main_version); ?>">
				<div class="container <?php echo esc_attr($iqconnetik_extra_padding_top . ' ' . $iqconnetik_extra_padding_bottom); ?>">

					<?php
					//full width widget area before columns for home page
					if (iqconnetik_is_front_page() && is_active_sidebar('sidebar-home-before-columns')) :
					?>
						<div class="sidebar-home sidebar-home-before sidebar-home-before-columns">
							<?php dynamic_sidebar('sidebar-home-before-columns'); ?>
						</div><!-- .sidebar-home-before-columns -->
					<?php endif; ?>
					<div id="columns" class="main-columns">
						<main id="col" class="<?php echo esc_attr($iqconnetik_css_classes['main'] . ' ' . $iqconnetik_font_size); ?>">
						<?php
						/**
						 * Fires at the top of main column.
						 *
						 * @since WBPlank 0.0.1
						 */
						do_action('iqconnetik_action_top_of_main_column');

					endif; //full-width & 404
					if (iqconnetik_is_front_page() && is_active_sidebar('sidebar-home-before-content')) :
						?>
							<div class="sidebar-home sidebar-home-before sidebar-home-before-content">
								<?php dynamic_sidebar('sidebar-home-before-content'); ?>
							</div><!-- .sidebar-home-before-content -->
						<?php
					endif; //iqconnetik_is_front_page
