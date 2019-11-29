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

get_header(); ?>
<div class="row-section page-breadcrumbs clearfix">
	<div class="container">
		<ul>
			<li><a href="<?php echo home_url(); ?>">Home</a></li>
			<li>»</li>
			<li><a href="<?php echo home_url() . '/personalities/'; ?>">Personalities</a></li>
			<li>»</li>
			<li><?php echo get_the_title(); ?></li>
		</ul>
	</div>
</div>

<div class="row-section content-area tpl-single-personality clearfix" id="primary">
		<div class="container">
			<div class="row column-md-flex">
				<main id="main" class="site-main col-md-8 col-sm-7" role="main">
					<div class="main-content row clearfix">
				    	<div class="col-personality-image col-lg-5 col-md-6 eq-height">
				    		<?php 
				    		if(has_post_thumbnail(get_the_ID())): 
					    		$thumbid = get_post_thumbnail_id(get_the_ID());
								$imgurl = wp_get_attachment_image_src( $thumbid , 'theme-thumbnail-330');  ?>
								<a href="<?php echo get_field("program_image_link"); ?>" style="background-image: url(<?php echo $imgurl[0]; ?>);"><img src="<?php echo $imgurl[0]; ?>" alt="<?php echo get_the_ID(); ?>" /></a>
								<?php
							else: ?>
								<a href="<?php echo get_field("program_image_link"); ?>" style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/default_thumb.jpg);"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/default_thumb.jpg" alt="<?php echo get_the_ID(); ?>" /></a>
							<?php
							endif; ?>
				    	</div>

				    	<div class="col-personality-details col-lg-7 col-md-6 eq-height">
				    		<h1><?php echo get_field("name") ? get_field("name") : get_the_title(); ?></h1>

							<?php
							$progs_obj = get_field('hosted_of', get_the_ID());
							if( $progs_obj ):
								echo '<p class="progs"><strong>Host of:</strong></p>';
								echo "<ul>";
								foreach( $progs_obj as $prog){
									setup_postdata($prog);
									?><li><a href="<?php echo get_permalink($prog->ID); ?>"><?php echo get_field("program_name", $prog->ID) ? get_field("program_name", $prog->ID) : get_the_title($prog->ID); ?></a></li><?php
								}
								echo "</ul>";
								wp_reset_postdata();
							endif; ?>
							
							<?php if(get_field("websites") || get_field("contact_number") || get_field("email")): ?>
								<p class="contacts"><strong>Contact:</strong></p>
								<ul>
									<?php
									if( have_rows('contact') ):
										$cnt = 1;
										while ( have_rows('contact') ) : the_row();
											$link_text = get_sub_field('link_text');
											$link_url = get_sub_field('link_url'); ?> 
											<li><a href="<?php echo $link_url; ?>"><?php echo $link_text; ?></a></li>
											<?php
											$cnt = $cnt + 1;
										endwhile;
									endif; ?>
									<?php if(get_field("contact_number")): ?>
										<li><a href="tel:<?php echo get_field("contact_number"); ?>"><?php echo get_field("contact_number"); ?></a></li>
									<?php endif; ?>
									<?php if(get_field("email")): ?>
										<li><a href="mailto:<?php echo get_field("email"); ?>"><?php echo get_field("email"); ?></a></li>
									<?php endif; ?>
								</ul>
				    		<?php endif; ?>

				    		<div class="socials">
								<?php if(get_field("social_pages")): ?>
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
				    	<?php if(get_field("personality_description")): ?>
					    	<div class="col-personality-desc col-lg-12 clearfix">
					    		<div>
					    			<?php echo get_field("personality_description"); ?>
					    		</div>
					    	</div>
				    	<?php endif; ?>
					</div>
					<?php
						$uid =  get_post_meta(get_the_ID(), 'wordpress_user', true);
					
						$args = array(
							'numberposts' => 8,
							'post_type' => 'post',
							'author__in' => array($uid)
						);

						$q = new WP_Query($args);

						if($q->have_posts())
						{
							?>
								<div class="blogs-authored column-narrow-spaces clearfix">
									<h2>BLOGS AUTHORED</h2>
									<div class="row">
										<?php
											while($q->have_posts())
											{
												$q->the_post();
												
												$datepretty = new DateTime(get_the_date());
												
												?>
													<div class="col-lg-3 col-xs-6 col-xxs-12 eq-height">
														<div class="ba-image" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');">
															
														</div>
														<div class="ba-details">
															<p class="ba-details-top">
																<a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
																<br /><span class="date"><?php echo $datepretty->format('m/d/Y'); ?></span> - <?php echo get_the_excerpt(); ?>
															</p>
														</div>
													</div>
												<?php
											}
							
											wp_reset_postdata();
										?>
									</div>
									<div class="ba-footer text-center">
										<a href="<?php echo get_author_posts_url($uid); ?>">MORE POSTS ›</a>
									</div>
								</div>
							<?php
						}
					?>
					

				</main>
				<aside class="secondary widget-area widget-area-person col-md-4 col-sm-5 col-sm-pad-0" role="complementary">
					<div class="widget-area-content">
						<?php dynamic_sidebar( 'sidebar-person' ); ?>
					</div>
				</aside>
			</div>
		</div>
	</div>

<?php if(!is_front_page()): ?>
<?php get_template_part( 'template-parts/page/content', "support" ); ?>
<?php endif; ?>

<aside class="secondary widget-area widget-area-person" role="complementary">
	<div class="widget-area-content">
		<?php dynamic_sidebar( 'sidebar-person' ); ?>
	</div>
</aside>

<?php get_footer();
