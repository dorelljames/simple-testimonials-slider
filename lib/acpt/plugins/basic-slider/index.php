<?php
add_action('init', 'acpt_slider');
function acpt_slider() {
include('shortcodes.php');

$args = array(
'supports' => array( 'title', 'page-attributes', 'acpt_slide_options'  ),
'hierarchical' => false,
'public' => false,
'has_archive' => false,
'show_ui' => true
);

$slide = new post_type('slide','slides', false,  $args );

new tax('group','groups', $slide, true);
}

add_action( 'add_meta_boxes', 'acpt_slider_meta' );

function acpt_slider_meta() {
	new meta_box('acpt_slide_options', array('sample'), array('label' => 'Slide'));
}

function meta_acpt_slide_options() {
	$form = new form('slide', null);
	$form->image('image', array('label' => 'Image URL', 'help' => 'Upload an Image that is 940px by 350px for best results', 'button' => 'Add Your Slide'));
	$form->text('headline', array('label' => 'Headline'));
	$form->textarea('description',array('label' => 'Description'));
	$form->select('showText', array('Yes', 'No'), array('label' => 'Show Headline and Description'));
}

require_once('template.php');