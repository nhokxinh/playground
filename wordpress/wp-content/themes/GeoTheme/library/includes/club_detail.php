<?php if(!$preview){get_header();}?>
<div id="wrapper" class="clearfix">

         	<div id="inner_pages" class="clearfix" >

            	

                <h1 class="main_title"><a href="<?php if($preview){echo '#';}else{the_permalink();} ?>" rel="bookmark" title="Permanent Link to <?php if($preview){echo $proprty_name;}else{the_title_attribute();} ?>">

                      <?php if($preview){echo $proprty_name;}else{the_title();} ?>

                      </a></h1>   

                       <div class="likethis">

                     <?php if ( get_option('ptthemes_tweet_button') ) { ?>

                       <a href="http://twitter.com/share" class="twitter-share-button"><?php _e('Tweet');?></a>

					 <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script> 

  					<?php } ?>

                     <?php if ( get_option('ptthemes_facebook_button') ) { ?>

        			<iframe <?php if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)){echo 'allowtransparency="true"'; }?> class="facebook" src="http://www.facebook.com/plugins/like.php?href=<?php echo urlencode(get_permalink($post->ID)); ?>&amp;layout=button_count&amp;show_faces=false&amp;width=100&amp;action=like&amp;colorscheme=light" scrolling="no" frameborder="0"  style="border:none; overflow:hidden; width:100px; height:20px"></iframe> 
                    <?php } ?>
                    
					<?php if ( get_option('ptthemes_google_button') ) { ?>
<div id="plusone-div"></div>
<script type="text/javascript">gapi.plusone.render('plusone-div', {"size": "medium", "count": "true" });</script>                    
					<?php } ?>

                      </div>

                      

                <div class="breadcrumb clearfix">

                <?php if ( get_option( 'ptthemes_breadcrumbs' )) {  ?>

                

                	<div class="breadcrumb_in"><?php if(function_exists('bcn_display')){bcn_display();} ?></div>

                

            <?php } ?></div>
<div class="clearfix"></div>
  		<div id="content" class="content_inner" >
	
			<div class="clearfix">
				<ul>
					<?php
						$features = explode("\n",get_post_meta( $post->ID, 'pg_barsclubs_features', true ));
						foreach($features as $f){
							echo '<li style="padding-left:1em">' . $f . '</li>';
						}
					?>
				</ul>
			</div>
			<hr style="margin-bottom:-1em" />
			<?php $events = get_posts(array('post_type'=>array('event'),'meta_key'=>'pg_event_venue','meta_value'=>$post->ID));
				if (count($events) > 0){
			?>
			<ul>
				<?php
					foreach ($events as $event){
						echo '<li style="padding-left:1em"><a style="color:#31b2e5" href="', $event->guid , '">', $event->post_title, '</a></li>';
					}
				?>
			</ul>
			<hr/>
			<?php } ?>

        <div class="single_post">

      <?php if(have_posts() || $preview) : 
	   if($preview && !$_REQUEST['alook'] && $_SESSION['property_info']['price_select']){$pkg_limit = get_property_price_info_listing('',$_SESSION['property_info']['price_select']);}
	   elseif(($preview && $_REQUEST['alook'] )||($preview && !$_SESSION['property_info']['price_select']) ){$pkg_limit = get_property_price_info_listing($_REQUEST['pid']);}
	   else{$pkg_limit = get_property_price_info_listing($post->ID);} ?>

         <?php if($preview){
		 $thumb_img_counter = 0;
		if($_SESSION["file_info"])
		{	$post_images = array();
			if($_REQUEST['pid']){$post_images = bdw_get_images($_REQUEST['pid'],'large');}
			$thumb_img_counter = $thumb_img_counter+count($_SESSION["file_info"]);
			$image_path = get_image_phy_destination_path();
				
			$tmppath = "/".$upload_folder_path."tmp/";
				
			foreach($_SESSION["file_info"] as $image_id=>$val)
			{
				$post_images[] = site_url().$tmppath.$image_id.'.jpg';
			$thumb_img_counter++;
			}
		}elseif($_REQUEST['pid']){ $post_images = bdw_get_images($_REQUEST['pid'],'large');}
		}else{ $post_images = bdw_get_images($post->ID,'large');}


		 global $thumb_url; /// get the mutiuser id

		$img_p = get_img_p(get_option('ptthemes_image_x_cut'));### added image crop position

		$img_zc = get_img_zc(get_option('ptthemes_image_zc'));### added image zoom or crop option

		$img_q = '&amp;q='.get_option('ptthemes_image_q');### added image quality option

		 ?>

		  <?php  if(!$preview){the_post();} ?>

              <div id="post-<?php if($preview){echo 'preview';}else{the_ID();} ?>" class="posts post_spacer">

