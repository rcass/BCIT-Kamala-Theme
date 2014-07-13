<?php

/**
 * Plugin Name: Add Comic Review Post Type and Taxonomies
 * Description: This will add the comic review post type and taxonomy.
 * Version: 0.1
 * Author: Rose Cass
 * Author URI: https://bitbucket.org/rcass/rose-reads-wp-theme/overview
 * License: GPL2
 */

/*  Copyright 2014  Morten Rand-Hendriksen  (email : morten@pinkandyellow.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_action( 'init', 'comic_reviews_init' );
/**
 * Register a book post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function comic_reviews_init() {
	$labels = array(
		'name'               => 'Comic Reviews',
		'singular_name'      => 'Comic Review',
		'menu_name'          => 'Comic Reviews',
		'name_admin_bar'     => 'Comic Review',
		'add_new'            => 'Add new',
		'add_new_item'       => 'Add New Comic Review',
		'new_item'           => 'New Comic Review',
		'edit_item'          => 'Edit Comic Review',
		'view_item'          => 'View Comic Review',
		'all_items'          => 'All Comic Reviews',
		'search_items'       => 'Search Comic Reviews',
		'parent_item_colon'  => 'Parent Comic Reviews',
		'not_found'          => 'No Reviews Found',
		'not_found_in_trash' => 'No reviews found in Trash',
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-format-status',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'reviews' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( 'review', $args );
}

function my_rewrite_flush() {
    // First, we "add" the custom post type via the above written function.
    // Note: "add" is written with quotes, as CPTs don't get added to the DB,
    // They are only referenced in the post_type column with a post entry, 
    // when you add a post of this CPT.
    mortens_reviews_init();

    // ATTENTION: This is *only* done during plugin activation hook in this example!
    // You should *NEVER EVER* do this on every page load!!
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'my_rewrite_flush' );

// Custom Six Taxonomies

// hook into the init action and call create_review_taxonomies when it fires
add_action( 'init', 'create_review_taxonomies', 0 );

function create_review_taxonomies() {
    
// Add Rating Taxonomy (Hierarchical)
	$labels = array(
		'name'              => _x( 'Ratings', 'taxonomy general name' ),
		'singular_name'     => _x( 'Rating', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Ratings' ),
		'all_items'         => __( 'All Ratings' ),
		'parent_item'       => __( 'Parent Rating' ),
		'parent_item_colon' => __( 'Parent Rating:' ),
		'edit_item'         => __( 'Edit Rating' ),
		'update_item'       => __( 'Update Rating' ),
		'add_new_item'      => __( 'Add New Rating' ),
		'new_item_name'     => __( 'New Rating Name' ),
		'menu_name'         => __( 'Rating' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'ratings' ),
	);

	register_taxonomy( 'rating', array( 'review' ), $args );
    
// Add Series Taxonomy (Non-Hierarchical)
	$labels = array(
		'name'                       => _x( 'Series', 'taxonomy general name' ),
		'singular_name'              => _x( 'Series', 'taxonomy singular name' ),
		'search_items'               => __( 'Search Series' ),
		'popular_items'              => __( 'Popular Series' ),
		'all_items'                  => __( 'All Series' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Series' ),
		'update_item'                => __( 'Update Series' ),
		'add_new_item'               => __( 'Add New Series' ),
		'new_item_name'              => __( 'New Series Title' ),
		'separate_items_with_commas' => __( 'Separate series with commas' ),
		'add_or_remove_items'        => __( 'Add or remove series' ),
		'choose_from_most_used'      => __( 'Choose from the most used series' ),
		'not_found'                  => __( 'No series found.' ),
		'menu_name'                  => __( 'Series' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,  //Look into this one
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'series' ),
	);

	register_taxonomy( 'series', 'review', $args ); //name of tax, object_type, args array above

    
    // Add Creator Taxonomy (Non-Hierarchical) (May divde this into writters/artists)
	$labels = array(
		'name'                       => _x( 'Creator', 'taxonomy general name' ),
		'singular_name'              => _x( 'Creator', 'taxonomy singular name' ),
		'search_items'               => __( 'Search Creators' ),
		'popular_items'              => __( 'Popular Creators' ),
		'all_items'                  => __( 'All Creators' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Creator' ),
		'update_item'                => __( 'Update Creator' ),
		'add_new_item'               => __( 'Add New Creator' ),
		'new_item_name'              => __( 'New Creator Name' ),
		'separate_items_with_commas' => __( 'Separate creators with commas' ),
		'add_or_remove_items'        => __( 'Add or remove creators' ),
		'choose_from_most_used'      => __( 'Choose from the most used creators' ),
		'not_found'                  => __( 'No creators found.' ),
		'menu_name'                  => __( 'Creators' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,  
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'creators' ),
	);

	register_taxonomy( 'creators', 'review', $args ); //name of tax, object_type, args array above
    
    // Add Publisher Taxonomy (Non-Hierarchical) 
	$labels = array(
		'name'                       => _x( 'Publishers', 'taxonomy general name' ),
		'singular_name'              => _x( 'Publisher', 'taxonomy singular name' ),
		'search_items'               => __( 'Search Publishers' ),
		'popular_items'              => __( 'Popular Publishers' ),
		'all_items'                  => __( 'All Publishers' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Publisher' ),
		'update_item'                => __( 'Update Publisher' ),
		'add_new_item'               => __( 'Add New Publisher' ),
		'new_item_name'              => __( 'New Publisher' ),
		'separate_items_with_commas' => __( 'Separate publishers with commas' ),
		'add_or_remove_items'        => __( 'Add or remove publishers' ),
		'choose_from_most_used'      => __( 'Choose from the most used publishers' ),
		'not_found'                  => __( 'No publishers found.' ),
		'menu_name'                  => __( 'Publishers' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,  
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'publishers' ),
	);

	register_taxonomy( 'publishers', 'review', $args ); //name of tax, object_type, args array above
    
    // Add Format Taxonomy (Non-Hierarchical) 
	$labels = array(
		'name'                       => _x( 'Formats', 'taxonomy general name' ),
		'singular_name'              => _x( 'Format', 'taxonomy singular name' ),
		'search_items'               => __( 'Search Formats' ),
		'popular_items'              => __( 'Popular Formats' ),
		'all_items'                  => __( 'All Formats' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Format' ),
		'update_item'                => __( 'Update Format' ),
		'add_new_item'               => __( 'Add New Format' ),
		'new_item_name'              => __( 'New Format' ),
		'separate_items_with_commas' => __( 'Separate formats with commas' ),
		'add_or_remove_items'        => __( 'Add or remove formats' ),
		'choose_from_most_used'      => __( 'Choose from the most used formats' ),
		'not_found'                  => __( 'No formats found.' ),
		'menu_name'                  => __( 'Formats' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,  
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'fortmats' ),
	);

	register_taxonomy( 'formats', 'review', $args ); //name of tax, object_type, args array above
    
    // Add Similar To Taxonomy (Non-Hierarchical) 
	$labels = array(
		'name'                       => _x( 'Similar To', 'taxonomy general name' ),
		'singular_name'              => _x( 'Similar To', 'taxonomy singular name' ),
		'search_items'               => __( 'Search Similar Ideas' ),
		'popular_items'              => __( 'Popular Similar Ideas' ),
		'all_items'                  => __( 'All Similar Ideas' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Similar Ideas' ),
		'update_item'                => __( 'Update Similar Ideas' ),
		'add_new_item'               => __( 'Add New Similar Ideas' ),
		'new_item_name'              => __( 'New Similar Idea' ),
		'separate_items_with_commas' => __( 'Separate ideas with commas' ),
		'add_or_remove_items'        => __( 'Add or remove ideas' ),
		'choose_from_most_used'      => __( 'Choose from the most used ideas' ),
		'not_found'                  => __( 'No ideas found.' ),
		'menu_name'                  => __( 'Similar To' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,  
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'similarto' ),
	);

	register_taxonomy( 'similarto', 'review', $args ); //name of tax, object_type, args array above

}