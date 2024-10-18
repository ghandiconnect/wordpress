<?php

/**
 * Template Name: Full Width Post
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
	<div id="layout" class="layout-full-width">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemtype="https://schema.org/Article" itemscope="itemscope">
			<div class="title-wrap">

				<div class="author-post">By <?php the_author(); ?><h3 class="background-author">Post</h3>
				</div>
				<?php the_title('<div class="entry-title" itemprop="headline"><span>', '</span></div>'); ?>
			</div>
			<?php

			iqconnetik_post_thumbnail();

			?>
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

				<footer class="entry-footer entry-footer-top"><?php iqconnetik_entry_meta(true, true, true, false, true); ?></footer>
				<!-- .entry-footer -->

				<div class="entry-content" itemprop="text">
					<?php

					the_content();

					wp_link_pages(
						iqconnetik_get_wp_link_pages_atts()
					);
					?>
				</div><!-- .entry-content -->

				<footer class="entry-footer entry-footer-bottom">
					<div class="meta-tags">
						<?php
						iqconnetik_entry_meta(false, false, false, true, false, false);
						?>
					</div>
					<?php
					if (function_exists('iqconnetik_share_this')) {
						iqconnetik_share_this();
					}
					?>
				</footer>
				<!-- .entry-footer -->

			</div><!-- .item-content -->
		</article><!-- #post-<?php the_ID(); ?> -->
		<?php

		get_template_part('template-parts/post/bio');
		//bio

		iqconnetik_post_nav();

		//iqconnetik_related_posts(get_the_ID());

		// If comments are open or we have at least one comment, load up the comment template.
		if (comments_open() || get_comments_number()) {
			comments_template();
		}
		?>
	</div><!-- #layout -->
<?php
endwhile;

get_footer();