<div id="galleria" <?php  if(count($post_images)==1){echo 'style="margin-bottom:-90px;"';} ?>>

             <?php

                if(count($post_images)>0)

				{
					if($pkg_limit['image_limit']=='' || count($post_images)<$pkg_limit['image_limit']){$img_count = count($post_images);}else{$img_count =$pkg_limit['image_limit'];}
					for($im=0;$im<$img_count;$im++)

					{

					?>

            <div class="small" > 

                <a href="<?php echo get_bloginfo('template_directory').'/thumb.php?src='.$post_images[$im].'&amp;w=580&amp;h=390'.$img_zc.$img_p.$img_q.$thumb_url; ?>">

                    <img src="<?php  echo get_bloginfo('template_directory').'/thumb.php?src='.$post_images[$im].'&amp;w=75&amp;h=50&amp;zc='.$img_zc.$thumb_url; ?>" alt=""  title=""/>

                </a>

            </div>

             <?php	

					}

				}

				?>

        </div>
<?php if($post_images){?>
        <script type="text/javascript">

    // Load theme

    Galleria.loadTheme('<?php bloginfo('template_directory'); ?>/library/js/galleria.classic.js');

    // run galleria and add some options

    jQuery('#galleria').galleria({

		width:580,

        height:470,

        image_crop: false, // crop all images to fit

        thumb_crop: true, // crop all thumbnails to fit

		<?php if(count($post_images)==1){ echo 'thumbnails: false,';}?>		

        transition: 'fade', // crossfade photos

        transition_speed: 700, // slow down the crossfade

		autoplay: <?php if(get_option('ptthemes_photo_gallery')){echo 'true';}else{echo 'false';}?>,

        data_config: function(img) {

            // will extract and return image captions from the source:

            return  {

                title: jQuery(img).parent().next('strong').html(),

                description: jQuery(img).parent().next('strong').next().html()

            };

        },

        extend: function() {

            this.bind(Galleria.IMAGE, function(e) {

                // bind a click event to the active image

                jQuery(e.imageTarget).css('cursor','pointer').click(this.proxy(function() {

                    // open the image in a lightbox

                    this.openLightbox();

                }));

            });

        }

    });

    </script>
<?php } ?>



		<?php  if(get_post_meta($post->ID,'video',true) || $video){?>

            <div class="video_main">

            <?php if($preview){echo str_replace('\"', '', $video);}else{echo get_post_meta($post->ID,'video',true);}?>

            </div>

         <?php }?>

         <?php if($preview){echo apply_filters( 'the_content', $proprty_desc );}else{the_content();} ?>

           <?php if(($proprty_feature || get_post_meta($post->ID,'proprty_feature',true)) && $pkg_limit['property_feature_pkg']){?>

           	 <div class="register_info">     

            <?php if($preview){echo $proprty_feature;}else{echo nl2br(get_post_meta($post->ID,'proprty_feature',true));}?> 

           </div>

           <?php }?>

             <!-- <p class="post_bottom clearfix">  <?php 
			 if($preview){echo '<span class="category">'.implode(",", $_SESSION['property_info']['category']).'</span>';
			 if($kw_tags){echo '<span class="tags">'.$kw_tags.'</span>';}
			 }else{the_taxonomies(array('before'=>'<span class="category">','sep'=>'</span><span class="tags">','after'=>'</span>')); }?> </p> -->

				
              </div> <!-- post #end -->



              

               

<div class="pos_navigation clearfix">

    <div class="post_left fl"><?php GT_previous_post_link('%link',''.__('Previous'), true) ?></div>

    <div class="post_right fr"><?php GT_next_post_link('%link',__('Next').'', true) ?></div>

