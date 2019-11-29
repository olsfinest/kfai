<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage KFAI
 * @since 1.0
 * @version 1.0
 */

?>

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