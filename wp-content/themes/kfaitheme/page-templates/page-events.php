<?php
/**
 * Template Name: Events Template
 *
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage XIA_LLC
 * @since 1.0
 * @version 1.0
 */

get_header();
$eventid=1028; ?>
 
<div class="row-section content-area clearfix wow fadeIn" id="primary">
	<div class="container">
		<div class="row">
			<main id="main" class="site-main col-lg-12" role="main">
				<div class="main-content clearfix">
					
					<a href="events/community/list" style="background-color: #F84E5D;  color: white;   padding: 10px; font-weight: bold;    text-transform: uppercase;  margin: 0 auto 20px auto;   width: 150px;  display: block; text-align: center;">My Events</a>
					
			    <?php
					if ( have_posts() ) :
						while ( have_posts() ) : the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class("module text-content wow fadeIn"); ?>>
								<?php
									if(!is_singular("tribe_events")){ ?>
								<header class="page-header">
									<h1 class="page-title text-<?php echo get_field("alignment", $eventid); ?>">
										<?php echo get_custom_title($eventid); ?>
									</h1>
								</header>
								<?php } ?>
								
									<?php
									if(!is_singular("tribe_events")){ ?><div class="recent-upcoming-events column-narrow-spaces clearfix">
									<div class="row"><?php
									wp_reset_query();

									global $post;
									$get_posts = tribe_get_events(array('posts_per_page'=>2, 'eventDisplay'=>'upcoming') );
									foreach($get_posts as $post) { setup_postdata($post); ?>
										<div class="col-sm-6">
												
												<?php 
									    		if(has_post_thumbnail()): 
										    		$thumbid = get_post_thumbnail_id();
													$imgurl = wp_get_attachment_image_src( $thumbid , 'theme-thumbnail-668');  ?>
													<div class="ue-image" style="background-image: url(<?php echo $imgurl[0]; ?>);">
														<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('theme-thumbnail-668'); ?></a>
													</div>
													<?php
												else: ?>
													<div class="ue-image" style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/default_thumb.jpg);">
														<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('theme-thumbnail-md'); ?></a>
													</div>
												<?php
												endif; ?>
												<div class="ue-details clearfix eq-height">
													<div class="detailsleft">
														<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
														<p>
															<?php if (tribe_get_start_date($post, false, "F j, Y") == tribe_get_end_date($post, false, "F j, Y") ) { ?>
																	<?php echo tribe_get_start_date($post, false, "F j, Y"); ?>
															<?php }else{ ?>
																	<?php if (tribe_get_start_date($post, false, "F") == tribe_get_end_date($post, false, "F") ) { ?>
																			<?php echo tribe_get_start_date($post, false, "F j"); ?>-<?php echo tribe_get_end_date($post, false, "j, Y"); ?>,
																	<?php }else{ ?>
																			<?php echo tribe_get_start_date($post, false, "F j"); ?>-<?php echo tribe_get_end_date($post, false, "F j, Y"); ?>,
																	<?php } ?>
															<?php } ?>
														</p>
														<?php 
															$venue = tribe_get_venue($post); ?>
														<p><?php echo $venue; ?></p>	
													</div>	
													<div class="detailsright">
														<a href="<?php the_permalink(); ?>" class="moreinfo">MORE INFO</a><br />
														<a href="<?php the_permalink(); ?>" class="gettickets">GET TICKETS</a>
													</div>
												</div>

										</div>
										<?php wp_reset_query(); ?>		
										<?php }
										?></div>
								</div><?php } ?>
									

								<div class="page-content">
									<?php
										the_content();

										wp_link_pages( array(
											'before' => '<div class="page-links">' . __( 'Pages:', 'xiatheme' ),
											'after'  => '</div>',
										) );
									?>
								</div>
							</article>

							<?php
							do_action('XIA_row_layout');
						endwhile;
					else : 
						get_template_part( 'template-parts/post/content', 'none' );
					endif; ?>
				</div>
			</main>
		</div>
	</div>
</div>

<?php get_footer();
