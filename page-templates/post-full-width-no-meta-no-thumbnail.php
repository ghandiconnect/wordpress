<?php

/**
 * Template Name: Full Width Post - no meta and featured image
 * Template Post Type: post
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

get_header();

// Start the Loop.
while (have_posts()) :
	the_post();
?>

	<div id="layout" class="layout-no-meta-no-thumbnail">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemtype="https://schema.org/Article" itemscope="itemscope">
			<div class="item-content">
				<?php

				$iqconnetik_show_title = !iqconnetik_option('title_show_title', '') && get_the_title();
				if ($iqconnetik_show_title) :
				?>
					<header class="entry-header">
						<?php the_title('<h1 class="entry-title" itemprop="headline">', '</h1>'); ?>
					</header>
				<?php endif; //show_title 
				?>

				<div class="entry-content" itemprop="text">
					<?php

					the_content();

					wp_link_pages(
						iqconnetik_get_wp_link_pages_atts()
					);
					?>
				</div><!-- .entry-content -->

			</div><!-- .item-content -->
		</article><!-- #post-<?php the_ID(); ?> -->
	</div><!-- #layout -->
<?php
endwhile;

get_footer();
