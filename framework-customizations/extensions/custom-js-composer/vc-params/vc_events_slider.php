<?php
/*
Element Description: VC Events Slider
*/

// Element Class
class vcEventsSlider extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_events_slider_mapping' ) );
        add_shortcode( 'vc_events_slider', array( $this, 'vc_events_slider_html' ) );
    }

    // Element Mapping
    public function vc_events_slider_mapping() {

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()
        vc_map(
          array(
            'name' => __('Events Slider', 'alone'),
            'base' => 'vc_events_slider',
            'description' => __('Events Slider', 'alone'),
            'category' => __('Events', 'alone'),
            'icon' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/posts-slider-2.png',
            'params' => array(
              /* source */
              array(
          			'type' => 'textfield',
          			'heading' => __( 'Total Items', 'alone' ),
          			'param_name' => 'post_total_items',
          			'description' => __( 'Set max limit for items in event or enter -1 to display all (limited to 1000).', 'alone' ),
                'value' => 3,
                'group' => 'Source',
                'admin_label'   => true,
              ),
              array(
                'type' => 'dropdown',
                'heading' => __('Events Type', 'alone'),
                'param_name' => 'type',
                'value' => array(
                  __('Recent', 'alone') => 'recent',
                  // __('By Taxonomy ID', 'alone') => 'taxonomy_id',
                  __('By ID', 'alone') => 'event_id',
                ),
                'std' => 'recent',
                'description' => __( 'Select event type query.', 'alone' ),
                'group' => 'Source',
                'admin_label' => true,
              ),
              array(
                'type' => 'textfield',
                'heading' => __('Taxonomy IDs', 'alone'),
                'param_name' => 'taxonomy_ids',
                'value' => '',
                /*
                'dependency' => array(
          				'element' => 'type',
          				'value' => 'taxonomy_id',
          			),
                */
                'description' => __( 'Enter taxonomy id (Ex: 1,2,3).', 'alone' ),
                'group' => 'Source',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('Event IDs', 'alone'),
                'param_name' => 'event_ids',
                'value' => '',
                'dependency' => array(
          				'element' => 'type',
          				'value' => 'event_id',
          			),
                'description' => __( 'Enter event id (Ex: 1,2,3).', 'alone' ),
                'group' => 'Source',
              ),
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
              /*** Layout Options ***/
              array(
                'type' => 'dropdown',
                'heading' => __('Image Size', 'alone'),
                'param_name' => 'image_size',
                'value' => array(
                  array('value' => 'thumbnail', 'label' => esc_html__('Thumbnail', 'alone')),
                  array('value' => 'medium', 'label' => esc_html__('Medium', 'alone')),
                  array('value' => 'medium_large', 'label' => esc_html__('Medium Large', 'alone')),
                  array('value' => 'large', 'label' => esc_html__('Large', 'alone')),
                  array('value' => 'alone-image-large', 'label' => esc_html__('Large (1228 x 691)', 'alone')),
                  array('value' => 'alone-image-medium', 'label' => esc_html__('Medium (614 x 346)', 'alone')),
                  array('value' => 'alone-image-small', 'label' => esc_html__('Small (295 x 166)', 'alone')),
                  array('value' => 'alone-image-square-800', 'label' => esc_html__('Square (800 x 800)', 'alone')),
                  array('value' => 'alone-image-square-300', 'label' => esc_html__('Square (300 x 300)', 'alone')),
                ),
                'std' => 'alone-image-medium',
                'description' => __('Select a image size', 'alone'),
                'group' => 'Layout',
              ),
              array(
                'type' => 'vc_image_picker',
                'heading' => __( 'Select Layout', 'alone' ),
                'param_name' => 'layout',
                'value' => array(
                  'default' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/event-slider-layout-default.jpg',
                  // 'block-image' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/posts-slider-layout-2.jpg',
                ),
                'std' => 'default',
                'description' => __('Select a layout display', 'alone'),
                'group' => 'Layout',
              ),
              /*** Slider Options ***/
              array(
                'type' => 'textfield',
                'heading' => __('Items', 'alone'),
                'param_name' => 'items',
                'value' => '3',
                'admin_label' => false,
                'description' => __('The number of items you want to see on the screen.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('Margin', 'alone'),
                'param_name' => 'margin',
                'value' => '30',
                'admin_label' => false,
                'description' => __('margin-right(px) on item.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'dropdown',
                'heading' => __('Loop', 'alone'),
                'param_name' => 'loop',
                'value' => array(
                  __('Yes', 'alone') => '1',
                  __('No', 'alone') => '0',
                ),
                'std' => '0',
                'description' => __('Infinity loop. Duplicate last and first items to get loop illusion.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'dropdown',
                'heading' => __('Center', 'alone'),
                'param_name' => 'center',
                'value' => array(
                  __('Yes', 'alone') => '1',
                  __('No', 'alone') => '0',
                ),
                'std' => '0',
                'description' => __('Center item. Works well with even an odd number of items.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('stagePadding', 'alone'),
                'param_name' => __('stage_padding', 'alone'),
                'value' => '0',
                'description' => __('Padding left and right on stage (can see neighbours).', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('startPosition', 'alone'),
                'param_name' => __('start_position', 'alone'),
                'value' => '0',
                'description' => __('Start position or URL Hash string like `#id`.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'dropdown',
                'heading' => __('Nav', 'alone'),
                'param_name' => 'nav',
                'value' => array(
                  __('Yes', 'alone') => '1',
                  __('No', 'alone') => '0',
                ),
                'std' => '0',
                'description' => __('Show next/prev buttons.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'dropdown',
                'heading' => __('Dots', 'alone'),
                'param_name' => 'dots',
                'value' => array(
                  __('Yes', 'alone') => '1',
                  __('No', 'alone') => '0',
                ),
                'std' => '0',
                'description' => __('Show dots navigation.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('slideBy', 'alone'),
                'param_name' => __('slide_by', 'alone'),
                'value' => 1,
                'description' => __('Navigation slide by x. `page` string can be set to slide by page.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'dropdown',
                'heading' => __('Autoplay', 'alone'),
                'param_name' => 'autoplay',
                'value' => array(
                  __('Yes', 'alone') => '1',
                  __('No', 'alone') => '0',
                ),
                'std' => '0',
                'description' => __('Autoplay.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'dropdown',
                'heading' => __('autoplayHoverPause', 'alone'),
                'param_name' => 'autoplay_hover_pause',
                'value' => array(
                  __('Yes', 'alone') => '1',
                  __('No', 'alone') => '0',
                ),
                'std' => '0',
                'description' => __('Pause on mouse hover.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('autoplayTimeout', 'alone'),
                'param_name' => 'autoplay_timeout',
                'value' => '5000',
                'description' => __('Autoplay interval timeout.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('smartSpeed', 'alone'),
                'param_name' => 'smart_speed',
                'value' => '250',
                'description' => __('AutoplaySpeed Calculate. More info to come..', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('Table Items', 'alone'),
                'param_name' => 'responsive_table_items',
                'value' => '1',
                'admin_label' => false,
                'description' => __('The number of items you want to see on the table screen.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('Mobile Items', 'alone'),
                'param_name' => 'responsive_mobile_items',
                'value' => '1',
                'admin_label' => false,
                'description' => __('The number of items you want to see on the mobile screen.', 'alone'),
                'group' => 'Slider Options',
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
  		 * Filter 'VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG' to change vc_custom_heading class
  		 *
  		 * @param string - filter_name
  		 * @param string - element_class
  		 * @param string - shortcode_name
  		 * @param array - shortcode_attributes
  		 *
  		 * @since 4.3
  		 */
  		$css_class = apply_filters( 'vc_events_slider_filter_class', 'wpb_theme_custom_element wpb_events_slider ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

  		return array(
  			'css_class' => trim( preg_replace( '/\s+/', ' ', $css_class ) ),
  			'styles' => $styles,
  		);
    }

    public function event_get_posts($atts = array()) {
      extract($atts);

      $args = array(
        'post_type' => 'fw-event',
        'items' => $post_total_items,
        'image_class' => 'event-featured-image',
        'date_format' => 'l, j, M',
        'image_size' => $image_size,
        'cat' => $taxonomy_ids,
        'image_width' => '100%',
        'image_height' => 'auto',
        'image_post' => false,
      );

      switch ($type) {
        case 'recent':
          $args['sort'] = 'recent';
          break;

        case 'event_id':
          $args['sort'] = 'by_id';
          $args['post__in'] = explode(',', $event_ids);
          # code...
          break;
      }

      return  alone_get_posts($args);
    }

    public function variables($event_id, $item_data) {
      $event_options = fw_get_db_post_option($event_id);
      $venue =  fw_akg('general-event/event_location/venue', $event_options);
      $limit_space = fw_akg('total_space', $event_options);

      $variables = array(
        '{ID}'                => $event_id,
        '{post_title}'        => fw_akg('post_title', $item_data),
        '{post_link}'         => fw_akg('post_link', $item_data),
        '{post_author_link}'  => fw_akg('post_author_link', $item_data),
        '{post_author_name}'  => fw_akg('post_author_name', $item_data),
        '{post_excerpt}'      => fw_akg('post_excerpt', $item_data),
        '{term_list}'         => get_the_term_list($event_id, 'fw-event-taxonomy-name', '<div class="event-term-list">', ',', '</div>'),
        '{post_featured_image}' => get_template_directory_uri() . '/assets/images/image-default-2.jpg',
        '{post_excerpt}'      => fw_akg('post_excerpt', $item_data),
        '{event_start_time}'  => (function_exists('bearsthemes_event_get_start_time')) ? bearsthemes_event_get_start_time($event_id) : '',
        '{venue}'             => $venue,
      );

      return $variables;
    }

    public function _template($temp = 'default', $item = array(), $atts = array()) {
      $output = '';
      $event_id = fw_akg('post_id', $item);
      $variables = $this->variables($event_id, $item);

      /* check featured image exist */
      if ( has_post_thumbnail($event_id) ) {
        $variables['{post_featured_image}'] = get_the_post_thumbnail_url($event_id, fw_akg('image_size', $atts));
      }

      $variables['{layout}'] = $atts['layout'];

      switch ($temp) {
        case 'default':
          $output = implode('', array(
            '<div class="item-inner layout-{layout}">',
              '<div class="event-featured-image-wrap">',
                '<div class="event-thumbnail-background" style="background: url({post_featured_image}) center center, #333; background-size: 100%;"></div>',
                '{term_list}',
              '</div>',
              '<div class="content-entry">',
                '<div class="circle-overlay"></div>',
                '<a href="{post_link}" class="title-link" title="{post_title}"><h4 class="title">{post_title}</h4></a>',
                '<div class="event-start-time"><span class="ion-ios-location"></span> {venue}, <span class="ion-ios-timer"></span> {event_start_time}</div>',
                '<a class="readmore-link" href="{post_link}" title="'. __('View detail', 'alone') .'"><span class="ion-ios-arrow-right"></span></a>',
              '</div>',
            '</div>',
          ));
          break;
      }

      return str_replace(array_keys($variables), array_values($variables), $output);
    }

    // Element HTML
    public function vc_events_slider_html( $atts, $content ) {
      $atts['self'] = $this;
      $atts['content'] = $content;
      return fw_render_view(get_template_directory() . '/framework-customizations/extensions/custom-js-composer/vc-elements/vc_events_slider.php', array('atts' => $atts), true);
    }

} // End Element Class


// Element Class Init
new vcEventsSlider();
