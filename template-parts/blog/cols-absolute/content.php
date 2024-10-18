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

$iqconnetik_css_class = (!iqconnetik_has_post_thumbnail()) ? 'no-post-thumbnail content-absolute-no-image' : 'content-absolute';

?>
<div class="grid-item">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemtype="https://schema.org/Article" itemscope="itemscope">
		<div class="<?php echo esc_attr($iqconnetik_css_class); ?>">
			<?php
			iqconnetik_post_thumbnail('iqconnetik-square');
			?>
			<div class="overlap-content">

				<?php if (get_the_title()) : ?>
					<header class="entry-header">
						<?php
						iqconnetik_sticky_post_label();
						the_title(sprintf('<h2 class="entry-title" itemprop="headline"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
						?>
					</header><!-- .entry-header -->
				<?php endif; //get_the_title 
				?>

				<footer class="entry-footer entry-footer-top"><?php iqconnetik_entry_meta(false, true, false, false, false); ?></footer>
				<!-- .entry-footer -->

			</div><!-- .overlap-content -->
		</div><!-- <?php echo esc_attr($iqconnetik_css_class); ?> -->
	</article><!-- #post-<?php the_ID(); ?> -->
</div><!-- .grid-item -->