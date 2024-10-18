<?php

/**
 * Template helpers fucntions
 *
 * @package Iqconnetik
 * @since 0.0.1
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

//returning walker for change comments HTML
if (!function_exists('iqconnetik_return_comments_walker')) :
	function iqconnetik_return_comments_walker()
	{
		return new Iqconnetik_Comments_Walker;
	}
endif;

if (!function_exists('iqconnetik_get_body_schema_itemtype')) :

	/**
	 * Get itemtype value for body tag
	 *
	 * @since 0.0.1
	 */
	function iqconnetik_get_body_schema_itemtype()
	{

		//Get default itemtype
		$iqconnetik_itemtype = (is_page()) ? 'WebPage' : 'Blog';

		//Change itemtype if is search page
		if (is_search()) {
			$iqconnetik_itemtype = 'SearchResultsPage';
		}

		return $iqconnetik_itemtype;
	}
endif;

//get theme template part
if (!function_exists('iqconnetik_template_part')) :
	function iqconnetik_template_part($iqconnetik_template_part_name, $iqconnetik_default_value = '1')
	{
		$iqconnetik_return = iqconnetik_option($iqconnetik_template_part_name, $iqconnetik_default_value);

		//for demo
		if (!empty($_GET[$iqconnetik_template_part_name])) {
			$iqconnetik_return = absint($_GET[$iqconnetik_template_part_name]);
		}

		return $iqconnetik_return;
	}
endif;

//get proper CSS classes for #main section based on page template
if (!function_exists('iqconnetik_get_page_main_section_css_classes')) :
	function iqconnetik_get_page_main_section_css_classes()
	{
		$return = 'width-inherit';
		if (is_page_template('page-templates/no-sidebar-720.php')) {
			$return = 'container-720';
		}
		if (is_page_template('page-templates/no-sidebar-960.php')) {
			$return = 'container-960';
		}
		if (is_page_template('page-templates/no-sidebar-1170.php')) {
			$return = 'container-1170';
		}

		return $return;
	}
endif;

//get proper CSS classes for main column, aside column and body
if (!function_exists('iqconnetik_get_layout_css_classes')) :
	function iqconnetik_get_layout_css_classes()
	{

		//default - sidebar
		$iqconnetik_return = array(
			'body'  => 'with-sidebar',
			'main'  => 'column-main',
			'aside' => 'column-aside',
		);

		//check for shop
		if (function_exists('is_woocommerce') && is_woocommerce()) :
			if (is_product()) {
				$iqconnetik_shop_sidebar_position_option = iqconnetik_option('product_sidebar_position', 'right');
			}
			if (is_shop() || is_product_taxonomy()) {
				$iqconnetik_shop_sidebar_position_option = iqconnetik_option('shop_sidebar_position', 'right');
			}
			//if empty sidebar or disabled in customizer - removing aside
			if (!is_active_sidebar('shop') || 'no' === $iqconnetik_shop_sidebar_position_option) {
				$iqconnetik_return['body']  = 'no-sidebar';
				$iqconnetik_return['aside'] = false;

				return $iqconnetik_return;
			} //is_active_sidebar( 'shop' )
			//left sidebar
			if ('left' === $iqconnetik_shop_sidebar_position_option) {
				$iqconnetik_return['body'] .= ' sidebar-left';

				return $iqconnetik_return;
				//default - right sidebar
			} else {
				return $iqconnetik_return;
			}
		endif; //is_woocommerce()

		//check for shop wishlist
		if (function_exists('yith_wcwl_is_wishlist_page')) {
			if (yith_wcwl_is_wishlist_page()) {
				$iqconnetik_shop_sidebar_position_option = iqconnetik_option('shop_sidebar_position', 'right');
				//if empty sidebar or disabled in customizer - removing aside
				if (!is_active_sidebar('shop') || 'no' === $iqconnetik_shop_sidebar_position_option) {
					$iqconnetik_return['body']  = 'no-sidebar';
					$iqconnetik_return['aside'] = false;

					return $iqconnetik_return;
				}
				//left sidebar
				if ('left' === $iqconnetik_shop_sidebar_position_option) {
					$iqconnetik_return['body'] .= ' sidebar-left';

					return $iqconnetik_return;
					//default - right sidebar
				} else {
					return $iqconnetik_return;
				}
			}
		}; //yith_wcwl_is_wishlist_page()

		//no sidebar for the events calendar plugin page
		if (function_exists('tribe_is_event_query')) {
			if (tribe_is_event_query()) {

				$iqconnetik_return['body']  = 'no-sidebar';
				$iqconnetik_return['aside'] = false;

				return $iqconnetik_return;
			}
		}

		//if category has meta - overriding default customizer option option
		if (is_category()) {
			$iqconnetik_sidebar_position_option = iqconnetik_get_category_sidebar_position();
		} else {
			if (!is_single()) {
				$iqconnetik_sidebar_position_option = iqconnetik_option('blog_sidebar_position', 'right');
			} else {
				$iqconnetik_sidebar_position_option = iqconnetik_option('blog_single_sidebar_position', 'right');
			}
		} //is_category

		if (!is_page_template('page-templates/home.php')) {
			$sidebar = 'sidebar-1';
			if (is_front_page() && is_active_sidebar('sidebar-home-main')) {
				$sidebar = 'sidebar-home-main';
			}
			//if empty sidebar - removing aside
			if (!is_active_sidebar($sidebar)) {
				$iqconnetik_return['body']  = 'no-sidebar';
				$iqconnetik_return['aside'] = false;

				return $iqconnetik_return;
			} //sidebar-1
		} else {
			//if empty sidebar on home.php page template - removing aside
			if (!is_active_sidebar('sidebar-home-main')) {
				$iqconnetik_return['body']  = 'no-sidebar';
				$iqconnetik_return['aside'] = false;

				return $iqconnetik_return;
			} //sidebar-nome-main
		} //! is_page_template( 'page-templates/home.php'

		//various cases with sidebar
		//single post without sidebars
		if (is_single()) {

			//no sidebar for posts layouts
			if (
				is_page_template('page-templates/post-full-width-no-meta-no-thumbnail.php')
				||
				is_page_template('page-templates/post-full-width-no-meta.php')
				||
				is_page_template('page-templates/post-full-width.php')
			) {
				$iqconnetik_return['body']  = 'no-sidebar';
				$iqconnetik_return['aside'] = false;

				return $iqconnetik_return;
			}
		} //is_single

		//pages
		if (is_page()) :

			//no sidebar
			if (
				is_page_template('page-templates/full-width.php')
				||
				is_page_template('page-templates/empty-page.php')
				||
				is_page_template('page-templates/empty-page-container.php')
				||
				is_page_template('page-templates/no-sidebar-720.php')
				||
				is_page_template('page-templates/no-sidebar-960.php')
				||
				is_page_template('page-templates/no-sidebar-1170.php')
				||
				is_page_template('page-templates/no-sidebar-no-title.php')
				||
				is_page_template('page-templates/no-sidebar-no-padding.php')
				||
				!is_page_template()
			) {
				$iqconnetik_return['body']  = 'no-sidebar';
				$iqconnetik_return['aside'] = false;

				return $iqconnetik_return;
			}

			//left sidebar for page
			if (
				is_page_template('page-templates/sidebar-left.php')
				||
				('left' === $iqconnetik_sidebar_position_option)
			) {
				$iqconnetik_return['body'] .= ' sidebar-left';

				return $iqconnetik_return;
			}

		//right sidebar is default
		endif; // is_page

		//if no sidebar option - removing aside
		if ('no' === $iqconnetik_sidebar_position_option && !(is_page_template('page-templates/home.php'))) {
			$iqconnetik_return['body']  = 'no-sidebar';
			$iqconnetik_return['aside'] = false;

			return $iqconnetik_return;
		}

		//left sidebar
		if ('left' === $iqconnetik_sidebar_position_option) {
			$iqconnetik_return['body'] .= ' sidebar-left';
		}

		return $iqconnetik_return;
	}
endif;

//get category layout based on category meta with global blog option as fallback
if (!function_exists('iqconnetik_get_category_layout')) :
	function iqconnetik_get_category_layout()
	{
		$iqconnetik_layout = '';

		$iqconnetik_queried_object = get_queried_object();
		$iqconnetik_term_id        = $iqconnetik_queried_object->term_id;

		//if layout is overriden for category in admin panel
		$iqconnetik_term_metas_layout = get_term_meta($iqconnetik_term_id, 'layout', true);
		if (!empty($iqconnetik_term_metas_layout)) {
			$iqconnetik_layout = $iqconnetik_term_metas_layout;
		}

		//if category layout not specified - getting default layout
		if (empty($iqconnetik_layout)) {
			$iqconnetik_layout = iqconnetik_option('blog_layout', '') ? iqconnetik_option('blog_layout', '') : 'default';
		}

		return $iqconnetik_layout;
	}
endif;

//get category layout gap based on category meta with global blog option as fallback
if (!function_exists('iqconnetik_get_category_layout_gap')) :
	function iqconnetik_get_category_layout_gap()
	{
		$iqconnetik_layout_gap = '';

		$iqconnetik_queried_object = get_queried_object();
		$iqconnetik_term_id        = $iqconnetik_queried_object->term_id;

		//if layout is overriden for category in admin panel
		$iqconnetik_term_metas_layout = get_term_meta($iqconnetik_term_id, 'gap', true);
		if (!empty($iqconnetik_term_metas_layout)) {
			$iqconnetik_layout_gap = $iqconnetik_term_metas_layout;
		}

		//if category layout not specified - getting default layout
		if (empty($iqconnetik_layout_gap)) {
			$iqconnetik_layout_gap = iqconnetik_option('blog_layout_gap', '') ? iqconnetik_option('blog_layout_gap', '') : '';
		}

		return $iqconnetik_layout_gap;
	}
endif;

//get feed shot_title
if (!function_exists('iqconnetik_get_feed_shot_title')) :
	function iqconnetik_get_feed_shot_title()
	{
		if (is_category()) {
			$iqconnetik_show_title = !iqconnetik_option('title_show_title', '');
		} else {
			$iqconnetik_show_title = !iqconnetik_option('title_show_title', '') && !is_front_page();
		}

		return $iqconnetik_show_title;
	}
endif;

//get feed layout
if (!function_exists('iqconnetik_get_feed_layout')) :
	function iqconnetik_get_feed_layout()
	{
		if (is_category()) {
			$iqconnetik_layout = iqconnetik_get_category_layout();
		} else {
			$iqconnetik_layout = iqconnetik_option('blog_layout', '') ? iqconnetik_option('blog_layout', '') : 'default';
		}

		//override option for demo purposes
		if (isset($_GET['blog_layout'])) {
			$iqconnetik_layout_id = absint($_GET['blog_layout']);
			$iqconnetik_layouts   = array_keys(iqconnetik_get_feed_layout_options());
			$iqconnetik_layout    = !empty($iqconnetik_layouts[$iqconnetik_layout_id]) ? $iqconnetik_layouts[$iqconnetik_layout_id] : $iqconnetik_layout;
		}

		return $iqconnetik_layout;
	}
