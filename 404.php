<?php

/**
 * The 404 page template file
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

$iqconnetik_404_heading          = iqconnetik_option('404_heading', '');
$iqconnetik_404_heading_img      = iqconnetik_option('404_heading_image', '');
$iqconnetik_404_text_bottom_line = iqconnetik_option('404_text_bottom_line', '');
$iqconnetik_background           = iqconnetik_option('404_background', '');
$iqconnetik_background_image     = iqconnetik_option('404_background_image', '');
$iqconnetik_overlay 		        = iqconnetik_option('404_background_image_overlay', '');

$iqconnetik_extra_padding_top    = iqconnetik_option('404_extra_padding_top', '');
$iqconnetik_extra_padding_bottom = iqconnetik_option('404_extra_padding_bottom', '');

$iqconnetik_404_content_align    = iqconnetik_option('404_content_align', '');

if (!empty($iqconnetik_overlay)) {
	$iqconnetik_overlay = ' background-overlay ' . $iqconnetik_overlay;
}

get_header();

?>
<div id="main" class="main section-404 <?php echo esc_attr($iqconnetik_background . ' background-cover cover-center ' . $iqconnetik_overlay); ?>" <?php echo (!empty($iqconnetik_background_image)) ? 'style="background-image: url(' . esc_url($iqconnetik_background_image) . ');"' : ''; ?>>
	<div class="container <?php echo esc_attr($iqconnetik_extra_padding_top . ' ' . $iqconnetik_extra_padding_bottom); ?>">
		<main class="<?php echo esc_attr($iqconnetik_404_content_align); ?>">
			<div id="layout" class="text-center">
				<div class="content-wrap">
					<?php echo (!empty($iqconnetik_404_heading_img)) ? '<img src="' . esc_url($iqconnetik_404_heading_img) . '" alt="' . esc_attr('img') . '">' : '' ?>
					<?php echo (!empty($iqconnetik_404_heading) && empty($iqconnetik_404_heading_img)) ? '<h1 class="text-404">' . esc_html($iqconnetik_404_heading) . '</h1>' : ''; ?>
					<p class="fs-20"><?php echo (!empty($iqconnetik_404_text_bottom_line)) ? esc_html($iqconnetik_404_text_bottom_line) : esc_html_e("Oops, Sorry We Can’t Find That Page!", 'iqconnetik'); ?></p>
					<div class="many-buttons">
						<a id="back-btn" href="#" class="btn btn-big btn-outline-gradient back-page"><?php esc_html_e('Go Back', 'iqconnetik'); ?></a>
						<a href="<?php echo get_home_url(); ?>" class="btn btn-big btn-gradient">
							<?php esc_html_e('Go Home', 'iqconnetik'); ?>
						</a>
					</div>
				</div><!--eof #content-wrap -->
			</div><!-- #layout -->
		</main>
	</div><!-- .container -->
</div><!-- #main -->
<?php
get_footer();
