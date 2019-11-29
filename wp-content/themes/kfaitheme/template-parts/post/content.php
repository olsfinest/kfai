<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage KFAI
 * @since 1.0
 * @version 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class("item-post clearfix wow fadeInUp"); ?>>
	<?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'dt-thumbnail-md' ); ?>
			</a>
		</div><!-- .post-thumbnail -->
	<?php endif; ?>

	<header class="entry-header">
		<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Read More › <span class="screen-reader-text"> "%s"</span>', 'kfaitheme' ),
				get_the_title()
			) );

			wp_link_pages( array(
				'before'      => '<div class="page-links">' . __( 'Pages:', 'kfaitheme' ),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->
	<div class="entry-footer clearfix">
		<a class="more" href="<?php echo get_permalink(); ?>">Read More ›</a>
		<div class="entry-share">
			<?php echo do_shortcode("[wp_social_sharing social_options='facebook,twitter,googleplus,linkedin,pinterest,xing,reddit' twitter_username='arjun077' facebook_text='' twitter_text='' googleplus_text='' linkedin_text='' pinterest_text='' xing_text='' reddit_text='' icon_order='f,t,g,l,p,x,r' show_icons='1' before_button_text='Share: ' text_position='' social_image='']
"); ?>
		</div>
	</div>
</article><!-- #post-## -->


