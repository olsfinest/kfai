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
$program_ID = '';
$id = get_the_ID();
$progepdate_ts = get_field('ep_date', false, false);
$progepdate = new DateTime();
$progepdate->setTimestamp($progepdate_ts);
$progepdatet = $progepdate->format('n/j/Y');

 ?>
<div class="row-section page-breadcrumbs clearfix">
	<div class="container">
		<ul>
			<li><a href="<?php echo home_url(); ?>">Home</a></li>
			<li>»</li>
			<li><a href="<?php echo home_url() . '/programs/'; ?>">Programs</a></li>
			<li>»</li>
			<li>
				<?php
				$program_title = get_field('episode_program');
				if( $program_title ): 
					$p_title = $program_title;
					setup_postdata( $p_title ); 
					$program_ID = $p_title->ID;
					echo get_the_title($p_title);
					wp_reset_postdata();
				endif; ?>
			</li>
		</ul>
	</div>
</div>
<div class="row-section content-area tpl-single-program clearfix" id="primary">
		<div class="container">
			<div class="row column-md-flex">
				<main id="main" class="site-main col-md-12 col-sm-7" role="main">
					<div class="main-content row clearfix">
				    	<div class="col-program-image col-lg-5 col-md-6 eq-height">

				    		<?php 
				    		if(has_post_thumbnail($program_title)): 
					    		$thumbid = get_post_thumbnail_id($program_title);
$imgurl = wp_get_attachment_image_src( $thumbid , 'theme-thumbnail-330');  ?>
<a href="<?php echo get_field("program_image_link"); ?>" style="background-image: url(<?php echo $imgurl[0]; ?>);"><img src="<?php echo $imgurl[0]; ?>" alt="<?php echo get_the_ID($program_ID); ?>" /></a>
<?php
							else: ?>
<a href="<?php echo get_field("program_image_link"); ?>" style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/default_thumb.jpg);"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/default_thumb.jpg" alt="<?php echo get_the_ID(); ?>" /></a>
							<?php
							endif; ?> 
				    	</div> 

				    	<div class="col-program-details col-lg-7 col-md-6 eq-height">
				    		<h1><?php echo get_field("episode_title") ? get_field("episode_title") : get_the_title(); ?></h1>

				    		<p class="epprogram">
				    			<strong>Program:</strong><br />
<a href="<?php echo get_permalink($p_title); ?>"><?php echo get_the_title($p_title); ?></a><br />
<span><?php  $date1 = get_field("episode_title") ? get_field("episode_title") : get_the_title();
 $result = substr($date1, 0, 10);
echo $newDate = date("F j, Y", strtotime($result));
?></span>
				    		</p>

				    		<p class="djs"><strong>DJs:</strong>
							<?php
							$djs_obj = get_field('djs', $p_title);
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
wp_reset_query();
wp_reset_postdata();
							else:
echo "\"Anonymous\"";
							endif; ?>
							</p>
							
							<?php 
							$id = get_the_ID();
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
$rssurl = get_field('rss_feed_url');	
							}

							} // end while
							} // end if
							wp_reset_query();
							

$spinitron_id = kfai_get_spinitron_playlist_for_episode(get_the_ID());
							
							$urlname = get_field('audio_file_url');
							?>
							<div class="episodes-btns">

								<?php kfai_print_episode_listen_button(get_the_ID()); ?>
<?php if($url != NULL): ?>
				    			<a href="<?php if($url != NULL) { echo get_field('audio_file'); } ?>" class="btn btn-dark-bordered"><span class="fa fa-download"></span>Bonus Content</a><?php endif; ?>
							</div>
				    	</div>
				    	<div class="col-program-desc col-lg-12 clearfix">
				    		<div>
								
								<?php
									if($spinitron_id)
									{
										?>
								<h2>PLAYLIST TRACKS: </h2>
								
								<div style="position:relative;width:100%;height:0;padding-bottom:56.25%;">
									<!--<iframe id="spinitron_frame" src="http://widgets.spinitron.com/widget/now-playing-v2?station=kfai&num=8&sharing=1&cover=1&player=1&merch=1&stylesheet=<?php echo get_template_directory_uri(); ?>/spinitron-widget.css" allow="encrypted-media" style="position:absolute;top:0;left:0;width:100%;height:100%;border:0px;">-->
									<iframe id="spinitron_frame" src="http://spinitron.com/KFAI/pl/<?php echo $spinitron_id; ?>/?cover=1&stylesheet=<?php echo get_template_directory_uri(); ?>/spinitron-widget.css" allow="encrypted-media" style="position:absolute;top:0;left:0;width:100%;height:100%;border:0px;">
									</iframe>
								</div>
										<?php
									}
?>




<?php foreach ($result['items'] as $spin): ?>

	<?php 
	$title = htmlspecialchars($spin['title'], ENT_NOQUOTES); 
	$title = strtoupper($title); 
	$currenttitle = get_the_title();
	$currenttitle1 = substr($currenttitle , 11);
	$currenttitle2 = strtoupper($currenttitle1);
	
	if($title == $currenttitle2) {
		$playlistid = htmlspecialchars($spin['id'], ENT_NOQUOTES);
	
		
	}
	
	?>
						
<?php endforeach ?>
	
				    		</div>
				    	</div>
					</div>
				</main>
				
				
			
		
			</div>
		</div>
	</div>
<?php if(!is_front_page()): ?>
<?php // get_template_part( 'template-parts/page/content', "support" ); ?>
<?php endif; ?>

<aside class="secondary widget-area widget-area-program" role="complementary">
	<div class="widget-area-content">
		<?php dynamic_sidebar( 'sidebar-prog' ); ?>
	</div>
</aside>

<?php get_footer();