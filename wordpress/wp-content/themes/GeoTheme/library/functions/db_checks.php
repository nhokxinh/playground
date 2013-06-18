<?php
#########################################################
### CHECK BLOGS POSTS FOR CITY ID #######################
#########################################################
function tool_blog_convert(){
global $wpdb,$table_prefix;
$blog_lost = $wpdb->get_results("SELECT ID FROM $wpdb->posts WHERE post_type='post' AND post_status='publish' AND ID NOT IN(SELECT $wpdb->posts.ID FROM $wpdb->posts join $wpdb->postmeta on $wpdb->postmeta.post_id=$wpdb->posts.ID WHERE $wpdb->posts.post_type='post' AND $wpdb->posts.post_status='publish' AND $wpdb->postmeta.meta_key='post_city_id') GROUP BY ID");
$i=0;
foreach($blog_lost as $lost){
	update_post_meta($lost->ID, 'post_city_id', 0);
$i++;	
}
?>
<div class="updated fade below-h2" id="message" style="background-color: rgb(255, 251, 204);" >
 <p><?php if($i){echo $i; _e(' blog posts converted.');}else{ _e('No blog posts converted.');}?></p>
 </div>
 <br />
 <?php
}
#########################################################
### CHECK CITY DATABASE #################################
#########################################################
function chk_city_db(){
global $wpdb,$multicity_db_table_name;
$loc_arr = $wpdb->get_results("SELECT * FROM $multicity_db_table_name");
$i=0;
$err='';
foreach($loc_arr as $loc){
if($loc->city_id==''){$err .= __('<p>Cities with no ID</p>');}
if($loc->cityname==''){$err .= '<p>City id: '.$loc->city_id.' has no name</p>';}
if($loc->lat==''){$err .= '<p>City id: '.$loc->city_id.' has no lat</p>';}
if($loc->lng==''){$err .= '<p>City id: '.$loc->city_id.' has no lng</p>';}
if($loc->scall_factor==''){$err .= '<p>City id: '.$loc->city_id.' has no scall_factor</p>';}
if($loc->is_zoom_home==''){$err .= '<p>City id: '.$loc->city_id.' has no zoom factor</p>';}
if($loc->city_slug==''){$err .= '<p>City id: '.$loc->city_id.' has no slug name</p>';}
$i++;	
}
?>
<div class="updated fade below-h2" id="message" style="background-color:<?php if($err){echo '#FFA6A6';}else{echo '#95FF95';}?>;" >
 <p><?php echo $i; _e(' Cities checked');?></p>
<?php echo $err; ?>
 </div>
 <br />
 <?php
}

#########################################################
### CHECK COUNTRY DATABASE ##############################
#########################################################
function chk_country_db(){
global $wpdb,$multicountry_db_table_name;
$loc_arr = $wpdb->get_results("SELECT * FROM $multicountry_db_table_name");
$i=0;
$err='';
foreach($loc_arr as $loc){
if($loc->country_id==''){$err .= __('<p>Countries with no ID</p>');}
if($loc->countryname==''){$err .= '<p>Country id: '.$loc->country_id.' has no name</p>';}
if($loc->lat==''){$err .= '<p>Country id: '.$loc->country_id.' has no lat</p>';}
if($loc->lng==''){$err .= '<p>Country id: '.$loc->country_id.' has no lng</p>';}
if($loc->scall_factor==''){$err .= '<p>Country id: '.$loc->country_id.' has no scall_factor</p>';}
if($loc->is_zoom_home==''){$err .= '<p>Country id: '.$loc->country_id.' has no zoom factor</p>';}
if($loc->country_slug==''){$err .= '<p>Country id: '.$loc->country_id.' has no slug name</p>';}
$i++;	
}
?>
<div class="updated fade below-h2" id="message" style="background-color:<?php if($err){echo '#FFA6A6';}else{echo '#95FF95';}?>;" >
 <p><?php echo $i; _e(' Countries checked');?></p>
<?php echo $err; ?>
 </div>
 <br />
 <?php
}

#########################################################
### CHECK REGION DATABASE ###############################
#########################################################
function chk_region_db(){
global $wpdb,$multiregion_db_table_name;
$loc_arr = $wpdb->get_results("SELECT * FROM $multiregion_db_table_name");
$i=0;
$err='';
foreach($loc_arr as $loc){
if($loc->region_id==''){$err .= __('<p>Regions with no ID</p>');}
if($loc->regionname==''){$err .= '<p>Region id: '.$loc->region_id.' has no name</p>';}
if($loc->lat==''){$err .= '<p>Region id: '.$loc->region_id.' has no lat</p>';}
if($loc->lng==''){$err .= '<p>Region id: '.$loc->region_id.' has no lng</p>';}
if($loc->scall_factor==''){$err .= '<p>Region id: '.$loc->region_id.' has no scall_factor</p>';}
if($loc->is_zoom_home==''){$err .= '<p>Region id: '.$loc->region_id.' has no zoom factor</p>';}
if($loc->region_slug==''){$err .= '<p>Region id: '.$loc->region_id.' has no slug name</p>';}
$i++;	
}
?>
<div class="updated fade below-h2" id="message" style="background-color:<?php if($err){echo '#FFA6A6';}else{echo '#95FF95';}?>;" >
 <p><?php echo $i; _e(' Regions checked');?></p>
<?php echo $err; ?>
 </div>
 <br />
 <?php
}

#########################################################
### CHECK HOODS DATABASE ################################
#########################################################
function chk_hood_db(){
global $wpdb,$multihood_db_table_name;
$loc_arr = $wpdb->get_results("SELECT * FROM $multihood_db_table_name");
$i=0;
$err='';
foreach($loc_arr as $loc){
if($loc->hood_id==''){$err .= __('<p>Neighbourhoods with no ID</p>');}
if($loc->hoodname==''){$err .= '<p>Neighbourhood id: '.$loc->hood_id.' has no name</p>';}
if($loc->lat==''){$err .= '<p>Neighbourhood id: '.$loc->hood_id.' has no lat</p>';}
if($loc->lng==''){$err .= '<p>Neighbourhood id: '.$loc->hood_id.' has no lng</p>';}
if($loc->scall_factor==''){$err .= '<p>Neighbourhood id: '.$loc->hood_id.' has no scall_factor</p>';}
if($loc->is_zoom_home==''){$err .= '<p>Neighbourhood id: '.$loc->hood_id.' has no zoom factor</p>';}
if($loc->hood_slug==''){$err .= '<p>Neighbourhood id: '.$loc->hood_id.' has no slug name</p>';}
$i++;	
}
?>
<div class="updated fade below-h2" id="message" style="background-color:<?php if($err){echo '#FFA6A6';}else{echo '#95FF95';}?>;" >
 <p><?php echo $i; _e(' Neighbourhoods checked');?></p>
<?php echo $err; ?>
 </div>
 <br />
 <?php
}


#########################################################
### CHECK PRICE DATABASE ################################
#########################################################
function fix_price_db(){
global $wpdb,$price_db_table_name;
$wpdb->get_results("DROP TABLE $price_db_table_name");
geotheme_activation_setup();
?>
<div class="updated fade below-h2" id="message" style="background-color:<?php echo '#95FF95';?>;" >
 <p><?php  _e(' Price table fixed'); echo $price_db_table_name;?></p>
 </div>
 <br />
 <?php
}
?>