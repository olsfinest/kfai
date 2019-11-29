<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage KFAI
 * @since 1.0
 * @version 1.0
 */

get_header();
$prg_id = get_the_ID(); ?>
<div class="row-section page-breadcrumbs clearfix">
	<div class="container">
		<ul>
			<li><a href="<?php echo home_url(); ?>">Home</a></li>
			<li>»</li>
			<li><a href="<?php echo home_url() . '/programs/'; ?>">Programs</a></li>
			<li>»</li>
			<li><?php echo get_the_title(); ?></li>
		</ul>
	</div>
</div>

<div class="row-section content-area tpl-single-program clearfix" id="primary">
		<div class="container">
			<div class="row column-md-flex">
				<main id="main" class="site-main col-md-8 col-sm-7" role="main">
					<div class="main-content row clearfix">
				    	<div class="col-program-image col-lg-5 col-md-6 eq-height">

				    		<?php 
				    		if(has_post_thumbnail(get_the_ID())): 
					    		$thumbid = get_post_thumbnail_id(get_the_ID());
								$imgurl = wp_get_attachment_image_src( $thumbid , 'theme-thumbnail-330');  ?>
								<a href="<?php echo get_field("program_image_link"); ?>" style="background-image: url(<?php echo $imgurl[0]; ?>);"><img src="<?php echo $imgurl[0]; ?>" alt="<?php echo get_the_ID(); ?>" /></a>
								<?php
							else: ?>
								<a href="<?php echo get_field("program_image_link"); ?>" style="background-image: url(<?php echo get_field('default_image_program' , 'option')"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/default_thumb.jpg" alt="<?php echo get_the_ID(); ?>" /></a>
							<?php
							endif; ?>
				    	</div>

				    	<div class="col-program-details col-lg-7 col-md-6 eq-height">
				    		<h1><?php echo get_field("program_name") ? get_field("program_name") : get_the_title(); ?></h1>

							<p class="sched">
								<?php
									for($dayi=0;$dayi<7;$dayi++)
									{
										if(get_field('schedule_'.$dayi.'_enabled', $program_id) == '1')
										{
											?>
												<?php echo kfai_print_air_datetime($dayi, get_field('schedule_'.$dayi.'_starttime',  $program_id), get_field('schedule_'.$dayi.'_endtime',  $program_id)); ?><br />
											<?php 
										}
									}
								?>
							</p>

				    		<p class="djs"><strong>DJs:</strong>
							<?php
							$djs_obj = get_field('djs', get_the_ID());
							if( $djs_obj ):
								$cnt = 1; 
								foreach( $djs_obj as $dj){
									setup_postdata($dj);
									if($cnt > 1){
										echo ", ";
									}
									?><a href="<?php echo get_permalink($dj->ID); ?>"><?php echo get_field("name", $dj->ID) ? get_field("name", $dj->ID) : get_the_title($dj->ID); ?></a><?php
									$cnt = $cnt + 1;
								}
								wp_reset_postdata();
							else:
								echo "\"Anonimous\"";
							endif; ?>
							</p>

				    		<?php 
							$term_list = wp_get_post_terms(get_the_ID(), 'program_cat', array( 'fields' => 'all' ) );
							$cnt = 1;
							if($term_list): ?>
							<p class="categories"><span class="fa fa-tags"></span>
							<?php
							foreach($term_list as $progcat){
								if($cnt > 1){
									echo ", ";
								}
								echo "<a href='/program-category/".$progcat->slug."'>".$progcat->name."</a>";
								$cnt = $cnt + 1;
							} ?>
							</p>
							<?php endif; ?>

				    		<p class="latestep"><?php kfai_print_most_recent_episode_listen_button(get_the_ID()); ?></p>
				    		<div class="socials">
								<?php if(get_field("social_media")): ?>
				    			<?php
									if( have_rows('social_urls') ):
									while ( have_rows('social_urls') ) : the_row();
									$social_name = get_sub_field('social_name');
								 	$social_link = get_sub_field('social_link');
									?> 
									<a href="<?php echo $social_link; ?>" target="_blank"><span class="fa <?php echo $social_name; ?>"></span></a>
									<?php
									endwhile;
									endif;
									?>
								
								<?php else: ?>
									<?php
									if( have_rows('social_icons', 'option') ):
									while ( have_rows('social_icons', 'option') ) : the_row();
									$name = get_sub_field('name', 'option');
									$icon = get_sub_field('icon', 'option');
								 	$page_link = get_sub_field('page_link', 'option');
									?> 
									<a href="<?php echo $page_link; ?>" target="_blank" title="<?php echo $name; ?>"><span class="fa <?php echo $icon; ?>"></span></a>
									<?php
									endwhile;
									endif;
									?>
								<?php endif; ?>
				    		</div>
				    	</div>
				    	<div class="col-program-desc col-lg-12 clearfix">
				    		<div>
				    			<?php echo get_field("program_description"); ?>
				    		</div>
				    	</div>
					</div>

					
							<?php
							wp_reset_postdata();
							$the_queryep = new WP_Query( array(
							'post_type' => 'episode',
								'post_status' => 'publish',
								'posts_per_page' => 2 ,  
								'meta_key'   => 'ep_date',
								'orderby'    => 'meta_value_num',
								'order'      => 'DESC',
								'meta_query' => array( 
							       array(
									'key' => 'episode_program',
									'value' => $prg_id,
									'compare' => 'IN'
									)
						        ),
							) ); 
							//echo $the_queryep->ID;
							if ( $the_queryep->have_posts() ) { ?>
							<div class="recent-playlist column-narrow-spaces clearfix">
								<h2>RECENT PLAYLISTS</h2>
								<div class="row">
							<?php
							while ( $the_queryep->have_posts() ) { $the_queryep->the_post(); ?>
								<div class="col-lg-6 eq-height">
									<div class="rp-image">
										<?php 
							    		if(has_post_thumbnail($prg_id)): 
								    		$thumbid = get_post_thumbnail_id($prg_id);
											$imgurl = wp_get_attachment_image_src( $thumbid , 'theme-thumbnail-215');  ?>
											<a href="<?php echo get_permalink(); ?>">
												<img src="<?php echo $imgurl[0]; ?>" alt="" /></a>
											<?php
										else: ?>
											<a href="<?php echo get_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/program-image.jpg" alt="" /></a>
										<?php
										endif; ?>
										
									</div>
									<div class="rp-details">
										<p class="rp-details-top">
											<strong><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></strong><br />
											<?php
											$epdate_ts = get_field('ep_date', false, false);
											$epdate = new DateTime();
											$epdate->setTimestamp($epdate);
											$epdatet = $epdate->format('F j, Y'); ?>
											<!--<span class="date"><?php echo $epdatet; ?></span><br />-->
											<span>DJs: <?php
											$djs_obj = get_field('djs', $prg_id);
											if( $djs_obj ):
												$cnt = 1; 
												foreach( $djs_obj as $dj){
													setup_postdata($dj);
													if($cnt > 1){
														echo ", ";
													}
													?><?php echo get_field("name", $dj->ID) ? get_field("name", $dj->ID) : get_the_title($dj->ID); ?><?php
													$cnt = $cnt + 1;
												}
											else:
												echo "\"Anonimous\"";
											endif; ?></span>
										</p>
										<?php kfai_print_episode_listen_button(get_the_ID()); ?>
										<a href="<?php echo get_permalink(); ?>" class="btn btn-dark-bordered"><span class="fa fa-info-circle"></span>DETAILS</a>
									</div>
								</div>
								<?php
							}
							wp_reset_postdata(); ?>
							</div>
							</div>
							<?php
							}
							?>
						
				</main>
				<aside class="secondary widget-area widget-area-program col-md-4 col-sm-5 col-sm-pad-0" role="complementary">
					<div class="widget-area-content">
						<section class="widget Annual_Archive_Widget">
							<h3 class="widget-title">Program Archives</h3>	
							<?php
							wp_reset_postdata();
							$the_query = new WP_Query( array(
							'post_type' => 'episode',
							'post_status' => 'publish',
							'posts_per_page' => -1 ,
							'meta_key'   => 'ep_date',
							'orderby'    => 'meta_value_num',
							'order'      => 'DESC',
							'meta_query' => array( 
								       array(
										'key' => 'episode_program',
										'value' => $prg_id,
										'compare' => 'IN'
										)
							        ),
							) ); 
							if ( $the_query->have_posts() ) {



								$month_check = '';
								echo '<ul class="archive-programs">';
							while ( $the_query->have_posts() ) { $the_query->the_post();
								$program_titlel = get_field('episode_program');
								$program_IDl = '';
								if( $program_titlel ): 
									$p_titlel = $program_titlel;
									$program_IDl = $p_titlel->ID;
								endif;

								$mon_ts = get_field('ep_date', false, false);
								$mon = new DateTime();
								$mon->setTimestamp($mon_ts);
								$mon = $mon->format('F'); 

								if ($mon !== $month_check) {
									$mond_ts = get_field('ep_date', false, false);
									$mond = new DateTime();
									$mond->setTimestamp($mond_ts);
									/*$firstday = date($mond->format('Y') . '' . $mond->format('m') . '' . '01');
									$lastday = date($mond->format('Y') .'' . $mond->format('m') . '' . date('t', strtotime($firstday)));*/
									$firstday = date($mond->format('m') . '/' . '01' . '/' . $mond->format('Y'));
									$lastday = date($mond->format('m') .'/' . date('t', strtotime($firstday)) . '/' . $mond->format('Y'));
									
									if($mond->format('Y') >= 2000)
									{
										echo "<li> <a href='". home_url() ."/playlists/?programid=".$prg_id."&yr=". $mond->format('Y') ."&mon=". $mond->format('m') ."'>" .$mond->format('F Y');
										$the_query_count = new WP_Query( array(
										'post_type' => 'episode',
										'post_status' => 'publish',
										'posts_per_page' => -1 ,
										'orderby'    => 'meta_value_num',
										'order'      => 'DESC',
										'date_query' => array(
											'after' => kfai_get_start_date($mond->format('Y'), $mond->format('m')),
											'before' => kfai_get_end_date($mond->format('Y'), $mond->format('m')),
											'inclusive' => true
										),
										'meta_query' => array( 
											  array(
												'key' => 'episode_program',
												'value' => $prg_id,
												'compare' => '='
											)
										),
										) ); 
										echo " (" . $the_query_count->post_count . ") </a></li>";
									}
								}
							?>
							
							<?php
							$month_check = $mon;
							}
							echo '</ul>';
							wp_reset_postdata();
							}
							?>
							<!--</form>-->
						</section>
						<?php dynamic_sidebar( 'sidebar-prog' ); ?>
					</div>
				</aside>
			</div>
		</div>
	</div>

<?php if(!is_front_page()): ?>
<?php get_template_part( 'template-parts/page/content', "support" ); ?>
<?php endif; ?>

<aside class="secondary widget-area widget-area-program" role="complementary">
	<div class="widget-area-content">
		<?php dynamic_sidebar( 'sidebar-prog' ); ?>
	</div>
</aside>

<?php get_footer();
