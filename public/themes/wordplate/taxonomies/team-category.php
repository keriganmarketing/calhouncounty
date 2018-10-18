<?php

/**
 * Registers the `team_category` taxonomy,
 * for use with 'team'.
 */
function team_category_init() {
	register_taxonomy( 'team-category', array( 'team' ), array(
		'hierarchical'      => true,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_ui'           => true,
		'show_admin_column' => false,
		'query_var'         => true,
		'rewrite'           => true,
		'capabilities'      => array(
			'manage_terms'  => 'edit_posts',
			'edit_terms'    => 'edit_posts',
			'delete_terms'  => 'edit_posts',
			'assign_terms'  => 'edit_posts',
		),
		'labels'            => array(
			'name'                       => __( 'Categories', 'wordplate' ),
			'singular_name'              => _x( 'Category', 'taxonomy general name', 'wordplate' ),
			'search_items'               => __( 'Search Categories', 'wordplate' ),
			'popular_items'              => __( 'Popular Categories', 'wordplate' ),
			'all_items'                  => __( 'All Categories', 'wordplate' ),
			'parent_item'                => __( 'Parent Category', 'wordplate' ),
			'parent_item_colon'          => __( 'Parent Category:', 'wordplate' ),
			'edit_item'                  => __( 'Edit Category', 'wordplate' ),
			'update_item'                => __( 'Update Category', 'wordplate' ),
			'view_item'                  => __( 'View Category', 'wordplate' ),
			'add_new_item'               => __( 'New Category', 'wordplate' ),
			'new_item_name'              => __( 'New Category', 'wordplate' ),
			'separate_items_with_commas' => __( 'Separate Categories with commas', 'wordplate' ),
			'add_or_remove_items'        => __( 'Add or remove Categories', 'wordplate' ),
			'choose_from_most_used'      => __( 'Choose from the most used Categories', 'wordplate' ),
			'not_found'                  => __( 'No Categories found.', 'wordplate' ),
			'no_terms'                   => __( 'No Categories', 'wordplate' ),
			'menu_name'                  => __( 'Categories', 'wordplate' ),
			'items_list_navigation'      => __( 'Categories list navigation', 'wordplate' ),
			'items_list'                 => __( 'Categories list', 'wordplate' ),
			'most_used'                  => _x( 'Most Used', 'team-category', 'wordplate' ),
			'back_to_items'              => __( '&larr; Back to Categories', 'wordplate' ),
		),
		'show_in_rest'      => true,
		'rest_base'         => 'team-category',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	) );

}
add_action( 'init', 'team_category_init' );

/**
 * Sets the post updated messages for the `team_category` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `team_category` taxonomy.
 */
function team_category_updated_messages( $messages ) {

	$messages['team-category'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Category added.', 'wordplate' ),
		2 => __( 'Category deleted.', 'wordplate' ),
		3 => __( 'Category updated.', 'wordplate' ),
		4 => __( 'Category not added.', 'wordplate' ),
		5 => __( 'Category not updated.', 'wordplate' ),
		6 => __( 'Categories deleted.', 'wordplate' ),
	);

	return $messages;
}
add_filter( 'term_updated_messages', 'team_category_updated_messages' );
