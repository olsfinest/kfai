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

<article id="post-<?php the_ID(); ?>" <?php post_class("single-post"); ?>>

	<header class="page-header">
		<h1 class="page-title"><?php echo get_the_title(); ?></h1>
	</header><!-- .page-header -->

		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'full' ); ?>
			</a>
		</div><!-- .post-thumbnail -->

	<div class="page-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'kfaitheme' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .page-content -->
	<div class="entry-footer clearfix">
		<div class="entry-share">
			<?php echo do_shortcode("[wp_social_sharing social_options='facebook,twitter,googleplus,linkedin,pinterest,xing,reddit' twitter_username='arjun077' facebook_text='' twitter_text='' googleplus_text='' linkedin_text='' pinterest_text='' xing_text='' reddit_text='' icon_order='f,t,g,l,p,x,r' show_icons='1' before_button_text='Share: ' text_position='' social_image='']
"); ?>
		</div>
	</div>
</article><!-- #post-## -->
