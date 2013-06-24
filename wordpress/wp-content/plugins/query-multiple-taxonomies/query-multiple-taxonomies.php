<?php
/*
Plugin Name: Query Multiple Taxonomies
Version: 1.6.2
Description: Filter posts through multiple custom taxonomies using a widget.
Author: scribu
Author URI: http://scribu.net
Plugin URI: http://scribu.net/wordpress/query-multiple-taxonomies
Text Domain: query-multiple-taxonomies
Domain Path: /lang
*/

require dirname( __FILE__ ) . '/scb/load.php';

function _qmt_init() {
	load_plugin_textdomain( 'query-multiple-taxonomies', '', basename( dirname( __FILE__ ) ) . '/lang' );

	require_once dirname( __FILE__ ) . '/core.php';
	require_once dirname( __FILE__ ) . '/walkers.php';
	require_once dirname( __FILE__ ) . '/widget.php';

	Taxonomy_Drill_Down_Widget::init( __FILE__ );
}
scb_init( '_qmt_init' );

add_action('wp_ajax_get_place_list', 'get_place_list');
add_action('wp_ajax_nopriv_get_place_list', 'get_place_list');

function get_place_list(){
	$tax_query = array();
	
	$query = array(
		'post_type'=>$_POST['post_type']
	);
	
	if (isset($_POST['qmt'])){
		foreach ( $_POST['qmt'] as $taxonomy => $terms ) {
			$query['tax_query'][] = array(
				'taxonomy' => $taxonomy,
				'terms' => $terms,
				'field' => 'term_id',
				'operator' => 'IN',
				'include_children' => true
			);
		}
	}

	$posts = get_posts($query);
	
	// add items details
	foreach ($posts as $item) {
		$item->link = get_permalink($item->ID);
		$image = wp_get_attachment_image_src( get_post_thumbnail_id($item->ID) );
		if($image !== false){
			$item->thumbnailDir = $image[0];
		} else {
			$item->thumbnailDir = $aitThemeOptions->directory->defaultItemImage;
		}
		$item->marker = $term->marker;
		$item->optionsDir = get_post_meta($item->ID, '_ait-dir-item', true);
		$item->packageClass = getItemPackageClass($item->post_author);

		$item->rating = aitCalculateMeanForPost($item->ID);
	}
	
	$output = json_encode($posts);
 	// response output
    header( "Content-Type: application/json" );
    echo $output;
    exit;
}