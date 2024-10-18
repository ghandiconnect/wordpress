<?php

/**
 * Template part for displaying posts
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

?>
<div class="grid-item">
    <article id="post-<?php the_ID(); ?>" <?php post_class('bg_teaser vertical-item i'); ?> itemtype="https://schema.org/Article" itemscope="itemscope">
        <?php
        iqconnetik_post_thumbnail('iqconnetik-default-post');
        ?>
        <div class="item-content content-padding">
            <header class="entry-header">
                <?php
                if (!empty(iqconnetik_option('blog_show_categories'))) :
                    iqconnetik_entry_meta(false, false, true, false, false, false, false);
                endif;
                ?>
                <?php
                the_title(sprintf('<h4 class="entry-title darklinks" itemprop="headline"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h4>');
                ?>
                <?php
                if (

                    !empty(iqconnetik_option('blog_show_date'))
                    || !empty(iqconnetik_option('blog_show_author'))
                    || !empty(iqconnetik_option('blog_show_comments_link'))
                    || !empty(iqconnetik_option('blog_show_likes'))
                    || !empty(iqconnetik_option('blog_show_views'))
                ) : ?>
                    <div class="entry-meta post-meta darklinks">
                        <?php iqconnetik_entry_meta(true, true, false, false, true, true, true); ?>
                    </div>
                <?php endif; ?>
            </header><!-- .entry-header -->
            <div class="entry-content" itemprop="text">
                <?php
                the_content(
                    esc_html__('', 'iqconnetik')
                );

                wp_link_pages(
                    iqconnetik_get_wp_link_pages_atts()
                );
                ?>
            </div><!-- .entry-content -->
            <?php
            if (!empty(iqconnetik_option('blog_show_tags')) && !empty(get_the_tags())) : ?>
                <footer class="entry-footer entry-footer-top">
                    <div class="entry-meta post-meta darklinks">
                        <?php iqconnetik_entry_meta(false, false, false, true, false, false, false); ?>
                    </div><!-- .entry-meta -->
                </footer><!-- .entry-footer-top -->
            <?php endif; ?>
            <?php
            if (
                !empty(iqconnetik_option('blog_share_facebook', true))
                || !empty(iqconnetik_option('blog_share_twitter', true))
                || !empty(iqconnetik_option('blog_share_telegram', true))
                || !empty(iqconnetik_option('blog_share_pinterest', true))
                || !empty(iqconnetik_option('blog_share_linkedin', true))
            ) :
            ?>
                <footer class="entry-footer entry-footer-bottom entry-blog-share">
                    <?php
                    if (function_exists('iqconnetik_share_this')) {
                        iqconnetik_share_this();
                    }
                    ?>
                </footer><!-- .entry-footer-bottom -->
            <?php endif; ?>
        </div><!-- .item-content -->
    </article><!-- #post-<?php the_ID(); ?> -->
</div>