endif;

//get feed gap
if (!function_exists('iqconnetik_get_feed_gap')) :
	function iqconnetik_get_feed_gap()
	{
		if (is_category()) {
			$iqconnetik_layout_gap = iqconnetik_get_category_layout_gap();
		} else {
			$iqconnetik_layout_gap = iqconnetik_option('blog_layout_gap', '') ? iqconnetik_option('blog_layout_gap', '') : '';
		}

		//override option for demo purposes
		if (isset($_GET['blog_layout_gap'])) {
			$iqconnetik_layout_gap_id = absint($_GET['blog_layout_gap']);
			$iqconnetik_layout_gaps   = array_keys(iqconnetik_get_feed_layout_gap_options());
			$iqconnetik_layout_gap    = !empty($iqconnetik_layout_gaps[$iqconnetik_layout_gap_id]) ? $iqconnetik_layout_gaps[$iqconnetik_layout_gap_id] : $iqconnetik_layout_gap;
		}

		return $iqconnetik_layout_gap;
	}
endif;

//get category sidebar_position based on category meta with global blog option as fallback
if (!function_exists('iqconnetik_get_category_sidebar_position')) :
	function iqconnetik_get_category_sidebar_position()
	{
		$iqconnetik_sidebar_position = '';

		$iqconnetik_queried_object = get_queried_object();
		$iqconnetik_term_id        = $iqconnetik_queried_object->term_id;

		//term metas from category options has higher priority than customizer option for special categories
		$iqconnetik_term_metas = get_term_meta($iqconnetik_term_id, 'sidebar_position', true);
		if (!empty($iqconnetik_term_metas)) {
			$iqconnetik_sidebar_position = $iqconnetik_term_metas;
		}

		//if category sidebar_position not specified - getting default sidebar_position
		if (empty($iqconnetik_sidebar_position)) {
			$iqconnetik_sidebar_position = iqconnetik_option('blog_sidebar_position', '') ? iqconnetik_option('blog_sidebar_position', '') : 'right';
		}

		return $iqconnetik_sidebar_position;
	}
endif;

//get single post layout based on blog post option
if (!function_exists('iqconnetik_get_post_layout')) :
	function iqconnetik_get_post_layout()
	{

		$iqconnetik_layout = iqconnetik_option('blog_single_layout', '') ? iqconnetik_option('blog_single_layout', '') : 'default';

		//override option for demo purposes
		if (isset($_GET['blog_single_layout'])) {
			$iqconnetik_layout_id = absint($_GET['blog_single_layout']);
			$iqconnetik_layouts   = array_keys(iqconnetik_get_post_layout_options());
			$iqconnetik_layout    = !empty($iqconnetik_layouts[$iqconnetik_layout_id]) ? $iqconnetik_layouts[$iqconnetik_layout_id] : $iqconnetik_layout;
		}

		return $iqconnetik_layout;
	}
endif;

if (!function_exists('iqconnetik_body_classes')) :
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $iqconnetik_classes Classes for the body element.
	 *
	 * @return array
	 */
	function iqconnetik_body_classes($iqconnetik_classes)
	{
		//header-empty
		if (is_page_template('page-templates/empty-page.php')) {
			$iqconnetik_classes[] = 'header-empty';
		}

		//header sticky
		if (has_nav_menu('side') || is_active_sidebar('sidebar-side')) {
			$iqconnetik_classes[] = 'has-side-nav';
			$iqconnetik_classes[] = iqconnetik_option('side_nav_position', '') ? 'side-nav-right' : 'side-nav-left';
			$iqconnetik_classes[] = iqconnetik_option('side_nav_sticked', '') ? 'side-nav-sticked' : '';
			$iqconnetik_classes[] = iqconnetik_option('side_nav_header_overlap', '') ? 'side-nav-header-overlap' : '';
		}

		// Adds a class of hfeed to non-singular pages.
		if (!is_singular()) {
			$iqconnetik_classes[] = 'hfeed';
		} else {
			//add 'singular' class for single post or page or any other post type
			$iqconnetik_classes[] = 'singular';
		}

		//Adds a sidebar classes
		$iqconnetik_css_classes = iqconnetik_get_layout_css_classes();

		$iqconnetik_classes[] = $iqconnetik_css_classes['body'];

		//Add icons in meta classes
		//single post
		if (is_singular()) {
			$iqconnetik_hide_meta_icons = iqconnetik_option('blog_single_hide_meta_icons', false);

			//blog loop
		} else {

			$iqconnetik_hide_meta_icons = iqconnetik_option('blog_hide_meta_icons', false);
		}
		if ($iqconnetik_hide_meta_icons) {
			$iqconnetik_classes[] = 'meta-icons-hidden';
		}

		$blog_single_hide_meta_categories_icons = iqconnetik_option('blog_single_hide_meta_categories_icons', false);
		if (is_singular() && !empty($blog_single_hide_meta_categories_icons)) {
			$iqconnetik_classes[] = 'meta-icons-categories-hidden';
		}

		//container width
		$iqconnetik_container_width      = iqconnetik_option('main_container_width', '1170');
		$iqconnetik_container_post_width = iqconnetik_option('blog_single_container_width', '');
		$iqconnetik_container_blog_width = iqconnetik_option('blog_container_width', '');
		if (is_singular('post') && !empty($iqconnetik_container_post_width)) {
			$iqconnetik_container_width = $iqconnetik_container_post_width;
		}
		if ((is_home() || is_category() || is_tag() || is_date() || is_author()) && !empty($iqconnetik_container_blog_width)) {
			$iqconnetik_container_width = $iqconnetik_container_blog_width;
		}
		if ('1520' === $iqconnetik_container_width) {
			$iqconnetik_classes[] = 'container-1520';
		}
		if ('1170' === $iqconnetik_container_width) {
			$iqconnetik_classes[] = 'container-1170';
		}
		if ('960' === $iqconnetik_container_width) {
			$iqconnetik_classes[] = 'container-960';
		}
		if ('720' === $iqconnetik_container_width) {
			$iqconnetik_classes[] = 'container-720';
		}

		//meta icons color class
		$iqconnetik_meta_icons_color = iqconnetik_option('color_meta_icons', '');
		if ($iqconnetik_meta_icons_color) {
			$iqconnetik_classes[] = esc_attr($iqconnetik_meta_icons_color);
		}

		//shop class
		if (class_exists('WooCommerce')) {
			$iqconnetik_classes[] = 'woo';
		}

		//header class
		if ('always-sticky' === iqconnetik_option('header_sticky', '')) {
			$iqconnetik_classes[] = 'header-sticky';
		}

		//animation enabled
		$iqconnetik_animation = iqconnetik_option('animation_enabled', '');
		if (!empty($iqconnetik_animation) && !is_customize_preview()) {
			$iqconnetik_classes[] = 'animation-enabled';
		}

		//title section enabled
		$iqconnetik_title = iqconnetik_is_title_section_is_shown();
		if (empty($iqconnetik_title)) {
			$iqconnetik_classes[] = 'title-hidden';
		}

		return $iqconnetik_classes;
	}
endif;
add_filter('body_class', 'iqconnetik_body_classes');

//markup for animated page elements
if (!function_exists('iqconnetik_animated_elements_markup')) :
	function iqconnetik_animated_elements_markup()
	{
		$iqconnetik_animation = iqconnetik_option('animation_enabled', '');
		if (empty($iqconnetik_animation)) {
			return;
		}

		//get animations array from customizer. Keys - selectors
		$iqconnetik_animations = array(
			'.column-aside .widget'            => iqconnetik_option('animation_sidebar_widgets', ''),
			'.footer-top-widgets .widget'      => iqconnetik_option('animation_footer_top_widgets', ''),
			'.footer-widgets .widget'          => iqconnetik_option('animation_footer_widgets', ''),
			'.hfeed article.post'              => iqconnetik_option('animation_feed_posts', ''),
			'.hfeed .post .post-thumbnail img' => iqconnetik_option('animation_feed_posts_thumbnail', ''),
		);

		$iqconnetik_animations = array_filter($iqconnetik_animations);
		if (!empty($iqconnetik_animations) && !is_customize_preview()) :
?>
			data-animate='<?php echo esc_attr(str_replace('&quot;', '"', json_encode($iqconnetik_animations))); ?>'
		<?php
		endif;
	}
endif;

//markup for sticky post label
if (!function_exists('iqconnetik_sticky_post_label')) :
	function iqconnetik_sticky_post_label()
	{
		if (is_sticky() && is_home() && !is_paged()) :
		?>
			<span class="icon-inline sticky-post">
				<?php iqconnetik_icon('thumb-tack'); ?>
				<span><?php echo esc_html_x('Sticky', 'post', 'iqconnetik'); ?></span>
			</span><!-- .sticky-post -->
			<?php
		endif; //is_sticky()
	}
endif;

//arguments for link pages
if (!function_exists('iqconnetik_get_wp_link_pages_atts')) :
	function iqconnetik_get_wp_link_pages_atts()
	{
		return apply_filters(
			'iqconnetik_link_pages_atts',
			array(
				'before'      => '<div class="page-links"><span class="screen-reader-text">' . esc_html__('Pages: ', 'iqconnetik') . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			)
		);
	}
endif;

//arguments for link pages
if (!function_exists('iqconnetik_get_the_posts_pagination_atts')) :
	function iqconnetik_get_the_posts_pagination_atts()
	{
		return array(
			'mid_size'  => 5,
			'prev_text' => '<span class="screen-reader-text">' . esc_html__('Previous page', 'iqconnetik') . '</span><span class="icon-inline"><i class="fa fa-chevron-left"></i></span>',
			'next_text' => '<span class="screen-reader-text">' . esc_html__('Next page', 'iqconnetik') . '</span><span class="icon-inline"><i class="fa fa-chevron-right"></i></span>',
		);
	}
endif;

//get top level menu items count
if (!function_exists('iqconnetik_get_menu_top_level_items_count')) :
	function iqconnetik_get_menu_top_level_items_count($iqconnetik_menu_name)
	{

		$iqconnetik_locations   = get_nav_menu_locations();
		$iqconnetik_menu_id     = $iqconnetik_locations[$iqconnetik_menu_name];
		$iqconnetik_menu_object = wp_get_nav_menu_object($iqconnetik_menu_id);
		if (empty($iqconnetik_menu_object)) {
			return '-1';
		}

		$iqconnetik_menu_items       = wp_get_nav_menu_items($iqconnetik_menu_object->term_id);
		$iqconnetik_menu_items_count = 0;

		foreach ((array) $iqconnetik_menu_items as $iqconnetik_key => $iqconnetik_menu_item) {
			if ('0' === $iqconnetik_menu_item->menu_item_parent) {
				$iqconnetik_menu_items_count++;
			}
		}

		return $iqconnetik_menu_items_count;
	}
