<?php

// get iframe HTML
$iframe = get_field('video');

preg_match('/src="(.+?)"/', $iframe, $matches);
$src = $matches[1];

// add extra params to iframe src
$params = array(
    'rel'         => 0,
    'controls'    => 0,
    'showinfo'    => 0,
    'enablejsapi' => 1,
    'autoplay'    => 1
);
$newSrc = add_query_arg($params, $src);

$iframe = str_replace($src, $newSrc, $iframe);
$iframe = preg_replace('/width="(.+?)"/', '', $iframe);
$iframe = preg_replace('/height="(.+?)"/', '', $iframe);
$att    = 'class="embed-responsive-item" ref="videoplayer"  v-if="videoPlaying" ';

$iframe = str_replace('></iframe>', ' ' . $att . '></iframe>', $iframe);

bladerunner('views.pages.front', [
    'video' => $iframe
]);