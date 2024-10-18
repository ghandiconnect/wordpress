<?php

/**
 * The template for displaying all single posts.
 * Also used in the Customizer preview
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

if (have_posts()) :

	/* Start the Loop */
	while (have_posts()) :
		the_post();

		$iqconnetik_layout = iqconnetik_get_post_layout();
?>
		<div id="layout" class="layout-<?php echo esc_attr($iqconnetik_layout); ?>">
			<?php
			get_template_part('template-parts/post/content-single', $iqconnetik_layout);
			?>
		</div><!-- #layout -->
<?php

	endwhile; // End of the loop.

else :

	// If no content, include the "No posts found" template.
	get_template_part('template-parts/content', 'none');

endif; //have_posts
