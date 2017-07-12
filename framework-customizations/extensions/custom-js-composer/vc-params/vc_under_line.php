<?php
/*
Element Description: VC Under Line
*/

// Element Class
class vcUnderLine extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_under_line_mapping' ) );
        add_shortcode( 'vc_under_line', array( $this, 'vc_under_line_html' ) );
    }

     // Element Mapping
    public function vc_under_line_mapping() {

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()
        vc_map(
            array(
                'name' => __( 'Under Line', 'alone' ),
                'base' => 'vc_under_line',
                'description' => __('Under Line', 'alone'),
                'category' => __('Theme Elements', 'alone'),
                'icon' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/counter-up.png',
                'params' => array(
                    /* source */
                    array( 
                        'type' => 'textfield',
                        'heading' => __('Max width', 'alone'),
                        'param_name' => 'max_width',
                        'description' => __('Enter Max width (ex: 100)', 'alone'), 
                        'value' => '100',
                    ),
                    array( 
                        'type' => 'textfield',
                        'heading' => __('Height', 'alone'),
                        'param_name' => 'height',
                        'description' => __('Enter height (ex: 5)', 'alone'), 
                        'value' => '5',
                    ),
                    array(
                        'type' => 'colorpicker',
                        'heading' => __('Under line color', 'alone'),
                        'param_name' => 'color',
                        'value' => '#36dfe7', //Default Black color
                        'description' => __('Select color ', 'alone'), 
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => __('Alignment', 'alone'),
                        'param_name' => 'align',
                        'description' => __('Select button alignment', 'alone'),
                        'value' => array(
                        __('Left', 'alone') => 'left',
                        __('Right', 'alone') => 'right',
                        __('Center', 'alone') => 'center',
                        ),
                        'std' => 'center', 
                    ),

                    /* Style */
                    array(
                        'type' => 'el_id',
                        'heading' => __( 'Element ID', 'alone' ),
                        'param_name' => 'el_id',
                        'description' => __( 'Enter element ID .', 'alone' ), 
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Extra class name', 'alone' ),
                        'param_name' => 'el_class',
                        'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'alone' ), 
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
  		 * Filter 'VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG' to change vc_under_line class
  		 *
  		 * @param string - filter_name
  		 * @param string - element_class
  		 * @param string - shortcode_name
  		 * @param array - shortcode_attributes
  		 *
  		 * @since 4.3
  		 */
  		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_theme_custom_element wpb_under_line ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

  		return array(
  			'css_class' => trim( preg_replace( '/\s+/', ' ', $css_class ) ),
  			'styles' => $styles,
  		);
    }



    public function _template($temp = 'default', $params = array()) {

    }


    // Element HTML
    public function vc_under_line_html( $atts, $content ) {
      $atts['self'] = $this;
      $atts['content'] = $content;
      return fw_render_view(get_template_directory() . '/framework-customizations/extensions/custom-js-composer/vc-elements/vc_under_line.php', array('atts' => $atts), true);
    }


} // End Element Class


// Element Class Init
new vcUnderLine();
