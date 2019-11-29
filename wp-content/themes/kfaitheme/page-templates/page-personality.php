<?php
/**
 * Template Name: Personality Template
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

<div class="row-section search-filters program-search-filters column-narrow-spaces clearfix">
	<div class="container">
		<div class="row">
			<div class="col-lg-10">
				<div class="row">
					<div class="col-filter filter-search col-lg-3 col-xs-6">
						<form id="filterform-search" role="search" class="search-form" method="GET">
							<input type="search" class="search-field text-search" value="<?php echo isset( $_REQUEST[ 'search' ] ) ? $_REQUEST[ 'search' ] : ''; ?>" name="search" placeholder="Search" />
							<button type="submit" class="search-submit" id="submit-search"><span class="fa fa-search"></span></button>  
						</form>
					</div>
					<div class="col-filter filter-programs col-lg-3 col-xs-6">
						<form id="filterform-program" role="search" class="search-form" method="GET">
							<select name="programid" id="filterbyprogram" class="selectpicker">
								<option value="">Program</option>
								<?php 
								wp_reset_query();
								$args = array(
									'posts_per_page'   => -1,
									'post_type'        => array('program'),
									'post_status'      => 'publish',
									'order' => 'ASC',
									'orderby' => 'name',
								);
								$wp_query = new WP_Query( $args);
								if( $wp_query->have_posts()):
									while($wp_query->have_posts()):$wp_query->the_post(); ?>
										<option value="<?php echo get_the_ID(); ?>" <?php echo isset( $_REQUEST[ 'programid' ] ) && $_REQUEST[ 'programid' ] == get_the_ID() ? "selected" : ''; ?>><?php echo get_field("program_name") ? get_field("program_name") : get_the_title(); ?></option>
										<?php
									endwhile;
									wp_reset_query();
								endif; ?>
							</select>
						</form>
					</div>
					<div class="col-filter filter-alpha col-lg-3 col-xs-6">
						<form id="filterform-order" class="search-form" method="GET">
							<input type="hidden" name="filter" value="alphabitical" />
							<select name="programorder" id="orderalphabetical" class="selectpicker">
								<option value="ASC">Filter Alphabetically</option>
								<option value="ASC" <?php echo isset( $_REQUEST[ 'order' ] ) && $_REQUEST[ 'order' ] == "ASC" ? "selected" : ''; ?>>Ascending</option>
								<option value="DESC" <?php echo isset( $_REQUEST[ 'order' ] ) && $_REQUEST[ 'order' ] == "DESC" ? "selected" : ''; ?>>Decending</option>
							</select>
						</form>
					</div>
					<div class="col-filter filter-cat col-lg-3 col-xs-6">
						<form id="filterform-cat" class="search-form" method="GET">
							<input type="hidden" name="filter" value="category" />
							<select name="cat" id="filterbycat" class="selectpicker">
								<option value="">Filter by Tag/Category</option>
								<?php
								$personalitycatlist = get_terms(array(
													    'taxonomy' => 'personality_cat',
													    'hide_empty' => false,
													));
								foreach($personalitycatlist as $percat){ ?>
									<option value="<?php echo $percat->slug; ?>" <?php echo isset( $_REQUEST[ 'cat' ] ) && $_REQUEST[ 'cat' ] == $percat->slug ? "selected" : ''; ?>><?php echo $percat->name; ?></option>
									<?php
								} ?>
							</select>
						</form>
					</div>
				</div>
			</div>
			<div class="col-lg-2">
				<div class="col-filter"><a href="#" class="btn" id="filterclear">Clear Filters</a></div>
			</div>
		</div>
	</div>
</div>

<div class="row-section personality-gateway-blocks column-narrow-spaces clearfix">
	<div class="container">
		<div id="filter-initial-results" class="row">
			<?php 
			wp_reset_query();
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$args2 = array(
				'posts_per_page'   => 14,
				'post_type'        => array('personality'),
				'post_status'      => 'publish',
				'suppress_filters' => true,
				'paged'            => $paged,
				'order' => 'ASC',
				'orderby' => 'name',
			);
			
			$wp_query2 = new WP_Query( $args2 );
			$cn = 1; 
			$cnt = 1; 
			if( $wp_query2->have_posts()):
				echo '<div class="wrap-personality-posts">';
				while($wp_query2->have_posts()):$wp_query2->the_post(); ?>
					<div class="gateway-block personality-item gateway-block-<?php echo $cn; ?> eq-height t">
						<?php if(has_post_thumbnail()): ?>
							<?php
							$thumbid = get_post_thumbnail_id(get_the_ID());
							$imgurl = wp_get_attachment_image_src( $thumbid , 'theme-thumbnail-330');  ?>
							<div class="block-content" style="background-image: url(<?php echo $imgurl[0]; ?>);">
						<?php else: ?>
							<div class="block-content">
						<?php endif; ?>
								<div class="block-details">
									<h3><a href="<?php echo get_permalink(); ?>"><?php echo get_field("name") ? get_field("name") : get_the_title(); ?></a></h3>
									<?php $plink = get_permalink(); ?>
									<?php
									$progs_obj = get_field('hosted_of', get_the_ID());
									if( $progs_obj ):
										$cntp = 1; 
										foreach( $progs_obj as $prog){
											setup_postdata($prog);
											if($cntp == 1){
											?><h4><a href="<?php echo get_permalink($prog->ID); ?>">
													<?php echo get_field("program_name", $prog->ID) ? get_field("program_name", $prog->ID) : get_the_title($prog->ID); ?>
													</a>
											</h4><?php
											}
											$cntp = $cntp + 1; 
										}
										wp_reset_postdata();wp_reset_query();
									endif; ?>
									<p class="excerpt">
										<?php echo get_content_limit(get_the_excerpt(), 250, "<a href='".$plink."'>more »</a>"); ?>
									</p>
									<div class="block-details-footer">
										<div class="latestep">
											
										</div>
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
								</div>
						</div>
					</div>
					<?php 
					$cn = $cn + 1;
					if(($cnt%7) == 0){ 
						$cn = 1;
					}
					$cnt = $cnt + 1;
				endwhile;
				?>
				<nav class="post-pagination post-pagination-personality text-center clearfix">
					<ul class="nav-links nav-links-personality">
						<li class="previous previous-personality"><?php echo get_previous_posts_link('Recent Post &raquo;'); ?></li>
						<li class="next next-personality"><?php echo get_next_posts_link('&laquo; Older Post', $wp_query2->max_num_pages); ?></li>
					</ul>
				</nav>
				<?php
				echo '</div>';
				wp_reset_query();
			endif; ?>
		</div>
		<div id="filter-results" class="row">
			<div class="filterloadmore"></div>
		</div>
	</div>
</div>


<?php if(!is_front_page()): ?>
	<?php get_template_part( 'template-parts/page/content', "support" ); ?>
<?php endif; ?>

<?php get_footer();
