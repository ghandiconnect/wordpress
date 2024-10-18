<?php

/**
 * The footer section template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Iqconnetik
 * @since 0.0.1
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

//this footer displays only widgets so if has no widgets - it will be hidden
if (!is_active_sidebar('sidebar-footer')) {
	if (is_customize_preview()) {
		echo '<footer id="footer" class="d-none"></footer>';
	}
	return;
}

$iqconnetik_fluid = iqconnetik_option('footer_fluid') ? '-fluid' : '';

$iqconnetik_footer_background    = iqconnetik_option('footer_background', '');
$iqconnetik_extra_padding_top    = iqconnetik_option('footer_extra_padding_top', '');
$iqconnetik_extra_padding_bottom = iqconnetik_option('footer_extra_padding_bottom', '');

$iqconnetik_border_top        = iqconnetik_option('footer_border_top', '');
$iqconnetik_border_bottom     = iqconnetik_option('footer_border_bottom', '');
$iqconnetik_font_size         = iqconnetik_option('footer_font_size', '');
$iqconnetik_footer_layout_gap = iqconnetik_option('footer_layout_gap', '');

$iqconnetik_background_image = iqconnetik_section_background_image_array('footer');
?>
<footer id="footer" class="footer footer-3 <?php echo esc_attr($iqconnetik_footer_background . ' ' . $iqconnetik_font_size . ' ' . $iqconnetik_background_image['class']); ?>" <?php echo (!empty($iqconnetik_background_image['url'])) ? 'style="background-image: url(' . esc_url($iqconnetik_background_image['url']) . ');"' : ''; ?>>
	<?php
	if ('full' === $iqconnetik_border_top) {
		echo wp_kses_post('<hr class="section-hr">');
	}
	?>
	<div class="container<?php echo esc_attr($iqconnetik_fluid . ' ' . $iqconnetik_extra_padding_top . ' ' . $iqconnetik_extra_padding_bottom); ?>">
		<?php
		if ('container' === $iqconnetik_border_top) {
			echo wp_kses_post('<hr class="section-hr">');
		}

		?>
		<div class="layout-cols-4 <?php echo esc_attr('layout-gap-' . $iqconnetik_footer_layout_gap); ?>">
			<aside class="footer-widgets grid-wrapper one-half-second">
				<?php
				dynamic_sidebar('sidebar-footer');
				?>
			</aside><!-- .footer-widgets> -->
		</div>
		<?php

		if ('container' === $iqconnetik_border_bottom) {
			echo wp_kses_post('<hr class="section-hr">');
		}
		?>
	</div><!-- .container -->
	<?php
	if ('full' === $iqconnetik_border_bottom) {
		echo wp_kses_post('<hr class="section-hr">');
	}
	?>
</footer><!-- #footer -->