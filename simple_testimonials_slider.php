<?php
/*
Plugin Name: Simple Testimonials Slider
Plugin URI: http://dev.dorelljames.com
Dependencies: Advanced Custom Post Type by kevindees - already included
Description: Just a simple testimonial slider to showcase your awesome testimonials.
Version: 0.2
Author: Dorell James Galang
Author URI: http://dorelljames.com
License: GPL2
*/

/* load needed things */
define('DS', DIRECTORY_SEPARATOR);
define('PLUGIN_DIR', dirname(__FILE__) ); 
define('TESTIMONIAL_POST_TYPE_FILE', PLUGIN_DIR . DS . 'inc' . DS . 'testimonial-post-type.php');
define('FUNCTIONS_FILE', PLUGIN_DIR . DS . 'inc' . DS . 'functions.php');
define('ACPT_INI_FILE', PLUGIN_DIR . DS . 'lib' . DS . 'acpt' . DS . 'init.php'); // init file of acpt plugin by kevindees


# Creating 'testimonials' custom post type
if ( file_exists( TESTIMONIAL_POST_TYPE_FILE ) ) {
    require_once( TESTIMONIAL_POST_TYPE_FILE );
} else {
	echo "Can't load TESTIMONIAL_POST_TYPE_FILE...";
	exit;
}

# Adding useful functions
if ( file_exists( FUNCTIONS_FILE ) ) {
    require_once( FUNCTIONS_FILE );
} else {
	echo "Can't load FUNCTIONS_FILE...";
	exit;
}


# Include important ACPT plugin for our testimonial custom post type 
if ( file_exists( ACPT_INI_FILE ) ) {
    require_once( ACPT_INI_FILE );
} else {
    echo "Can't load ACPT_INI_FILE...";
    exit;
}

# Doing our stuff below


# Create the slider
function make_slider( $atts ) {

	extract( shortcode_atts( array(
        'type' => $atts['type'],
        'limit' => $atts['limit'],
        'class' => $atts['class'],
	), $atts ) );

	// by default, get all
	if ( ! empty ( $limit ) ) {
		$testimonials = get_all_testimonials( $limit );
	} else {
		$testimonials = get_all_testimonials();
	}

	if ( $type == "liquid-slider" ) {
		$slider = create_liquid_slider( $testimonials, $class );
	}  else { // default is bxslider
		$slider = create_bxslider( $testimonials, $class );
	}

	echo $slider;

}

add_shortcode( 'simple_testimonial_slider' , 'make_slider' );
add_shortcode( 'sts' , 'make_slider' );

// Liquid slider create
if ( ! function_exists('create_liquid_slider') ) {
	function create_liquid_slider( $testimonials, $class ) {

		$slider = '<div id="simple-testimonials-slider" class="' . $class . '">';

		foreach( $testimonials as $testimonial ) {

			// specifying which link should be used
			if ( ! empty( $testimonial['post_custom_link'] ) ) {
				$custom_link = '<a class="testimonial-url" href="' . $testimonial['post_custom_link']  . '">' . $testimonial['post_name'] . '</a>';
			} else {
				$custom_link = '<a class="testimonial-url" href="' . $testimonial['post_link'] . '">' . $testimonial['post_name'] . '</a>';
			}
	        
	        $slider .= '<div>';
	        $slider .= '<p class="testimonial-content">' . $testimonial['post_content'] . ' <a href="' . $testimonial['post_link'] . '" class="more">Read More</a></p>';
	        $slider .= '<p class="testimonial-by">- ' . $custom_link . '</p>';
	        $slider .= '</div>';

	    }
	 
	    $slider .= '</div>';

	 	$slider_js = '<script>';
	    $slider_js .= 'jQuery(function() {';
	    $slider_js .= 'jQuery("#simple-testimonials-slider").liquidSlider({
	    	autoSlide: true,
		    dynamicTabs: false,
		    autoHeight: false,
	    });';
		$slider_js .= '});';
		$slider_js .= '</script>';

		$slider .= $slider_js;

		return $slider;

	}
}

// BxSlider create
if ( ! function_exists('create_bxslider') ) {
	function create_bxslider( $testimonials, $class ) {

		$slider = '<ul id="simple-testimonials-slider" class="' . $class . '">';

		foreach( $testimonials as $testimonial ) {

			// specifying which link should be used
			if ( ! empty( $testimonial['post_custom_link'] ) ) {
				$custom_link = '<a href="' . $testimonial['post_custom_link']  . '">' . $testimonial['post_name'] . '</a>';
			} else {
				$custom_link = '<a href="' . $testimonial['post_link'] . '">' . $testimonial['post_name'] . '</a>';
			}
	        
	        $slider .= '<li>';
	        $slider .= '<p class="testimonial-content">' . $testimonial['post_content'] . ' <a href="' . $testimonial['post_link'] . '" class="more">Read More</a></p>';
	        $slider .= '<p class="testimonial-by">' . $custom_link . '</p>';
	        $slider .= '</li>';

	    }

	    $slider .= '</ul>';

        return $slider;
	}
}

function create_all_testimonials_link( $atts ) {

	extract( shortcode_atts( array(
        'text' => $atts['text'],
        'class' => $atts['class'],
        'id' => $atts['id'],
	), $atts ) );

	if ( empty( $text ) ) {
		$link = '<a href="' . get_site_url() . '/testimonials' . '" class="' . $class . '">Go to testimonials</a>';
	} else {
		$link = '<a href="' . get_site_url() . '/testimonials' . '" class="' . $class . '">' . $text . '</a>';
	}

	echo $link;
	
}
add_shortcode('simple_testimonial_slider_link', 'create_all_testimonials_link');
add_shortcode('sts_link', 'create_all_testimonials_link');


/* Rewrite */

function myplugin_activate() {
	// register taxonomies/post types here
	flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'myplugin_activate' );


function myplugin_deactivate() {
	flush_rewrite_rules();
}

register_deactivation_hook( __FILE__, 'myplugin_deactivate' );

