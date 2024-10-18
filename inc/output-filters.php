<?php

/**
 * Template HTML output filters
 *
 * @package Iqconnetik
 * @since 0.0.1
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

//remove 'has-post-thumbnail' post_class if appropriate single post layout is selected
if (!function_exists('iqconnetik_filter_post_class')) :
	function iqconnetik_filter_post_class($iqconnetik_classes)
	{
		if (is_single() && 'title-section-image' === iqconnetik_option('blog_single_layout', '')) {
			$iqconnetik_key = array_search('has-post-thumbnail', $iqconnetik_classes, true);
			unset($iqconnetik_classes[$iqconnetik_key]);
		}

		return $iqconnetik_classes;
	}
endif;
add_filter('post_class', 'iqconnetik_filter_post_class');

// Wraps the title's each word in separate span
if (!function_exists('iqconnetik_filter_widget_title')) :
	/**
	 * Wraps the title words in spans.
	 *
	 * @param string $iqconnetik_title The string.
	 *
	 * @return string          The modified string.
	 */
	function iqconnetik_filter_widget_title($iqconnetik_title)
	{
		//RSS escaping HTML in title and break it

		if (empty($iqconnetik_title)) {
			return;
		}

		if (stripos($iqconnetik_title, 'rss') !== false) {
			return $iqconnetik_title;
		}

		// Cut the title into words.
		$iqconnetik_words = explode(' ', $iqconnetik_title);

		$iqconnetik_array = array();

		foreach ($iqconnetik_words as $iqconnetik_index => $iqconnetik_word) {
			$iqconnetik_counter = $iqconnetik_index + 1;
			$iqconnetik_array[] = '<span class="widget-title-word widget-title-word-' . $iqconnetik_counter . '">' . $iqconnetik_word . '</span>';
		}

		return implode(' ', $iqconnetik_array);
	}
endif;
add_filter('widget_title', 'iqconnetik_filter_widget_title', 999);

//Since 5.4 this do not needed?
//filter calendar widget to fix validation errors
if (!function_exists('iqconnetik_filter_widget_calendar_html')) :
	function iqconnetik_filter_widget_calendar_html($iqconnetik_html)
	{
		//get tfoot
		$iqconnetik_tfoot = preg_match('/<tfoot>(.|\n)*<\/tfoot>/', $iqconnetik_html, $iqconnetik_match);
		//remove tfoot from table
		$iqconnetik_html = preg_replace('/<tfoot>(.|\n)*<\/tfoot>/', '', $iqconnetik_html);
		//attach tfoot after tbody
		if (!empty($iqconnetik_match[0])) {
			$iqconnetik_html = str_replace('</tbody>', "</tbody>\n\t" . $iqconnetik_match[0], $iqconnetik_html);
		}

		return $iqconnetik_html;
	} //iqconnetik_filter_widget_calendar_html()
endif;
add_filter('get_calendar', 'iqconnetik_filter_widget_calendar_html');

//wrapping in a span widgets categories and archives items count - but skip dropdowns
if (!function_exists('iqconnetik_filter_add_span_to_arhcive_widget_count')) :
	function iqconnetik_filter_add_span_to_arhcive_widget_count($iqconnetik_links)
	{
		if (stristr($iqconnetik_links, '<option')) {
			return $iqconnetik_links;
		}

		//for woo categories widget
		$iqconnetik_links = str_replace('<span class="count">(', '<span class="count"><span class="count-open">(</span>', $iqconnetik_links);

		//for categories widget
		$iqconnetik_links = str_replace('</a> (', '</a> <span class="count"><span class="count-open">(</span>', $iqconnetik_links);
		//for archive widget
		$iqconnetik_links = str_replace('&nbsp;(', ' <span class="count"><span class="count-open">(</span>', $iqconnetik_links);
		$iqconnetik_links = preg_replace('/([0-9]+)\)/', '$1<span class="count-close">)</span></span>', $iqconnetik_links);

		//putting span before link for styling purpose
		$iqconnetik_links = preg_replace('~(<a href=.*</a>) (<span class="count"><span class="count-open">\(</span>([0-9]*)<span class="count-close">\)</span></span>)~', '$2$1', $iqconnetik_links);

		return $iqconnetik_links;
	}
