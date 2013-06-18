<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type='text/javascript' src='<?php echo site_url();?>/wp-includes/js/jquery/jquery.js?ver=1.7.1'></script>
<script type='text/javascript' src='http://maps.google.com/maps/api/js?sensor=false'></script>
<!--
iPad minimal web app HTML/CSS template (Responsive Web Design, no JS required)

@author Xavi Esteve
@website http://xaviesteve.com/2899/ipad-iphone-mobile-html-css-template-for-web-apps/
@version 1.0
@Last Updated: 31 January 2012
@license Public Domain (free + no need to attribute, I'd be glad if you send me a link to your creation)


Notes:
- Header position bug when scrolling: When you scroll down, the header may move to the middle of the screen. Fix it by removing the # from the URL.

-->
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/> 
<link rel="apple-touch-icon" href="favicon-114.png" />
<meta name="apple-mobile-web-app-capable" content="yes" /><!-- hide top bar in mobile safari-->
<!--<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" /> translucent top bar -->
<!--<link rel="stylesheet" type="text/css" media="screen" href="style.css" />-->
<link rel="shortcut icon" href="/favicon.ico">
<style type="text/css">
/* Eric Meyer's Reset */html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,b,u,i,center,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,embed,figure,figcaption,footer,header,hgroup,menu,nav,output,ruby,section,summary,time,mark,audio,video{border:0;font-size:100%;font:inherit;vertical-align:baseline;margin:0;padding:0;}article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block;}body{line-height:1;}ol,ul{list-style:none;}blockquote,q{quotes:none;}blockquote:before,blockquote:after,q:before,q:after{content:none;}table{border-collapse:collapse;border-spacing:0;}

/* Common */
strong,.strong {font-weight:bold;}
.center {text-align:center;}

