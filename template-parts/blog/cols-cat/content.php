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

$read_more = iqconnetik_read_more_markup_excerpt();

?>
<div class="grid-item">
	<article id="post-<?php the_ID(); ?>" <?php post_class('post-block'); ?> itemtype="https://schema.org/Article" itemscope="itemscope">
		<?php
		iqconnetik_sticky_post_label();
		iqconnetik_post_thumbnail('iqconnetik-square', '', true);
		?>
		<div class="item-content">
			<?php if (get_the_title()) : ?>
				<header class="entry-header entry-header-small">
					<?php

					the_title(sprintf('<h3 class="entry-title mb-1" itemprop="headline"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h3>');
					?>
				</header><!-- .entry-header -->
			<?php endif; //get_the_title 
			?>

			<footer class="entry-footer entry-footer-top"><?php iqconnetik_entry_meta(true, true, true, false, true); ?></footer>
			<!-- .entry-footer -->

			<div class="entry-content" itemprop="text">
				<?php

				echo wp_kses_post(wp_trim_words(get_the_excerpt(get_the_ID()), 15));

				wp_link_pages(
					iqconnetik_get_wp_link_pages_atts()
				);
				?>
			</div><!-- .entry-content -->

			<footer class="entry-footer  entry-footer-bottom"><?php iqconnetik_entry_meta(false, false, false, true, false); ?></footer>
			<!-- .entry-footer -->

			<?php if (!empty($read_more)) : ?>
				<div>
					<?php echo wp_kses_post($read_more); ?>
				</div>
			<?php endif; ?>

		</div><!-- .item-content -->
	</article><!-- #post-<?php the_ID(); ?> -->
</div><!-- .grid-item -->