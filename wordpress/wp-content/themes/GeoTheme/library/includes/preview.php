<?php
session_start();
global $upload_folder_path,$wpdb,$child_dir,$child_fn_dir,$ct_on;
//print_r($_POST);
if($_POST)
{
	$proprty_name = stripslashes($_POST['proprty_name']);
	$address = stripslashes($_POST['address']);
	$geo_latitude = $_POST['geo_latitude'];
	$geo_longitude = $_POST['geo_longitude'];
	$claimed = $_POST['claimed'];
	$map_view = $_POST['map_view'];
	$timing = $_POST['timing'];
	$contact = stripslashes($_POST['contact']);
	$email = $_POST['email'];
	$website = $_POST['website'];
	$twitter = $_POST['twitter'];
	$facebook = $_POST['facebook'];
	$a_businesses = $_POST['a_businesses'];
	$kw_tags = $_POST['kw_tags'];
	$post_city_id  = $_POST['post_city_id'];
	$package_pid = $_POST['package_pid'];
	$video = $_POST['video'];
	
	$proprty_desc = stripslashes($_POST['proprty_desc']);
	$proprty_feature = stripslashes($_POST['proprty_feature']);
		
	$_SESSION['property_info'] = $_POST;
	if($_POST['user_email'] && $_FILES['user_photo']['name'])
	{
		$src = $_FILES['user_photo']['tmp_name'];
		$dest_path = get_image_phy_destination_path_user().date('Ymdhis')."_".$_FILES['user_photo']['name'];
		$user_photo = image_resize_custom($src,$dest_path,150,150);        
        $photo_path = get_image_rel_destination_path_user().$user_photo['file'];
		$_SESSION['property_info']['user_photo'] = $photo_path;
	}

}else
{

	$catid_info_arr = get_property_cat_id_name($_REQUEST['pid']);
	$post_info = get_post_info($_REQUEST['pid']);
	$proprty_name = stripslashes($post_info['post_title']);
	$proprty_desc = stripslashes($post_info['post_content']);
	$proprty_feature = stripslashes($post_info['proprty_feature']);	
	$post_meta = get_post_meta($_REQUEST['pid'], '',false);
	//print_r($post_meta);
	$address = stripslashes($post_meta['address'][0]);
	$geo_latitude = $post_meta['geo_latitude'][0];
	$geo_longitude = $post_meta['geo_longitude'][0];
	$claimed = $post_meta['claimed'][0];
	$map_view = $post_meta['map_view'][0];
	$timing = $post_meta['timing'][0];
	$contact = $post_meta['contact'][0];
	$email = $post_meta['email'][0];
	$website = $post_meta['website'][0];
	$twitter = $post_meta['twitter'][0];
	$facebook = $post_meta['facebook'][0];
	$a_businesses = $post_meta['a_businesses'][0];
	$kw_tags = $post_meta['kw_tags'][0];
	$post_city_id  = $post_meta['post_city_id'][0];
	$package_pid = $post_meta['package_pid'][0];
	
	if($_REQUEST['pid'])
	{
		$is_delet_property = 1;
	}
}
global $upload_folder_path;
if($_SESSION["file_info"])
{
	$tmppath = $upload_folder_path.'tmp/';
	foreach($_SESSION["file_info"] as $image_id=>$val)
	{		 
		 $image_src =  site_url().'/'.$tmppath.$image_id.'.jpg';
		 break;
	}
}else
{
	$image_src = $thumb_img_arr[0];
	if($_REQUEST['pid']){
	$large_img_arr = bdw_get_images($_REQUEST['pid'],'large');
	$thumb_img_arr = bdw_get_images($_REQUEST['pid'],'thumb');
	}
	$image_src = $large_img_arr[0];
}
if($_REQUEST['pid'])
{
	$large_img_arr = bdw_get_images($_REQUEST['pid'],'large');
	$thumb_img_arr = bdw_get_images($_REQUEST['pid'],'thumb');
}

if(function_exists('pt_check_captch_cond') && $_REQUEST['pid']==''){
if(!pt_check_captch_cond())
{
wp_redirect(site_url().'/?ptype=post_listing&backandedit=1&emsg=captch&pkg='.$_SESSION['property_info']['price_select']);
exit;
}
}

?>
<?php get_header(); ?>
<?php include (TEMPLATEPATH . "/library/includes/preview_buttons.php");?>
<?php if($_REQUEST['ptype']=='preview'){$preview=1;} ?>
<?php if($ct_on && file_exists($child_dir.'/library/includes/place_detail.php')){include_once ($child_dir. '/library/includes/place_detail.php');}
else{require_once (TEMPLATEPATH . '/library/includes/place_detail.php');}?>
