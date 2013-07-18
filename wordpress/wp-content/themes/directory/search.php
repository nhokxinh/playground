<?php

/**
 * AIT WordPress Theme
 *
 * Copyright (c) 2012, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */

$latteParams['type'] = (isset($_GET['dir-search'])) ? true : false;
$ajax = (isset($_GET['ajax'])) ? true : false;
if($latteParams['type']){
	$latteParams['isDirSearch'] = true;
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

		$item->rating = aitCalculateMeanForPost($item->ID);
	}

} else {
	$posts = WpLatte::createPostEntity($wp_query->posts);
}
$latteParams['posts'] = $posts;
if (!$ajax){
    WPLatte::createTemplate(basename(__FILE__, '.php'), $latteParams)->render();
} else {
    $result = '';
    $self = str_replace('ajax=yes&', '', $_SERVER["REQUEST_URI"]);
    $current_url = 'http://' . $_SERVER["SERVER_NAME"] . $self;
    if (!empty($posts)) {
        $str_li = '';
        foreach ($posts as $item) {
            $str_li .= '<li class="s_item">
                            <a href="' . $item->link . '"><img src="' . $item->thumbnailDir . '" alt="' . $item->post_title . '" />
                            <h3>' . $item->post_title. '</h3>
                            <span>' . $item->post_excerpt . '</span></a>
                        </li>';
        }
        if ($str_li != "") {
            $result = '<ul class="s_ul">' . $str_li . '
                    <li class="s_item s_last"><a href="' . $current_url . '">Xem thêm</a></li>
                    </ul>';
        }
    } else {
        $result = '<center>Không có kết quả nào được tìm thấy.</center>';
    }
    echo $result;
}