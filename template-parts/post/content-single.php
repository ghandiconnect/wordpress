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
<article id="post-<?php the_ID(); ?>" <?php post_class('vertical-item'); ?> itemtype="https://schema.org/Article" itemscope="itemscope">
	<?php
	iqconnetik_post_thumbnail('iqconnetik-default-post');
	?>
	<div class="item-content">
		<?php
		if (!empty(iqconnetik_option('blog_single_show_categories'))) :
			iqconnetik_entry_meta(false, false, true, false, false, false, false);
		endif;
		?>
		<header class="entry-header">
			<?php
			$iqconnetik_show_title = !iqconnetik_option('title_show_title', '') && get_the_title();
			if ($iqconnetik_show_title) :
			?>
				<?php the_title('<h1 class="entry-title" itemprop="headline"><span>', '</span></h1>'); ?>
			<?php
			else :
				echo '<h5 class="hidden" itemscope="itemscope" itemprop="headline" itemtype="https://schema.org/Text">' . esc_html(get_the_title()) . '</h5>';
			endif; //show_title
			?>
			<?php
			if (

				!empty(iqconnetik_option('blog_single_show_date'))
				|| !empty(iqconnetik_option('blog_single_show_author'))
				|| !empty(iqconnetik_option('blog_single_show_comments_link'))
				|| !empty(iqconnetik_option('blog_single_show_likes'))
				|| !empty(iqconnetik_option('blog_single_show_views'))
			) : ?>
				<div class="entry-meta post-meta darklinks">
					<?php iqconnetik_entry_meta(true, true, false, false, true, true, true); ?>
				</div>
			<?php endif; ?>
		</header><!-- .entry-header -->
		<div class="entry-content" itemprop="text">
			<?php
			the_content();

			wp_link_pages(
				iqconnetik_get_wp_link_pages_atts()
			);
			?>
		</div><!-- .entry-content -->
		<?php
		if (!empty(iqconnetik_option('blog_single_show_tags')) && !empty(get_the_tags())) : ?>
			<footer class="entry-footer entry-footer-top">
				<div class="entry-meta post-meta darklinks">
					<?php iqconnetik_entry_meta(false, false, false, true, false, false, false); ?>
				</div><!-- .entry-meta -->
			</footer><!-- .entry-footer-top -->
		<?php endif; ?>
		<?php
		if (
			!empty(iqconnetik_option('blog_single_share_facebook', true))
			|| !empty(iqconnetik_option('blog_single_share_twitter', true))
			|| !empty(iqconnetik_option('blog_single_share_telegram', true))
			|| !empty(iqconnetik_option('blog_single_share_pinterest', true))
			|| !empty(iqconnetik_option('blog_single_share_linkedin', true))
		) :
		?>
			<footer class="entry-footer entry-footer-bottom entry-blog-share">
				<?php
				if (function_exists('iqconnetik_share_this')) {
					iqconnetik_share_this();
				}
				?>
			</footer><!-- .entry-footer-bottom -->
		<?php endif; ?>
	</div><!-- .item-content -->
</article><!-- #post-<?php the_ID(); ?> -->
<?php
//bio
get_template_part('template-parts/post/bio');

iqconnetik_related_posts(get_the_ID());

//nav
iqconnetik_post_nav();

// If comments are open or we have at least one comment, load up the comment template.
if (comments_open() || get_comments_number()) {
	comments_template();
}
?>