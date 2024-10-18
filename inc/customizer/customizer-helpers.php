<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

add_action('customize_register', 'iqconnetik_customize_register', 999);
if (!function_exists('iqconnetik_customize_register')) :
	function iqconnetik_customize_register($wp_customize)
	{
		// Define a custom control class, WP_Customize_Custom_Control.
		// Register the class so that its JS template is available in the Customizer.
		$wp_customize->register_control_type('Iqconnetik_Google_Font_Control');

		//////////
		//colors//
		//////////
		// colorLight
		// colorFont
		// colorFontDark
		// colorBackground
		// colorBorder
		// colorBorderDark
		// colorDark
		// colorDarkGrey
		// colorGrey
		// colorMain
		// colorMain2
		// colorMain3
		// colorMain4
		$wp_customize->get_setting('colorLight')->transport                = 'postMessage';
		$wp_customize->get_setting('colorFont')->transport                 = 'postMessage';
		$wp_customize->get_setting('colorFontDark')->transport             = 'postMessage';
		$wp_customize->get_setting('colorBackground')->transport   		   = 'postMessage';
		$wp_customize->get_setting('colorBorder')->transport               = 'postMessage';
		$wp_customize->get_setting('colorBorderDark')->transport           = 'postMessage';
		$wp_customize->get_setting('colorDark')->transport                 = 'postMessage';
		$wp_customize->get_setting('colorDarkGrey')->transport             = 'postMessage';
		$wp_customize->get_setting('colorGrey')->transport                 = 'postMessage';
		$wp_customize->get_setting('colorMain')->transport                 = 'postMessage';
		$wp_customize->get_setting('colorMain2')->transport                = 'postMessage';
		$wp_customize->get_setting('colorMain3')->transport                = 'postMessage';
		$wp_customize->get_setting('colorMain4')->transport                = 'postMessage';

		////////////////////
		//color meta icons//
		////////////////////
		$wp_customize->get_setting('color_meta_icons')->transport = 'postMessage';

		//////////////
		//containers//
		//////////////
		$section_ids = array(
			'main_container_width',
			'blog_single_container_width',
			'blog_container_width',

		);
		foreach ($section_ids as $id) :
			if (empty($wp_customize->get_setting($id))) {
				continue;
			}
			$wp_customize->get_setting($id)->transport = 'postMessage';
		endforeach;

		///////////
		//sidebar//
		///////////
		$section_ids = array(
			'blog_sidebar_position',
			'blog_single_sidebar_position',
			'shop_sidebar_width',
			'shop_gap_width',
			'shop_sidebar_position',
			'product_sidebar_position',
		);
		foreach ($section_ids as $id) :
			if (empty($wp_customize->get_setting($id))) {
				continue;
			}
			$wp_customize->get_setting($id)->transport = 'postMessage';
			$wp_customize->selective_refresh->add_partial(
				$id,
				array(
					'selector' => '#aside',
					'container_inclusive' => true,
					'render_callback' => function () {
						get_template_part('sidebar');
					},
				)
			);
		endforeach;

		/////////////////////
		//selective refresh//
		/////////////////////

		//#logo
		$section_ids = array(
			'custom_logo',
			'blogname',
			'blogdescription',
			'logo',
			'logo_primary_text',
			'logo_text_secondary',
			'logo_background',
			'logo_padding_horizontal',
		);
		foreach ($section_ids as $id) :
			if (empty($wp_customize->get_setting($id))) {
				continue;
			}
			$wp_customize->get_setting($id)->transport = 'postMessage';
			$wp_customize->selective_refresh->add_partial(
				$id,
				array(
					'selector' => 'a.logo',
					'container_inclusive' => false,
					'render_callback' => function () {
						get_template_part('template-parts/header/logo/logo', iqconnetik_template_part('logo', '1'));
					},
				)
			);
		endforeach;

		//////////
		//#intro//
		//////////
		$section_ids = array(
			'intro_layout',
			'intro_fullscreen',
			'intro_background',
			'intro_background_image',
			'intro_image_animation',
			'intro_background_image_cover',
			'intro_background_image_fixed',
			'intro_background_image_overlay',
			'intro_heading',
			'intro_heading_mt',
			'intro_heading_mb',
			'intro_heading_animation',
			'intro_description',
			'intro_description_mt',
			'intro_description_mb',
			'intro_description_animation',
			'intro_button_text_first',
			'intro_button_url_first',
			'intro_button_first_animation',
			'intro_button_text_second',
			'intro_button_url_second',
			'intro_button_second_animation',
			'intro_buttons_mt',
			'intro_buttons_mb',
			'intro_shortcode',
			'intro_shortcode_mt',
			'intro_shortcode_mb',
			'intro_shortcode_animation',
			'intro_alignment',
			'intro_extra_padding_top',
			'intro_extra_padding_bottom',
			'intro_font_size',
			'intro_background_image_scale',
			'intro_image_absolute',
			'intro_social_links',
		);
		foreach ($section_ids as $id) :
			if (empty($wp_customize->get_setting($id))) {
				continue;
			}
			$wp_customize->get_setting($id)->transport = 'postMessage';
			$wp_customize->selective_refresh->add_partial(
				$id,
				array(
					'selector' => '#intro',
					'container_inclusive' => true,
					'render_callback' => function () {
						if (iqconnetik_is_front_page()) :
							get_template_part('template-parts/header/intro');
						endif;
					},
				)
			);
		endforeach;


		////////////////////////
		//topline,header,title//
		////////////////////////
		$section_ids = array(
			'meta_email',
			'meta_email_label',
			'meta_phone',
			'meta_phone_label',
			'meta_address',
			'meta_address_label',
			'meta_opening_hours',
			'meta_opening_hours_label',
			'meta_facebook',
			'meta_twitter',
			'meta_youtube',
			'meta_instagram',
			'meta_pinterest',
			'meta_linkedin',
			'meta_github',
			'header',
			'header_fluid',
			'header_background',
			'header_align_main_menu',
			'header_toggler_menu_main',
			//'header_absolute',
			'header_transparent',
			'header_border_top',
			'header_border_bottom',
			'header_font_size',
			'header_sticky',
			'header_topline_options_heading',
			//from site identity
			'header_top_tall',
			//from header image
			'header_image',
			'header_image_background_image_cover',
			'header_image_background_image_fixed',
			'header_image_background_image_overlay',
			//from homepage settings
			'intro_position',
			'topline',
			'topline_fluid',
			'topline_background',
			'topline_font_size',
			'topline_meta_mail',
			'topline_meta_phone',
			'topline_meta_address',
			'topline_font_size',
			'title',
			'title_fluid',
			'title_show_title',
			'title_show_breadcrumbs',
			'title_background',
			'title_border_top',
			'title_border_bottom',
			'title_extra_padding_top',
			'title_extra_padding_bottom',
			'title_font_size',
			'title_hide_taxonomy_name',
			'title_background_image',
			'title_background_image_cover',
			'title_background_image_fixed',
			'title_background_image_overlay',
			//woo
			'header_cart_dropdown',
		);
		foreach ($section_ids as $id) :
			if (empty($wp_customize->get_setting($id))) {
				continue;
			}
			$wp_customize->get_setting($id)->transport = 'postMessage';
			$wp_customize->selective_refresh->add_partial(
				$id,
				array(
					'selector' => '#top-wrap',
					'container_inclusive' => true,
					'render_callback' => function () {
						get_template_part('template-parts/header/header-top');
					},
				)
			);
		endforeach;

		////////
		//main//
		////////
		///
		$section_ids = array(
			//#main
			'main_sidebar_width',
			'main_gap_width',
			'shop_sidebar_width',
			'shop_gap_width',
			'main_extra_padding_top',
			'main_extra_padding_bottom',
			'main_font_size',
			//aside
			'main_sidebar_sticky',
			'sidebar_font_size',
		);
		foreach ($section_ids as $id) :
			if (empty($wp_customize->get_setting($id))) {
				continue;
			}
			$wp_customize->get_setting($id)->transport = 'postMessage';
		endforeach;

		////////
		//blog//
		////////
		$section_ids = array(
			'blog_page_name',
			'blog_show_full_text',
			'blog_excerpt_length',
			'blog_read_more_text',
			'blog_hide_taxonomy_type_name',
			'blog_meta_options_heading',
			'blog_hide_meta_icons',
			'blog_show_author',
			'blog_show_author_avatar',
			'blog_before_author_word',
			'blog_show_date',
			'blog_before_date_word',
			'blog_show_categories',
			'blog_show_tags',
			'blog_before_tags_word',
			'blog_show_comments_link',
			'blog_show_views',
			'blog_before_views_word',
			'blog_show_likes',
			'blog_before_likes_word',
			'blog_share_facebook',
			'blog_share_twitter',
			'blog_share_telegram',
			'blog_share_pinterest',
			'blog_share_linkedin',
		);
		foreach ($section_ids as $id) :
			if (empty($wp_customize->get_setting($id))) {
				continue;
			}
			$wp_customize->get_setting($id)->transport = 'postMessage';
			$wp_customize->selective_refresh->add_partial(
				$id,
				array(
					'selector' => '#layout',
					'container_inclusive' => true,
					'render_callback' => function () {
						get_template_part('template-parts/index');
					},
				)
			);
		endforeach;

		////////
		//post//
		////////
		$section_ids = array(
			'blog_single_first_embed_featured',
			'blog_single_show_author_bio',
			'blog_single_author_bio_about_word',
			'blog_single_post_nav_heading',
			'blog_single_post_nav',
			'blog_single_post_nav_word_prev',
			'blog_single_post_nav_word_next',
			'blog_single_related_posts_heading',
			'blog_single_related_posts',
			'blog_single_related_posts_title',
			'blog_single_related_posts_number',
			'blog_single_meta_options_heading',
			'blog_single_hide_meta_icons',
			'blog_single_show_author',
			'blog_single_show_author_avatar',
			'blog_single_before_author_word',
			'blog_single_show_date',
			'blog_single_before_date_word',
			'blog_single_show_categories',
			'blog_single_show_tags',
			'blog_single_before_tags_word',
			'blog_single_show_comments_link',
			'blog_single_comments_title_reply',
			'blog_single_show_views',
			'blog_single_before_views_word',
			'blog_single_show_likes',
			'blog_single_share_facebook',
			'blog_single_share_twitter',
			'blog_single_share_telegram',
			'blog_single_share_pinterest',
			'blog_single_share_linkedin',
		);
		foreach ($section_ids as $id) :
			if (empty($wp_customize->get_setting($id))) {
				continue;
			}
			$wp_customize->get_setting($id)->transport = 'postMessage';
			$wp_customize->selective_refresh->add_partial(
				$id,
				array(
					'selector' => '#layout',
					'container_inclusive' => true,
					'render_callback' => function () {
						get_template_part('template-parts/single');
					},
				)
			);
		endforeach;

		///////////
		//#footer//
		///////////
		$section_ids = array(
			'footer',
			'footer_layout_gap',
			'footer_fluid',
			'footer_background',
			'footer_border_top',
			'footer_border_bottom',
			'footer_extra_padding_top',
			'footer_extra_padding_bottom',
			'footer_font_size',
			'footer_background_image',
			'footer_background_image_cover',
			'footer_background_image_fixed',
			'footer_background_image_overlay',
		);
		foreach ($section_ids as $id) :
			if (empty($wp_customize->get_setting($id))) {
				continue;
			}
			$wp_customize->get_setting($id)->transport = 'postMessage';
			$wp_customize->selective_refresh->add_partial(
				$id,
				array(
					'selector' => '#footer',
					'container_inclusive' => true,
					'render_callback' => function () {
						get_template_part('template-parts/footer/footer', iqconnetik_template_part('footer', '1'));
					},
				)
			);
		endforeach;


		///////////////
		//#footer-top//
		///////////////
		$section_ids = array(
			'footer_top',
			'footer_top_content_heading_text',
			'footer_top_heading',
			'footer_top_heading_mt',
			'footer_top_heading_mb',
			'footer_top_heading_animation',
			'footer_top_description',
			'footer_top_description_mt',
			'footer_top_description_mb',
			'footer_top_description_animation',
			'footer_top_shortcode',
			'footer_top_shortcode_mt',
			'footer_top_shortcode_mb',
			'footer_top_shortcode_animation',
			'footer_top_fluid',
			'footer_top_background',
			'footer_top_border_top',
			'footer_top_border_bottom',
			'footer_top_extra_padding_top',
			'footer_top_extra_padding_bottom',
			'footer_top_font_size',
			'footer_top_background_image',
			'footer_top_background_image_cover',
			'footer_top_background_image_fixed',
			'footer_top_background_image_overlay',
		);

		foreach ($section_ids as $id) :
			if (empty($wp_customize->get_setting($id))) {
				continue;
			}
			$wp_customize->get_setting($id)->transport = 'postMessage';
			$wp_customize->selective_refresh->add_partial(
				$id,
				array(
					'selector' => '#footer-top',
					'container_inclusive' => true,
					'render_callback' => function () {
						get_template_part('template-parts/footer-top/section', iqconnetik_template_part('footer_top', ''));
					},
				)
			);
		endforeach;

		//////////////
		//#copyright//
		//////////////
		$section_ids = array(
			'copyright',
			'copyright_text',
			'copyright_fluid',
			'copyright_background',
			'copyright_extra_padding_top',
			'copyright_extra_padding_bottom',
			'copyright_font_size',
			'copyright_background_image',
			'copyright_background_image_cover',
			'copyright_background_image_fixed',
			'copyright_background_image_overlay',
		);

		foreach ($section_ids as $id) :
			if (empty($wp_customize->get_setting($id))) {
				continue;
			}
			$wp_customize->get_setting($id)->transport = 'postMessage';
			$wp_customize->selective_refresh->add_partial(
				$id,
				array(
					'selector' => '#copyright',
					'container_inclusive' => true,
					'render_callback' => function () {
						get_template_part('template-parts/copyright/copyright', iqconnetik_template_part('copyright', '1'));
					},
				)
			);
		endforeach;

		//toTop
		$wp_customize->get_setting('totop')->transport = 'postMessage';
		$wp_customize->selective_refresh->add_partial(
			'totop',
			array(
				'selector' => '#to-top-wrap',
				'container_inclusive' => true,
				'render_callback' => function () {
					get_template_part('template-parts/footer/footer-totop');
				},
			)
		);
		//preloader
		$wp_customize->get_setting('preloader')->transport = 'postMessage';
		$wp_customize->selective_refresh->add_partial(
			'preloader',
			array(
				'selector' => '#preloader-wrap',
				'container_inclusive' => true,
				'render_callback' => function () {
					get_template_part('template-parts/header/header-preloader');
				},
			)
		);

		/////////
		//fonts//
		/////////
		$section_ids = array(
			'font_body',
			'font_headings',
		);
		foreach ($section_ids as $id) :
			if (empty($wp_customize->get_setting($id))) {
				continue;
			}
			$wp_customize->get_setting($id)->transport = 'postMessage';
			$wp_customize->selective_refresh->add_partial(
				$id,
				array(
					'selector' => 'head',
					'container_inclusive' => false,
					'render_callback' => function () {
						echo '<meta charset="';
						bloginfo('charset');
						echo '"/><meta name="viewport" content="width=device-width, initial-scale=1"/>';
						wp_head();
					},
				)
			);
		endforeach;

		/////////////
		//animation//
		/////////////
		$section_ids = array(
			'animation_enabled',
			'animation_sidebar_widgets',
			'animation_footer_top_widgets',
			'animation_footer_widgets',
			'animation_feed_posts',
			'animation_feed_posts_thumbnail',
		);
		foreach ($section_ids as $id) :
			if (empty($wp_customize->get_setting($id))) {
				continue;
			}
			$wp_customize->get_setting($id)->transport = 'postMessage';
		endforeach;

		//no need to reload page for these sections - just set them as a post message
		//assets_min
		$wp_customize->get_setting('box_fade_in')->transport = 'postMessage';
		$wp_customize->get_setting('assets_min')->transport = 'postMessage';
		$wp_customize->get_setting('jquery_to_footer')->transport = 'postMessage';

		$section_ids = array(
			'woocommerce_demo_store_notice',
			'woocommerce_demo_store',

			//shop
			'woocommerce_shop_page_display',
			'woocommerce_category_archive_display',
			'woocommerce_default_catalog_orderby',
			'woocommerce_catalog_columns',
			'woocommerce_catalog_rows',

			//checkout
			'woocommerce_checkout_company_field',
			'woocommerce_checkout_address_2_field',
			'woocommerce_checkout_phone_field',
			'woocommerce_checkout_highlight_required_fields',
			'wp_page_for_privacy_policy',
			'woocommerce_terms_page_id',
		);
		foreach ($section_ids as $id) :
			if (empty($wp_customize->get_setting($id))) {
				continue;
			}
			$wp_customize->get_setting($id)->transport = 'postMessage';
			$wp_customize->selective_refresh->add_partial(
				$id,
				array(
					'selector' => 'div.woo',
					'container_inclusive' => true,
					'render_callback' => 'iqconnetik_woocommerce_pages_ajax_render',
				)
			);
		endforeach;

		///////////////
		//shop custom//
		///////////////
		$section_ids = array(
			'product_simple_add_to_cart_hide_button',
			'product_simple_add_to_cart_hide_icon',
			'product_simple_add_to_cart_block_button',
			'product_simple_add_to_cart_text',
			'product_show_reviews',
			'product_show_category',
			'product_show_short_description',
			'product_show_thumbnail_add_to_cart',
			'product_show_thumbnail_link',
		);
		foreach ($section_ids as $id) :
			if (empty($wp_customize->get_setting($id))) {
				continue;
			}
			$wp_customize->get_setting($id)->transport = 'postMessage';
			$wp_customize->selective_refresh->add_partial(
				$id,
				array(
					'selector' => 'div.woo',
					'container_inclusive' => true,
					'render_callback' => 'iqconnetik_woocommerce_pages_ajax_render',
				)
			);
		endforeach;
	}
