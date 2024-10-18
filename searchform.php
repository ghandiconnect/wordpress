<?php

/**
 * Template for displaying search forms
 *
 * @package WordPress
 * @subpackage Iqconnetik
 * @since 0.0.1
 *
 */

$iqconnetik_unique_id = uniqid('search-form-');

?>
<form autocomplete="off" role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">

	<input type="search" id="<?php echo esc_attr($iqconnetik_unique_id); ?>" class="search-field" placeholder="<?php echo esc_attr_x('Search', 'placeholder', 'iqconnetik'); ?>" value="<?php echo esc_attr(get_search_query()); ?>" name="s" />
	<button type="submit" class="search-submit"><?php iqconnetik_icon('magnify'); ?>
		<span class="screen-reader-text"><?php echo esc_html_x('Search', 'submit button', 'iqconnetik'); ?></span>
	</button>

	<label for="<?php echo esc_attr($iqconnetik_unique_id); ?>" class="screen-reader-text">
		<?php echo esc_html_x('Search for:', 'label', 'iqconnetik'); ?>
	</label>

</form><!-- .search-form -->