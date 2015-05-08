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



//*Includes Advanced Custom Fields

include_once( 'advanced-custom-fields/acf.php' );
define( 'ACF_LITE', true );

add_action( 'init', 'register_custom_post_type' );
// add_action( 'plugins_loaded', 'acf_fields' );

//*End Advanced Custom Fields


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

// /**
// * Constructor. Called when plugin is initialised
// */

 
// add_action( 'init', 'register_custom_post_type' );
// add_action( 'add_meta_boxes', 'register_meta_boxes' ); 
// add_action( 'save_post', 'save_meta_boxes' );


// /**
// * Registers a Meta Box on our Contact Custom Post Type, called 'Contact Details'
// */
// function register_meta_boxes() {
//     add_meta_box( 'contact-details', 'Contact Details', 'output_meta_box', 'contact', 'normal', 'high' );   
// }


// /**
// * Output a Contact Details meta box
// *
// * @param WP_Post $post WordPress Post object
// */
// function output_meta_box($post) {
 
//     $email = get_post_meta( $post->ID, '_contact_email', true );
     
//     // Add a nonce field so we can check for it later.
//     wp_nonce_field( 'save_contact', 'contacts_nonce' );
     
//     // Output label and field
//     echo ( '<label for="contact_email">' . __( 'Email Address', 'tuts-crm' ) . '</label>' );
//     echo ( '<input type="text" name="contact_email" id="contact_email" value="' . esc_attr( $email ) . '" />' );
     
// }

// /**
// * Saves the meta box field data
// *
// * @param int $post_id Post ID
// */
// function save_meta_boxes( $post_id ) {
 
//     // Check if our nonce is set.
//     if ( ! isset( $_POST['contacts_nonce'] ) ) {
//         return $post_id;    
//     }
 
//     // Verify that the nonce is valid.
//     if ( ! wp_verify_nonce( $_POST['contacts_nonce'], 'save_contact' ) ) {
//         return $post_id;
//     }
 
//     // Check this is the Contact Custom Post Type
//     if ( 'contact' != $_POST['post_type'] ) {
//         return $post_id;
//     }
 
//     // Check the logged in user has permission to edit this post
//     if ( ! current_user_can( 'edit_post', $post_id ) ) {
//         return $post_id;
//     }
 
//     // OK to save meta data
//     $email = sanitize_text_field( $_POST['contact_email'] );
//     update_post_meta( $post_id, '_contact_email', $email );
     
// }



/**
* Register ACF Field Groups and Fields
*/
function acf_fields() {
 
    if( function_exists( "register_field_group" ) ) {
        register_field_group(array (
            'id' => 'acf_contact-details',
            'title' => 'Contact Details',
            'fields' => array (
                array (
                    'key' => 'field_5323276db7e18',
                    'label' => 'Email Address',
                    'name' => 'email_address',
                    'type' => 'email',
                    'required' => 1,
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array (
                    'key' => 'field_53232a6cf3800',
                    'label' => 'Phone Number',
                    'name' => 'phone_number',
                    'type' => 'number',
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'min' => '',
                    'max' => '',
                    'step' => '',
                ),
                array (
                    'key' => 'field_53232aa9f3801',
                    'label' => 'Photo',
                    'name' => 'photo',
                    'type' => 'image',
                    'save_format' => 'object',
                    'preview_size' => 'thumbnail',
                    'library' => 'all',
                ),
                array (
                    'key' => 'field_53232c2ff3802',
                    'label' => 'Type',
                    'name' => 'type',
                    'type' => 'select',
                    'required' => 1,
                    'choices' => array (
                        'Prospect' => 'Prospect',
                        'Customer' => 'Customer',
                    ),
                    'default_value' => '',
                    'allow_null' => 0,
                    'multiple' => 0,
                ),
            ),
            'location' => array (
                array (
                    array (
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'contact',
                        'order_no' => 0,
                        'group_no' => 0,
                    ),
                ),
            ),
            'options' => array (
                'position' => 'normal',
                'layout' => 'default',
                'hide_on_screen' => array (
                    0 => 'permalink',
                    1 => 'excerpt',
                    2 => 'custom_fields',
                    3 => 'discussion',
                    4 => 'comments',
                    5 => 'revisions',
                    6 => 'slug',
                    7 => 'author',
                    8 => 'format',
                    9 => 'featured_image',
                    10 => 'categories',
                    11 => 'tags',
                    12 => 'send-trackbacks',
                ),
            ),
            'menu_order' => 1,
        ));
    }
}
