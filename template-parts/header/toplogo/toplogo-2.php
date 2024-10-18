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
<div id="toplogo" class="toplogo toplogo-2 <?php echo esc_attr($iqconnetik_font_size . ' ' . $iqconnetik_header_toplogo_bg . ' ' . $iqconnetik_header_top_tall); ?>">
    <div class="container<?php echo esc_attr($iqconnetik_fluid); ?> container-flex">
        <?php if (!empty($iqconnetik_meta)) : ?>
            <div class="media-wrap darklinks">
                <?php
                if (!empty($iqconnetik_meta['phone'])) :
                    $phone_from_meta = $iqconnetik_meta['phone'];
                    $print_phone = preg_replace("/[^0-9]/", '', $phone_from_meta);
                ?>
                    <div class="media">
                        <div class="media-body">
                            <h6><a class="phone" href="tel:<?php echo esc_attr($print_phone); ?>"><?php echo wp_kses_post($iqconnetik_meta['phone']); ?></a></h6>
                        </div>
                    </div>
                <?php
                endif; //phone
                if (!empty($iqconnetik_meta['email'])) :
                ?>
                    <div class="media">
                        <div class="media-body">
                            <h6><a href="mailto:<?php echo esc_attr($iqconnetik_meta['email']); ?>"><?php echo wp_kses_post($iqconnetik_meta['email']); ?></a></h6>
                        </div>
                    </div>
                <?php
                endif; //email 
                ?>
            </div><!-- .site-meta -->
        <?php
        endif; //! empty meta
        ?>
        <div class="logo-wrap">
            <?php get_template_part('template-parts/header/logo/logo-top', iqconnetik_template_part('logo', '1')); ?>
        </div>
        <div class="header_right_buttons darklinks">
            <?php get_template_part('template-parts/header/header-search'); ?>
        </div>
    </div>
</div><!-- eof .col- -->