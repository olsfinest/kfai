<?php
/**
 * Template Name: Programs2 Template
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

get_header();
$origid = get_the_ID(); ?>

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
					<div class="col-filter filter-day col-lg-3 col-xs-6">
						<form id="filterform-day" class="search-form" method="GET">
							<input type="hidden" name="filter" value="day" />
							<select name="day" id="filterbyday" class="selectpicker">
								<option value="">Filter by Day</option>
								<option value="sun" <?php echo isset( $_REQUEST[ 'day' ] ) && $_REQUEST[ 'day' ] == "sun" ? "selected" : ''; ?>>Sunday</option>
								<option value="mon" <?php echo isset( $_REQUEST[ 'day' ] ) && $_REQUEST[ 'day' ] == "mon" ? "selected" : ''; ?>>Monday</option>
								<option value="tue" <?php echo isset( $_REQUEST[ 'day' ] ) && $_REQUEST[ 'day' ] == "tue" ? "selected" : ''; ?>>Tuesday</option>
								<option value="wed" <?php echo isset( $_REQUEST[ 'day' ] ) && $_REQUEST[ 'day' ] == "wed" ? "selected" : ''; ?>>Wednesday</option>
								<option value="thu" <?php echo isset( $_REQUEST[ 'day' ] ) && $_REQUEST[ 'day' ] == "thu" ? "selected" : ''; ?>>Thursday</option>
								<option value="fri" <?php echo isset( $_REQUEST[ 'day' ] ) && $_REQUEST[ 'day' ] == "fri" ? "selected" : ''; ?>>Friday</option>
								<option value="sat" <?php echo isset( $_REQUEST[ 'day' ] ) && $_REQUEST[ 'day' ] == "sat" ? "selected" : ''; ?>>Saturday</option>
							</select>
						</form>
					</div>
					<div class="col-filter filter-time col-lg-3 col-xs-6">
						<form id="filterform-starttime" class="search-form" method="GET">
							<input type="hidden" name="filter" value="starttime" />
							<select name="starttime" id="filterbystarttime" class="selectpicker">
								<option value="">Filter by Start Time</option>
								<option value="00:00:00">12 am</option>
								<option value="01:00:00">1 am</option>
								<option value="02:00:00">2 am</option>
								<option value="03:00:00">3 am</option>
								<option value="04:00:00">4 am</option>
								<option value="05:00:00">5 am</option>
								<option value="06:00:00">6 am</option>
								<option value="07:00:00">7 am</option>
								<option value="08:00:00">8 am</option>
								<option value="09:00:00">9 am</option>
								<option value="10:00:00">10 am</option>
								<option value="11:00:00">11 am</option>
								<option value="12:00:00">12 pm</option>
								<option value="13:00:00">1 pm</option>
								<option value="14:00:00">2 pm</option>
								<option value="15:00:00">3 pm</option>
								<option value="16:00:00">4 pm</option>
								<option value="17:00:00">5 pm</option>
								<option value="18:00:00">6 pm</option>
								<option value="19:00:00">7 pm</option>
								<option value="20:00:00">8 pm</option>
								<option value="21:00:00">9 pm</option>
								<option value="22:00:00">10 pm</option>
								<option value="23:00:00">11 pm</option>
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

<div class="row-section program-gateway-blocks column-narrow-spaces clearfix">
	<div class="container">
		<div id="filter-initial-results" class="row">
			<div class="filteroverlayloadmore"></div>
			<div class="column-md-flex">
				<div class="gateway-block gateway-block-lg col-md-6">
					<?php
					wp_reset_postdata();

					$postheroids = array();
					$today = getdate();
					$cnt = 0;
					$the_querycur = new WP_Query( array(
						'post_type' => 'program',
						'post_status' => 'publish',
						'order' => 'ASC',
						'meta_key'  => 'starttime',
						'orderby' => 'meta_value',
						'posts_per_page' => -1,
						/*'meta_query' => array(
							array(
								'key'     => 'day',
								'value'   => $today["wday"],
								'compare' => 'LIKE',
							),
							array(
								'key'     => 'starttime',
								'value'   => array( 0, 23 ),
								'compare' => 'BETWEEN',
							),
						),*/
					) ); 
					$onairid = array();
					$onaircurid = array();
					$tagline = "UPCOMING ON AIR:";
					$has = 0;
					if ( $the_querycur->have_posts() ) { 
						while ( $the_querycur->have_posts() ) : $the_querycur->the_post(); 
							$the_querycurID = get_the_ID();
							$day = get_field('day');
							$starttime = get_field('starttime');
							$end_time = get_field('end_time');

							$starthour = strtotime($starttime);
							$starthour = date('G', $starthour);
							$endhour = strtotime($end_time);
							$endhour = date('G', $endhour);

							$starttimed = new DateTime(get_field('starttime'));
							$starttimede = $starttimed->format('G');



							/*if($today['weekday'] == $day ){
								if(date('G') >= $starthour && date('G') < $endhour){
									$onairid[0] = get_the_ID();
									$has = 1;
									array_push($onaircurid, get_the_ID());
								}elseif(date('G') < $endhour){ 
									$onairid[0] = get_the_ID();
									$has = 0;
								}
							}else{
								$tom = strtotime("+1 day");
								$tom = date("l", $tom);
								if($tom == $day){
									$onairid[] = get_the_ID();
									$has = 0;
								}else{
									$has = 1;
								}
							}*/



							$starttimeaired = new DateTime(get_field('starttime'));
							$starttimeaired = $starttimeaired->format('G');
							$starttimeairedend = new DateTime(get_field('end_time'));
							$starttimeairedend = $starttimeairedend->format('G');
							if($today['weekday'] == $day && ($today['hours'] >= $starttimeaired && $today['hours'] < $starttimeairedend)){
								$onairid[0] = get_the_ID();
								$has = 1;
								//echo get_the_ID() ."<br />";
								array_push($onaircurid, get_the_ID());
								
							}else{
								$onairid[0] = get_the_ID();
								$has = 0; 
							}

						endwhile; 
							/*$curairlastitem = end($onaircurid);*/
							$onairid[0] = $onaircurid[0];
							$postheroids[] = $onairid[0];

							if($onaircurid){
								$tagline = "ON AIR NOW:";
							}
							if(has_post_thumbnail($onairid[0])): ?>
								<?php
								$thumbid = get_post_thumbnail_id($onairid[0]);
								$imgurl = wp_get_attachment_image_src( $thumbid , 'theme-thumbnail-665');  ?>
								<div class="block-content" style="background-image: url(<?php echo $imgurl[0]; ?>);">
							<?php else: ?>
								<div class="block-content">
							<?php endif; ?>
									<div class="block-details">
										<h2><?php echo $tagline; ?></h2>

										<h3><a href="<?php echo get_permalink($onairid[0]); ?>"><?php echo get_field("program_name", $onairid[0]) ? get_field("program_name",$onairid[0]) : get_the_title($onairid[0]); ?></a></h3>

										<?php
										if(get_field('starttime', $onairid[0])){ ?> 
											<p class="sched"><?php echo get_field('day',  $onairid[0]); ?>, <?php echo get_field('starttime',  $onairid[0]); ?> to <?php echo get_field('end_time',  $onairid[0]); ?></p>
											<?php 
										} ?>

										<p class="djs">DJs: 
										<?php
										$djs_obj = get_field('djs', $onairid[0]);
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
										$term_list = wp_get_post_terms($onairid[0], 'program_cat', array( 'fields' => 'all' ) );
										$cnt = 1;
										if($term_list): ?>
										<p class="categories"><span class="fa fa-tags"></span>
										<?php
										foreach($term_list as $progcat){
											if($cnt > 1){
												echo ", ";
											}
											echo "<a href='".get_permalink($origid)."?filter=category&cat=".$progcat->slug."'>".$progcat->name."</a>";
											$cnt = $cnt + 1;
										} ?>
										</p>
										<?php endif; ?>

										<div class="latestep">

											<?php
														$eplatest = new WP_Query( array(
															'post_type' => 'episode',
															'post_status' => 'publish',
															'order' => 'DESC',
															'posts_per_page' => 1,
															'meta_key'  => 'ep_date',
															'orderby' => 'meta_value',
															'meta_query' => array(
																array(
																	'key'     => 'episode_program',
																	'value'   => $onairid[0],
																	'compare' => 'LIKE',
																),
															),
														) ); 
													if ( $eplatest->have_posts() ) { 
														while ( $eplatest->have_posts() ) { $eplatest->the_post(); ?>
															<a href="<?php echo get_permalink(); ?>"><span class="fa fa-play-circle"></span> Listen to the latest episode</a>
														<?php
														}
													}else{
														?><a href="#"><span class="fa fa-play-circle"></span> Listen to the latest episode</a><?php
													} ?>
										</div>
										<div class="socials">
											<a href="#"><span class="fa fa-facebook-square"></span></a>
											<a href="#"><span class="fa fa-twitter-square"></span></a>
											<a href="#"><span class="fa fa-instagram"></span></a>
											<a href="#"><span class="fa fa-mixcloud"></span></a>
											<a href="#"><span class="fa fa-soundcloud"></span></a>
										</div>
									</div>
								</div>
							<?php

						wp_reset_postdata();
					} ?>
				</div>
				<div class="col-md-6">
					<div class="row">
						<?php

						


						/*********************************************************/
						wp_reset_postdata();
						if($onaircurid){

							$onairarr = array();
							if(count($onaircurid) > 1){
								foreach ($onaircurid as $value) {
								    if($value !== $onairid[0]){
								    	$postheroids[] = $value;
								    	$onairarr[] = $value;
										$day = get_field('day', $value);
										$starttime = get_field('starttime', $value);
										$end_time = get_field('end_time', $value); ?>
										<div class="gateway-block gateway-block-sm col-xs-6  eq-height">
											<?php if(has_post_thumbnail($value)): 
												$thumbid = get_post_thumbnail_id($value);
												$imgurl = wp_get_attachment_image_src( $thumbid , 'theme-thumbnail-330');  ?>
												<div class="block-content" style="background-image: url(<?php echo $imgurl[0]; ?>);">
											<?php else: ?>
												<div class="block-content">
											<?php endif; ?>
													<div class="block-details">
														<?php
														$starttimeaired = new DateTime(get_field('starttime', $value));
														$starttimeaired = $starttimeaired->format('G');
														$starttimeairedend = new DateTime(get_field('end_time', $value));
														$starttimeairedend = $starttimeairedend->format('G');
														if($today['weekday'] == $day && ($today['hours'] >= $starttimeaired && $today['hours'] < $starttimeairedend)){
															echo "<h3>On Air Now:</h3>";
														}
														?>
														<h3><a href="<?php echo get_permalink($value); ?>"><?php echo get_field("program_name", $value) ? get_field("program_name", $value) : get_the_title($value); ?></a></h3>
														<?php
														if($starttime){ ?> 
															<p class="sched"><?php echo $day; ?>, <?php echo $starttime; ?> to <?php echo $end_time; ?></p>
															<?php 
														} ?>
														<p class="djs">DJs: 
														<?php
														$djs_obj = get_field('djs', $value);
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
														$term_list = wp_get_post_terms( $value, 'program_cat', array( 'fields' => 'all' ) );
														$cnt = 1;
														if($term_list): ?>
														<p class="categories"><span class="fa fa-tags"></span>
														<?php
														foreach($term_list as $progcat){
															if($cnt > 1){
																echo ", ";
															}
															echo "<a href='".get_permalink($origid)."?filter=category&cat=".$progcat->slug."'>".$progcat->name."</a>";
															$cnt = $cnt + 1;
														} ?>
														</p>
														<?php endif; ?>
														<div class="block-details-footer">
															<div class="latestep">
																<?php
																	$eplatest = new WP_Query( array(
																		'post_type' => 'episode',
																		'post_status' => 'publish',
																		'order' => 'DESC',
																		'posts_per_page' => 1,
																		'meta_key'  => 'ep_date',
																		'orderby' => 'meta_value',
																		'meta_query' => array(
																			array(
																				'key'     => 'episode_program',
																				'value'   => $value,
																				'compare' => 'LIKE',
																			),
																		),
																	) ); 
																if ( $eplatest->have_posts() ) { 
																	while ( $eplatest->have_posts() ) { $eplatest->the_post(); ?>
																		<a href="<?php echo get_permalink(); ?>"><span class="fa fa-play-circle"></span> Listen to the latest episode</a>
																	<?php
																	}
																}else{
																	?><a href="#"><span class="fa fa-play-circle"></span> Listen to the latest episode</a><?php
																} ?>
															</div>
															<div class="socials">
																<a href="#"><span class="fa fa-facebook-square"></span></a>
																<a href="#"><span class="fa fa-twitter-square"></span></a>
																<a href="#"><span class="fa fa-instagram"></span></a>
																<a href="#"><span class="fa fa-mixcloud"></span></a>
																<a href="#"><span class="fa fa-soundcloud"></span></a>
															</div>
														</div>
													</div>
												</div>
										</div>
								    	<?php
								    }
								}
							}

							$arg3 = array(
							'post_type' => 'program',
							'post_status' => 'publish',
							'order' => 'ASC',
							'meta_key'  => 'starttime',
							'orderby' => 'meta_value',
							'posts_per_page' => 4 - count($onairarr),
							'post__not_in' => $postheroids,
						 ); 
						}else{
							$arg3 = array(
							'post_type' => 'program',
							'post_status' => 'publish',
							'order' => 'ASC',
							'meta_key'  => 'starttime',
							'orderby' => 'meta_value',
							'posts_per_page' => 4,
							'post__not_in' => $postheroids,
						 ); 
						}
						
						
						$the_query3 = new WP_Query($arg3);
						if ( $the_query3->have_posts() ) { 
							while ( $the_query3->have_posts() ) { $the_query3->the_post();
							$postheroids[] = get_the_ID();
							$day = get_field('day');
							$starttime = get_field('starttime');
							$end_time = get_field('end_time'); ?>
							<div class="gateway-block gateway-block-sm col-xs-6  eq-height">
								<?php if(has_post_thumbnail()): 
									$thumbid = get_post_thumbnail_id(get_the_ID());
									$imgurl = wp_get_attachment_image_src( $thumbid , 'theme-thumbnail-330');  ?>
									<div class="block-content" style="background-image: url(<?php echo $imgurl[0]; ?>);">
								<?php else: ?>
									<div class="block-content">
								<?php endif; ?>
										<div class="block-details">
											<?php
											$starttimeaired = new DateTime(get_field('starttime'));
											$starttimeaired = $starttimeaired->format('G');
											$starttimeairedend = new DateTime(get_field('end_time'));
											$starttimeairedend = $starttimeairedend->format('G');
											if($today['weekday'] == $day && ($today['hours'] >= $starttimeaired && $today['hours'] < $starttimeairedend)){
												echo "<h3>On Air Now</h3>";
											}
											?>
											<h3><a href="<?php echo get_permalink(); ?>"><?php echo get_field("program_name") ? get_field("program_name") : get_the_title(); ?></a></h3>
											<?php
											if($starttime){ ?> 
												<p class="sched"><?php echo $day; ?>, <?php echo $starttime; ?> to <?php echo $end_time; ?></p>
												<?php 
											} ?>
											<p class="djs">DJs: 
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
											$term_list = wp_get_post_terms( get_the_ID(), 'program_cat', array( 'fields' => 'all' ) );
											$cnt = 1;
											if($term_list): ?>
											<p class="categories"><span class="fa fa-tags"></span>
											<?php
											foreach($term_list as $progcat){
												if($cnt > 1){
													echo ", ";
												}
												echo "<a href='".get_permalink($origid)."?filter=category&cat=".$progcat->slug."'>".$progcat->name."</a>";
												$cnt = $cnt + 1;
											} ?>
											</p>
											<?php endif; ?>
											<div class="block-details-footer">
												<div class="latestep">
													<?php
														$eplatest = new WP_Query( array(
															'post_type' => 'episode',
															'post_status' => 'publish',
															'order' => 'DESC',
															'posts_per_page' => 1,
															'meta_key'  => 'ep_date',
															'orderby' => 'meta_value',
															'meta_query' => array(
																array(
																	'key'     => 'episode_program',
																	'value'   => get_the_ID(),
																	'compare' => 'LIKE',
																),
															),
														) ); 
													if ( $eplatest->have_posts() ) { 
														while ( $eplatest->have_posts() ) { $eplatest->the_post(); ?>
															<a href="<?php echo get_permalink(); ?>"><span class="fa fa-play-circle"></span> Listen to the latest episode</a>
														<?php
														}
													}else{
														?><a href="#"><span class="fa fa-play-circle"></span> Listen to the latest episode</a><?php
													} ?>
												</div>
												<div class="socials">
													<a href="#"><span class="fa fa-facebook-square"></span></a>
													<a href="#"><span class="fa fa-twitter-square"></span></a>
													<a href="#"><span class="fa fa-instagram"></span></a>
													<a href="#"><span class="fa fa-mixcloud"></span></a>
													<a href="#"><span class="fa fa-soundcloud"></span></a>
												</div>
											</div>
										</div>
									</div>
							</div>
							<?php
							}
							wp_reset_postdata();
						}
						?>
					</div>
				</div>
			</div>
			<?php 
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$args2 = array(
				'posts_per_page'   => 8,
				'post_type'        => array('program'),
				'post_status'      => 'publish',
				'suppress_filters' => true,
				'paged'            => $paged,
				'order' => 'ASC',
				'meta_key'  => 'starttime',
				'orderby' => 'meta_value',
				'post__not_in' => $postheroids,
			);
			
			$wp_query2 = new WP_Query( $args2 );

			if( $wp_query2->have_posts()):
				echo '<div class="wrap-program-posts">';
				while($wp_query2->have_posts()):$wp_query2->the_post(); 
					$day = get_field('day');
					$starttime = get_field('starttime');
					$end_time = get_field('end_time'); ?>
					<div class="gateway-block program-post gateway-block-sm col-md-3 col-xs-6 eq-height">
						<?php if(has_post_thumbnail()): 
							$thumbid = get_post_thumbnail_id(get_the_ID());
							$imgurl = wp_get_attachment_image_src( $thumbid , 'theme-thumbnail-330');  ?>
							<div class="block-content" style="background-image: url(<?php echo $imgurl[0]; ?>);">
						<?php else: ?>
							<div class="block-content">
						<?php endif; ?>
								<div class="block-details">
									<?php
											$starttimeaired = new DateTime(get_field('starttime'));
											$starttimeaired = $starttimeaired->format('G');
											$starttimeairedend = new DateTime(get_field('end_time'));
											$starttimeairedend = $starttimeairedend->format('G');
											if($today['weekday'] == $day && ($today['hours'] >= $starttimeaired && $today['hours'] < $starttimeairedend)){
												echo "<h3>On Air Now</h3>";
											}
											?>
									<h3><a href="<?php echo get_permalink(); ?>"><?php echo get_field("program_name") ? get_field("program_name") : get_the_title(); ?></a></h3>
									<?php
									if($starttime){ ?> 
										<p class="sched"><?php echo $day; ?>, <?php echo $starttime; ?> to <?php echo $end_time; ?></p>
										<?php 
									} ?>
									<p class="djs">DJs: 
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
									$term_list = wp_get_post_terms( get_the_ID(), 'program_cat', array( 'fields' => 'all' ) );
									$cnt = 1;
									if($term_list): ?>
									<p class="categories"><span class="fa fa-tags"></span>
									<?php
									foreach($term_list as $progcat){
										if($cnt > 1){
											echo ", ";
										}
										echo "<a href='".get_permalink($origid)."?filter=category&cat=".$progcat->slug."'>".$progcat->name."</a>";
										$cnt = $cnt + 1;
									} ?>
									</p>
									<?php endif; ?>
									<div class="block-details-footer">
										<div class="latestep">
											<?php
														$eplatest = new WP_Query( array(
															'post_type' => 'episode',
															'post_status' => 'publish',
															'order' => 'DESC',
															'posts_per_page' => 1,
															'meta_key'  => 'ep_date',
															'orderby' => 'meta_value',
															'meta_query' => array(
																array(
																	'key'     => 'episode_program',
																	'value'   => get_the_ID(),
																	'compare' => 'LIKE',
																),
															),
														) ); 
													if ( $eplatest->have_posts() ) { 
														while ( $eplatest->have_posts() ) { $eplatest->the_post(); ?>
															<a href="<?php echo get_permalink(); ?>"><span class="fa fa-play-circle"></span> Listen to the latest episode</a>
														<?php
														}
													}else{
														?><a href="#"><span class="fa fa-play-circle"></span> Listen to the latest episode</a><?php
													} ?>
										</div>
										<div class="socials">
											<a href="#"><span class="fa fa-facebook-square"></span></a>
											<a href="#"><span class="fa fa-twitter-square"></span></a>
											<a href="#"><span class="fa fa-instagram"></span></a>
											<a href="#"><span class="fa fa-mixcloud"></span></a>
											<a href="#"><span class="fa fa-soundcloud"></span></a>
										</div>
									</div>
								</div>
							</div>
					</div>
					<?php 
				endwhile;
				?>
					<nav class="post-pagination post-pagination-program text-center clearfix">
						<ul class="nav-links nav-links-program">
							<li class="previous previous-program"><?php echo get_previous_posts_link('Recent Post &raquo;'); ?></li>
							<li class="next next-program"><?php echo get_next_posts_link('&laquo; Older Post', $wp_query2->max_num_pages); ?></li>
						</ul>
					</nav>
				<?php
				echo '</div>';
				wp_reset_query();
			endif;
			?>
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
