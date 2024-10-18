<?php

/**
 * The footer top section template file
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
	echo '<section id="footer-top" class="d-none"></section>';
}
