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
 * @subpackage XIA_LLC
 * @since 1.0
 * @version 1.0
 */
 
get_header(); ?>


	<div class="row-section content-area tpl-event-calendar clearfix" id="primary">
		<div class="container">
				<main id="main" class="site-main " role="main">
					<div class="main-content clearfix">
						<div class="more-posts">
							
						<?php
							if ( have_posts() ) : ?> 	
								<div class="item-posts item-posts-archive row">
								<?php
								while ( have_posts() ) : the_post();

									get_template_part( 'template-parts/post/content', get_post_format() );

								endwhile;
								?>
								
								<nav class="post-pagination post-pagination-archive text-center clearfix">
									<ul class="nav-links nav-links-archive">
										<li class="previous previous-archive"><?php previous_posts_link('Recent Post &raquo;'); ?></li>
										<li class="next next-archive"><?php next_posts_link('&laquo; Older Post'); ?></li>
									</ul>
								</nav>
								</div> 
								<?php

							endif;
							?>
						</div>
					</div>
				</main>
		</div>
	</div>

<?php get_footer();
