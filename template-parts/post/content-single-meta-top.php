<?php

/**
 * The template for displaying all default single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Iqconnetik
 * @since 0.0.1
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemtype="https://schema.org/Article" itemscope="itemscope">
	<?php
	$iqconnetik_show_title = !iqconnetik_option('title_show_title', '') && get_the_title();
	if ($iqconnetik_show_title) :
	?>
		<header class="entry-header">
			<?php the_title('<h1 class="entry-title" itemprop="headline"><span>', '</span></h1>'); ?>
		</header>
	<?php
	else :
		echo '<h4 class="hidden" itemscope="itemscope" itemprop="headline" itemtype="https://schema.org/Text">' . esc_html(get_the_title()) . '</h4>';
	endif; //show_title
	?>

	<footer class="entry-footer entry-footer-top"><?php iqconnetik_entry_meta(true, true, true, false, true); ?></footer>
	<!-- .entry-footer -->
	<?php

	iqconnetik_post_thumbnail();

	?>
	<div class="item-content">
		<div class="entry-content" itemprop="text">
			<?php

			the_content();

			wp_link_pages(
				iqconnetik_get_wp_link_pages_atts()
			);
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer entry-footer-bottom"><?php iqconnetik_entry_meta(false, false, false, true, false); ?></footer>
		<!-- .entry-footer -->

	</div><!-- .item-content -->
</article><!-- #post-<?php the_ID(); ?> -->
<?php

get_template_part('template-parts/post/bio');

iqconnetik_post_nav();

iqconnetik_related_posts(get_the_ID());

// If comments are open or we have at least one comment, load up the comment template.
if (comments_open() || get_comments_number()) {
	comments_template();
}
