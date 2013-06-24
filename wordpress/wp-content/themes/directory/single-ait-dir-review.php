<?php

$latteParams['post'] = WpLatte::createPostEntity(
	$GLOBALS['wp_query']->post,
	array(
		'meta' => $GLOBALS['pageOptions'],
	)
);

$latteParams['options'] = get_post_meta($latteParams['post']->id, 'eventbox', true);

// check url link
if (isset($latteParams['options']['web']) && !empty($latteParams['options']['web']) && (strpos($latteParams['options']['web'],'http://') === false && strpos($latteParams['options']['web'],'https://') === false)){
    $latteParams['options']['web'] = 'http://'.$latteParams['options']['web'];
}

$thumbnailDir = wp_get_attachment_image_src( get_post_thumbnail_id($latteParams['post']->id) );
if($thumbnailDir !== false){
	$latteParams['thumbnailDir'] = $thumbnailDir[0];
} else {
	$latteParams['thumbnailDir'] = $aitThemeOptions->directory->defaultItemImage;
}
// get term for this items
$terms = wp_get_post_terms($latteParams['post']->id, 'event_types');

// get items from current category 
$latteParams['term'] = array();
$latteParams['ancestors'] = array();
$latteParams['items'] = array();

//LongLC added
$venue_id = get_post_meta($latteParams['post']->id, 'pg_review_venue', true);
$venue = get_post($venue_id);
$latteParams['venue'] = get_post_meta($venue_id, '_ait-dir-item', true);
$latteParams['venue']['name'] = get_the_title($venue_id);
$latteParams['venue']['permalink'] = get_permalink($venue_id);
$latteParams['venue']['excerpt'] = $venue->post_excerpt;
$venue_entity = WpLatte::createPostEntity(
	$venue,
	array(
		'meta' => $GLOBALS['pageOptions'],
	)
);
$latteParams['venue']['thumb'] = $venue_entity->thumbnailSrc;

$latteParams['event_date'] = get_post_meta($latteParams['post']->id, 'pg_event_date', true);
$latteParams['event_time'] = get_post_meta($latteParams['post']->id, 'pg_event_time', true);

$venue_options = get_post_meta($venue_id, '_ait-dir-item', true);
$latteParams['options']['gpsLatitude'] = $venue_options['gpsLatitude'];
$latteParams['options']['gpsLongitude'] = $venue_options['gpsLongitude'];

// pending preview
if($GLOBALS['wp_query']->post->post_status != 'publish'){
	
	$item = $GLOBALS['wp_query']->post;
	// options
	$item->optionsDir = get_post_meta($item->ID, 'eventbox', true);
	// link
	$item->link = get_permalink($item->ID);
	// thumbnail
	$image = wp_get_attachment_image_src( get_post_thumbnail_id($item->ID) );
	if($image !== false){
		$item->thumbnailDir = $image[0];
	} else {
		$item->thumbnailDir = $GLOBALS['aitThemeOptions']->directory->defaultItemImage;
	}
	// marker
	$terms = wp_get_post_terms($item->ID, 'event_types');
	$termMarker = $GLOBALS['aitThemeOptions']->directoryMap->defaultMapMarkerImage;
	if(isset($terms[0])){
		$termMarker = getCategoryMeta("marker", intval($terms[0]->term_id));
	}
	$item->marker = $termMarker;
	// excerpt
	$item->excerptDir = aitGetPostExcerpt($item->post_excerpt,$item->post_content);
	$item->packageClass = getItemPackageClass($item->post_author);

	$latteParams['term'] = null;
	$latteParams['items'] = array($item);
	$latteParams['ancestors'] = array();
	
} else {
	if(isset($terms[0])){
		
		// term
		$terms[0]->link = get_term_link(intval($terms[0]->term_id), 'event_types');
		$terms[0]->icon = getCategoryMeta("icon", intval($terms[0]->term_id));
		$terms[0]->marker = getCategoryMeta("marker", intval($terms[0]->term_id));

		$termAncestors = array_reverse(get_ancestors(intval($terms[0]->term_id), 'event_types'));
		$ancestors = array();
		foreach ($termAncestors as $anc) {
			$term = get_term($anc, 'event_types');
			$term->link = get_term_link(intval($term->term_id), 'event_types');
			$ancestors[] = $term;
		}

		$categoryID = intval($terms[0]->term_id);
		$location = 0;
		$search = '';
		$radiusKm = ($aitThemeOptions->directory->showDistanceInDetail) ? $aitThemeOptions->directory->showDistanceInDetail : 1000 ;
		// center and radius
		$radius = array($radiusKm,$latteParams['options']['gpsLatitude'],$latteParams['options']['gpsLongitude']);

		$venue_category = wp_get_post_terms($venue_id, 'ait-dir-item-category');
		$venue_category_id = $venue_category[0]->term_id;
		$items = getItems($venue_category_id,$location,$search,$radius);

		$latteParams['term'] = $terms[0];
		$latteParams['items'] = $items;
		$latteParams['ancestors'] = $ancestors;

	} else {
		// no category selected

		// all items
		$items = getItems();
		$thisItem;
		for($i = 0; $i < count($items); $i++) {
			if($items[$i]->ID == $latteParams['post']->id) { 
				$thisItem = $items[$i]; 
			}
		}
		unset($items);

		$latteParams['term'] = null;
		$latteParams['items'] = array($thisItem);
		$latteParams['ancestors'] = array();
	}
}

$latteParams['isDirSingle'] = true;

$latteParams['sidebarType'] = 'item';

$latteParams['rating'] = aitCalculateMeanForPost($latteParams['post']->id);

/**
 * Fire!
 */
WPLatte::createTemplate(basename(__FILE__, '.php'), $latteParams)->render();