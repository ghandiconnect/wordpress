<?php

/**
 * The header template file
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
//options
$iqconnetik_transparent       = iqconnetik_option('header_transparent') ? 'transparent' : '';
$iqconnetik_header_background = iqconnetik_option('header_background', '');
$iqconnetik_font_size         = iqconnetik_option('header_font_size', '');

$iqconnetik_background_image = iqconnetik_section_background_image_array('header');

$iqconnetik_search = iqconnetik_option('header_search', '');

//meta
$iqconnetik_meta                 = iqconnetik_get_theme_meta();

get_template_part('template-parts/header/toplogo/toplogo', iqconnetik_template_part('toplogo', ''));
?>
<div id="overlay"></div>
<header id="header" class="page_header_side header_side_right header-7 <?php echo esc_attr($iqconnetik_header_background . ' ' . $iqconnetik_font_size . ' ' . $iqconnetik_transparent); ?>">
    <span class="toggle_menu_side"><span></span></span>
    <div class="scrollbar-macosx">
        <div class="side_header_inner <?php echo esc_attr($iqconnetik_background_image['class']); ?>" <?php echo (!empty($iqconnetik_background_image['url'])) ? 'style="background-image: url(' . esc_url($iqconnetik_background_image['url']) . ');"' : ''; ?>>
            <div class="header-side-menu">
                <nav class="mainmenu_side_wrapper">
                    <?php wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_class'     => 'nav menu-side-click',
                        'container'      => 'ul'
                    )); ?>
                </nav>
            </div>
            <div class="social-links-wrap">
                <?php iqconnetik_social_links(); ?>
            </div>
            <?php if (!empty($iqconnetik_search)) {
                get_search_form();
            }; ?>
            <?php if (!empty($iqconnetik_meta)) : ?>
                <div class="site-meta darklinks">
                    <?php
                    if (!empty($iqconnetik_meta['phone'])) :
                        $phone_from_meta = $iqconnetik_meta['phone'];
                        $print_phone = preg_replace("/[^0-9]/", '', $phone_from_meta);
                    ?>
                        <span class="icon-inline">
                            <?php iqconnetik_icon('phone'); ?>
                            <?php if (!empty($iqconnetik_meta['phone_label'])) : ?>
                                <h6 class="phone-label mt-0 mb-0"><?php echo wp_kses_post($iqconnetik_meta['phone_label']); ?></h6><br>
                            <?php endif; ?>
                            <a class="phone" href="tel:<?php echo esc_attr($print_phone); ?>"><?php echo wp_kses_post($iqconnetik_meta['phone']); ?></a>
                        </span>
                    <?php
                    endif; //phone
                    if (!empty($iqconnetik_meta['email'])) :
                    ?>
                        <span class="icon-inline">
                            <?php iqconnetik_icon('email'); ?>
                            <?php if (!empty($iqconnetik_meta['email_label'])) : ?>
                                <h6 class="email-label mt-0 mb-0"><?php echo wp_kses_post($iqconnetik_meta['email_label']); ?></h6><br>
                            <?php endif; ?>
                            <a href="mailto:<?php echo esc_attr($iqconnetik_meta['email']); ?>"><?php echo wp_kses_post($iqconnetik_meta['email']); ?></a>
                        </span>
                    <?php
                    endif; //email
                    if (!empty($iqconnetik_meta['address'])) :
                    ?>
                        <span class="icon-inline">
                            <?php iqconnetik_icon('map-marker'); ?>
                            <?php if (!empty($iqconnetik_meta['address_label'])) : ?>
                                <h6 class="address-label mt-0 mb-0"><?php echo wp_kses_post($iqconnetik_meta['address_label']); ?></h6><br>
                            <?php endif; ?>
                            <span class="grey"><?php echo wp_kses_post($iqconnetik_meta['address']); ?></span>
                        </span>
                    <?php
                    endif; //address
                    if (!empty($iqconnetik_meta['opening_hours'])) :
                    ?>
                        <span class="icon-inline">
                            <?php iqconnetik_icon('clock-outline'); ?>
                            <?php if (!empty($iqconnetik_meta['opening_hours_label'])) : ?>
                                <h6 class="hours-label mt-0 mb-0"><?php echo wp_kses_post($iqconnetik_meta['opening_hours_label']); ?></h6><br>
                            <?php endif; ?>
                            <span class="grey"><?php echo wp_kses_post($iqconnetik_meta['opening_hours']); ?></span>
                        </span>
                    <?php
                    endif; //opening_hours
                    ?>
                </div><!-- .site-meta -->
            <?php
            endif; //! empty meta
            ?>
        </div><!-- eof .side_header_inner -->
    </div><!-- eof .scrollbar-macosx-->
</header><!-- eof .page_header_side-->