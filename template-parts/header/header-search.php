<?php

/**
 * The header search template file
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

$iqconnetik_search = iqconnetik_option('header_search', '');


if (empty($iqconnetik_search)) {
	return;
}
//d-none shown-lg
$iqconnetik_header = iqconnetik_option('header', '');

?>
<div class="header-search">
	<button id="search_toggle" aria-controls="search_dropdown" aria-expanded="false" aria-label="<?php esc_attr_e('Search Dropdown Toggler', 'iqconnetik'); ?>">
		<?php
		iqconnetik_icon('magnify');
		?>
	</button>
</div><!-- .header-search -->
<?php
