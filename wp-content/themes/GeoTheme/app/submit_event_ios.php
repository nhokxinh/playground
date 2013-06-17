<head>
<script type='text/javascript' src='http://stiofan.com/wp-includes/js/jquery/jquery.js?ver=1.7.1'></script>
<script type='text/javascript' src='http://maps.google.com/maps/api/js?sensor=false'></script>
<style>
body {}
.message_note{
	display:block;
	clear:both;
}
input[type=text] {width:100%;}
textarea {width:100%;}
select {width:100%;}
.top_banner_section_inn {padding-left:0px !important;width: 300px !important;}
#map_canvas{width:300px !important;height:200px !important;}
.form_cat{width:200px !important;}
.message_note{border-bottom:solid 1px #000;}
</style>
<meta id="viewport" name="viewport" content ="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
</head>
<?php

if($_REQUEST['backandedit'])
{
}else
{
	$_SESSION['property_info'] = array();
}
if(!is_user_can_add_event())
{
	wp_redirect(site_url());
}
if($_REQUEST['pid'])
{
	if(!$current_user->data->ID)
	{
		wp_redirect(get_settings('home').'/index.php?ptype=login');
		exit;
	}
	$pid = $_REQUEST['pid'];
	$proprty_type = $catid_info_arr['type']['id'];
	$post_info = get_post_info($_REQUEST['pid']);
	$proprty_name = $post_info['post_title'];
	$proprty_desc = $post_info['post_content'];
	$post_meta = get_post_meta($_REQUEST['pid'], '',false);
	$address = $post_meta['address'][0];
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
	$package_pid = $post_meta['package_pid'][0];
	$st_date = $post_meta['st_date'][0];
	$st_time = $post_meta['st_time'][0];
	$end_date = $post_meta['end_date'][0];
	$end_time = $post_meta['end_time'][0];
	$recurring = $post_meta['recurring'][0];
	$post_hood_id = $post_meta['post_hood_id'][0];
	$video = $post_meta['video'][0];
		############################## FIX FOR TAGS
	$kw_tags = '';
$tags = get_the_terms( $pid, 'event_tags' );
	//$tags = get_the_tags($pid);
$xt = 1;
foreach ($tags as $tag) {
if ($xt <= 20) {
$kw_tags .= $tag->name.", ";
}
$xt++;
}
################
	//$kw_tags = $post_meta['kw_tags'][0];
	$post_city_id = $post_meta['post_city_id'][0];
	$reg_desc = stripslashes($post_meta['reg_desc'][0]);
	$reg_fees = $post_meta['reg_fees'][0];
	$proprty_feature = $post_meta['proprty_feature'][0];
	$cat_array = array();
	if($pid)
	{
		global $wpdb;
		$cat_array = $wpdb->get_col("select cat.name from $wpdb->terms cat join $wpdb->term_taxonomy t on t.term_id=cat.term_id  join $wpdb->term_relationships tr on tr.term_taxonomy_id=t.term_taxonomy_id where tr.object_id=\"$pid\" and t.taxonomy='eventcategory'");
	}
	$thumb_img_arr = bdw_get_images_with_info($_REQUEST['pid'],'thumb');
}
######################## LINK BUSINESS TO EVENT #########################################
if($_REQUEST['linkid'])
{
	if(!$current_user->data->ID)
	{
		wp_redirect(get_settings('home').'/index.php?ptype=login');
		exit;
	}
	$linkid = $_REQUEST['linkid'];
	$proprty_type = $catid_info_arr['type']['id'];
	$post_info = get_post_info($_REQUEST['linkid']);
	$proprty_name = $post_info['post_title'];
	$proprty_desc = $post_info['post_content'];
	$post_meta = get_post_meta($_REQUEST['linkid'], '',false);
	$address = $post_meta['address'][0];
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
	//$package_pid = $post_meta['package_pid'][0];
	$st_date = $post_meta['st_date'][0];
	$st_time = $post_meta['st_time'][0];
	$end_date = $post_meta['end_date'][0];
	$end_time = $post_meta['end_time'][0];
	$recurring = $post_meta['recurring'][0];
	$post_hood_id = $post_meta['post_hood_id'][0];
	$video = $_SESSION['property_info']['video'];
		############################## FIX FOR TAGS
	$kw_tags = '';
	$tags = get_the_terms( $linkid, 'event_tags' );
	//$tags = get_the_tags($linkid );
$xt = 1;
foreach ($tags as $tag) {
if ($xt <= 20) {
$kw_tags .= $tag->name.", ";
}
$xt++;
}
################
	//$kw_tags = $post_meta['kw_tags'][0];
	$post_city_id = $post_meta['post_city_id'][0];
	$reg_desc = stripslashes($post_meta['reg_desc'][0]);
	$reg_fees = $post_meta['reg_fees'][0];
	$proprty_feature = $post_meta['proprty_feature'][0];
	$cat_array = array();
	if($linkid)
	{
		global $wpdb;
		$cat_array = $wpdb->get_col("select cat.name from $wpdb->terms cat join $wpdb->term_taxonomy t on t.term_id=cat.term_id  join $wpdb->term_relationships tr on tr.term_taxonomy_id=t.term_taxonomy_id where tr.object_id=\"$linkid\" and t.taxonomy='eventcategory'");
	}
	//$thumb_img_arr = bdw_get_images_with_info($_REQUEST['linkid'],'thumb'); // removed untill fix found
}
######################## 	END LINK BUSINESS TO EVENT ##########################################
if($_SESSION['property_info'] && $_REQUEST['backandedit'])
{
	$proprty_name = $_SESSION['property_info']['proprty_name'];
	$proprty_desc = $_SESSION['property_info']['proprty_desc'];
	$proprty_feature = $_SESSION['property_info']['proprty_feature'];
	$address = $_SESSION['property_info']['address'];
	$geo_latitude = $_SESSION['property_info']['geo_latitude'];
	$geo_longitude = $_SESSION['property_info']['geo_longitude'];
	$claimed = $_SESSION['property_info']['claimed'];	
	$map_view = $_SESSION['property_info']['map_view'];	
	$st_date = $_SESSION['property_info']['stdate'];
	$st_time = $_SESSION['property_info']['sttime'];
	$end_date = $_SESSION['property_info']['enddate'];
	$end_time = $_SESSION['property_info']['endtime'];
	$recurring = $_SESSION['property_info']['recurring'];
	$reg_desc = $_SESSION['property_info']['reg_desc'];
	$reg_fees = $_SESSION['property_info']['reg_fees'];
	$post_city_id = $_SESSION['property_info']['post_city_id'];
	$post_hood_id = $_SESSION['property_info']['post_hood_id'];
	if($_SESSION['property_info']['package_pid']){$package_pid = $_SESSION['property_info']['package_pid'];}
	
	$contact = $_SESSION['property_info']['contact'];
	$email = $_SESSION['property_info']['email'];
	$website = $_SESSION['property_info']['website'];
	$twitter = $_SESSION['property_info']['twitter'];
	$facebook = $_SESSION['property_info']['facebook'];
	$a_businesses = $_SESSION['property_info']['a_businesses'];
	$kw_tags = $_SESSION['property_info']['kw_tags'];
	$user_fname = $_SESSION['property_info']['user_fname'];
	$user_phone = $_SESSION['property_info']['user_phone'];
	$user_email = $_SESSION['property_info']['user_email'];
	$user_login_or_not = $_SESSION['property_info']['user_login_or_not'];
	$cat_array = $_SESSION['property_info']['category'];
	$proprty_add_coupon = $_SESSION['property_info']['proprty_add_coupon'];
	$price_select = $_SESSION['property_info']['price_select'];
	$video = $_SESSION['property_info']['video'];
	
	
}
################ LIMIT PACKAGE CODE ######################
if($_SESSION['property_info']['price_select']){$price_select = $_REQUEST['pkg'];}

if($_REQUEST['pkg'] || $package_pid)
{	
if($_REQUEST['pkg']){$package_pid = $_REQUEST['pkg']; }

global $price_db_table_name,$wpdb;
$pricesql = "select * from $price_db_table_name where status=1 and pid=$package_pid and post_type='event'";
$priceinfo = $wpdb->get_row($pricesql, ARRAY_A);
//echo $priceinfo['title'];
	
	
	
$html_editor = $priceinfo['html_editor'];
$property_feature_pkg = $priceinfo['property_feature_pkg'];
$property_desc_pkg = $priceinfo['property_desc_pkg'];
$video_pkg = $priceinfo['video_pkg'];
$timing_pkg = $priceinfo['timing_pkg'];
$contact_pkg = $priceinfo['contact_pkg'];
$email_pkg = $priceinfo['email_pkg'];
$website_pkg = $priceinfo['website_pkg'];
$twitter_pkg = $priceinfo['twitter_pkg'];
$facebook_pkg = $priceinfo['facebook_pkg'];
$kw_tags_pkg = $priceinfo['kw_tags_pkg'];
$image_limit = $priceinfo['image_limit'];
$cat_limit = $priceinfo['cat_limit'];
$link_business_pkg = $priceinfo['link_business_pkg'];
$recurring_pkg = $priceinfo['recurring_pkg'];
$reg_desc_pkg = $priceinfo['reg_desc_pkg'];
$reg_fees_pkg = $priceinfo['reg_fees_pkg'];
$cat_exclude = $priceinfo['cat'];
$lat_lng = $priceinfo['lat_lng'];
}
################## LIMIT PACKAGE CODE #####################

if(!$_REQUEST['pid'] && !$_REQUEST['backandedit']){
	$reg_desc = HOW_TO_APPLY_DESC_TEXT;	
}
if($proprty_desc=='')
{
	$proprty_desc = __("Enter description for your listing.");
}
if($_REQUEST['renew'])
{
	$property_list_type = get_post_meta($_REQUEST['pid'],'list_type',true);
}
if($_REQUEST['ptype']=='post_event')
{
	if($_REQUEST['pid'])
	{
		if($_REQUEST['renew'])
		{
			$page_title = RENEW_EVENT_TEXT;
		}elseif($_REQUEST['upgrade'])
		{
			$page_title = UPGRADE_LISING_TEXT;
		}else
		{
			$page_title = EDIT_EVENT_TEXT;
		}
	}else
	{
		$page_title = POST_EVENT_TITLE;
	}
}else
{
	if($_REQUEST['pid'])
	{
		if($_REQUEST['renew'])
		{
			$page_title = RENEW_LISING_TEXT;
		}elseif($_REQUEST['upgrade'])
		{
			$page_title = UPGRADE_LISING_TEXT;
		}else
		{
			$page_title = EDIT_LISING_TEXT;
		}
	}else
	{
		$page_title = POST_PLACE_TITLE;
	}
}
?>

<!-- /TinyMCE -->
<body>
<div id="wrapper" class="clearfix">
<div id="inner_pages" class="clearfix" >
    <h1><?php echo $page_title;?></h1>   
<div class="clearfix"></div>
<div id="content" class="content_inner" >


<h5 class="form_title " <?php if(get_option('is_user_addevent')=='0' || get_option('is_user_eventlist')=='0'){ echo 'style="display:none"';} ?>> <?php _e(SELECT_LISTING_TYPE_TEXT);?></h5>
              <div class="form_row clearfix" <?php if(get_option('is_user_addevent')=='0' || get_option('is_user_eventlist')=='0'){ echo 'style="display:none"';} ?>>
             	<label><?php echo SELECT_EVENT_TYPE_TEXT;?> </label>
                   <?php if(get_option('is_user_addevent')=='0'){}else{ ?> 
             	<span class=" user_define"> <input name="listing_type" id="place_listing" type="radio" value="post_listing" <?php if($_REQUEST['submit_place']){ echo 'checked="checked"';}?> onclick="window.location.href='<?php echo site_url();?>/?api_submit=1&submit_place=1&user_name=<?php echo $_REQUEST['user_name'];?>&user_pass=<?php echo $_REQUEST['user_pass'];?>'" /> <?php echo POST_PLACE_TITLE;?> </span>
                <?php }?>
                <?php if(get_option('is_user_eventlist')=='0'){}else{ ?>  
				 <span class="user_define"> <input name="listing_type" id="event_listing" type="radio" value="post_event" <?php if($_REQUEST['submit_event']){ echo 'checked="checked"';}?>  onclick="window.location.href='<?php echo site_url();?>/?api_submit=1&submit_event=1&user_name=<?php echo $_REQUEST['user_name'];?>&user_pass=<?php echo $_REQUEST['user_pass'];?>'" /> <?php echo POST_EVENT_TITLE;?> </span>
                 <?php }?>
             </div>
             
			 
			  <?php
			 if($_REQUEST['pid'] || $_POST['renew'] || $_POST['upgrade']){
				//$form_action_url = site_url().'/?ptype=preview';
			 }else
			 {
				// $form_action_url = get_ssl_normal_url(site_url().'/?ptype=preview',$_REQUEST['pid']);
			 }
			$form_action_url = site_url().'/?api_submit=1&submit_event=1&pkg=1&step=1';
			 ?>             
            <form name="propertyform" id="propertyform" action="<?php echo $form_action_url; ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="user_login_or_not" id="user_login_or_not" value="<?php echo $user_login_or_not;?>" />
            <input type="hidden" name="pid" value="<?php echo $_REQUEST['pid'];?>" />
            <input type="hidden" name="renew" value="<?php echo $_REQUEST['renew'];?>" />
            <input type="hidden" name="upgrade" value="<?php echo $_REQUEST['upgrade'];?>" />
            <input type="hidden" name="post_type" value="event" />
            
            <input type="hidden" name="user_name" value="<?php echo $_REQUEST['user_name'];?>" />
            <input type="hidden" name="user_pass" value="<?php echo $_REQUEST['user_pass'];?>" />

			 
			 <!--  ##################################### PRICE DETAILS ################################################ -->
              <?php if($_REQUEST['pid']=='' || $_REQUEST['renew'] || $_REQUEST['upgrade']){?>
                   
              <?php 
			  
			$uri =  end(explode('?', $_SERVER['REQUEST_URI']));
			$uri = explode('&pkg=', $uri);
			echo $url2[0];
			  	 $property_price_info = get_property_price_info();
				 if($property_price_info)
				 {
				 ?>
			  <div class="form_row clearfix <?php if($_REQUEST['upgrade']){echo 'upgrade_highlight';} ?>" >
             	<label><?php echo SELECT_TYPE_TEXT;?> </label>
                <?php get_price_info_event($price_select,$package_pid,$uri[0]);?> 
             	                
             </div>
			 
			 
			 <?php if(get_option('is_allow_coupon_code')){?>
			 <h5 class="form_title"><?php echo COUPON_CODE_TITLE_TEXT;?></h5> 
              <div class="form_row clearfix">
             	<label><?php echo PRO_ADD_COUPON_TEXT;?> </label>
				<input type="text" name="proprty_add_coupon" id="proprty_add_coupon" class="textfield" value="<?php echo esc_attr(stripslashes($proprty_add_coupon)); ?>" />
				 <span class="message_note"><?php echo COUPON_NOTE_TEXT; ?></span>				
             </div>
			 <?php }?>
			 <?php }?>
             <?php }
			              if($_REQUEST['pkg'] || $package_pid || $_REQUEST['pid'] || $_REQUEST['backandedit']){
					?>
            <!--  ##################################### END PRICE DETAILS ############################################# -->
			  <h5 class="form_title "> <?php _e(EVENT_DETAILS_TEXT);?> </h5>
              <!-- ##################### CLAIM LISTING QUESTION ##################-->
             <?php if(get_option('claim_listing')==1){ ?>
             <div class="form_row clearfix">
             	<label><?php echo ADD_EVENT_CLAIM_LISTING;?> <span>*</span> </label>
<div class="category_label2">
             	   
             	<div class="form_cat2">                
                <input type="radio" class="checkbox" name="claimed" id="claimed1" <?php if($claimed=='1' ){echo 'checked="checked"';}?>  value="1" size="20"  /> <?php _e('Yes');?></div>
                
               <div class="form_cat2"  > <input type="radio" class="checkbox" name="claimed" id="claimed2" <?php if($claimed=='0'){echo 'checked="checked"';}?> value="0" size="20"  /> <?php _e('No');?></div>                
                
                </div>
		        <span class="message_error2" id="claimed_span"></span>
             </div>
             <?php } else{
		echo '<input type="radio" class="checkbox" name="claimed" id="claimed1" checked="checked"  value="" style="display:none;" />';		 
		echo '<input type="radio" class="checkbox" name="claimed" id="claimed2"  value="" style="display:none;" />';		 
				 } ?>
			 <!-- ##################### CLAIM LISTING QUESTION ##################-->			 
             <div class="form_row clearfix">
             	<label><?php echo EVENT_TITLE;?> <span>*</span> </label>
             	<input type="text" name="proprty_name" id="proprty_name" class="textfield" value="<?php echo esc_attr(stripslashes($proprty_name)); ?>" size="25"  />
		        <span class="message_error2" id="proprty_name_span"></span>
             </div>
             
    <?php if($link_business_pkg==1){
            //create a query for all of the user businesses posts
    $selected = get_post_meta( $_GET['pid'], 'a_businesses', true );
	if($linkid){$selected = $linkid;}
	           Businesses_custom_metabox($selected);
	}
               ?>  
                 
             <div class="form_row clearfix" <?php if(!get_option('ptthemes_enable_multicity_flag')){?>style="display:none;"<?php }?>>
             	<label><?php echo EVENT_CITY_TEXT;?> </label>
             	<?php if($post_city_id){}else{$post_city_id = $_SESSION['multi_city'];}  echo get_multicit_select_dl('post_city_id','post_city_id',$post_city_id,' class="textfield textfield_x" '); ?>                
             </div>
             
             <?php if(get_option('ptthemes_enable_multihood_flag')){?>
             <div class="form_row clearfix">
             	<label><?php echo NEIGHBOURHOOD;?> </label>
<?php  
echo get_multihood_select_dl('post_hood_id','post_hood_id',$post_city_id,' class="textfield textfield_x" ','','',$post_hood_id); ?>		        
<span class="message_note"><?php echo NEIGHBOURHOOD_MSG;?></span>
             </div>
             <?php }?>
             
             <div class="form_row clearfix">
             	<label><?php echo EVENT_ADDRESS;?> </label>
             	<input type="text" name="address" id="address" class="textfield" value="<?php echo esc_attr(stripslashes($address)); ?>" size="25"  />
		       <span class="message_note"><?php echo ADDREDD_MSG;?></span>
                <span class="message_error2" id="address_span"></span>
             </div>
			 
			 <div class="form_row clearfix">
             <?php include_once(TEMPLATEPATH . "/library/map/location_add_map.php");?>
			  <span class="message_note"><?php echo GET_MAP_MSG;?></span></div>
			  
             
             <div class="form_row clearfix" <?php if($lat_lng==2){echo 'style="display:none;"';}?>>
             	<label><?php echo EVENT_ADDRESS_LAT;?> </label>
             	<input type="text" name="geo_latitude" id="geo_latitude" class="textfield" value="<?php echo esc_attr(stripslashes($geo_latitude)); ?>" size="25"  />
		        <span class="message_note"><?php echo GET_LATITUDE_MSG;?></span>
             </div>
             <div class="form_row clearfix" <?php if($lat_lng==2){echo 'style="display:none;"';}?>>
             	<label><?php echo EVENT_ADDRESS_LNG;?> </label>
             	<input type="text" name="geo_longitude" id="geo_longitude" class="textfield" value="<?php echo esc_attr(stripslashes($geo_longitude)); ?>" size="25"  />
		       <span class="message_note"><?php echo GET_LOGNGITUDE_MSG;?></span>
             </div>
             
              <div class="form_row clearfix">
             	<label><?php echo EVENT_MAP_VIEW_LNG;?> </label>
               <div class="category_label2">
             	                <?php
                if($map_view=='')
				{
					$map_view = 'G_NORMAL_MAP';	
				}
				?>
             	<div class="form_cat2">
                
                <input type="radio" class="checkbox" name="map_view" id="map_view" <?php if($map_view=='G_NORMAL_MAP' ){echo 'checked="checked"';}?>  value="G_NORMAL_MAP" size="25"  /> <?php _e('Default Map');?></div>
               <div class="form_cat2"> <input type="radio"  class="checkbox" name="map_view" id="map_view2" <?php if($map_view=='G_SATELLITE_MAP'){echo 'checked="checked"';}?> value="G_SATELLITE_MAP" size="25"  /> <?php _e('Satellite Map');?></div>
                <div class="form_cat2"><input type="radio" class="checkbox"  name="map_view" id="map_view3" <?php if($map_view=='G_HYBRID_MAP'){echo 'checked="checked"';}?>  value="G_HYBRID_MAP" size="25"  /> <?php _e('Hybrid Map');?></div>
                
                </div>

             </div>
        
              <div class="form_row clearfix">
             	<label><?php echo EVENT_ST_DATE;?> </label>
             	<input type="date"  name="stdate"  id="stdate" class="textfield_m at-date" rel='yy-mm-dd' value="<?php echo esc_attr(stripslashes($st_date)); ?>" size="25"  />
			    &nbsp;<img src="<?php echo bloginfo('template_directory');?>/images/cal.gif" alt="Calendar"  style="cursor: pointer;" align="middle" border="0" />
		         <span class="message_note"><?php echo EVENT_ST_DATE_MSG;?></span>
             </div>
             
             <div class="form_row clearfix">
             	<label><?php echo EVENT_ST_TIME;?> </label>
             	<input type="time" name="sttime" id="sttime" class="textfield at-time" rel='hh:mm'  value="<?php echo esc_attr(stripslashes($st_time)); ?>" size="25"  />
		         <span class="message_note"><?php echo EVENT_ST_TIME_MSG;?></span>
             </div>
              <div class="form_row clearfix">
             	<label><?php echo EVENT_END_DATE;?> </label>
             	<input type="date" name="enddate" id="enddate" class="textfield_m at-date" rel='yy-mm-dd' value="<?php echo esc_attr(stripslashes($end_date)); ?>" size="25"  />
                &nbsp;<img src="<?php echo bloginfo('template_directory');?>/images/cal.gif" alt="Calendar"  style="cursor: pointer;" align="middle" border="0" />
		         <span class="message_note"><?php echo EVENT_END_DATE_MSG;?></span>
             </div>
             <div class="form_row clearfix">
             	<label><?php echo EVENT_END_TIME;?> </label>
             	<input type="time" name="endtime" id="endtime" class="textfield at-time" rel='hh:mm' value="<?php echo esc_attr(stripslashes($end_time)); ?>" size="25"  />
		         <span class="message_note"><?php echo EVENT_END_TIME_MSG;?></span>
             </div>
             
             <?php if($recurring_pkg!=2){?>
             <div class="form_row clearfix" <?php if($recurring_pkg==0){?> onclick="alert('<?php echo NOT_WITH_PACKAGE; ?>');return false" <?php } ?>>
             	<label><?php echo RECURRING_TEXT;?> </label>
                <select name="recurring" id="recurring"  class="textfield">
       			<option value="">Not Recurring</option>
                <?php if($recurring_pkg==1){ ?>
       			<option value="week" <?php if($recurring=='week'){echo 'selected="selected"';} ?>>Every Week</option>
       			<option value="two_week" <?php if($recurring=='two_week'){echo 'selected="selected"';} ?>>Every Two Weeks</option>
       			<option value="month" <?php if($recurring=='month'){echo 'selected="selected"';} ?>>Every Month</option>
       			<option value="year" <?php if($recurring=='year'){echo 'selected="selected"';} ?>>Every Year</option>
                <?php } ?>
                </select>
		         <span class="message_note"><?php echo RECURRING_MSG;?></span>
             </div>
              <?php } ?>
             
			  <?php if($property_desc_pkg!=2){?> 
			  <div class="form_row clearfix" <?php if($property_desc_pkg==0){?> onclick="alert('<?php echo NOT_WITH_PACKAGE; ?>');return false" <?php } ?>>
             	<label><?php echo EVENT_DESCRIPTION_TEXT;?> <span>*</span> </label>
				<textarea  name="proprty_desc" id="proprty_desc" class="textarea" rows=""  cols="" <?php if($property_desc_pkg==0){echo 'disabled="disabled"';} ?>  ><?php  echo esc_attr(stripslashes($proprty_desc)); ?></textarea> 
				<span class="message_note"><?php _e(HTML_TAGS_ALLOW_MSG);?></span>
				<span class="message_error2" id="proprty_desc_span"></span>
             </div>
             <?php } ?>
			 
			 <?php if($reg_desc_pkg!=2){?>
			 <div class="form_row clearfix" <?php if($reg_desc_pkg==0){?> onclick="alert('<?php echo NOT_WITH_PACKAGE; ?>');return false" <?php } ?>>
             	<label><?php echo EVENT_REGISTRATION_DESC;?> </label>
                <textarea  name="reg_desc" id="reg_desc" class="textarea" rows=""  cols="" <?php if($reg_desc_pkg==0){echo 'disabled="disabled"';} ?>><?php if($reg_desc_pkg==1){echo esc_attr(stripslashes($reg_desc));} ?></textarea> 
		         <span class="message_note"><?php echo EVENT_REGISTRATION_DESC_MSG;?></span>
             </div>
             <?php } ?>
             
             <?php if($reg_fees_pkg!=2){?>
             <div class="form_row clearfix" <?php if($reg_fees_pkg==0){?> onclick="alert('<?php echo NOT_WITH_PACKAGE; ?>');return false" <?php } ?>>
             	<label><?php echo EVENT_REGISTRATION_FEES;?> </label>
             	<input type="text" name="reg_fees" id="reg_fees" class="textfield" <?php if($reg_desc_pkg==0){echo 'disabled="disabled"';} ?> value="<?php if($reg_fees_pkg==1){echo esc_attr(stripslashes($reg_fees));} ?>" size="25"  />
		         <span class="message_note"><?php echo EVENT_REGISTRATION_FEES_MSG.EVENT_REGISTRATION_FEES_PRICE_MSG?></span>
             </div>
             <?php } ?>
             
             
              
              <?php if($contact_pkg!=2){?>
             <div class="form_row clearfix" <?php if($contact_pkg==0){?> onclick="alert('<?php echo NOT_WITH_PACKAGE; ?>');return false" <?php } ?>>
             	<label><?php echo EVENT_CONTACT_INFO;?> </label>
             	<input type="tel" name="contact" id="contact" class="textfield" <?php if($contact_pkg==0){echo 'disabled="disabled"';} ?> value="<?php if($contact_pkg==1){echo esc_attr(stripslashes($contact));} ?>" size="25"  />
		        <span class="message_error2" id="contact_span"></span>
                <span class="message_note"><?php echo CONTACT_MSG;?></span>
             </div>
             <?php } ?>
             
             <?php if($email_pkg!=2){?>
             <div class="form_row clearfix" <?php if($email_pkg==0){?> onclick="alert('<?php echo NOT_WITH_PACKAGE; ?>');return false" <?php } ?>>
             	<label><?php echo EVENT_CONTACT_EMAIL;?> </label>
             	<input type="email" name="email" id="email" class="textfield" <?php if($email_pkg==0){echo 'disabled="disabled"';} ?> value="<?php if($email_pkg==1){echo esc_attr(stripslashes($email));} ?>" size="25"  />
		        <span class="message_error2" id="email_span"></span>
             </div>
             <?php } ?>
             
             <?php if($website_pkg!=2){?>
              <div class="form_row clearfix" <?php if($website_pkg==0){?> onclick="alert('<?php echo NOT_WITH_PACKAGE; ?>');return false" <?php } ?>>
             	<label><?php echo EVENT_WEBSITE;?> </label>
             	<input type="url" name="website" id="website" class="textfield" <?php if($website_pkg==0){echo 'disabled="disabled"';} ?>  value="<?php if($website_pkg==1){echo esc_attr(stripslashes($website));} ?>" size="25"  />
		         <span class="message_note"><?php echo WEBSITE_MSG;?></span>
             </div>
             <?php } ?>
             
             <?php if($twitter_pkg!=2){?>
              <div class="form_row clearfix" <?php if($twitter_pkg==0){?> onclick="alert('<?php echo NOT_WITH_PACKAGE; ?>');return false" <?php } ?>>
             	<label><?php echo TWITTER_TEXT; ?></label>
             	 <input name="twitter" id="twitter" <?php if($twitter_pkg==0){echo 'disabled="disabled"';} ?> value="<?php if($twitter_pkg==1){echo esc_attr(stripslashes($twitter));}?>" type="url" class="textfield" />
                 <span class="message_note"><?php echo TWITTER_MSG;?></span>
              </div>
              <?php } ?>
              
              <?php if($facebook_pkg!=2){?>
              <div class="form_row clearfix" <?php if($facebook_pkg==0){?> onclick="alert('<?php echo NOT_WITH_PACKAGE; ?>');return false" <?php } ?>>
             	<label><?php echo FACEBOOK_TEXT; ?></label>
             	 <input name="facebook" id="facebook" <?php if($facebook_pkg==0){echo 'disabled="disabled"';} ?> value="<?php if($facebook_pkg==1){echo esc_attr(stripslashes($facebook));}?>" type="url" class="textfield" />
                 <span class="message_note"><?php echo FACEBOOK_MSG;?></span>
              </div>
              <?php } ?>
              
             <div class="form_row clearfix">
             	<label><?php echo EVENT_CATETORY_TEXT;?> <span>*</span> </label>
            	<div class="category_label"><?php require_once (TEMPLATEPATH . '/library/includes/event_category.php');?></div>
                <span class="message_note"><?php echo EVENT_MSG;?></span>
                <span id="category_span" class="message_error2"></span>
            </div>
             
             <?php if($kw_tags_pkg!=2){?>
             <div class="form_row clearfix" <?php if($kw_tags_pkg==0){?> onclick="alert('<?php echo NOT_WITH_PACKAGE; ?>');return false" <?php } ?>>
            <label><?php echo TAGKW_TEXT; ?></label>
             <input name="kw_tags" id="kw_tags" <?php if($kw_tags_pkg==0){echo 'disabled="disabled"';} ?> value="<?php if($kw_tags_pkg==1){echo esc_attr(stripslashes($kw_tags));}?>" type="text" class="textfield" maxlength="<?php echo TAGKW_TEXT_COUNT;?>" />
             <span class="message_note"><?php echo TAGKW_MSG;?></span>
          </div>
          <?php } ?>
          
            <?php 
			$custom_metaboxes = get_post_custom_fields_templ($package_pid);
			$cus_post_id = mysql_real_escape_string ($_REQUEST['pid']);
			if($_REQUEST['linkid']){$cus_post_id=mysql_real_escape_string ($_REQUEST['linkid']);}
			foreach($custom_metaboxes as $key=>$val)
			{
				$name = $val['name'];
				$site_title = $val['site_title'];
				$type = $val['type'];
				$admin_desc = $val['desc'];
				$option_values = $val['option_values'];
				$value = '';
				if($cus_post_id)
				{
					$value = get_post_meta($cus_post_id, $name,true);
				}else
				if($_SESSION['property_info'] && $_REQUEST['backandedit'])
				{
					$value = 	$_SESSION['property_info'][$name];
				}else{if($value==''){$value= $val['default'];}}
			?>
            <div class="form_row clearfix">
			   <?php if($type=='text'){?>
               <label><?php echo $site_title; ?></label>
             <input name="<?php echo $name;?>" id="<?php echo $name;?>" value="<?php echo $value;?>" type="text" class="textfield" />
               <?php 
                }elseif($type=='link'){if($value== $val['default']){$value='';}?>
               <label><?php echo $site_title; ?></label>
             <input name="<?php echo $name;?>" id="<?php echo $name;?>" value="<?php echo $value;?>" type="text" class="textfield" />
               <?php 
				}elseif($type=='checkbox'){
                ?>     
                <label><?php echo $site_title; ?></label>      
                <input name="<?php echo $name;?>" id="<?php echo $name;?>" <?php if($value){ echo 'checked="checked"';}?>  value="1" type="checkbox" /> 
                <?php
                }elseif($type=='textarea'){
                ?>
                <label><?php echo $site_title; ?></label>
                <textarea name="<?php echo $name;?>" id="<?php echo $name;?>"><?php echo $value;?></textarea>       
                <?php
                }elseif($type=='select'){
                ?>
                 <label><?php echo $site_title; ?></label>
                <select name="<?php echo $name;?>" id="<?php echo $name;?>" class="textfield textfield_x">
                <?php if($option_values){
				$option_values_arr = explode(',',$option_values);
				
				for($i=0;$i<count($option_values_arr);$i++)
				{
				?>
                <option value="<?php echo $option_values_arr[$i]; ?>" <?php if($value==$option_values_arr[$i]){ echo 'selected="selected"';}?>><?php 
				echo str_replace(array('/1', '/0'), '', $option_values_arr[$i]); ?></option>
                <?php	
				}
				?>
                <?php }?>               
                </select>                
                <?php
                }elseif($type=='multiselect'){
				?>
                 <label><?php echo $site_title; ?></label>
                <select name="<?php echo $name;?>[]" id="<?php echo $name;?>" multiple="multiple" class="textfield textfield_x">
                <?php if($option_values){
				$option_values_arr = explode(',',$option_values);
				for($i=0;$i<count($option_values_arr);$i++)
				{
				?>
                <option value="<?php echo $option_values_arr[$i]; ?>" <?php if(in_array($option_values_arr[$i],$value)){ echo 'selected="selected"';}?>><?php echo $option_values_arr[$i]; ?></option>
                <?php	
				}
				?>
                <?php }?>
               
                </select>
                
                <?php
                }
                ?>
                
             	 <span class="message_note"><?php echo $admin_desc;?></span>
              </div>
              <?php }?>
            
             
             
			 <script type="text/javascript">
			 function show_value_hide(val)
			 {
			 	document.getElementById('property_submit_price_id').innerHTML = document.getElementById('span_'+val).innerHTML;
			 }
			 </script>
         
		
        <?php if($video_pkg!=2){?> 
			  <div class="form_row clearfix" <?php if($video_pkg==0){?> onclick="alert('<?php echo NOT_WITH_PACKAGE; ?>');return false" <?php } ?>>
             	<label><?php echo PRO_VIDEO_TEXT;?> </label>
				<textarea  name="video" id="video" class="textarea" rows=""  cols=""  <?php if($video_pkg==0){echo 'disabled="disabled"';} ?> ><?php  if($video_pkg==1){ echo esc_attr(stripslashes($video));} ?></textarea> 
				<span class="message_note"><?php _e(HTML_VIDEO_TEXT);?></span>
				<span class="message_error2" id="video_span"></span>
             </div>
             <?php } ?>
             
          
           
		<?php if(get_option('accept_term_condition')){	?>
        <div class="form_row clearfix">
             	<label>&nbsp;</label>
             	 <input name="term_and_condition" id="term_and_condition" value="" type="checkbox" class="chexkbox" />
                 <?php echo str_replace('\"','"',get_option('term_condition_content'));?>
              </div>
              <script type="text/javascript">
              function check_term_condition()
			  {
				if(eval(document.getElementById('term_and_condition')))  
				{
					if(document.getElementById('term_and_condition').checked)
					{	
						return true;
					}else
					{
						alert('<?php _e('Please accept Terms and Conditions');?>');
						return false;
					}
				}
			  }
              </script>
        <?php 
		$submit_button = 'onclick="return check_term_condition();"';
		}?>
		    
        <?php 
		if(function_exists('pt_get_captch') && $_REQUEST['pid']==''){pt_get_captch(); }?>       
			  <input type="submit" name="Update" value="<?php echo PRO_PREVIEW_BUTTON;?>" class="b_review"  <?php echo $submit_button;?> />
			  
			   <div class="form_row clear_both">
			  	 <span class="message_note"> <?php _e('Note: You will be able to see a preview in the next page');?>  </span>
			  </div>
                                    			 <?php }?>

           </form>  

</div> <!-- content #end -->

</div>


<script language="javascript" type="text/javascript">
/*<![CDATA[*/
<?php if(function_exists('pt_get_captch') && $_REQUEST['emsg']=='captch'){ ?>
jQuery("#<?php $cap_secure = get_captch_id(); echo $cap_secure;?>").focus();
<?php } ?>
var ptthemes_category_dislay = '<?php echo get_option('ptthemes_category_dislay');?>';
var user_val = '';
function set_login_registration_frm(val)
{
	if(val=='existing_user')
	{	user_val = '&user_val=existing';
		document.getElementById('login_user_frm_id').style.display = '';
		document.getElementById('contact_detail_id').style.display = 'none';
		document.getElementById('user_login_or_not').value = val;
	}else  //new_user
	{	user_val = '&user_val=new';
		document.getElementById('contact_detail_id').style.display = '';
		document.getElementById('login_user_frm_id').style.display = 'none';
		document.getElementById('user_login_or_not').value = val;
	}
}
<?php if($user_login_or_not)
{
?>
set_login_registration_frm('<?php echo $user_login_or_not;?>');
<?php
}
?>
/*]]>*/
</script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/place_validation.js"></script> 
</body>