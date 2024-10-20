<?php

/**
 * Template Name: Left Sidebar Page
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

$iqconnetik_show_title = !iqconnetik_option('title_show_title', '') && get_the_title() && !is_front_page();

get_header();

/* Start the Loop */
while (have_posts()) :
	the_post();
?>
	<div id="layout" class="layout-page-sidebar-left">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemtype="https://schema.org/WebPage" itemscope="itemscope">
			<?php if ($iqconnetik_show_title) : ?>
				<header class="entry-header">
					<?php the_title('<h1 class="entry-title"  itemprop="headline">', '</h1>'); ?>
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
		</article><!-- #post-<?php the_ID(); ?> -->
		<?php

		// If comments are open or we have at least one comment, load up the comment template.
		if (comments_open() || get_comments_number()) {
			comments_template();
		}
		?>
	</div><!-- #layout -->
<?php

endwhile; // End of the loop.

get_footer();
