<?php

/**
 * Custom customizer control with heading - used as divider
 *
 * @package Iqconnetik
 * @since 0.0.1
 */
if (!class_exists('Iqconnetik_Google_Font_Control') && class_exists('WP_Customize_Control')) :

	class Iqconnetik_Google_Font_Control extends WP_Customize_Control
	{

		/**
		 * The type of customize control being rendered.
		 */
		public $type = 'google-font';

		/**
		 * The selected font.
		 */
		public $selected_font = '';

		/**
		 * Using JS for content.
		 */
		public function render_content()
		{
		}

		public function content_template()
		{
?>
			<# if( typeof(Vue)==='undefined' ) { return; } var api=wp.customize; var controlId=data.settings.default; var currentValue=api(controlId).get(); var appId=_.uniqueId( 'customize-google-font-app-' ); var labelId=_.uniqueId( 'customize-google-font-select-' ); var descriptionId=_.uniqueId( 'customize-google-font-description-' ); try { var value=JSON.parse(currentValue); } catch(e) { var value={ font: '' , variant: [], subset: [] } } #>
				<div id="{{ appId }}">
					<div v-cloak>
						<div class="customize-control-notifications-container"></div>
						<# if ( data.label ) { #>
							<label class="customize-control-title" for="{{ labelId }}">{{{ data.label }}}</label>
							<# } #>
								<# if ( data.description ) { #>
									<span id="{{ descriptionId }}" class="description customize-control-description">{{{ data.description }}}</span>
									<# } #>

										<input type="text" id="{{ labelId }}" <?php echo wp_kses_post($this->get_link()); ?> v-model="fontJSON" class="iqconnetik-hidden" />
										<select v-model="selected_font" v-on:change="resetVariantsSubsets">
											<option v-for="font in fonts" v-bind:value="font.family">
												~{ font.family }~
											</option>
										</select>

										<h3 v-if="selected_font">
											<?php esc_html_e('Font Variants', 'iqconnetik'); ?>
										</h3>
										<span class="description" v-if="selected_font">
										</span>

										<select multiple v-if="selected_font" v-model="selectedVariant">
											<option v-for="variant in fonts[selected_font].variants" v-bind:value="variant">
												~{ variant }~
											</option>
										</select>

										<h3 v-if="selected_font">
											<?php esc_html_e('Font Subsets', 'iqconnetik'); ?>
										</h3>

										<select multiple v-if="selected_font" v-model="selectedSubset">
											<option v-for="subset in fonts[selected_font].subsets" v-bind:value="subset">
												~{ subset }~
											</option>
										</select>
					</div>
				</div>
				<# api.bind( 'ready' , function(){ var fonts=mwtGoogleFonts; var app=new Vue({ delimiters: ['~{', '}~' ], el: '#' +appId, data: { fonts: fonts, selected_font: value.font, selectedVariant: value.font ? value.variant : [], selectedSubset: value.font? value.subset : [], loaded: false }, mounted: function () { this.$nextTick(function () { this.loaded=true; }); }, methods: { resetVariantsSubsets: function() { this.selectedVariant=[], this.selectedSubset=[] } }, computed: { fontJSON: function() { var json=JSON.stringify({ font: this.selected_font, variant: this.selected_font ? this.selectedVariant : [], subset: this.selected_font ? this.selectedSubset : [] }); api(controlId).set(json); return json; } } }); }); #>
		<?php
		}
	}
endif;