endif;

//get menu class depending on menu top level items count
if (!function_exists('iqconnetik_get_menu_class_based_on_top_items_count')) :
	function iqconnetik_get_menu_class_based_on_top_items_count($iqconnetik_menu_name)
	{

		$iqconnetik_menu_items_count = iqconnetik_get_menu_top_level_items_count($iqconnetik_menu_name);
		if ('-1' === $iqconnetik_menu_items_count) {
			return 'menu-empty';
		}

		$iqconnetik_css_class = 'menu-low-items';

		if ($iqconnetik_menu_items_count > 4) {
			$iqconnetik_css_class = 'menu-many-items';
		}

		return $iqconnetik_css_class;
	}
endif;


//print svg icon
if (!function_exists('iqconnetik_icon')) :
	function iqconnetik_icon($iqconnetik_name, $iqconnetik_return = false, $iqconnetik_container_css_class = 'svg-icon')
	{
		//in the future we'll add option for this
		$iqconnetik_icons_pack = 'google';

		if ($iqconnetik_return) {
			ob_start();
		}

		echo '<span class="' . esc_attr($iqconnetik_container_css_class) . ' icon-' . esc_attr($iqconnetik_name) . '">';
		get_template_part('/template-parts/svg/' . $iqconnetik_icons_pack . '/' . $iqconnetik_name);
		echo '</span>';

		if ($iqconnetik_return) {
			return ob_get_clean();
		}
	}
endif;

//print social link
if (!function_exists('iqconnetik_social_link')) :
	function iqconnetik_social_link($iqconnetik_name, $iqconnetik_url)
	{
		echo '<a href="' . esc_url($iqconnetik_url) . '" target="_blank" class="social-icon social-icon-' . esc_attr($iqconnetik_name) . ' bordered rounded">';
		iqconnetik_icon($iqconnetik_name);
		echo '</a>';
	}
endif;

//meta
//get meta array
if (!function_exists('iqconnetik_get_theme_meta')) :
	function iqconnetik_get_theme_meta($iqconnetik_meta_names = array())
	{
		/*
		customizer options with meta are:
			'meta_email'
			'meta_email_label'
			'meta_email_2'
			'meta_email_2_label'
			'meta_phone'
			'meta_phone_label'
			'meta_phone_2'
			'meta_phone_label_2'
			'meta_address'
			'meta_address_label'
			'meta_opening_hours'
			'meta_opening_hours_label'
		*/

		//if no names specified - using all meta
		if (empty($iqconnetik_meta_names)) :
			$iqconnetik_meta_names = array(
				'email',
				'email_2',
				'phone',
				'phone_2',
				'address',
				'opening_hours',
			);
		endif;

		$iqconnetik_theme_meta = array();

		//meta values
		foreach ($iqconnetik_meta_names as $iqconnetik_meta_name) {
			$iqconnetik_value = iqconnetik_option('meta_' . $iqconnetik_meta_name);
			if (!empty($iqconnetik_value)) {
				$iqconnetik_theme_meta[$iqconnetik_meta_name] = $iqconnetik_value;
			}
		}

		//labels for meta if it is not empty
		if (!empty($iqconnetik_theme_meta)) {
			foreach ($iqconnetik_theme_meta as $iqconnetik_meta_name => $iqconnetik_meta_value) {
				$iqconnetik_label = iqconnetik_option('meta_' . $iqconnetik_meta_name . '_label');
				if (!empty($iqconnetik_label)) {
					$iqconnetik_theme_meta[$iqconnetik_meta_name . '_label'] = $iqconnetik_label;
				}
			}
		}

		return $iqconnetik_theme_meta;
	}
endif;

//print all social links based on theme_meta from Customizzer
if (!function_exists('iqconnetik_social_links')) :
	function iqconnetik_social_links($wrapper_class = '', $links_class = '')
	{

		$iqconnetik_facebook  = iqconnetik_option('meta_facebook');
		$iqconnetik_twitter   = iqconnetik_option('meta_twitter');
		$iqconnetik_instagram = iqconnetik_option('meta_instagram');
		$iqconnetik_linkedin  = iqconnetik_option('meta_linkedin');
		$iqconnetik_youtube   = iqconnetik_option('meta_youtube');
		$iqconnetik_pinterest = iqconnetik_option('meta_pinterest');

		if (
			!empty($iqconnetik_facebook)
			||
			!empty($iqconnetik_twitter)
			||
			!empty($iqconnetik_instagram)
			||
			!empty($iqconnetik_linkedin)
			||
			!empty($iqconnetik_youtube)
			||
			!empty($iqconnetik_pinterest)
		) :

			if ($wrapper_class) {
				echo '<div class="' . esc_attr($wrapper_class) . '">';
			}
			echo '<span class="social-links' . ' ' . $links_class . '">';

			if (!empty($iqconnetik_facebook)) :
				iqconnetik_social_link('facebook', $iqconnetik_facebook);
			endif;

			if (!empty($iqconnetik_twitter)) :
				iqconnetik_social_link('twitter', $iqconnetik_twitter);
			endif;

			if (!empty($iqconnetik_instagram)) :
				iqconnetik_social_link('instagram', $iqconnetik_instagram);
			endif;

			if (!empty($iqconnetik_linkedin)) :
				iqconnetik_social_link('linkedin', $iqconnetik_linkedin);
			endif;

			if (!empty($iqconnetik_youtube)) :
				iqconnetik_social_link('youtube', $iqconnetik_youtube);
			endif;

			if (!empty($iqconnetik_pinterest)) :
				iqconnetik_social_link('pinterest', $iqconnetik_pinterest);
			endif;

			echo '</span><!--.social-links-->';
			if ($wrapper_class) {
				echo '</div><!--' . esc_html($wrapper_class) . '-->';
			}

		endif;
	}
endif;

//print copyright social link
if (!function_exists('iqconnetik_social_link_2')) :
	function iqconnetik_social_link_2($iqconnetik_name, $iqconnetik_url)
	{
		echo '<a href="' . esc_url($iqconnetik_url) . '" target="_blank" class="social-icon social-icon-' . esc_attr($iqconnetik_name) . '">';
		iqconnetik_icon($iqconnetik_name);
		echo '</a>';
	}
endif;

//print all social links based on theme_meta from Customizzer 
if (!function_exists('iqconnetik_social_links_copyright')) :
	function iqconnetik_social_links_copyright($wrapper_class = '')
	{

		$iqconnetik_twitter   = iqconnetik_option('meta_twitter');
		$iqconnetik_facebook  = iqconnetik_option('meta_facebook');
		$iqconnetik_linkedin  = iqconnetik_option('meta_linkedin');
		$iqconnetik_youtube   = iqconnetik_option('meta_youtube');
		$iqconnetik_instagram = iqconnetik_option('meta_instagram');
		$iqconnetik_pinterest = iqconnetik_option('meta_pinterest');
		$iqconnetik_github    = iqconnetik_option('meta_github');

		if (
			!empty($iqconnetik_facebook)
			||
			!empty($iqconnetik_twitter)
			||
			!empty($iqconnetik_youtube)
			||
			!empty($iqconnetik_instagram)
			||
			!empty($iqconnetik_pinterest)
			||
			!empty($iqconnetik_linkedin)
			||
			!empty($iqconnetik_github)
		) :

			if ($wrapper_class) {
				echo '<div class="' . esc_attr($wrapper_class) . '">';
			}
			echo '<span class="social-links copyright-social-links divided-content">';

			if (!empty($iqconnetik_facebook)) :
				iqconnetik_social_link_2('facebook', $iqconnetik_facebook);
			endif;

			if (!empty($iqconnetik_twitter)) :
				iqconnetik_social_link_2('twitter', $iqconnetik_twitter);
			endif;

			if (!empty($iqconnetik_youtube)) :
				iqconnetik_social_link_2('youtube', $iqconnetik_youtube);
			endif;

			if (!empty($iqconnetik_instagram)) :
				iqconnetik_social_link_2('instagram', $iqconnetik_instagram);
			endif;

			if (!empty($iqconnetik_pinterest)) :
				iqconnetik_social_link_2('pinterest', $iqconnetik_pinterest);
			endif;

			if (!empty($iqconnetik_linkedin)) :
				iqconnetik_social_link_2('linkedin', $iqconnetik_linkedin);
			endif;

			if (!empty($iqconnetik_github)) :
				iqconnetik_social_link_2('github-circle', $iqconnetik_github);
			endif;

			echo '</span><!--.social-links-->';
			if ($wrapper_class) {
				echo '</div><!--' . esc_html($wrapper_class) . '-->';
			}

		endif;
	}
endif;

//print meta link
if (!function_exists('iqconnetik_link_theme_meta_widget')) :
	function iqconnetik_link_theme_meta_widget($iqconnetik_name, $iqconnetik_url)
	{
		echo '<a href="' . esc_url($iqconnetik_url) . '" target="_blank" class="meta-icon meta-icon-' . esc_attr($iqconnetik_name) . ' bordered rounded">';
		iqconnetik_icon($iqconnetik_name);
		echo '</a>';
	}
endif;

//print meta link
if (!function_exists('iqconnetik_link_theme_meta_widget_alt')) :
	function iqconnetik_link_theme_meta_widget_alt($iqconnetik_name, $iqconnetik_url)
	{
		echo '<a href="' . esc_url($iqconnetik_url) . '" target="_blank" class="meta-icon meta-icon-' . esc_attr($iqconnetik_name) . '">';
		iqconnetik_icon($iqconnetik_name);
		echo '</a>';
	}
endif;

//print social link
if (!function_exists('iqconnetik_social_link_theme_meta_widget')) :
	function iqconnetik_social_link_theme_meta_widget($iqconnetik_name, $iqconnetik_url)
	{
		echo '<a href="' . esc_url($iqconnetik_url) . '" target="_blank" class="social-icon border-icon social-icon-' . esc_attr($iqconnetik_name) . '">';
		iqconnetik_icon($iqconnetik_name);
		echo '</a>';
	}
endif;

