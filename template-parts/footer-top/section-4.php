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
$iqconnetik_footer_top_widget      = is_active_sidebar('sidebar-footer-top');
$iqconnetik_footer_top_shortcode   = iqconnetik_option('footer_top_shortcode', '');

if (
	empty($iqconnetik_footer_top_heading)
	&&
	empty($iqconnetik_footer_top_description)
	&&
	empty($iqconnetik_footer_top_widget)
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
$iqconnetik_footer_top_layout_gap = iqconnetik_option('footer_top_layout_gap', '');

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
<section id="footer-top" class="footer-top footer-top-1 <?php echo esc_attr($iqconnetik_footer_top_background . ' ' . $iqconnetik_font_size . ' ' . $iqconnetik_background_image['class']); ?>" <?php echo (!empty($iqconnetik_background_image['url'])) ? 'style="background-image: url(' . esc_url($iqconnetik_background_image['url']) . ');"' : ''; ?>>
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

		if (is_active_sidebar('sidebar-footer-top')) :
		?>
			<div class="footer-top-widgets <?php echo esc_attr('layout-gap-' . $iqconnetik_footer_top_layout_gap); ?>">
				<div class="layout-cols-4 grid-wrapper">
					<?php
					dynamic_sidebar('sidebar-footer-top');
					?>
				</div>
			</div><!-- .footer-top-widgets -->
		<?php
		endif;

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
<?php
$footer_top_bottom_section     = iqconnetik_option('footer_top_bottom_section', '');
if (!empty($footer_top_bottom_section)) {

	//text
	$iqconnetik_footer_top_bottom_section_heading     = iqconnetik_option('footer_top_bottom_section_heading', '');
	$iqconnetik_footer_top_bottom_section_description = iqconnetik_option('footer_top_bottom_section_description', '');
	$iqconnetik_footer_top_bottom_section_shortcode   = iqconnetik_option('footer_top_bottom_section_shortcode', '');

	$iqconnetik_bottom_section_fluid = iqconnetik_option('footer_top_bottom_section_fluid') ? '-fluid' : '';

	$iqconnetik_footer_top_bottom_section_background = iqconnetik_option('footer_top_bottom_section_background', '');
	$iqconnetik_bottom_section_extra_padding_top     = iqconnetik_option('footer_top_bottom_section_extra_padding_top', '');
	$iqconnetik_bottom_section_extra_padding_bottom  = iqconnetik_option('footer_top_bottom_section_extra_padding_bottom', '');

	$iqconnetik_bottom_section_border_top    = iqconnetik_option('footer_top_bottom_section_border_top', '');
	$iqconnetik_bottom_section_border_bottom = iqconnetik_option('footer_top_bottom_section_border_bottom', '');
	$iqconnetik_bottom_section_font_size     = iqconnetik_option('footer_top_bottom_section_font_size', '');

	$iqconnetik_bottom_section_background_image = iqconnetik_section_background_image_array('footer_top_bottom_section');

	if (
		empty($iqconnetik_footer_top_bottom_section_heading)
		&&
		empty($iqconnetik_footer_top_bottom_section_description)
		&&
		empty($iqconnetik_footer_top_bottom_section_shortcode)
	) {
		return;
	}

	$footer_top_bottom_section_home_page_only = iqconnetik_option('footer_top_bottom_section_home_page_only', '');

	if (
		!empty($footer_top_bottom_section_home_page_only)
		&&
		!is_front_page()
	) {
		return;
	}
?>

	<section id="footer-top-bottom-section" class="footer-top-bottom-section <?php echo esc_attr($iqconnetik_footer_top_bottom_section_background . ' ' . $iqconnetik_bottom_section_font_size . ' ' . $iqconnetik_bottom_section_background_image['class']); ?>" <?php echo (!empty($iqconnetik_bottom_section_background_image['url'])) ? 'style="background-image: url(' . esc_url($iqconnetik_bottom_section_background_image['url']) . ');"' : ''; ?>>
		<?php
		if ('full' === $iqconnetik_bottom_section_border_top) {
			echo wp_kses_post('<hr class="section-hr">');
		}
		?>
		<div class="container<?php echo esc_attr($iqconnetik_bottom_section_fluid . ' ' . $iqconnetik_bottom_section_extra_padding_top . ' ' . $iqconnetik_bottom_section_extra_padding_bottom); ?>">
			<?php
			if ('container' === $iqconnetik_bottom_section_border_top) {
				echo wp_kses_post('<hr class="section-hr">');
			}

			if (!empty($iqconnetik_footer_top_bottom_section_heading)) :
				$iqconnetik_footer_top_bottom_section_heading_mb = iqconnetik_option('footer_top_bottom_section_heading_mb', '');
			?>
				<h3 class="footer_top_bottom_section-heading <?php echo esc_attr($iqconnetik_footer_top_bottom_section_heading_mb); ?>">
					<?php echo wp_kses_post($iqconnetik_footer_top_bottom_section_heading); ?>
				</h3>
			<?php
			endif; //footer_top_heading

			if (!empty($iqconnetik_footer_top_bottom_section_description)) :
				$iqconnetik_footer_top_bottom_section_description_mb = iqconnetik_option('footer_top_bottom_section_description_mb', '');
			?>
				<div class="footer_top_bottom_section-description <?php echo esc_attr($iqconnetik_footer_top_bottom_section_description_mb); ?>">
					<?php echo wp_kses_post($iqconnetik_footer_top_bottom_section_description); ?>
				</div>
			<?php
			endif; //footer_top_description

			if (!empty($iqconnetik_footer_top_bottom_section_shortcode)) :
				$iqconnetik_footer_top_bottom_section_shortcode_mb = iqconnetik_option('footer_top_bottom_section_shortcode_mb', '');
			?>
				<div class="footer_top_bottom_section-shortcode <?php echo esc_attr($iqconnetik_footer_top_bottom_section_shortcode_mb); ?>">
					<?php echo do_shortcode($iqconnetik_footer_top_bottom_section_shortcode); ?>
				</div>
			<?php
			endif; //footer_top_shortcode

			if ('container' === $iqconnetik_bottom_section_border_bottom) {
				echo wp_kses_post('<hr class="section-hr">');
			}
			?>
		</div><!-- .container -->
		<?php
		if ('full' === $iqconnetik_bottom_section_border_bottom) {
			echo wp_kses_post('<hr class="section-hr">');
		}
		?>
	</section><!-- .footer -->
<?php } ?>