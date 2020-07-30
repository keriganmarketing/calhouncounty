<?php

namespace KMA\Modules\KMAServices;

use KMA\Modules\KMAHelpers\CustomTaxonomy;
use KMA\Modules\KMAHelpers\CustomPostType;
use KeriganSolutions\KMASlider\KMASliderModule;

class Slider extends KMASliderModule {


    public function __construct()
    {
        //blank on purpose
    }
    
    public function use()
    {
        
        // Create the post type for Slide
        add_action( 'init', [$this, 'createPostType'] );
        add_filter( 'post_updated_messages', [$this, 'postTypeUpdated'] );

        // Create the taxonomy for Slider
        add_action( 'init', [$this, 'createTaxonomy'] );
        add_filter( 'term_updated_messages', [$this, 'taxonomyUpdated'] );

        if ( function_exists( 'acf_add_local_field_group' ) ) {
            add_action( 'init', [$this, 'registerFields'] );
        }     
        
        add_action('rest_api_init', [$this, 'addRoutes']);
    }

}