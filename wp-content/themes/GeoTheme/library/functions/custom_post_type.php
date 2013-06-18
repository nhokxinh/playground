<?php
global $wp_query;

// place permilink structure
global $wp_rewrite;
$place_structure = '/city/%city%/%placecategory%/%place%';
$place_structure = get_option('place_link');
//$event_structure = '/city/%city%/%eventcategory%/%event%';
//$wp_rewrite->add_rewrite_tag("%event%", '([^/]+)', "event=");
$wp_rewrite->add_rewrite_tag("%place%", '([^/]+)', "place=");
//$wp_rewrite->add_permastruct('event', $event_structure, false);
$wp_rewrite->add_permastruct('place', $place_structure, false);


// Add filter to plugin init function
//add_filter('post_link', 'place_permalink', 10, 3);
//add_filter('post_type_link', 'event_permalink', 10, 3);	
add_filter('post_type_link', 'place_permalink', 10, 3);	

// Adapted from get_permalink function in wp-includes/link-template.php
function place_permalink($permalink, $post_id, $leavename) {
	$post = get_post($post_id);
	$rewritecode = array(
		'%year%',
		'%monthnum%',
		'%day%',
		'%hour%',
		'%minute%',
		'%second%',
		$leavename? '' : '%postname%',
		'%post_id%',
		'%placecategory%',
		'%author%',
		'%city%',
		$leavename? '' : '%pagename%',
	);
 
	if ( '' != $permalink && !in_array($post->post_status, array('draft', 'pending', 'auto-draft')) ) {
		$unixtime = strtotime($post->post_date);
 
		$category = '';
		if ( strpos($permalink, '%placecategory%') !== false ) {
			//$cats = get_the_category($post->ID);
			$terms = get_the_terms($post->ID, 'placecategory');
//print_r($terms);foreach ($terms as $taxindex => $taxitem) {
foreach ($terms as $taxindex => $taxitem) {
$cat = $taxitem->slug;

}
$category = $cat;
			//print_r ($cats);
			/*if ( $cats ) {
				usort($cats, '_usort_terms_by_ID'); // order by ID
				$category = $cats[0]->slug;
				if ( $parent = $cats[0]->parent )
					$category = get_category_parents($parent, false, '/', true) . $category;
			}*/
			// show default category in permalinks, without
			// having to assign it explicitly
			if ( empty($category) ) {
				$category = 'category';
			}
			//$category ='';
			
		} 
		
		$author = '';
		if ( strpos($permalink, '%author%') !== false ) {
			$authordata = get_userdata($post->post_author);
			$author = $authordata->user_nicename;
		}
		
		$city = '';
		if ( strpos($permalink, '%city%') !== false ) {
			global $wpdb,$city_info;
			$multicity_db_table_name = $wpdb->base_prefix . "multicity"; // DATABASE TABLE  MULTY CITY
			$pcity_id = get_post_meta($post->ID,'post_city_id',true);
			if($pcity_id){
		//$city = strtolower($wpdb->get_var("SELECT cityname FROM $multicity_db_table_name WHERE city_id =\"$pcity_id\""));
		
		$city = city_name_url($pcity_id); 
		

			}else{$city = 'na';}
		}
 
		$date = explode(" ",date('Y m d H i s', $unixtime));
		$rewritereplace =
		array(
			$date[0],
			$date[1],
			$date[2],
			$date[3],
			$date[4],
			$date[5],
			$post->post_name,
			$post->ID,
			$category,
			$author,
			$city,
			$post->post_name,
		);
		$permalink = str_replace($rewritecode, $rewritereplace, $permalink);
	} else { // if they're not using the fancy permalink option
	}
	return $permalink;
}
##################
function event_permalink($permalink, $post_id, $leavename) {
	$post = get_post($post_id);
	$rewritecode = array(
		'%year%',
		'%monthnum%',
		'%day%',
		'%hour%',
		'%minute%',
		'%second%',
		$leavename? '' : '%postname%',
		'%post_id%',
		'%eventcategory%',
		'%author%',
		'%city%',
		$leavename? '' : '%pagename%',
	);
 
	if ( '' != $permalink && !in_array($post->post_status, array('draft', 'pending', 'auto-draft')) ) {
		$unixtime = strtotime($post->post_date);
 
		$category = '';
		if ( strpos($permalink, '%eventcategory%') !== false ) {
			//$cats = get_the_category($post->ID);
			$terms = get_the_terms($post->ID, 'eventcategory');
//print_r($terms);foreach ($terms as $taxindex => $taxitem) {
foreach ($terms as $taxindex => $taxitem) {
$cat = $taxitem->slug;

}
$category = $cat;
			//print_r ($cats);
			/*if ( $cats ) {
				usort($cats, '_usort_terms_by_ID'); // order by ID
				$category = $cats[0]->slug;
				if ( $parent = $cats[0]->parent )
					$category = get_category_parents($parent, false, '/', true) . $category;
			}*/
			// show default category in permalinks, without
			// having to assign it explicitly
			if ( empty($category) ) {
				$category = 'category';
			}
			//$category ='';
			
		} 
		
		$author = '';
		if ( strpos($permalink, '%author%') !== false ) {
			$authordata = get_userdata($post->post_author);
			$author = $authordata->user_nicename;
		}
		
		$city = '';
		if ( strpos($permalink, '%city%') !== false ) {
			global $wpdb,$city_info;
			$multicity_db_table_name = $wpdb->base_prefix . "multicity"; // DATABASE TABLE  MULTY CITY
			$pcity_id = get_post_meta($post->ID,'post_city_id',true);
			if($pcity_id!=''){
		//$city = strtolower($wpdb->get_var("SELECT cityname FROM $multicity_db_table_name WHERE city_id =\"$pcity_id\""));
		$city = city_name_url($pcity_id);
			}else{$city = 'na';}
		}
 
		$date = explode(" ",date('Y m d H i s', $unixtime));
		$rewritereplace =
		array(
			$date[0],
			$date[1],
			$date[2],
			$date[3],
			$date[4],
			$date[5],
			$post->post_name,
			$post->ID,
			$category,
			$author,
			$city,
			$post->post_name,
		);
		$permalink = str_replace($rewritecode, $rewritereplace, $permalink);
	} else { // if they're not using the fancy permalink option
	}
	return $permalink;
}