//print all social links based on theme_meta from Customizzer
if (!function_exists('iqconnetik_social_links_theme_meta_widget')) :
	function iqconnetik_social_links_theme_meta_widget($wrapper_class = '')
	{

		$iqconnetik_twitter   = iqconnetik_option('meta_twitter');
		$iqconnetik_facebook  = iqconnetik_option('meta_facebook');
		$iqconnetik_linkedin  = iqconnetik_option('meta_linkedin');
		$iqconnetik_youtube   = iqconnetik_option('meta_youtube');
		$iqconnetik_instagram = iqconnetik_option('meta_instagram');
		$iqconnetik_pinterest = iqconnetik_option('meta_pinterest');
		$iqconnetik_github    = iqconnetik_option('meta_github');

		if (
			!empty($iqconnetik_facebook)
			||
			!empty($iqconnetik_twitter)
			||
			!empty($iqconnetik_youtube)
			||
			!empty($iqconnetik_instagram)
			||
			!empty($iqconnetik_pinterest)
			||
			!empty($iqconnetik_linkedin)
			||
			!empty($iqconnetik_github)
		) :

			if ($wrapper_class) {
				echo '<div class="' . esc_attr($wrapper_class) . '">';
			}
			echo '<span class="social-links">';

			if (!empty($iqconnetik_twitter)) :
				iqconnetik_social_link_theme_meta_widget('twitter', $iqconnetik_twitter);
			endif;

			if (!empty($iqconnetik_facebook)) :
				iqconnetik_social_link_theme_meta_widget('facebook', $iqconnetik_facebook);
			endif;

			if (!empty($iqconnetik_instagram)) :
				iqconnetik_social_link_theme_meta_widget('instagram', $iqconnetik_instagram);
			endif;

			if (!empty($iqconnetik_youtube)) :
				iqconnetik_social_link_theme_meta_widget('youtube', $iqconnetik_youtube);
			endif;

			if (!empty($iqconnetik_pinterest)) :
				iqconnetik_social_link_theme_meta_widget('pinterest', $iqconnetik_pinterest);
			endif;

			if (!empty($iqconnetik_linkedin)) :
				iqconnetik_social_link_theme_meta_widget('linkedin', $iqconnetik_linkedin);
			endif;

			if (!empty($iqconnetik_github)) :
				iqconnetik_social_link_theme_meta_widget('github-circle', $iqconnetik_github);
			endif;

			echo '</span><!--.social-links-->';
			if ($wrapper_class) {
				echo '</div><!--' . esc_html($wrapper_class) . '-->';
			}

		endif;
	}
endif;

if (!function_exists('iqconnetik_has_post_thumbnail')) :
	/**
	 * Check if has post thumbnail and thumbnail file exists
	 */
	function iqconnetik_has_post_thumbnail($iqconnetik_id = false)
	{
		if (empty($iqconnetik_id)) {
			$iqconnetik_id = get_the_ID();
		}

		return !(post_password_required($iqconnetik_id)
			||
			is_attachment()
			||
			!has_post_thumbnail($iqconnetik_id)
			||
			!file_exists(get_attached_file(get_post_thumbnail_id($iqconnetik_id))));
	}
endif;

if (!function_exists('iqconnetik_post_thumbnail')) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function iqconnetik_post_thumbnail($iqconnetik_size = 'iqconnetik-default-post', $iqconnetik_css_class = '', $show_categories = false)
	{

		if (
			!iqconnetik_has_post_thumbnail()
		) {
			return;
		}

		//detect video
		$oembed_url = false;
		$oembed_post_thumbnail = false;
		//only video post format
		if ('video' === get_post_format()) {
			$oembed_post_thumbnail = true;
		}

		if ($oembed_post_thumbnail) {
			$post_content = get_the_content();
			//get oEmbed URL
			$reg = preg_match('|^\s*(https?://[^\s"]+)\s*$|im', $post_content, $matches);

			$oembed_url = !empty($reg) ? trim($matches[0]) : false;
			//if no youtube, trying to find self hosted

			$first_self_hosted = '';
			$embeds = array();
			if (empty($oembed_url)) {
				$post_content = apply_filters('the_content', $post_content);
				$embeds = get_media_embedded_in_content($post_content);
			}
		}

		if (is_singular()) :
			if (($oembed_url || !empty($embeds[0]))) :
				//if youtube
				if ($oembed_url) :
					add_filter('the_content', function ($content) use ($oembed_url) {
						//remove embed
						$content = str_replace($oembed_url, '', $content);
						//hide embed wrapper
						$pos = strpos($content, 'class="wp-block-embed');
						if ($pos !== false) {
							$content = substr_replace($content, 'class="d-none wp-block-embed', $pos, strlen('class="wp-block-embed'));
						}
						return $content;
						//1 - to run early
					}, 1);
			?>
					<figure class="wp-block-embed wp-embed-aspect-16-9 post-thumbnail mb-0">
						<div class="wp-block-embed__wrapper" itemprop="video" itemscope="itemscope" itemtype="https://schema.org/VideoObject">
							<?php

							echo wp_oembed_get($oembed_url);

							$thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');

							if ($thumbnail_url) :
							?>
								<meta itemprop="thumbnailUrl" content="<?php echo esc_url($thumbnail_url); ?>">
							<?php
							endif; //thumbnail_url
							?>
							<meta itemprop="uploadDate" content="<?php echo esc_attr(the_time(get_option('date_format'))); ?>">
							<meta itemprop="contentUrl" content="<?php echo esc_url($oembed_url); ?>">
							<?php
							the_title('<h3 class="d-none" itemprop="name">', '</h3>');
							?>
							<p class="d-none" itemprop="description">
								<?php echo wp_kses(get_the_excerpt(), false); ?>
							</p>
						</div>
					</figure><!-- .post-thumbnail -->
				<?php
				//self hosted
				else :
					$embed = (!empty($embeds[0])) ? $embeds[0] : false;
					$url = preg_match('`src="(.*)"`', $embed, $founds);
					$hosted_video_url = !empty($founds['1']) ? $founds['1'] : '';
					add_filter('the_content', function ($content) use ($embed) {
						//remove embed
						$content = str_replace($embed, '', $content);
						//hide embed wrapper
						$pos = strpos($content, 'class="wp-block-video');
						if ($pos !== false) {
							$content = substr_replace($content, 'class="d-none wp-block-video', $pos, strlen('class="wp-block-embed'));
						}
						return $content;
						//1 - to run early
					}, 1);
				?>
					<figure class="post-thumbnail mb-0">
						<div class="wp-block-video" itemprop="video" itemscope="itemscope" itemtype="https://schema.org/VideoObject">
							<?php
							echo wp_kses_post($embed);
							$thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
							if ($thumbnail_url) :
							?>
								<meta itemprop="thumbnailUrl" content="<?php echo esc_url($thumbnail_url); ?>">
							<?php
							endif; //thumbnail_url
							?>
							<meta itemprop="uploadDate" content="<?php echo esc_attr(the_time(get_option('date_format'))); ?>">
							<meta itemprop="contentUrl" content="<?php echo esc_url($hosted_video_url); ?>">
							<?php
							the_title('<h3 class="d-none" itemprop="name">', '</h3>');
							?>
							<p class="d-none" itemprop="description">
								<?php echo wp_kses(get_the_excerpt(), false); ?>
							</p>
						</div>
					</figure><!-- .post-thumbnail -->
				<?php
				endif; //$oembed_url
			//not video
			else :
				?>
				<figure class="<?php echo esc_attr('post-thumbnail ' . $iqconnetik_css_class); ?>">
					<?php
					if ($show_categories) {
						iqconnetik_entry_meta(false, false, true, false, false);
					}
					the_post_thumbnail(
						$iqconnetik_size,
						array(
							'itemprop' => 'image',
							'alt'      => get_the_title(),
						)
					);
					?>
				</figure><!-- .post-thumbnail -->
			<?php
			//oembed
			endif;
		//not is_singular
		//archive
		else :

			//detecting gallery
			$is_gallery = false;
			$gallery_css_class = '';
			$image_size = (iqconnetik_option('blog_layout') === 'cols 2 masonry') ? 'iqconnetik-small-width' : 'iqconnetik-default-post';
			if ('gallery' === get_post_format()) {
				$galleries_images = get_post_galleries_images();
				//gutenberg block parse
				if (!empty($galleries_images)) {
					global $post;
					if (has_block('gallery', $post->post_content)) {
						$post_blocks = parse_blocks($post->post_content);
						foreach ($post_blocks as $post_block) {
							if ('core/gallery' === $post_block['blockName']) {
								$src_array = array();
								$gallery_imgs_ids = [];
								foreach ($post_block['innerBlocks'] as $subel) {
									$gallery_imgs_ids[] = $subel['attrs']['id'];
								}
								foreach ($gallery_imgs_ids as $id) {
									$src_array[] = wp_get_attachment_image_url($id, $image_size);
								}
								$galleries_images = $src_array;
								break;
							}
						}
					}
				}

				$galleries_images_count = count($galleries_images);
				if ($galleries_images_count) {
					$is_gallery = true;
					$gallery_css_class = 'item-media-gallery';
				}
			} //gallery post format

			?>
			<div class="post-thumbnail-wrap">
				<?php
				if ($show_categories) {
					iqconnetik_entry_meta(false, false, true, false, false, false, false);
				}
				?>
				<figure class="<?php echo esc_attr('post-thumbnail ' . $iqconnetik_css_class); ?>">
					<a href="<?php

								if (empty($oembed_url)) {
									the_permalink();
								} else {
									echo esc_url($oembed_url);
								}

								?>">
						<?php

						if (empty($is_gallery)) {


							the_post_thumbnail(
								$iqconnetik_size,
								array(
									'itemprop' => 'image',
									'alt'      => get_the_title(),
								)
							);
						} else {
							//gallery

							echo '<div class="flexslider"><ul class="slides">';

							//adding featured image as a first element in carousel

							//featured image url
							$post_featured_image_src = wp_get_attachment_image_url(get_post_thumbnail_id(), $image_size);

							if ($post_featured_image_src) : ?>
								<li><img src="<?php echo esc_url($post_featured_image_src); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
								</li>
							<?php endif;
							$count = 1;

							foreach ($galleries_images as $gallerie) :
								//foreach ($gallerie as $src) :
								//showing only 3 images from gallery
								if ($count > 9) {
									break;
								}
							?>
								<li><img src="<?php echo esc_url($gallerie); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
								</li>
						<?php
								$count++;
							//endforeach;
							endforeach;
							echo '</ul></div><!--.flexslider-->';
						}
						iqconnetik_post_format_icon(get_post_format());
						?>
					</a>
				</figure>
			</div>
			<!-- post-thumbnail-wrap -->
		<?php
		endif; // End is_singular().
	}
endif; //iqconnetik_post_thumbnail

//print post format icon
if (!function_exists('iqconnetik_post_format_icon')) :
	function iqconnetik_post_format_icon($iqconnetik_post_format = '')
	{
		// 'video', 'audio', 'image', 'gallery', 'quote'
		switch ($iqconnetik_post_format):
			case 'video':
				iqconnetik_icon('video');
				break;
			case 'audio':
				iqconnetik_icon('volume-high');
				break;
			case 'image':
				//iqconnetik_icon('image');
				break;
			case 'gallery':
				iqconnetik_icon('camera');
				break;
			case 'quote':
				iqconnetik_icon('format-quote-close');
				break;

			default:
		endswitch;
	}
endif;


