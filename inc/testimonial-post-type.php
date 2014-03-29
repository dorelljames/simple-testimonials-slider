<?php

add_action( 'init', 'custom_post_testimonial' );

function custom_post_testimonial() {

    $args = array(
        'supports' => array( 'title', 'editor' ),
        'heirarchical' => false,
        'public' => true,
        'exclude_from_search' => true, // exclude from search in frontend
        // 'publicly_queryable' => false, // don't allow query from frontend
        'show_in_nav_menus' => false, // don't show in navigation
        'menu_position' => 55,
        'menu_icon' => plugins_url( 'simple_testimonial_slider.png' , __FILE__ ),
        'has_archive' => true,
    );

    $locations = new post_type( 'testimonial', 'testimonials', false, $args ); // create custom post type

}

add_action( 'add_meta_boxes', 'add_testimonials_meta' );

# Add testimonial meta
function add_testimonials_meta() {
    
    new meta_box('Testimonial Details', array('testimonial')); // Location Details

}

# Add meta fields for our testimonials
function meta_testimonial_details() {

    $testimonial_details = new form('sts_details', null);

    $testimonial_details->text('name', array('label' => 'Name (Author, Customer or By)'));
    $testimonial_details->text('link', array('label' => 'Custom URL (overrides testimonial permalink)'));

}

# Retrieves all testimonials, no limit by by default and only retrieves published ones
function get_all_testimonials($limit = -1) {

    $testimonials = null; // reset to null
    $testimonials_q = new WP_Query( array(
            'post_type' => 'testimonial', 
            'post_status' => array('publish'), 
            'showposts' => -1, 
            'posts_per_page' => -1, 
        )
    );

    // var_dump($testimonials_q);

    $testimonials = $testimonials_q->get_posts();

    // var_dump($testimonials);

    if(empty($testimonials)) {
        $r_testimonial = 0;
    } else {
        foreach($testimonials as $testimonial) {

            $post_name = get_post_meta($testimonial->ID, "acpt_sts_details_text_name", true);
            $post_custom_link = get_post_meta($testimonial->ID, "acpt_sts_details_text_link", true);

            $r_testimonial[$testimonial->ID] = array(
                'post_status' => $testimonial->post_status, // status
                'post_title' => $testimonial->post_title, // title, not really used 
                'post_content' => $testimonial->post_content, // description
                'post_link' => get_permalink($testimonial->ID), // default permalink
                'post_name' => ( !empty($post_name)  ? $post_name : 'Anynomous' ), // author, customer, by
                'post_custom_link' => esc_url( $post_custom_link ) // @overrides post link if specified
            );
        }

        if(!isset($r_testimonial))  
            $r_testimonial = 0;
    }

    return $r_testimonial;

}