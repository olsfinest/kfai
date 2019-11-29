<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage KFAI
 * @since 1.0
 * @version 1.0
 */

?>




        </div>

        <div class="row-section-wrap site-footer off-canvas-move clearfix" id="footer">
            <div class="row-section footer-backtotop clearfix">
                <div class="container">
                    <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrows-back.png" alt=""></a>
                </div>
            </div>
            <div class="row-section footer-top clearfix wow fadeIn">
                <div class="container">
                    <div class="site-socials">
                        <a href="https://www.facebook.com/kfaiFMradio/" target="_blank"><span class="fa fa-facebook-square"></span></a>
                        <a href="https://twitter.com/kfaifmradio" target="_blank"><span class="fa fa-twitter-square"></span></a>
                        <a href="/feed" target="_blank"><span class="fa fa-rss-square"></span></a>
                    </div>
                    <?php wp_nav_menu( array(
                        'theme_location' => 'footer',
                        'menu_id'        => 'footer-menu',
                        'depth'          => 1,
                        'container' => false,
                    ) ); ?>
                </div>
            </div>
            <div class="row-section footer-bottom clearfix">
                <div class="container">
                    <span class="attribution line">&copy; <?php echo date('Y') ."&nbsp;". esc_attr( get_bloginfo( 'name', 'display' ) ); ?> &dash; All Rights Reserved.</span>
                    <span class="site-location line">1808 Riverside Avenue, Minneapolis, MN 55454 P: 612-341-3144</span>
                    <span class="sep line">|</span>
                    <a href="/about/privacy" class="line">Privacy Statement</a>
                    <span class="sep line">|</span>
                    <a href="https://publicfiles.fcc.gov/fm-profile/kfai" target="_blank" class="line">FCC Public Profile</a>
					<span class="sep line">|</span>
					<span class="site-websiteby">Website by <a target="_blank" href="https://www.skolmarketing.com/">Skol Marketing</a></span>
                </div>
            </div>
        </div>
    </div>
    <div id="loading"></div>
    <?php wp_footer(); ?>
    <script type="text/javascript">
        (function($){
            $(window).bind("load",function(){
                $('#loading').fadeOut("slow");

                var d = new Date();
                var n = d.getDay(); 
                $( "#tabs" ).tabs({
                  active: n
                });
            });
        })(jQuery);

        wow = new WOW({
            boxClass:     'wow',
            animateClass: 'animated',
            offset:       100
        });
        wow.init();
    </script>
    </body>
</html>
