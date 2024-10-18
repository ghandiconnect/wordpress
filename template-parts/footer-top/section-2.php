<?php

/**
 * The footer top section template file
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

//text
$iqconnetik_footer_top_heading     = iqconnetik_option('footer_top_heading', '');
$iqconnetik_footer_top_description = iqconnetik_option('footer_top_description', '');
$iqconnetik_footer_top_shortcode   = iqconnetik_option('footer_top_shortcode', '');

if (
	empty($iqconnetik_footer_top_heading)
	&&
	empty($iqconnetik_footer_top_description)
	&&
	empty($iqconnetik_footer_top_shortcode)
) {
	return;
}

$iqconnetik_fluid = iqconnetik_option('footer_fluid') ? '-fluid' : '';

$iqconnetik_footer_top_background = iqconnetik_option('footer_top_background', '');
$iqconnetik_extra_padding_top     = iqconnetik_option('footer_top_extra_padding_top', '');
$iqconnetik_extra_padding_bottom  = iqconnetik_option('footer_top_extra_padding_bottom', '');

$iqconnetik_border_top    = iqconnetik_option('footer_top_border_top', '');
$iqconnetik_border_bottom = iqconnetik_option('footer_top_border_bottom', '');
$iqconnetik_font_size     = iqconnetik_option('footer_top_font_size', '');

$iqconnetik_background_image = iqconnetik_section_background_image_array('footer_top');

//animation
//animate an__XXX
//footer_top_heading_animation
//footer_top_description_animation
//footer_top_button_first_animation
//footer_top_button_second_animation
//footer_top_shortcode_animation
$iqconnetik_footer_top_heading_animation       = iqconnetik_option('footer_top_heading_animation', '') ? 'animate an__' . iqconnetik_option('footer_top_heading_animation') : '';
$iqconnetik_footer_top_description_animation   = iqconnetik_option('footer_top_description_animation', '') ? 'animate an__' . iqconnetik_option('footer_top_description_animation') : '';
$iqconnetik_footer_top_button_first_animation  = iqconnetik_option('footer_top_button_first_animation', '') ? 'animate an__' . iqconnetik_option('footer_top_button_first_animation') : '';
$iqconnetik_footer_top_button_second_animation = iqconnetik_option('footer_top_button_second_animation', '') ? 'animate an__' . iqconnetik_option('footer_top_button_second_animation') : '';
$iqconnetik_footer_top_shortcode_animation     = iqconnetik_option('footer_top_shortcode_animation', '') ? 'animate an__' . iqconnetik_option('footer_top_shortcode_animation') : '';

?>
<section id="footer-top" class="footer-top footer-top-2 text-center <?php echo esc_attr($iqconnetik_footer_top_background . ' ' . $iqconnetik_font_size . ' ' . $iqconnetik_background_image['class']); ?>" <?php echo (!empty($iqconnetik_background_image['url'])) ? 'style="background-image: url(' . esc_url($iqconnetik_background_image['url']) . ');"' : ''; ?>>
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

		if (!empty($iqconnetik_footer_top_heading)) :
			$iqconnetik_footer_top_heading_mt = iqconnetik_option('footer_top_heading_mt', '');
			$iqconnetik_footer_top_heading_mb = iqconnetik_option('footer_top_heading_mb', '');
		?>
			<h3 class="footer_top-heading <?php echo esc_attr($iqconnetik_footer_top_heading_animation . ' ' . $iqconnetik_footer_top_heading_mt . ' ' . $iqconnetik_footer_top_heading_mb); ?>">
				<?php echo wp_kses_post($iqconnetik_footer_top_heading); ?>
			</h3>
		<?php
		endif; //footer_top_heading

		if (!empty($iqconnetik_footer_top_description)) :
			$iqconnetik_footer_top_description_mt = iqconnetik_option('footer_top_description_mt', '');
			$iqconnetik_footer_top_description_mb = iqconnetik_option('footer_top_description_mb', '');
		?>
			<div class="footer_top-description <?php echo esc_attr($iqconnetik_footer_top_description_animation . ' ' . $iqconnetik_footer_top_description_mt . ' ' . $iqconnetik_footer_top_description_mb); ?>">
				<?php echo wp_kses_post($iqconnetik_footer_top_description); ?>
			</div>
		<?php
		endif; //footer_top_description

		if (!empty($iqconnetik_footer_top_shortcode)) :
			$iqconnetik_footer_top_shortcode_mt = iqconnetik_option('footer_top_shortcode_mt', '');
			$iqconnetik_footer_top_shortcode_mb = iqconnetik_option('footer_top_shortcode_mb', '');
		?>
			<div class="footer_top-shortcode <?php echo esc_attr($iqconnetik_footer_top_shortcode_animation . ' ' . $iqconnetik_footer_top_shortcode_mt . ' ' . $iqconnetik_footer_top_shortcode_mb); ?>">
				<?php echo do_shortcode($iqconnetik_footer_top_shortcode); ?>
			</div>
		<?php
		endif; //footer_top_shortcode

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
</section><!-- #footer -->