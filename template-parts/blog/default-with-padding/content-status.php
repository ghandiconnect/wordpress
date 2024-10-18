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
<article id="post-<?php the_ID(); ?>" <?php post_class('bg_teaser vertical-item i'); ?> itemtype="https://schema.org/Article" itemscope="itemscope">
	<?php
	iqconnetik_post_thumbnail('iqconnetik-default-post');
	?>
	<div class="item-content content-padding text-center">
		<header class="entry-header">
			<?php
			the_title(sprintf('<h4 class="entry-title" itemprop="headline">', esc_url(get_permalink())), '</h4>');
			?>
		</header><!-- .entry-header -->
		<div class="entry-content" itemprop="text">
			<?php
			the_content(
				esc_html__('', 'iqconnetik')
			);

			wp_link_pages(
				iqconnetik_get_wp_link_pages_atts()
			);
			?>
		</div><!-- .entry-content -->
	</div><!-- .item-content -->
</article><!-- #post-<?php the_ID(); ?> -->