</div>

              </div> <!-- single post content #end -->

              <div class="single_post_advt"><?php dynamic_sidebar(7);  ?> </div>

            		<?php if(get_option('ptthemes_related_on_detailpage')!='No'){ get_related_posts($post);} ?>


 <?php endif; ?>

         <div id="comments" class="clearfix"> <?php comments_template(); ?></div>

  </div> <!-- content #end -->

      <div id="sidebar">

      <div class="company_info">

     <?php  

############################################# Fix for "Edit this Post" link taking user to backend ########################################	 

	 //edit_post_link( __( 'Edit this Post' ), "\n\t\t\t\t\t\t<p class=\"edit-link\">", "</p>\n\t\t\t\t\t" );

	if(get_edit_post_link() && !$preview){

			$var1 = array('wp-admin/post.php?post', '&amp;action=edit');

			$var2  = array('?ptype=post_listing&pid', '');

			$link    = get_edit_post_link();

			$output  = str_replace($var1, $var2, $link);

			echo '<p class="edit-link"><a href="'.$output.'">'.__('Edit this Post').'</a><a href="'.$output.'&upgrade=1" style="float:right;">'.__('Upgrade Listing').'</a></p>';

}

############################################# Fix for "Edit this Post" link taking user to backend ########################################

#######################OWNER VERIFIED FUNCTION ################

$post_id = get_post($post->ID); 

$author_id = $post_id->post_author;

$user = new WP_User( $author_id );

$author_role = $user->roles[0];

if($preview){$is_owned = $claimed;}else{$is_owned = get_post_meta($post->ID,'claimed',true);}



if(get_option('show_owner_verified')==1){ 

if ($author_role =='author' && $is_owned!='0' ){?>



		<p> <span class="i_verified"> <?php echo OWNER_VERIFIED_PLACE;?> </span></p>





<?php }}

###############################################################

#################### claim listing function#######################################

if(get_option('claim_listing')==1){

if ($author_role =='administrator' || $is_owned=='0' ){	

	if ( is_user_logged_in() ) { ?>

	<p class="edit-link"><a href="#" class="b_claim_listing"><?php echo CLAIM_LISTING_OWNER;?></a></p>

<?php } else { ?>

	<p class="edit-link"><a href="<?php echo site_url().'/?ptype=login&msg=claim'; ?>" ><?php echo CLAIM_LISTING_OWNER;?></a></p>

<?php }} }?> 

     <?php if(isset($_REQUEST['claim_request']) && $_REQUEST['claim_request']=='success'){?>

        <p class="sucess_msg"><?php echo CLAIM_LISTING_SUCCESS;?></p>

         <?php }elseif(isset($_REQUEST['emsg']) && $_REQUEST['emsg']=='captch'){?>

        <p class="error_msg_fix"><?php echo WRONG_CAPTCH_MSG;?></p>

        <?php }

########################### end claim listing function ############################

########################### author link function       ############################

if ($is_owned=='1' && get_option('author_link')==1 && !$preview ){	

	 ?>

	<p class="author-link"><?php _e('Author : '); the_author_posts_link(); ?></p>

<?php } 



########################### end author link function   ############################
 
#################### Google Analytics function #######################################
if(get_option('ga_stats')==1 && get_edit_post_link() && !$preview && $post->post_status=='publish' && $pkg_limit['google_analytics']){

if(get_edit_post_link()){

	if ( is_user_logged_in() ) { 

	$page_url = $_SERVER['REQUEST_URI'];

	if(isset($_REQUEST['ga_start'])){$ga_start = $_REQUEST['ga_start'];}else{$ga_start = '';}

	if(isset($_REQUEST['ga_end'])){$ga_end = $_REQUEST['ga_end'];}else{$ga_end ='';}

	?>
<script type="text/javascript">
		jQuery(document).ready(function(){
			
				jQuery("#ga_stats p").load("<?php echo get_bloginfo('url').'/?ptype=ga&ga_page='.$page_url; ?>");
			
		});
		</script>
        <div id="ga_stats"><p><img src="<?php echo get_bloginfo('template_directory').'/images/'; ?>ajax-loader.gif" /></p></div>

<?php }}}

########################### end Google Analytics function############################

