<?php
$headerImageData = get_field('header_image');

bladerunner('views.pages.index',[
    'headerImage' => ($headerImageData ? $headerImageData['url']: null),
    'headline'    => get_field('headline')
]);