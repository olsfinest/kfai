<?php
/**
 * Displays top navigation
 *
 * @package WordPress
 * @subpackage KFAI
 * @since 1.0
 * @version 1.0
 */

?>
<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php _e( 'Top Menu', 'kfaitheme' ); ?>">
	<?php wp_nav_menu( array(
		'theme_location' => 'primary',
		'menu_id'        => 'primary-menu',
		'depth'          => 1,
		'container' => false,
		"link_before" => "<span>",
		"link_after" => "</span>",
	) ); ?>
</nav><!-- #site-navigation -->