endif;

//cutsomizer typical backgrounds array
if (!function_exists('iqconnetik_customizer_backgrounds_array')) :
	function iqconnetik_customizer_backgrounds_array($unset_empty = false)
	{

		$bg = array(
			''                        => esc_html__('Transparent', 'iqconnetik'),
			'l'                       => esc_html__('Light', 'iqconnetik'),
			'l m'                     => esc_html__('Grey', 'iqconnetik'),
			'i'                       => esc_html__('Dark', 'iqconnetik'),
			'i m'                     => esc_html__('Darker', 'iqconnetik'),
			'i c'                     => esc_html__('Main', 'iqconnetik'),
			'i c c2'                  => esc_html__('Main 2', 'iqconnetik'),
		);

		if (!empty($unset_empty)) {
			unset($bg['']);
		}

		return $bg;
	}
endif;

//cutsomizer typical borders array
if (!function_exists('iqconnetik_customizer_borders_array')) :
	function iqconnetik_customizer_borders_array()
	{

		return array(
			''          => esc_html__('None', 'iqconnetik'),
			'container' => esc_html__('Container width', 'iqconnetik'),
			'full'      => esc_html__('Full width', 'iqconnetik'),
		);
	}
endif;

//cutsomizer typical font sizes array
if (!function_exists('iqconnetik_customizer_font_size_array')) :
	function iqconnetik_customizer_font_size_array()
	{
		// see _variables.scss
		//9 10 11 12 13 14 15 16 17 18 19 20 21 22 24 54 60 100 200
		return array(
			''      => esc_html__('Inherit', 'iqconnetik'),
			'fs-9'  => esc_html__('9px', 'iqconnetik'),
			'fs-10' => esc_html__('10px', 'iqconnetik'),
			'fs-11' => esc_html__('11px', 'iqconnetik'),
			'fs-12' => esc_html__('12px', 'iqconnetik'),
			'fs-13' => esc_html__('13px', 'iqconnetik'),
			'fs-14' => esc_html__('14px', 'iqconnetik'),
			'fs-15' => esc_html__('15px', 'iqconnetik'),
			'fs-16' => esc_html__('16px', 'iqconnetik'),
			'fs-17' => esc_html__('17px', 'iqconnetik'),
			'fs-18' => esc_html__('18px', 'iqconnetik'),
			'fs-19' => esc_html__('19px', 'iqconnetik'),
			'fs-20' => esc_html__('20px', 'iqconnetik'),
			'fs-21' => esc_html__('21px', 'iqconnetik'),
			'fs-22' => esc_html__('22px', 'iqconnetik'),
			'fs-24' => esc_html__('24px', 'iqconnetik'),
		);
	}
