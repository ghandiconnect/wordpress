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
$iqconnetik_transparent       = iqconnetik_option('header_transparent') ? 'transparent' : '';
$iqconnetik_absolute          = iqconnetik_option('header_absolute') ? 'absolute' : '';
$iqconnetik_header_top_tall   = iqconnetik_option('header_top_tall') ? 'header-tall' : '';
$iqconnetik_sticky            = iqconnetik_option('header_sticky');
$iqconnetik_header_background = iqconnetik_option('header_background', '');
$iqconnetik_font_size         = iqconnetik_option('header_font_size', '');

$iqconnetik_border_top    = iqconnetik_option('header_border_top', '');
$iqconnetik_border_bottom = iqconnetik_option('header_border_bottom', '');

$iqconnetik_toggler_side_in_header = iqconnetik_option('header_toggler_menu_side', true);
$iqconnetik_toggler_main_in_header = iqconnetik_option('header_toggler_menu_main', true);

$iqconnetik_header_align_main_menu = iqconnetik_option('header_align_main_menu', '');
$iqconnetik_header_has_menu_class  = has_nav_menu('primary') ? 'has-menu' : 'no-menu';

$iqconnetik_background_image = iqconnetik_section_background_image_array('header');

//meta
$iqconnetik_meta                 = iqconnetik_get_theme_meta();
$iqconnetik_header_meta   = iqconnetik_option('header_meta');
$iqconnetik_header_meta_class = (!empty($iqconnetik_header_meta)) ? 'show-meta' : '';

//button
$iqconnetik_header_button_text = iqconnetik_option('header_button_text', '');
$iqconnetik_header_button_url  = iqconnetik_option('header_button_url', '');
$iqconnetik_button_text_class = ($iqconnetik_header_button_text) ? 'with-button' : '';

if (!empty($iqconnetik_sticky)) :
?>
    <div id="header-affix-wrap" class="header-wrap <?php echo esc_attr($iqconnetik_header_background . ' ' . $iqconnetik_transparent . ' ' . $iqconnetik_absolute); ?>">
    <?php endif; //$iqconnetik_sticky 
    ?>
    <div id="overlay"></div>
    <header id="header" class="header header-1 <?php echo esc_attr($iqconnetik_button_text_class . ' ' . $iqconnetik_header_meta_class . ' ' . $iqconnetik_header_background . ' ' . $iqconnetik_font_size . ' ' . $iqconnetik_header_align_main_menu . ' ' . $iqconnetik_sticky . ' ' . $iqconnetik_transparent . ' ' . $iqconnetik_absolute . ' ' . $iqconnetik_header_top_tall . ' ' . $iqconnetik_header_has_menu_class . ' ' . $iqconnetik_background_image['class']); ?>" <?php echo (!empty($iqconnetik_background_image['url'])) ? 'style="background-image: url(' . esc_url($iqconnetik_background_image['url']) . ');"' : ''; ?>>
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
            <?php if (!empty($iqconnetik_toggler_side_in_header) && (has_nav_menu('side') || is_active_sidebar('sidebar-side'))) : ?>
                <button id="nav_side_toggle" class="nav-btn" aria-controls="nav_side" aria-expanded="false" aria-label="<?php esc_attr_e('Side Menu Toggler', 'iqconnetik'); ?>">
                    <span></span>
                </button>
            <?php
            endif; //toggler_side_in_header
            ?>
            <div class="logo-wrap">
                <?php
                get_template_part('template-parts/header/logo/logo', iqconnetik_template_part('logo', '1'));
                ?>
            </div>
            <?php
            if (has_nav_menu('primary')) :
            ?>
                <nav id="nav_top" class="top-nav" aria-label="<?php esc_attr_e('Top Menu', 'iqconnetik'); ?>">
                    <?php
                    if (has_nav_menu('primary')) :
                        $iqconnetik_menu_css_class = iqconnetik_get_menu_class_based_on_top_items_count('primary');
                        wp_nav_menu(
                            array(
                                'theme_location' => 'primary',
                                'menu_class'     => 'top-menu ' . $iqconnetik_menu_css_class,
                                'container'      => false,
                            )
                        );
                    endif; //has_nav_menu 

                    if (empty($iqconnetik_toggler_main_in_header)) :
                    ?>
                        <button id="nav_toggle" class="nav-btn" aria-controls="nav_top" aria-expanded="false" aria-label="<?php esc_attr_e('Top Menu Toggler', 'iqconnetik'); ?>">
                            <span></span>
                        </button>
                    <?php
                    //echo closing button if main button is inside header section
                    else :
                    ?>
                        <button id="nav_close" class="nav-btn" aria-controls="nav_top" aria-expanded="true" aria-label="<?php esc_attr_e('Top Menu Close', 'iqconnetik'); ?>">
                            <span></span>
                        </button>
                    <?php endif; //toggler_main_in_header 
                    ?>
                </nav><!-- .top-nav -->
            <?php
            endif; //has_nav_menu 
            ?>
            <?php
            if (!empty($iqconnetik_toggler_main_in_header) && has_nav_menu('primary')) :
            ?>
                <button id="nav_toggle" class="nav-btn" aria-controls="nav_top" aria-expanded="false" aria-label="<?php esc_attr_e('Top Menu Toggler', 'iqconnetik'); ?>">
                    <span></span>
                </button>
            <?php endif; //toggler_main_in_header 
            ?>
            <?php if (!empty($iqconnetik_header_button_text)) : ?>
                <div class="header_right_buttons hidden-xs">
                    <a href="<?php echo esc_url($iqconnetik_header_button_url); ?>" target="_self" class="header-button btn btn-outline-gradient btn-medium"><?php echo esc_html($iqconnetik_header_button_text); ?></a>
                </div>
            <?php endif; ?>
        </div><!-- .container -->
        <?php
        if ('container' === $iqconnetik_border_bottom) {
            echo wp_kses_post('<hr class="section-hr container">');
        }
        if ('full' === $iqconnetik_border_bottom) {
            echo wp_kses_post('<hr class="section-hr">');
        }
        ?>
    </header><!-- #header -->
    <?php if (!empty($iqconnetik_sticky)) : ?>
    </div>
    <!--#header-affix-wrap-->
<?php endif; //$iqconnetik_sticky 
?>