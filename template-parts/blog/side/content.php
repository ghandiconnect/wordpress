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

$iqconnetik_side_item = (!iqconnetik_has_post_thumbnail()) ? '' : 'side-item content-padding with_background';

?>
<article id="post-<?php the_ID(); ?>" <?php post_class($iqconnetik_side_item); ?> itemtype="https://schema.org/Article" itemscope="itemscope">
	<?php
	iqconnetik_post_thumbnail('iqconnetik-square');
	?>
	<div class="item-content">
		<?php
		if (!empty(iqconnetik_option('blog_show_date')) || !empty(iqconnetik_option('blog_show_author')) || !empty(iqconnetik_option('blog_show_comments_link')) || !empty(iqconnetik_option('blog_show_views')) || !empty(iqconnetik_option('blog_show_categories'))) :
		?>
			<div class="entry-footer entry-footer-top">
				<?php iqconnetik_entry_meta(true, true, true, false, true, true); ?>
			</div>
			<!-- .entry-footer -->
		<?php endif; ?>
		<?php if (get_the_title()) : ?>
			<header class="entry-header">
				<?php
				the_title(sprintf('<h3 class="entry-title big" itemprop="headline"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h3>');
				?>
			</header><!-- .entry-header -->
		<?php endif; //get_the_title 
		?>
		<div class="entry-content" itemprop="text">
			<?php
			$iqconnetik_show_full_text = iqconnetik_option('blog_show_full_text', false);

			if (empty($iqconnetik_show_full_text)) :

				the_excerpt();

			else :

				the_content(
					iqconnetik_read_more_inside_link_markup()
				);

			endif; // show_full_text

			wp_link_pages(
				iqconnetik_get_wp_link_pages_atts()
			);
			?>
			<?php
			if (
				!empty(iqconnetik_option('blog_show_tags'))
				||
				!empty(iqconnetik_option('blog_share_facebook', true))
				||
				!empty(iqconnetik_option('blog_share_twitter', true))
				||
				!empty(iqconnetik_option('blog_share_telegram', true))
				||
				!empty(iqconnetik_option('blog_share_pinterest', true))
				||
				!empty(iqconnetik_option('blog_share_linkedin', true))
			) :
			?>
				<div class="entry-footer entry-footer-bottom">
					<?php
					if (!empty(iqconnetik_option('blog_show_tags'))) {
					?>
						<div class="meta-tags">
							<?php
							iqconnetik_entry_meta(false, false, false, true, false, false);
							?>
						</div>
					<?php } ?>
					<?php
					if (function_exists('iqconnetik_share_this')) {
						iqconnetik_share_this();
					}
					?>
				</div>
				<!-- .entry-footer -->
			<?php endif; ?>
		</div><!-- .entry-content -->

	</div><!-- .item-content -->
</article><!-- #post-<?php the_ID(); ?> -->