endif;

//cutsomizer typical font weight array
if (!function_exists('iqconnetik_customizer_font_weight_array')) :
	function iqconnetik_customizer_font_weight_array()
	{
		// see _variables.scss
		//100 200 300 400 500 600 700 800 900
		return array(
			''      => esc_html__('Inherit', 'iqconnetik'),
			'fw-100' => esc_html__('100', 'iqconnetik'),
			'fw-200' => esc_html__('200', 'iqconnetik'),
			'fw-300' => esc_html__('300', 'iqconnetik'),
			'fw-400' => esc_html__('400', 'iqconnetik'),
			'fw-500' => esc_html__('500', 'iqconnetik'),
			'fw-600' => esc_html__('600', 'iqconnetik'),
			'fw-700' => esc_html__('700', 'iqconnetik'),
			'fw-800' => esc_html__('800', 'iqconnetik'),
			'fw-900' => esc_html__('900', 'iqconnetik'),
		);
	}
endif;

//cutsomizer typical margin top array
if (!function_exists('iqconnetik_customizer_margin_top_array')) :
	function iqconnetik_customizer_margin_top_array()
	{
		return array(
			''      => esc_html__('Default', 'iqconnetik'),
			'mt-0'  => esc_html__('0', 'iqconnetik'),
			'mt-01' => esc_html__('0.1em', 'iqconnetik'),
			'mt-02' => esc_html__('0.2em', 'iqconnetik'),
			'mt-03' => esc_html__('0.3em', 'iqconnetik'),
			'mt-04' => esc_html__('0.4em', 'iqconnetik'),
			'mt-05' => esc_html__('0.5em', 'iqconnetik'),
			'mt-1'  => esc_html__('1em', 'iqconnetik'),
			'mt-2'  => esc_html__('2em', 'iqconnetik'),
			'mt-3'  => esc_html__('3em', 'iqconnetik'),
			'mt-4'  => esc_html__('4em', 'iqconnetik'),
			'mt-5'  => esc_html__('5em', 'iqconnetik'),
		);
	}
