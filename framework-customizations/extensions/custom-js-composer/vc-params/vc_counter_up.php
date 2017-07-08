<?php
/*
Element Description: VC Counter Up
*/

// Element Class
class vcCounterUp extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_counter_up_mapping' ) );
        add_shortcode( 'vc_counter_up', array( $this, 'vc_counter_up_html' ) );
    }
 
     // Element Mapping
    public function vc_counter_up_mapping() {
        
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()
        vc_map(
            array(
                'name' => __( 'Counter Up', 'alone' ),
                'base' => 'vc_counter_up',
                'description' => __('Counter Up', 'alone'),
                'category' => __('Theme Elements', 'alone'),
                'icon' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/liquid-button.png',
                'params' => array(
                    /* source */
                    array(
                        'type' => 'textfield',
                        'heading' => __('Counter number', 'alone'),
                        'param_name' => 'counter_number',
                        'description' => __('Enter number', 'alone'),
                        'group' => 'Source',
                        'value' => '1,234',
                    ), 
                    array(
                        'type' => 'colorpicker',
                        'heading' => __('Text Color', 'alone'),
                        'param_name' => 'text_color',
                        'value' => '#000000',  
                        'description' => __('Select text color', 'alone'),
                        'group' => 'Source',
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => __('Alignment', 'alone'),
                        'param_name' => 'align',
                        'description' => __('Select counter alignment', 'alone'),
                        'value' => array(
                        __('Left', 'alone') => 'left',
                        __('Right', 'alone') => 'right',
                        __('Center', 'alone') => 'center',
                        ),
                        'std' => 'center',
                        'group' => 'Source',
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __('Font size', 'alone'),
                        'param_name' => 'font_size',
                        'description' => __('Enter font size', 'alone'),
                        'group' => 'Source',
                        'value' => '',
                    ),
                    array(
                        'type' => 'textarea_safe',
                        'heading' => __('Custom css', 'alone'),
                        'param_name' => 'custom_css',
                        'description' => __('Enter css custom (ex: font-family: "Arial"; font-weight: bold;)', 'alone'),
                        'group' => 'Source',
                        'value' => '',
                    ),

                    /*Setting*/
                    
                    array(
                        'type' => 'textfield',
                        'heading' => __('Before prefix', 'alone'),
                        'param_name' => 'before_prefix',
                        'description' => __('Enter before prefix', 'alone'),
                        'group' => 'Counter Setting',
                        'value' => '$',
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __('After prefix', 'alone'),
                        'param_name' => 'after_prefix',
                        'description' => __('Enter after prefix', 'alone'),
                        'group' => 'Counter Setting',
                        'value' => ' ',
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __('Delay', 'alone'),
                        'param_name' => 'delay',
                        'description' => __('Enter delay number', 'alone'),
                        'group' => 'Counter Setting',
                        'value' => '10',
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __('Time', 'alone'),
                        'param_name' => 'time',
                        'description' => __('Enter time number', 'alone'),
                        'group' => 'Counter Setting',
                        'value' => '1000',
                    ),

                    /* Style */
                    array(
                        'type' => 'el_id',
                        'heading' => __( 'Element ID', 'alone' ),
                        'param_name' => 'el_id',
                        'description' => __( 'Enter element ID .', 'alone' ),
                        'group' => 'Source',
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Extra class name', 'alone' ),
                        'param_name' => 'el_class',
                        'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'alone' ),
                        'group' => 'Source',
                    ),
                    /* css editor */
                    array(
                        'type' => 'css_editor',
                        'heading' => __( 'Css', 'alone' ),
                        'param_name' => 'css',
                        'group' => __( 'Design Options general', 'alone' ),
                    ),
                ),
            )
        );

    }
 
    /**
  	 * Parses google_fonts_data and font_container_data to get needed css styles to markup
  	 *
  	 * @param $el_class
  	 * @param $css
  	 * @param $atts
  	 *
  	 * @since 1.0
  	 * @return array
  	 */
    public function getStyles($el_class, $css, $atts) {
        $styles = array();
	  
        /**
  		 * Filter 'VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG' to change vc_counter_up class
  		 *
  		 * @param string - filter_name
  		 * @param string - element_class
  		 * @param string - shortcode_name
  		 * @param array - shortcode_attributes
  		 *
  		 * @since 4.3
  		 */
  		$css_class = apply_filters( 'vc_counter_up_filter_class', 'wpb_theme_custom_element wpb_counter_up ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

  		return array(
  			'css_class' => trim( preg_replace( '/\s+/', ' ', $css_class ) ),
  			'styles' => $styles,
  		);
    }


    public function _template($temp = 'default', $params = array()) {

    }

    // Element HTML
    public function vc_counter_up_html( $atts, $content ) {
      $atts['self'] = $this;
      $atts['content'] = $content;
      return fw_render_view(get_template_directory() . '/framework-customizations/extensions/custom-js-composer/vc-elements/vc_counter_up.php', array('atts' => $atts), true);
    }

} // End Element Class


// Element Class Init
new vcCounterUp();
