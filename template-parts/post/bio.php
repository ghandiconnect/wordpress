<?php

/**
 * The template to display post author bio
 *
 * @package WordPress
 * @subpackage Iqconnetik
 * @since 0.0.1
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

$iqconnetik_author_id = get_the_author_meta('ID');

$iqconnetik_show_bio   = iqconnetik_option('blog_single_show_author_bio', true);
$iqconnetik_author_bio = get_the_author_meta('description', $iqconnetik_author_id);

if (empty($iqconnetik_show_bio) || empty($iqconnetik_author_bio)) {
	return;
}

//SEO additional fields
$iqconnetik_twitter_url 	  = get_the_author_meta('twitter', $iqconnetik_author_id);
$iqconnetik_facebook_url     = get_the_author_meta('facebook', $iqconnetik_author_id);
$iqconnetik_linkedin_url     = get_the_author_meta('linkedin', $iqconnetik_author_id);
$iqconnetik_instagram_url    = get_the_author_meta('instagram', $iqconnetik_author_id);
$iqconnetik_youtube_url      = get_the_author_meta('youtube', $iqconnetik_author_id);
$iqconnetik_custom_image_url = get_the_author_meta('custom_profile_image', $iqconnetik_author_id);
?>
<div class="author-meta">
	<div class="side-item has-post-thumbnail">
		<div class="item-media">
			<?php
			if (!empty($iqconnetik_custom_image_url)) {
				echo '<img src="' . esc_url($iqconnetik_custom_image_url) . '" alt="' . esc_attr(get_the_author_meta('display_name', $iqconnetik_author_id)) . '">';
			} else {
				echo get_avatar($iqconnetik_author_id, 700);
			}
			?>
		</div><!-- eof .item-media -->
		<div class="item-content">
			<?php
			$iqconnetik_about_word = iqconnetik_option('blog_single_author_bio_about_word');
			if (!empty($iqconnetik_about_word)) :
			?>
				<p class="about-author-heading">
					<?php echo esc_html($iqconnetik_about_word); ?>
				</p>
			<?php endif; ?>
			<h5 class="author-name mt-0">
				<?php
				the_author();
				//echo wp_kses_post( get_the_author_meta( 'display_name', $iqconnetik_author_id ) );
				?>
			</h5>
			<?php if (!empty($iqconnetik_author_bio)) : ?>
				<p class="author-bio">
					<?php echo wp_kses_post($iqconnetik_author_bio); ?>
				</p>
			<?php
			endif; //author_bio
			if ($iqconnetik_twitter_url || $iqconnetik_facebook_url || $iqconnetik_linkedin_url || $iqconnetik_instagram_url || $iqconnetik_youtube_url) :
			?>
				<span class="social-links author-social">
					<?php

					if ($iqconnetik_facebook_url) :
						iqconnetik_social_link('facebook', $iqconnetik_facebook_url, '');
					endif;
					if ($iqconnetik_twitter_url) :
						iqconnetik_social_link('twitter', $iqconnetik_twitter_url, '');
					endif;
					if ($iqconnetik_instagram_url) :
						iqconnetik_social_link('instagram', $iqconnetik_instagram_url, '');
					endif;
					if ($iqconnetik_linkedin_url) :
						iqconnetik_social_link('linkedin', $iqconnetik_linkedin_url, '');
					endif;
					if ($iqconnetik_youtube_url) :
						iqconnetik_social_link('youtube', $iqconnetik_youtube_url, '');
					endif;
					?>
				</span><!-- eof .author-social -->
			<?php endif; //author social 
			?>
		</div><!-- eof .item-content -->
	</div><!-- eof author-meta -->
</div>
<?php
