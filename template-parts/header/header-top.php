<?php

/**
 * The header top template file
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

//wrapper for topline, header and title
echo '<div id="top-wrap">';

$iqconnetik_intro_position = iqconnetik_option('intro_position', '');
//intro section on front page after header
if (iqconnetik_is_front_page() && 'before' === $iqconnetik_intro_position) :

	get_template_part('template-parts/header/intro');

endif;

$iqconnetik_header_image_url = get_header_image();
if (!empty($iqconnetik_header_image_url)) :
	$iqconnetik_background_image = iqconnetik_section_background_image_array('header_image', true);
?>
	<div id="header-image" class="i <?php echo esc_attr($iqconnetik_background_image['class']); ?>" style="background-image: url('<?php echo esc_url($iqconnetik_background_image['url']); ?> ');">
	<?php
endif; //header_image_url

$iqconnetik_absolute_home_page = iqconnetik_option('header_absolute_home_page', '');
$iqconnetik_header_absolute = iqconnetik_option('header_absolute', '');

if (!empty($iqconnetik_absolute_home_page) && is_front_page() && empty($iqconnetik_header_absolute)) :
	?>
		<div class="header-absolute-wrap">
			<div class="header-absolute-content home-absolute">
			<?php
		endif; //$iqconnetik_header_absolute_home_page 

		if (!empty($iqconnetik_header_absolute)) :
			?>
				<div class="header-absolute-wrap">
					<div class="header-absolute-content">
					<?php
				endif; //$iqconnetik_header_absolute

				//topline header section
				get_template_part('template-parts/header/topline/topline', iqconnetik_template_part('topline', ''));

				//header section
				get_template_part('template-parts/header/header', iqconnetik_template_part('header', '1'));

				if (!empty($iqconnetik_header_absolute)) :
					?>
					</div><!-- .header-absolute-content -->
					<?php
					if (!empty($iqconnetik_absolute_home_page) && is_front_page() && empty($iqconnetik_header_absolute)) :
					?>
				</div><!-- .header-absolute-front-page-content -->
				<?php endif;

					//title section not on front page
					if (iqconnetik_is_title_section_is_shown() && !is_404() && !is_page_template('page-templates/home.php')) :
						get_template_part('template-parts/title/title', iqconnetik_template_part('title', '1'));
					//front page text
					else :
						//TODO homepage fullwidth image
						$iqconnetik_display_header_text = display_header_text();
						if (!empty($iqconnetik_display_header_text)) : ?>
					<h1 class="site-title">
						<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
							<?php echo wp_kses_post(get_bloginfo('name', 'display')); ?>
						</a>
					</h1>
					<?php
							$iqconnetik_description = get_bloginfo('description', 'display');

							if ($iqconnetik_description || is_customize_preview()) : ?>
						<p class="site-description"><?php echo wp_kses_post($iqconnetik_description); ?></p>
			<?php
							endif; //description
						endif; //display_header_text
					endif; //iqconnetik_is_front_page
			?>
			</div><!-- .header-absolute-wrap -->
			<?php
				else :
					//title section not on front page
					if (iqconnetik_is_title_section_is_shown() && !is_404() && !is_page_template('page-templates/home.php')) :
						get_template_part('template-parts/title/title', iqconnetik_template_part('title', '1'));
					//front page text
					else :
						//TODO homepage fullwidth image
						$iqconnetik_display_header_text = display_header_text();
						if (!empty($iqconnetik_display_header_text)) : ?>
					<h1 class="site-title">
						<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
							<?php echo wp_kses_post(get_bloginfo('name', 'display')); ?>
						</a>
					</h1>
					<?php
							$iqconnetik_description = get_bloginfo('description', 'display');

							if ($iqconnetik_description || is_customize_preview()) : ?>
						<p class="site-description"><?php echo wp_kses_post($iqconnetik_description); ?></p>
			<?php
							endif; //description
						endif; //display_header_text
					endif; //iqconnetik_is_front_page
				endif; //$iqconnetik_header_absolute

				if (!empty($iqconnetik_absolute_home_page) && is_front_page() && empty($iqconnetik_header_absolute)) : ?>
		</div>
	</div>
<?php endif; //$iqconnetik_header_absolute_home_page 

				/**
				 * Fires after the header.
				 *
				 * @since WBPlank 0.0.1
				 */
				do_action('iqconnetik_action_after_header');

				//intro section on front page after header
				if (iqconnetik_is_front_page() && 'after' === $iqconnetik_intro_position) :
					get_template_part('template-parts/header/intro');
				endif;

				if (!empty($iqconnetik_header_image_url)) :
?>
	</div>
	<!--#header-image-->
<?php
				endif; //$iqconnetik_header_image_url

				echo '</div><!--#top-wrap-->';
