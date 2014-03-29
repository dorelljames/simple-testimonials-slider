<?php
// [slider]
function acpt_slider_code( $attr ) {
	$group = false;
	$height = null;
	$width = null;
	$alt = null;
	$caption_classes = null;
	$classes = null;

	extract( shortcode_atts( array(
		'group' => false,
		'height' => '350',
		'width' => '940',
		'alt' => true,
		'caption_classes' => 'caption',
		'classes' => 'slides'
	), $attr ) );

	$settings = array(
		'height' => $height,
		'width' => $width,
		'alt' => $alt,
		'caption_classes' => $caption_classes,
		'classes' => $classes);

	ob_start();
		list_slides($group, array(), $settings);
	$output = ob_get_clean( );

	return $output;
}

add_shortcode( 'slider', 'acpt_slider_code' );