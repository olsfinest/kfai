<?php
/**
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
 
	<div class="row-section content-area tpl-has-sidebar clearfix" id="primary">
		<div class="container">
			<div class="row column-md-flex">
				<main id="main" class="site-main col-md-8 col-sm-7" role="main">
					<div class="main-content clearfix">
				    <?php // Show the selected frontpage content.
						if ( have_posts() ) :
							while ( have_posts() ) : the_post();

								get_template_part( 'template-parts/page/content', 'page' );

								do_action('Theme_module_content');
							endwhile;
						else : // I'm not sure it's possible to have no posts when this page is shown, but WTH.
							get_template_part( 'template-parts/post/content', 'none' );
						endif; ?>
					</div>
				</main><!-- #main -->

				<?php get_sidebar(); ?>
			</div>
		</div>
	</div><!-- #primary -->

<?php if(!is_front_page()): ?>
	<?php get_template_part( 'template-parts/page/content', "support" ); ?>
<?php endif; ?>


<?php get_footer();
