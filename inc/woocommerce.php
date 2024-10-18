<?php

/**
 * WooCommerce support
 *
 * @package WordPress
 * @subpackage Iqconnetik
 * @since 0.0.1
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

//Woo min required version is 3.6

//removing aria-describedby in add to cart link
add_filter('woocommerce_loop_add_to_cart_link', 'iqconnetik_woocommerce_loop_add_to_cart_link', 10, 2);
if (!function_exists('iqconnetik_woocommerce_loop_add_to_cart_link')) :
	function iqconnetik_woocommerce_loop_add_to_cart_link($link, $product)
	{
		$link = sprintf(
			'<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s" aria-label="%s">%s</a>',
			esc_url($product->add_to_cart_url()),
			esc_attr(isset($quantity) ? $quantity : 1),
			esc_attr($product->get_id()),
			esc_attr($product->get_sku()),
			esc_attr(isset($class) ? $class : 'button product_type_simple add_to_cart_button ajax_add_to_cart'),
			esc_attr($product->add_to_cart_description()),
			esc_html($product->add_to_cart_text())
		);

		return $link;
	}
endif;

//header products counter ajax refresh
add_filter('woocommerce_add_to_cart_fragments', 'iqconnetik_filter_woocommerce_cart_count_fragments', 10, 1);
if (!function_exists('iqconnetik_filter_woocommerce_cart_count_fragments')) :
	function iqconnetik_filter_woocommerce_cart_count_fragments($fragments)
	{
		$fragments['span.cart-count'] = '<span class="cart-count">';
		if (!empty(WC()->cart->get_cart_contents_count())) {
			$fragments['span.cart-count'] .= WC()->cart->get_cart_contents_count();
		}
		$fragments['span.cart-count'] .= '</span>';
		return $fragments;
	}
endif;

//removing wrapper 'main' and 'div' elements - templates/global and adding our custom with class .woo
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'iqconnetik_action_woocommerce_output_content_wrapper', 10);
if (!function_exists('iqconnetik_action_woocommerce_output_content_wrapper')) :
	function iqconnetik_action_woocommerce_output_content_wrapper()
	{
		echo '<div class="woo">';
	}
endif;
add_action('woocommerce_after_main_content', 'iqconnetik_action_woocommerce_output_content_wrapper_end', 10);
if (!function_exists('iqconnetik_action_woocommerce_output_content_wrapper_end')) :
	function iqconnetik_action_woocommerce_output_content_wrapper_end()
	{
		echo '</div><!--.woo-->';
	}
endif;


//removing default WooCommerce sidebar - we have our sidebar
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

//removing default breadcrumbs - we have our breadcrumbs
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

//removing page title if it is showing in the title section (to prevent duplication)
$iqconnetik_title = iqconnetik_option('title_show_title', '');
if (!empty($iqconnetik_title)) {
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
	add_filter('woocommerce_show_page_title', '__return_false');
}

/////////////////
//Products Loop//
/////////////////

//wrap products counter and filter dropdown to div on products archive
add_action('woocommerce_before_shop_loop', 'iqconnetik_action_woocommerce_before_shop_loop_open_wrap_div', 15);
if (!function_exists('iqconnetik_action_woocommerce_before_shop_loop_open_wrap_div')) :
	function iqconnetik_action_woocommerce_before_shop_loop_open_wrap_div()
	{
		echo '<div class="row clear woo-count-filter-wrap">';
	}
endif;

// view
add_action('woocommerce_before_shop_loop', 'upqode_action_before_shop_loop_wrap_form_close', 30);
if (!function_exists('upqode_action_before_shop_loop_wrap_form_close')) :
	function upqode_action_before_shop_loop_wrap_form_close()
	{
		echo '<span class="toggle_shop_view_wrap">' . esc_html('View', 'iqconnetik') . '<a href="#" id="toggle_shop_view" class=""></a></span>';
	}
endif;

add_action('woocommerce_before_shop_loop', 'iqconnetik_action_woocommerce_before_shop_loop_close_wrap_div', 35);
if (!function_exists('iqconnetik_action_woocommerce_before_shop_loop_close_wrap_div')) :
	function iqconnetik_action_woocommerce_before_shop_loop_close_wrap_div()
	{
		echo '</div><!--.woo-count-filter-wrap-->';
	}
endif; //iqconnetik_action_woocommerce_before_shop_loop_close_wrap_div

//wrap product and category loop item into div
add_action('woocommerce_before_subcategory', 'iqconnetik_action_woocommerce_before_shop_loop_item_open_wrap_div', 5);
add_action('woocommerce_before_shop_loop_item', 'iqconnetik_action_woocommerce_before_shop_loop_item_open_wrap_div', 5);
if (!function_exists('iqconnetik_action_woocommerce_before_shop_loop_item_open_wrap_div')) :
	function iqconnetik_action_woocommerce_before_shop_loop_item_open_wrap_div()
	{
		echo '<div class="product-loop-item with_shadow">';
		//add to cart button options
		$hide_btn  = iqconnetik_option('product_simple_add_to_cart_hide_button', '') ? 'hide-btn' : '';
		//additional product info options
		$show_cat  = iqconnetik_option('product_show_category', '') ? 'show-cat' : '';
		$show_desc = iqconnetik_option('product_show_short_description', '') ? 'show-desc' : '';
		echo '<div class="product-item-wrap ' . esc_attr($hide_btn . ' ' . $show_cat . ' ' . $show_desc) . '">';
		echo '<div class="product-thumbnail-wrap">';
	}
endif; //iqconnetik_action_woocommerce_before_shop_loop_item_open_wrap_div

//onsale
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
add_action('woocommerce_after_shop_loop_item', 'woocommerce_show_product_loop_sale_flash', 10);

add_action('woocommerce_after_subcategory', 'iqconnetik_action_woocommerce_after_shop_loop_item_close_wrap_div', 15);
add_action('woocommerce_after_shop_loop_item', 'iqconnetik_action_woocommerce_after_shop_loop_item_close_wrap_div', 15);
if (!function_exists('iqconnetik_action_woocommerce_after_shop_loop_item_close_wrap_div')) :
	function iqconnetik_action_woocommerce_after_shop_loop_item_close_wrap_div()
	{
		echo '</div><!--.product-item-wrap-->';
		echo '</div><!--.product-loop-item-->';
	}
endif;

add_action('woocommerce_after_shop_loop_item_title', 'iqconnetik_action_woocommerce_after_shop_loop_item_product_short_description', 10);
if (!function_exists('iqconnetik_action_woocommerce_after_shop_loop_item_product_short_description')) :
	function iqconnetik_action_woocommerce_after_shop_loop_item_product_short_description()
	{
		global $product;
		echo '<div class="product-short-description">';
		echo wp_kses_post($product->get_short_description());
		echo '</div><!-- .product-short-description -->';
	}
endif;

//quick view button
if (class_exists('YITH_WCQV_Frontend')) :
	remove_action('woocommerce_after_shop_loop_item', array(YITH_WCQV_Frontend::get_instance(), 'yith_add_quick_view_button'), 15);
	remove_action('yith_wcwl_table_after_product_name', array(YITH_WCQV_Frontend::get_instance(), 'yith_add_quick_view_button'), 15, 0);

	add_filter('yith_add_quick_view_button_html', 'iqconnetik_filter_yith_add_quick_view_button_html');
	if (!function_exists('iqconnetik_filter_yith_add_quick_view_button_html')) :
		function iqconnetik_filter_yith_add_quick_view_button_html($html)
		{
			return str_replace('class="button ', 'class="', $html);
		}
	endif;
endif;

//closing product link after image
add_action('woocommerce_before_shop_loop_item_title', 'iqconnetik_action_woocommerce_template_loop_close_link_and_div_after_thumbnail', 11);
if (!function_exists('iqconnetik_action_woocommerce_template_loop_close_link_and_div_after_thumbnail')) :
	function iqconnetik_action_woocommerce_template_loop_close_link_and_div_after_thumbnail()
	{
		echo '</a>';

		$css_rating_class = iqconnetik_option('product_show_thumbnail_rating', '') ? 'visible' : 'hidden';
		echo '<div class="product-thumbnail-rating-wrap ' . esc_attr($css_rating_class) . '">';
		if (wc_review_ratings_enabled()) {
			woocommerce_template_loop_rating();
		}
		echo '</div>';

		$show_cart_link   = iqconnetik_option('product_show_cart_thumbnail_link', '');
		$show_add_to_cart = iqconnetik_option('product_show_thumbnail_add_to_cart', '');
		$show_whishlist   = defined('YITH_WCWL') && iqconnetik_option('product_show_thumbnail_whishlist', '');
		$show_quick_view  = class_exists('YITH_WCQV_Frontend');

		if ($show_cart_link || $show_add_to_cart || $show_whishlist || $show_quick_view) :
			echo '<div class="product-buttons-wrap">';
			echo '<div class="product-icons-wrap">';
			if ($show_cart_link) {
				echo '<a class="added_to_cart wc-forward"  href="' . esc_url(wc_get_cart_url()) . '"></a>';
			}
			if ($show_add_to_cart) {
				//echo '<div class="add-to-cart-wrap">';
				woocommerce_template_loop_add_to_cart();
				//echo '</div><!-- .add-to-cart-wrap -->';
			}
			echo '</div><!-- .product-icons-wrap -->';
			echo '</div><!-- .product-buttons-wrap -->';
			//YITH WooCommerce Wishlist
			if ($show_whishlist && is_user_logged_in()) {
				echo do_shortcode('[yith_wcwl_add_to_wishlist]');
			}
			//YITH WooCommerce Quick View
			if ($show_quick_view) {
				echo do_shortcode('[yith_quick_view]');
			}
		endif; //buttons
		echo '</div><!-- .product-thumbnail-wrap -->';
	}
endif; //iqconnetik_woocommerce_template_loop_close_link_and_div_after_thumbnail

//putting link to product in the product title heading
if (!function_exists('iqconnetik_action_woocommerce_template_loop_product_title')) :
	function iqconnetik_action_woocommerce_template_loop_product_title()
	{
		echo '<h5 class="woocommerce-loop-product__title darklinks">';
		woocommerce_template_loop_product_link_open();
		the_title();
		woocommerce_template_loop_product_link_close();
		echo '</h5>';
	}

endif;

add_action('woocommerce_shop_loop_item_title', 'iqconnetik_action_woocommerce_template_loop_product_title_elementor_fix', 5);
function iqconnetik_action_woocommerce_template_loop_product_title_elementor_fix()
{
	add_action('woocommerce_shop_loop_item_title', 'iqconnetik_action_woocommerce_template_loop_product_title', 10);
	remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
}

function iqconnetik_woocommerce_template_loop_rating()
{
	$css_show_rating_class = iqconnetik_option('product_show_rating', '') ? 'visible' : 'hidden';
	if (wc_review_ratings_enabled()) {
		echo '<div class="product-rating-wrap ' . esc_attr($css_show_rating_class) . '">';
		woocommerce_template_loop_rating();
		echo '</div>';
	}
}

add_action('woocommerce_shop_loop_item_title', 'iqconnetik_action_woocommerce_template_loop_product_rating_elementor_fix', 5);
function iqconnetik_action_woocommerce_template_loop_product_rating_elementor_fix()
{
	add_action('woocommerce_after_shop_loop_item_title', 'iqconnetik_woocommerce_template_loop_rating', 5);
	remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
}

//closing category link after image
add_action('woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_link_close', 9);
remove_action('woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10);
//putting link to category in the product category title heading
add_action('woocommerce_shop_loop_subcategory_title', 'iqconnetik_action_woocommerce_template_loop_category_title', 10);
if (!function_exists('iqconnetik_action_woocommerce_template_loop_category_title')) :
	function iqconnetik_action_woocommerce_template_loop_category_title($category)
	{
		echo '</div><!-- .product-thumbnail-wrap -->';
		echo '<h2 class="woocommerce-loop-category__title">';
		woocommerce_template_loop_category_link_open($category);
		echo esc_html($category->name);
		if ($category->count > 0) {
			echo wp_kses(
				apply_filters(
					'iqconnetik_woocommerce_subcategory_count_html',
					' <mark class="count">(' . esc_html($category->count) . ')</mark>',
					$category
				),
				array(
					'mark' => array(
						'class' => array(),
					),
				)
			);
		}
		woocommerce_template_loop_category_link_close();
		echo '</h2>';
	}
endif;

//add categories to loop
add_action('woocommerce_shop_loop_item_title', 'iqconnetik_action_woocommerce_shop_loop_item_title_open_wrap', 5);
if (!function_exists('iqconnetik_action_woocommerce_shop_loop_item_title_open_wrap')) :
	function iqconnetik_action_woocommerce_shop_loop_item_title_open_wrap()
	{
		echo '<div class="product-title-cat-wrap">';
	}
endif;
add_action('woocommerce_shop_loop_item_title', 'iqconnetik_action_woocommerce_shop_loop_item_title', 20);
if (!function_exists('iqconnetik_action_woocommerce_shop_loop_item_title')) :
	function iqconnetik_action_woocommerce_shop_loop_item_title()
	{
		global $product;
		echo wp_kses_post(wc_get_product_category_list($product->get_id(), ', ', '<span class="posted_in">', '</span>'));
		echo '</div><!-- .product-title-cat-wrap -->';
		echo '<div class="product-footer">';
	}
endif;

//add price and buttons inside it
if (!function_exists('iqconnetik_action_woocommerce_after_shop_loop_item_title_price_and_add_to_cart_wrap')) :
	function iqconnetik_action_woocommerce_after_shop_loop_item_title_price_and_add_to_cart_wrap()
	{
		echo '<div class="shop-product-buttons">';
		woocommerce_template_loop_add_to_cart();
		echo '</div>';
		echo '</div><!-- .product-footer -->';
	}
endif; //iqconnetik_action_woocommerce_after_shop_loop_item_title_rating_wrap_and_reviews_count

add_action('woocommerce_after_shop_loop_item_title', 'iqconnetik_action_woocommerce_after_shop_loop_item_title_price_and_add_to_cart_wrap_elementor_fix', 5);
function iqconnetik_action_woocommerce_after_shop_loop_item_title_price_and_add_to_cart_wrap_elementor_fix()
{
	add_action('woocommerce_after_shop_loop_item_title', 'iqconnetik_action_woocommerce_after_shop_loop_item_title_price_and_add_to_cart_wrap', 10);
	remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
}

//remove closing A tag from the end of product and category loop item - we have our own earlier
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_after_subcategory', 'woocommerce_template_loop_category_link_close', 10);

//change woo pagination
add_action('woocommerce_after_shop_loop', 'iqconnetik_action_woocommerce_after_shop_loop', 9);
if (!function_exists('iqconnetik_action_woocommerce_after_shop_loop')) :
	function iqconnetik_action_woocommerce_after_shop_loop()
	{
		echo '<div class="nav-links">';
	}
endif;
//change woo pagination
add_action('woocommerce_after_shop_loop', 'iqconnetik_action_woocommerce_after_shop_loop_end', 1);
if (!function_exists('iqconnetik_action_woocommerce_after_shop_loop_end')) :
	function iqconnetik_action_woocommerce_after_shop_loop_end()
	{
		echo '</div><!--.nav-links -->';
	}
endif;
//change woo pagination
add_filter('woocommerce_pagination_args', 'iqconnetik_filter_woocommerce_pagination_args');
if (!function_exists('iqconnetik_filter_woocommerce_pagination_args')) :
	function iqconnetik_filter_woocommerce_pagination_args($args)
	{
		$args['type'] = 'plain';
		$args         = wp_parse_args(iqconnetik_get_the_posts_pagination_atts(), $args);
		return $args;
	}
endif;

//add autocomplete none for search form
add_filter('get_product_search_form', 'iqconnetik_filter_woocommerce_get_product_search_form');
if (!function_exists('iqconnetik_filter_woocommerce_get_product_search_form')) :
	function iqconnetik_filter_woocommerce_get_product_search_form($form_html)
	{
		$form_html = str_replace('<form', '<form autocomplete="off"', $form_html);
		$form_html = str_replace('class="woocommerce-product-search"', 'class="woocommerce-product-search search-form"', $form_html);
		$form_html = str_replace('class="woocommerce-product-search"', 'class="woocommerce-product-search search-form"', $form_html);
		$form_html = str_replace('<button type="submit"', '<button type="submit" class="search-submit"', $form_html);
		$form_html = str_replace('</button>', iqconnetik_icon('magnify', true) . '</button>', $form_html);
		return $form_html;
	}
endif;

////////////////////
//cart page layout//
////////////////////
add_action('woocommerce_before_cart', 'iqconnetik_action_woocommerce_before_cart');
if (!function_exists('iqconnetik_action_woocommerce_before_cart')) :
	function iqconnetik_action_woocommerce_before_cart()
	{
		echo '<div class ="cart-cols">';
	}
endif;

add_action('woocommerce_after_cart', 'iqconnetik_action_woocommerce_after_cart');
if (!function_exists('iqconnetik_action_woocommerce_after_cart')) :
	function iqconnetik_action_woocommerce_after_cart()
	{
		echo '</div><!-- .cart-cols.cols-2 -->';
	}
endif;

//////////
//Blocks//
//////////

//add autocomplete none for search form
add_filter('woocommerce_blocks_product_grid_item_html', 'iqconnetik_filter_woocommerce_blocks_product_grid_item_html', 10, 2);
if (!function_exists('iqconnetik_filter_woocommerce_blocks_product_grid_item_html')) :
	function iqconnetik_filter_woocommerce_blocks_product_grid_item_html($html, $data)
	{
		return "<li class=\"product wc-block-grid__product\">
				<div class=\"product-loop-item\">
					<div class=\"product-item-wrap\">
					    <div class=\"product-thumbnail-wrap\">
							<a href=\"{$data->permalink}\" class=\"wc-block-grid__product-link\">
								{$data->image}
							</a>
						</div>
						<a href=\"{$data->permalink}\" class=\"wc-block-grid__product-link\">
							{$data->title}
						</a>
						{$data->badge}
						{$data->price}
						{$data->rating}
						{$data->button}
					</div>
				</div>
			</li>";
	}
endif;

/*
add .products to block UL
uncomment, if needed
add_filter( 'the_content', 'iqconnetik_filter_woocommerce_the_content' );
*/
if (!function_exists('iqconnetik_filter_woocommerce_the_content')) :
	function iqconnetik_filter_woocommerce_the_content($html)
	{
		return str_replace('ul class="wc-block-grid__products"', 'ul class="products wc-block-grid__products"', $html);
	}
