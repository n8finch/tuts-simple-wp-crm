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



add_action( 'init', 'register_CRM_post_type' );
/**
 * Register CRM Contact post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function register_CRM_post_type() {
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
