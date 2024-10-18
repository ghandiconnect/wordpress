<?php

/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Iqconnetik
 * @since 0.0.1
 * @version 0.0.1
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

$iqconnetik_css_classes = iqconnetik_get_layout_css_classes();

if (empty($iqconnetik_css_classes['aside'])) {
	if (is_customize_preview()) {
		echo '<aside id="aside" class="d-none"></aside>';
	}
	return;
}
$iqconnetik_sidebar_sticky       = iqconnetik_option('main_sidebar_sticky', false);
$iqconnetik_sidebar_sticky_class = !empty($iqconnetik_sidebar_sticky) ? ' sticky' : '';
$iqconnetik_font_size            = iqconnetik_option('sidebar_font_size', '');
$iqconnetik_sidebar_extra_class  = '';
if (is_page_template('page-templates/home.php') || is_front_page()) {
	if (is_active_sidebar('sidebar-home-after-columns')) {
		$iqconnetik_sidebar_extra_class .= 'with-after-columns-sidebar';
	}
}
?>
<aside id="aside" itemtype="https://schema.org/WPSideBar" itemscope="itemscope" class="<?php echo esc_attr($iqconnetik_css_classes['aside'] . ' ' . $iqconnetik_font_size . ' ' . $iqconnetik_sidebar_extra_class); ?>">
	<div class="widgets-wrap<?php echo esc_attr($iqconnetik_sidebar_sticky_class); ?>">

		<?php
		/**
		 * Fires at the top of aside column.
		 *
		 * @since Iqconnetik 0.0.1
		 */
		do_action('iqconnetik_action_top_of_aside_column');


		if (iqconnetik_is_shop()) {
			dynamic_sidebar('shop');
		} else {
			if (is_page_template('page-templates/home.php') || is_front_page()) {
				if (is_active_sidebar('sidebar-home-main')) {
					dynamic_sidebar('sidebar-home-main');
				} else {
					dynamic_sidebar('sidebar-1');
				}
			} else {
				dynamic_sidebar('sidebar-1');
			}
		}


		/**
		 * Fires at the bottom of aside column.
		 *
		 * @since Iqconnetik 0.0.1
		 */
		do_action('iqconnetik_action_bottom_of_aside_column');

		?>

	</div><!-- .widgets-wrap -->
</aside><!-- .column-aside -->