endif;

//add class to checkout button
remove_action('woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_proceed_to_checkout', 20);
add_action('woocommerce_widget_shopping_cart_buttons', 'iqconnetik_action_woocommerce_widget_shopping_cart_proceed_to_checkout', 20);
if (!function_exists('iqconnetik_action_woocommerce_widget_shopping_cart_proceed_to_checkout')) :
	function iqconnetik_action_woocommerce_widget_shopping_cart_proceed_to_checkout()
	{
		echo '<a href="' . esc_url(wc_get_checkout_url()) . '" class="button alt checkout wc-forward">' . esc_html__('Checkout', 'iqconnetik') . '</a>';
	}
endif;

add_action('woocommerce_checkout_before_order_review_heading', 'iqconnetik_action_echo_div_checkout_before_order_review_heading');
if (!function_exists('iqconnetik_action_echo_div_checkout_before_order_review_heading')) :
	function iqconnetik_action_echo_div_checkout_before_order_review_heading()
	{
		echo '<div class="order_wrap">';
	}
endif;

add_action('woocommerce_checkout_after_order_review', 'iqconnetik_action_echo_div_checkout_after_order_review');
if (!function_exists('iqconnetik_action_echo_div_checkout_after_order_review')) :
	function iqconnetik_action_echo_div_checkout_after_order_review()
	{
		echo '</div>';
	}
