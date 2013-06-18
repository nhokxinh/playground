<?php get_header(); 
global $wp_query, $post;
$current_term = $wp_query->get_queried_object();
?>
<?php dynamic_sidebar('Event Listing Top Section'); ?>
<div id="wrapper" class="clearfix">
  <div id="inner_pages" class="clearfix" >
            
            	    <h1> <?php echo $current_term->name; ?> </h1>

                 <div class="breadcrumb clearfix">
				<?php if ( get_option( 'ptthemes_breadcrumbs' )) {  ?>
                	<div class="breadcrumb_in"><?php if(function_exists('bcn_display')){bcn_display();} ?></div>
            <?php } ?>
            </div>
    
    <div class="clearfix"></div>
    <div id="content" class="content_index clearfix">
  <div id="cat_top_desc">
   <?php 
$saved_data = stripslashes(get_tax_meta($current_term->term_id,'ct_cat_top_desc'));
 $cat_description =  apply_filters( 'the_content', $saved_data );
if($cat_description){echo str_replace('%location_name%', $_SESSION['location_name'], $cat_description);}?>
  </div>
        <div class="clearfix"></div>
         <?php if(get_option('ptthemes_cat_sort_dd')){?>
     
		<div class="sort_by sort_by_dd"><?php _e('Events');?> :
        <select name="sort_by_dd" id="sort_by_dd" onchange="set_selected_city(this.value)">
      <?php
	   if($_REQUEST['etype']=='')
	   {
			$_REQUEST['etype'] = 'upcoming';   
	   }
	    $category_link =  get_term_link( $term, $taxonomy );?>
        
        <option value="<?php if(strstr($category_link,'?')){ echo $cat_url = $category_link."&amp;etype=upcoming";}else{ echo $cat_url = $category_link."?etype=upcoming";}?>" <?php if($_REQUEST['etype']=='upcoming'){ echo 'selected="selected"';}?>><?php _e('Upcoming');?></option>
        
        <option value="<?php if(strstr($category_link,'?')){ echo $cat_url = $category_link."&amp;etype=past";}else{ echo $cat_url = $category_link."?etype=past";}?>" <?php if($_REQUEST['etype']=='past'){ echo 'selected="selected"';}?>><?php _e('Past');?></option>                
          
                   <?php get_category_sort_terms($current_term->term_id,$category_link); ?>
        
         <?php get_category_sort_terms_dd($current_term->term_id,$category_link); ?>
 
    </select>	
        			</div>
<script type="text/javascript">
jQuery(function(){
  jQuery("#sort_by_dd").change(function(){
    window.location=this.value
  });
});
</script>	
			<?php } else{?>
    <ul class="sort_by">
    	<li class="title"> <?php _e('Events');?> :</li>
       <?php
	   if($_REQUEST['etype']=='')
	   {
			$_REQUEST['etype'] = 'upcoming';   
	   }
	    $category_link =  get_term_link( $term, $taxonomy );?>
         <li class="<?php if($_REQUEST['etype']=='upcoming'){ echo 'current';}?> upcoming"> <a href="<?php if(strstr($category_link,'?')){ echo $cat_url = $category_link."&amp;etype=upcoming";}else{ echo $cat_url = $category_link."?etype=upcoming";}?>">  <?php _e('Upcoming');?> </a></li>
          <li class="<?php if($_REQUEST['etype']=='past'){ echo 'current';}?> past"> <a href="<?php if(strstr($category_link,'?')){ echo $cat_url = $category_link."&amp;etype=past";}else{ echo $cat_url = $category_link."?etype=past";}?>">  <?php _e('Past');?> </a></li>
                   <?php get_category_sort_terms($current_term->term_id,$category_link); ?>

           <li class="i_next"> <?php next_posts_link(__('Next')) ?>  </li>
            <li class="i_previous"><?php previous_posts_link(__('Previous')) ?> </li>
     </ul>
              <?php }?>          
<div id="filter_boxes">
  <?php get_category_filter_terms($current_term->term_id,$category_link);?>
  </div>
    <ul class="<?php if(get_option('ptthemes_cat_listing')=='grid'){echo 'category_grid_view';}else{ echo 'category_list_view';}?> clearfix">
   
  
      
	  <?php if(have_posts()) : $pcount=0; ?>
      <?php while(have_posts()) : the_post()  ?>
     
      
