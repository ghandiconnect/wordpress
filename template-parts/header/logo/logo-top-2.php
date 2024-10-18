<?php

/**
 * The logo template file
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

$args = !empty($args) ? $args : array();
$div = !empty($args['div']) ? 'div' : 'a';

$iqconnetik_custom_logo         = iqconnetik_option('custom_logo');
$iqconnetik_logo_white          = iqconnetik_option('logo_image_inverse');
$iqconnetik_logo_image_class    = (!empty($iqconnetik_custom_logo) || !empty($iqconnetik_logo_white)) ? 'with-image' : 'no-image';
$iqconnetik_logo_text_primary   = iqconnetik_option('logo_primary_text');
$iqconnetik_logo_text_secondary = iqconnetik_option('logo_text_secondary');
$iqconnetik_logo_background     = iqconnetik_option('logo_background');
$iqconnetik_logo_x_padding      = iqconnetik_option('logo_padding_horizontal');
$iqconnetik_logo_padding_class  = (!empty($iqconnetik_logo_x_padding)) ? 'px' : '';

//if no text - get blog name for primary text
if (empty($iqconnetik_logo_text_primary) && empty($iqconnetik_logo_text_secondary) && empty($iqconnetik_custom_logo)) {
	$iqconnetik_logo_text_primary = get_bloginfo('name');
}
?>
<<?php echo esc_html($div); ?> class="logo logo-vertical <?php echo esc_attr($iqconnetik_logo_image_class . ' ' . $iqconnetik_logo_background . ' ' . $iqconnetik_logo_padding_class); ?>" href="<?php echo esc_url(home_url('/')); ?>" rel="home" itemprop="url">
	<?php
	//image
	if (iqconnetik_option('toplogo_background') === 'l' || iqconnetik_option('toplogo_background') === 'l m' || iqconnetik_option('toplogo_background') === '') :
		echo wp_get_attachment_image($iqconnetik_custom_logo, 'full');
	else :
		if (!empty($iqconnetik_logo_white)) :
	?>
			<img src="<?php echo esc_url($iqconnetik_logo_white); ?>" alt="<?php esc_attr('white logo', 'iqconnetik'); ?>">
		<?php
		endif; //logo_white
	endif; //image
	//text
	if (!empty($iqconnetik_logo_text_primary) || !empty($iqconnetik_logo_text_secondary)) :
		?>
		<span class="logo-text">
			<?php if (!empty($iqconnetik_logo_text_primary)) : ?>
				<span class="logo-text-primary">
					<?php echo wp_kses_post($iqconnetik_logo_text_primary); ?>
				</span><!-- .logo-text-primary -->
			<?php endif; ?>
			<?php if (!empty($iqconnetik_logo_text_secondary)) : ?>
				<span class="logo-text-secondary">
					<?php echo wp_kses_post($iqconnetik_logo_text_secondary); ?>
				</span><!-- .logo-text-secondary -->
			<?php endif; ?>
		</span><!-- .logo-text -->
	<?php endif; ?>
</<?php echo esc_html($div); ?>><!-- .logo -->