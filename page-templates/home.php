<?php

/**
 * Template Name: Home - Top and Right Sidebars
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

get_header();


/* Start the Loop */
while (have_posts()) :
	the_post();
	$iqconnetik_content = get_the_content();
	if (!empty($iqconnetik_content)) :

		the_content();

		wp_link_pages(
			iqconnetik_get_wp_link_pages_atts()
		);

	endif; //get_the_content
endwhile; // End of the loop.

get_footer();