?>

 

      	<p> <span class="i_location"><?php _e('Địa chỉ:'); ?> </span> <?php if($preview){echo $address;}else{echo get_post_meta($post->ID,'pg_shopping_address',true);} ?>   </p>

		 <?php if(get_post_meta($post->ID,'pg_shopping_url',true) || $website){

			 if($preview){}else{$website = get_post_meta($post->ID,'pg_shopping_url',true);}

			 if(!strstr($website,'http'))

			 {

				 $website = 'http://'.get_post_meta($post->ID,'pg_shopping_url',true);

			 }

			 ?>

        <?php if($website){?>

		<p>  <span class="i_website"><a href="<?php echo $website;?>" target="_blank" ><strong><?php _e('Website:');?></strong> <?php echo $website;?></a>  </span> </p>

        <?php }?>

		<?php }?>
		
		<?php pg_the_taxonomies(array('before'=>'<p><span>','sep'=>'</span></p><p><span>','after'=>'</span></p>')); ?>

		
		<p><span style="color:#31b2e5;font-weight:bold">Hướng dẫn đường đi: </span><?php echo get_post_meta( $post->ID, 'pg_shopping_direction', true ); ?></p>
		<p><span style="color:#31b2e5;font-weight:bold">Nghỉ lễ: </span><?php echo get_post_meta( $post->ID, 'pg_shopping_holiday', true ); ?></p>
		<p><span style="color:#31b2e5;font-weight:bold">Năm thành lập: </span><?php echo get_post_meta( $post->ID, 'pg_shopping_est', true ); ?></p>
        

        <p>  <?php favourite_html($post->post_author,$post->ID); ?></p>

     

         <?php if(($timing || get_post_meta($post->ID,'timing',true)) && $pkg_limit['timing_pkg']){?>

		<p> <span class="i_time"> <?php echo EVENT_TIMING;?> : </span>  <?php if($preview){echo $timing;}else{echo get_post_meta($post->ID,'timing',true);}?>  </p>

		<?php }?>

         <?php if(($contact || get_post_meta($post->ID,'contact',true)) && $pkg_limit['contact_pkg'] && get_option('ptthemes_contact_on_detailpage')=='Yes' && get_post_meta($post->ID,'contact_show',true)!='No'){?>

		<p> <span class="i_contact"> <?php echo EVENT_CONTACT_INFO;?> :</span>  <?php if($preview){echo $contact;}else{echo get_post_meta($post->ID,'contact',true);}?>  </p>

		<?php }?>

        

         <?php if(($email || get_post_meta($post->ID,'email',true)) && $pkg_limit['email_pkg'] && get_option('ptthemes_email_on_detailpage')=='Yes' && get_post_meta($post->ID,'email_show',true)!='No'){?>

		<p> <span class="i_email2"><a href="#" class="b_send_inquiry" ><?php echo SEND_INQUIRY;?> </a> | <a href="#" class="b_sendtofriend"><?php echo SEND_TO_FRIEND;?></a></span></p>

         <?php if($_REQUEST['send_inquiry']=='success'){?>

        <p class="sucess_msg"><?php echo SEND_INQUIRY_SUCCESS;?></p>

        <?php }elseif($_REQUEST['sendtofrnd']=='success'){?>

        <p class="sucess_msg"><?php echo SEND_FRIEND_SUCCESS;?></p>

        <?php }elseif($_REQUEST['emsg']=='captch'){?>

        <p class="error_msg_fix"><?php echo WRONG_CAPTCH_MSG;?></p>

        <?php }?>

		<?php }?>

                 


           <?php if(!$preview){echo get_post_custom_listing_single_page($post->ID,'<p><span class="post_cus_field {#HTMLVAR#}">{#TITLE#} : </span>{#VALUE#}</p>');}
		   elseif($preview && $_REQUEST['alook']){echo get_post_custom_listing_single_page(mysql_real_escape_string($_REQUEST['pid']),'<p><span class="{#HTMLVAR#}">{#TITLE#}</span> : {#VALUE#}</p>');}else{echo get_post_custom_listing_single_page_preview($post->ID,'<p><span class="post_cus_field {#HTMLVAR#}">{#TITLE#} : </span>{#VALUE#}</p>');} ?>

        

        </div>

        

        <div class="company_info2">
        <?php if(!get_option('ptthemes_disable_rating')){ ?>
<div class="hreview-aggregate">
       <p> <span class="i_rating">
	   
   
	   <?php _e('Rating');?> :</span> <span class="single_rating"> <?php echo get_post_rating_star($post->ID);?></span><br /> 
       
       
       
      <span class="rating">
      <?php  if($preview){$avg_rating = 0;}else{$avg_rating = get_post_average_rating($post->ID);}
if($avg_rating==0)							{echo 0;}
if($avg_rating>=1 && $avg_rating<1.25 )		{echo 1;}
if($avg_rating>=1.25 && $avg_rating<1.75 )	{echo 1.5;}
if($avg_rating>=1.75 && $avg_rating<2.25 )	{echo 2;}
if($avg_rating>=2.25 && $avg_rating<2.75 )	{echo 2.5;}
if($avg_rating>=2.75 && $avg_rating<3.25 )	{echo 3;}
if($avg_rating>=3.25 && $avg_rating<3.75 )	{echo 3.5;}
if($avg_rating>=3.75 && $avg_rating<4.25 )	{echo 4;}
if($avg_rating>=4.25 && $avg_rating<4.75 )	{echo 4.5;}
if($avg_rating>=4.75 && $avg_rating<=5 )	{echo 5;}
 ?></span><?php _e('/5 based on');?> <span class="count"><?php  if($preview){$rating_count = 0;}else{$rating_count = get_post_rating_count($post->ID);} echo $rating_count; ?></span>  <?php _e('user');?> <?php if($rating_count == 1){_e('review.');}else{_e('reviews.');}?>
 <br />
   <span class="item">
      <span class="fn"><?php if($preview){echo $proprty_name;}else{the_title();} ?><br /> 
   <?php if($post_images[0]){ ?><img src="<?php echo get_bloginfo('template_directory').'/thumb.php?src='.$post_images[0].'&amp;w=75&amp;h=50&amp;zc='.$img_zc.$thumb_url; ?>" class="photo" alt="<?php if($preview){echo $proprty_name;}else{the_title();} ?>"/> <?php }?> </span></span>
        
     </p></div><?php }?> 

       <div class="share clearfix"> 

        <div class="addthis_toolbox addthis_default_style">