//----------------------------------------------------------------------//
// Initiate the plugin to add custom post type of "places" and "events"
//----------------------------------------------------------------------//
// add_action("init", "custom_posttype_menu_wp_admin");
// function custom_posttype_menu_wp_admin()
// {
// //===============EVENT SECTION START================
// register_post_type(	'event', 
// 				array(	'label' 			=> __('Events'),
// 						'labels' 			=> array(	'name' 					=> __('Events'),
// 														'singular_name' 		=> __('Event'),
// 														'add_new' 				=> __('Add Event'),
// 														'add_new_item' 			=> __('Add New Event'),
// 														'edit' 					=> __('Edit'),
// 														'edit_item' 			=> __('Edit Event'),
// 														'new_item' 				=> __('New Event'),
// 														'view_item'				=> __('View Event'),
// 														'search_items' 			=> __('Search Events'),
// 														'not_found' 			=> __('No Events found'),
// 														'not_found_in_trash' 	=> __('No Events found in trash')	),
// 						'public' 			=> true,
// 						'can_export'		=> true,
// 						'show_ui' 			=> true, // UI in admin panel
// 						'_builtin' 			=> false, // It's a custom post type, not built in
// 						'_edit_link' 		=> 'post.php?post=%d',
// 						'capability_type' 	=> 'post',
// 						'menu_icon' 		=> get_bloginfo('template_url').'/images/favicon.ico',
// 						'hierarchical' 		=> false,
// 						'rewrite' 			=> array(	"slug" => "events"	), // Permalinks
// 						//'rewrite' 			=> false,
// 						'query_var' 		=> "event", // This goes to the WP_Query schema
// 						'supports' 			=> array(	'title',
// 														'author', 
// 														'excerpt',
// 														'thumbnail',
// 														'comments',
// 														'editor', 
// 														'trackbacks',
// 														'custom-fields',
// 														'revisions') ,
// 						'show_in_nav_menus'	=> true ,
// 						'taxonomies'		=> array('eventcategory','event_tags')
// 					)
// 				);
// 
// // Register custom taxonomy
// $ecat_name=get_option('event_cat_pre');
// register_taxonomy(	"eventcategory", 
// 				array(	"event"	), 
// 				array (	"hierarchical" 		=> true, 
// 						"label" 			=> "Event Category", 
// 						'labels' 			=> array(	'name' 				=> __('Event Categories'),
// 														'singular_name' 	=> __('Event Category'),
// 														'search_items' 		=> __('Search Events'),
// 														'popular_items' 	=> __('Popular Event Categories'),
// 														'all_items' 		=> __('All Event Categories'),
// 														'parent_item' 		=> __('Parent Event Category'),
// 														'parent_item_colon' => __('Parent Event Category:'),
// 														'edit_item' 		=> __('Edit Event Category'),
// 														'update_item'		=> __('Update Event Category'),
// 														'add_new_item' 		=> __('Add New Event Category'),
// 														'new_item_name' 	=> __('New Event Category Name')	), 
// 						'public' 			=> true,
// 						'show_ui' 			=> true,
// 						//"rewrite" 			=> true
// 						'rewrite' => array('slug'=>"$ecat_name"),'with_front'=>false)
// 				);
// register_taxonomy(	"event_tags", 
// 				array(	"event"	), 
// 				array(	"hierarchical" 		=> false, 
// 						"label" 			=> "Event Tags", 
// 						'labels' 			=> array(	'name' 				=> __('Event Tags'),
// 														'singular_name' 	=> __('Event Tags'),
// 														'search_items' 		=> __('Search Event Tags'),
// 														'popular_items' 	=> __('Popular Event Tags'),
// 														'all_items' 		=> __('All Event Tags'),
// 														'parent_item' 		=> __('Parent Event Tags'),
// 														'parent_item_colon' => __('Parent Event Tags:'),
// 														'edit_item' 		=> __('Edit Event Tags'),
// 														'update_item'		=> __('Update Event Tags'),
// 														'add_new_item' 		=> __('Add New Event Tags'),
// 														'new_item_name' 	=> __('New Event Tags Name')	),  
// 						'public' 			=> true,
// 						'show_ui' 			=> true,
// 						"rewrite" 			=> true	)
// 				);
// register_taxonomy( 'city', 
// 				   array( 	'hierarchical' => FALSE, 'label' => __('City'),  
// 						'public' => TRUE, 'show_ui' => TRUE,
// 						//'query_var' => 'city',
// 						'rewrite' => true ) );
// 
// 
// }
// 
// //===============EVENT SECTION END================
// add_action("init", "place_posttype_menu_wp_admin");
// function place_posttype_menu_wp_admin()
// {
// //===============PLACE SECTION START================
// register_post_type(	'place', 
// 				array(	'label' 			=> __('Places'),
// 						'labels' 			=> array(	'name' 					=> __('Places'),
// 														'singular_name' 		=> __('Place'),
// 														'add_new' 				=> __('Add Place'),
// 														'add_new_item' 			=> __('Add New Place'),
// 														'edit' 					=> __('Edit'),
// 														'edit_item' 			=> __('Edit Place'),
// 														'new_item' 				=> __('New Pace'),
// 														'view_item'				=> __('View Place'),
// 														'search_items' 			=> __('Search Places'),
// 														'not_found' 			=> __('No Places found'),
// 														'not_found_in_trash' 	=> __('No Places found in trash')	),
// 						'public' 			=> true,
// 						'can_export'		=> true,
// 						'show_ui' 			=> true, // UI in admin panel
// 						'_builtin' 			=> false, // It's a custom post type, not built in
// 						'_edit_link' 		=> 'post.php?post=%d',
// 						'capability_type' 	=> 'post',
// 						'menu_icon' 		=> get_bloginfo('template_url').'/images/favicon.ico',
// 						'hierarchical' 		=> false,
// 						'rewrite' 			=> false, // Permalinks
// 						'query_var' 		=> true, // This goes to the WP_Query schema
// 						'supports' 			=> array(	'title',
// 														'author', 
// 														'excerpt',
// 														'thumbnail',
// 														'comments',
// 														'editor', 
// 														'trackbacks',
// 														'custom-fields',
// 														'revisions') ,
// 						'show_in_nav_menus'	=> true ,
// 						'taxonomies'		=> array('placecategory','place_tags')
// 					)
// 				);
// 
// // Register custom taxonomy
// $pcat_name=get_option('place_cat_pre');
// //$city_name = city_name_url($_SESSION['multi_city']);
// //$pcat_name= $city_name.'/'.$pcat_name;
// register_taxonomy(	"placecategory", 
// 				array(	"place"	), 
// 				array (	"hierarchical" 		=> true, 
// 						"label" 			=> "Place Category", 
// 						'labels' 			=> array(	'name' 				=> __('Place Categories'),
// 														'singular_name' 	=> __('Place Category'),
// 														'search_items' 		=> __('Search Places'),
// 														'popular_items' 	=> __('Popular Place Categories'),
// 														'all_items' 		=> __('All Place Categories'),
// 														'parent_item' 		=> __('Parent Place Category'),
// 														'parent_item_colon' => __('Parent Place Category:'),
// 														'edit_item' 		=> __('Edit Place Category'),
// 														'update_item'		=> __('Update Place Category'),
// 														'add_new_item' 		=> __('Add New Place Category'),
// 														'new_item_name' 	=> __('New Place Category Name')	), 
// 						'public' 			=> true,
// 						'show_ui' 			=> true,
// 						//"rewrite" 			=> true
// 						'rewrite' => array('slug'=>"$pcat_name",'with_front'=>false))
// 				);
// register_taxonomy(	"place_tags", 
// 				array(	"place"	), 
// 				array(	"hierarchical" 		=> false, 
// 						"label" 			=> "Pace Tags", 
// 						'labels' 			=> array(	'name' 				=> __('Place Tags'),
// 														'singular_name' 	=> __('Place Tags'),
// 														'search_items' 		=> __('Search Place Tags'),
// 														'popular_items' 	=> __('Popular Place Tags'),
// 														'all_items' 		=> __('All Place Tags'),
// 														'parent_item' 		=> __('Parent Place Tags'),
// 														'parent_item_colon' => __('Parent Place Tags:'),
// 														'edit_item' 		=> __('Edit Place Tags'),
// 														'update_item'		=> __('Update Place Tags'),
// 														'add_new_item' 		=> __('Add New Place Tags'),
// 														'new_item_name' 	=> __('New Place Tags Name')	),  
// 						'public' 			=> true,
// 						'show_ui' 			=> true,
// 						"rewrite" 			=> true	)
// 				);
// register_taxonomy( 'city', 
// 				   array( 	'hierarchical' => FALSE, 'label' => __('City'),  
// 						'public' => TRUE, 'show_ui' => TRUE,
// 						//'query_var' => 'city',
// 						'rewrite' => true ) );
// 
// 
// 
// // add to our plugin init function
// 
// 
// 
// }
// 
// add_action('admin_init', 'flush_rewrites');
// function flush_rewrites() {
// flush_rewrite_rules( false ); ################## FIX BY USER mcmcghee 
// }
//===============PLACE SECTION END================



