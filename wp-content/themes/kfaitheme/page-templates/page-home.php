<?php
/**
 * Template Name: Home Template
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
 
<div class="row-section page-gateway-blocks column-narrow-spaces clearfix">
	<div class="container">
		<div class="row">
			<?php
			if( have_rows('page_gateway_blocks') ):
				$cnt = 1;
				while ( have_rows('page_gateway_blocks') ) : the_row();
					$pageid = get_sub_field('page');
					$thumbid = get_post_thumbnail_id($pageid);
					$imgurl = wp_get_attachment_image_src( $thumbid , 'theme-thumbnail-440');  ?> 
					<div class="gateway-block col-md-4 eq-height">
						<div class="gb-content" style="background-image: url(<?php echo $imgurl[0]; ?>);">
							<div class="gb-detail">
								<h3><?php echo get_the_title($pageid); ?></h3>
								<p><?php /*echo get_content_limit(get_the_excerpt($pageid), 300, "...");*/echo get_the_excerpt($pageid); ?></p>
								<a href="<?php echo get_permalink($pageid); ?>" class="btn">View <?php echo get_the_title($pageid); ?></a>
							</div>
						</div>
					</div>
					<?php
					$cnt = $cnt + 1;
				endwhile;
			endif; ?>
		</div>
	</div>
</div>

<div class="row-section popular-program-categories column-narrow-spaces clearfix">
	<div class="container">
		<h2 class="page-sub-heading"><?php echo get_field("pcheading"); ?></h2>
		<div class="row">
			<?php
			if( have_rows('program_categories') ):
				$cnt = 1;
				while ( have_rows('program_categories') ) : the_row();
					$category = get_sub_field('category');
					$terms = get_term_by("term_taxonomy_id", $category , "program_cat");
					$fimg = get_field("featured_image", "program_cat_".$terms->term_id); ?> 
					<div class="gateway-block col-lg-3 col-xs-6 eq-height">
						<div class="gb-content" style="background-image: url(<?php echo $fimg["url"]; ?>);">
							<div class="gb-detail">
								<a href="<?php echo home_url(); ?>/programs/?filter=category&cat=<?php echo $terms->slug; ?>"><span><?php echo $terms->name; ?></span></a>
							</div>
						</div>
					</div>
					<?php
					$cnt = $cnt + 1;
				endwhile;
			endif; ?>
		</div>
		<div class="rs-footer text-center">
			<a href="<?php echo get_field("pcpage_url_link"); ?>">MORE PROGRAM CATEGORIES ›</a>
		</div>
	</div>
</div>

<div class="row-section support-gateways column-narrow-spaces clearfix">
    <div class="container">
        <div class="row">
            <div class="support-page-gateway col-lg-8 col-sm-6">
                <?php 
                    $donate_page_link = get_field("donate_page_link", FRONTPAGEID); 
                    $thumbid = get_post_thumbnail_id($donate_page_link);
                    $imgurl = wp_get_attachment_image_src( $thumbid , 'full'); ?>
                <div class="spg-content" style="background-image: url(<?php echo $imgurl[0]; ?>);">
                    <div class="spg-details">
                        <h3><?php echo get_field("donate_heading", FRONTPAGEID); ?></h3>
                        <p><?php echo get_field("donate_sub_heading", FRONTPAGEID); ?></p>
                        <a href="<?php echo get_permalink($donate_page_link); ?>" class="btn btn-white-bordered"><span class="fa fa-heart"></span>DONATE</a>
                    </div>
                </div>
            </div>
            <div class="support-social-gateway col-lg-4 col-sm-6">
                <div class="row">
                    <div class="support-app-gateway col-lg-6 col-xs-6 col-xxs-12 eq-height">
                        <div class="spg-content" style="background-image: url(<?php echo get_field("app_bg_image", FRONTPAGEID)["url"]; ?>);">
                            <div class="spg-details">
                                <h3><?php echo get_field("app_heading", FRONTPAGEID); ?></h3>
                                <a href="https://itunes.apple.com/us/app/kfai-public-radio-app/id658037246?mt=8"><span class="fa fa-apple"></span></a>
                                <a href="https://play.google.com/store/apps/details?id=com.skyblue.pra.kfai&feature=search_result"><span class="fa fa-android"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="support-app-gateway col-lg-6 col-xs-6 col-xxs-12  eq-height">
                        <div class="spg-content">
                            <?php echo get_field("facebook_embed_code", FRONTPAGEID); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row-section home-recent-news column-narrow-spaces clearfix">
	<div class="container">
		<h2 class="page-sub-heading"><?php echo get_field("news_heading"); ?></h2>
		<div class="row">
			<?php
			wp_reset_postdata();
			$the_query = new WP_Query( array(
				 'post_type' => 'post',
				 'post_status' => 'publish',
				 'order' => 'DESC',
				 'posts_per_page' => get_field("number_of_items_to_display")
			 ) ); 
			if ( $the_query->have_posts() ) { 
			while ( $the_query->have_posts() ) { $the_query->the_post();
			?>
				<div class="news-item col-lg-2 col-sm-4 col-xs-6 eq-height">
					<div class="ni-content">
						<div class="ni-image">
								<?php if(has_post_thumbnail()): ?>
									<?php
									$thumbid = get_post_thumbnail_id(get_the_ID());
									$imgurl = wp_get_attachment_image_src( $thumbid , 'theme-thumbnail-215'); ?>
									<a href="<?php echo get_permalink(); ?>" style="background-image: url(<?php echo $imgurl[0]; ?>);"><?php the_post_thumbnail(); ?></a>
								<?php else: ?>
									<a href="<?php echo get_permalink(); ?>" style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/default_thumb.jpg);"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/default_thumb.jpg" alt="NO IMAGE-<?php echo get_the_title(); ?>" /></a>
								<?php endif; ?>
							</a>
						</div>
						<div class="ni-detail">
							<p><?php echo get_the_date("F j, Y"); ?> <?php echo get_the_title(); ?> <a href="<?php echo get_permalink(); ?>">»</a></p>
						</div>
					</div>
				</div>
			<?php
			}
			wp_reset_postdata();
			}
			?>
		</div>
		<div class="rs-footer text-center">
			<a href="<?php echo get_field("more_news_page_url_link"); ?>">MORE NEWS ›</a>
		</div>
	</div>
</div>
<?php get_footer();
