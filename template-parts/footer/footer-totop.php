<?php

/**
 * The footer template file for the 'to top' button
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
	echo '<div id="to-top-wrap">';
}

$iqconnetik_to_top = iqconnetik_option('totop', true);
//page totop button
if (!empty($iqconnetik_to_top)) :
?>
	<a id="to-top" href="#body">
		<span class="screen-reader-text">
			<?php esc_html_e('Go to top', 'iqconnetik'); ?>
		</span>
	</a>
<?php
endif; //totop_enabled

if (is_customize_preview()) {
	echo '</div>';
}
