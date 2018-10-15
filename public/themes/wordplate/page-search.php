<?php
$headerImageData = get_field('header_image');
$searchString = (isset($_GET['search']) ? $_GET['search'] : null);
$search = new WP_Query( ['s' => $searchString] );
$results = [];

if($search && !empty($search->posts)){
    foreach($search->posts as $result){
        if($result->post_content != ''){
            $results[] = $result;
        }
    }
}

bladerunner('views.pages.archive',[
    'headerImage'   => $headerImageData['url'],
    'headline'      => get_field('headline'),
    'searchString'  => $searchString,
    'results'       => $results
]);