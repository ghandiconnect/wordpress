<?php

/**
 * The header preloader template file
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

if (is_customize_preview()) {
	echo '<div id="preloader-wrap">';
}

//page preloader
$iqconnetik_preloader = iqconnetik_option('preloader', '');

if (!empty($iqconnetik_preloader)) :
?>
	<!-- preloader -->
	<div id="preloader" class="preloader <?php echo esc_attr($iqconnetik_preloader); ?>">
		<div class="preloader_css"></div>
	</div>
<?php
endif; //preloader_enabled

if (is_customize_preview()) {
	echo '</div>';
}
