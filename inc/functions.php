<?php

// // Liquid slider styles & scripts
// if ( ! function_exists('load_liquid_slider_scripts') ) {
// function load_liquid_slider_scripts() {
//     if ( ( has_shortcode( $post->post_content, 'simple_testimonial_slider' ) || has_shortcode( $post->post_content, 'sts' ) ) && ! is_admin() ) {

//         wp_enqueue_style( 'ls-css', plugins_url( 'liquidslider-master/css/liquid-slider.css' , __FILE__ ) );
//         wp_enqueue_style( 'ls-custom-css', plugins_url( 'style.css' , __FILE__ ) );

//         wp_enqueue_script( 'jquery-easing', plugins_url( 'simple-testimonials-slider/liquidslider-master/js/jquery.easing.1.3.js' ), array('jquery'), '', true );
//         wp_enqueue_script( 'jquery-touchSwipe', plugins_url( 'simple-testimonials-slider/liquidslider-master/js/jquery.touchSwipe.min.js' ), array('jquery-easing'), '', true );
//         wp_enqueue_script( 'jquery-ls', plugins_url( 'simple-testimonials-slider/liquidslider-master/js/jquery.liquid-slider.min.js' ), array('jquery-touchSwipe'), '', true );
//     }
// }
// add_action('wp_enqueue_scripts', 'ls_scripts');

// BxSlider styles & scripts
if ( ! function_exists('load_bx_slider') ) {
    function load_bx_slider_scripts() {

        global $post;

        if ( ( has_shortcode( $post->post_content, 'simple_testimonial_slider' ) || has_shortcode( $post->post_content, 'sts' ) ) && ! is_admin() ) {

            wp_enqueue_style( 'bxslider-css', dirname( get_bloginfo('stylesheet_url') ) . '/lib/bxslider-4-master/jquery.bxslider.css');

            wp_enqueue_script( 'bxslider-js', dirname( get_bloginfo('stylesheet_url') ) . '/lib/bxslider-4-master/jquery.bxslider.min.js', array('jquery'), '4.1.1', true );
            // wp_enqueue_script( 'bxslider-js2', dirname( get_bloginfo('stylesheet_url') ) . '/lib/bxslider-4-master/simple_testimonial_slider.js', array('jquery'), '1.1', true );

        }

    }
}
add_action( 'wp_enqueue_scripts', 'load_bx_slider_scripts' );

// Common styles for the slider
// if ( ! function_exists('load_common_scripts_styles') ) {
//     function load_common_scripts_styles() {

//         global $post;

//         if ( ( has_shortcode( $post->post_content, 'simple_testimonial_slider' ) || has_shortcode( $post->post_content, 'sts' ) ) && ! is_admin() ) {

//             wp_enqueue_style( 'simple_testimonial_slider-css', PLUGIN_DIR . DS . 'simple_testimonials_slider.css', array('bxslider-css'), '1.0', 'all' );

//             wp_enqueue_script( 'simple_testimonial_slider_js', dirname( get_bloginfo('stylesheet_url') ) . '/inc/simple_testimonial_slider.js', array('bxslider-js'), '1.0', true );

//         }
//     }
// }
// add_action( 'wp_enqueue_scripts', 'load_common_scripts_styles' );