<a href="http://www.addthis.com/bookmark.php?v=250&amp;username=<?php if(get_option('ptthemes_addthis_username')){echo get_option('ptthemes_addthis_username');}else{ echo 'ra-4facd1303678e5c0';}?>" class="addthis_button_compact sharethis"><?php _e('Share');?></a>

</div>




  </div>

      

      <div class="links">

       <?php if(($twitter || get_post_meta($post->ID,'twitter',true)) && $pkg_limit['twitter_pkg']){?><a href="<?php if($preview){echo $twitter;}else{echo get_post_meta($post->ID,'twitter',true);}?>" class="i_twitter" target="_blank"> <?php _e('Twitter');?> </a> <?php }?>     

        <?php if(($facebook || get_post_meta($post->ID,'facebook',true)) && $pkg_limit['facebook_pkg']){?><a href="<?php if($preview){echo $facebook;}else{echo get_post_meta($post->ID,'facebook',true);}?>" class="i_facebook" target="_blank"><?php _e('Facebook');?> </a><?php }?>  

       </div> 

      


        

         

        </div>  <?php if($pkg_limit['link_business_pkg'] && get_business_events_new() && !$preview): ?>

        <div class="widget">

		<div class="links"><h3><?php _e('Events'); ?></h3>

    <?php echo get_business_events_new(); ?>

    </div></div>

	<?php endif; ?>



    <?php if($pkg_limit['link_business_pkg'] && get_business_events_old() && !$preview): ?>

        <div class="widget">

		<div class="links"><h3><?php _e('Past Events'); ?></h3>

    <?php echo get_business_events_old(); ?>

    </div></div>           

	<?php endif; ?>



    <!-- company info -->

 	<div class="sidebar_in"><?php  dynamic_sidebar(8);  ?> </div>

    </div> <!-- sidebar #end -->

    </div>

    <?php if(!$preview){require_once (TEMPLATEPATH . '/library/includes/popup_frms.php');}?>
</div>
 <?php get_footer(); ?>