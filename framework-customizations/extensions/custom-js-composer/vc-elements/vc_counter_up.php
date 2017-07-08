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
    'counter_number'    => '1,234',   
    'before_prefix'     => '$',
    'after_prefix'      => '',
    'text_color'        => '#000000',
    'delay'             => '10',
    'time'              => '1000', 
    'align'             => 'center', 
    'font_size'         => '',
    'custom_css'        => '',
    /* Style */
    'el_id'             => '',
    'el_class'          => '',
    'css'               => '',
  ),
  $atts
);
extract($atts);
//echo '<pre>';print_r($atts);echo '</pre>';

$bt_style = "color: " . esc_attr($text_color) . "; ";
$bt_style .= esc_attr( !empty($font_size) ? "font-size: {$font_size}; " : "" );
$bt_style .=  $custom_css ;

$content = wpb_js_remove_wpautop($content, true);

/**
 * @var $css_class
 */
extract( $self->getStyles( $el_class, $css, $atts ) );

/** elm ID **/
$attr_id = '';
if(! empty($el_id)) { $attr_id = "id='{$el_id}'"; }

$counteup_data = json_encode(array(
  'delay' => $delay,
  'time' => $time, 
));

?>
<div <?php echo esc_attr($attr_id); ?> class="<?php echo esc_attr($css_class); ?> text-<?php echo esc_attr($align); ?>"> 
    <div style="<?php echo $bt_style; ?>">
        <?php echo esc_attr($before_prefix); ?>
            <span class="counterUp" data-bears-counterup="<?php echo esc_attr($counteup_data); ?>"><?php echo $counter_number ?></span>
        <?php echo esc_attr($after_prefix); ?>
    </div> 
</div>