if (!function_exists('iqconnetik_the_author')) :
	/*
		** Prints author HTML with with link on author archive.
		 */
	function iqconnetik_the_author()
	{

		//options
		//single post
		if (is_singular()) {

			$iqconnetik_show_author   = iqconnetik_option('blog_single_show_author', true);
			$iqconnetik_author_avatar = iqconnetik_option('blog_single_show_author_avatar', '');
			$iqconnetik_author_word   = iqconnetik_option('blog_single_before_author_word', '');
			$iqconnetik_show_icons    = false;

			//blog loop
		} else {

			$iqconnetik_show_author   = iqconnetik_option('blog_show_author', true);
			$iqconnetik_author_avatar = iqconnetik_option('blog_show_author_avatar', '');
			$iqconnetik_author_word   = iqconnetik_option('blog_before_author_word', '');
			$iqconnetik_show_icons    = false;
		}

		if (!empty($iqconnetik_show_author)) :
			//author-wrapper
		?>
			<span class="entry-author-wrap icon-inline darklinks">
				<?php
				if (!empty($iqconnetik_author_avatar)) :
					echo '<span class="author-avatar">';
					$iqconnetik_author_id        = get_the_author_meta('ID');
					$iqconnetik_custom_image_url = get_the_author_meta('custom_profile_image', $iqconnetik_author_id);
					if (!empty($iqconnetik_custom_image_url)) {
						echo '<img src="' . esc_url($iqconnetik_custom_image_url) . '" alt="' . esc_attr(get_the_author_meta('display_name', $iqconnetik_author_id)) . '">';
					} else {
						echo get_avatar($iqconnetik_author_id, 60);
					}
					echo '</span><!-- .author-avatar-->';
				endif; //$iqconnetik_author_avatar
				?>
				<?php
				//icon
				if (!empty($iqconnetik_show_icons)) {
					iqconnetik_icon('user');
				}
				//word
				if (!empty($iqconnetik_author_word)) :
				?>
					<span class="entry-author-word meta-word">
						<?php echo esc_html($iqconnetik_author_word); ?>
					</span>
					<!--.entry-author-word-->
				<?php
				endif;
				//value
				?>
				<h6 class="vcard author mt-0 mb-0" itemtype="https://schema.org/Person" itemscope="itemscope" itemprop="author">
					<?php
					the_author_posts_link();
					?>
				</h6><!-- .author -->
			</span>
			<!--.entry-author-wrap-->
			<!-- publisher -->
			<div class="hidden" itemprop="publisher" itemtype="http://schema.org/Organization" itemscope="itemscope">
				<span itemprop="name"><?php the_author(); ?></span>
				<?php
				$iqconnetik_custom_logo = iqconnetik_option('custom_logo');
				if (!empty($iqconnetik_custom_logo)) :
				?>
					<span itemprop="logo" itemscope="itemscope" itemtype="https://schema.org/ImageObject">
						<?php
						$iqconnetik_custom_logo_metadata = !empty($iqconnetik_custom_logo) ? wp_get_attachment_metadata($iqconnetik_custom_logo) : array(
							'width'  => '0',
							'height' => '0',
						);
						echo wp_get_attachment_image($iqconnetik_custom_logo, 'full');
						?>
						<meta itemprop="url" content="<?php echo esc_url(home_url('/')); ?>" />
						<meta itemprop="width" content="<?php echo esc_attr($iqconnetik_custom_logo_metadata['width']); ?>" />
						<meta itemprop="height" content="<?php echo esc_attr($iqconnetik_custom_logo_metadata['height']); ?>" />
					</span>
				<?php endif; //custom_logo 
				?>
			</div>
			<!-- publisher -->
		<?php
		endif; //author
	}
endif; //iqconnetik_the_author

add_filter('the_author_posts_link', 'iqconnetik_the_author_link_itemprop');
if (!function_exists('iqconnetik_the_author_link_itemprop')) :
	/**
	 * Add 'itemprop' attribute to the author link.
	 */
	function iqconnetik_the_author_link_itemprop($iqconnetik_link)
	{
		$iqconnetik_link = str_replace('rel="author">', 'rel="author" itemprop="url"><span itemprop="name">', $iqconnetik_link);
		$iqconnetik_link = str_replace('</a>', '</span></a>', $iqconnetik_link);

		return $iqconnetik_link;
	}
endif;

if (!function_exists('iqconnetik_the_date')) :
	/**
	 * Prints date HTML with the post link on blog.
	 */
	function iqconnetik_the_date()
	{

		//options
		//single post
		if (is_singular()) {

			$iqconnetik_show_date  = iqconnetik_option('blog_single_show_date', true);
			$iqconnetik_date_word  = iqconnetik_option('blog_single_before_date_word', '');
			$iqconnetik_show_icons = !iqconnetik_option('blog_single_hide_meta_icons', false);

			//blog loop
		} else {

			$iqconnetik_show_date  = iqconnetik_option('blog_show_date', true);
			$iqconnetik_date_word  = iqconnetik_option('blog_before_date_word', '');
			$iqconnetik_show_icons = !iqconnetik_option('blog_hide_meta_icons', false);
		}

		if (!empty($iqconnetik_show_date)) :
			//date-wrapper
		?>
			<span class="entry-date-wrap icon-inline">
				<?php

				//icon
				if (!empty($iqconnetik_show_icons)) {
					iqconnetik_icon('clock-outline');
				}

				//word
				if (!empty($iqconnetik_date_word)) :
				?>
					<span class="date-word meta-word">
						<?php echo esc_html($iqconnetik_date_word); ?>
					</span>
					<!--.date-word-->
				<?php
				endif;
				//value
				//link date to post on archive
				if (!is_singular()) :
				?>
					<a href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark" itemprop="mainEntityOfPage">
					<?php endif; //is_singular 
					?>
					<span itemprop="datePublished"><?php the_time(get_option('date_format')); ?></span>
					<span class="hidden" itemprop="dateModified"><?php the_modified_time(get_option('date_format')); ?></span>
					<?php if (!is_singular()) : ?>
					</a>
				<?php endif; //is_singular 
				?>
			</span>
			<!--.entry-date-wrap-->
			<?php
		endif; //date
	}
endif; //iqconnetik_the_date

if (!function_exists('iqconnetik_the_categories')) :
	/**
	 * Prints categories HTML for the current post.
	 */

	function iqconnetik_the_categories()
	{

		//options
		//single post
		if (is_singular()) {

			$iqconnetik_show_categories = iqconnetik_option('blog_single_show_categories', true);
			$iqconnetik_categories_word = '';
			$iqconnetik_show_icons      = false;

			//blog loop
		} else {

			$iqconnetik_show_categories = iqconnetik_option('blog_show_categories', true);
			$iqconnetik_categories_word = '';
			$iqconnetik_show_icons      = false;
		}

		if (!empty($iqconnetik_show_categories)) :
			$iqconnetik_c = wp_get_post_categories(get_the_ID());

			//only if categories exists
			if (!empty($iqconnetik_c)) :

				//categories-wrapper
			?>
				<span class="entry-categories-wrap icon-inline">
					<?php

					//icon
					if (!empty($iqconnetik_show_icons)) {
						iqconnetik_icon('paperclip');
					}

					//word
					if (!empty($iqconnetik_categories_word)) :
					?>
						<span class="categories-word meta-word">
							<?php echo esc_html($iqconnetik_categories_word); ?>
						</span>
						<!--.categories-word-->
					<?php
					endif;

					//value
					?>
					<span class="categories-list">
						<?php
						echo wp_kses_post(get_the_category_list('<span class="entry-categories-separator"> </span>'));
						?>
					</span>
					<!--.categories-list-->
				</span>
				<!--.entry-categories-wrap-->
			<?php
			endif; //$iqconnetik_c
		endif; //categories
	}
endif; //iqconnetik_the_categories

if (!function_exists('iqconnetik_the_tags')) :
	/**
	 * Prints tags HTML for the current post.
	 */
	function iqconnetik_the_tags()
	{

		//options
		//single post
		if (is_singular()) {

			$iqconnetik_show_tags  = iqconnetik_option('blog_single_show_tags', true);
			$iqconnetik_tags_word  = iqconnetik_option('blog_single_before_tags_word', '');
			$iqconnetik_show_icons = false;

			//blog loop
		} else {

			$iqconnetik_show_tags  = iqconnetik_option('blog_show_tags', true);
			$iqconnetik_tags_word  = iqconnetik_option('blog_before_tags_word', '');
			$iqconnetik_show_icons = false;
		}

		if (!empty($iqconnetik_show_tags)) :

			$iqconnetik_t = wp_get_post_tags(get_the_ID());

			//only if tags exists
			if (!empty($iqconnetik_t)) :

				//tags-wrapper
			?>
				<span class="entry-tags-wrap icon-inline">
					<?php

					//icon
					if (!empty($iqconnetik_show_icons)) {
						iqconnetik_icon('tag');
					}

					//word
					if (!empty($iqconnetik_tags_word)) :
					?>
						<span class="tags-word meta-word">
							<?php echo esc_html($iqconnetik_tags_word); ?>
						</span>
						<!--.tags-word-->
					<?php
					endif; //tags_word

					//value
					?>
					<span class="tags-list">
						<?php
						echo wp_kses_post(get_the_tag_list('<span class="entry-tags">', '<span class="entry-tags-separator"> </span>', '</span>'));
						?>
					</span>
					<!--.tags-list-->
				</span>
				<!--.entry-tags-wrap-->
				<?php
			endif; //$iqconnetik_t
		endif; //tags
	}
endif; //iqconnetik_the_tags

if (!function_exists('iqconnetik_comment_count')) :
	/**
	 * Prints HTML with the comment count for the current post.
	 */
	function iqconnetik_comment_count()
	{

		//options
		//single post
		if (is_singular()) {

			$iqconnetik_show_comments = iqconnetik_option('blog_single_show_comments_link', 'number');
			$iqconnetik_show_icons    = !iqconnetik_option('blog_single_hide_meta_icons', false);

			//blog loop
		} else {

			$iqconnetik_show_comments = iqconnetik_option('blog_show_comments_link', 'number');
			$iqconnetik_show_icons    = !iqconnetik_option('blog_hide_meta_icons', false);
		}

		if (!post_password_required() && (comments_open() || get_comments_number()) && $iqconnetik_show_comments) :
			switch ($iqconnetik_show_comments):
				case 'number':
				?>
					<span class="comments-link icon-inline">
						<?php
						if (!empty($iqconnetik_show_icons)) {
							iqconnetik_icon('comment-outline');
						}
						$comments_count = get_comments_number();
						comments_popup_link($comments_count, $comments_count, $comments_count);
						?>
					</span><!-- .comments-link -->
				<?php
					break;
					//text
				default:
				?>
					<span class="comments-link icon-inline">
						<?php

						if (!empty($iqconnetik_show_icons)) {
							iqconnetik_icon('comment-outline');
						}
						?>

						<?php

						comments_popup_link(
							sprintf(
								wp_kses(
									/* translators: %s: Name of current post. Only visible to screen readers. */
									__(' Leave a comment<span class="screen-reader-text"> on %s</span>', 'iqconnetik'),
									array(
										'span' => array(
											'class' => array(),
										),
									)
								),
								get_the_title()
							)
						);
						?>
					</span><!-- .comments-link -->
				<?php
			endswitch;
		endif; //show_comments
	}