endif;
add_filter('wp_list_categories', 'iqconnetik_filter_add_span_to_arhcive_widget_count');
add_filter('get_archives_link', 'iqconnetik_filter_add_span_to_arhcive_widget_count');

//wrapping tag links in span
if (!function_exists('iqconnetik_filter_add_spans_to_tag_links')) :
	function iqconnetik_filter_add_spans_to_tag_links($iqconnetik_html)
	{

		$iqconnetik_html = str_replace('<a', '<span><a', $iqconnetik_html);
		$iqconnetik_html = str_replace('</a>', '</a></span>', $iqconnetik_html);

		return $iqconnetik_html;
	}
endif;
add_filter('wp_tag_cloud', 'iqconnetik_filter_add_spans_to_tag_links');

//wrapping "category" word in title area in a span
if (!function_exists('iqconnetik_filter_wrap_cat_title_before_colon_in_span')) :
	function iqconnetik_filter_wrap_cat_title_before_colon_in_span($iqconnetik_title)
	{
		$iqconnetik_hide_tax_name_title = iqconnetik_option('blog_hide_taxonomy_type_name', false);
		if (is_category()) {
			$iqconnetik_hide_tax_name_title = true;
		}
		if (empty($iqconnetik_hide_tax_name_title)) {
			return preg_replace('/^.*: /', '<span class="taxonomy-name-title">${0}</span>', $iqconnetik_title);
		} else {
			return preg_replace('/^.*: /', '', $iqconnetik_title);
		}
	}
endif;
add_filter('get_the_archive_title', 'iqconnetik_filter_wrap_cat_title_before_colon_in_span');

// add icon to edit comment link
if (!function_exists('iqconnetik_filter_edit_comment_link')) :
	function iqconnetik_filter_edit_comment_link($edit_comment_html)
	{
		$edit_comment_html = str_replace('<span class="edit-link">', '<span class="edit-link"> ', $edit_comment_html);

		return $edit_comment_html;
	}
endif;
add_filter('edit_comment_link', 'iqconnetik_filter_edit_comment_link');

// add 'data-hover' attribute to nav menu link
if (!function_exists('iqconnetik_filter_menu_item_data_hover_attribute')) :
	function iqconnetik_filter_menu_item_data_hover_attribute($atts, $item, $args, $depth)
	{
		if (!strpos($item->title, 'rel="home" itemprop="url"')) {
			$atts['data-hover'] = $item->title;
		}
		return $atts;
	}
endif;
add_filter('nav_menu_link_attributes', 'iqconnetik_filter_menu_item_data_hover_attribute', 4, 10);


// this function can be used to update views count on posts on wp_footer action
if (!function_exists('iqconnetik_action_increment_post_views_count')) :
	function iqconnetik_action_increment_post_views_count()
	{
		if (is_singular('post')) {
			$post_id = get_the_ID();
			$count   = (int) get_post_meta($post_id, 'iqconnetik_views_count', true);
			$count++;
			update_post_meta($post_id, 'iqconnetik_views_count', $count);
		}
	}
endif;

//add ALT text on post thumbnail if it is empty
if (!function_exists('iqconnetik_filter_post_thumbnail_add_alt_text_if_empty')) :
	function iqconnetik_filter_post_thumbnail_add_alt_text_if_empty($html, $post_id)
	{
		return str_replace('alt=""', 'alt="' . esc_attr(get_the_title($post_id)) . '"', $html);
	}
endif;
add_filter('post_thumbnail_html', 'iqconnetik_filter_post_thumbnail_add_alt_text_if_empty', 10, 2);

//remove 'role="navigation"' from 'nav' pagination element
if (!function_exists('iqconnetik_filter_navigation_markup_template')) :
	function iqconnetik_filter_navigation_markup_template($html)
	{
		$html = str_replace('role="navigation" ', '', $html);
		return $html;
	}
