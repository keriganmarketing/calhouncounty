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