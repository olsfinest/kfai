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

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php //if(!is_front_page()): ?>
		<header class="page-header">
			<h1 class="page-title"><?php echo get_custom_title(get_the_ID()); ?></h1>
		</header><!-- .page-header -->
	<?php //endif; ?>
	<div class="page-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'kfaitheme' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .page-content -->
</article><!-- #post-## -->
