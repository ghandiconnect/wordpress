<?php

/**
 * Template part for displaying posts
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

$excerpt_class = '';
if ('' == get_the_excerpt()) {
	$excerpt_class = 'no-excerpt';
}

$blog_excerpt_length = iqconnetik_option('blog_excerpt_length');
$blog_read_more_text = iqconnetik_option('blog_read_more_text');
$read_more = iqconnetik_read_more_markup_excerpt();

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('vertical-item with_shadow' . ' ' . $excerpt_class); ?> itemtype="https://schema.org/Article" itemscope="itemscope">
	<?php
	iqconnetik_sticky_post_label();
	iqconnetik_post_thumbnail('iqconnetik-default-post');
	?>

	<div class="item-content content-padding">
		<?php
		if (!empty(iqconnetik_option('blog_show_categories'))) :
			iqconnetik_entry_meta(false, false, true, false, false, false, false);
		endif;
		?>
		<?php if (get_the_title()) : ?>
			<header class="entry-header">
				<?php
				if (

					!empty(iqconnetik_option('blog_show_date'))
					|| !empty(iqconnetik_option('blog_show_author'))
					|| !empty(iqconnetik_option('blog_show_comments_link'))
					|| !empty(iqconnetik_option('blog_show_likes'))
					|| !empty(iqconnetik_option('blog_show_views'))
				) : ?>
					<div class="entry-meta post-meta">
						<?php iqconnetik_entry_meta(true, true, false, false, true, true, true); ?>
					</div>
				<?php endif; ?>
				<?php
				the_title(sprintf('<h4 class="entry-title darklinks" itemprop="headline"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h4>');
				?>
			</header><!-- .entry-header -->
		<?php endif; //get_the_title 
		?>
		<div class="entry-content" itemprop="text">
			<?php
			$iqconnetik_show_full_text = iqconnetik_option('blog_show_full_text', false);

			if (empty($iqconnetik_show_full_text)) :

				echo wp_kses_post(wp_trim_words(get_the_excerpt()));

			else :

				the_content(
					esc_html__('', 'iqconnetik')
				);

			endif; // show_full_text

			wp_link_pages(
				iqconnetik_get_wp_link_pages_atts()
			);
			?>
		</div><!-- .entry-content -->
		<?php
		if (!empty(iqconnetik_option('blog_show_tags')) && !empty(get_the_tags()) || !empty($read_more)) : ?>
			<footer class="entry-footer entry-footer-top">
				<?php if (!empty(iqconnetik_option('blog_show_tags')) && !empty(get_the_tags())) : ?>
					<div class="entry-meta post-meta">
						<?php iqconnetik_entry_meta(false, false, false, true, false, false, false); ?>
					</div><!-- .entry-meta -->
				<?php endif; ?>
				<?php if (!empty($read_more)) : ?>
					<div>
						<?php echo wp_kses_post($read_more); ?>
					</div>
				<?php endif; ?>
			</footer><!-- .entry-footer-top -->
		<?php endif; ?>
		<?php
		if (
			!empty(iqconnetik_option('blog_share_facebook', true))
			|| !empty(iqconnetik_option('blog_share_twitter', true))
			|| !empty(iqconnetik_option('blog_share_telegram', true))
			|| !empty(iqconnetik_option('blog_share_pinterest', true))
			|| !empty(iqconnetik_option('blog_share_linkedin', true))
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
</article><!-- #post-<?php the_ID(); ?>-->