<?php

/**
 * The copyright section template file
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

$iqconnetik_fluid = iqconnetik_option('copyright_fluid') ? '-fluid' : '';

$iqconnetik_text = iqconnetik_option('copyright_text', '');
if (empty($iqconnetik_text)) {
	$iqconnetik_text = get_bloginfo('name', 'display');
}

$iqconnetik_copyright_background = iqconnetik_option('copyright_background', '');
$iqconnetik_extra_padding_top    = iqconnetik_option('copyright_extra_padding_top');
$iqconnetik_extra_padding_bottom = iqconnetik_option('copyright_extra_padding_bottom');
$iqconnetik_font_size            = iqconnetik_option('copyright_font_size', '');

$iqconnetik_background_image = iqconnetik_section_background_image_array('copyright'); ?>
<div id="copyright" class="copyright copyright-4 <?php echo esc_attr($iqconnetik_copyright_background . ' ' . $iqconnetik_font_size . ' ' . $iqconnetik_background_image['class']); ?>" <?php echo (!empty($iqconnetik_background_image['url'])) ? 'style="background-image: url(' . esc_url($iqconnetik_background_image['url']) . ');"' : ''; ?>>
	<div class="container<?php echo esc_attr($iqconnetik_fluid . ' ' . $iqconnetik_extra_padding_top . ' ' . $iqconnetik_extra_padding_bottom); ?>">
		<div class="cols-2">

			<div class="copyright-text color-darkgrey">
				<?php echo wp_kses_post(iqconnetik_get_copyright_text($iqconnetik_text)); ?>
			</div>
			<?php
			iqconnetik_social_links();
			?>
		</div><!-- .cols-2 -->
	</div><!-- .container -->

</div><!-- #copyright -->