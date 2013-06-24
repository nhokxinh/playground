<?php

/**
 * AIT WordPress Theme
 *
 * Copyright (c) 2012, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */

/**
 * Template Name: Directory Homepage Template
 * Description: This template show content, top level categories list and alternative content defined in Directory general settings 
 */

$latteParams['post'] = WpLatte::createPostEntity(
	$GLOBALS['wp_query']->post,
	array(
		'meta' => $GLOBALS['pageOptions'],
	)
);

//get latest reviews
$posts = WpLatte::createPostEntity(get_posts( array(
	'numberposts'		=> 10,
	'post_type'			=>	'ait-dir-review'
)));

// add posts details
foreach ($posts as $item) {
	$item->link = get_permalink($item->id);
	$image = wp_get_attachment_image_src( get_post_thumbnail_id($item->id) );
	if($image !== false){
		$item->thumbnailDir = $image[0];
	} else {
		$item->thumbnailDir = $aitThemeOptions->directory->defaultItemImage;
	}
	$item->optionsDir = get_post_meta($item->id, '_ait-dir-item', true);
	//$item->excerptDir = aitGetPostExcerpt($item->excerpt,$item->content);
	$item->packageClass = getItemPackageClass($item->author->id);
	
	$item->rating = aitCalculateMeanForPost($item->id);
}

$latteParams['posts'] = $posts;
$latteParams['headerSlider'] = $latteParams['post']->options('header')->slider;
$latteParams['sidebarType'] = 'home';
$latteParams['leftSidebarType'] = 'home';

/**
 * Fire!
 */
WPLatte::createTemplate(basename(__FILE__, '.php'), $latteParams)->render();
