<?php

/**
 * The template for displaying page title in page title section
 *
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (is_search()) :
	$iqconnetik_search_query = esc_html(get_search_query());
	if ((bool) trim($iqconnetik_search_query) === false) :
		echo esc_html__('Search', 'iqconnetik');
	else :
		echo esc_html__('Search Results for: ', 'iqconnetik');
		echo esc_html($iqconnetik_search_query);
	endif;

	return;
endif;

if (is_home()) :
	$iqconnetik_title = iqconnetik_option('blog_page_name', esc_html__('Blog', 'iqconnetik'));
	echo esc_html($iqconnetik_title);

	return;
endif;

if (is_404()) :
	$iqconnetik_title = esc_html__('404', 'iqconnetik');
	echo esc_html($iqconnetik_title);

	return;
endif;

if (function_exists('is_shop')) :
	if (is_shop()) :
		$iqconnetik_title = esc_html__('Shop', 'iqconnetik');
		echo esc_html($iqconnetik_title);

		return;
	endif;
endif;

if (is_singular()) :
	the_title();

	return;
endif;

if (is_archive()) :
	$iqconnetik_hide_tax_name_class = iqconnetik_option('title_hide_taxonomy_name', '') ? 'hide-tax-name' : 'tax-name';
	echo '<span class="' . esc_attr($iqconnetik_hide_tax_name_class) . '">';
	the_archive_title();
	echo '</span>';

	return;
endif;