endif;

if (!function_exists('iqconnetik_set_post_likes')) :
	/**
	 * Likes incrementor
	 *
	 * @param int $postID ID of the post.
	 *
	 * @return bool No success if cookies are disabled
	 */
	function iqconnetik_set_post_likes($postID)
	{
		if (empty($_COOKIE["$postID"])) {

			$count_key = 'iqconnetik_post_likes_count';
			$count     = get_post_meta($postID, $count_key, true);
			if ($count == '') {
				$count = 0;
				delete_post_meta($postID, $count_key);
				add_post_meta($postID, $count_key, '1');
			} else {
				$count++;
				update_post_meta($postID, $count_key, $count);
			}
			setcookie("$postID", "voted", strtotime('+1 day'), COOKIEPATH, COOKIE_DOMAIN, false); // 86400 = 1 day
			return true;
		}

		return false;
	} //iqconnetik_set_post_likes()
endif;

if (!function_exists('iqconnetik_get_post_likes')) :
	/**
	 * Get likes value
	 *
	 * @param int $postID ID of the post.
	 */
	function iqconnetik_get_post_likes($postID)
	{
		$count_key = 'iqconnetik_post_likes_count';
		$count     = get_post_meta($postID, $count_key, true);
		if ($count == '') {
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');

			return '0';
		}

		return $count;
	} //iqconnetik_get_post_likes()
endif;

if (!function_exists('iqconnetik_print_post_likes')) :
	/**
	 * Get likes value
	 *
	 * @param int $count of likes of the post.
	 */
	function iqconnetik_print_post_likes($count)
	{
		$html = '';
		if (!$count) {
			$html = '<span class="item-likes-count">0</span> <span class="item-likes-word">' . esc_html__('Likes', 'iqconnetik') . '</span>';
		}

		if ($count == 1) {
			$html = '<span class="item-likes-count">1</span> <span class="item-likes-word">' . esc_html__('Like', 'iqconnetik') . '</span>';
		}

		if ($count > 1) {
			$html = '<span class="item-likes-count">' . $count . '</span> <span class="item-likes-word">' . esc_html__('Likes', 'iqconnetik') . '</span>';
		}

		return $html;
	} //iqconnetik_print_post_likes()
endif;

if (!function_exists('iqconnetik_post_likes_scripts')) :
	// Add the JS
	function iqconnetik_post_likes_scripts()
	{
		wp_enqueue_script('post-likes', get_template_directory_uri() . '/assets/js/mod-post-likes.js', array('jquery'), '1.0.0', true);
		wp_localize_script('post-likes', 'MyAjax', array(
			// URL to wp-admin/admin-ajax.php to process the request
			'ajaxurl'  => admin_url('admin-ajax.php'),
			// generate a nonce with a unique ID "myajax-post-comment-nonce"
			// so that you can check it later when an AJAX request is sent
			'security' => wp_create_nonce('increment-post-likes') //,
			//'post_id' => get_the_ID()
		));
	} //iqconnetik_post_likes_scripts()
endif;
add_action('wp_enqueue_scripts', 'iqconnetik_post_likes_scripts');

if (!function_exists('iqconnetik_inc_post_like_callback')) :
	// The function that handles the AJAX request
	function iqconnetik_inc_post_like_callback()
	{
		check_ajax_referer('increment-post-likes', 'security');
		$pID = intval($_POST['pID']);
		iqconnetik_set_post_likes($pID);
		echo iqconnetik_print_post_likes(iqconnetik_get_post_likes($pID));

		die(); // this is required to return a proper result
	} //iqconnetik_inc_post_like_callback()
endif;
add_action('wp_ajax_add_like', 'iqconnetik_inc_post_like_callback');
add_action('wp_ajax_nopriv_add_like', 'iqconnetik_inc_post_like_callback');

if (!function_exists('iqconnetik_post_like_button')) :
	/**
	 * Print like button
	 */
	function iqconnetik_post_like_button($postID)
	{
		$output = '';
		if (empty($_COOKIE["$postID"])) {
			$output = '<span data-id="' . $postID . '"><a href="" class="like_button like_active_button"><i class="fa fa-heart-o" aria-hidden="true"></i></a></span>';
		} else {
			$output = '<span data-id="' . $postID . '"><span class="like_button"><i class="fa fa-check" aria-hidden="true"></i></span></span>';
		}
		echo apply_filters('iqconnetik_like_button', $output);
	} //iqconnetik_post_like_button()
endif;
add_action('iqconnetik_post_meta', 'iqconnetik_post_like_button', 10, 1);

if (!function_exists('iqconnetik_post_like_count')) :
	/**
	 * Print like counter value
	 */
	function iqconnetik_post_like_count($postID)
	{
		echo apply_filters('iqconnetik_like_count', '<span class="item-likes votes_count_' . $postID . '">' . iqconnetik_print_post_likes(iqconnetik_get_post_likes($postID)) . '</span>');
	} //iqconnetik_post_like_count()
endif;
add_action('iqconnetik_post_meta', 'iqconnetik_post_like_count', 20, 1);

if (!function_exists('iqconnetik_the_likes')) :
	/**
	 * Prints date HTML with the post link on blog.
	 */
	function iqconnetik_the_likes()
	{

		//options
		//single post
		if (is_singular()) {

			$blog_show_likes  = iqconnetik_option('blog_single_show_likes', true);
			$blog_before_likes_word  = iqconnetik_option('blog_single_before_likes_word', '');

			//blog loop
		} else {

			$blog_show_likes  = iqconnetik_option('blog_show_likes', 'number');
			$blog_before_likes_word  = iqconnetik_option('blog_before_likes_word', '');
		}

		if (!empty($blog_show_likes)) :
			//likes-wrapper
			switch ($blog_show_likes):
				case 'number':
				?>
					<span class="entry-like-wrap icon-inline number-only highlightlinks">
						<?php

						//icon
						iqconnetik_post_like_button(get_the_ID());

						//word
						if (!empty($blog_before_likes_word)) :
						?>
							<span class="date-word meta-word">
								<?php echo esc_html($blog_before_likes_word); ?>
							</span>
							<!--.likes-word-->
						<?php
						endif;
						iqconnetik_post_like_count(get_the_ID());
						?>
					</span>
				<?php
					break;
					//text
				default:
				?>
					<span class="entry-like-wrap icon-inline highlightlinks">
						<?php

						//icon
						iqconnetik_post_like_button(get_the_ID());

						//word
						if (!empty($blog_before_likes_word)) :
						?>
							<span class="date-word meta-word">
								<?php echo esc_html($blog_before_likes_word); ?>
							</span>
							<!--.likes-word-->
						<?php
						endif;
						iqconnetik_post_like_count(get_the_ID());
						?>
					</span>
			<?php
			endswitch;
		endif; //likes
	}
endif; //iqconnetik_show_likes

