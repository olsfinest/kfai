<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage KFAI
 * @since 1.0
 * @version 1.0
 */

if ( ! is_active_sidebar( 'sidebar-blog' ) ) {
	return;
}
?>
 
<aside id="secondary" class="widget-area widget-area-blog col-md-4 col-sm-5 col-sm-pad-0" role="complementary">
	<div class="widget-area-content">
		<?php dynamic_sidebar( 'sidebar-blog' ); ?>
	</div>
</aside><!-- #secondary -->
