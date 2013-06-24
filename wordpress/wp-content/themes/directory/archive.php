<?php

/**
 * AIT WordPress Theme
 *
 * Copyright (c) 2012, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */

// directory search
$latteParams['type'] = (isset($_GET['dir-search'])) ? true : false;
$latteParams['post_type'] = (isset($_GET['post_type'])) ? true : false;

if($latteParams['type']){
	// show all items on map
	if(isset($aitThemeOptions->search->searchShowMap)){
		$radius = array();
		if(isset($_GET['geo'])){
			$radius[] = $_GET['geo-radius'];
			$radius[] = $_GET['geo-lat'];
			$radius[] = $_GET['geo-lng'];
		}
		$latteParams['items'] = getItems(intval($_GET['categories']),intval($_GET['locations']),$GLOBALS['wp_query']->query_vars['s'],$radius);
	}

	$posts = $wp_query->posts;
	foreach ($posts as $item) {
		$item->link = get_permalink($item->ID);
		$image = wp_get_attachment_image_src( get_post_thumbnail_id($item->ID) );
		if($image !== false){
			$item->thumbnailDir = $image[0];
		} else {
			$item->thumbnailDir = $aitThemeOptions->directory->defaultItemImage;
		}
		$item->excerptDir = aitGetPostExcerpt($item->post_excerpt,$item->post_content);
		$item->packageClass = getItemPackageClass($item->post_author);

		$item->rating = aitCalculateMeanForPost($item->ID);
	}

	$latteParams['posts'] = $posts;
} else if ($latteParams['post_type']){
	$post_type = $_GET['post_type'];
	
	// $term = $GLOBALS['wp_query']->queried_object;
	// if (!$term){
	// 	$post_type_obj = get_post_type_object($post_type);
	// 	$term = (object) array('name' => $post_type_obj->label,'link' => get_bloginfo('url') . '/?post_type=' . $post_type);
	// }
	$post_type_obj = get_post_type_object($post_type);
	$term = (object) array('name' => $post_type_obj->label,'link' => get_bloginfo('url') . '/?post_type=' . $post_type);
	
	$posts = WpLatte::createPostEntity($GLOBALS['wp_query']->posts);
	
	// $query = array(
	// 	'numberposts'		=> -1,
	// 	'post_type'			=>	$post_type
	// );
	// foreach ($_GET as $key => $val){
	// 	if ($key != 'post_type'){
	// 		$query['tax_query'][] = array(
	// 			'taxonomy' => $key,
	// 			'terms' => $val,
	// 			'field' => 'slug',
	// 			'include_children' => true
	// 		);
	// 	}
	// }
	
	$tax_queries = array();
	foreach ($_GET as $key => $val){
		if ($key != 'post_type'){
			$tax = $key;
			if (strpos($key,'dir-item-') === 0){
				$tax = 'ait-' . $key;
			}
			
			$term_name = get_term_by('slug',$val,$tax)->name;
			$tax_queries[] = (object) array(
				'name' => get_taxonomy($tax)->label . ': ' . $term_name,
				'link' => get_bloginfo('url') . '/?' . $key . '=' . $val
			);
		}
	}
	
	// $items = get_posts($query);
	
	$items = $GLOBALS['wp_query']->posts;
	
	if ($post_type == 'ait-dir-item'){
		$subcategories =  get_terms( 'ait-dir-item-category', array('parent' => intval($term->term_id), 'hide_empty' => false) );

		$term->icon = getCategoryMeta("icon",intval($term->term_id));
		$term->marker = getCategoryMeta("marker",intval($term->term_id));

		// add subcategory links
		foreach ($subcategories as $category) {
			$category->link = get_term_link(intval($category->term_id), 'ait-dir-item-category') . '&post_tpe=ait-dir-item';
			$category->icon = getCategoryMeta("icon",intval($category->term_id));
			$category->excerpt = getCategoryMeta("excerpt", intval($category->term_id));
		}

		// add items details
		foreach ($items as $item) {
			$item->link = get_permalink($item->id);
			$image = wp_get_attachment_image_src( get_post_thumbnail_id($item->id) );
			if($image !== false){
				$item->thumbnailDir = $image[0];
			} else {
				$item->thumbnailDir = $aitThemeOptions->directory->defaultItemImage;
			}
			$item->marker = $term->marker;
			$item->optionsDir = get_post_meta($item->id, '_ait-dir-item', true);
			$item->packageClass = getItemPackageClass($item->post_author);
			$item->post_title = $item->title;
			$item->rating = aitCalculateMeanForPost($item->id);
		}
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

		// breadcrumbs 
		$ancestorsIDs = array_reverse(get_ancestors(intval($term->term_id), 'ait-dir-item-category'));
		$ancestors = array();
		foreach ($ancestorsIDs as $anc) {
			$cat = get_term($anc, 'ait-dir-item-category');
			$cat->link = get_term_link($anc, 'ait-dir-item-category');
			$ancestors[] = $cat;
		}
	} else if ($post_type == 'ait-dir-event'){
		$subcategories =  get_terms( 'event_types', array('parent' => intval($term->term_id), 'hide_empty' => false) );

		$term->icon = getCategoryMeta("icon",intval($term->term_id));
		$term->marker = getCategoryMeta("marker",intval($term->term_id));

		// add subcategory links
		foreach ($subcategories as $category) {
			$category->link = get_term_link(intval($category->term_id), 'event_types') . '&post_type=ait-dir-event';
			$category->icon = getCategoryMeta("icon",intval($category->term_id));
			$category->excerpt = $category->description;
		}

		$items = array();
		// add posts details
		foreach ($posts as $item) {
			$item->link = get_permalink($item->id);
			$image = wp_get_attachment_image_src( get_post_thumbnail_id($item->id) );
			if($image !== false){
				$item->thumbnailDir = $image[0];
			} else {
				$item->thumbnailDir = $aitThemeOptions->directory->defaultItemImage;
			}
			$item->optionsDir = get_post_meta(get_post_meta($item->ID,'pg_event_venue',true), '_ait-dir-item', true);
			//$item->excerptDir = aitGetPostExcerpt($item->excerpt,$item->content);
			$item->packageClass = getItemPackageClass($item->author->id);
			
			$item->rating = aitCalculateMeanForPost($item->id);
			
			$venue_id = get_post_meta($item->id,'pg_event_venue',true);
			$venue = WpLatte::createPostEntity(get_post($venue_id));
			array_push($items,$venue);
		}
		
		// add items details
		foreach ($items as $item) {
			$item->link = get_permalink($item->id);
			$image = wp_get_attachment_image_src( get_post_thumbnail_id($item->id) );
			if($image !== false){
				$item->thumbnailDir = $image[0];
			} else {
				$item->thumbnailDir = $aitThemeOptions->directory->defaultItemImage;
			}
			$item->marker = $term->marker;
			$item->optionsDir = get_post_meta($item->id, '_ait-dir-item', true);
			$item->packageClass = getItemPackageClass($item->post_author);
			$item->post_title = $item->title;
			$item->rating = aitCalculateMeanForPost($item->id);
		}

		// breadcrumbs 
		$ancestorsIDs = array_reverse(get_ancestors(intval($term->term_id), 'event_types'));
		$ancestors = array();
		foreach ($ancestorsIDs as $anc) {
			$cat = get_term($anc, 'event_types');
			$cat->link = get_term_link($anc, 'event_types');
			$ancestors[] = $cat;
		}
	} else if ($post_type == 'ait-dir-review'){
		$subcategories =  array();

		$term->icon = getCategoryMeta("icon",intval($term->term_id));
		$term->marker = getCategoryMeta("marker",intval($term->term_id));

		// add items details
		foreach ($items as $item) {
			$item->link = get_permalink($item->id);
			$image = wp_get_attachment_image_src( get_post_thumbnail_id($item->ID) );
			if($image !== false){
				$item->thumbnailDir = $image[0];
			} else {
				$item->thumbnailDir = $aitThemeOptions->directory->defaultItemImage;
			}
			$item->marker = $term->marker;
			$item->optionsDir = get_post_meta($item->id, 'reviewbox', true);
			$item->packageClass = getItemPackageClass($item->post_author);
			$item->post_title = $item->title;
			$item->rating = aitCalculateMeanForPost($item->id);
		}
		// add posts details
		foreach ($posts as $item) {
			$item->link = get_permalink($item->id);
			$image = wp_get_attachment_image_src( get_post_thumbnail_id($item->id) );
			if($image !== false){
				$item->thumbnailDir = $image[0];
			} else {
				$item->thumbnailDir = $aitThemeOptions->directory->defaultItemImage;
			}
			$item->optionsDir = get_post_meta($item->id, 'reviewbox', true);
			//$item->excerptDir = aitGetPostExcerpt($item->excerpt,$item->content);
			$item->packageClass = getItemPackageClass($item->author->id);

			$item->rating = aitCalculateMeanForPost($item->id);
		}

		// breadcrumbs 
		$ancestors = array();
	}

	$latteParams['ancestors'] = $ancestors;
	$latteParams['tax_queries'] = $tax_queries;
	$latteParams['term'] = $term;
	// $latteParams['term']->name = wp_title('','',false);
	$latteParams['subcategories'] = $subcategories;
	$latteParams['items'] = $items;
	$latteParams['posts'] = $posts;

	$latteParams['isDirTaxonomy'] = true;

	$latteParams['sidebarType'] = 'item';
	
	WPLatte::createTemplate('post-type-ait-dir-item.php', $latteParams)->render(); exit;
} else {

	$latteParams['archive'] = new WpLatteArchiveEntity();
	$latteParams['posts'] = WpLatte::createPostEntity($wp_query->posts);

}

WPLatte::createTemplate(basename(__FILE__, '.php'), $latteParams)->render();