if (!function_exists('iqconnetik_the_view')) :
	/**
	 * Prints date HTML with the post link on blog.
	 */
	function iqconnetik_the_view()
	{

		//options
		//single post
		if (is_singular()) {

			$blog_show_views  = iqconnetik_option('blog_single_show_views', true);
			$blog_before_views_word  = iqconnetik_option('blog_single_before_views_word', '');
			$iqconnetik_show_icons = !iqconnetik_option('blog_single_hide_meta_icons', false);

			//blog loop
		} else {

			$blog_show_views  = iqconnetik_option('blog_show_views', 'number');
			$blog_before_views_word  = iqconnetik_option('blog_before_views_word', '');
			$iqconnetik_show_icons = !iqconnetik_option('blog_hide_meta_icons', false);
		}

		if (!empty($blog_show_views) && function_exists('iqconnetik_show_post_views_count')) :
			//views-wrapper
			?>
			<span class="entry-view-wrap icon-inline <?php echo esc_attr($blog_show_views === 'number') ? 'number-only' : ''; ?>">
				<?php

				//icon
				if (!empty($iqconnetik_show_icons)) {
					iqconnetik_icon('eye');
				}

				//word
				if (!empty($blog_before_views_word)) :
				?>
					<span class="date-word meta-word">
						<?php echo esc_html($blog_before_views_word); ?>
					</span>
					<!--.views-word-->
			<?php
				endif;
				iqconnetik_show_post_views_count();
				echo '</span>';
			endif; //views
		}
	endif; //iqconnetik_the_views

	if (!function_exists('iqconnetik_entry_meta')) :
		/**
		 * Prints HTML with the comment count for the current post.
		 */

		function iqconnetik_entry_meta($iqconnetik_show_author = true, $iqconnetik_show_date = true, $iqconnetik_show_categories = true, $iqconnetik_show_tags = true, $iqconnetik_show_likes = true, $iqconnetik_the_view = true, $iqconnetik_show_comments = true)
		{
			if (!empty($iqconnetik_show_author)) :
				iqconnetik_the_author();
			endif; //author

			if (!empty($iqconnetik_show_date)) :
				iqconnetik_the_date();
			endif; //date

			if (!empty($iqconnetik_show_categories)) :
				iqconnetik_the_categories();
			endif; //categories

			if (!empty($iqconnetik_show_tags)) :
				iqconnetik_the_tags();
			endif; //tags

			if (!empty($iqconnetik_show_likes)) :
				iqconnetik_the_likes();
			endif; //likes

			if (!empty($iqconnetik_the_view)) :
				iqconnetik_the_view();
			endif; //view

			if (!empty($iqconnetik_show_comments)) :
				iqconnetik_comment_count();
			endif; //comments
		}
	endif;


	if (!function_exists('iqconnetik_post_nav')) :
		/**
		 * Display navigation to next/previous post when applicable.
		 */
		function iqconnetik_post_nav()
		{

			$iqconnetik_blog_single_post_nav = iqconnetik_option('blog_single_post_nav', '');

			if (empty($iqconnetik_blog_single_post_nav)) {
				return;
			}

			// Don't print empty markup if there's nowhere to navigate.
			$iqconnetik_previous = (is_attachment()) ? get_post(get_post()->post_parent) : get_adjacent_post(false, '', true);
			$iqconnetik_next     = get_adjacent_post(false, '', false);

			if (!$iqconnetik_next && !$iqconnetik_previous) {
				return;
			}

			$iqconnetik_word_prev = iqconnetik_option('blog_single_post_nav_word_prev', esc_html__('Prev', 'iqconnetik'));
			$iqconnetik_word_next = iqconnetik_option('blog_single_post_nav_word_next', esc_html__('Next', 'iqconnetik'));
			?>
			<nav class="post-nav post-nav-layout-<?php echo esc_attr($iqconnetik_blog_single_post_nav); ?>">
				<?php

				if (is_attachment() && 'attachment' === $iqconnetik_previous->post_type) {
					return;
				}

				if ($iqconnetik_previous && has_post_thumbnail($iqconnetik_previous->ID)) {
					$iqconnetik_prevthumb = wp_get_attachment_image_src(get_post_thumbnail_id($iqconnetik_previous->ID), 'post-thumbnail');
					if ($iqconnetik_prevthumb) {
						$iqconnetik_prevthumb_sm         = wp_get_attachment_image_src(get_post_thumbnail_id($iqconnetik_previous->ID), 'thumbnail');
						$iqconnetik_prev_thumbnail_style = ' style="background-image: url(' . esc_url($iqconnetik_prevthumb[0]) . '); "';
						$iqconnetik_prev_thumbnail_class = 'has-image background-cover cover-center';
						$iqconnetik_prev_thumbnail_img   = '<span class="post-nav-thumb"><img src="' . esc_url($iqconnetik_prevthumb_sm[0]) . '" alt="' . $iqconnetik_previous->post_title . '"></span>';
					} else {
						$iqconnetik_prev_thumbnail_style = '';
						$iqconnetik_prev_thumbnail_class = 'no-image';
						$iqconnetik_prev_thumbnail_img   = '';
					}
				} else {
					$iqconnetik_prev_thumbnail_style = '';
					$iqconnetik_prev_thumbnail_class = 'no-image';
					$iqconnetik_prev_thumbnail_img   = '';
				}

				if ($iqconnetik_next && has_post_thumbnail($iqconnetik_next->ID)) {
					$iqconnetik_nextthumb = wp_get_attachment_image_src(get_post_thumbnail_id($iqconnetik_next->ID), 'post-thumbnail');
					if ($iqconnetik_nextthumb) {
						$iqconnetik_nextthumb_sm         = wp_get_attachment_image_src(get_post_thumbnail_id($iqconnetik_next->ID), 'thumbnail');
						$iqconnetik_next_thumbnail_style = ' style="background-image: url(' . esc_url($iqconnetik_nextthumb[0]) . '); "';
						$iqconnetik_next_thumbnail_class = 'has-image background-cover cover-center';
						$iqconnetik_next_thumbnail_img   = '<span class="post-nav-thumb"><img src="' . esc_url($iqconnetik_nextthumb_sm[0]) . '" alt="' . $iqconnetik_next->post_title . '"></span>';
					} else {
						$iqconnetik_next_thumbnail_style = '';
						$iqconnetik_next_thumbnail_class = 'no-image';
						$iqconnetik_next_thumbnail_img   = '';
					}
				} else {
					$iqconnetik_next_thumbnail_style = '';
					$iqconnetik_next_thumbnail_class = 'no-image';
					$iqconnetik_next_thumbnail_img   = '';
				}

				//layouts
				switch ($iqconnetik_blog_single_post_nav):
					case 'bg':
						echo '<div>';
						previous_post_link(
							'%link',
							'<div class="post-nav-item bg-item prev-item ' . esc_attr($iqconnetik_prev_thumbnail_class) . '"' . $iqconnetik_prev_thumbnail_style . '>
							<span class="post-nav-words-wrap">
								<span class="post-nav-word highlight">' . esc_html($iqconnetik_word_prev) . '</span>
								<h5 class="post-nav-title">%title</h5>
							</span>
						</div>',
							false,
							''
						);
						echo '</div>';

						echo '<div>';
						next_post_link(
							'%link',
							'<div class="post-nav-item bg-item next-item ' . esc_attr($iqconnetik_next_thumbnail_class) . '"' . $iqconnetik_next_thumbnail_style . '>
							<span class="post-nav-words-wrap">
								<span class="post-nav-word highlight">' . esc_html($iqconnetik_word_next) . '</span>
								<h5 class="post-nav-title">%title</h5>
							</span>
						</div>',
							false,
							''
						);
						echo '</div>';
						break;
					case 'thumbnail':
						echo '<div>';
						previous_post_link(
							'%link',
							'<div class="post-nav-item prev-item">
							<span class="post-nav-arrow">' . iqconnetik_icon('chevron-left', true) . '</span>
							' . $iqconnetik_prev_thumbnail_img . '
							<span class="post-nav-words-wrap">
								<span class="post-nav-word">' . esc_html($iqconnetik_word_prev) . '</span>
								<span class="post-nav-title">%title</span>
							</span>
						</div>',
							false,
							''
						);
						echo '</div>';

						echo '<div>';
						next_post_link(
							'%link',
							'<div class="post-nav-item next-item">
							<span class="post-nav-words-wrap">
								<span class="post-nav-word">' . esc_html($iqconnetik_word_next) . '</span> 
								<span class="post-nav-title">%title</span>
							</span>
							' . $iqconnetik_next_thumbnail_img . '
							<span class="post-nav-arrow">' . iqconnetik_icon('chevron-right', true) . '</span>
						</div>',
							false,
							''
						);
						echo '</div>';
						break;
					case 'arrow':
						echo '<div>';
						previous_post_link(
							'%link',
							'<div class="post-nav-item prev-item">
								<span class="post-nav-word">' . esc_html($iqconnetik_word_prev) . '</span>
							</div>',
							false,
							''
						);
						echo '</div>';

						echo '<div>';
						next_post_link(
							'%link',
							'<div class="post-nav-item next-item">
								<span class="post-nav-word">' . esc_html($iqconnetik_word_next) . '</span> 
							</div>',
							false,
							''
						);
						echo '</div>';
						break;
						//title
					default:
						echo '<div>';
						previous_post_link(
							'%link',
							'<div class="post-nav-item prev-item">
							<span class="post-nav-words-wrap">
								<span class="post-nav-word">' . esc_html($iqconnetik_word_prev) . '</span>
								<span class="post-nav-title">%title</span>
							</span>
						</div>',
							false,
							''
						);
						echo '</div>';

						echo '<div>';
						next_post_link(
							'%link',
							'<div class="post-nav-item next-item">
							<span class="post-nav-words-wrap">
								<span class="post-nav-word">' . esc_html($iqconnetik_word_next) . '</span> 
								<span class="post-nav-title">%title</span>
							</span>
						</div>',
							false,
							''
						);
						echo '</div>';
				endswitch;

				?>
			</nav><!-- .navigation -->
			<?php
		} //iqconnetik_post_nav
	endif;


	if (!function_exists('iqconnetik_section_background_image_array')) :
		/**
		 * Get array of section attributes to display background image.
		 */
		function iqconnetik_section_background_image_array($iqconnetik_section, $iqconnetik_empty_image = false)
		{

			//processing title section background for simple single post 'title-section-image' layout
			if (is_single() && 'title' === $iqconnetik_section) :
				if (iqconnetik_get_post_layout() === 'title-section-image') :
					//if has post thumbnail
					if (!post_password_required() && !is_attachment() && has_post_thumbnail()) {
						return array(
							'url'   => get_the_post_thumbnail_url(get_the_ID(), 'full'),
							'class' => 'i post-thumbnail-background background-cover cover-center background-fixed background-overlay overlay-dark',
						);
					}
				endif;
			endif; //is_single

			//for page with feature image - override default header_image
			if ('header_image' === $iqconnetik_section) {
				$iqconnetik_image = get_header_image();
				//for page with feature image - override default image
				if (is_page()) {
					if (has_post_thumbnail()) {
						$iqconnetik_image = get_the_post_thumbnail_url();
					}
				}
			} else {
				$iqconnetik_image = iqconnetik_option($iqconnetik_section . '_background_image', '');
				// override title background if page featured image is set
				if ('title' === $iqconnetik_section && $iqconnetik_image) {
					//for page with feature image - override default image
					if (is_page()) {
						if (has_post_thumbnail()) {
							$iqconnetik_image = get_the_post_thumbnail_url();
						}
					}
				}
			}

			$iqconnetik_return = array(
				'url'   => $iqconnetik_image,
				'class' => '',
			);

			if (empty($iqconnetik_image) && empty($iqconnetik_empty_image)) {
				return $iqconnetik_return;
			}

			$iqconnetik_cover   = iqconnetik_option($iqconnetik_section . '_background_image_cover', '');
			$iqconnetik_fixed   = iqconnetik_option($iqconnetik_section . '_background_image_fixed', '');
			$iqconnetik_overlay = iqconnetik_option($iqconnetik_section . '_background_image_overlay', '');

			if (!empty($iqconnetik_cover)) {
				$iqconnetik_return['class'] .= 'background-cover cover-center';
			}

			if (!empty($iqconnetik_fixed)) {
				$iqconnetik_return['class'] .= ' background-fixed';
			}

			if (!empty($iqconnetik_overlay)) {
				$iqconnetik_return['class'] .= ' background-overlay ' . $iqconnetik_overlay;
			}

			return $iqconnetik_return;
		}
	endif;

	/////////////
	//Read More//
	/////////////

	// Read more markup inside link for excertp and the_content
	if (!function_exists('iqconnetik_read_more_inside_link_markup')) :
		function iqconnetik_read_more_inside_link_markup($iqconnetik_read_more_text = '')
		{

			if (empty($iqconnetik_read_more_text)) {
				$iqconnetik_read_more_text = iqconnetik_option('blog_read_more_text', '');
			}

			if (empty($iqconnetik_read_more_text)) {
				return '';
			}

			return sprintf(
				wp_kses(
					$iqconnetik_read_more_text . '<span class="screen-reader-text"> "%s"</span>',
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			);
		}
	endif;

	//generated excerpt ending...
	if (!function_exists('iqconnetik_excerpt_more')) :
		function iqconnetik_excerpt_more($iqconnetik_more)
		{
			return '<span class="more-dots">...</span>';
		}
	endif;
	add_filter('excerpt_more', 'iqconnetik_excerpt_more', 21);

	//read more for excerpt
	if (!function_exists('iqconnetik_read_more_markup_excerpt')) :
		function iqconnetik_read_more_markup_excerpt()
		{
			global $post;
			$iqconnetik_markup = ' <div class="more-tag"><a class="more-link btn btn-big with-arrow btn-gradient" href="' .
				esc_url(get_permalink($post->ID)) . '">' .
				iqconnetik_read_more_inside_link_markup() .
				'<i class="ico ico-arrow-right"></i></a></div><!-- .more-tag -->';

			return $iqconnetik_markup;
		}
	endif;

	//putting read more text inside excerpt if text is not empty
	if (!function_exists('iqconnetik_read_more_in_excerpt')) :
		function iqconnetik_read_more_in_excerpt($iqconnetik_excerpt)
		{

			$iqconnetik_read_more_text = iqconnetik_option('blog_read_more_text', '');

			if (empty($iqconnetik_read_more_text)) {
				return $iqconnetik_excerpt;
			}

			$iqconnetik_excerpt = str_replace('</p>', iqconnetik_read_more_markup_excerpt($iqconnetik_read_more_text) . '</p>', $iqconnetik_excerpt);

			return $iqconnetik_excerpt;
		}
	endif;
	add_filter('the_excerpt', 'iqconnetik_read_more_in_excerpt', 21);

	//Filter the except length
	if (!function_exists('iqconnetik_excerpt_custom_length')) :
		function iqconnetik_excerpt_custom_length($iqconnetik_length)
		{

			return absint(iqconnetik_option('blog_excerpt_length', 40));
		}
	endif;
	add_filter('excerpt_length', 'iqconnetik_excerpt_custom_length', 999);

	//home page intro teasers
	if (!function_exists('iqconnetik_get_intro_teasers')) :
		function iqconnetik_get_intro_teasers()
		{

			$iqconnetik_teasers = array();

			for ($iqconnetik_i = 1; $iqconnetik_i < 5; $iqconnetik_i++) {
				/*
			reeatable options:
				intro_teaser_image_
				intro_teaser_title_
				intro_teaser_text_
				intro_teaser_link_
				intro_teaser_button_text_
			*/
				$iqconnetik_teasers[$iqconnetik_i] = array_filter(
					array(
						'image'  => iqconnetik_option('intro_teaser_image_' . $iqconnetik_i, ''),
						'title'  => iqconnetik_option('intro_teaser_title_' . $iqconnetik_i, ''),
						'text'   => iqconnetik_option('intro_teaser_text_' . $iqconnetik_i, ''),
						'link'   => iqconnetik_option('intro_teaser_link_' . $iqconnetik_i, ''),
						'button' => iqconnetik_option('intro_teaser_button_text_' . $iqconnetik_i, ''),
					)
				);
			}

			return array_filter($iqconnetik_teasers);
		}
	endif;

	//related posts
	if (!function_exists('iqconnetik_related_posts')) :
		function iqconnetik_related_posts($iqconnetik_id)
		{

			$iqconnetik_layout = iqconnetik_option('blog_single_related_posts', '');
			if (empty($iqconnetik_layout)) {
				return;
			}
			$iqconnetik_tags   = wp_get_post_tags($iqconnetik_id, array('fields' => 'ids'));
			if (!empty($iqconnetik_tags)) :
				//list
				//list-thumbnails
				//grid
				//num of posts
				$iqconnetik_posts_number = absint(iqconnetik_option('blog_single_related_posts_number', 3));
				if (empty($iqconnetik_posts_number)) {
					$iqconnetik_posts_number = 3;
				}

				$iqconnetik_args  = array(
					'tag__in'        => $iqconnetik_tags,
					'post__not_in'   => array($iqconnetik_id),
					'posts_per_page' => $iqconnetik_posts_number,
				);
				$iqconnetik_query = new WP_Query($iqconnetik_args);
				if ($iqconnetik_query->have_posts()) :
					$iqconnetik_related_title = iqconnetik_option('blog_single_related_posts_title', esc_html__('Related Posts', 'iqconnetik'));
			?>
					<div class="related-posts">
						<?php if (!empty($iqconnetik_related_title)) : ?>
							<h3 class="related-posts-heading"><?php echo wp_kses_post($iqconnetik_related_title); ?></h3>
							<?php
						endif; //related_title
						switch ($iqconnetik_layout):
							case 'grid':
								switch ($iqconnetik_posts_number):
									case 3:
										$iqconnetik_wrapper_class = 'layout-cols-3';
										break;
									case 4:
										$iqconnetik_wrapper_class = 'layout-cols-4';
										break;
									default:
										$iqconnetik_wrapper_class = '';
								endswitch;
								if ($iqconnetik_query->post_count < 3) {
									$iqconnetik_wrapper_class = 'layout-cols-' . $iqconnetik_query->post_count;
								}
							?>
								<div class="layout-gap-30">
									<div class="grid-wrapper <?php echo esc_attr($iqconnetik_wrapper_class); ?>">
										<?php
										while ($iqconnetik_query->have_posts()) :
											$iqconnetik_query->the_post();
										?>
											<div class="grid-item post">
												<article <?php post_class('vertical-item'); ?>>
													<?php if (has_post_thumbnail()) : ?>
														<figure class="post-thumbnail">
															<a href="<?php the_permalink(); ?>">
																<?php the_post_thumbnail('iqconnetik-square'); ?>
															</a>
														</figure>
													<?php endif; ?>
													<div class="item-content">
														<header class="entry-header">
															<div class="entry-meta post-meta mb-0">
																<?php iqconnetik_entry_meta(false, true, true, false, false, false, false); ?>
															</div>
															<h6 class="entry-title darklinks mt-0 mb-0">
																<a rel="bookmark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
															</h6>
														</header>
													</div>
												</article>
											</div>
										<?php endwhile; ?>
									</div><!-- .grid-wrapper -->
								</div><!-- .layout-gap-* -->
							<?php
								break;

							case 'list-thumbnails':
							?>
								<ul class="posts-list">
									<?php
									while ($iqconnetik_query->have_posts()) :
										$iqconnetik_query->the_post();
									?>
										<li class="list-has-post-thumbnail">
											<?php if (has_post_thumbnail()) : ?>
												<a class="posts-list-thumbnail" href="<?php the_permalink(); ?>">
													<?php the_post_thumbnail('thumbnail'); ?>
												</a>
											<?php endif; ?>
											<div class="item-content">
												<h5 class="post-title">
													<a rel="bookmark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
												</h5>
												<div class="icon-inline-wrap">
													<span class="icon-inline post-date">
														<?php iqconnetik_icon('clock-outline') ?>
														<span><?php echo get_the_date('', get_the_ID()); ?></span>
													</span>
												</div>
											</div>
										</li>
									<?php endwhile; ?>
								</ul>
							<?php
								break;

							default:
							?>
								<ul class="list-styled">
									<?php
									while ($iqconnetik_query->have_posts()) :
										$iqconnetik_query->the_post();
									?>
										<li class="">
											<h6>
												<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
											</h6>
										</li>
									<?php endwhile; ?>
								</ul>
						<?php
						endswitch; //layout
						?>
					</div><!-- .related-posts -->
	<?php
				endif; //have_posts
				wp_reset_postdata();
			endif; //tags
		}
	endif;

	//get any widget HTML markup
	if (!function_exists('iqconnetik_get_the_widget')) :
		function iqconnetik_get_the_widget($iqconnetik_widget_class, $iqconnetik_instance = array())
		{

			if (!class_exists($iqconnetik_widget_class)) {
				return '';
			}
			//same as in inc/setup.php file
			$iqconnetik_args = array(
				'before_title' => '<h3 class="widget-title"><span>',
				'after_title'  => '</span></h3>',
			);

			ob_start();

			the_widget($iqconnetik_widget_class, $iqconnetik_instance, $iqconnetik_args);

			return ob_get_clean();
		}
	endif;

	//count widgets in sidebar
	if (!function_exists('iqconnetik_get_sidebar_widgets_count')) :
		function iqconnetik_get_sidebar_widgets_count($sidebar_id)
		{
			$widgets = get_option('sidebars_widgets');

			return count($widgets[$sidebar_id]);
		}
	endif;

	//detect shop - handy for sidebar and breadcrumbs
	if (!function_exists('iqconnetik_is_shop')) :
		function iqconnetik_is_shop()
		{
			$iqconnetik_return = false;
			if (function_exists('is_woocommerce')) {
				if (is_woocommerce() || is_cart() || is_checkout() || is_account_page()) {
					$iqconnetik_return = true;
				}
			}
			if (function_exists('yith_wcwl_is_wishlist_page')) {
				if (yith_wcwl_is_wishlist_page()) {
					$iqconnetik_return = true;
				}
			}

			return $iqconnetik_return;
		}
	endif;

	//echo breadcrumbs markup
	if (!function_exists('iqconnetik_breadcrumbs')) :
		function iqconnetik_breadcrumbs()
		{
			$iqconnetik_args              = array(
				'before' => '<nav class="breadcrumbs">',
				'after'  => '</nav>',
			);
			$iqconnetik_seo_options       = get_option('wpseo_titles');
			$iqconnetik_args['delimiter'] = !empty($iqconnetik_seo_options['breadcrumbs-sep']) ? $iqconnetik_seo_options['breadcrumbs-sep'] : '/';
			if (function_exists('yoast_breadcrumb')) :
				yoast_breadcrumb('<nav class="breadcrumbs">', '</nav>');
			elseif (iqconnetik_is_shop()) :
				woocommerce_breadcrumb(
					array(
						'wrap_before' => $iqconnetik_args['before'] . '<span>',
						'wrap_after'  => '</span>' . $iqconnetik_args['after'],
						'before'      => '<span class="breadcrumbs_item">',
						'after'       => '</span>',
						'delimiter'   => ' ' . $iqconnetik_args['delimiter'] . ' ',
					)
				);
			elseif (function_exists('rank_math_the_breadcrumbs')) :
				$args = array(
					'delimiter'   => '&nbsp;&#47;&nbsp;',
					'wrap_before' => '<nav class="breadcrumbs">',
					'wrap_after'  => '</nav>',
					'before'      => '',
					'after'       => '',
				);
				rank_math_the_breadcrumbs($args);
			endif;
		}
	endif;

	//check if breadcrumbs are enabled and plugins to show them are active
	if (!function_exists('iqconnetik_breadcrumbs_enabled')) :
		function iqconnetik_breadcrumbs_enabled()
		{
			$iqconnetik_return = iqconnetik_option('title_show_breadcrumbs', true);
			if (iqconnetik_is_shop() && $iqconnetik_return) {
				return $iqconnetik_return;
			} elseif (function_exists('yoast_breadcrumb') && $iqconnetik_return) {
				return $iqconnetik_return;
			} elseif (function_exists('rank_math_the_breadcrumbs') && $iqconnetik_return) {
				return $iqconnetik_return;
			} else {
				return false;
			}
		}
	endif;

	//copyright text - year
	if (!function_exists('iqconnetik_get_copyright_text')) :
		function iqconnetik_get_copyright_text($iqconnetik_text = '')
		{
			$iqconnetik_text = str_replace('[year]', '<span class="copyright-year">' . date('Y') . '</span>', $iqconnetik_text);
			return $iqconnetik_text;
		}
	endif;

	//detect is_front_page and not is paged
	if (!function_exists('iqconnetik_is_front_page')) :
		function iqconnetik_is_front_page()
		{
			return is_front_page();
		}
	endif;

	//detect for displaying title section
	if (!function_exists('iqconnetik_is_title_section_is_shown')) :
		function iqconnetik_is_title_section_is_shown()
		{
			if (is_page_template('page-templates/no-sidebar-no-title.php')) {
				return false;
			}
			$iqconnetik_show_title       = iqconnetik_option('title_show_title', '');
			$iqconnetik_show_search      = iqconnetik_option('title_show_search', '');
			$iqconnetik_show_breadcrumbs = iqconnetik_breadcrumbs_enabled();
			$iqconnetik_is_front_page    = iqconnetik_is_front_page();

			if (!empty($iqconnetik_is_front_page) && empty($iqconnetik_show_search)) {
				return false;
			}

			if (empty($iqconnetik_show_title) && empty($iqconnetik_show_breadcrumbs) && empty($iqconnetik_show_search)) {
				return false;
			} else {
				return true;
			}
		}
	endif;
