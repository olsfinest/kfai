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
 ?>

 
	<div class="row-section content-area tpl-single clearfix" id="primary">
		<div class="container">
			<div class="row column-md-flex">
				<main id="main" class="site-main col-md-8 col-sm-7" role="main">
					<div class="main-content clearfix">
				    <?php 
						if ( have_posts() ) :
							while ( have_posts() ) : the_post();
								//get_template_part( 'template-parts/post/content', 'single' );
								?>
								<div class="blog-post">
									<div class="block-content">
										<div class="block-image">
											<?php 
								    		if(has_post_thumbnail()): 
									    		$thumbid = get_post_thumbnail_id();
												$imgurl = wp_get_attachment_image_src( $thumbid , 'full');  ?>
												<a href="<?php echo get_permalink(); ?>" style="background-image: url(<?php echo $imgurl[0]; ?>);"><img src="<?php echo $imgurl[0]; ?>" alt="<?php echo get_the_title(); ?>" /></a>
												<?php
											endif; ?>
										</div>
										<div class="block-details">
											<h1><?php echo get_the_title(); ?></h1>
											<?php
											$blogtaglist = wp_get_post_terms(get_the_ID(), 'post_tag', array( 'fields' => 'all' ) );
											if($blogtaglist):
												echo '<div class="post-tags">';
												foreach($blogtaglist as $blogtag){ 
													echo "<a href='".get_permalink($blogid)."?filter=tags&tag=".$blogtag->slug."'>".$blogtag->name."</a>";
												}
												echo '</div>';
											endif; ?>
											
											<div class="post-meta">
												<span class="date"><?php echo get_the_date("F j, Y"); ?></span> - Posted in <a href="#">General Announcements</a> by <a href="#">Miriam X.</a>
											</div>

											<div class="post-content">
												<?php the_content(); ?>
											</div>

											<div class="post-share">
												<?php echo do_shortcode("[wp_social_sharing social_options='facebook,twitter,googleplus,linkedin,pinterest,xing,reddit' twitter_username='' facebook_text='' twitter_text='' googleplus_text='' linkedin_text='' pinterest_text='' xing_text='' reddit_text='' icon_order='f,t,g,l,p,x,r' show_icons='1' before_button_text='Share: ' text_position='' social_image='']"); ?>
											</div>
											
											<?php
												
												$author_id = get_the_author_meta('ID');
											
												$author_info = array(
													'name' => get_user_meta($author_id, 'first_name', true).' '.get_user_meta($author_id, 'last_name', true),
													'bio_excerpt' => get_the_author_meta('description'),
													'permalink' => get_author_posts_url($author_id),
													'picture_url' => get_avatar($author_id, '275'),
													'posts_url' => get_author_posts_url($author_id)
												);
												// Do we have a personality linked to this author/user? If so, fetch that instead.
											
												$personality_args = array(
													'numberposts' => 1,
													'post_type' => 'personality',
													'meta_query' => array(
														array(
															'key' => 'wordpress_user',
															'value' => $author_id,
															'compare' => '='
														)
													)
												);
											
												$personality_query = new WP_Query($personality_args);
											
												if($personality_query->have_posts())
												{
													$personality_query->the_post();
													
													$personality_id = get_the_ID();
													
													wp_reset_postdata();
													
													$author_info['name'] = get_post_meta($personality_id, 'name', true);
													$author_info['bio_excerpt'] = get_post_meta($personality_id, 'personality_description', true);
													$author_info['permalink'] = get_permalink($personality_id);
													$author_info['picture_url'] = wp_get_attachment_url(get_post_meta($personality_id, 'personality_image', true));
												}
											?>
											
											<div class="post-author clearfix">
												<div class="pa-image" style="background-image: url(<?php echo $author_info['picture_url']; ?>);">
													<a href="<?php echo $author_info['permalink']; ?>"><img src="<?php echo $author_info['picture_url']; ?>" alt="" /></a>
												</div>
												<div class="pa-details">
													<h3><a href="<?php echo $author_info['permalink']; ?>"><?php echo $author_info['name']; ?></a></h3>
													<p><?php echo $author_info['bio_excerpt']; ?> <a href="<?php echo $author_info['permalink']; ?>">View full bio »</a></p>
													<p class="otherpost"><a href="<?php echo $author_info['posts_url']; ?>">Other posts by <?php echo $author_info['name']; ?> »</a></p>
													<!--<div class="socials">
														<a href="#"><span class="fa fa-facebook-square"></span></a>
														<a href="#"><span class="fa fa-twitter-square"></span></a>
														<a href="#"><span class="fa fa-instagram"></span></a>
														<a href="#"><span class="fa fa-mixcloud"></span></a>
														<a href="#"><span class="fa fa-soundcloud"></span></a>
													</div>-->
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php
							endwhile;
						else : 
							get_template_part( 'template-parts/post/content', 'none' );
						endif; ?>
					</div>
				</main>

				<?php get_sidebar("blog"); ?>
			</div>
		</div>

	</div>

<?php if(!is_front_page()): ?>
	<?php get_template_part( 'template-parts/page/content', "support" ); ?>
<?php endif; ?>

<?php get_footer();
