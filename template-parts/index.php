<?php

/**
 * The main template file
 * Also used in the Customizer preview
 * It contains the index.php file but without header and footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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

$iqconnetik_show_title = iqconnetik_get_feed_shot_title();
$iqconnetik_layout     = iqconnetik_get_feed_layout();
$iqconnetik_layout_gap = iqconnetik_get_feed_gap();

//layout may contain columns count separated by space and 'masonry' word after columns count
$iqconnetik_layout         = explode(' ', $iqconnetik_layout);
$iqconnetik_columns_number = (!empty($iqconnetik_layout[1])) ? absint($iqconnetik_layout[1]) : '';
$iqconnetik_masonry        = (!empty($iqconnetik_layout[2]) && 'masonry' === $iqconnetik_layout[2]) ? true : false;
$iqconnetik_grid_class     = (!empty($iqconnetik_masonry)) ? 'masonry' : 'grid-wrapper';
$iqconnetik_layout         = $iqconnetik_layout[0];
$iqconnetik_columns        = (!empty($iqconnetik_columns_number)) ? true : false;

//additional css classes for #layout div element
$iqconnetik_layout_class  = 'layout-' . $iqconnetik_layout;
$iqconnetik_layout_class .= !empty($iqconnetik_columns) ? ' layout-cols-' . $iqconnetik_columns_number : ' layout-cols-1';
$iqconnetik_layout_class .= !empty($iqconnetik_layout_gap) ? ' layout-gap-' . $iqconnetik_layout_gap : ' layout-gap-default';

if (!empty($iqconnetik_masonry)) {
	iqconnetik_enqueue_masonry_action();
}

if (have_posts()) :
?>
	<div id="layout" class="<?php echo esc_attr($iqconnetik_layout_class); ?>">
		<?php if (!empty($iqconnetik_show_title)) : ?>
			<h1 class="archive-title">
				<span><?php get_template_part('template-parts/title/title-text'); ?></span>
			</h1>
		<?php
		endif; //show_title

		if (is_category()) :
			$iqconnetik_category_description = category_description();
			if (!empty($iqconnetik_category_description)) {
				echo '<div class="category-description">' . wp_kses_post($iqconnetik_category_description) . '</div><!-- .category-description -->';
			}
		endif; //is_category

		if (!empty($iqconnetik_columns)) :
			// read about masonry layout here:
			// https://masonry.desandro.com/options.html
			// https://github.com/desandro/masonry/issues/549
		?>
			<div class="grid-columns-wrapper">
				<div class="<?php echo esc_attr($iqconnetik_grid_class); ?>">
					<div class="grid-sizer"></div>
				<?php
			endif; //columns

			// Load posts loop.
			while (have_posts()) :

				the_post();
				get_template_part('template-parts/blog/' . $iqconnetik_layout . '/content', get_post_format());

			endwhile;

			if (!empty($iqconnetik_columns)) :
				?>
				</div><!-- .<?php echo esc_html($iqconnetik_grid_class); ?>-->
			</div><!-- .grid-columns-wrapper -->
		<?php
			endif; //columns 
		?>
		<?php
		// Previous/next page navigation.
		the_posts_pagination(
			iqconnetik_get_the_posts_pagination_atts()
		);
		?> <?php
			?>
	</div><!-- #layout -->
<?php
else :

	// If no content, include the "No posts found" template.
	get_template_part('template-parts/content', 'none');

endif; //have_posts
