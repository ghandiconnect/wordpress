<?php

/**
 * The intro section text template file
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
$iqconnetik_intro_pre_heading = iqconnetik_option('intro_pre_heading', '');
$iqconnetik_intro_heading     = iqconnetik_option('intro_heading', '');
$iqconnetik_intro_description = iqconnetik_option('intro_description', '');
$iqconnetik_intro_shortcode   = iqconnetik_option('intro_shortcode', '');

//buttons
$iqconnetik_intro_button_text_first  = iqconnetik_option('intro_button_text_first', '');
$iqconnetik_intro_button_url_first   = iqconnetik_option('intro_button_url_first', '');
$iqconnetik_intro_button_text_second = iqconnetik_option('intro_button_text_second', '');
$iqconnetik_intro_button_url_second  = iqconnetik_option('intro_button_url_second', '');

//animation
//animate an__XXX
//intro_heading_animation
//intro_description_animation
//intro_button_first_animation
//intro_button_second_animation
//intro_shortcode_animation
$iqconnetik_intro_pre_heading_animation   = iqconnetik_option('intro_pre_heading_animation', '') ? 'animate an__' . iqconnetik_option('intro_pre_heading_animation') : '';
$iqconnetik_intro_heading_animation       = iqconnetik_option('intro_heading_animation', '') ? 'animate an__' . iqconnetik_option('intro_heading_animation') : '';
$iqconnetik_intro_description_animation   = iqconnetik_option('intro_description_animation', '') ? 'animate an__' . iqconnetik_option('intro_description_animation') : '';
$iqconnetik_intro_button_first_animation  = iqconnetik_option('intro_button_first_animation', '') ? 'animate an__' . iqconnetik_option('intro_button_first_animation') : '';
$iqconnetik_intro_button_second_animation = iqconnetik_option('intro_button_second_animation', '') ? 'animate an__' . iqconnetik_option('intro_button_second_animation') : '';
$iqconnetik_intro_shortcode_animation     = iqconnetik_option('intro_shortcode_animation', '') ? 'animate an__' . iqconnetik_option('intro_shortcode_animation') : '';


//not showing intro if no content specified
if (
	empty($iqconnetik_intro_pre_heading)
	&&
	empty($iqconnetik_intro_heading)
	&&
	empty($iqconnetik_intro_description)
	&&
	empty($iqconnetik_intro_shortcode)
	&&
	empty($iqconnetik_intro_button_text_first)
	&&
	empty($iqconnetik_intro_button_text_second)
) {
	return;
}

if (iqconnetik_option('intro_social_links')) {
	iqconnetik_social_links('intro-social-links');
}

if (!empty($iqconnetik_intro_pre_heading)) :
	$iqconnetik_intro_pre_heading_mt = iqconnetik_option('intro_pre_heading_mt', '');
	$iqconnetik_intro_pre_heading_mb = iqconnetik_option('intro_pre_heading_mb', '');
?>
	<div class="intro-pre-heading <?php echo esc_attr($iqconnetik_intro_pre_heading_animation . ' ' . $iqconnetik_intro_pre_heading_mt . ' ' . $iqconnetik_intro_pre_heading_mb); ?>">
		<?php echo wp_kses_post($iqconnetik_intro_pre_heading); ?>
	</div>
<?php
endif; //intro_heading

if (!empty($iqconnetik_intro_heading)) :
	$iqconnetik_intro_heading_mt = iqconnetik_option('intro_heading_mt', '');
	$iqconnetik_intro_heading_mb = iqconnetik_option('intro_heading_mb', '');
?>
	<h1 class="intro-heading <?php echo esc_attr($iqconnetik_intro_heading_animation . ' ' . $iqconnetik_intro_heading_mt . ' ' . $iqconnetik_intro_heading_mb); ?>">
		<?php echo wp_kses_post($iqconnetik_intro_heading); ?>
		<span class="intro-heading-duplicate d-none <?php echo esc_attr($iqconnetik_intro_heading_animation . ' ' . $iqconnetik_intro_heading_mt . ' ' . $iqconnetik_intro_heading_mb); ?>">
			<?php echo wp_kses_post($iqconnetik_intro_heading); ?>
		</span>
	</h1>

<?php
endif; //intro_heading

if (!empty($iqconnetik_intro_description)) :
	$iqconnetik_intro_description_mt = iqconnetik_option('intro_description_mt', '');
	$iqconnetik_intro_description_mb = iqconnetik_option('intro_description_mb', '');
?>
	<div class="intro-description grey <?php echo esc_attr($iqconnetik_intro_description_animation . ' ' . $iqconnetik_intro_description_mt . ' ' . $iqconnetik_intro_description_mb); ?>">
		<?php echo wp_kses_post($iqconnetik_intro_description); ?>
	</div>
<?php
endif; //intro_description

if (!empty($iqconnetik_intro_button_text_first) || !empty($iqconnetik_intro_button_text_second)) :
	$iqconnetik_intro_buttons_mt = iqconnetik_option('intro_buttons_mt', '');
	$iqconnetik_intro_buttons_mb = iqconnetik_option('intro_buttons_mb', '');
?>
	<div class="intro-buttons <?php echo esc_attr($iqconnetik_intro_buttons_mt . ' ' . $iqconnetik_intro_buttons_mb); ?>">
		<?php if (!empty($iqconnetik_intro_button_text_first)) : ?>
			<a class="theme_button wide_button color1 <?php echo esc_attr($iqconnetik_intro_button_first_animation); ?>" href="<?php echo esc_url($iqconnetik_intro_button_url_first); ?>"><?php echo esc_html($iqconnetik_intro_button_text_first); ?></a>
		<?php endif; //intro_button_text_first 
		?>
		<?php if (!empty($iqconnetik_intro_button_text_second)) : ?>
			<a class="theme_button wide_button color2 <?php echo esc_attr($iqconnetik_intro_button_second_animation); ?>" href="<?php echo esc_url($iqconnetik_intro_button_url_second); ?>"><?php echo esc_html($iqconnetik_intro_button_text_second); ?></a>
		<?php endif; //intro_button_text_second 
		?>
	</div>
<?php
endif; //intro_heading
if (!empty($iqconnetik_intro_shortcode)) :
	$iqconnetik_intro_shortcode_mt = iqconnetik_option('intro_shortcode_mt', '');
	$iqconnetik_intro_shortcode_mb = iqconnetik_option('intro_shortcode_mb', '');
?>
	<div class="intro-shortcode <?php echo esc_attr($iqconnetik_intro_shortcode_animation . ' ' . $iqconnetik_intro_shortcode_mt . ' ' . $iqconnetik_intro_shortcode_mb); ?>">
		<?php echo do_shortcode($iqconnetik_intro_shortcode); ?>
	</div>
<?php
endif; //intro_shortcode
