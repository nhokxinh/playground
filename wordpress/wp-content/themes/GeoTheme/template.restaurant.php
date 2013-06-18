<?php 
/*
 * Template Name: Restaurants
 */
get_header(); ?>

            <div id="white-background">
                <!-- content -->
                <div id="content" class="container clearfix">

                    <div class="container">
                        <div class="page-title-heading">
                            <h2><?php the_title(); ?><?php if ( !get_post_meta($post->ID, 'snbpd_pagedesc', true)== '') { ?> / <?php }?> <span><?php echo get_post_meta($post->ID, 'snbpd_pagedesc', true); ?></span></h2>
                        </div>
                    </div>
                    <div class="title-border"></div>

                    <div class="container clearfix">
                        <ul id="restaurant-items"  class="three-fourth" style="margin-bottom: 0;">
                            <?php
                            global $post;
                            $term = get_query_var('term');
                            $tax = get_query_var('taxonomy');
                            $args=array('post_type'=> 'restaurant','post_status'=> 'publish', 'orderby'=> 'post_date', 'caller_get_posts'=>1, 'paged'=>$paged, 'posts_per_page'=>of_get_option('sc_eventitemsperpage'));
                            $taxargs = array($tax=>$term);
                            if($term!='' && $tax!='') { $args  = array_merge($args, $taxargs); }

                            query_posts($args);

                            while ( have_posts()):the_post();
                                $categories = wp_get_object_terms( get_the_ID(), 'event_types');
                                ?>

                                <!-- PROJECT ITEM STARTS -->
                                    <li class="three-fourth-block <?php foreach ($categories as $category) { echo $category->slug. ' '; } ?>" data-id="id-<?php the_ID(); ?>" data-type="<?php foreach ($categories as $category) { echo $category->slug. ' '; } ?>">
                                        <div style="display:inline">
                                            <?php the_post_thumbnail(); ?>
                                        </div>

										<div style="display:inline-table;vertical-align:top;margin-top:0.5em;margin-left:0.5em">
                                            <h4 style="line-height:0.5em">
                                                <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" title="<?php the_title(); ?>"> <?php the_title(); ?> </a>
                                            </h4>
											<h5 style="line-height:0.5em"><?php echo get_post_meta( $post->ID, 'pg_restaurant_address', true ); ?></h5>
											<h5 style="line-height:0.5em"><?php echo get_post_meta( $post->ID, 'pg_restaurant_phone', true ); ?></h5>
											<ul>
												<?php
													$features = explode("\n",get_post_meta( $post->ID, 'pg_restaurant_features', true ));
													foreach($features as $f){
														echo '<li>- ' . $f . '</li>';
													}
												?>
											</ul>
											<ul>
												<?php
													$events = get_posts(array('post_type'=>array('event'),'meta_key'=>'snbp_event_venue','meta_value'=>$post->ID));
													foreach ($events as $event){
														echo '<li><a href="', $event->guid , '">', $event->post_title, '</a></li>';
													}
												?>
											</ul>
										</div>
                                    </li>
                                <!-- PROJECT ITEM ENDS -->
                                <?php endwhile;  ?>

                            <div class="three-fourth">
                                <div class="space"></div>
                                <div class="title-border" style="float: left;"></div>
                                <!-- begin #pagination -->
                                <?php if (function_exists("wpthemess_paginate")) { wpthemess_paginate(); } ?>
                                <!-- end #pagination -->
                            </div>

                        </ul>

                        <?php
                        wp_reset_query();
                        wp_reset_postdata();
                        ?>

                        <!-- Begin Sidebar -->
                        <div class="one-fourth-block last" style="margin-top: 20px;">
                            <?php get_template_part( 'blog', 'sidebar' ); ?>
                        </div>
                        <!-- End Sidebar -->

                    </div><!-- end .container -->
                </div><!-- end content -->

            </div><!-- end #white-background -->

<?php get_footer(); ?>