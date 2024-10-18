<?php

/**
 * The search template file
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

$iqconnetik_show_title   = !iqconnetik_option('title_show_title', '') && get_the_title();

get_header();

?>
<div id="layout" class="layout-search">
	<?php if (!empty($iqconnetik_show_title)) : ?>
		<h1><?php get_template_part('template-parts/title/title-text'); ?></h1>
		<?php
	endif; //show_title

	if (have_posts()) {

		// Load posts loop.
		while (have_posts()) :
			the_post();
			if ('product' === get_post_type() && function_exists('wc_get_template')) :
		?>
				<div class="woo woocommerce columns-1">
					<ul class="products search-results">
						<?php
						wc_get_template('content-product.php');
						?>
					</ul>
				</div>
			<?php
			else :
			?>
				<article id="post-<?php the_ID(); ?>" <?php post_class('content-padding with-background'); ?>>
					<header class="entry-header">
						<?php
						if (
							!empty(iqconnetik_option('blog_show_author'))
							|| !empty(iqconnetik_option('blog_show_date'))
							||	!empty(iqconnetik_option('blog_show_categories'))
						) : ?>
							<div class="entry-meta post-meta greylinks">
								<?php iqconnetik_entry_meta(true, true, true, false, false, false, false); ?>
							</div>
						<?php endif; ?>
						<?php
						the_title(sprintf('<h5 class="entry-title darklinks" itemprop="headline"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h5>');
						?>
					</header><!-- .entry-header -->
					<?php
					the_excerpt();
					if (
						'post' === get_post_type()
					) :
					?>
						<footer class="entry-footer entry-footer-top">
							<div class="entry-meta post-meta greylinks"><?php iqconnetik_entry_meta(false, false, false, true, true, true, true);; ?></div><!-- .entry-meta -->
						</footer>
					<?php
					endif; //'post'
					?>
				</article><!-- #post-<?php the_ID(); ?> -->
	<?php
			endif;
		endwhile;

		// Previous/next page navigation.
		the_posts_pagination(
			iqconnetik_get_the_posts_pagination_atts()
		);
	} else {

		// If no content, include the "No posts found" template.
		get_template_part('template-parts/content', 'none');
	}
	?>
</div><!-- #layout -->
<?php

get_footer();
