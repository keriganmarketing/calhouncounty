<?php

/**
 * Registers the `business_listing` post type.
 */
function business_listing_init() {
	register_post_type( 'business-listing', array(
		'labels'                => array(
			'name'                  => __( 'Business Listings', 'wordplate' ),
			'singular_name'         => __( 'Business Listing', 'wordplate' ),
			'all_items'             => __( 'All Business Listings', 'wordplate' ),
			'archives'              => __( 'Business Listing Archives', 'wordplate' ),
			'attributes'            => __( 'Business Listing Attributes', 'wordplate' ),
			'insert_into_item'      => __( 'Insert into Business Listing', 'wordplate' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Business Listing', 'wordplate' ),
			'featured_image'        => _x( 'Featured Image', 'business-listing', 'wordplate' ),
			'set_featured_image'    => _x( 'Set featured image', 'business-listing', 'wordplate' ),
			'remove_featured_image' => _x( 'Remove featured image', 'business-listing', 'wordplate' ),
			'use_featured_image'    => _x( 'Use as featured image', 'business-listing', 'wordplate' ),
			'filter_items_list'     => __( 'Filter Business Listings list', 'wordplate' ),
			'items_list_navigation' => __( 'Business Listings list navigation', 'wordplate' ),
			'items_list'            => __( 'Business Listings list', 'wordplate' ),
			'new_item'              => __( 'New Business Listing', 'wordplate' ),
			'add_new'               => __( 'Add New', 'wordplate' ),
			'add_new_item'          => __( 'Add New Business Listing', 'wordplate' ),
			'edit_item'             => __( 'Edit Business Listing', 'wordplate' ),
			'view_item'             => __( 'View Business Listing', 'wordplate' ),
			'view_items'            => __( 'View Business Listings', 'wordplate' ),
			'search_items'          => __( 'Search Business Listings', 'wordplate' ),
			'not_found'             => __( 'No Business Listings found', 'wordplate' ),
			'not_found_in_trash'    => __( 'No Business Listings found in trash', 'wordplate' ),
			'parent_item_colon'     => __( 'Parent Business Listing:', 'wordplate' ),
			'menu_name'             => __( 'Business Listings', 'wordplate' ),
		),
		'public'                => true,
		'hierarchical'          => false,
		'show_ui'               => true,
		'show_in_nav_menus'     => true,
		'supports'              => array( 'title', 'editor' ),
		'has_archive'           => true,
		'rewrite'               => true,
		'query_var'             => true,
		'menu_icon'             => 'dashicons-admin-post',
		'show_in_rest'          => true,
		'rest_base'             => 'business-listing',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'business_listing_init' );

/**
 * Sets the post updated messages for the `business_listing` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `business_listing` post type.
 */
function business_listing_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['business-listing'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Business Listing updated. <a target="_blank" href="%s">View Business Listing</a>', 'wordplate' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'wordplate' ),
		3  => __( 'Custom field deleted.', 'wordplate' ),
		4  => __( 'Business Listing updated.', 'wordplate' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Business Listing restored to revision from %s', 'wordplate' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Business Listing published. <a href="%s">View Business Listing</a>', 'wordplate' ), esc_url( $permalink ) ),
		7  => __( 'Business Listing saved.', 'wordplate' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Business Listing submitted. <a target="_blank" href="%s">Preview Business Listing</a>', 'wordplate' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Business Listing scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Business Listing</a>', 'wordplate' ),
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Business Listing draft updated. <a target="_blank" href="%s">Preview Business Listing</a>', 'wordplate' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'business_listing_updated_messages' );

/**
 * Registers the `category` taxonomy,
 * for use with 'business-listing'.
 */
function category_init() {
	register_taxonomy( 'category', array( 'business-listing' ), array(
		'hierarchical'      => true,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_ui'           => true,
		'show_admin_column' => true,
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
			'separate_items_with_commas' => __( 'Separate categories with commas', 'wordplate' ),
			'add_or_remove_items'        => __( 'Add or remove categories', 'wordplate' ),
			'choose_from_most_used'      => __( 'Choose from the most used categories', 'wordplate' ),
			'not_found'                  => __( 'No categories found.', 'wordplate' ),
			'no_terms'                   => __( 'No categories', 'wordplate' ),
			'menu_name'                  => __( 'Categories', 'wordplate' ),
			'items_list_navigation'      => __( 'Categories list navigation', 'wordplate' ),
			'items_list'                 => __( 'Categories list', 'wordplate' ),
			'most_used'                  => _x( 'Most Used', 'category', 'wordplate' ),
			'back_to_items'              => __( '&larr; Back to Categories', 'wordplate' ),
		),
		'show_in_rest'      => true,
		'rest_base'         => 'category',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	) );

}
add_action( 'init', 'category_init' );

/**
* Sets the post updated messages for the `category` taxonomy.
*
* @param  array $messages Post updated messages.
* @return array Messages for the `category` taxonomy.
*/
function category_updated_messages( $messages ) {

	$messages['category'] = array(
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
add_filter( 'term_updated_messages', 'category_updated_messages' );

if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_5bb3d48fd4fe4',
		'title' => 'Contact Info',
		'fields' => array(
			array(
				'key' => 'field_5bb3d49a7ebb3',
				'label' => 'Address',
				'name' => 'address',
				'type' => 'textarea',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'new_lines' => '',
			),
			array(
				'key' => 'field_5bb3d50f08640',
				'label' => 'Phone Number',
				'name' => 'phone_number',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5bb3d53c9c0a1',
				'label' => 'Toll Free Phone Number',
				'name' => 'toll_free_phone_number',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5bb3d54a9093d',
				'label' => 'Fax Number',
				'name' => 'fax_number',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5bb3d553694f8',
				'label' => 'Email Address',
				'name' => 'email_address',
				'type' => 'email',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array(
				'key' => 'field_5bb3d565fd977',
				'label' => 'Website',
				'name' => 'website',
				'type' => 'url',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
			),
			array(
				'key' => 'field_5bb3e3107f673',
				'label' => 'Photo',
				'name' => 'photo',
				'type' => 'image',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'target_size' => 'custom',
				'width' => 400,
				'height' => 300,
				'preview_size' => 'medium',
				'save_in_media_library' => 'yes',
				'retina_mode' => 'no',
				'save_format' => 'object',
				'library' => 'all',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'business-listing',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));
	
endif;

function getBusinessListings($taxonomy = ''){
	$args = [
		'posts_per_page'   => -1,
		'orderby'          => 'menu_order',
		'order'            => 'ASC',
		'post_type'        => 'business-listing',
		'post_status'      => 'publish' 
	];

	if ( $taxonomy != '' ) {
		$categoryarray = [
			'relation' => 'AND',
			[
				'taxonomy'         => 'category',
				'field'            => 'slug',
				'terms'            => $taxonomy,
				'include_children' => false,
			],
		];
		$args['tax_query'] = $categoryarray;
	}

	$request = get_posts($args);

	$output = [];
	foreach ($request as $item) {
		$item->address = get_field('address',$item->ID);
		$item->phone_number = get_field('phone_number',$item->ID);
		$item->toll_free_phone_number = get_field('toll_free_phone_number',$item->ID);
		$item->fax_number = get_field('fax_number',$item->ID);
		$item->email_address = get_field('email_address',$item->ID);
		$item->website = get_field('website',$item->ID);
		$item->photo = get_field('photo',$item->ID);

		$output[] = $item;
	}

	return $output;

}

function business_listing_shortcode( $atts ) {
	$a = shortcode_atts( array(
		'category' => ''
	), $atts );

	$output = '<div class="row business-listings">';
	foreach(getBusinessListings($a['category']) as $listing){
		$output .= '
		<div class="col-md-6 col-lg-4 mb-4">
			<div class="card text-center full-height">
				'.($listing->photo != '' ? '<img src="'.$listing->photo['url'].'" alt="'.$listing->photo['alt'].'" class="card-img-top" >' : '').'
				<div class="card-body">
					<p><strong>'.$listing->post_title.'</strong></p>
					'.($listing->address!='' ? '<p>' . nl2br($listing->address) . '</p>' : '' ).'
					<p>
					'.($listing->phone_number!='' ? '<a href="tel:'.$listing->phone_number.'">'.$listing->phone_number.'</a><br>' : '').'
					'.($listing->toll_free_phone_number!='' ? '<a href="tel:'.$listing->toll_free_phone_number.'">'.$listing->toll_free_phone_number.'</a> <small>toll free</small><br>' : '').'
					'.($listing->fax_number!='' ? $listing->fax_number.' <small>fax</small><br>' : '').'
					'.($listing->email_address!='' ? '<a href="mailto:'.$listing->email_address.'">'.$listing->email_address.'</a><br>' : '').'
					'.($listing->website!='' ? '<a href="'.$listing->website.'">visit website</a><br>' : '').'
					</p>
				</div>
			</div>
		</div>
		';
	}
	$output .= '</div>';

	return $output;
}
add_shortcode( 'business_listings', 'business_listing_shortcode' );