<?php

/**
 * Custom customizer control - hidden option. Used for demo number
 *
 * @package Iqconnetik
 * @since 0.0.1
 */
if (!class_exists('Iqconnetik_Hidden_Customize_Control') && class_exists('WP_Customize_Control')) :

	class Iqconnetik_Hidden_Customize_Control extends WP_Customize_Control
	{
		public $type = 'hidden-option';

		protected function render_content()
		{
		}
	}

endif;