/* Shared classes */
.header {background: #aeb2be; /* Old browsers */background: -moz-linear-gradient(top, #ffffff 0%, #aeb2be 100%); /* FF3.6+ */background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(100%,#aeb2be)); /* Chrome,Safari4+ */background: -webkit-linear-gradient(top, #ffffff 0%,#aeb2be 100%); /* Chrome10+,Safari5.1+ */background: -o-linear-gradient(top, #ffffff 0%,#aeb2be 100%); /* Opera 11.10+ */background: -ms-linear-gradient(top, #ffffff 0%,#aeb2be 100%); /* IE10+ */background: linear-gradient(top, #ffffff 0%,#aeb2be 100%); /* W3C */filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#aeb2be',GradientType=0 ); /* IE6-9 */
border-bottom:1px solid #000;height:43px;position:fixed;text-align:center;top:0;left:0;}

.header .title {color:#71787F;font-size:18px;font-weight:bold;margin-top:10px;text-shadow:0 1px 1px #fff;}

/* Structure */
html, #wrap {background:#d8dae0;font: 16px normal Helvetica,sans-serif;-webkit-user-select: none;}
			
	#main {background:#d8dae0;height:100%;padding:63px 20px 20px 320px;position:relative;vertical-align:top;}
		#main .header {padding-left:155px;width:100%;}
			#main .header .left,
			#main .header .right {background: #7A8091; /* Old browsers */background: -moz-linear-gradient(top, #999999 0%, #333333 100%); /* FF3.6+ */background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#999999), color-stop(100%,#333333)); /* Chrome,Safari4+ */background: -webkit-linear-gradient(top, #999999 0%,#333333 100%); /* Chrome10+,Safari5.1+ */background: -o-linear-gradient(top, #999999 0%,#333333 100%); /* Opera 11.10+ */background: -ms-linear-gradient(top, #999999 0%,#333333 100%); /* IE10+ */background: linear-gradient(top, #999999 0%,#333333 100%); /* W3C */filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#999999', endColorstr='#333333',GradientType=0 ); /* IE6-9 */
color: #fff;border-radius: 5px;border: 1px solid #6d6d6d;font-size: 12px;left: 310px;position: fixed;top: 9px;padding: 5px 8px;text-decoration:none;}
			#main .header .title {}
			#main .header .right {right: 10px;left: auto;}
		#main .content {}
			#main .content>:first-child {margin-top:0 !important;}
			#main .content .title {font-size:18px;font-weight:bold;margin:20px 0 10px;}
			#main .content .title2 {color:#4C536C;font-size:16px;font-weight:bold;margin:20px 0 10px;}
			#main .content .title3 {}
			#main .content .title4 {}
			#main .content .title5 {}
			#main .content>p {color:#4C536C;margin:10px 0;text-shadow:0 1px 1px #ccc;}
			#main .content p.note {color:#4C536C;font-size:12px;text-align:center;text-shadow:0 1px 1px #ccc;}
			
			/* Box white */
			#main .content .box-white {background:#fff;border:1px solid #B4B7BB;border-radius:10px;}
				#main .content .box-white p {color:#000;border-bottom:1px solid #B4B7BB;font-weight:bold;margin:0;padding:10px;}
					#main .content .box-white p:last-child {border-bottom:none;}
				#main .content .box-white p span {color:#4C556C;float:right;font-weight:normal;}
					#main .content .box-white p span.detail {color: #999;float: none;font-size:12px;margin-left:5px;}
					#main .content .box-white p span.arrow {color: #666;float: none;font-family: monospace;font-weight: bold;margin-left: 5px;text-shadow: 0 1px 1px #666;}
			
			/* Tables */
			#main table {margin:20px 0 10px;width:100%;}
				#main table thead th {color:#848B9A;font-size:90%;font-weight:normal;margin:20px 0 10px;padding-bottom:10px;text-align:left;}
					#main table thead th:first-child {color:#000;font-size:16px;font-weight:bold;}
				#main table tbody {background:#fff;border:1px solid #B4B7BB;border-radius:10px;/* not working */}
					#main table tbody tr {border-bottom:1px solid #B4B7BB;}
						#main table tbody tr:last-child {border-bottom:none;}
						#main table tbody tr td {color:#4C556C;padding:10px 0;}
							#main table tbody tr td:first-child {color:#000;padding-left:10px;}
							#main table tbody tr td:last-child {padding-right:10px;}
							
							/* Dirty fix attempt for tbody border-radius */
							#main table tbody {border-spacing: 0;}
								#main table tbody tr {border:1px solid #B4B7BB;border-radius:10px;}
								#main table tbody tr:first-child td:first-child {border-top-left-radius:10px;}
								#main table tbody tr:first-child td:last-child {border-top-right-radius:10px;}
								#main table tbody tr:last-child td:first-child {border-bottom-left-radius:10px;}
								#main table tbody tr:last-child td:last-child {border-bottom-right-radius:10px;}
								#main table tbody tr:last-child {border-bottom:1px solid #B4B7BB;}

				/* Links */
				a {color:#0085d5;text-decoration:none;-webkit-touch-callout: none;}
				#main .content .box-white p a,
				#main .content table a {display: block;padding: 10px;margin: -10px;}

				/* Forms and buttons */
				#main .content p label {width:15%;} /* Labels not currently clickable without scripting */
				#main .content p input[type=text],
				#main .content p input[type=tel],
				#main .content p input[type=email],
				#main .content p input[type=url],
				#main .content p input[type=password],
				#main .content p select {background:none;border:none;color:#4C556C;float:right;font-size:14px;margin-top: -1px;width:84%;}
				#main .content p select {margin-right:15px;}
				#main .content p textarea {background:none;border:none;color:#4C556C;font-size:14px;margin-top: -1px;width:100%;height:100px;}
				#main .content .button {color:#fff;cursor:pointer;border:1px solid #999;border-radius: 5px;font-size:16px;font-weight:bold;padding: 8px;width:100%;}
				#main .content .button.red {background: #D42E32; /* Old browsers */
background: -moz-linear-gradient(top, #d58e94 0%, #d42e32 50%, #be1012 51%, #90191b 100%); /* FF3.6+ */background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#d58e94), color-stop(50%,#d42e32), color-stop(51%,#be1012), color-stop(100%,#90191b)); /* Chrome,Safari4+ */background: -webkit-linear-gradient(top, #d58e94 0%,#d42e32 50%,#be1012 51%,#90191b 100%); /* Chrome10+,Safari5.1+ */background: -o-linear-gradient(top, #d58e94 0%,#d42e32 50%,#be1012 51%,#90191b 100%); /* Opera 11.10+ */background: -ms-linear-gradient(top, #d58e94 0%,#d42e32 50%,#be1012 51%,#90191b 100%); /* IE10+ */background: linear-gradient(top, #d58e94 0%,#d42e32 50%,#be1012 51%,#90191b 100%); /* W3C */filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#d58e94', endColorstr='#90191b',GradientType=0 ); /* IE6-9 */
border-color:#9A8185;}
				#main .content .button.blue {background: #3030d4; /* Old browsers */
background: -moz-linear-gradient(top, #8b8bd5 0%, #3030d4 50%, #1111bb 51%, #181893 100%); /* FF3.6+ */background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#8b8bd5), color-stop(50%,#3030d4), color-stop(51%,#1111bb), color-stop(100%,#181893)); /* Chrome,Safari4+ */background: -webkit-linear-gradient(top, #8b8bd5 0%,#3030d4 50%,#1111bb 51%,#181893 100%); /* Chrome10+,Safari5.1+ */background: -o-linear-gradient(top, #8b8bd5 0%,#3030d4 50%,#1111bb 51%,#181893 100%); /* Opera 11.10+ */background: -ms-linear-gradient(top, #8b8bd5 0%,#3030d4 50%,#1111bb 51%,#181893 100%); /* IE10+ */background: linear-gradient(top, #8b8bd5 0%,#3030d4 50%,#1111bb 51%,#181893 100%); /* W3C */filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#8b8bd5', endColorstr='#181893',GradientType=0 ); /* IE6-9 */
border-color:#9A8185;}


	#sidebar {background:#BCBEC4;border-right:1px solid #000;height:100%;left:0;position:fixed;top:0;vertical-align:top;width:300px;z-index:1;}
		#sidebar .header {width:300px;}
			#sidebar .header .title {}
		#sidebar .content {padding: 43px 0 20px 0;}
			#sidebar .content .nav {}
				#sidebar .content .nav a {background:#D9DCE0;border-top:1px solid #E7EAED;border-bottom:1px solid #D0D3D7;color:#000;display:block;font-weight:900;height: 17px;padding: 12px 10px 16px 10px;text-decoration:none;}
					#sidebar .content .nav a.active {background: #0375EE;/* Old browsers */background: -moz-linear-gradient(top, #058CF5 0%, #015DE6 100%); /* FF3.6+ */background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#058CF5), color-stop(100%,#015DE6)); /* Chrome,Safari4+ */background: -webkit-linear-gradient(top, #058CF5 0%,#015DE6 100%); /* Chrome10+,Safari5.1+ */background: -o-linear-gradient(top, #058CF5 0%,#015DE6 100%); /* Opera 11.10+ */background: -ms-linear-gradient(top, #058CF5 0%,#015DE6 100%); /* IE10+ */background: linear-gradient(top, #058CF5 0%,#015DE6 100%); /* W3C */filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#058CF5', endColorstr='#015DE6',GradientType=0 ); /* IE6-9 */
					border-top:1px solid #015DE6;color:#fff;text-shadow:0 1px 1px #333;}
					#sidebar .content .nav a span {color:#4C556C;float:right;font-weight:normal;}
						#sidebar .content .nav a.active span {color:#fff;}
					#sidebar .content .nav a .ico {background:#999;border-radius:5px;display: inline-block;float: none;height: 28px;margin: -5px 10px 0 0;vertical-align: middle;width: 28px;}
					#sidebar .content .nav a .info {background: #E20000;border: 1px solid #C00;border-radius: 100%;box-shadow:0 1px 1px #999;color: white;font-size: 12px;display: block;padding: 1px 5px;}
			#sidebar .content p {color:#4C536C;font-size:14px;padding:10px;text-shadow:0 1px 1px #ccc;}

/* All portable */
@media only screen and (max-device-width: 1024px) {
	#sidebar {overflow:scroll;} /* Sidebar is only scrollable in portable devices, you can change that */
}
/* iPhone */
@media only screen and (max-width: 768px) {
	#sidebar {display:none;}
	#main {padding-left:20px;}
		#main .header {padding-left:0;}
			#main .header .left {left:10px;}
			
#main .content p label {}
				#main .content p input[type=text],
				#main .content p input[type=password],
				#main .content p select {width:60%;}
}


.arrow-left {
	width: 0; 
	height: 0; 
	border-top: 10px solid transparent;
	border-bottom: 10px solid transparent; 
	
	border-right:10px solid blue; 
}

.arrow-down {
	width: 0; 
	height: 0; 
	border-left: 10px solid transparent;
	border-right: 10px solid transparent;
	
	border-top: 10px solid blue;
}

.ddown {background:#CCC;display:none;}

.message_note{margin-left::2px;}
.form_cat, .form_subcat {width:280px !important;}
</style>
</head>

<?php
//print_r($_SESSION);
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
	$package_pid = $post_meta['package_pid'][0];
	$post_hood_id = $post_meta['post_hood_id'][0];
	############################## FIX FOR TAGS
	$kw_tags = '';
	$tags = get_the_terms( $pid, 'place_tags' );
$xt = 1;
foreach ($tags as $tag) {
if ($xt <= 20) {
$kw_tags .= $tag->name.", ";
}
$xt++;
}
################
	//$kw_tags = $post_meta['kw_tags'][0];
	$proprty_feature =$post_meta['proprty_feature'][0];
	$post_city_id =$post_meta['post_city_id'][0];
	$cat_array = array();
	if($pid)
	{
		//$catinfoarr = get_the_category($post_info['ID']);
		$catinfoarr = get_the_terms($post_info['ID'], 'placecategory');

		$cat_array = array();
		
		foreach ($catinfoarr as $taxindex => $taxitem)
		{
		$cat_array[] = $taxitem->name;
		}
		/*for($c=0;$c<count($catinfoarr);$c++)
		{
			$cat_array[] = $catinfoarr[$c]->term_id;
		}*/
	}
	$thumb_img_arr = bdw_get_images_with_info($_REQUEST['pid'],'thumb');
}
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
	$timing = $_SESSION['property_info']['timing'];
	$contact = $_SESSION['property_info']['contact'];
	$email = $_SESSION['property_info']['email'];
	$website = $_SESSION['property_info']['website'];
	$twitter = $_SESSION['property_info']['twitter'];
	$facebook = $_SESSION['property_info']['facebook'];
	$kw_tags = $_SESSION['property_info']['kw_tags'];
	$post_city_id = $_SESSION['property_info']['post_city_id'];
	$post_hood_id = $_SESSION['property_info']['post_hood_id'];
	if($_SESSION['property_info']['package_pid']){$package_pid = $_SESSION['property_info']['package_pid'];}
	
	$user_fname = $_SESSION['property_info']['user_fname'];
	$user_phone = $_SESSION['property_info']['user_phone'];
	$user_email = $_SESSION['property_info']['user_email'];
	$user_login_or_not = $_SESSION['property_info']['user_login_or_not'];
	$cat_array = $_SESSION['property_info']['category'];
	$proprty_add_coupon = $_SESSION['property_info']['proprty_add_coupon'];
	$price_select = $_SESSION['property_info']['price_select'];
}
################ LIMIT PACKAGE CODE ######################


if($_SESSION['property_info']['price_select']){$price_select = $_REQUEST['pkg'];}

if($_REQUEST['pkg'] || $package_pid)
{	
if($_REQUEST['pkg']){$package_pid = $_REQUEST['pkg']; }
global $price_db_table_name,$wpdb;
$pricesql = "select * from $price_db_table_name where status=1 and pid=$package_pid and post_type='listing'";
$priceinfo = $wpdb->get_row($pricesql, ARRAY_A);
//echo $priceinfo['title'];
	
	
	
$html_editor = $priceinfo['html_editor'];
$property_feature_pkg = $priceinfo['property_feature_pkg'];
$property_desc_pkg = $priceinfo['property_desc_pkg'];
$listing_desc_pkg = $priceinfo['listing_desc_pkg'];
$timing_pkg = $priceinfo['timing_pkg'];
$contact_pkg = $priceinfo['contact_pkg'];
$email_pkg = $priceinfo['email_pkg'];
$website_pkg = $priceinfo['website_pkg'];
$twitter_pkg = $priceinfo['twitter_pkg'];
$facebook_pkg = $priceinfo['facebook_pkg'];
$kw_tags_pkg = $priceinfo['kw_tags_pkg'];
$image_limit = $priceinfo['image_limit'];
$cat_limit = $priceinfo['cat_limit'];
$cat_exclude = $priceinfo['cat'];
}
################## LIMIT PACKAGE CODE #####################
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
			$page_title = UPGRADE_EVENT_TEXT;
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
<div id="wrap">
	
	
		<div id="main">
		
            
<div id="content" class="content" >


<h2 class="title" <?php if(get_option('is_user_addevent')=='0' || get_option('is_user_eventlist')=='0'){ echo 'style="display:none"';} ?>> <?php _e(SELECT_LISTING_TYPE_TEXT);?></h2>
              <div class="form_row clearfix" <?php if(get_option('is_user_addevent')=='0' || get_option('is_user_eventlist')=='0'){ echo 'style="display:none"';} ?>>
                <div class="box-white">
                <p>
                   <?php if(get_option('is_user_addevent')=='0'){}else{ ?> 
             	<input name="listing_type" id="place_listing" type="radio" value="post_listing" <?php if($_REQUEST['submit_place']){ echo 'checked="checked"';}?> onClick="window.location.href='<?php echo site_url();?>/?api_submit=1&submit_place=1&user_name=<?php echo $_REQUEST['user_name'];?>&user_pass=<?php echo $_REQUEST['user_pass'];?>'" /> <?php echo POST_PLACE_TITLE;?>
                <?php }?>
                
                <span>
                <?php if(get_option('is_user_eventlist')=='0'){}else{ ?>  
				 <input name="listing_type" id="event_listing" type="radio" value="post_event" <?php if($_REQUEST['submit_event']){ echo 'checked="checked"';}?>  onclick="window.location.href='<?php echo site_url();?>/?api_submit=1&submit_event=1&user_name=<?php echo $_REQUEST['user_name'];?>&user_pass=<?php echo $_REQUEST['user_pass'];?>'" /> <?php echo POST_EVENT_TITLE;?>
                 <?php }?>
                 </span>
                 </p>
                 </div><!--box-white-->
             </div>
             
             
			 
			  <?php
			 if($_REQUEST['pid'] || $_POST['renew'] || $_POST['upgrade']){
				//$form_action_url = site_url().'/?ptype=preview';
			 }else
			 {
				// $form_action_url = get_ssl_normal_url(site_url().'/?ptype=preview',$_REQUEST['pid']);
			 }
			$form_action_url = site_url().'/?api_submit=1&submit_place=1&pkg=1&step=1';
			 ?>             
            <form name="propertyform" id="propertyform" action="<?php echo $form_action_url; ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="user_login_or_not" id="user_login_or_not" value="<?php echo $user_login_or_not;?>" />
            <input type="hidden" name="pid" value="<?php echo $_REQUEST['pid'];?>" />
            <input type="hidden" name="renew" value="<?php echo $_REQUEST['renew'];?>" />
            <input type="hidden" name="upgrade" value="<?php echo $_REQUEST['upgrade'];?>" />
            <input type="hidden" name="post_type" value="place" />
            
            <input type="hidden" name="user_name" value="<?php echo $_REQUEST['user_name'];?>" />
            <input type="hidden" name="user_pass" value="<?php echo $_REQUEST['user_pass'];?>" />

			 
			 <!--  ##################################### PRICE DETAILS ################################################ -->
              <?php if($_REQUEST['pid']=='' || $_REQUEST['renew'] || $_REQUEST['upgrade']){?>
                   
              <?php 
			  
			$uri =  end(explode('?', $_SERVER['REQUEST_URI']));
			$uri = explode('&pkg=', $uri);
			//echo $uri[0];
			  	 $property_price_info = get_property_price_info();
				 if($property_price_info)
				 {
				 ?>
			  <div class="form_row clearfix <?php if($_REQUEST['upgrade']){echo 'upgrade_highlight';} ?>" >
             	<h2 class="title"><?php echo SELECT_TYPE_TEXT; ?> </h2>
                <?php get_app_price_info($price_select,$package_pid,$uri[0], 'listing');?> 
             	                
             </div>
			 
<script type="text/javascript">
jQuery(".arrow-left").click(function () {
jQuery(this).toggleClass("arrow-down");
var id = jQuery(this).attr('id');
jQuery("."+id ).slideToggle("slow");
});
</script>
			 
			 <?php if(get_option('is_allow_coupon_code')){?>
			 <h2 class="title"><?php echo COUPON_CODE_TITLE_TEXT;?></h2> 
              <div class="box-white">
             	<p><label><?php echo PRO_ADD_COUPON_TEXT;?></label>
				<input type="text" name="proprty_add_coupon" id="proprty_add_coupon" class="textfield" value="<?php echo esc_attr(stripslashes($proprty_add_coupon)); ?>" /></p>
             </div>
             <p><?php echo COUPON_NOTE_TEXT; ?></p>				

			 <?php }?>
			 <?php }?>
             <?php }
             if($_REQUEST['pkg'] || $package_pid || $_REQUEST['pid'] || $_REQUEST['backandedit']){
					?>
            <!--  ##################################### END PRICE DETAILS ############################################# -->
			  <h2 class="title"><?php _e(LISTING_DETAILS_TEXT);?></h2>
             <!-- ##################### CLAIM LISTING QUESTION ##################-->
             <?php if(get_option('claim_listing')==1){ ?>
             <p><?php echo ADD_PLACE_CLAIM_LISTING;?></p>
             <div class="box-white">
             <p><input type="radio" class="checkbox" name="claimed" id="claimed1" <?php if($claimed=='1' ){echo 'checked="checked"';}?>  value="1"  /> <?php _e('Yes');?>
             <span><input type="radio" class="checkbox" name="claimed" id="claimed2" <?php if($claimed=='0'){echo 'checked="checked"';}?> value="0"   /> <?php _e('No');?>			</span></p>               
           </div>
             <span class="message_error2" id="claimed_span"></span>
             
             <?php }else{
		echo '<input type="radio" class="checkbox" name="claimed" id="claimed1" checked="checked"  value="" style="display:none;" />';		 
		echo '<input type="radio" class="checkbox" name="claimed" id="claimed2"  value="" style="display:none;" />';		 
				 } ?>
			 <!-- ##################### CLAIM LISTING QUESTION ##################-->
		
              <div class="box-white">
             	<p><label><?php echo EVENT_TITLE_TEXT;?></label></
             	<input type="text" name="proprty_name" id="proprty_name" class="textfield" value="<?php echo esc_attr(stripslashes($proprty_name)); ?>" />
                <span class="message_error2" id="proprty_name_span"></span>

		        </p>
             
            
                <p <?php if(!get_option('ptthemes_enable_multicity_flag')){?>style="display:none;"<?php }?>>
             	<label><?php echo EVENT_CITY_TEXT;?> </label>
             	<?php if($post_city_id){}else{$post_city_id = $_SESSION['multi_city'];}  echo get_multicit_select_dl('post_city_id','post_city_id',$post_city_id,' class="textfield textfield_x" '); ?>
                </p>
             
			<?php if(get_option('ptthemes_enable_multihood_flag')){?>
             <p>
             	<label><?php echo NEIGHBOURHOOD;?> </label>
<?php  
echo get_multihood_select_dl('post_hood_id','post_hood_id',$post_city_id,' class="textfield textfield_x" ','','',$post_hood_id); ?>		        
             </p>
             <?php }?>
             
             
             <p>
             	<label><?php echo EVENT_ADDRESS;?> </label>
             	<input type="text" name="address" id="address" class="textfield" value="<?php echo esc_attr(stripslashes($address)); ?>"  />
             </p>
             
             </div>
             
			 <div class="box-white"> 
			 <?php include_once("location_add_map_app.php");?>
			 <span class="message_note"><?php echo GET_MAP_MSG;?></span></div>
			
             
             
             	<input type="hidden" name="geo_latitude" id="geo_latitude" class="textfield" value="<?php echo esc_attr(stripslashes($geo_latitude)); ?>" size="25"  />
		       
             	<input type="hidden" name="geo_longitude" id="geo_longitude" class="textfield" value="<?php echo esc_attr(stripslashes($geo_longitude)); ?>" size="25"  />
		      
			  
               <p><?php echo EVENT_MAP_VIEW_LNG;?></p>

             	                <?php
                if($map_view=='')
				{
					$map_view = 'G_NORMAL_MAP';	
				}
				?>
                
                <table>
					<tbody>
						<tr>
                        	<td>
                            <input type="radio" class="checkbox" name="map_view" id="map_view" <?php if($map_view=='G_NORMAL_MAP' ){echo 'checked="checked"';}?>  value="G_NORMAL_MAP" size="25"  /> <?php _e('Default');?>                           
                            </td>
                            <td>
                            <input type="radio"  class="checkbox" name="map_view" id="map_view1" <?php if($map_view=='G_SATELLITE_MAP'){echo 'checked="checked"';}?> value="G_SATELLITE_MAP" size="25"  /> <?php _e('Satellite');?>
                            </td>
                            <td>
                            <input type="radio" class="checkbox"  name="map_view" id="map_view2" <?php if($map_view=='G_HYBRID_MAP'){echo 'checked="checked"';}?>  value="G_HYBRID_MAP" size="25"  /> <?php _e('Hybrid');?>
                            </td>
                        </tr>
					</tbody>
				</table>
                
                
                

			  <div class="box-white">
             	<p class="center"><label><?php echo PRO_DESCRIPTION_TEXT;?></label></p>
				<p><textarea  name="proprty_desc" id="proprty_desc" class="textarea" rows=""  cols=""  ><?php  echo esc_attr(stripslashes($proprty_desc)); ?></textarea></p> 
			
             
             <?php if($property_feature_pkg!=2){?> 
             	<p class="center"><label><?php echo PRO_FEATURE_TEXT;?></label></p>
				<p><textarea  name="proprty_feature" id="proprty_feature" class="textarea" rows=""  cols=""  <?php if($property_feature_pkg==0){echo 'disabled="disabled"';} ?> ><?php  if($property_feature_pkg==1){ echo esc_attr(stripslashes($proprty_feature));} ?></textarea></p> 
				         
             <?php } ?>
			 
			 
			 <?php if($timing_pkg!=2){?>
             	<p><label><?php echo EVENT_TIMING;?> </label></p>
             	<input type="text" name="timing" id="timing" class="textfield" value="<?php if($timing_pkg==1){ echo esc_attr(stripslashes($timing));} ?>" size="25"  <?php if($timing_pkg==0){echo 'disabled="disabled"';} ?>  /></p>
             <?php } ?>
             
             <?php if($contact_pkg!=2){?>
             	<p><label><?php echo EVENT_CONTACT_INFO;?> </label>
             	<input type="tel" name="contact" id="contact" class="textfield" value="<?php if($contact_pkg==1){ echo esc_attr(stripslashes($contact));} ?>" size="25"  <?php if($contact_pkg==0){echo 'disabled="disabled"';} ?>/></p>
		      <?php } ?>
             
             <?php if($email_pkg!=2){?>
             	<p><label><?php echo EVENT_CONTACT_EMAIL;?> </label>
             	<input type="email" name="email" id="email" class="textfield" value="<?php if($email_pkg==1){ echo esc_attr(stripslashes($email));} ?>" size="25"  <?php if($email_pkg==0){echo 'disabled="disabled"';} ?>/></p>
             <?php } ?>
             
             <?php if($website_pkg!=2){?>
             	<p><label><?php echo EVENT_WEBSITE;?> </label>
             	<input type="url" name="website" id="website" class="textfield" value="<?php if($website_pkg==1){ echo esc_attr(stripslashes($website));} ?>" size="25" <?php if($website_pkg==0){echo 'disabled="disabled"';} ?> /></p>
             <?php } ?>
             
             <?php if($twitter_pkg!=2){?>
             	<p><label><?php echo TWITTER_TEXT; ?></label>
             	 <input name="twitter" id="twitter" value="<?php if($website_pkg==1){ echo esc_attr(stripslashes($twitter)); }?>" type="url" class="textfield" <?php if($twitter_pkg==0){echo 'disabled="disabled"';} ?> /></p>
              <?php } ?>
              
              <?php if($facebook_pkg!=2){?>
             	<p><label><?php echo FACEBOOK_TEXT; ?></label>
             	 <input name="facebook" id="facebook" value="<?php if($website_pkg==1){ echo esc_attr(stripslashes($facebook)); }?>" type="url"  class="textfield" <?php if($facebook_pkg==0){echo 'disabled="disabled"';} ?> /></p>
              <?php } ?>
              
              </div>
              
             	<h2 class="title2"><?php echo EVENT_CATETORY_TEXT;?></h2>
            	<p><?php require_once (TEMPLATEPATH . '/library/includes/places_category.php');?></p>
            
            <div class="box-white">
            <?php if($kw_tags_pkg!=2){?>
             	<p><label><?php echo TAGKW_TEXT; ?></label>
             	 <input name="kw_tags" id="kw_tags" value="<?php if($kw_tags_pkg==1){ echo esc_attr(stripslashes($kw_tags)); } ?>" type="text" class="textfield" maxlength="<?php echo TAGKW_TEXT_COUNT;?>" <?php if($kw_tags_pkg==0){echo 'disabled="disabled"';} ?> /></p>
              <?php } ?>
              
     		<?php 
			$custom_metaboxes = get_post_custom_fields_templ($package_pid);
			foreach($custom_metaboxes as $key=>$val)
			{
				$name = $val['name'];
				$site_title = $val['site_title'];
				$type = $val['type'];
				$admin_desc = $val['desc'];
				$option_values = $val['option_values'];
				$value='';
				if($_REQUEST['pid'])
				{
					$value = get_post_meta($_REQUEST['pid'], $name,true);
				}else
				if($_SESSION['property_info'] && $_REQUEST['backandedit'])
				{
					$value = 	$_SESSION['property_info'][$name];
				}else{if($value==''){$value= $val['default'];}}
			?>
			   <?php if($type=='text'){?>
               <p><label><?php echo $site_title; ?></label>
             <input name="<?php echo $name;?>" id="<?php echo $name;?>" value="<?php echo $value;?>" type="text" class="textfield" /></p>
               <?php 
                }elseif($type=='checkbox'){
                ?>     
                 <p><label><?php echo $site_title; ?></label>      
                <input name="<?php echo $name;?>" id="<?php echo $name;?>" <?php if($value){ echo 'checked="checked"';}?>  value="<?php echo $default_value;?>" type="checkbox" /></p> 
                <?php
                }elseif($type=='textarea'){
                ?>
                <p class="center"><label><?php echo $site_title; ?></label></p>
                <p><textarea name="<?php echo $name;?>" id="<?php echo $name;?>"><?php echo $value;?></textarea></p>       
                <?php
                }elseif($type=='select'){
                ?>
                 <p><label><?php echo $site_title; ?></label>
                <select name="<?php echo $name;?>" id="<?php echo $name;?>" class="textfield textfield_x"></select>
                <?php if($option_values){
				$option_values_arr = explode(',',$option_values);
				
				for($i=0;$i<count($option_values_arr);$i++)
				{
				?>
                <option value="<?php echo $option_values_arr[$i]; ?>" <?php if($value==$option_values_arr[$i]){ echo 'selected="selected"';}?>><?php echo $option_values_arr[$i]; ?></option>
                <?php	
				}
				?>
                <?php }?>
               
                </select></p>
                
                <?php
                }elseif($type=='multiselect'){
				?>
                 <p><label><?php echo $site_title; ?></label>
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
               
                </select></p>
                
                <?php
                }
                ?>
            <?php
			}
			?>
             
            
            </div> 
            
			 <script type="text/javascript">
			 function show_value_hide(val)
			 {
			 	document.getElementById('property_submit_price_id').innerHTML = document.getElementById('span_'+val).innerHTML;
			 }
			 </script>
       
		
		<?php if(get_option('accept_term_condition')){	?>
			  <div class="box-white">
             	<p><label><?php echo str_replace('\"','"',get_option('term_condition_content'));?></label>
             	 <input name="term_and_condition" id="term_and_condition" value="" type="checkbox" class="chexkbox" /></p>
                 
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
		
		  <?php if(function_exists('pt_get_captch') && $_REQUEST['pid']==''){pt_get_captch_app(); }?>

			  <input type="submit" name="Update"  class="button blue"  value="<?php echo PRO_PREVIEW_BUTTON;?>" class="b_review" <?php echo $submit_button;?>/>
			  
			
              
           </form>  
           			 <?php }?>

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