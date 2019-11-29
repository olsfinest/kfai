<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage KFAI
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>	

</head>

<body <?php body_class("off-canvas-site"); ?>>
<div id="wptime-plugin-preloader"></div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
 
<?php global $post; ?>

<?php if(!is_front_page()): ?>
	<?php if($post->post_parent): ?>
		<div id="page" class="site tpl-default tpl-has-parent off-canvas-page">
	<?php else: ?>
		<div id="page" class="site tpl-default off-canvas-page">
	<?php endif; ?>
<?php else: ?>
	<div id="page" class="site tpl-home off-canvas-page">
<?php endif; ?>

	<div class="row-section-wrap clearfix" id="header">
		<div class="row-section header-top off-canvas-move clearfix">
			<div class="container">
				<?php wp_nav_menu( array(
					'theme_location' => 'top',
					'menu_id'        => 'top-menu',
					'depth'          => 1,
					'container' => false,
				) ); ?>
			</div>
		</div>
		<div class="row-section header-main off-canvas-move clearfix">
			<div class="container">
				<?php get_template_part( 'template-parts/header/header', 'logo' ); ?> 
				<div class="now-broadcasting-btn">
					
				
					<a href="javascript://" onclick="window.open('/jplayer/jquery.html','jplayer','width=380,height=280');" class="">
						<span class="btn">Now BroadCasting</span>
						<span class="txt">
							<?php 
								$onairnow = kfai_get_on_air_now();
							
								echo get_the_title($onairnow);
							?>
						</span>
					</a>
					<span class="txt">
						<?php
							$djs_obj = get_field('djs', $onairnow);

							if($djs_obj)
							{
								$cnt = 1;

								foreach($djs_obj as $dj)
								{
									setup_postdata($dj);

									if($cnt > 1)
									{
										echo ", ";
									}

									?>
										<a href="<?php echo get_permalink($dj->ID); ?>" style="background:none!important;"><?php echo get_field("name", $dj->ID) ? get_field("name", $dj->ID) : get_the_title($dj->ID); ?></a>
									<?php

									$cnt = $cnt + 1;
								}

								wp_reset_postdata();
							}
						
							if(time() - get_option('kfai_nowplaying_timestamp', 0) < 300)
							{
								echo "<br />".get_option('kfai_nowplaying_artist', 0)." - ".get_option('kfai_nowplaying_song', 0);
							}
						?>
					</span>
				</div>

				<div class="playlists-donate-btns">
					<a href="https://spinitron.com/KFAI/" class="playlist-btn"><span class="fa fa-headphones"></span>Playlists</a>
					<a href="<?php echo home_url(); ?>/donate/" class="donate-btn"><span class="fa fa-heart"></span>Donate</a>
				</div>
			</div>
		</div>
		<div class="row-section header-menu clearfix">
			<div class="container">
				<div class="off-canvas-move clearfix">
					<button type="button" class="navbar-toggle">
						<span class="fa fa-bars"></span>
					</button>
					<a href="#" class="nav-btn-search"><span class="fa fa-search"></span></a>
				</div>
				<div class="site-product-search">
		        	<?php get_search_form(); ?>
		        </div>
				<div id="navigation" class="navigation off-canvas-nav clearfix">
					<div class="playlists-donate-btns">
						<a href="#" class="playlist-btn"><span class="fa fa-headphones"></span>Playlists</a>
						<a href="#" class="donate-btn"><span class="fa fa-heart"></span>Donate</a>
					</div>
					<?php wp_nav_menu( array(
						'theme_location' => 'top',
						'menu_id'        => 'top-menu',
						'depth'          => 1,
						'container' => false,
					) ); ?>
		        	<?php get_template_part( 'template-parts/header/navigation', 'top' ); ?>

		        </div> 
			</div>  
		</div>
   </div>

   <div class="row-section-wrap off-canvas-move clearfix" id="site-content-contain">
	   <?php if(!is_front_page()): ?>
	   <?php if(get_field("add_page_slider")): ?>
	<div class="row-section page-slider clearfix">
		<div class="page-slider-full-carousel slider-slider">
			<?php
			if( have_rows('pageslides') ):
				$cnt = 1;
				while ( have_rows('pageslides') ) : the_row();
					$slide_image = get_sub_field('slide_image');
					$slide_headline = get_sub_field('slide_headline');
					$slide_description = get_sub_field('slide_description');
					$button_link_url = get_sub_field('button_link_url');
					$button_link_text = get_sub_field('button_link_text'); ?> 
					<div class="page-slide">
						<div class="slide-img" style="background-image: url(<?php echo $slide_image["sizes"]["theme-featured-banner"]; ?>);">
							<img src="<?php echo $slide_image["sizes"]["theme-featured-banner"]; ?>" alt="<?php echo $slide_image["alt"]; ?>" />
						</div>
						<div class="slide-caption">
							<div class="container">
								<div class="slide-caption-details">
								<div class="slide-caption-details-inner">
									<h2><?php echo $slide_headline; ?></h2>
									<?php echo $slide_description; ?>
									<div class="slide-link">
										<a href="<?php echo $button_link_url; ?>"><?php echo $button_link_text; ?></a>
									</div>
								</div>
								</div>
							</div>
						</div>
					</div>
					<?php
					$cnt = $cnt + 1;
				endwhile;
			endif; ?>
		</div>
	</div>
<?php endif; ?>
	   <?php endif; ?>