endif;

//add spans to filter widget braces
add_filter('woocommerce_layered_nav_count', 'iqconnetik_filter_woocommerce_layered_nav_count', 10, 2);
if (!function_exists('iqconnetik_filter_woocommerce_layered_nav_count')) :
	function iqconnetik_filter_woocommerce_layered_nav_count($html, $count)
	{
		return '<span class="count"><span class="count-open">(</span>' . absint($count) . '<span class="count-close">)</span></span>';
	}
endif;

//cart_page
remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');

add_action('woocommerce_after_cart', 'woocommerce_cross_sell_display');

//add sidebar position option for product and shop
add_filter('iqconnetik_customizer_options', 'iqconnetik_filter_iqconnetik_customizer_options');
if (!function_exists('iqconnetik_filter_iqconnetik_customizer_options')) :
	function iqconnetik_filter_iqconnetik_customizer_options($options)
	{
		//sections
		$options['section_iqconnetik_woocommerce_layout'] = array(
			'type'        => 'section',
			'panel'       => 'woocommerce',
			'label'       => esc_html__('Shop Layout', 'iqconnetik'),
			'description' => esc_html__('These options let you manage sidebar positions on the shop and product pages.', 'iqconnetik'),
		);

		$options['section_iqconnetik_woocommerce_products'] = array(
			'type'        => 'section',
			'panel'       => 'woocommerce',
			'label'       => esc_html__('Products List', 'iqconnetik'),
			'description' => esc_html__('These options let you manage your products list display.', 'iqconnetik'),
		);

		$options['section_iqconnetik_woocommerce_product_share_button'] = array(
			'type'        => 'section',
			'panel'       => 'woocommerce',
			'label'       => esc_html__('Product Share Buttons', 'iqconnetik'),
			'description' => esc_html__('These options let you manage your product share buttons.', 'iqconnetik'),
		);

		//options
		//sidebars
		$options['shop_sidebar_width'] = array(
			'type'    => 'select',
			'section' => 'section_iqconnetik_woocommerce_layout',
			'label'   => esc_html__('Sidebar width on big screens', 'iqconnetik'),
			'default' => iqconnetik_option('shop_sidebar_width', ''),
			'choices' => array(
				''   => esc_html__('Default', 'iqconnetik'),
				'33' => esc_html__('1/3 - 33%', 'iqconnetik'),
				'25' => esc_html__('1/4 - 25%', 'iqconnetik'),
				'30' => esc_html__('30% - 70%', 'iqconnetik'),
			),
		);
		$options['shop_gap_width'] = array(
			'type'    => 'select',
			'section' => 'section_iqconnetik_woocommerce_layout',
			'label'   => esc_html__('Sidebar gap width', 'iqconnetik'),
			'default' => iqconnetik_option('shop_gap_width', ''),
			'choices' => array(
				''   => esc_html__('Default', 'iqconnetik'),
				'10' => esc_html__('10px', 'iqconnetik'),
				'20' => esc_html__('20px', 'iqconnetik'),
				'30' => esc_html__('30px', 'iqconnetik'),
				'40' => esc_html__('40px', 'iqconnetik'),
				'50' => esc_html__('50px', 'iqconnetik'),
				'60' => esc_html__('60px', 'iqconnetik'),
				'80' => esc_html__('80px', 'iqconnetik'),
			),
		);
		$options['shop_sidebar_position'] = array(
			'type'        => 'radio',
			'section'     => 'section_iqconnetik_woocommerce_layout',
			'default'     => iqconnetik_option('shop_sidebar_position', 'right'),
			'label'       => esc_html__('Shop sidebar position', 'iqconnetik'),
			'description' => esc_html__('This option let you manage sidebar position on the shop page.', 'iqconnetik'),
			'choices'     => iqconnetik_get_sidebar_position_options(),
		);

		$options['product_sidebar_position'] = array(
			'type'        => 'radio',
			'section'     => 'section_iqconnetik_woocommerce_layout',
			'default'     => iqconnetik_option('product_sidebar_position', 'right'),
			'label'       => esc_html__('Product sidebar position', 'iqconnetik'),
			'description' => esc_html__('This option let you manage sidebar position on product pages.', 'iqconnetik'),
			'choices'     => iqconnetik_get_sidebar_position_options(),
		);

		$options['header_cart_dropdown'] = array(
			'type'        => 'checkbox',
			'section'     => 'section_iqconnetik_woocommerce_layout',
			'default'     => iqconnetik_option('header_cart_dropdown', ''),
			'label'       => esc_html__('Show Cart Dropdown in Header', 'iqconnetik'),
			'description' => esc_html__('Show cart icon in header with product count in shopping cart if added.', 'iqconnetik'),
		);

		//products list
		//button options
		$options['product_simple_add_to_cart_hide_button'] = array(
			'type'    => 'checkbox',
			'section' => 'section_iqconnetik_woocommerce_products',
			'default' => iqconnetik_option('product_simple_add_to_cart_hide_button', ''),
			'label'   => esc_html__('Hide product "Add to Cart" button', 'iqconnetik'),
		);

		//products additional info options
		$options['product_show_category'] = array(
			'type'    => 'checkbox',
			'section' => 'section_iqconnetik_woocommerce_products',
			'default' => iqconnetik_option('product_show_category', ''),
			'label'   => esc_html__('Show products categories', 'iqconnetik'),
		);

		$options['product_show_rating'] = array(
			'type'    => 'checkbox',
			'section' => 'section_iqconnetik_woocommerce_products',
			'default' => iqconnetik_option('product_show_rating', ''),
			'label'   => esc_html__('Show products rating', 'iqconnetik'),
		);

		$options['product_show_short_description'] = array(
			'type'    => 'checkbox',
			'section' => 'section_iqconnetik_woocommerce_products',
			'default' => iqconnetik_option('product_show_short_description', ''),
			'label'   => esc_html__('Show product short description', 'iqconnetik'),
		);

		$options['product_show_thumbnail_add_to_cart'] = array(
			'type'    => 'checkbox',
			'section' => 'section_iqconnetik_woocommerce_products',
			'default' => iqconnetik_option('product_show_thumbnail_add_to_cart', ''),
			'label'   => esc_html__('Show "Add to Cart" button over thumbnail', 'iqconnetik'),
		);

		$options['product_show_cart_thumbnail_link'] = array(
			'type'    => 'checkbox',
			'section' => 'section_iqconnetik_woocommerce_products',
			'default' => iqconnetik_option('product_show_cart_thumbnail_link', ''),
			'label'   => esc_html__('Show "Cart" button over thumbnail', 'iqconnetik'),
		);

		$options['product_show_thumbnail_rating'] = array(
			'type'    => 'checkbox',
			'section' => 'section_iqconnetik_woocommerce_products',
			'default' => iqconnetik_option('product_show_thumbnail_rating', ''),
			'label'   => esc_html__('Show rating over thumbnail', 'iqconnetik'),
		);

		if (defined('YITH_WCWL')) {
			$options['product_show_thumbnail_whishlist'] = array(
				'type'    => 'checkbox',
				'section' => 'section_iqconnetik_woocommerce_products',
				'default' => iqconnetik_option('product_show_thumbnail_whishlist', ''),
				'label'   => esc_html__('Show "Whishlist" button over thumbnail', 'iqconnetik'),
			);
		}

		//product share buttons
		$options['product_share_facebook'] = array(
			'type'    => 'checkbox',
			'section' => 'section_iqconnetik_woocommerce_product_share_button',
			'label'   => esc_html__('Enable Facebook Share Button', 'iqconnetik'),
			'default' => iqconnetik_option('product_share_facebook', true),
		);

		$options['product_share_twitter'] = array(
			'type'    => 'checkbox',
			'section' => 'section_iqconnetik_woocommerce_product_share_button',
			'label'   => esc_html__('Enable Twitter Share Button', 'iqconnetik'),
			'default' => iqconnetik_option('product_share_twitter', true),
		);

		$options['product_share_telegram'] = array(
			'type'    => 'checkbox',
			'section' => 'section_iqconnetik_woocommerce_product_share_button',
			'label'   => esc_html__('Enable Telegram Share Button', 'iqconnetik'),
			'default' => iqconnetik_option('product_share_telegram', true),
		);

		$options['product_share_pinterest'] = array(
			'type'    => 'checkbox',
			'section' => 'section_iqconnetik_woocommerce_product_share_button',
			'label'   => esc_html__('Enable Pinterest Share Button', 'iqconnetik'),
			'default' => iqconnetik_option('product_share_pinterest', true),
		);

		$options['product_share_linkedin'] = array(
			'type'    => 'checkbox',
			'section' => 'section_iqconnetik_woocommerce_product_share_button',
			'label'   => esc_html__('Enable LinkedIn Share Button', 'iqconnetik'),
			'default' => iqconnetik_option('product_share_linkedin', true),
		);

		return $options;
	}
