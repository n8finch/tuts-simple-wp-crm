<?php
/**
 * Plugin Name: Tuts+ WP CRM
 * Plugin URI: https://github.com/FinchPS/tuts-simple-wp-crm
 * Version: 1.0
 * Author: Nate Finch and Tuts+
 * Author URI: http://code.tutsplus.com
 * Description: A simple CRM system for WordPress
 * License: GPL2
 */







add_action( 'init', 'register_custom_post_type' );


/**
 * Register CRM Contact post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function register_custom_post_type() {
	$labels = array(
		'name'               => _x( 'Contacts', 'post type general name', 'tuts-crm' ),
        'singular_name'      => _x( 'Contact', 'post type singular name', 'tuts-crm' ),
        'menu_name'          => _x( 'Contacts', 'admin menu', 'tuts-crm' ),
        'name_admin_bar'     => _x( 'Contact', 'add new on admin bar', 'tuts-crm' ),
        'add_new'            => _x( 'Add New', 'contact', 'tuts-crm' ),
		'add_new_item'       => __( 'Add New Contact', 'tuts-crm' ),
        'new_item'           => __( 'New Contact', 'tuts-crm' ),
        'edit_item'          => __( 'Edit Contact', 'tuts-crm' ),
        'view_item'          => __( 'View Contact', 'tuts-crm' ),
        'all_items'          => __( 'All Contacts', 'tuts-crm' ),
        'search_items'       => __( 'Search Contacts', 'tuts-crm' ),
        'parent_item_colon'  => __( 'Parent Contacts:', 'tuts-crm' ),
        'not_found'          => __( 'No conttacts found.', 'tuts-crm' ),
        'not_found_in_trash' => __( 'No contacts found in Trash.', 'tuts-crm' ),
		);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'book' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'public'             => false,
        'publicly_queryable' => false,
		'hierarchical'       => false,
		'menu_position'      => 10,
		'menu_icon'			 => 'dashicons-businessman',
		'supports'           => array( 'title', 'author', 'comments' )
	);

	register_post_type( 'contact', $args );
}

/**
* Constructor. Called when plugin is initialised
*/

 
add_action( 'init', 'register_custom_post_type' );
add_action( 'add_meta_boxes', 'register_meta_boxes' ); 
add_action( 'save_post', 'save_meta_boxes' );


/**
* Registers a Meta Box on our Contact Custom Post Type, called 'Contact Details'
*/
function register_meta_boxes() {
    add_meta_box( 'contact-details', 'Contact Details', 'output_meta_box', 'contact', 'normal', 'high' );   
}


/**
* Output a Contact Details meta box
*
* @param WP_Post $post WordPress Post object
*/
function output_meta_box($post) {
 
    $email = get_post_meta( $post->ID, '_contact_email', true );
     
    // Add a nonce field so we can check for it later.
    wp_nonce_field( 'save_contact', 'contacts_nonce' );
     
    // Output label and field
    echo ( '<label for="contact_email">' . __( 'Email Address', 'tuts-crm' ) . '</label>' );
    echo ( '<input type="text" name="contact_email" id="contact_email" value="' . esc_attr( $email ) . '" />' );
     
}

/**
* Saves the meta box field data
*
* @param int $post_id Post ID
*/
function save_meta_boxes( $post_id ) {
 
    // Check if our nonce is set.
    if ( ! isset( $_POST['contacts_nonce'] ) ) {
        return $post_id;    
    }
 
    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['contacts_nonce'], 'save_contact' ) ) {
        return $post_id;
    }
 
    // Check this is the Contact Custom Post Type
    if ( 'contact' != $_POST['post_type'] ) {
        return $post_id;
    }
 
    // Check the logged in user has permission to edit this post
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }
 
    // OK to save meta data
    $email = sanitize_text_field( $_POST['contact_email'] );
    update_post_meta( $post_id, '_contact_email', $email );
     
}