<?php $pcount++;
global $thumb_url,$wpdb;
$thumb_url1 = $thumb_url.get_image_cutting_edge($args);
$img_zc = get_img_zc(get_option('ptthemes_image_zc'));### added image zoom or crop option
$post_images = bdw_get_images($post->ID,'large');
$cat_default_img = get_tax_meta($current_term->term_id,'ct_cat_default_img'); // Set the default category image
$no_image = get_bloginfo('template_url').'/images/no-image.jpg';
if($cat_default_img['src']){$default_img = $cat_default_img['src'];}else{$default_img =$no_image;}
$current_post_id = $post->ID;
$new_days = get_option('ptthemes_new_days');
?>     
   	
        <?php
        if(get_option('ptthemes_cat_listing')=='grid')
		{
		?>
        	<li id="post-<?php the_ID(); ?>" class="clearfix <?php if(get_post_meta($post->ID,'is_featured',true)){ echo 'featured';}?> <?php echo FEATURED_IMG_CLASS;?>
"> 
           <?php if(round(abs(strtotime($post->post_date)-strtotime(date('Y-m-d')))/86400)<$new_days) {?> <span class="<?php echo 'new';?>">new</span> <?php }?>
           <?php if(get_post_meta($post->ID,'is_featured',true)) {?> <span class="<?php echo 'featured_img';?>">featured</span> <?php }?>
            
<?php 
if(get_the_post_thumbnail( $post->ID, array())){?>
<a class="post_img" href="<?php the_permalink(); ?>">
<?php $post_thumb =  get_the_post_thumbnail_src(get_the_post_thumbnail( $post->ID));?>
<img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo $post_thumb;?>&amp;w=<?php echo TTIMG_SW;?>&amp;h=<?php echo TTIMG_SH;?>&amp;zc=<?php echo $img_zc; ?>&amp;q=80<?php echo $thumb_url1;?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"  />
</a><?php
}else if($post_images[0]){ 
?>
 <a class="post_img" href="<?php the_permalink(); ?>"><img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo $post_images[0];?>&amp;w=<?php echo TTIMG_SW;?>&amp;h=<?php echo TTIMG_SH;?>&amp;zc=<?php echo $img_zc; ?>&amp;q=80<?php echo $thumb_url1;?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"  /></a>
<?php
} else {?>
<a class="post_img" href="<?php the_permalink(); ?>"><img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo $default_img; ?>&amp;w=<?php echo TTIMG_SW;?>&amp;h=<?php echo TTIMG_SH;?>&amp;zc=<?php echo $img_zc; ?>&amp;q=80<?php echo $thumb_url1;?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"  /></a><?php }?> 
            
                <h3> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3> 
                <p class="timing"> <span><?php _e('Start Date :');?></span> <?php echo get_formated_date(get_post_meta($post->ID,'st_date',true)).' '.get_formated_time(get_post_meta($post->ID,'st_time',true));?><br />
               <span><?php _e('End Date :');?></span> <?php echo  get_formated_date(get_post_meta($post->ID,'end_date',true)) . ' ' .get_formated_time(get_post_meta($post->ID,'end_time',true));?> </p>
                
                <span class="rating"><?php echo get_post_rating_star($current_post_id);?></span>
                
                 <span class="ping"><a href="#sticky_map"  onclick="openMarker('<?php echo $post->ID; ?>')"  id="pinpoint_<?php echo $post->ID; ?>"><?php _e('Pinpoint');?></a></span>
               <?php favourite_html($post->post_author,$post->ID); ?>
            <p class="timing"> <?php echo $attribute_desc = get_post_custom_for_listing_page($post->ID,' <span class="{#HTMLVAR#}">{#TITLE#}</span> : {#VALUE#}<br /> '); ?> </p>
             <p class="review clearfix">    
             <a href="<?php the_permalink(); ?>#comments" class="pcomments" ><?php comments_number('0', '1', '%'); ?> </a>  
             <span class="readmore"> <a href="<?php the_permalink(); ?>"><?php _e('read more');?> </a> </span>
             </p>
             </li>
             <?php if($pcount!=0 && ($pcount%5)==0){?>
             <li class="hr"></li>
             <?php }?>
         <?php
		}else
		{
		?>
        <li id="post-<?php the_ID(); ?>" class="clearfix <?php if(get_post_meta($post->ID,'is_featured',true)){ echo 'featured';}?> <?php echo FEATURED_IMG_CLASS;?>
"> 
       <?php if(round(abs(strtotime($post->post_date)-strtotime(date('Y-m-d')))/86400)<$new_days) {?> <span class="<?php echo 'new';?>">new</span> <?php }?>
       <?php if(get_post_meta($post->ID,'is_featured',true)) {?> <span class="<?php echo 'featured_img';?>">featured</span> <?php }?>
        
      <?php 
            if(get_the_post_thumbnail( $post->ID, array())){?>
             <a class="post_img" href="<?php the_permalink(); ?>">
             <?php $post_thumb =  get_the_post_thumbnail_src(get_the_post_thumbnail( $post->ID));?>
             <img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo $post_thumb;?>&amp;w=<?php echo TTIMG_MW;?>&amp;h=<?php echo TTIMG_MH;?>&amp;zc=<?php echo $img_zc; ?>&amp;q=80<?php echo $thumb_url1;?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"  />
             </a>
            <?php }else if($post_images[0]){ global $thumb_url;
             
                $thumb_url1 = $thumb_url.get_image_cutting_edge($args);
            ?>
             <a class="post_img" href="<?php the_permalink(); ?>">
             <img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo $post_images[0];?>&amp;w=<?php echo TTIMG_MW;?>&amp;h=<?php echo TTIMG_MH;?>&amp;zc=<?php echo $img_zc; ?>&amp;q=80<?php echo $thumb_url1;?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"  /> </a>
             <?php
            } else { ?> 
<a class="post_img" href="<?php the_permalink(); ?>"><img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo $default_img; ?>&amp;w=<?php echo TTIMG_MW;?>&amp;h=<?php echo TTIMG_MH;?>&amp;zc=<?php echo $img_zc; ?>&amp;q=80<?php echo $thumb_url1;?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"  /></a>            <?php }?> 
         <div class="content">
         <h3>  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>  </h3> 
         <p class="timing"> <span><?php _e('Start Date :');?></span> 
		 <?php echo get_formated_date(get_post_meta($post->ID,'st_date',true)).' '. get_formated_time(get_post_meta($post->ID,'st_time',true));?> 
         <br /> 
         <span><?php _e('End Date :');?></span> <?php echo get_formated_date(get_post_meta($post->ID,'end_date',true)) . ' ' .get_formated_time(get_post_meta($post->ID,'end_time',true));?>
         </p>
            <div class="content_right">
            <a href="<?php the_permalink(); ?>#comments" class="pcomments" ><?php comments_number('0 '.__('reviews'), '1 '.__('review'), '% '.__('reviews')); ?> </a> 
            <span class="rating"><?php echo get_post_rating_star($current_post_id);?></span>
           
            <a href="#sticky_map"  onclick="openMarker('<?php echo $post->ID; ?>')"  class="ping" id="pinpoint_<?php echo $post->ID; ?>"><?php _e('Pinpoint');?></a>
                      <?php favourite_html($post->post_author,$post->ID); ?> 
          
        </div>
        
        
        
         <p class="address"> <span><?php _e('Location')?> :</span> <?php echo get_post_meta($post->ID,'address',true);?></p>
         
         <p class="timing"> <?php echo $attribute_desc = get_post_custom_for_listing_page($post->ID,' <span class="{#HTMLVAR#}">{#TITLE#}</span> : {#VALUE#}<br /> '); ?> </p>
         
        <span class="readmore" ><a href="<?php the_permalink(); ?>" > <?php _e('read more');?>  </a> </span>
        </div> 
     </li>
        <?php	
		}
		?>
      <?php endwhile; ?>
      </ul>
      
      
      
   <?php if ($current_term->count > get_option('posts_per_page')) { ?>
      <div class="pagination">       
       <span class="i_previous" > <?php previous_posts_link(__('Previous')) ?> </span>
       <span class="i_next" ><?php next_posts_link(__('Next')) ?> </span>
       
    
      
        <?php if (function_exists('wp_pagenavi')) { ?>
        <?php wp_pagenavi(); ?>
        <?php } ?>
      </div>
      <?php } ?>
      <?php else: ?>
     <?php _e('<b>No events Available right now</b>');?>
      <?php endif; ?>
      
      
      
    </div> <!-- content #end -->
    
    
    <div id="sidebar">
	<?php dynamic_sidebar(12);  ?>
</div> <!-- sidebar right--> 
  </div><!-- wrapper --> 
<?php get_footer(); ?>