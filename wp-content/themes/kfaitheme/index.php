<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage KFAI
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

 
	<div class="row-section content-area clearfix" id="primary">
		<div class="container">
			<div class="row column-md-flex">
				<main id="main" class="site-main col-md-8 col-sm-7" role="main">
					<div class="main-content clearfix">

					<?php
					$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
					
					//if(!is_archive() && $paged == 1):

						wp_reset_query();
					
						$args = array_merge( $wp_query->query_vars , array( 'numberposts' => 1, 'posts_per_page' => 1 ) );	
							
							$cusquery = new WP_Query( $args );
							if ( $cusquery->have_posts() ) {
								while ( $cusquery->have_posts() ) : $cusquery->the_post();
									$recentid = get_the_ID();
									?>
										<div id="hero" class="entry-hero clearfix">
											<h2> <a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a> </h2>

											<div class="hero-image">
												<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail("dt-thumbnail-lg"); ?></a>
											</div>
											
											<div class="hero-detail">  
												<?php
												the_content( sprintf(
																__( ' ', 'kfaitheme' ),
																get_the_title()
															) );
												?>
											</div>

											<div class="hero-footer clearfix">
												<a class="more" href="<?php echo get_permalink(); ?>">Read More ›</a>
												<div class="entry-share">
													<?php echo do_shortcode("[addtoany]"); ?>
												</div>
											</div>
										</div>
									<?php
									wp_reset_query();
								endwhile;
							}
						?>
						
					<?php 
					
					$args2 = array_merge( $wp_query->query_vars , array( 'post__not_in' => array($recentid) ) );
					query_posts( $args2 ); 
					
					//endif;			
					?>
						<br /><hr /><br />

						<div class="more-posts">
							
						<?php
							if ( have_posts() ) : ?>
								<h2 class="text-center">More Recent Posts</h2>
								<div class="item-posts item-posts-blog row">
								<?php /* Start the Loop */
								while ( have_posts() ) : the_post();

									/*
									 * Include the Post-Format-specific template for the content.
									 * If you want to override this in a child theme, then include a file
									 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
									 */
									get_template_part( 'template-parts/post/content', get_post_format() );

								endwhile;
								?>
								
								<nav class="post-pagination post-pagination-blog text-center clearfix">
									<ul class="nav-links nav-links-blog">
										<li class="previous previous-blog"><?php previous_posts_link('Recent Post &raquo;'); ?></li>
										<li class="next next-blog"><?php next_posts_link('&laquo; Older Post'); ?></li>
									</ul>
								</nav>
								</div> 
								<?php

							endif;
							?>
						</div>
					</div>
				</main><!-- #main -->
				<?php get_sidebar("blog"); ?>
			</div>
		</div>
	</div><!-- #primary -->

<?php get_footer();
