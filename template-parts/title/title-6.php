<?php

/**
 * The title section template file
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

$iqconnetik_fluid             = iqconnetik_option('title_fluid') ? '-fluid' : '';
$iqconnetik_show_title       = iqconnetik_option('title_show_title', '');
$iqconnetik_show_breadcrumbs = iqconnetik_breadcrumbs_enabled();

$iqconnetik_title_background     = iqconnetik_option('title_background', '');
$iqconnetik_extra_padding_top    = iqconnetik_option('title_extra_padding_top', '');
$iqconnetik_extra_padding_bottom = iqconnetik_option('title_extra_padding_bottom', '');
$iqconnetik_border_top           = iqconnetik_option('title_border_top', '');
$iqconnetik_border_bottom        = iqconnetik_option('title_border_bottom', '');
$iqconnetik_font_size            = iqconnetik_option('title_font_size', '');
$iqconnetik_background_image     = iqconnetik_section_background_image_array('title');

?>
<section id="title" class="title title-7 text-center <?php echo esc_attr($iqconnetik_title_background . ' ' . $iqconnetik_font_size . ' ' . $iqconnetik_background_image['class']); ?>" <?php echo (!empty($iqconnetik_background_image['url'])) ? 'style="background-image: url(' . esc_url($iqconnetik_background_image['url']) . ');"' : ''; ?>>
    <?php
    if ('full' === $iqconnetik_border_top) {
        echo wp_kses_post('<hr class="section-hr">');
    }
    ?>
    <div class="container<?php echo esc_attr($iqconnetik_fluid); ?> <?php echo esc_attr($iqconnetik_extra_padding_top . ' ' . $iqconnetik_extra_padding_bottom); ?>">
        <?php
        if ('container' === $iqconnetik_border_top) {
            echo wp_kses_post('<hr class="section-hr">');
        }
        if (!empty($iqconnetik_show_title)) {
        ?>
            <h1 class="color-main" itemprop="headline"><?php get_template_part('template-parts/title/title-text'); ?></h1>
        <?php
        } // show_title
        if (!empty($iqconnetik_show_breadcrumbs)) {
            iqconnetik_breadcrumbs();
        }
        if ('container' === $iqconnetik_border_bottom) {
            echo wp_kses_post('<hr class="section-hr">');
        }
        ?>
    </div><!-- .container -->
    <?php
    if ('full' === $iqconnetik_border_bottom) {
        echo wp_kses_post('<hr class="section-hr">');
    }
    ?>
</section><!-- #title -->