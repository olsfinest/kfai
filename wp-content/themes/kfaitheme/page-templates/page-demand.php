<?php
/**
 * Template Name: Ondemand Template
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
 * @subpackage KFAI
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
 
	<div class="row-section content-area tpl-has-sidebar clearfix" id="primary">
		<div class="container">
			<div class="row column-md-flex">
				<main id="main" class="site-main col-md-8 col-sm-7" role="main">
					<div class="main-content clearfix">
				    <?php 
						if ( have_posts() ) :
							while ( have_posts() ) : the_post();

								get_template_part( 'template-parts/page/content', 'page' );

								do_action('Theme_module_content');
							endwhile;
						else : 
							get_template_part( 'template-parts/post/content', 'none' );
						endif; ?>
						<hr />
						<?php
							wp_reset_postdata(); ?>

							<?php
							// Get the paged variable and use it in the custom query.
							// (see: http://codex.wordpress.org/Pagination ).
							$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
							 
							// query arguments.
							$argst = array(
							 
							    // set the date pagination to 'monthly'
							    'date_pagination_type' => 'daily', // 'yearly', 'monthly', 'daily'
							    'paged' => $paged,
								
							 	
							    // Add your own WP_Query arguments here
							    'post_type'            => array( 'episode' ),
							    'ignore_sticky_posts'  => true,
							    'post_status' => 'publish',
								'meta_query' => array(
									'relation' => 'AND',
									'meta_epdate' => array(
										'key' => 'ep_date',
										'type' => 'CHAR',
										'value' => '-',
										'compare' => 'NOT LIKE'
									),
									'meta_eptime' => array(
										'key' => 'ep_time',
										'type' => 'CHAR',
										'compare' => 'EXISTS'
									)
								),
								'orderby' => array(
									'post_date' => 'DESC',
									'meta_eptime' => 'DESC'
								)
							);
							 
							// The custom query.
							$the_queryt = new WP_Query( $argst );
							
							$args = array(
								'date_format' => 'j',
								'date_query'  => $the_queryt,
								// Use other pagination arguments here
							);
														 
							// Variable $the_query is the query object.
							// Don't forget to add the query object to the label functions when using a custom query;
							?>
							 
							<?php if ( $the_queryt->have_posts() ) : ?>
							 
							    <h3 class="title-day text-center">
							        <?php
								
							        // Echo current date with format 'F Y' ( e.g. November 2010 ).
						 			echo km_dp_get_current_date_label('F j, Y', $the_queryt);
									
							        ?>
							    </h3>
								<div class="paginationbyday clearfix">
								    <?php
								    // Date Pagination.
								 
								    // Default labels.
								    $next_label = 'Previous Page';
								    $prev_label = 'Next Page';  
								 
								    // Check if functions exists (plugin is activated).
								    if ( function_exists( 'km_dp_get_next_date_label' ) ) {
								        $next_label = km_dp_get_next_date_label( 'F j, Y g:i a', $the_queryt );
								    }   
								 
								    if ( function_exists( 'km_dp_get_previous_date_label' ) ) {
								        $prev_label = km_dp_get_previous_date_label( 'F j, Y g:i a', $the_queryt );
								    }
								    ?>
								    <!-- WordPress core pagination functions (see the Codex) -->
								    <?php
								    // Set max_num_pages for next_posts_link() when using a custom query (see the Codex).
								    // Get the max_num_pages from the custom query object ($the_query)
								    ?>
								    <ul>
								 		<li class="prev" title="<?php echo $next_label; ?>"><?php next_posts_link( '« Prev', $the_queryt->max_num_pages ); ?></li>
								 		<li class="next" title="<?php echo $prev_label; ?>"><?php previous_posts_link( 'Next »'); ?></li>
								 	</ul>
							 	</div>
							    <!-- The custom query Loop -->
							    <?php while ( $the_queryt->have_posts() ) : $the_queryt->the_post(); ?>
							 		<div class="archive-item clearfix">
									<h3><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title();  ?></a></h3>
									<?php
										$thisepid = get_the_ID();
										$demand = get_permalink();
									$id = get_the_ID();	
									 $urlname = get_field('audio_file_url'); ?>
									
									<?php
										 $epdate =  get_field('ep_date' , false , true);
										
										if(is_numeric($epdate))
										{
											$date = new DateTime();
											$date->setTimestamp($epdate);
										}
										else
										{
											$date = new DateTime($epdate);
										}
										 
										 
										 $epdate1 = $date->format('F j, Y'); 
										 
										 $time =	get_field('ep_time' , false , true);
										
										$epdatetime = new DateTime($date->format('F j, Y ').$time);
									?>
									
									
							<?php 
							$title = get_the_title(); 
							 $title2 = substr($title, 11);
							 $title3 = str_replace(' ', '', $title2);
							
							
							$args = array(
							 'post_type'        => 'program',
							'showposts' => 1000 
							);
							$query = new WP_Query( $args ); 
							if ( $query->have_posts() ) {
							while ( $query->have_posts() ) {
							$query->the_post(); 
							
							if($title2 == get_the_title()) {
									
								$getaudio = get_field('audio_file_directory_url');
								
								//$demand = get_permalink();
									
							}
							
							

							} // end while
								
							wp_reset_query();
							} // end if
							

							$getaudio;
							
							?>

										<span><?php  echo $epdatetime->format('F j, Y \a\t g:i a'); ?></span>
										<div class="ep-btns">
										
									
											<a href="<?php echo $demand; ?>" class="btn btn-dark-bordered"><span class="fa fa-info-circle"></span>DETAILS</a>
											
											
											<?php kfai_print_episode_listen_button($thisepid); ?>
										</div>
									</div>
							    <?php endwhile;  wp_reset_query(); 
								?>
							 
							    <div class="paginationbyday clearfix">
								    <?php
								    // Date Pagination.
								 
								    // Default labels.
								    $next_label = 'Previous Page';
								    $prev_label = 'Next Page';  
								 
								    // Check if functions exists (plugin is activated).
								    if ( function_exists( 'km_dp_get_next_date_label' ) ) {
								        $next_label = km_dp_get_next_date_label( 'F j, Y g:i a', $the_queryt );
								    }   
								 
								    if ( function_exists( 'km_dp_get_previous_date_label' ) ) {
								        $prev_label = km_dp_get_previous_date_label( 'F j, Y g:i a', $the_queryt );
								    }
								    ?>
								    <!-- WordPress core pagination functions (see the Codex) -->
								    <?php
								    // Set max_num_pages for next_posts_link() when using a custom query (see the Codex).
								    // Get the max_num_pages from the custom query object ($the_query)
								    ?>
								    <ul>
								 		<li class="prev" title="<?php echo $next_label; ?>"><?php next_posts_link( '« Prev', $the_queryt->max_num_pages ); ?></li>
								 		<li class="next" title="<?php echo $prev_label; ?>"><?php previous_posts_link( 'Next »'); ?></li>
								 	</ul>
							 	</div>
							 
							    <?php wp_reset_postdata(); ?>
							<?php else:  ?>
							    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
							<?php endif; ?>
					</div>
				</main>

				<?php get_sidebar(); ?>
				
				
				
				
			</div>
		</div>
	</div><!-- #primary -->

<?php if(!is_front_page()): ?>
	<?php get_template_part( 'template-parts/page/content', "support" ); ?>
<?php endif; ?>



<?php get_footer(); ?>