endif;

//elements in single product summary
add_action('woocommerce_before_add_to_cart_button', 'iqconnetik_action_echo_open_div_before_add_to_cart_button');
if (!function_exists('iqconnetik_action_echo_open_div_before_add_to_cart_button')) :
	function iqconnetik_action_echo_open_div_before_add_to_cart_button()
	{
		echo '<div class="add-to-cart">';
	}
endif;

add_action('woocommerce_after_add_to_cart_button', 'iqconnetik_action_echo_open_div_after_add_to_cart_button');
if (!function_exists('iqconnetik_action_echo_open_div_after_add_to_cart_button')) :
	function iqconnetik_action_echo_open_div_after_add_to_cart_button()
	{
		echo '</div>';
	}
endif;

//change image thumbnails size
add_filter('woocommerce_get_image_size_gallery_thumbnail', 'iqconnetik_change_image_size_gallery_thumbnail');
if (!function_exists('iqconnetik_change_image_size_gallery_thumbnail')) :
	function iqconnetik_change_image_size_gallery_thumbnail($size)
	{
		return array(
			'width' => 300,
			'height' => 300,
			'crop' => 0,
		);
	}
endif;

add_action('woocommerce_before_single_product_summary', 'iqconnetik_action_echo_div_columns_before_single_product_summary', 9);
if (!function_exists('iqconnetik_action_echo_div_columns_before_single_product_summary')) :
	function iqconnetik_action_echo_div_columns_before_single_product_summary()
	{
		echo '<div class="product-gallery-wrap">';
	}