/////The filter code to get the custom post type in the RSS feed
function myfeed_request($qv) {
	if (isset($qv['feed'])){ 
	if($_REQUEST['post_type']){$qv['post_type'] =  mysql_real_escape_string($_REQUEST['post_type']);}
	else{$qv['post_type'] = array('post', 'place', 'event');}}
	return $qv;
}
add_filter('request', 'myfeed_request');

###############################################
################ INVOICES START ###############
###############################################
$post_type = '';
	if($_REQUEST['post'])
	{
		global $wpdb;
		$pid=$_REQUEST['post'];
		$post_type = $wpdb->get_var("select post_type from $wpdb->posts where ID=\"$pid\"");
	}

if($_REQUEST['post_type']=='invoice' || $post_type=='invoice'){
//add_filter( 'display_post_states','custom_post_state');
add_action( 'post_submitbox_misc_actions', 'custom_status_metabox' );
}
function custom_post_state( $states ) {
	global $post;
	$show_custom_state = get_post_meta( $post->ID, '_status' );
	   if ( $show_custom_state ) {
		$states[] = __( '<span class="custom_state '.strtolower($show_custom_state[0]).'">'.$show_custom_state[0].'</span>' );
		}
	return $states;
}


function custom_status_metabox(){
	global $post;
	$custom  = get_post_custom($post->ID);
	$status  = $custom["_status"][0];
	$i   = 0;
	/* ----------------------------------- */
	/*   Array of custom status messages            */
	/* ----------------------------------- */
	$custom_status = array(
			'Paid',
			'Unpaid',
			'Overdue',
			'Free',
			'Canceled',
			'Subscription-Payment',
			'Subscription-Active',
			'Subscription-Canceled',
		);
	echo '<div class="misc-pub-section custom">';
	echo '<label>Invoice status: </label><select name="status">';
	echo '<option class="default">Invoice status</option>';
	echo '<option>-----------------</option>';
	for($i=0;$i<count($custom_status);$i++){
		if($status == $custom_status[$i]){
		    echo '<option value="'.$custom_status[$i].'" selected="true">'.$custom_status[$i].'</option>';
		  }else{
		    echo '<option value="'.$custom_status[$i].'">'.$custom_status[$i].'</option>';
		  }
		}
	echo '</select>';
	echo '<br /></div>';?>
    <?php if(get_post_status( $post->post_title )!='publish' ){?>
<div class="misc-pub-section curtime misc-pub-section-last">
<span id="publish_paid">
	<?php _e('Publish Related Post?');?>:  <input type="checkbox" name="publish_paid" id="publish_paid"  />
    </span>
</div> 
<?php }
}
add_action('save_post', 'save_status');
function save_status(){
	global $post, $wpdb;
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){ return $post->ID; }
	update_post_meta($post->ID, "_status", $_POST["status"]);
	if($_POST["publish_paid"]){$wpdb->query("update $wpdb->posts set post_status='publish' where ID=$post->post_title");}

}

add_action("init", "invoice_posttype_menu_wp_admin");
function invoice_posttype_menu_wp_admin()
{
//===============PLACE SECTION START================
register_post_type(	'invoice', 
				array(	'label' 			=> __('Transactions'),
						'labels' 			=> array(	'name' 					=> __('Transactions'),
														'singular_name' 		=> __('Transaction'),
														'add_new' 				=> __('Add Transaction'),
														'add_new_item' 			=> __('Add New Transaction'),
														'edit' 					=> __('Edit'),
														'edit_item' 			=> __('Edit Transaction'),
														'new_item' 				=> __('New Transaction'),
														'view_item'				=> __('View Transaction'),
														'search_items' 			=> __('Search Transactions'),
														'not_found' 			=> __('No Transactions found'),
														'not_found_in_trash' 	=> __('No Transactions found in trash')	),
						'public' 			=> false,
						'can_export'		=> true,
						'show_ui' 			=> true, // UI in admin panel
						'_builtin' 			=> false, // It's a custom post type, not built in
						'_edit_link' 		=> 'post.php?post=%d',
						'capability_type' 	=> 'post',
						'menu_icon' 		=> get_bloginfo('template_url').'/images/favicon.ico',
						'hierarchical' 		=> false,
						'rewrite' 			=> false, // Permalinks
						'query_var' 		=> true, // This goes to the WP_Query schema
						'supports' 			=> array(	'title',
														'author', 
														//'excerpt',
														//'thumbnail',
														//'comments',
														'editor'), 
														//'trackbacks',
														//'custom-fields',
														//'revisions') ,
						'show_in_nav_menus'	=> true 
						//'taxonomies'		=> array('invoicecategory','invoice_tags')
					)
				);





// add to our plugin init function



}
################# INVOICES END ##################

################# DISABLE WYSIWYG FOR INVOICES ##################
add_filter( 'user_can_richedit', 'disable_for_invoice' );
function disable_for_invoice( $default ) {
    global $post;
    if ( 'invoice' == get_post_type( $post ) )
        return false;
    return $default;
}



###############################################
################ EXPIRE DAE START #############
###############################################

if($_REQUEST['post_type']=='place' || $post_type=='place' || $_REQUEST['post_type']=='event' || $post_type=='event'){
add_action( 'post_submitbox_misc_actions', 'expire_date_metabox' );
}

function expire_date_metabox(){
	global $post;
	?>
<div class="misc-pub-section curtime misc-pub-section-last">

	<span id="timestamp">
	Expires on:  <input type="text" name="expire_date" id="expire_date" class="textfield_m at-date" rel='yy-mm-dd' value="<?php echo get_post_meta( $post->ID, 'expire_date', true );?>" size="25"  />
    </span>
    <?php _e('<small>Please enter expiry date eg: <b>2012-03-16</b></small>');?>
	</div> 
<?php
}
add_action('save_post', 'save_expire');
function save_expire(){
	global $post;
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){ return $post->ID; }
	if($_POST["expire_date"]){update_post_meta($post->ID, "expire_date", $_POST["expire_date"]);}
	else{update_post_meta($post->ID, "expire_date", "Never");}
}