endif;

//cutsomizer typical margin bottom array
if (!function_exists('iqconnetik_customizer_margin_bottom_array')) :
	function iqconnetik_customizer_margin_bottom_array()
	{
		return array(
			''      => esc_html__('Default', 'iqconnetik'),
			'mb-0'  => esc_html__('0', 'iqconnetik'),
			'mb-01' => esc_html__('0.1em', 'iqconnetik'),
			'mb-02' => esc_html__('0.2em', 'iqconnetik'),
			'mb-03' => esc_html__('0.3em', 'iqconnetik'),
			'mb-04' => esc_html__('0.4em', 'iqconnetik'),
			'mb-05' => esc_html__('0.5em', 'iqconnetik'),
			'mb-1'  => esc_html__('1em', 'iqconnetik'),
			'mb-2'  => esc_html__('2em', 'iqconnetik'),
			'mb-3'  => esc_html__('3em', 'iqconnetik'),
			'mb-4'  => esc_html__('4em', 'iqconnetik'),
			'mb-5'  => esc_html__('5em', 'iqconnetik'),
		);
	}
endif;

//cutsomizer typical background overlay array
if (!function_exists('iqconnetik_customizer_background_overlay_array')) :
	function iqconnetik_customizer_background_overlay_array()
	{

		return array(
			''              => esc_html__('None', 'iqconnetik'),
			'overlay-light' => esc_html__('Light', 'iqconnetik'),
			'overlay-grey' => esc_html__('Grey', 'iqconnetik'),
			'overlay-dark' => esc_html__('Dark', 'iqconnetik'),
			'overlay-darker'  => esc_html__('Darker', 'iqconnetik'),
			'overlay-dark-blue' => esc_html__('Dark Blue', 'iqconnetik'),
			'overlay-black'  => esc_html__('Black', 'iqconnetik'),
			'overlay-main' => esc_html__('Main', 'iqconnetik'),
			'overlay-main2' => esc_html__('Main 2', 'iqconnetik'),
		);
	}
