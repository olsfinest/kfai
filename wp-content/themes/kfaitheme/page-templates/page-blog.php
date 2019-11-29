<?php
/**
 * Template Name: Blog Template
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
 * @subpackage KFAI
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="row-section search-filters blog-search-filters clearfix">
	<div class="container">
		<div class="container-sm clearfix">
			<div class="row">
			
				<div class="col-filter filter-search col-lg-4 col-xs-6">
					<form role="search" method="get" class="search-form" action="<?php echo get_permalink(); ?>">
						<input type="search" class="search-field" value="<?php echo isset( $_REQUEST[ 'search' ] ) ? $_REQUEST[ 'search' ] : ''; ?>" name="search" placeholder="Search" />
						<button type="submit" class="search-submit"><span class="fa fa-search"></span></button>  
					</form>
				</div>
				<div class="col-filter filter-cat col-lg-4 col-xs-6">
					<form role="search" method="get" class="search-form" name="formcat" action="<?php echo get_permalink(); ?>" >
						<input type="hidden" name="filter" value="category" />
						<select name="cat" id="filterbycat" class="selectpicker" onChange="document.forms['formcat'].submit();">
							<option value="">Filter by Category</option>
							<?php
							$blogcatlist = get_terms(array(
												    'taxonomy' => 'category',
												    'hide_empty' => false,
												));
							foreach($blogcatlist as $blogcat){ ?>
								<option value="<?php echo $blogcat->slug; ?>" <?php echo isset( $_REQUEST[ 'cat' ] ) && $_REQUEST[ 'cat' ] == $blogcat->slug ? "selected" : ''; ?>><?php echo $blogcat->name; ?></option>
								<?php
							} ?>
						</select>
					</form>
				</div>
				<div class="col-filter filter-tag col-lg-4 col-xs-6">
					<form role="search" method="get" class="search-form" name="formtag" action="<?php echo get_permalink(); ?>" >
						<input type="hidden" name="filter" value="tags" />
						<select name="tag" id="filterbytag" class="selectpicker" onChange="document.forms['formtag'].submit();">
							<option value="">Filter by Tag</option>
							<?php
							$blogtaglist = get_terms(array(
												    'taxonomy' => 'post_tag',
												    'hide_empty' => false,
												));
							foreach($blogtaglist as $blogtag){ ?>
								<option value="<?php echo $blogtag->slug; ?>" <?php echo isset( $_REQUEST[ 'tag' ] ) && $_REQUEST[ 'tag' ] == $blogtag->slug ? "selected" : ''; ?>><?php echo $blogtag->name; ?></option>
								<?php
							} ?>
						</select>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row-section blog-gateway-blocks clearfix">
	<div class="container">
		<?php if ( isset( $_REQUEST[ 'cat' ] ) ) { ?>
			<h2 class="page-sub-heading"><small>Category:</small> "<?php echo $_REQUEST[ 'cat' ]; ?>"</h2><br />
		<?php } ?>
		<?php if ( isset( $_REQUEST[ 'tag' ] ) ) { ?>
			<h2 class="page-sub-heading"><small>Tag:</small> "<?php echo $_REQUEST[ 'tag' ]; ?>"</h2><br />
		<?php } ?>
		<?php
		if ( isset( $_REQUEST[ 'search' ] ) ) {
		    query_posts( array(
				's' => $_REQUEST[ 'search' ],
		         'post_type' => 'post',
		         'post_status' => 'publish',
		         'order' => 'DESC',
				 'orderby' => 'date',
				'posts_per_page' => -1,
		         )
		      );
		    if ( have_posts() ) : ?>
		    	<h2 class="page-sub-heading"><?php _e( 'Search Results Found For', 'kfaitheme' ); ?>: "<?php the_search_query(); ?>"</h2>
		    	<?php
		    	echo '<div class="row">';
		    	while ( have_posts() ) : the_post(); ?>
					<div class="gateway-block blog-post gateway-block-sm col-md-4 col-xs-6 col-xxs-12 eq-height">
						<div class="block-content">
							<div class="block-image">
								<?php 
					    		if(has_post_thumbnail()): 
						    		$thumbid = get_post_thumbnail_id();
									$imgurl = wp_get_attachment_image_src( $thumbid , 'theme-thumbnail-420');  ?>
									<a href="<?php echo get_permalink(); ?>" style="background-image: url(<?php echo $imgurl[0]; ?>);"><img src="<?php echo $imgurl[0]; ?>" alt="<?php echo get_the_title(); ?>" /></a>
									<?php
								else: ?>
									<a href="<?php echo get_permalink(); ?>" style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/default_thumb.jpg);"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/default_thumb.jpg" alt="<?php echo get_the_title(); ?>" /></a>
								<?php
								endif; ?>
							</div>
							<div class="block-details">
								<h3><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?> <span>»</span></a></h3>
							</div>
						</div>
					</div>
					<?php
			    endwhile; 
			    wp_reset_query();
			    echo '</div>';
		    endif;

		}else{ ?>
	<?php if ( !isset( $_REQUEST[ 'cat' ] ) ) { ?>
		<div class="row column-md-flex">
			<div class="gateway-block gateway-block-lg col-md-6">
				<?php
				wp_reset_postdata();
				$postheroids = array();
				$today = getdate();
				$cnt = 0;
				$the_querycur = new WP_Query( array(
					'post_type' => 'post',
					'post_status' => 'publish',
					'order' => 'DESC',
					'orderby' => 'date',
					'posts_per_page' => 1,
				) ); 
				$onairid = array();
				if ( $the_querycur->have_posts() ) { 
					while ( $the_querycur->have_posts() ) : $the_querycur->the_post(); 
						$onairid[0] = get_the_ID();
					endwhile; 
						$postheroids[] = $onairid[0]; ?>
						<div class="block-content">
							<div class="block-image">
								<?php 
					    		if(has_post_thumbnail($onairid[0])): 
						    		$thumbid = get_post_thumbnail_id($onairid[0]);
									$imgurl = wp_get_attachment_image_src( $thumbid , 'theme-thumbnail-665');  ?>
									<a href="<?php echo get_permalink($onairid[0]); ?>" style="background-image: url(<?php echo $imgurl[0]; ?>);"><img src="<?php echo $imgurl[0]; ?>" alt="<?php echo get_the_title($onairid[0]); ?>" /></a>
									<?php
								else: ?>
									<a href="<?php echo get_permalink($onairid[0]); ?>" style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/default_thumb.jpg);"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/default_thumb.jpg" alt="<?php echo get_the_title($onairid[0]); ?>" /></a>
								<?php
								endif; ?>
							</div>
							<div class="block-details">
								<h3><a href="<?php echo get_permalink($onairid[0]); ?>"><?php echo get_the_title($onairid[0]); ?></a></h3>
								<p class="date"><?php echo get_the_date(); ?></p>
								<p><?php echo get_content_limit(get_the_excerpt($onairid[0]), 300, "<a href='".get_permalink($onairid[0])."'>...continue reading »</a>"); ?></p>
							</div>
						</div>
						<?php
					wp_reset_postdata();
				} ?>
			</div>
			<div class="col-md-6">
					<?php
					wp_reset_postdata();

					if ( isset( $_REQUEST[ 'filter' ] ) ) {
						switch ($_REQUEST[ 'filter' ] ) {
						    case "category":
						    	if ( isset( $_REQUEST[ 'cat' ] ) ) {
							        $arg3 = array(
										'post_type' => 'post',
										'post_status' => 'publish',
										'order' =>  "DESC",
										'orderby' => 'date',
										'posts_per_page' => 2,
										'post__not_in' => $postheroids,
										'category_name' => $_REQUEST[ 'cat' ],
									);
							    }
						        break;
						    case "tags":
						    	if ( isset( $_REQUEST[ 'tag' ] ) ) {
							        $arg3 = array(
										'post_type' => 'post',
										'post_status' => 'publish',
										'order' =>  "DESC",
										'orderby' => 'date',
										'posts_per_page' => 2,
										'post__not_in' => $postheroids,
										'tag' => $_REQUEST[ 'tag' ],
									);
							    }
						        break;
						    default:
						        $arg3 = array(
									'post_type' => 'post',
									'post_status' => 'publish',
									'order' =>  "DESC",
									'orderby' => 'date',
									'posts_per_page' => 2,
									'post__not_in' => $postheroids,
								 ); 
						}
					}else{
						$arg3 = array(
							'post_type' => 'post',
							'post_status' => 'publish',
							'order' =>  "DESC",
							'orderby' => 'date',
							'posts_per_page' => 2,
							'post__not_in' => $postheroids,
						 ); 
					}
					$the_query3 = new WP_Query($arg3);
					if ( $the_query3->have_posts() ) { 
						$cntf = 1;	
						while ( $the_query3->have_posts() ) { $the_query3->the_post();
							$postheroids[] = get_the_ID(); ?>
							<div class="gateway-block gateway-block-full-<?php echo $cntf; ?> gateway-block-full eq-height">
								<div class="block-content clearfix">
									<div class="block-image">
										<?php 
							    		if(has_post_thumbnail()): 
								    		$thumbid = get_post_thumbnail_id();
											$imgurl = wp_get_attachment_image_src( $thumbid , 'theme-thumbnail-665');  ?>
											<a href="<?php echo get_permalink($onairid[0]); ?>" style="background-image: url(<?php echo $imgurl[0]; ?>);"><img src="<?php echo $imgurl[0]; ?>" alt="<?php echo get_the_title(); ?>" /></a>
											<?php
										else: ?>
											<a href="<?php echo get_permalink(); ?>" style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/default_thumb.jpg);"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/default_thumb.jpg" alt="<?php echo get_the_title(); ?>" /></a>
										<?php
										endif; ?>
									</div>
									<div class="block-details">
										<h3><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
										<p class="date"><?php echo get_the_date(); ?></p>
										<p><?php echo get_content_limit(get_the_excerpt(), 300, "<a href='".get_permalink()."'>...continue reading »</a>"); ?></p>
									</div>
								</div>
							</div>
						<?php
						$cntf = $cntf + 1;	
						}
					wp_reset_postdata();
					}
					?>
			</div>
		</div>
	<?php } ?>

		<?php 
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		
		if ( isset( $_REQUEST[ 'filter' ] ) ) {
			switch ($_REQUEST[ 'filter' ] ) {
			    case "category":
			    	if ( isset( $_REQUEST[ 'cat' ] ) ) {
				        $args2 = array(
							'post_type' => 'post',
							'post_status' => 'publish',
							'order' =>  "DESC",
							'orderby' => 'date',
							'posts_per_page' => 9,
							'paged'            => $paged,
							'post__not_in' => $postheroids,
							'category_name' => $_REQUEST[ 'cat' ],
						);
				    }
			        break;
			    case "tags":
			    	if ( isset( $_REQUEST[ 'tag' ] ) ) {
				        $args2 = array(
							'post_type' => 'post',
							'post_status' => 'publish',
							'order' =>  "DESC",
							'orderby' => 'date',
							'posts_per_page' => 9,
							'paged'            => $paged,
							'post__not_in' => $postheroids,
							'tag' => $_REQUEST[ 'tag' ],
						);
				    }
			        break;
			    default:
			        $args2 = array(
						'post_type' => 'post',
						'post_status' => 'publish',
						'order' =>  "DESC",
						'orderby' => 'date',
						'posts_per_page' => 9,
						'paged'            => $paged,
						'post__not_in' => $postheroids,
					 ); 
			}
		}else{
			$args2 = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'order' =>  "DESC",
				'orderby' => 'date',
				'posts_per_page' => 9,
				'paged'            => $paged,
				'post__not_in' => $postheroids,
			);
		}
		$wp_query2 = new WP_Query( $args2 );

		if( $wp_query2->have_posts()):
			echo '<div class="row wrap-blog-posts">';
			while($wp_query2->have_posts()):$wp_query2->the_post();  ?>
				<div class="gateway-block blog-post gateway-block-sm col-md-4 col-xs-6 col-xxs-12 eq-height">
					<div class="block-content">
						<div class="block-image">
							<?php 
				    		if(has_post_thumbnail()): 
					    		$thumbid = get_post_thumbnail_id();
								$imgurl = wp_get_attachment_image_src( $thumbid , 'theme-thumbnail-420');  ?>
								<a href="<?php echo get_permalink(); ?>" style="background-image: url(<?php echo $imgurl[0]; ?>);"><img src="<?php echo $imgurl[0]; ?>" alt="<?php echo get_the_title(); ?>" /></a>
								<?php
							else: ?>
								<a href="<?php echo get_permalink(); ?>" style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/default_thumb.jpg);"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/default_thumb.jpg" alt="<?php echo get_the_title(); ?>" /></a>
							<?php
							endif; ?>
						</div>
						<div class="block-details">
							<h3><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?> <span>»</span></a></h3>
						</div>
					</div>
				</div>
				<?php 
			endwhile;
			?>
				<nav class="post-pagination post-pagination-blog text-center clearfix">
					<ul class="nav-links nav-links-blog">
						<li class="previous previous-blog"><?php echo get_previous_posts_link('Recent Post &raquo;'); ?></li>
						<li class="next next-blog"><?php echo get_next_posts_link('&laquo; Older Post', $wp_query2->max_num_pages); ?></li>
					</ul>
				</nav>
			<?php
			echo '</div>';
			wp_reset_query();
		endif;
		?>
<?php } ?>
	</div>
</div>

<?php if(!is_front_page()): ?>
	<?php get_template_part( 'template-parts/page/content', "support" ); ?>
<?php endif; ?>

<?php get_footer();