endif;

add_action('woocommerce_before_single_product_summary', 'iqconnetik_action_echo_div_close_first_column_before_single_product_summary', 21);
if (!function_exists('iqconnetik_action_echo_div_close_first_column_before_single_product_summary')) :
	function iqconnetik_action_echo_div_close_first_column_before_single_product_summary()
	{
		echo '</div><!-- eof .product-gallery-wrap -->';
	}
endif;

add_filter('woocommerce_product_thumbnails_columns', 'paulc_change_product_thumbnails_columns');
function paulc_change_product_thumbnails_columns()
{
	return 4; // change the value as per your need
}

add_action('woocommerce_single_product_summary', 'flicke_action_echo_open_div_before_add_to_cart_button');
if (!function_exists('flicke_action_echo_open_div_before_add_to_cart_button')) :
	function flicke_action_echo_open_div_before_add_to_cart_button()
	{
		$product_share_facebook  = iqconnetik_option('product_share_facebook', true);
		$product_share_twitter  = iqconnetik_option('product_share_twitter', true);
		$product_share_telegram  = iqconnetik_option('product_share_telegram', true);
		$product_share_pinterest  = iqconnetik_option('product_share_pinterest', true);
		$product_share_linkedin  = iqconnetik_option('product_share_linkedin', true);
		if ($product_share_facebook || $product_share_twitter || $product_share_telegram || $product_share_pinterest || $product_share_linkedin) {
			echo '<div class="share_buttons">';
			if ($product_share_facebook) {
				echo '<a href="https://www.facebook.com/share.php?u=' . esc_url(get_permalink()) . '" class="social-icon color-bg-icon ico-socicon-facebook" target="_blank"></a>';
			}

			if ($product_share_twitter) {
				echo '<a href="https://twitter.com/intent/tweet?url=' . esc_url(get_permalink()) . '" class="social-icon color-bg-icon ico-socicon-x-twitter" target="_blank"></a>';
			}

			if ($product_share_telegram) {
				echo '<a href="https://telegram.me/share/url?url=' . esc_url(get_permalink()) . '" class="social-icon color-bg-icon ico-socicon-telegram" target="_blank"></a>';
			}

			if ($product_share_pinterest) {
				echo '<a href="https://pinterest.com/pin/create/bookmarklet/?url=' . esc_url(get_permalink()) . '" class="social-icon color-bg-icon ico-socicon-pinterest" target="_blank"></a>';
			}

			if ($product_share_linkedin) {
				echo '<a href="https://www.linkedin.com/shareArticle?url=' . esc_url(get_permalink()) . '" class="social-icon color-bg-icon ico-socicon-linkedin" target="_blank"></a>';
			}
			echo '</div>';
		}
	}
endif;

add_filter('formatted_woocommerce_price', 'iqconnetik_price_decimals', 10, 5);
function iqconnetik_price_decimals($formatted_price, $price, $decimal_places, $decimal_separator, $thousand_separator)
{
	$unit = number_format(intval($price), 0, $decimal_separator, $thousand_separator);
	$decimal = sprintf('%02d', ($price - intval($price)) * 100);
	return $unit . '<sup>' . $decimal . '</sup>';
}
