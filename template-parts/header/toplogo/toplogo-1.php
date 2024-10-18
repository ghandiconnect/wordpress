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
$iqconnetik_fluid             = iqconnetik_option('header_fluid') ? '-fluid' : '';
$iqconnetik_header_top_tall   = iqconnetik_option('header_top_tall') ? 'header-tall' : '';
$iqconnetik_header_toplogo_bg = iqconnetik_option('toplogo_background', 'l');
$iqconnetik_font_size         = iqconnetik_option('toplogo_font_size', '');

//meta
$iqconnetik_meta                 = iqconnetik_get_theme_meta();

?>
<div id="toplogo" class="toplogo toplogo-1 <?php echo esc_attr($iqconnetik_font_size . ' ' . $iqconnetik_header_toplogo_bg . ' ' . $iqconnetik_header_top_tall); ?>">
    <div class="container<?php echo esc_attr($iqconnetik_fluid); ?> container-flex">
        <div class="logo-wrap">
            <?php get_template_part('template-parts/header/logo/logo-top', iqconnetik_template_part('logo', '1')); ?>
        </div>
        <?php if (!empty($iqconnetik_meta)) : ?>
            <div class="toplogo-includes darklinks">
                <?php
                if (!empty($iqconnetik_meta['address'])) :
                ?>
                    <div class="media">
                        <div class="icon-styled color-main">
                            <?php iqconnetik_icon('map-marker'); ?>
                        </div>
                        <div class="media-body">
                            <?php if (!empty($iqconnetik_meta['address_label'])) : ?>
                                <h6 class="address-label"><?php echo wp_kses_post($iqconnetik_meta['address_label']); ?></h6>
                            <?php endif; ?>
                            <p class="grey"><?php echo wp_kses_post($iqconnetik_meta['address']); ?></p>
                        </div>
                    </div>
                <?php
                endif; //address
                if (!empty($iqconnetik_meta['email'])) :
                ?>
                    <div class="media">
                        <div class="icon-styled color-main">
                            <?php iqconnetik_icon('email') ?>
                        </div>
                        <div class="media-body">
                            <?php if (!empty($iqconnetik_meta['email_label'])) : ?>
                                <h6 class="email-label"><?php echo wp_kses_post($iqconnetik_meta['email_label']); ?></h6>
                            <?php endif; ?>
                            <a href="mailto:<?php echo esc_attr($iqconnetik_meta['email']); ?>"><?php echo wp_kses_post($iqconnetik_meta['email']); ?></a>
                        </div>
                    </div>
                <?php
                endif; //email 
                if (!empty($iqconnetik_meta['phone'])) :
                    $phone_from_meta = $iqconnetik_meta['phone'];
                    $print_phone = preg_replace("/[^0-9]/", '', $phone_from_meta);
                ?>
                    <div class="media">
                        <div class="icon-styled color-main">
                            <?php iqconnetik_icon('phone-outline') ?>
                        </div>
                        <div class="media-body">
                            <?php if (!empty($iqconnetik_meta['phone_label'])) : ?>
                                <h6 class="phone-label"><?php echo wp_kses_post($iqconnetik_meta['phone_label']); ?></h6>
                            <?php endif; ?>
                            <a class="phone" href="tel:<?php echo esc_attr($print_phone); ?>"><?php echo wp_kses_post($iqconnetik_meta['phone']); ?></a>
                        </div>
                    </div>
                <?php
                endif; //phone
                ?>
                <div class="hidden-lg">
                    <?php iqconnetik_social_links(); ?>
                </div>
            </div><!-- .site-meta -->
        <?php
        endif; //! empty meta
        ?>
    </div>
</div><!-- eof .col- -->