endif;
add_filter('navigation_markup_template', 'iqconnetik_filter_navigation_markup_template');

//remove menu-container class from nav_menu widget
if (!function_exists('iqconnetik_filter_widget_nav_menu_args')) :
	function iqconnetik_filter_widget_nav_menu_args($args)
	{
		$args = wp_parse_args(
			$args,
			array(
				'container' => false,
			)
		);
		return $args;
	}
endif;
add_filter('widget_nav_menu_args', 'iqconnetik_filter_widget_nav_menu_args');

//add custom image size to Gutenberg dropdown
add_filter('image_size_names_choose', 'iqconnetik_filter_image_size_names_choose');
if (!function_exists('iqconnetik_filter_image_size_names_choose')) :
	function iqconnetik_filter_image_size_names_choose($sizes)
	{
		return array_merge($sizes, array(
			'iqconnetik-square' => esc_html__('Square', 'iqconnetik'),
		));
	}
endif;


//gallery block filter
add_filter('render_block', 'iqconnetik_filter_gallery_block_markup', 10, 3);
if (!function_exists('iqconnetik_filter_gallery_block_markup')) :
	function iqconnetik_filter_gallery_block_markup($block_content, $block)
	{

		if ('core/gallery' !== $block['blockName']) {
			return $block_content;
		}
		$output = $block_content;
		if (!empty($block['attrs']['ids'])) {
			$image_size = empty($block['attrs']['sizeSlug']) ? 'large' : $block['attrs']['sizeSlug'];
			foreach ($block['attrs']['ids'] as $id) {
				$image_data = wp_get_attachment_metadata($id);
				if (!empty($image_data)) {

					$output = str_replace('data-id="' . $id . '"', 'data-id="' . $id . '" data-width="' . $image_data['width'] . '" data-height="' . $image_data['height'] . '" ', $output);
				}
			}
		}

		return $output;
	}
endif;

/**
 * Fix active class in nav for blog page and special cats or post inside special cat.
 * since 1.9.9 - auto insert Logo menu item in center of the menu primary if appropriate header is set
 *
 * @param array $menu_items Menu items.
 * @return array
 */
if (!function_exists('iqconnetik_filter_nav_menu_item_classes')) :
	function iqconnetik_filter_nav_menu_item_classes($menu_items, $args)
	{
		//logo in the middle of the primary menu
		if ('primary' === $args->theme_location && '10' === iqconnetik_option('header')) :
			$count = iqconnetik_get_menu_top_level_items_count('primary');
			$logo_item_key = (int) round($count / 2);
			ob_start();
			get_template_part('template-parts/header/logo/logo', iqconnetik_template_part('logo', '1'), array('div' => true));
			$html_logo = ob_get_clean();
			$logo_el = new WP_Post(
				(object) array(
					'menu_item_parent' => '0',
					'url' => esc_url(home_url('/')),
					'title' => $html_logo,
					'ID' => 'primary-logo-id',
					'classes' => array(
						//'d-none',
						'desktop-logo-menu-item',
					),
				)
			);
			$new_items = array();
			$top_level_count = 0;
			$logo_added = false;
			foreach ($menu_items as $key => $item) {
				if ('0' === $item->menu_item_parent) {
					$top_level_count++;
				}
				if (!$logo_added) :
					if (($top_level_count === $logo_item_key + 1) || (1 === $count) || (0 === $count)) :
						$new_items[] = $logo_el;
						$logo_added = true;
					endif; //count = key
				endif; //logo added
				$new_items[] = $item;
			}
			$menu_items = $new_items;
			unset($new_items);
		endif; //primary and heading with center logo
		return $menu_items;
	}
endif;
add_filter('wp_nav_menu_objects', 'iqconnetik_filter_nav_menu_item_classes', 10, 2);

function extra_post_class($classes)
{
	global $post;
	$classes[] = get_post_meta($post->ID, 'post-class', true);
	return $classes;
}
add_filter('post_class', 'extra_post_class');
