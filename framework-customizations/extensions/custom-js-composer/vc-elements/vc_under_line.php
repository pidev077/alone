<?php
if ( ! defined('ABSPATH')) {
    die('-1');
}

// Params extraction
$atts = shortcode_atts(
  array(
    'self'              => '',
    'content'           => '',
    /* Source */
    'max_width'         => '100',
    'height'            => '5', 
    'color'        			=> '#36dfe7', 
    'align'             => 'center', 
    /* Style */
    'el_id'             => '',
    'el_class'          => '',
    'css'               => '',
  ),
  $atts
);
extract($atts);
// echo '<pre>';print_r($atts);echo '</pre>'; 

$content = wpb_js_remove_wpautop($content, true);

/**
 * @var $css_class
 */
extract( $self->getStyles( $el_class, $css,  $atts ) );
 

/** elm ID **/
$attr_id = '';
if(! empty($el_id)) { $attr_id = "id='{$el_id}'"; }

$variables = array(
	'{class}'									=> 'alone-under-line',
  '{max-width}'      			=> $max_width,
  '{height}'       				=> $height,
  '{color}'        				=> $color,
  '{align}'       				=> $align, 
	'{height_2}'							=> ($height - 2),
);

$templates = array(
  'default' => implode('', array(
    '<div class="{class} text-{align}" style="max-width: {max-width}px; margin: auto; padding: 4px 0;">',
      '<div class="line" style="border-color: {color}; position: relative;height: {height}px;border: 1px solid {color};-webkit-border-radius: 3px;border-radius: 3px;">',
				'<span style="background-color: {color}; position: absolute;right: 0;top: 0;width: 60%;height: {height_2}px;">', 
				'</span>',
      '</div>',
    '</div>',
  )),
);

?>
<div <?php echo esc_attr($attr_id); ?> class="<?php echo esc_attr($css_class); ?>  "> 
    <?php echo str_replace(array_keys($variables), array_values($variables), $templates['default']); ?> 
</div>
