<?php

/**
 * The template for displaying the footer
 *
 * Contains the footer.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Iqconnetik
 * @since 0.0.1
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (is_front_page() && is_active_sidebar('sidebar-home-after-content')) : ?>
	<div class="sidebar-home sidebar-home-after sidebar-home-after-content">
		<?php dynamic_sidebar('sidebar-home-after-content'); ?>
	</div><!-- .sidebar-home-after-content -->
<?php
endif; //is_front_page

if (
	//no need to close container class if they was not opened
	//see header.php file
	!is_page_template('page-templates/full-width.php')
	&& !is_404()
	&& !is_page_template('page-templates/home.php')
) :
	/**
	 * Fires at the bottom of main column.
	 *
	 * @since Iqconnetik 0.0.1
	 */
	do_action('iqconnetik_action_bottom_of_main_column');

?>
	</main><!-- #main -->

	<?php get_sidebar('sidebar-1'); ?>
	</div><!-- #columns -->
	<?php
	//full width widget area before columns for home page
	if (is_front_page() && is_active_sidebar('sidebar-home-after-columns')) :
	?>
		<div class="sidebar-home sidebar-home-after sidebar-home-after-columns">
			<?php dynamic_sidebar('sidebar-home-after-columns'); ?>
		</div><!-- .sidebar-home-after-columns -->
	<?php endif; //home.php 
	?>
	</div><!-- .container -->
	</div><!-- #main -->
<?php

endif; //full-width

get_template_part('template-parts/footer-top/section', iqconnetik_template_part('footer_top', '1'));
if (is_404()) :
	get_template_part('template-parts/footer/footer');
else :
	get_template_part('template-parts/footer/footer', iqconnetik_template_part('footer', '1'));
endif;
if (is_404()) :
	get_template_part('template-parts/copyright/copyright-1');
else :
	get_template_part('template-parts/copyright/copyright', iqconnetik_template_part('copyright', '1'));
endif;

?>
</div><!-- #box -->
<?php
//if there is no header chosen  we need to show #overlay here for side menu overlay
$iqconnetik_header = iqconnetik_option('header', '');
if (empty($iqconnetik_header)) :
?>
	<div id="overlay"></div>
<?php
endif; //header

get_template_part('template-parts/footer/footer-totop');

//photoswipe markup
if (is_singular()) :
?>
	<div id="pswp" class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="pswp__bg"></div>
		<div class="pswp__scroll-wrap">
			<div class="pswp__container">
				<div class="pswp__item"></div>
				<div class="pswp__item"></div>
				<div class="pswp__item"></div>
			</div>
			<div class="pswp__ui pswp__ui--hidden">
				<div class="pswp__top-bar">
					<div class="pswp__counter"></div>
					<button class="pswp__button pswp__button--close" title="<?php echo esc_attr__('Close (Esc)', 'iqconnetik'); ?>"></button>
					<button class="pswp__button pswp__button--share" title="<?php echo esc_attr__('Share', 'iqconnetik'); ?>"></button>
					<button class="pswp__button pswp__button--fs" title="<?php echo esc_attr__('Toggle fullscreen', 'iqconnetik'); ?>"></button>
					<button class="pswp__button pswp__button--zoom" title="<?php echo esc_attr__('Zoom in/out', 'iqconnetik'); ?>"></button>
					<div class="pswp__preloader">
						<div class="pswp__preloader__icn">
							<div class="pswp__preloader__cut">
								<div class="pswp__preloader__donut"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
					<div class="pswp__share-tooltip"></div>
				</div>
				<button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
				</button>
				<button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
				</button>
				<div class="pswp__caption">
					<div class="pswp__caption__center"></div>
				</div>
			</div>
		</div>
	</div><!--.pswp -->
<?php
endif; //is_singular
/**
 * Fires at the bottom of whole web page before the wp_footer function.
 *
 * @since Iqconnetik 0.0.1
 */
do_action('iqconnetik_action_before_wp_footer');
wp_footer();
?>
</body>

</html>