endif;

//helper div for preview
if (!function_exists('iqconnetik_action_footer_print_preview_helper_div')) :
	function iqconnetik_action_footer_print_preview_helper_div($customizer_settings)
	{
		if (is_customize_preview()) :
			$iqconnetik_view        = '';
			$iqconnetik_view_global = '';
			$iqconnetik_class       = '';

			//container width
			$iqconnetik_container_width            = iqconnetik_option('main_container_width', '1140');
			$iqconnetik_container_post_width       = iqconnetik_option('blog_single_container_width', '');
			$iqconnetik_container_blog_width       = iqconnetik_option('blog_container_width', '');
			if (iqconnetik_is_shop()) {
				$iqconnetik_view_global = is_singular() ? 'product' : 'shop';
			}
			if (is_singular('post')) {
				$iqconnetik_view_global = 'post';
				if (!empty($iqconnetik_container_post_width)) {
					$iqconnetik_view            = 'post';
					$iqconnetik_container_width = $iqconnetik_container_post_width;
				}
			}

			if ((is_home() || is_category() || is_tag() || is_date() || is_author())) {
				$iqconnetik_view_global = 'archive';
				if (!empty($iqconnetik_container_blog_width)) {
					$iqconnetik_view            = 'archive';
					$iqconnetik_container_width = $iqconnetik_container_blog_width;
				}
			}
			if ('1520' === $iqconnetik_container_width) {
				$iqconnetik_class = 'container-1520';
			}
			if ('1400' === $iqconnetik_container_width) {
				$iqconnetik_class = 'container-1400';
			}
			if ('1140' === $iqconnetik_container_width) {
				$iqconnetik_class = 'container-1140';
			}
			if ('960' === $iqconnetik_container_width) {
				$iqconnetik_class = 'container-960';
			}
			if ('720' === $iqconnetik_container_width) {
				$iqconnetik_class = 'container-720';
			}

			wp_localize_script(
				'iqconnetik-init-script',
				'iqconnetikPreviewObject',
				array(
					'view'       => $iqconnetik_view,
					'viewGlobal' => $iqconnetik_view_global,
					'container'  => $iqconnetik_class,
				)
			);

		endif;
	}
endif;
add_filter('iqconnetik_action_before_wp_footer', 'iqconnetik_action_footer_print_preview_helper_div');
