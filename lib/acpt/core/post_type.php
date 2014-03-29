<?php
/**
  * Post Type
  *
  * This is the long description for a DocBlock. This text may contain
  * multiple lines and even some _markdown_.
  *
  * * Markdown style lists function too
  * * Just try this out once
  *
  * The section after the long description contains the tags; which provide
  * structured meta-data concerning the given element.
  *
  * @author  Kevin Dees
  *
  * @since 0.6
  * @version 0.6
  *
  * @global string $acpt_version
  */
class post_type extends acpt {

	public $singular = null;
	public $plural = null;

	function __construct( $singular = null, $plural = null, $cap = false, $settings = array() ) {
		if($singular !== null ) $this->make($singular, $plural, $cap, $settings);
	}
	
	/**
	 * Make Post Type. Do not use before init.
	 * 
	 * @param string $singular singular name is required
	 * @param string $plural plural name is required
	 * @param boolean $cap turn on custom capabilities
	 * @param array $settings args override and extend
	 */
	function make($singular = null, $plural = null, $cap = false, $settings = array() ) {
		if(!$singular) exit('Making Post Type: You need to enter a singular name.');
		if(!$plural) exit('Making Post Type: You need to enter a plural name.');

		// make lowercase
		$singular = strtolower($singular);
		$plural = strtolower($plural);

		// setup object for later use
		$this->plural = $plural;
		$this->singular = $singular;
		
		// make uppercase
		$upperSingular = ucwords($singular);
		$upperPlural = ucwords($plural);

		$labels = array(
			'name' => $upperPlural,
			'singular_name' => $upperSingular,
			'add_new' => 'Add New',
			'add_new_item' => 'Add New '.$upperSingular,
			'edit_item' => 'Edit '.$upperSingular,
			'new_item' => 'New '.$upperSingular,
			'view_item' => 'View '.$upperSingular,
			'search_items' => 'Search '.$upperPlural,
			'not_found' =>  'No '.$plural.' found',
			'not_found_in_trash' => 'No '.$plural.' found in Trash', 
			'parent_item_colon' => '',
			'menu_name' => $upperPlural,
		);
		
		$capabilities = array(
			'publish_posts' => 'publish_'.$plural,
			'edit_post' => 'edit_'.$singular,
			'edit_posts' => 'edit_'.$plural,
			'edit_others_posts' => 'edit_others_'.$plural,
			'delete_post' => 'delete_'.$singular,
			'delete_posts' => 'delete_'.$plural,
			'delete_others_posts' => 'delete_others_'.$plural,
			'read_post' => 'read_'.$singular,
			'read_private_posts' => 'read_private_'.$plural,
		);
		
		if($cap === true) :
			$cap = array(
				'capability_type' => $singular,
				'capabilities' => $capabilities,
			);
		else :
			$cap = array();
		endif;
		
		$args = array(
			'labels' => $labels,
			'description' => $plural,
			'rewrite' => array( 'slug' => sanitize_title($plural)),
			'public' => true,
			'has_archive' => true,
		);
		
		$args = array_merge($args, $cap, $settings);
		
		// Register post type
		register_post_type($singular, $args);
	}
}