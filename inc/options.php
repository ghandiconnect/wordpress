<?php

/**
 * Theme options
 *
 * @package Iqconnetik
 * @since 0.0.1
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

//default values for customizer or other theme options
if (!function_exists('iqconnetik_get_default_options_array')) :
    function iqconnetik_get_default_options_array()
    {

        //fonts choises:
        // Open Sans
        // Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese
        // Roboto
        // Lato
        // Raleway
        // Montserrat
        // PT Sans
        // Source Sans Pro
        // Oswald
        // Lora
        // Work Sans

        return array(
            'demo_number' => '',
            'colorLight' => '#ffffff',
            'colorFont' => '#777777',
            'colorFontDark' => '#9d9d9d',
            'colorBackground' => '#f5f5f5',
            'colorBorder' => '#e1e1e1',
            'colorBorderDark' => '#454545',
            'colorDark' => '#252525',
            'colorDarkGrey' => '#1d1d1d',
            'colorGrey' => '#f8f8f8',
            'colorMain' => '#ff6162',
            'colorMain2' => '#7470fc',
            'colorMain3' => '#896efd',
            'colorMain4' => '#4f74fb',
            'color_meta_icons' => '',
            'intro_block_heading' => '',
            'intro_position' => '',
            'intro_layout' => '',
            'intro_fullscreen' => '1',
            'intro_background' => 'i',
            'intro_background_image' => '',
            'intro_background_image_cover' => '1',
            'intro_background_image_fixed' => '',
            'intro_background_image_overlay' => '',
            'intro_image' => '',
            'intro_background_image_scale' => '',
            'intro_image_absolute' => '',
            'intro_image_animation' => '',
            'intro_pre_heading' => '',
            'intro_pre_heading_mt' => '',
            'intro_pre_heading_mb' => '',
            'intro_pre_heading_animation' => '',
            'intro_heading' => '',
            'intro_heading_mt' => '',
            'intro_heading_mb' => '',
            'intro_heading_animation' => '',
            'intro_description' => '',
            'intro_description_mt' => '',
            'intro_description_mb' => '',
            'intro_description_animation' => '',
            'intro_button_text_first' => '',
            'intro_button_url_first' => '',
            'intro_button_first_animation' => '',
            'intro_button_text_second' => '',
            'intro_button_url_second' => '',
            'intro_button_second_animation' => '',
            'intro_buttons_mt' => '',
            'intro_buttons_mb' => '',
            'intro_shortcode' => '',
            'intro_shortcode_mt' => '',
            'intro_shortcode_mb' => '',
            'intro_shortcode_animation' => '',
            'intro_alignment' => 'text-center',
            'intro_extra_padding_top' => '',
            'intro_extra_padding_bottom' => '',
            'intro_social_links' => '1',
            'intro_font_size' => 'fs-20',
            'logo_image_inverse' => '',
            'logo' => '1',
            'logo_primary_text' => 'IQconnetik',
            'logo_text_secondary' => '',
            'header_top_tall' => '',
            'logo_background' => '',
            'logo_padding_horizontal' => '',
            'preset' => '',
            'main_container_width' => '1170',
            'blog_container_width' => '',
            'blog_single_container_width' => '',
            'boxed' => '',
            'preloader' => 'cover',
            'box_fade_in' => '1',
            'totop' => '1',
            'assets_min' => '',
            'jquery_to_footer' => '',
            'meta_email' => 'info@iqconnetik.com',
            'meta_email_label' => 'Email Us',
            'meta_email_2' => 'example@armashop.com',
            'meta_email_2_label' => '',
            'meta_phone' => '1-800-765-4321',
            'meta_phone_label' => 'Give Us A Call',
            'meta_phone_2' => '1 234 056 77 95',
            'meta_phone_2_label' => '',
            'meta_address' => '2218 Vine Street',
            'meta_address_label' => 'Our Address',
            'meta_opening_hours' => 'Mon-Fri: 8am - 6pm',
            'meta_opening_hours_label' => '',
            'meta_telegram' => '#',
            'meta_facebook' => '#',
            'meta_instagram' => '#',
            'meta_youtube' => '#',
            'meta_twitter' => '#',
            'meta_pinterest' => '#',
            'meta_linkedin' => '#',
            'header_image_background_image_cover' => '',
            'header_image_background_image_fixed' => '',
            'header_image_background_image_overlay' => '',
            'header' => '1',
            'header_fluid' => '1',
            'header_background' => 'i',
            'header_background_image' => '',
            'header_background_image_cover' => '',
            'header_background_image_fixed' => '',
            'header_background_image_overlay' => '',
            'header_search' => 'on',
            'header_align_main_menu' => 'menu-center',
            'header_toggler_menu_main' => '1',
            'header_absolute_home_page' => '',
            'header_absolute' => '1',
            'header_transparent' => '1',
            'header_border_top' => 'full',
            'header_border_bottom' => '',
            'header_sticky' => 'always-sticky',
            'header_font_size' => 'fs-16',
            'header_button_text' => 'Request a quote',
            'header_button_image' => '',
            'header_button_url' => '#',
            'header_toplogo_options_heading' => '',
            'toplogo' => '1',
            'toplogo_background' => 'l',
            'toplogo_font_size' => 'fs-16',
            'header_topline_options_heading' => '',
            'topline' => '',
            'topline_fluid' => '1',
            'topline_background' => 'l',
            'topline_font_size' => 'fs-16',
            'topline_border_top' => '',
            'topline_border_bottom' => '',
            'topline_text' => 'Do you need help? Here Us:',
            'topline_meta_opening_hours' => '1',
            'topline_meta_mail' => '1',
            'topline_meta_phone' => '1',
            'topline_meta_address' => '',
            'header_logo_background' => '',
            'header_logo_modal_text' => '',
            'title' => '1',
            'title_fluid' => '',
            'title_show_title' => '1',
            'title_show_breadcrumbs' => '1',
            'title_background' => 'i',
            'title_border_top' => '',
            'title_border_bottom' => '',
            'title_extra_padding_top' => '',
            'title_extra_padding_bottom' => '',
            'title_font_size' => 'fs-16',
            'title_hide_taxonomy_name' => '1',
            'title_background_image' => '',
            'title_background_image_cover' => '1',
            'title_background_image_fixed' => '',
            'title_background_image_overlay' => 'overlay-dark-blue',
            'main_sidebar_width' => '30',
            'main_gap_width' => '100',
            'main_sidebar_sticky' => '',
            'main_extra_padding_top' => '',
            'main_extra_padding_bottom' => '',
            'main_font_size' => 'fs-16',
            'sidebar_font_size' => '',
            'main_version' => 'l',
            '404_heading_image' => '',
            '404_heading' => '404',
            '404_text_bottom_line' => '',
            '404_background' => 'i',
            '404_background_image' => '',
            '404_background_image_overlay' => '',
            '404_extra_padding_top' => '',
            '404_extra_padding_bottom' => '',
            '404_content_align' => 'content-center',
            'footer_top' => '4',
            'footer_top_layout_gap' => '30',
            'footer_top_fluid' => '',
            'footer_top_heading' => '',
            'footer_top_heading_mt' => '',
            'footer_top_heading_mb' => '',
            'footer_top_heading_animation' => '',
            'footer_top_description' => '',
            'footer_top_description_mt' => '',
            'footer_top_description_mb' => '',
            'footer_top_description_animation' => '',
            'footer_top_shortcode' => '',
            'footer_top_shortcode_mt' => '',
            'footer_top_shortcode_mb' => '',
            'footer_top_shortcode_animation' => '',
            'footer_top_background' => 'i',
            'footer_top_border_top' => '',
            'footer_top_border_bottom' => '',
            'footer_top_extra_padding_top' => '',
            'footer_top_extra_padding_bottom' => '',
            'footer_top_font_size' => 'fs-15',
            'footer_top_background_image' => '',
            'footer_top_background_image_cover' => '1',
            'footer_top_background_image_fixed' => '',
            'footer_top_background_image_overlay' => '',
            'footer_top_bottom_section_options_heading' => '',
            'footer_top_bottom_section' => '',
            'footer_top_bottom_section_home_page_only' => '1',
            'footer_top_bottom_section_fluid' => '',
            'footer_top_bottom_section_heading' => '',
            'footer_top_bottom_section_heading_mb' => '',
            'footer_top_bottom_section_description' => '',
            'footer_top_bottom_section_description_mb' => '',
            'footer_top_bottom_section_shortcode' => '',
            'footer_top_bottom_section_background' => '',
            'footer_top_bottom_section_border_top' => 'container',
            'footer_top_bottom_section_border_bottom' => 'container',
            'footer_top_bottom_section_extra_padding_top' => '',
            'footer_top_bottom_section_extra_padding_bottom' => '',
            'footer_top_bottom_section_font_size' => 'fs-14',
            'footer_top_bottom_section_background_image' => '',
            'footer_top_bottom_section_background_image_cover' => '',
            'footer_top_bottom_section_background_image_fixed' => '',
            'footer_top_bottom_section_background_image_overlay' => '',
            'footer' => '1',
            'footer_layout_gap' => '50',
            'footer_fluid' => '',
            'footer_background' => 'i',
            'footer_border_top' => '',
            'footer_border_bottom' => 'full',
            'footer_extra_padding_top' => '',
            'footer_extra_padding_bottom' => '',
            'footer_font_size' => 'fs-16',
            'footer_background_image' => '',
            'footer_background_image_cover' => '',
            'footer_background_image_fixed' => '',
            'footer_background_image_overlay' => '',
            'copyright' => '1',
            'copyright_text' => '© [year] Copyright',
            'copyright_fluid' => '',
            'copyright_background' => 'i',
            'copyright_extra_padding_top' => '',
            'copyright_extra_padding_bottom' => '',
            'copyright_font_size' => 'fs-16',
            'copyright_background_image' => '',
            'copyright_background_image_cover' => '',
            'copyright_background_image_fixed' => '',
            'copyright_background_image_overlay' => '',
            'font_body_heading' => '',
            'font_body' => '{"font":"Poppins","variant":["100","100italic","200","200italic","300","300italic","regular","italic","500","500italic","600","600italic","700","700italic","800","800italic","900","900italic"],"subset":["latin-ext","latin"]}',
            'font_headings_heading' => '',
            'font_headings' => '{"font":"Montserrat","variant":["100","100italic","200","200italic","300","300italic","regular","italic","500","500italic","600","600italic","700","700italic","800","800italic","900","900italic"],"subset":["latin-ext","latin"]}',
            'blog_layout' => '',
            'blog_sidebar_position' => 'right',
            'blog_page_name' => 'Blog',
            'blog_show_full_text' => '',
            'blog_excerpt_length' => '55',
            'blog_read_more_text' => 'Read More',
            'blog_hide_taxonomy_type_name' => '1',
            'blog_meta_options_heading' => '',
            'blog_hide_meta_icons' => '',
            'blog_show_author' => '1',
            'blog_show_author_avatar' => '1',
            'blog_before_author_word' => 'By',
            'blog_show_date' => '',
            'blog_before_date_word' => '',
            'blog_show_categories' => '1',
            'blog_show_tags' => '',
            'blog_before_tags_word' => '',
            'blog_show_views' => '',
            'blog_before_views_word' => '',
            'blog_show_likes' => '',
            'blog_before_likes_word' => '',
            'blog_show_comments_link' => '',
            'blog_share_options_heading' => '',
            'blog_share_facebook' => '',
            'blog_share_twitter' => '',
            'blog_share_telegram' => '',
            'blog_share_pinterest' => '',
            'blog_share_linkedin' => '',
            'blog_single_sidebar_position' => 'right',
            'blog_single_show_author_bio' => '',
            'blog_single_author_bio_about_word' => 'Author',
            'blog_single_post_nav_heading' => '',
            'blog_single_post_nav' => 'bg',
            'blog_single_post_nav_word_prev' => '< Previous Post',
            'blog_single_post_nav_word_next' => 'Next Post >',
            'blog_single_related_posts_heading' => '',
            'blog_single_related_posts' => '',
            'blog_single_related_posts_title' => 'Related Posts',
            'blog_single_related_posts_number' => '2',
            'blog_single_meta_options_heading' => '',
            'blog_single_hide_meta_icons' => '',
            'blog_single_show_author' => '1',
            'blog_single_show_author_avatar' => '1',
            'blog_single_before_author_word' => 'By',
            'blog_single_show_date' => '',
            'blog_single_before_date_word' => '',
            'blog_single_show_categories' => '1',
            'blog_single_show_tags' => '1',
            'blog_single_before_tags_word' => '',
            'blog_single_show_views' => '',
            'blog_single_before_views_word' => '',
            'blog_single_show_likes' => '',
            'blog_single_show_comments_link' => '',
            'blog_single_comments_title_reply' => 'Leave a Comment  ',
            'blog_single_share_options_heading' => '',
            'blog_single_share_facebook' => '',
            'blog_single_share_twitter' => '',
            'blog_single_share_telegram' => '',
            'blog_single_share_pinterest' => '',
            'blog_single_share_linkedin' => '',
            'animation_enabled' => '1',
            'animation_sidebar_widgets' => '',
            'animation_footer_top_widgets' => '',
            'animation_footer_widgets' => 'fadeInUp',
            'animation_feed_posts' => '',
            'animation_feed_posts_thumbnail' => '',
        );
    }
endif;

//get theme option from default or from customizer
if (!function_exists('iqconnetik_option')) :
    function iqconnetik_option($iqconnetik_option_name, $iqconnetik_default_value = '')
    {
        //get theme defaults
        $iqconnetik_defaults = iqconnetik_get_default_options_array();

        //lowest priority is basic default value from theme defaults
        $iqconnetik_return = (!empty($iqconnetik_defaults[$iqconnetik_option_name])) ? $iqconnetik_defaults[$iqconnetik_option_name] : $iqconnetik_default_value;

        unset($iqconnetik_defaults);

        //theme_mods are higher - if not empty - overriding value from theme default
        $iqconnetik_return = get_theme_mod($iqconnetik_option_name, $iqconnetik_return);

        if (isset($_GET[$iqconnetik_option_name])) {
            $iqconnetik_return = sanitize_text_field($_GET[$iqconnetik_option_name]);
        }

        return $iqconnetik_return;
    }
endif;

//layout options array. Used global in customizer and for categories
if (!function_exists('iqconnetik_get_feed_layout_options')) :
    function iqconnetik_get_feed_layout_options($iqconnetik_category = false)
    {
        if (empty($iqconnetik_category)) {
            $iqconnetik_first_element = esc_html__('Default - Top featured image', 'iqconnetik');
        } else {
            $iqconnetik_first_element = esc_html__('Inherit from Customizer settings', 'iqconnetik');
        }

        $iqconnetik_return = apply_filters(
            'iqconnetik_feed_layout_options',
            array(
                ''                         => $iqconnetik_first_element,
                'default-with-padding'       => esc_html__('Top featured with padding', 'iqconnetik'),
                'default-with-background'  => esc_html__('Top featured image with background', 'iqconnetik'),
                'default-half-image'       => esc_html__('Half thumbnail', 'iqconnetik'),
            )
        );

        return $iqconnetik_return;
    }
endif;

//gap options array. Used global in customizer and for categories
if (!function_exists('iqconnetik_get_feed_layout_gap_options')) :
    function iqconnetik_get_feed_layout_gap_options($iqconnetik_category = false)
    {
        if (empty($iqconnetik_category)) {
            $iqconnetik_first_element = esc_html__('Default - none', 'iqconnetik');
        } else {
            $iqconnetik_first_element = esc_html__('Inherit from Customizer settings', 'iqconnetik');
        }

        $iqconnetik_return = apply_filters(
            'iqconnetik_feed_layout_gap_options',
            array(
                ''    => $iqconnetik_first_element,
                '1'   => esc_html__('1px', 'iqconnetik'),
                '2'   => esc_html__('2px', 'iqconnetik'),
                '3'   => esc_html__('3px', 'iqconnetik'),
                '4'   => esc_html__('4px', 'iqconnetik'),
                '5'   => esc_html__('5px', 'iqconnetik'),
                '10'  => esc_html__('10px', 'iqconnetik'),
                '15'  => esc_html__('15px', 'iqconnetik'),
                '20'  => esc_html__('20px', 'iqconnetik'),
                '30'  => esc_html__('30px', 'iqconnetik'),
                '40'  => esc_html__('40px', 'iqconnetik'),
                '50'  => esc_html__('50px', 'iqconnetik'),
                '60'  => esc_html__('60px', 'iqconnetik'),
                '80'  => esc_html__('80px', 'iqconnetik'),
                '100' => esc_html__('100px', 'iqconnetik'),
                '150' => esc_html__('150px', 'iqconnetik'),
            )
        );

        return $iqconnetik_return;
    }
endif;


//layout options array. Used global in customizer and for single posts
if (!function_exists('iqconnetik_get_post_layout_options')) :
    function iqconnetik_get_post_layout_options($iqconnetik_category = false)
    {
        if (empty($iqconnetik_category)) {
            $iqconnetik_first_element = esc_html__('Default - top featured image', 'iqconnetik');
        } else {
            $iqconnetik_first_element = esc_html__('Inherit from Customizer settings', 'iqconnetik');
        }

        $iqconnetik_return = apply_filters(
            'iqconnetik_post_layout_options',
            array(
                ''                    => $iqconnetik_first_element,
                'wide-image'          => esc_html__('Wide featured image', 'iqconnetik'),
                'meta-top'            => esc_html__('Post meta above featured image', 'iqconnetik'),
                'meta-image'          => esc_html__('Post meta on featured image', 'iqconnetik'),
                'meta-side'           => esc_html__('Side post meta', 'iqconnetik'),
                'bottom-meta'         => esc_html__('Bottom post meta', 'iqconnetik'),
                'title-section-image' => esc_html__('Title section featured image', 'iqconnetik'),
            )
        );

        return $iqconnetik_return;
    }
endif;


//sidebar options array. Used global in customizer and for categories
if (!function_exists('iqconnetik_get_sidebar_position_options')) :
    function iqconnetik_get_sidebar_position_options($iqconnetik_category = false)
    {
        if (empty($iqconnetik_category)) {
            $iqconnetik_first_element = esc_html__('Default', 'iqconnetik');
        } else {
            $iqconnetik_first_element = esc_html__('Inherit from Customizer settings', 'iqconnetik');
        }

        $iqconnetik_return = array(
            'right' => esc_html__('Right sidebar', 'iqconnetik'),
            'left'  => esc_html__('Left sidebar', 'iqconnetik'),
            'no'    => esc_html__('No sidebar', 'iqconnetik'),
        );

        if ($iqconnetik_category) {
            $iqconnetik_return = array($iqconnetik_first_element) + $iqconnetik_return;
        }

        return $iqconnetik_return;
    }
endif;

//animation options array.
if (!function_exists('iqconnetik_get_animation_options')) :
    function iqconnetik_get_animation_options()
    {

        $iqconnetik_return = array(
            ''             => esc_html__('None', 'iqconnetik'),
            'bounce'       => esc_html__('bounce', 'iqconnetik'),
            'flash'        => esc_html__('flash', 'iqconnetik'),
            'pulse'        => esc_html__('pulse', 'iqconnetik'),
            'rubberBand'   => esc_html__('rubberBand', 'iqconnetik'),
            'shake'        => esc_html__('shake', 'iqconnetik'),
            'headShake'    => esc_html__('headShake', 'iqconnetik'),
            'swing'        => esc_html__('swing', 'iqconnetik'),
            'tada'         => esc_html__('tada', 'iqconnetik'),
            'wobble'       => esc_html__('wobble', 'iqconnetik'),
            'jello'        => esc_html__('jello', 'iqconnetik'),
            'heartBeat'    => esc_html__('heartBeat', 'iqconnetik'),
            'bounceIn'     => esc_html__('bounceIn', 'iqconnetik'),
            'fadeInIqconnetik'       => esc_html__('fadeIn', 'iqconnetik'),
            'fadeInDown'   => esc_html__('fadeInDown', 'iqconnetik'),
            'fadeInLeft'   => esc_html__('fadeInLeft', 'iqconnetik'),
            'fadeInRight'  => esc_html__('fadeInRight', 'iqconnetik'),
            'fadeInUp'     => esc_html__('fadeInUp', 'iqconnetik'),
            'flip'         => esc_html__('flip', 'iqconnetik'),
            'flipInX'      => esc_html__('flipInX', 'iqconnetik'),
            'flipInY'      => esc_html__('flipInY', 'iqconnetik'),
            'lightSpeedIn' => esc_html__('lightSpeedIn', 'iqconnetik'),
            'jackInTheBox' => esc_html__('jackInTheBox', 'iqconnetik'),
            'zoomIn'       => esc_html__('zoomIn', 'iqconnetik'),
        );

        return $iqconnetik_return;
    }
endif;

if (!class_exists('Iqconnetik_Color')) {
    class Iqconnetik_Color
    {
        public $hex;
        public $rgb;
        public $hsl;

        public function __construct($hex)
        {
            $hex = str_replace("#", "", $hex);
            $this->hex = $hex;
            $this->rgb = $this->hexToRgb($this->hex);
            $this->hsl = $this->toHSL($this->rgb);
        }
        public function back()
        {
            $this->rgb = $this->HSLtoRGB($this->hsl);
            $this->hex = $this->rgb2hex($this->rgb);
        }
        public function adjust_hue($newVal)
        {
            $this->hsl[0] += $newVal;
            $this->back();
        }
        public function saturate($newVal)
        {
            $this->hsl[1] += $newVal;
            $this->back();
        }
        public function desaturate($newVal)
        {
            $this->hsl[1] -= $newVal;
            $this->back();
        }
        public function lighten($newVal)
        {
            $this->hsl[2] += $newVal;
            $this->back();
        }
        public function darken($newVal)
        {
            $this->hsl[2] -= $newVal;
            $this->back();
        }
        public function get_all()
        {
            return array(
                'hex' => $this->hex,
                'rgb' => $this->rgb,
                'hls' => $this->hsl,
            );
        }
        public function hexToRgb($hex)
        {
            if (strlen($hex) == 3) {
                $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
                $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
                $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
            } else {
                $r = hexdec(substr($hex, 0, 2));
                $g = hexdec(substr($hex, 2, 2));
                $b = hexdec(substr($hex, 4, 2));
            }
            $rgb = array($r, $g, $b);
            return $rgb; // returns an array with the rgb values
        }
        public function rgbString()
        {
            return implode(", ", $this->rgb);
        }
        public function toHSL($rgb)
        {
            $red = $rgb[0];
            $green = $rgb[1];
            $blue = $rgb[2];
            $max = max($red, $green, $blue);
            $min = min($red, $green, $blue);

            $lightness = $max + $min;

            if ($max === $min) {
                $saturation = $hue = 0;
            } else {
                $diff = $max - $min;

                if ($lightness < 255) $saturation = $diff / $lightness;
                else $saturation = $diff / (510 - $lightness);

                if ($max === $red) $hue = 60 * ($green - $blue) / $diff;
                elseif ($max === $green) $hue = 60 * ($blue - $red) / $diff + 120;
                elseif ($max === $blue) $hue = 60 * ($red - $green) / $diff + 240;
            }

            return array(fmod($hue, 360), $saturation * 100, $lightness / 5.1);
        }
        public function hueToRGB($p, $q, $decHue)
        {
            if ($decHue < 0) $decHue += 1;
            else if ($decHue > 1) $decHue -= 1;

            if ($decHue * 6 < 1) return $p + ($q - $p) * $decHue * 6;
            if ($decHue * 2 < 1) return $q;
            if ($decHue * 3 < 2) return $p + ($q - $p) * (2 / 3 - $decHue) * 6;

            return $p;
        }
        // hue from 0 to 360, saturation and lightness from 0 to 100
        public function HSLtoRGB($hsl)
        {
            $hue = $hsl[0];
            $saturation = $hsl[1];
            $lightness = $hsl[2];
            if ($hue < 0) $hue += 360;

            $decHue = $hue / 360;
            $decSaturation = min(100, max(0, $saturation)) / 100;
            $decLightness = min(100, max(0, $lightness)) / 100;

            $q = $decLightness <= 0.5 ? $decLightness * ($decSaturation + 1) : $decLightness + $decSaturation - $decLightness * $decSaturation;
            $p = $decLightness * 2 - $q;

            $red = $this->hueToRGB($p, $q, $decHue + 1 / 3) * 255;
            $green = $this->hueToRGB($p, $q, $decHue) * 255;
            $blue = $this->hueToRGB($p, $q, $decHue - 1 / 3) * 255;

            return array(round($red), round($green), round($blue));
        }
        function rgb2hex($rgb)
        {
            $hex = '';
            $hex .= str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
            $hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
            $hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);

            return $hex; // returns the hex value including the number sign (#)
        }
    }
}

if (!function_exists('sanitize_rgba_color')) {
    function sanitize_rgba_color($color)
    {
        if (empty($color) || is_array($color)) {
            return 'rgba(0,0,0,0)';
        }

        // If string does not start with 'rgba', then treat as hex
        // sanitize the hex color and finally convert hex to rgba
        if (false === strpos($color, 'rgba')) {
            return sanitize_hex_color($color);
        }

        // By now we know the string is formatted as an rgba color so we need to further sanitize it.
        $color = str_replace(' ', '', $color);
        sscanf($color, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha);

        return 'rgba(' . $red . ',' . $green . ',' . $blue . ',' . $alpha . ')';
    }
}

//get :root colors inline styles string
if (!function_exists('iqconnetik_get_root_colors_inline_styles_string')) :
    function iqconnetik_get_root_colors_inline_styles_string()
    {
        //colors
        $iqconnetik_colors_string = '';
        // colorFont
        // colorFontDark
        // colorLight
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

        $iqconnetik_colors_string .= iqconnetik_option('colorLight', '') ? '--colorLight:' . sanitize_hex_color(iqconnetik_option('colorLight', '')) . ';' : '';
        $iqconnetik_colors_string .= iqconnetik_option('colorFont', '') ? '--colorFont:' . sanitize_hex_color(iqconnetik_option('colorFont', '')) . ';' : '';
        $iqconnetik_colors_string .= iqconnetik_option('colorFontDark', '') ? '--colorFontDark:' . sanitize_hex_color(iqconnetik_option('colorFontDark', '')) . ';' : '';
        $iqconnetik_colors_string .= iqconnetik_option('colorBackground', '') ? '--colorBackground:' . sanitize_hex_color(iqconnetik_option('colorBackground', '')) . ';' : '';
        $iqconnetik_colors_string .= iqconnetik_option('colorBorder', '') ? '--colorBorder:' . sanitize_hex_color(iqconnetik_option('colorBorder', '')) . ';' : '';
        $iqconnetik_colors_string .= iqconnetik_option('colorBorderDark', '') ? '--colorBorderDark:' . sanitize_hex_color(iqconnetik_option('colorBorderDark', '')) . ';' : '';
        $iqconnetik_colors_string .= iqconnetik_option('colorDark', '') ? '--colorDark:' . sanitize_hex_color(iqconnetik_option('colorDark', '')) . ';' : '';
        $iqconnetik_colors_string .= iqconnetik_option('colorDarkGrey', '') ? '--colorDarkGrey:' . sanitize_hex_color(iqconnetik_option('colorDarkGrey', '')) . ';' : '';
        $iqconnetik_colors_string .= iqconnetik_option('colorGrey', '') ? '--colorGrey:' . sanitize_hex_color(iqconnetik_option('colorGrey', '')) . ';' : '';
        $iqconnetik_colors_string .= iqconnetik_option('colorMain', '') ? '--colorMain:' . sanitize_hex_color(iqconnetik_option('colorMain', '')) . ';' : '';
        $iqconnetik_colors_string .= iqconnetik_option('colorMain2', '') ? '--colorMain2:' . sanitize_hex_color(iqconnetik_option('colorMain2', '')) . ';' : '';
        $iqconnetik_colors_string .= iqconnetik_option('colorMain3', '') ? '--colorMain3:' . sanitize_hex_color(iqconnetik_option('colorMain3', '')) . ';' : '';
        $iqconnetik_colors_string .= iqconnetik_option('colorMain4', '') ? '--colorMain4:' . sanitize_hex_color(iqconnetik_option('colorMain4', '')) . ';' : '';

        //RGB Colors
        // colorMainRGB
        $colorMainRGB = new Iqconnetik_Color(iqconnetik_option('colorMain', ''));
        $colorMainRGB = $colorMainRGB->rgbString();
        $iqconnetik_colors_string .= '--colorMainRGB:' . $colorMainRGB . ';';

        // colorMain2RGB
        $colorMain2RGB = new Iqconnetik_Color(iqconnetik_option('colorMain2', ''));
        $colorMain2RGB = $colorMain2RGB->rgbString();
        $iqconnetik_colors_string .= '--colorMain2RGB:' . $colorMain2RGB . ';';

        // colorMain3RGB
        $colorMain3RGB = new Iqconnetik_Color(iqconnetik_option('colorMain3', ''));
        $colorMain3RGB = $colorMain3RGB->rgbString();
        $iqconnetik_colors_string .= '--colorMain3RGB:' . $colorMain3RGB . ';';

        // colorMain4RGB
        $colorMain4RGB = new Iqconnetik_Color(iqconnetik_option('colorMain4', ''));
        $colorMain4RGB = $colorMain4RGB->rgbString();
        $iqconnetik_colors_string .= '--colorMain4RGB:' . $colorMain4RGB . ';';

        // colorFontRGB
        $colorFontRGB = new Iqconnetik_Color(iqconnetik_option('colorFont', ''));
        $colorFontRGB = $colorFontRGB->rgbString();
        $iqconnetik_colors_string .= '--colorFontRGB:' . $colorFontRGB . ';';

        // colorFontDarkRGB
        $colorFontDarkRGB = new Iqconnetik_Color(iqconnetik_option('colorFontDark', ''));
        $colorFontDarkRGB = $colorFontDarkRGB->rgbString();
        $iqconnetik_colors_string .= '--colorFontDarkRGB:' . $colorFontDarkRGB . ';';

        // colorDarkGreyRGB
        $colorDarkGreyRGB = new Iqconnetik_Color(iqconnetik_option('colorDarkGrey', ''));
        $colorDarkGreyRGB = $colorDarkGreyRGB->rgbString();
        $iqconnetik_colors_string .= '--colorDarkGreyRGB:' . $colorDarkGreyRGB . ';';

        // colorGreyRGB
        $colorGreyRGB = new Iqconnetik_Color(iqconnetik_option('colorGrey', ''));
        $colorGreyRGB = $colorGreyRGB->rgbString();
        $iqconnetik_colors_string .= '--colorGreyRGB:' . $colorGreyRGB . ';';

        // colorDarkRGB
        $colorDarkRGB = new Iqconnetik_Color(iqconnetik_option('colorDark', ''));
        $colorDarkRGB = $colorDarkRGB->rgbString();
        $iqconnetik_colors_string .= '--colorDarkRGB:' . $colorDarkRGB . ';';

        // colorLightRGB
        $colorLightRGB = new Iqconnetik_Color(iqconnetik_option('colorLight', ''));
        $colorLightRGB = $colorLightRGB->rgbString();
        $iqconnetik_colors_string .= '--colorLightRGB:' . $colorLightRGB . ';';

        // colorBackgroundRGB
        $colorBackgroundRGB = new Iqconnetik_Color(iqconnetik_option('colorBackground', ''));
        $colorBackgroundRGB = $colorBackgroundRGB->rgbString();
        $iqconnetik_colors_string .= '--colorBackgroundRGB:' . $colorBackgroundRGB . ';';

        // colorBorderRGB
        $colorBorderRGB = new Iqconnetik_Color(iqconnetik_option('colorBorder', ''));
        $colorBorderRGB = $colorBorderRGB->rgbString();
        $iqconnetik_colors_string .= '--colorBorderRGB:' . $colorBorderRGB . ';';

        // colorMainDarken10
        $colorMainDarken10 = new Iqconnetik_Color(iqconnetik_option('colorMain', ''));
        $colorMainDarken10->darken(10);
        $iqconnetik_colors_string .= '--colorMainDarken10:#' . $colorMainDarken10->hex . ';';

        // colorMainLighter30
        $colorMainLighter30 = new Iqconnetik_Color(iqconnetik_option('colorMain', ''));
        $colorMainLighter30->lighten(30);
        $iqconnetik_colors_string .= '--colorMainLighter30:#' . $colorMainLighter30->hex . ';';

        // colorMain2Darken10
        $colorMain2Darken10 = new Iqconnetik_Color(iqconnetik_option('colorMain2', ''));
        $colorMain2Darken10->darken(10);
        $iqconnetik_colors_string .= '--colorMain2Darken10:#' . $colorMain2Darken10->hex . ';';

        // colorMain3Darken10
        $colorMain3Darken10 = new Iqconnetik_Color(iqconnetik_option('colorMain3', ''));
        $colorMain3Darken10->darken(10);
        $iqconnetik_colors_string .= '--colorMain3Darken10:#' . $colorMain3Darken10->hex . ';';

        // font
        $fontBody       = '';
        $fontSecondary   = '';

        $huphoria_font_body     = json_decode(iqconnetik_option('font_body', '{"font":"","variant": [],"subset":[]}'));
        $huphoria_font_secondary = json_decode(iqconnetik_option('font_headings', '{"font":"","variant": [],"subset":[]}'));

        $huphoria_font_body_font = '';
        if (!empty($huphoria_font_body->font)) {
            $huphoria_font_body_font = $huphoria_font_body->font;
        } else {
            $huphoria_font_body_font = 'Arial, Helvetica Neue, Helvetica, sans-serif';
        }
        $fontBody = "--fontBody: \"{$huphoria_font_body_font}\" !important;";

        $huphoria_font_secondary_font = '';
        if (!empty($huphoria_font_secondary->font)) {
            $huphoria_font_secondary_font = $huphoria_font_secondary->font;
        } else {
            $huphoria_font_body_font = 'Playfair Display, serif';
        }
        $fontSecondary = "--fontSecondary: \"{$huphoria_font_secondary_font}\" !important;";

        $iqconnetik_colors_string .= $fontBody;
        $iqconnetik_colors_string .= $fontSecondary;

        return $iqconnetik_colors_string;
    }
endif;