//===============CHIM'S PLAYGROUND SECTION START================
add_action("init", "playground_posttype_menu_wp_admin");
function playground_posttype_menu_wp_admin()
{
	
	register_taxonomy(	"placecategory", 
					array('barsclubs','restaurant','shopping'),
					array (	"hierarchical" 		=> true, 
							"label" 			=> "Place Category", 
							'labels' 			=> array(	'name' 				=> __('Place Categories'),
															'singular_name' 	=> __('Place Category'),
															'search_items' 		=> __('Search Places'),
															'popular_items' 	=> __('Popular Place Categories'),
															'all_items' 		=> __('All Place Categories'),
															'parent_item' 		=> __('Parent Place Category'),
															'parent_item_colon' => __('Parent Place Category:'),
															'edit_item' 		=> __('Edit Place Category'),
															'update_item'		=> __('Update Place Category'),
															'add_new_item' 		=> __('Add New Place Category'),
															'new_item_name' 	=> __('New Place Category Name')	), 
							'public' 			=> true,
							'show_ui' 			=> true,
							//"rewrite" 			=> true
							'rewrite' => array('slug'=>"$pcat_name",'with_front'=>false))
					);
	
	
	
	//Area Taxonomy
	$labels = array(
	    'name'                          => __( 'Khu Vực', 'site5framework' ),
	    'singular_name'                 => __( 'Khu Vực', 'site5framework' ),
	    'search_items'                  => __( 'Tìm kiếm Khu Vực', 'site5framework' ),
	    'popular_items'                 => __( 'Khu Vực phổ biến', 'site5framework' ),
	    'all_items'                     => __( 'Toàn bộ Khu Vực', 'site5framework' ),
	    'parent_item'                   => __( 'Khu Vực cấp cha', 'site5framework' ),
	    'edit_item'                     => __( 'Sửa Khu Vực', 'site5framework' ),
	    'update_item'                   => __( 'Cập nhật Khu Vực', 'site5framework' ),
	    'add_new_item'                  => __( 'Thêm Khu Vực', 'site5framework' ),
	    'new_item_name'                 => __( 'Khu Vực mới', 'site5framework' ),
	    'separate_items_with_commas'    => __( 'Phân cách tên Khu Vực bằng dấu phẩy (,)', 'site5framework' ),
	    'add_or_remove_items'           => __( 'Thêm/bớt Khu Vực', 'site5framework' ),'',
	    'choose_from_most_used'         => __( 'Chọn trong danh sách Khu Vực phổ biến', 'site5framework' )
	);

	$args = array(
	    'label'                         => __( 'Khu Vực', 'site5framework' ),
	    'labels'                        => $labels,
	    'public'                        => true,
	    'hierarchical'                  => true,
	    'show_ui'                       => true,
	    'show_in_nav_menus'             => true,
	    'args'                          => array( 'orderby' => 'term_order' ),
	    'rewrite'                       => array( 'slug' => 'area', 'with_front' => false ),
	    'query_var'                     => true
	);

	register_taxonomy( 'area', array('barsclubs','restaurant','shopping','event'), $args );

	//Bars/Clubs post type
	register_post_type( 'barsclubs',
	    array(
	        'labels'                => array(
	            'name'                  => __( 'Bars/Clubs', 'site5framework' ),
	            'singular_name'         => __( 'Bar/Club', 'site5framework' ),
	            'add_new'               => __( 'Đăng ký Bar/Club', 'site5framework' ),
	            'add_new_item'          => __( 'Đăng ký Bar/Club', 'site5framework' ),
	            'edit_item'             => __( 'Chỉnh sửa Bar/Club', 'site5framework' ),
	            'new_item'              => __( 'Đăng ký Bar/Club', 'site5framework' ),
	            'view_item'             => __( 'Xem thông tin Bar/Club', 'site5framework' ),
	            'search_items'          => __( 'Tìm kiếm Bar/Club', 'site5framework' ),
	            'not_found'             => __( 'Không có bar/club nào', 'site5framework' ),
	            'not_found_in_trash'    => __( 'Không có bar/club nào đã xoá', 'site5framework' )
	        ),
	        'public'                => true,
	        'publicly_queryable'    => true,
	        'show_ui'               => true,
	        'query_var'             => true,
	        'permalink_epmask'      => true,
	        'menu_position'         => 5,
			'menu_icon' 			=> get_bloginfo('template_url').'/images/favicon.ico',
	        'show_in_menu'          => true,
	        'supports' 				=> array( 'title','editor', 'comments', 'page-attributes','thumbnail','excerpt','revisions' ),
	        'rewrite'               => array( 'slug' => 'barclub/details', 'with_front' => false ),
	        'has_archive'           => true
	    )
	);

	/*********************************************************************************************

	Registers Custom Restaurant Post Type

	 *********************************************************************************************/
	//Purpose taxonomy
	$labels = array(
	    'name'                          => __( 'Mục Đích', 'site5framework' ),
	    'singular_name'                 => __( 'Mục Đích', 'site5framework' ),
	    'search_items'                  => __( 'Tìm kiếm Mục Đích', 'site5framework' ),
	    'popular_items'                 => __( 'Mục Đích phổ biến', 'site5framework' ),
	    'all_items'                     => __( 'Toàn bộ Mục Đích', 'site5framework' ),
	    'parent_item'                   => __( 'Mục Đích cấp cha', 'site5framework' ),
	    'edit_item'                     => __( 'Sửa Mục Đích', 'site5framework' ),
	    'update_item'                   => __( 'Cập nhật Mục Đích', 'site5framework' ),
	    'add_new_item'                  => __( 'Thêm Mục Đích', 'site5framework' ),
	    'new_item_name'                 => __( 'Mục Đích mới', 'site5framework' ),
	    'separate_items_with_commas'    => __( 'Phân cách tên Mục Đích bằng dấu phẩy (,)', 'site5framework' ),
	    'add_or_remove_items'           => __( 'Thêm/bớt Mục Đích', 'site5framework' ),'',
	    'choose_from_most_used'         => __( 'Chọn trong danh sách Mục Đích phổ biến', 'site5framework' )
	);

	$args = array(
	    'label'                         => __( 'Mục Đích', 'site5framework' ),
	    'labels'                        => $labels,
	    'public'                        => true,
	    'hierarchical'                  => true,
	    'show_ui'                       => true,
	    'show_in_nav_menus'             => true,
	    'args'                          => array( 'orderby' => 'term_order' ),
	    'rewrite'                       => array( 'slug' => 'purpose', 'with_front' => false ),
	    'query_var'                     => true
	);

	register_taxonomy( 'purpose', array('restaurant'), $args );

	//Culture taxonomy
	$labels = array(
	    'name'                          => __( 'Văn Hoá Ẩm Thực', 'site5framework' ),
	    'singular_name'                 => __( 'Văn Hoá Ẩm Thực', 'site5framework' ),
	    'search_items'                  => __( 'Tìm kiếm Văn Hoá Ẩm Thực', 'site5framework' ),
	    'popular_items'                 => __( 'Văn Hoá Ẩm Thực phổ biến', 'site5framework' ),
	    'all_items'                     => __( 'Toàn bộ Văn Hoá Ẩm Thực', 'site5framework' ),
	    'parent_item'                   => __( 'Văn Hoá Ẩm Thực cấp cha', 'site5framework' ),
	    'edit_item'                     => __( 'Sửa Văn Hoá Ẩm Thực', 'site5framework' ),
	    'update_item'                   => __( 'Cập nhật Văn Hoá Ẩm Thực', 'site5framework' ),
	    'add_new_item'                  => __( 'Thêm Văn Hoá Ẩm Thực', 'site5framework' ),
	    'new_item_name'                 => __( 'Văn Hoá Ẩm Thực mới', 'site5framework' ),
	    'separate_items_with_commas'    => __( 'Phân cách tên Văn Hoá Ẩm Thực bằng dấu phẩy (,)', 'site5framework' ),
	    'add_or_remove_items'           => __( 'Thêm/bớt Văn Hoá Ẩm Thực', 'site5framework' ),'',
	    'choose_from_most_used'         => __( 'Chọn trong danh sách Văn Hoá Ẩm Thực phổ biến', 'site5framework' )
	);

	$args = array(
	    'label'                         => __( 'Văn Hoá Ẩm Thực', 'site5framework' ),
	    'labels'                        => $labels,
	    'public'                        => true,
	    'hierarchical'                  => true,
	    'show_ui'                       => true,
	    'show_in_nav_menus'             => true,
	    'args'                          => array( 'orderby' => 'term_order' ),
	    'rewrite'                       => array( 'slug' => 'culture', 'with_front' => false ),
	    'query_var'                     => true
	);

	register_taxonomy( 'culture', array('restaurant'), $args );

	//Dishes taxonomy
	$labels = array(
	    'name'                          => __( 'Thể Loại Món', 'site5framework' ),
	    'singular_name'                 => __( 'Thể Loại Món', 'site5framework' ),
	    'search_items'                  => __( 'Tìm kiếm Thể Loại Món', 'site5framework' ),
	    'popular_items'                 => __( 'Thể Loại Món phổ biến', 'site5framework' ),
	    'all_items'                     => __( 'Toàn bộ Thể Loại Món', 'site5framework' ),
	    'parent_item'                   => __( 'Thể Loại Món cấp cha', 'site5framework' ),
	    'edit_item'                     => __( 'Sửa Thể Loại Món', 'site5framework' ),
	    'update_item'                   => __( 'Cập nhật Thể Loại Món', 'site5framework' ),
	    'add_new_item'                  => __( 'Thêm Thể Loại Món', 'site5framework' ),
	    'new_item_name'                 => __( 'Thể Loại Món mới', 'site5framework' ),
	    'separate_items_with_commas'    => __( 'Phân cách tên Thể Loại Món bằng dấu phẩy (,)', 'site5framework' ),
	    'add_or_remove_items'           => __( 'Thêm/bớt Thể Loại Món', 'site5framework' ),'',
	    'choose_from_most_used'         => __( 'Chọn trong danh sách Thể Loại Món phổ biến', 'site5framework' )
	);

	$args = array(
	    'label'                         => __( 'Thể Loại Món', 'site5framework' ),
	    'labels'                        => $labels,
	    'public'                        => true,
	    'hierarchical'                  => true,
	    'show_ui'                       => true,
	    'show_in_nav_menus'             => true,
	    'args'                          => array( 'orderby' => 'term_order' ),
	    'rewrite'                       => array( 'slug' => 'dishes', 'with_front' => false ),
	    'query_var'                     => true
	);

	register_taxonomy( 'dishes', array('restaurant'), $args );

	//Facility taxonomy
	$labels = array(
	    'name'                          => __( 'Tiện Nghi', 'site5framework' ),
	    'singular_name'                 => __( 'Tiện Nghi', 'site5framework' ),
	    'search_items'                  => __( 'Tìm kiếm Tiện Nghi', 'site5framework' ),
	    'popular_items'                 => __( 'Tiện Nghi phổ biến', 'site5framework' ),
	    'all_items'                     => __( 'Toàn bộ Tiện Nghi', 'site5framework' ),
	    'parent_item'                   => __( 'Tiện Nghi cấp cha', 'site5framework' ),
	    'edit_item'                     => __( 'Sửa Tiện Nghi', 'site5framework' ),
	    'update_item'                   => __( 'Cập nhật Tiện Nghi', 'site5framework' ),
	    'add_new_item'                  => __( 'Thêm Tiện Nghi', 'site5framework' ),
	    'new_item_name'                 => __( 'Tiện Nghi mới', 'site5framework' ),
	    'separate_items_with_commas'    => __( 'Phân cách tên Tiện Nghi bằng dấu phẩy (,)', 'site5framework' ),
	    'add_or_remove_items'           => __( 'Thêm/bớt Tiện Nghi', 'site5framework' ),'',
	    'choose_from_most_used'         => __( 'Chọn trong danh sách Tiện Nghi phổ biến', 'site5framework' )
	);

	$args = array(
	    'label'                         => __( 'Tiện Nghi', 'site5framework' ),
	    'labels'                        => $labels,
	    'public'                        => true,
	    'hierarchical'                  => true,
	    'show_ui'                       => true,
	    'show_in_nav_menus'             => true,
	    'args'                          => array( 'orderby' => 'term_order' ),
	    'rewrite'                       => array( 'slug' => 'facility', 'with_front' => false ),
	    'query_var'                     => true
	);

	register_taxonomy( 'facility', array('restaurant'), $args );

	//Timeframe taxonomy
	$labels = array(
	    'name'                          => __( 'Thời Gian Hoạt Động', 'site5framework' ),
	    'singular_name'                 => __( 'Thời Gian Hoạt Động', 'site5framework' ),
	    'search_items'                  => __( 'Tìm kiếm Thời Gian Hoạt Động', 'site5framework' ),
	    'popular_items'                 => __( 'Thời Gian Hoạt Động phổ biến', 'site5framework' ),
	    'all_items'                     => __( 'Toàn bộ Thời Gian Hoạt Động', 'site5framework' ),
	    'parent_item'                   => __( 'Thời Gian Hoạt Động cấp cha', 'site5framework' ),
	    'edit_item'                     => __( 'Sửa Thời Gian Hoạt Động', 'site5framework' ),
	    'update_item'                   => __( 'Cập nhật Thời Gian Hoạt Động', 'site5framework' ),
	    'add_new_item'                  => __( 'Thêm Thời Gian Hoạt Động', 'site5framework' ),
	    'new_item_name'                 => __( 'Thời Gian Hoạt Động mới', 'site5framework' ),
	    'separate_items_with_commas'    => __( 'Phân cách tên Thời Gian Hoạt Động bằng dấu phẩy (,)', 'site5framework' ),
	    'add_or_remove_items'           => __( 'Thêm/bớt Thời Gian Hoạt Động', 'site5framework' ),'',
	    'choose_from_most_used'         => __( 'Chọn trong danh sách Thời Gian Hoạt Động phổ biến', 'site5framework' )
	);

	$args = array(
	    'label'                         => __( 'Thời Gian Hoạt Động', 'site5framework' ),
	    'labels'                        => $labels,
	    'public'                        => true,
	    'hierarchical'                  => true,
	    'show_ui'                       => true,
	    'show_in_nav_menus'             => true,
	    'args'                          => array( 'orderby' => 'term_order' ),
	    'rewrite'                       => array( 'slug' => 'timeframe', 'with_front' => false ),
	    'query_var'                     => true
	);

	register_taxonomy( 'timeframe', array('restaurant','barsclubs','shopping'), $args );

	//Avgprice taxonomy
	$labels = array(
	    'name'                          => __( 'Mức Giá Trung Bình', 'site5framework' ),
	    'singular_name'                 => __( 'Mức Giá Trung Bình', 'site5framework' ),
	    'search_items'                  => __( 'Tìm kiếm Mức Giá Trung Bình', 'site5framework' ),
	    'popular_items'                 => __( 'Mức Giá Trung Bình phổ biến', 'site5framework' ),
	    'all_items'                     => __( 'Toàn bộ Mức Giá Trung Bình', 'site5framework' ),
	    'parent_item'                   => __( 'Mức Giá Trung Bình cấp cha', 'site5framework' ),
	    'edit_item'                     => __( 'Sửa Mức Giá Trung Bình', 'site5framework' ),
	    'update_item'                   => __( 'Cập nhật Mức Giá Trung Bình', 'site5framework' ),
	    'add_new_item'                  => __( 'Thêm Mức Giá Trung Bình', 'site5framework' ),
	    'new_item_name'                 => __( 'Mức Giá Trung Bình mới', 'site5framework' ),
	    'separate_items_with_commas'    => __( 'Phân cách tên Mức Giá Trung Bình bằng dấu phẩy (,)', 'site5framework' ),
	    'add_or_remove_items'           => __( 'Thêm/bớt Mức Giá Trung Bình', 'site5framework' ),'',
	    'choose_from_most_used'         => __( 'Chọn trong danh sách Mức Giá Trung Bình phổ biến', 'site5framework' )
	);

	$args = array(
	    'label'                         => __( 'Mức Giá Trung Bình', 'site5framework' ),
	    'labels'                        => $labels,
	    'public'                        => true,
	    'hierarchical'                  => true,
	    'show_ui'                       => true,
	    'show_in_nav_menus'             => true,
	    'args'                          => array( 'orderby' => 'term_order' ),
	    'rewrite'                       => array( 'slug' => 'avgprice', 'with_front' => false ),
	    'query_var'                     => true
	);

	register_taxonomy( 'avgprice', array('barsclubs','restaurant','shopping'), $args );

	//Merchandise taxonomy
	$labels = array(
	    'name'                          => __( 'Sản Phẩm/Hàng Hoá', 'site5framework' ),
	    'singular_name'                 => __( 'Sản Phẩm/Hàng Hoá', 'site5framework' ),
	    'search_items'                  => __( 'Tìm kiếm Sản Phẩm/Hàng Hoá', 'site5framework' ),
	    'popular_items'                 => __( 'Sản Phẩm/Hàng Hoá phổ biến', 'site5framework' ),
	    'all_items'                     => __( 'Toàn bộ Sản Phẩm/Hàng Hoá', 'site5framework' ),
	    'parent_item'                   => __( 'Sản Phẩm/Hàng Hoá cấp cha', 'site5framework' ),
	    'edit_item'                     => __( 'Sửa Sản Phẩm/Hàng Hoá', 'site5framework' ),
	    'update_item'                   => __( 'Cập nhật Sản Phẩm/Hàng Hoá', 'site5framework' ),
	    'add_new_item'                  => __( 'Thêm Sản Phẩm/Hàng Hoá', 'site5framework' ),
	    'new_item_name'                 => __( 'Sản Phẩm/Hàng Hoá mới', 'site5framework' ),
	    'separate_items_with_commas'    => __( 'Phân cách tên Sản Phẩm/Hàng Hoá bằng dấu phẩy (,)', 'site5framework' ),
	    'add_or_remove_items'           => __( 'Thêm/bớt Sản Phẩm/Hàng Hoá', 'site5framework' ),'',
	    'choose_from_most_used'         => __( 'Chọn trong danh sách Sản Phẩm/Hàng Hoá phổ biến', 'site5framework' )
	);

	$args = array(
	    'label'                         => __( 'Sản Phẩm/Hàng Hoá', 'site5framework' ),
	    'labels'                        => $labels,
	    'public'                        => true,
	    'hierarchical'                  => true,
	    'show_ui'                       => true,
	    'show_in_nav_menus'             => true,
	    'args'                          => array( 'orderby' => 'term_order' ),
	    'rewrite'                       => array( 'slug' => 'merchandise', 'with_front' => false ),
	    'query_var'                     => true
	);

	register_taxonomy( 'merchandise', array('shopping'), $args );

	//Restaurant post type
	register_post_type( 'restaurant',
	    array(
	        'labels'                => array(
	            'name'                  => __( 'Nhà Hàng', 'site5framework' ),
	            'singular_name'         => __( 'Nhà Hàng', 'site5framework' ),
	            'add_new'               => __( 'Đăng ký Nhà Hàng', 'site5framework' ),
	            'add_new_item'          => __( 'Đăng ký Nhà Hàng', 'site5framework' ),
	            'edit_item'             => __( 'Chỉnh sửa Nhà Hàng', 'site5framework' ),
	            'new_item'              => __( 'Đăng ký Nhà Hàng', 'site5framework' ),
	            'view_item'             => __( 'Xem thông tin Nhà Hàng', 'site5framework' ),
	            'search_items'          => __( 'Tìm kiếm Nhà Hàng', 'site5framework' ),
	            'not_found'             => __( 'Không có Nhà Hàng nào', 'site5framework' ),
	            'not_found_in_trash'    => __( 'Không có Nhà Hàng nào đã xoá', 'site5framework' )
	        ),
	        'public'                => true,
	        'publicly_queryable'    => true,
	        'show_ui'               => true,
	        'query_var'             => true,
	        'permalink_epmask'      => true,
	        'menu_position'         => 5,
			'menu_icon' 			=> get_bloginfo('template_url').'/images/favicon.ico',
	        'show_in_menu'          => true,
	        'supports' 				=> array( 'title','editor', 'comments', 'page-attributes','thumbnail','excerpt','revisions' ),
	        'rewrite'               => array( 'slug' => 'restaurant/details', 'with_front' => false ),
	        'has_archive'           => true
	    )
	);

	//Shopping post type
	register_post_type( 'shopping',
	    array(
	        'labels'                => array(
	            'name'                  => __( 'Địa Điểm Mua Sắm', 'site5framework' ),
	            'singular_name'         => __( 'Địa Điểm Mua Sắm', 'site5framework' ),
	            'add_new'               => __( 'Đăng ký Địa Điểm Mua Sắm', 'site5framework' ),
	            'add_new_item'          => __( 'Đăng ký Địa Điểm Mua Sắm', 'site5framework' ),
	            'edit_item'             => __( 'Chỉnh sửa Địa Điểm Mua Sắm', 'site5framework' ),
	            'new_item'              => __( 'Đăng ký Địa Điểm Mua Sắm', 'site5framework' ),
	            'view_item'             => __( 'Xem thông tin Địa Điểm Mua Sắm', 'site5framework' ),
	            'search_items'          => __( 'Tìm kiếm Địa Điểm Mua Sắm', 'site5framework' ),
	            'not_found'             => __( 'Không có Địa Điểm Mua Sắm nào', 'site5framework' ),
	            'not_found_in_trash'    => __( 'Không có Địa Điểm Mua Sắm nào đã xoá', 'site5framework' )
	        ),
	        'public'                => true,
	        'publicly_queryable'    => true,
	        'show_ui'               => true,
	        'query_var'             => true,
	        'permalink_epmask'      => true,
	        'menu_position'         => 5,
			'menu_icon' 			=> get_bloginfo('template_url').'/images/favicon.ico',
	        'show_in_menu'          => true,
	        'supports' 				=> array( 'title','editor', 'comments', 'page-attributes','thumbnail','excerpt','revisions' ),
	        'rewrite'               => array( 'slug' => 'shopping/details', 'with_front' => false ),
	        'has_archive'           => true
	    )
	);
	
	$labels = array(
	    'name'                          => __( 'Loại Sự Kiện', 'site5framework' ),
	    'singular_name'                 => __( 'Loại Sự Kiện', 'site5framework' ),
	    'search_items'                  => __( 'Tìm kiếm Loại Sự Kiện', 'site5framework' ),
	    'popular_items'                 => __( 'Loại Sự Kiện phổ biến', 'site5framework' ),
	    'all_items'                     => __( 'Tất cả Loại Sự Kiện', 'site5framework' ),
	    'parent_item'                   => __( 'Loại Sự Kiện cấp cha', 'site5framework' ),
	    'edit_item'                     => __( 'Sửa Loại Sự Kiện', 'site5framework' ),
	    'update_item'                   => __( 'Cập nhật Loại Sự Kiện', 'site5framework' ),
	    'add_new_item'                  => __( 'Thêm Loại Sự Kiện', 'site5framework' ),
	    'new_item_name'                 => __( 'Loại Sự Kiện mới', 'site5framework' ),
	    'separate_items_with_commas'    => __( 'Phân cách Loại Sự Kiện bằng dấu phẩy (,)', 'site5framework' ),
	    'add_or_remove_items'           => __( 'Thêm/bớt Loại Sự Kiện', 'site5framework' ),'',
	    'choose_from_most_used'         => __( 'Chọn trong danh sách Loại Sự Kiện phổ biến', 'site5framework' )
	);

	$args = array(
	    'label'                         => __( 'Loại Sự Kiện', 'site5framework' ),
	    'labels'                        => $labels,
	    'public'                        => true,
	    'hierarchical'                  => true,
	    'show_ui'                       => true,
	    'show_in_nav_menus'             => true,
	    'args'                          => array( 'orderby' => 'term_order' ),
	    'rewrite'                       => array( 'slug' => 'event/event_types', 'with_front' => false ),
	    'query_var'                     => true
	);

	register_taxonomy( 'event_types', 'event', $args );

	//capacity
	$labels = array(
	    'name'                          => __( 'Số Lượng Chỗ', 'site5framework' ),
	    'singular_name'                 => __( 'Số Lượng Chỗ', 'site5framework' ),
	    'search_items'                  => __( 'Tìm kiếm Số Lượng Chỗ', 'site5framework' ),
	    'popular_items'                 => __( 'Số Lượng Chỗ phổ biến', 'site5framework' ),
	    'all_items'                     => __( 'Tất cả Số Lượng Chỗ', 'site5framework' ),
	    'parent_item'                   => __( 'Số Lượng Chỗ cấp cha', 'site5framework' ),
	    'edit_item'                     => __( 'Sửa Số Lượng Chỗ', 'site5framework' ),
	    'update_item'                   => __( 'Cập nhật Số Lượng Chỗ', 'site5framework' ),
	    'add_new_item'                  => __( 'Thêm Số Lượng Chỗ', 'site5framework' ),
	    'new_item_name'                 => __( 'Số Lượng Chỗ mới', 'site5framework' ),
	    'separate_items_with_commas'    => __( 'Phân cách Số Lượng Chỗ bằng dấu phẩy (,)', 'site5framework' ),
	    'add_or_remove_items'           => __( 'Thêm/bớt Số Lượng Chỗ', 'site5framework' ),'',
	    'choose_from_most_used'         => __( 'Chọn trong danh sách Số Lượng Chỗ phổ biến', 'site5framework' )
	);

	$args = array(
	    'label'                         => __( 'Số Lượng Chỗ', 'site5framework' ),
	    'labels'                        => $labels,
	    'public'                        => true,
	    'hierarchical'                  => true,
	    'show_ui'                       => true,
	    'show_in_nav_menus'             => true,
	    'args'                          => array( 'orderby' => 'term_order' ),
	    'rewrite'                       => array( 'slug' => 'capacity', 'with_front' => false ),
	    'query_var'                     => true
	);

	register_taxonomy( 'capacity', array('restaurant','shopping','barsclubs','event'), $args );

	//ticket
	$labels = array(
	    'name'                          => __( 'Giá Vé', 'site5framework' ),
	    'singular_name'                 => __( 'Giá Vé', 'site5framework' ),
	    'search_items'                  => __( 'Tìm kiếm Giá Vé', 'site5framework' ),
	    'popular_items'                 => __( 'Giá Vé phổ biến', 'site5framework' ),
	    'all_items'                     => __( 'Tất cả Giá Vé', 'site5framework' ),
	    'parent_item'                   => __( 'Giá Vé cấp cha', 'site5framework' ),
	    'edit_item'                     => __( 'Sửa Giá Vé', 'site5framework' ),
	    'update_item'                   => __( 'Cập nhật Giá Vé', 'site5framework' ),
	    'add_new_item'                  => __( 'Thêm Giá Vé', 'site5framework' ),
	    'new_item_name'                 => __( 'Giá Vé mới', 'site5framework' ),
	    'separate_items_with_commas'    => __( 'Phân cách Giá Vé bằng dấu phẩy (,)', 'site5framework' ),
	    'add_or_remove_items'           => __( 'Thêm/bớt Giá Vé', 'site5framework' ),'',
	    'choose_from_most_used'         => __( 'Chọn trong danh sách Giá Vé phổ biến', 'site5framework' )
	);

	$args = array(
	    'label'                         => __( 'Giá Vé', 'site5framework' ),
	    'labels'                        => $labels,
	    'public'                        => true,
	    'hierarchical'                  => true,
	    'show_ui'                       => true,
	    'show_in_nav_menus'             => true,
	    'args'                          => array( 'orderby' => 'term_order' ),
	    'rewrite'                       => array( 'slug' => 'event/ticketprice', 'with_front' => false ),
	    'query_var'                     => true
	);

	register_taxonomy( 'ticketprice', 'event', $args );


	register_post_type( 'event',
	    array(
	        'labels'                => array(
	            'name'                  => __( 'Sự Kiện', 'site5framework' ),
	            'singular_name'         => __( 'Sự Kiện', 'site5framework' ),
	            'add_new'               => __( 'Đăng ký Sự Kiện', 'site5framework' ),
	            'add_new_item'          => __( 'Đăng ký Sự Kiện', 'site5framework' ),
	            'edit_item'             => __( 'Sửa Sự Kiện', 'site5framework' ),
	            'new_item'              => __( 'Sự Kiện mới', 'site5framework' ),
	            'view_item'             => __( 'Xem Sự Kiện', 'site5framework' ),
	            'search_items'          => __( 'Tìm kiếm Sự Kiện', 'site5framework' ),
	            'not_found'             => __( 'Không có sự kiện nào', 'site5framework' ),
	            'not_found_in_trash'    => __( 'Không có sự kiện nào đã xoá', 'site5framework' )
	        ),
	        'public'                => true,
	        'publicly_queryable'    => true,
	        'show_ui'               => true,
	        'query_var'             => true,
	        'permalink_epmask'      => true,
	        'menu_position'         => 5,
			'menu_icon' 			=> get_bloginfo('template_url').'/images/favicon.ico',
	        'show_in_menu'          => true,
	        'supports' 				=> array( 'title','editor', 'comments', 'page-attributes','thumbnail','excerpt','revisions' ),
	        'rewrite'               => array( 'slug' => 'event/details', 'with_front' => false ),
	        'has_archive'           => true
	    )
	);
	
	
	
	
	
	
	
	//satisfaction
	$labels = array(
	    'name'                          => __( 'Mức Độ Hài Lòng', 'site5framework' ),
	    'singular_name'                 => __( 'Mức Độ Hài Lòng', 'site5framework' ),
	    'search_items'                  => __( 'Tìm kiếm Mức Độ Hài Lòng', 'site5framework' ),
	    'popular_items'                 => __( 'Mức Độ Hài Lòng phổ biến', 'site5framework' ),
	    'all_items'                     => __( 'Tất cả Mức Độ Hài Lòng', 'site5framework' ),
	    'parent_item'                   => __( 'Mức Độ Hài Lòng cấp cha', 'site5framework' ),
	    'edit_item'                     => __( 'Sửa Mức Độ Hài Lòng', 'site5framework' ),
	    'update_item'                   => __( 'Cập nhật Mức Độ Hài Lòng', 'site5framework' ),
	    'add_new_item'                  => __( 'Thêm Mức Độ Hài Lòng', 'site5framework' ),
	    'new_item_name'                 => __( 'Mức Độ Hài Lòng mới', 'site5framework' ),
	    'separate_items_with_commas'    => __( 'Phân cách Mức Độ Hài Lòng bằng dấu phẩy (,)', 'site5framework' ),
	    'add_or_remove_items'           => __( 'Thêm/bớt Mức Độ Hài Lòng', 'site5framework' ),'',
	    'choose_from_most_used'         => __( 'Chọn trong danh sách Mức Độ Hài Lòng phổ biến', 'site5framework' )
	);

	$args = array(
	    'label'                         => __( 'Mức Độ Hài Lòng', 'site5framework' ),
	    'labels'                        => $labels,
	    'public'                        => true,
	    'hierarchical'                  => true,
	    'show_ui'                       => true,
	    'show_in_nav_menus'             => true,
	    'args'                          => array( 'orderby' => 'term_order' ),
	    'rewrite'                       => array( 'slug' => 'review/satisfaction', 'with_front' => false ),
	    'query_var'                     => true
	);
	
	register_taxonomy( 'satisfaction', 'review', $args );
	
	//rating
	$labels = array(
	    'name'                          => __( 'Điểm Đánh Giá', 'site5framework' ),
	    'singular_name'                 => __( 'Điểm Đánh Giá', 'site5framework' ),
	    'search_items'                  => __( 'Tìm kiếm Điểm Đánh Giá', 'site5framework' ),
	    'popular_items'                 => __( 'Điểm Đánh Giá phổ biến', 'site5framework' ),
	    'all_items'                     => __( 'Tất cả Điểm Đánh Giá', 'site5framework' ),
	    'parent_item'                   => __( 'Điểm Đánh Giá cấp cha', 'site5framework' ),
	    'edit_item'                     => __( 'Sửa Điểm Đánh Giá', 'site5framework' ),
	    'update_item'                   => __( 'Cập nhật Điểm Đánh Giá', 'site5framework' ),
	    'add_new_item'                  => __( 'Thêm Điểm Đánh Giá', 'site5framework' ),
	    'new_item_name'                 => __( 'Điểm Đánh Giá mới', 'site5framework' ),
	    'separate_items_with_commas'    => __( 'Phân cách Điểm Đánh Giá bằng dấu phẩy (,)', 'site5framework' ),
	    'add_or_remove_items'           => __( 'Thêm/bớt Điểm Đánh Giá', 'site5framework' ),'',
	    'choose_from_most_used'         => __( 'Chọn trong danh sách Điểm Đánh Giá phổ biến', 'site5framework' )
	);

	$args = array(
	    'label'                         => __( 'Điểm Đánh Giá', 'site5framework' ),
	    'labels'                        => $labels,
	    'public'                        => true,
	    'hierarchical'                  => true,
	    'show_ui'                       => true,
	    'show_in_nav_menus'             => true,
	    'args'                          => array( 'orderby' => 'term_order' ),
	    'rewrite'                       => array( 'slug' => 'review/rating', 'with_front' => false ),
	    'query_var'                     => true
	);
	
	register_taxonomy( 'rating', 'review', $args );
	
	register_post_type( 'review',
	    array(
	        'labels'                => array(
	            'name'                  => __( 'Nhận Xét', 'site5framework' ),
	            'singular_name'         => __( 'Nhận Xét', 'site5framework' ),
	            'add_new'               => __( 'Viết Nhận Xét', 'site5framework' ),
	            'add_new_item'          => __( 'Viết Nhận Xét', 'site5framework' ),
	            'edit_item'             => __( 'Sửa Nhận Xét', 'site5framework' ),
	            'new_item'              => __( 'Nhận Xét mới', 'site5framework' ),
	            'view_item'             => __( 'Xem Nhận Xét', 'site5framework' ),
	            'search_items'          => __( 'Tìm kiếm Nhận Xét', 'site5framework' ),
	            'not_found'             => __( 'Không có nhận xét nào', 'site5framework' ),
	            'not_found_in_trash'    => __( 'Không có nhận xét nào đã xoá', 'site5framework' )
	        ),
	        'public'                => true,
	        'publicly_queryable'    => true,
	        'show_ui'               => true,
	        'query_var'             => true,
	        'permalink_epmask'      => true,
	        'menu_position'         => 5,
			'menu_icon' 			=> get_bloginfo('template_url').'/images/favicon.ico',
	        'show_in_menu'          => true,
	        'supports' 				=> array( 'title','editor', 'comments', 'page-attributes','thumbnail','excerpt','revisions' ),
	        'rewrite'               => array( 'slug' => 'review/details', 'with_front' => false ),
	        'has_archive'           => true
	    )
	);


	//  Add Columns to Event Edit Screen

	// function event_edit_columns($audio_columns){
	//     $event_columns = array(
	//         "cb" 				=> "<input type=\"checkbox\" />",
	//         "title" 			=> __('Title', 'site5framework'),
	//         "portfolio-tags" 	=> __('Tags', 'site5framework'),
	//         "author" 			=> __('Author', 'site5framework'),
	//         "comments" 			=> __('Comments', 'site5framework'),
	//         "date" 				=> __('Date', 'site5framework'),
	//     );
	//     $event_columns['comments'] = '<div class="vers"><img alt="Comments" src="' . esc_url( admin_url( 'images/comment-grey-bubble.png' ) ) . '" /></div>';
	//     return $event_columns;
	// }
	// 
	// // GET AUDIO IMAGE
	// function wpe_get_featured_image($post_ID) {
	//     $post_thumbnail_id = get_image_id_by_link ( get_post_meta($post_ID, 'snbp_pitemlink', true) );
	//     if ($post_thumbnail_id) {
	//         $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'small');
	//         return $post_thumbnail_img[0];
	//     }
	// }
	// 
	// 
	// function wpe_event_columns_head($defaults) {
	//     $defaults['featured_image'] = 'Image';
	//     return $defaults;
	// }
	// 
	// // SHOW THE FEATURED IMAGE
	// function wpe_event_columns_content ( $column, $post_id ) {
	// 
	//     if ( $column == 'featured_image') {
	//         $post_event_image = wpe_get_featured_image($post_id);
	//         if ($post_event_image) {
	//             echo '<img src="' . $post_event_image . '" />';
	//         }
	//     }
	// }
	// 
	// // ADDS EXTRA INFO TO ADMIN MENU FOR AUDIO POST ALBUMS
	// add_filter("manage_edit-event_columns", "wpe_event_columns_head");
	// add_action("manage_event_posts_custom_column", "wpe_event_columns_content", 10, 2 );


}
//===============CHIM'S PLAYGROUND SECTION END================

?>