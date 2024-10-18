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

$iqconnetik_has_thumbnail = iqconnetik_has_post_thumbnail();
$iqconnetik_css_class     = (!$iqconnetik_has_thumbnail) ? 'no-post-thumbnail content-absolute-no-image' : 'content-absolute';

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemtype="https://schema.org/Article" itemscope="itemscope">
	<?php
	if (!empty($iqconnetik_has_thumbnail)) :
	?>

		<div class="<?php echo esc_attr($iqconnetik_css_class); ?>">
			<?php
			iqconnetik_post_thumbnail();
			?>
			<div class="overlap-content">
				<?php if (get_the_title()) : ?>
					<header class="entry-header">
						<?php
						iqconnetik_sticky_post_label();
						the_title(sprintf('<h3 class="entry-title" itemprop="headline"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h3>');
						?>
					</header><!-- .entry-header -->
				<?php endif; //get_the_title 
				?>
				<footer class="entry-footer entry-footer-top"><?php iqconnetik_entry_meta(true, true, true, false, true, true); ?></footer>
				<!-- .entry-footer -->
			</div><!-- .overlap-content -->
		</div><!-- <?php echo esc_attr($iqconnetik_css_class); ?> -->


		<div class="item-content">
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

			<footer class="entry-footer  entry-footer-bottom"><?php iqconnetik_entry_meta(false, false, false, true, false); ?></footer>
			<!-- .entry-footer -->

		</div><!-- .item-content -->
	<?php
	//no thumbnail
	else :
	?>
		<?php if (get_the_title()) : ?>
			<header class="entry-header">
				<?php
				iqconnetik_sticky_post_label();
				the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
				?>
			</header><!-- .entry-header -->
		<?php endif; //get_the_title 
		?>
		<footer class="entry-footer entry-footer-top"><?php iqconnetik_entry_meta(true, true, true, false, true); ?></footer><!-- .entry-footer -->

		<div class="entry-content">
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

		<footer class="entry-footer  entry-footer-bottom"><?php iqconnetik_entry_meta(false, false, false, true, false); ?></footer><!-- .entry-footer -->

	<?php endif; //has_thumbnail 
	?>
</article><!-- #post-<?php the_ID(); ?> -->