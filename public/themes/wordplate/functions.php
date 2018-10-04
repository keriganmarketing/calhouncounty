<?php

declare(strict_types=1);

use KeriganSolutions\KMATeam\Team;
use KeriganSolutions\KMAContactInfo\ContactInfo;

// Register plugin helpers.
require template_path('includes/plugins/plate.php');
require template_path('includes/plugins/theme-setup.php');
require template_path('includes/plugins/acf-page-fields.php');
require('post-types/business-listing.php');

(new Team())->use();
(new ContactInfo())->addField([
    'key' => 'hours',
    'label' => 'Hours',
    'name' => 'hours',
    'type' => 'text',
    'parent' => 'group_contact_info',
])->use();

$socialLinks = new KeriganSolutions\SocialMedia\SocialSettingsPage();
if (is_admin()) {
    $socialLinks->createPage();
}

new KeriganSolutions\KMASlider\KMASliderModule();

// Set theme defaults.
add_action('after_setup_theme', function () {
    // Disable the admin toolbar.
    show_admin_bar(false);

    // Add post thumbnails support.
    add_theme_support('post-thumbnails');

    // Add title tag theme support.
    add_theme_support('title-tag');

    // Add HTML5 theme support.
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'widgets',
    ]);
});

// Enqueue and register scripts the right way.
add_action('wp_enqueue_scripts', function () {
    wp_deregister_script('jquery');

    wp_enqueue_style('wordplate', mix('styles/main.css'));

    wp_register_script('wordplate', mix('scripts/app.js'), '', '', true);
    wp_enqueue_script('wordplate', mix('scripts/app.js'), '', '', true);
});


// Remove JPEG compression.
add_filter('jpeg_quality', function () {
    return 100;
}, 10, 2);

// Custom Blade Cache Path
add_filter('bladerunner/cache/path', function () {
    return '../../uploads/.cache';
});

function expand_login_logo()
{ ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            width: auto;
        }
    </style>
<?php
}
add_action('login_enqueue_scripts', 'expand_login_logo');

/**
 * Registers the `category` taxonomy,
 * for use with 'team'.
 */
function category_init() {
    register_taxonomy( 'category', array( 'team' ), array(
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

function team_shortcode() {
    $output =
    '<div class="team-grid">
        <div class="row justify-content-center">';

    $team = new Team();
    $members = $team->queryTeam();

    foreach($members as $member){
        $output .=
        '<div class="col-md-6 col-lg-4">
            <div class="card team-member text-center">
                <a href="' . $member['link'] . '" >
                    <img src="' . $member['image']['sizes']['thumbnail'] . '" class="card-img-top" alt="' . $member['name'] . '" >
                </a>
                <div class="card-body">
                    <h3 class="text-uppercase text-dark">' . $member['name'] . '</h3>
                    <p class="text-uppercase text-light">' . $member['title'] . '</p>
                    <p class="text-uppercase text-light">
                    <a href="mailto:' . $member['email'] . '" >' . $member['email'] . '</a><br>
                    <a href="tel:' . $member['phone'] . '" >' . $member['phone'] . '</p>
                </div>
            </div>
            <div class="member-button text-center">
                <a href="' . $member['link'] . '" class="btn btn-outline-light" >View Bio</a>
            </div>
        </div>';
    }

    $output .= '</div></div>';

    return $output;
}
add_shortcode( 'team', 'team_shortcode' );