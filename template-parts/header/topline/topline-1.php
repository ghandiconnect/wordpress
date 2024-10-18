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

//meta
$iqconnetik_meta                 = iqconnetik_get_theme_meta();

$iqconnetik_fluid                = iqconnetik_option('topline_fluid') ? '-fluid' : '';
$iqconnetik_topline_background   = iqconnetik_option('topline_background', '');
$iqconnetik_font_size            = iqconnetik_option('topline_font_size', '');

$iqconnetik_topline_meta_mail    = iqconnetik_option('topline_meta_mail');
$iqconnetik_topline_meta_phone   = iqconnetik_option('topline_meta_phone');
$iqconnetik_topline_meta_address = iqconnetik_option('topline_meta_address');
$iqconnetik_topline_meta_opening_hours = iqconnetik_option('topline_meta_opening_hours');

$iqconnetik_border_top    = iqconnetik_option('topline_border_top', '');
$iqconnetik_border_bottom = iqconnetik_option('topline_border_bottom', '');

$iqconnetik_topline_text = iqconnetik_option('topline_text', '');

?>
<div id="topline" class="topline topline-1 <?php echo esc_attr($iqconnetik_topline_background . ' ' . $iqconnetik_font_size); ?>">
    <?php
    if ('full' === $iqconnetik_border_top) {
        echo wp_kses_post('<hr class="section-hr">');
    }
    ?>
    <?php
    if ('container' === $iqconnetik_border_top) {
        echo wp_kses_post('<hr class="section-hr container">');
    }
    ?>
    <div class="container<?php echo esc_attr($iqconnetik_fluid); ?>">
        <div class="icon-inline top_text">
            <?php
            if (!empty($iqconnetik_topline_text)) : ?>
                <span><?php echo esc_html($iqconnetik_topline_text); ?></span>
            <?php
            endif;
            ?>
        </div>
        <?php if (!empty($iqconnetik_meta)) : ?>
            <div class="site-meta darklinks">
                <?php
                if (!empty($iqconnetik_meta['phone']) && $iqconnetik_topline_meta_phone) :
                    $phone_from_meta = $iqconnetik_meta['phone'];
                    $print_phone = preg_replace("/[^0-9]/", '', $phone_from_meta);
                ?>
                    <span class="icon-inline">
                        <?php iqconnetik_icon('phone'); ?>
                        <?php if (!empty($iqconnetik_meta['phone_label'])) : ?>
                            <h6 class="phone-label mt-0 mb-0"><?php echo wp_kses_post($iqconnetik_meta['phone_label']); ?></h6>
                        <?php endif; ?>
                        <a class="phone" href="tel:<?php echo esc_attr($print_phone); ?>"><?php echo wp_kses_post($iqconnetik_meta['phone']); ?></a>
                    </span>
                <?php
                endif; //phone
                if (!empty($iqconnetik_meta['email']) && $iqconnetik_topline_meta_mail) :
                ?>
                    <span class="icon-inline">
                        <?php iqconnetik_icon('email'); ?>
                        <?php if (!empty($iqconnetik_meta['email_label'])) : ?>
                            <h6 class="email-label mt-0 mb-0"><?php echo wp_kses_post($iqconnetik_meta['email_label']); ?></h6>
                        <?php endif; ?>
                        <a href="mailto:<?php echo esc_attr($iqconnetik_meta['email']); ?>"><?php echo wp_kses_post($iqconnetik_meta['email']); ?></a>
                    </span>
                <?php
                endif; //email
                if (!empty($iqconnetik_meta['address']) && $iqconnetik_topline_meta_address) :
                ?>
                    <span class="icon-inline">
                        <?php iqconnetik_icon('map-marker'); ?>
                        <?php if (!empty($iqconnetik_meta['address_label'])) : ?>
                            <h6 class="address-label mt-0 mb-0"><?php echo wp_kses_post($iqconnetik_meta['address_label']); ?></h6>
                        <?php endif; ?>
                        <span class="grey"><?php echo wp_kses_post($iqconnetik_meta['address']); ?></span>
                    </span>
                <?php
                endif; //address
                if (!empty($iqconnetik_meta['opening_hours']) && $iqconnetik_topline_meta_opening_hours) :
                ?>
                    <span class="icon-inline">
                        <?php iqconnetik_icon('clock-outline'); ?>
                        <?php if (!empty($iqconnetik_meta['opening_hours_label'])) : ?>
                            <h6 class="hours-label mt-0 mb-0"><?php echo wp_kses_post($iqconnetik_meta['opening_hours_label']); ?></h6>
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
        <?php iqconnetik_social_links(); ?>
    </div><!-- .container -->
    <?php
    if ('container' === $iqconnetik_border_bottom) {
        echo wp_kses_post('<hr class="section-hr container">');
    }
    if ('full' === $iqconnetik_border_bottom) {
        echo wp_kses_post('<hr class="section-hr">');
    }
    ?>
</div><!-- #topline -->