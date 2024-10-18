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

$iqconnetik_before_social_word = iqconnetik_option('topline_text', '');

?>
<div id="topline" class="topline topline-2 <?php echo esc_attr($iqconnetik_topline_background . ' ' . $iqconnetik_font_size); ?>">
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
        <?php iqconnetik_social_links(); ?>
        <?php get_template_part('template-parts/header/header-search'); ?>
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