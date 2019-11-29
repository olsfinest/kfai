<?php
/**
 * Template Name: Playlists Template
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
global $wp_query;
$program_ID = $wp_query->query_vars['programid'];
$aryear = $wp_query->query_vars['yr'];
$armon = $wp_query->query_vars['mon'];
$armonw = "";

if($armon == "01"){$armonw = "January";}
elseif($armon == "02"){$armonw = "February";}
elseif($armon == "03"){$armonw = "March";}
elseif($armon == "04"){$armonw = "April";}
elseif($armon == "05"){$armonw = "May";}
elseif($armon == "06"){$armonw = "June";}
elseif($armon == "07"){$armonw = "July";}
elseif($armon == "08"){$armonw = "August";}
elseif($armon == "09"){$armonw = "September";}
elseif($armon == "10"){$armonw = "October";}
elseif($armon == "11"){$armonw = "November";}
else{$armonw = "December";}

$startdate = kfai_get_start_date($_REQUEST['yr'], $_REQUEST['mon']);
$enddate = kfai_get_end_date($_REQUEST['yr'], $_REQUEST['mon']);

/*$firstday = date($aryear . '' . $armon . '' . '01');
$lastday = date($aryear .'' . $armon . '' . date('t', strtotime($firstday)));*/
$firstday = date($armon . '/' . '01' . '/' . $aryear);
$lastday = date( $armon .'/' . date('t', strtotime($firstday)) . '/' . $aryear ); ?>

<div class="row-section page-breadcrumbs clearfix">
	<div class="container">
		<ul>
			<li><a href="<?php echo home_url(); ?>">Home</a></li>
			<li>»</li>
			<li><a href="<?php echo home_url() . '/programs/'; ?>">Programs</a></li>
			<li>»</li>
			<li>
				<?php
				echo get_the_title($wp_query->query_vars['programid']); ?>
			</li>
		</ul>
	</div>
</div>
<div class="row-section content-area tpl-single-program clearfix" id="primary">
		<div class="container">
			<div class="row column-md-flex">
				<main id="main" class="site-main col-md-8 col-sm-7" role="main">
					<div class="main-content clearfix">
						<h1><?php echo $armonw ." ". $aryear ." ". get_the_title($wp_query->query_vars['programid']); ?> Archives</h1>
				    	<?php
							wp_reset_postdata();
							$the_query = new WP_Query( array(
							'post_type' => 'episode',
										'post_status' => 'publish',
										'posts_per_page' => -1 ,
										'meta_key'   => 'ep_date', 
										'orderby'    => 'post_date',
										'order'      => 'DESC',
								'date_query' => array(
								'after' => $startdate,
								'before' => $enddate,
								'inclusive' => true
							),
										'meta_query' => array(  
									       array(
											'key' => 'episode_program',
											'value' => $program_ID,
											'compare' => 'IN'
											)
								        ),
							) ); 
							if ( $the_query->have_posts() ) { 
							while ( $the_query->have_posts() ) { $the_query->the_post(); ?>
								<div class="archive-item clearfix">
									<h3><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
									<?php
									$epdate_ts = get_field('ep_date', false, false);
									$epdate = new DateTime();
									$epdate->setTimestamp($epdate_ts);
									$epdatet = $epdate->format('l, F j, Y'); ?>
									<span><?php echo $epdatet; ?></span>
									<div class="ep-btns">
										<a href="<?php echo get_permalink(); ?>" class="btn btn-dark-bordered"><span class="fa fa-info-circle"></span>DETAILS</a>
										<?php kfai_print_episode_listen_button(get_the_ID()); ?>
									<!--	<a href="#" class="btn btn-dark-bordered"><span class="fa fa-download"></span>DOWNLOAD NOW</a> -->
									</div>
								</div>
								<?php
							}
							wp_reset_postdata();
							}
							?>
					</div>
				</main>
				<aside class="secondary widget-area widget-area-program col-md-4 col-sm-5 col-sm-pad-0" role="complementary">
					<div class="widget-area-content">
						<?php //dynamic_sidebar( 'sidebar-episode' ); ?>
						<section class="widget Annual_Archive_Widget">
							<h3 class="widget-title">Program Archives</h3>	
							<?php
							wp_reset_postdata();
							
							
							
							$the_query = new WP_Query( array(
							'post_type' => 'episode',
							'post_status' => 'publish',
							'posts_per_page' => -1 ,
							'meta_key'   => 'ep_date',
							'orderby'    => 'meta_value_num',
							'order'      => 'DESC',
							'meta_query' => array( 
								array(
									'key' => 'episode_program',
									'value' => $program_ID,
									'compare' => '='
								)
							),
							) ); 
							if ( $the_query->have_posts() ) {



								$month_check = '';
								echo '<ul class="archive-programs">';
							while ( $the_query->have_posts() ) { $the_query->the_post();
								$program_titlel = get_field('episode_program');
								$program_IDl = '';
								if( $program_titlel ): 
									$p_titlel = $program_titlel;
									$program_IDl = $p_titlel->ID;
								endif;

								$mon_ts = get_field('ep_date', false, false);
								$mon = new DateTime();
								$mon->setTimestamp($mon_ts);
								$mon = $mon->format('F'); 

								if ($mon !== $month_check) {
									$mond_ts = get_field('ep_date', false, false);
									$mond = new DateTime();
									$mond->setTimestamp($mond_ts);
									/*$firstday = date($mond->format('Y') . '' . $mond->format('m') . '' . '01');
									$lastday = date($mond->format('Y') .'' . $mond->format('m') . '' . date('t', strtotime($firstday)));*/
									$firstday = date($mond->format('m') . '/' . '01' . '/' . $mond->format('Y'));
									$lastday = date($mond->format('m') .'/' . date('t', strtotime($firstday)) . '/' . $mond->format('Y'));
									if($mond->format('Y') >= 2000)
									{
										echo "<li> <a href='". home_url() ."/playlists/?programid=".$program_ID."&yr=". $mond->format('Y') ."&mon=". $mond->format('m') ."'>" .$mond->format('F Y');
										$the_query_count = new WP_Query( array(
										'post_type' => 'episode',
										'post_status' => 'publish',
										'posts_per_page' => -1 ,
										'orderby'    => 'meta_value_num',
										'order'      => 'DESC',
										'date_query' => array(
											'after' => kfai_get_start_date($mond->format('Y'), $mond->format('m')),
											'before' => kfai_get_end_date($mond->format('Y'), $mond->format('m')),
											'inclusive' => true
										),
										'meta_query' => array( 
											  array(
												'key' => 'episode_program',
												'value' => $program_ID,
												'compare' => '='
											)
										),
										) ); 
										echo " (" . $the_query_count->post_count . ") </a></li>";
									}
								}
							?>
							
							<?php
							$month_check = $mon;
							}
							echo '</ul>';
							wp_reset_postdata();
							}
							?>
							<!--</form>-->
						</section>

					</div>
				</aside>
			</div>
		</div>
	</div>
<?php if(!is_front_page()): ?>
<?php get_template_part( 'template-parts/page/content', "support" ); ?>
<?php endif; ?>

<aside class="secondary widget-area widget-area-program" role="complementary">
	<div class="widget-area-content">
		<?php dynamic_sidebar( 'sidebar-prog' ); ?>
	</div>
</aside>

<?php get_footer();
