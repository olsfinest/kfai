<?php
/**
 * Template Name: Schedule Template
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
 
	<div class="row-section content-area tpl-schedule clearfix" id="primary">
		<div class="container">
			<div class="row">
				<main id="main" class="site-main col-lg-12" role="main">
					<div class="main-content clearfix">
						<header class="page-header">
							<h1 class="page-title text-<?php echo get_field("alignment", get_the_ID()); ?>">
								<?php echo get_custom_title(get_the_ID()); ?>
							</h1>
						</header>

				    	<div id="tabs">
				    		<?php 
								$weekdays = array("0", "1", "2", "3", "4", "5", "6" , "we"); 
								$weekdayslabel = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday" , "Web Exclusive"); 
								$cnt = 0;
								$cnt2 = 0;
							?>
							<ul>
								<?php
									foreach ($weekdayslabel as $daylabel)
									{
										?>
											<li><a href="#tabs-<?php echo $cnt2; ?>"><?php echo $daylabel; ?></a></li>
										<?php
										
										$cnt2 = $cnt2 + 1;
									}
								?>
							</ul>							
							<?php
								foreach ($weekdays as $weekday)
								{
									?>
										<div id="tabs-<?php echo $cnt; ?>" class="sched-content clearfix">
											<h2><?php echo $weekdayslabel[$cnt]; ?></h2>
									
											<?php
												
												if($weekday == "we")
												{
													$args = array(
														'posts_per_page' => -1,
														'post_type' => array('program'),
														'post_status' => 'publish',
														'suppress_filters' => true,
														'meta_query' => array(
															'meta_webexclusive' => array(
																'relation' => 'AND',
																array(
																  'key' => 'web_exclusive',
																  'value' => 'Web Exclusive',
																  'compare' => 'LIKE'
																)
															)
														),
														'order' => 'ASC',
														'orderby' => 'meta_starttime'
													); 
												}
												else
												{
													$args = array(
														'posts_per_page' => -1,
														'post_type' => array('program'),
														'post_status' => 'publish',
														'suppress_filters' => true,
														'meta_query' => array(
															'meta_starttime' => array(
																'key' => 'schedule_'.$cnt.'_starttime'
															),
															'meta_dayofweek' => array(
																'key' => 'schedule_'.$cnt.'_enabled',
																'value' => '1',
																'compare' => '='
															)
														),
														'order' => 'ASC',
														'orderby' => 'meta_starttime'
													); 
												}
												
												$q = new WP_Query($args);
							
												if($q->have_posts())
												{
													?>
														<div>
													<?php
													
													$daycnt = 0;
													
													while($q->have_posts())
													{
														$q->the_post();
														
														?>
															<div class="sched-prog <?php if ($daycnt % 2 == 0) { echo "even"; } else { echo "add"; }	?>">
																<div class="clearfix">
																	<div class="sched-time eq-height">
																		<span>
																			<?php
																				if($weekday == "we")
																				{
																					for($dayi=0;$dayi<7;$dayi++)
																					{
																						if(get_field('schedule_'.$dayi.'_enabled', get_the_ID()) == '1')
																						{
																							?>
																								<?php echo kfai_print_air_datetime($dayi, get_field('schedule_'.$dayi.'_starttime',  $program_id), get_field('schedule_'.$dayi.'_endtime',  $program_id)); ?><br />
																							<?php 
																						}
																					}
																				}
																				else
																				{
																					kfai_print_air_time(get_field('schedule_'.$weekday.'_starttime'), get_field('schedule_'.$weekday.'_endtime'));
																				}
																			?>
																		</span>
																	</div>
																	<div class="sched-details eq-height">
																		<a href="<?php echo get_permalink(); ?>"><?php echo get_field("program_name") ? get_field("program_name") : get_the_title(); ?></a>
																		<span class="djs">DJs: 
																		<?php
																			$djs_obj = get_field('djs', get_the_ID());
														
																			if($djs_obj)
																			{
																				$cntd = 1;
																				
																				foreach( $djs_obj as $dj)
																				{
																					setup_postdata($dj);
																					
																					if($cntd > 1)
																					{
																						echo ", ";
																					}
																					
																					echo get_field("name", $dj->ID) ? get_field("name", $dj->ID) : get_the_title($dj->ID); 

																					$cntd = $cntd + 1;
																				}
																				
																				wp_reset_postdata();
																			}
																		?>
																		</span>
																		<?php 
																			$term_list = wp_get_post_terms(get_the_ID(), 'program_cat', array('fields' => 'all'));
																			$cntt = 1;
														
																			if($term_list)
																			{
																				?>
																					<span class="categories">
																						<?php
																							foreach($term_list as $progcat)
																							{
																								if($cntt > 1)
																								{
																									echo ", ";
																								}

																								echo $progcat->name ;

																								$cntt = $cntt + 1;
																							}
																						?>
																					</span>
																				<?php
																			}
																		?>
																	</div>
																</div>
															</div>
														<?php
														
														$daycnt++;
													}
													
													?>
														</div>
													<?php
												}
										
											?>
											<br style="clear:both;" />
										</div>
									<?php
									
									$cnt = $cnt + 1;
								}
							?>
						</div>
					</div>
				</main>
			</div>
		</div>
	</div>

<?php get_footer();
