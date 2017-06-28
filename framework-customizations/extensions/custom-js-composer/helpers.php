<?php
/**
 * alone_load_custom_elements
 *
 */
if(! function_exists('alone_vc_load_custom_elements')) :
  function alone_vc_load_custom_elements() {
    $path = get_template_directory() . '/framework-customizations/extensions/custom-js-composer/';
    $new_elements = array(
      'vc_posts_slider_2',
      'vc_base_carousel',
      'vc_featured_box',
      'vc_pricing_table',
      'vc_progressbar_svg',
      'vc_posts_grid_resizable',
      'vc_liquid_button',
    );

    /* check plugin Give (donations) exist  */
    if (class_exists('Give')) :
      $new_elements[] = 'grid_builder_give_goal_progress';
      $new_elements[] = 'grid_builder_give_button_donate';
      $new_elements[] = 'vc_give_forms_slider';
    endif;

    /* fw_event */
    if (function_exists('fw_ext') && fw_ext('events')) {
      $new_elements[] = 'vc_events_slider';
      $new_elements[] = 'vc_events_listing';
    }

    foreach($new_elements as $item) :
      $dir = $path . 'vc-params/' . $item . '.php';
      if(file_exists($dir)) require $dir;
    endforeach;
  }
endif;
