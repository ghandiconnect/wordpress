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
<article id="post-<?php the_ID(); ?>" <?php post_class('title-only'); ?> itemtype="https://schema.org/Article" itemscope="itemscope">
	<?php if (get_the_title()) : ?>
		<header class="entry-header">
			<?php
			iqconnetik_sticky_post_label();
			the_title(sprintf('<h3 class="entry-title icon-inline" itemprop="headline">%s<a href="%s" rel="bookmark">', iqconnetik_icon('file-document-outline', true), esc_url(get_permalink())), '</a></h3>');
			?>
		</header><!-- .entry-header -->
	<?php endif; //get_the_title 
	?>
</article><!-- #post-<?php the_ID(); ?> -->