<?php

/**
 * The intro section template file
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

$iqconnetik_intro_layout      = iqconnetik_option('intro_layout', '');
$iqconnetik_intro_fullscreen  = iqconnetik_option('intro_fullscreen', '');
$iqconnetik_intro_heading     = iqconnetik_option('intro_heading', '');
$iqconnetik_intro_description = iqconnetik_option('intro_description', '');
$iqconnetik_intro_shortcode   = iqconnetik_option('intro_shortcode', '');

$iqconnetik_extra_padding_top    = iqconnetik_option('intro_extra_padding_top', '');
$iqconnetik_extra_padding_bottom = iqconnetik_option('intro_extra_padding_bottom', '');
$iqconnetik_intro_background     = iqconnetik_option('intro_background', '');
$iqconnetik_intro_alignment      = iqconnetik_option('intro_alignment', '');
$iqconnetik_font_size            = iqconnetik_option('intro_font_size', '');
$iqconnetik_background_image     = iqconnetik_section_background_image_array('intro');
$iqconnetik_image            = iqconnetik_option('intro_image', '');

$iqconnetik_intro_background_image_scale_class = iqconnetik_option('intro_background_image_scale', '') ? 'image-scale' : '';
$iqconnetik_intro_background_image_absolute_class = iqconnetik_option('intro_image_absolute', '') ? 'image-absolute' : '';

//buttons
$iqconnetik_intro_button_text_first  = iqconnetik_option('intro_button_text_first', '');
$iqconnetik_intro_button_url_first   = iqconnetik_option('intro_button_url_first', '');
$iqconnetik_intro_button_text_second = iqconnetik_option('intro_button_text_second', '');
$iqconnetik_intro_button_url_second  = iqconnetik_option('intro_button_url_second', '');

//animation
$iqconnetik_intro_image_animation = iqconnetik_option('intro_image_animation', '') ? 'animate an__' . iqconnetik_option('intro_image_animation') : '';

//not showing intro if no content specified
if (
	empty($iqconnetik_intro_heading)
	&&
	empty($iqconnetik_intro_description)
	&&
	empty($iqconnetik_intro_shortcode)
	&&
	empty($iqconnetik_intro_button_text_first)
	&&
	empty($iqconnetik_intro_button_text_second)
	&&
	empty($iqconnetik_background_image['url'])
) {
	return;
}
//if fullscreen - adding class to font size
if (!empty($iqconnetik_intro_fullscreen)) {
	$iqconnetik_font_size .= ' screen';
}

//default layout is background image
switch ($iqconnetik_intro_layout):
		//side image layout
	case 'image-left':
	case 'image-right':
?>
		<section id="intro" class="intro intro-section layout-gap-30 <?php echo esc_attr($iqconnetik_font_size . ' ' . $iqconnetik_intro_background . ' ' . $iqconnetik_intro_alignment . ' ' . $iqconnetik_intro_layout . ' ' . $iqconnetik_intro_background_image_scale_class . ' ' . $iqconnetik_intro_background_image_absolute_class . ' ' . $iqconnetik_background_image['class']); ?>" <?php echo (!empty($iqconnetik_background_image['url'])) ? 'style="background-image: url(' . esc_url($iqconnetik_background_image['url']) . ');"' : ''; ?>>
			<?php
			if (iqconnetik_option('intro_social_links')) {
				iqconnetik_social_links('intro-social-links-absolute');
			}
			?>
			<div class="container <?php echo esc_attr($iqconnetik_extra_padding_top . ' ' . $iqconnetik_extra_padding_bottom); ?>">
				<div class="d-grid grid-2-cols">
					<div class="column">
						<?php if (!empty($iqconnetik_image)) : ?>
							<div class="img-wrap">
								<img src="<?php echo esc_url($iqconnetik_image); ?>" alt="<?php echo esc_attr($iqconnetik_intro_heading); ?>" class="intro-image <?php echo esc_attr($iqconnetik_intro_image_animation); ?>">
							</div>
						<?php endif; ?>
					</div>
					<div class="column intro-section-text">
						<?php
						get_template_part('template-parts/header/intro-text');
						?>
					</div><!-- .column -->
				</div><!-- .d-grid -->
			</div><!-- .container -->
		</section><!-- #intro -->
	<?php
		break;

	case 'image-top':
	?>
		<section id="intro" class="intro intro-section <?php echo esc_attr($iqconnetik_font_size . ' ' . $iqconnetik_intro_background . ' ' . $iqconnetik_intro_alignment . ' ' . $iqconnetik_intro_layout . ' ' . $iqconnetik_background_image['class']); ?>" <?php echo (!empty($iqconnetik_background_image['url'])) ? 'style="background-image: url(' . esc_url($iqconnetik_background_image['url']) . ');"' : ''; ?>>
			<?php
			if (iqconnetik_option('intro_social_links')) {
				iqconnetik_social_links('intro-social-links-absolute');
			}
			?>
			<div class="container <?php echo esc_attr($iqconnetik_extra_padding_top . ' ' . $iqconnetik_extra_padding_bottom); ?>">
				<div class="column">
					<?php if (!empty($iqconnetik_image)) : ?>
						<img src="<?php echo esc_url($iqconnetik_image); ?>" alt="<?php echo esc_attr($iqconnetik_intro_heading); ?>" class="intro-image <?php echo esc_attr($iqconnetik_intro_image_animation); ?>">
					<?php endif; ?>
				</div>
				<div class="column intro-section-text">
					<?php
					get_template_part('template-parts/header/intro-text');
					?>
				</div><!-- .column -->
			</div><!-- .container -->
		</section><!-- #intro -->
	<?php
		break;
	case 'image-bottom':
	?>
		<section id="intro" class="intro intro-section <?php echo esc_attr($iqconnetik_font_size . ' ' . $iqconnetik_intro_background . ' ' . $iqconnetik_intro_alignment . ' ' . $iqconnetik_intro_layout . ' ' . $iqconnetik_background_image['class']); ?>" <?php echo (!empty($iqconnetik_background_image['url'])) ? 'style="background-image: url(' . esc_url($iqconnetik_background_image['url']) . ');"' : ''; ?>>
			<?php
			if (iqconnetik_option('intro_social_links')) {
				iqconnetik_social_links('intro-social-links-absolute');
			}
			?>
			<div class="container <?php echo esc_attr($iqconnetik_extra_padding_top . ' ' . $iqconnetik_extra_padding_bottom); ?>">
				<div class="column intro-section-text">
					<?php
					get_template_part('template-parts/header/intro-text');
					?>
				</div><!-- .column -->
				<div class="column">
					<?php if (!empty($iqconnetik_image)) : ?>
						<img src="<?php echo esc_url($iqconnetik_image); ?>" alt="<?php echo esc_attr($iqconnetik_intro_heading); ?>" class="intro-image <?php echo esc_attr($iqconnetik_intro_image_animation); ?>">
					<?php endif; ?>
				</div><!-- .column -->
			</div><!-- .container -->
		</section><!-- #intro -->
	<?php
		break;
		//background image
	default:
	?>
		<section id="intro" class="intro intro-section <?php echo esc_attr($iqconnetik_font_size . ' ' . $iqconnetik_intro_background . ' ' . $iqconnetik_intro_alignment . ' ' . $iqconnetik_background_image['class']); ?>" <?php echo (!empty($iqconnetik_background_image['url'])) ? 'style="background-image: url(' . esc_url($iqconnetik_background_image['url']) . ');"' : ''; ?>>
			<?php
			if (iqconnetik_option('intro_social_links')) {
				iqconnetik_social_links('intro-social-links-absolute');
			}
			?>
			<div class="container <?php echo esc_attr($iqconnetik_extra_padding_top . ' ' . $iqconnetik_extra_padding_bottom); ?>">
				<?php
				get_template_part('template-parts/header/intro-text');
				?>
			</div><!-- .container -->
		</section><!-- #intro -->
<?php
endswitch;//$iqconnetik_intro_layout
