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

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemtype="https://schema.org/Article" itemscope="itemscope">
	<?php
	iqconnetik_post_thumbnail();
	?>
	<div class="item-content">
		<div class="meta-date">
			<?php iqconnetik_entry_meta(false, true, false, false, false, false); ?>
		</div>
		<div class="meta-cat mt-1 mb-1">
			<?php iqconnetik_entry_meta(false, false, true, false, false, false); ?>
		</div>
		<?php if (get_the_title()) : ?>
			<header class="entry-header">
				<?php
				iqconnetik_sticky_post_label();
				the_title(sprintf('<h3 class="entry-title" itemprop="headline"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h3>');
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
		</div><!-- .entry-content -->

		<footer class="entry-footer entry-footer-top">
			<?php
			iqconnetik_entry_meta(true, false, false, false, true, true);
			if (function_exists('iqconnetik_share_this')) {
				iqconnetik_share_this();
			}
			?>
		</footer>
		<!-- .entry-footer -->

		<footer class="entry-footer  entry-footer-bottom meta-tags"><?php iqconnetik_entry_meta(false, false, false, true, false, false); ?></footer>
		<!-- .entry-footer -->

	</div><!-- .item-content -->
</article><!-- #post-<?php the_ID(); ?> -->