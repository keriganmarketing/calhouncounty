<?php

declare(strict_types=1);

use KeriganSolutions\KMATeam\Team;
use KeriganSolutions\KMAContactInfo\ContactInfo;

(new KMA\Modules\KMAHelpers\Plate())->use();
(new KMA\Modules\KMAServices\SocialIcons())->use();
(new KMA\Modules\KMAServices\Slider())->use();

// Register plugin helpers.
// require template_path('includes/plugins/plate.php');
require template_path('includes/plugins/theme-setup.php');
require template_path('includes/plugins/acf-page-fields.php');
require('post-types/business-listing.php');
require('taxonomies/team-category.php');

(new Team())->use();
(new ContactInfo())->addField([
    'key' => 'hours',
    'label' => 'Hours',
    'name' => 'hours',
    'type' => 'text',
    'parent' => 'group_contact_info',
])->use();

// new KeriganSolutions\KMASlider\KMASliderModule();

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
    // wp_deregister_script('jquery');

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

function team_shortcode( $atts ) {
	$a = shortcode_atts( array(
        'category' => '',
        'limit' => -1
    ), $atts );
    
    $output =
    '<div class="team-grid">
        <div class="row">';

    $args = [
        'posts_per_page' => $a['limit'],
        'offset' => 0,
        'order' => 'ASC',
        'orderby' => 'menu_order',
        'post_type' => 'team',
        'post_status' => 'publish',
    ];

    if ( $a['category'] != '' ) {
		$categoryarray = [
			'relation' => 'AND',
			[
				'taxonomy'         => 'team-category',
				'field'            => 'slug',
				'terms'            => $a['category'],
				'include_children' => false,
			],
		];
		$args['tax_query'] = $categoryarray;
	}

    $team = get_posts($args);

    foreach($team as $member){
        $image = get_field('image', $member->ID);
        $output .=
        '<div class="col-md-6 col-lg-4">
            <div class="team-member text-center full-height justify-content-center">
                <a href="' . get_permalink($member->ID) . '" >
                    <img src="' . $image['sizes']['thumbnail'] . '" class="img-fluid" alt="' . $member->post_title . '" >
                </a>
                <div class="card-body">
                    <h3 class="text-secondary font-weight-bold">' . $member->post_title . '</h3>
                    <p class="m-0"><strong>' . get_field('title', $member->ID) . '</strong></p>
                    '.($member->post_content!='' ? '<p>'.nl2br($member->post_content).'</p>' : '').'
                    <p>
                        <a href="mailto:' . get_field('email', $member->ID) . '" >' . get_field('email', $member->ID) . '</a><br>
                        <a href="tel:' . get_field('phone', $member->ID) . '" >' . get_field('phone', $member->ID) . '</a>
                    </p>';
            if(get_field('website',$member->ID) != ''){
                $output .='<a class="btn btn-sm btn-primary rounded-pill" target="_blank" href="' . get_field('website', $member->ID) . '" >visit website</a>';
            }

        $output .='</div>
            </div>
        </div>';
    }

    $output .= '</div></div>';

    return $output;
}
add_shortcode( 'team', 'team_shortcode' );

/**
* Removes width and height attributes from image tags
* @param string $html
* @return string
*/
function remove_image_size_attributes( $html ) {
    return preg_replace( '/(width|height)="\d*"/', '', $html );
}
    
// Remove image size attributes from post thumbnails
add_filter( 'post_thumbnail_html', 'remove_image_size_attributes' );

// Remove image size attributes from images added to a WordPress post
add_filter( 'image_send_to_editor', 'remove_image_size_attributes' );
  
// Add Bootstrap responsive class to images
function add_image_class($class){
    $class .= ' img-fluid';
    return $class;
}

add_filter('get_image_tag_class','add_image_class');