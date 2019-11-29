<?php
/**
 * Template Name: Scripts Template
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
 
	<div class="row-section content-area clearfix" id="primary">
		<div class="container">
			<div class="row">
				<main id="main" class="site-main col-lg-12" role="main">
					<div class="main-content clearfix">
				    <?php
						if ( have_posts() ) :
							while ( have_posts() ) : the_post();

								get_template_part( 'template-parts/page/content', 'page' );

								do_action('cfunc_content');
							endwhile;
						else : 
							get_template_part( 'template-parts/post/content', 'none' );
						endif; ?>

						<script type="text/javascript" src="https://www.iatspayments.com/AURA/AURA.aspx?PID=PAB60EFE17E1774E2B"></script>


<script type="text/javascript" src="https://www.iatspayments.com/AURA/AURA.aspx?PID=PA9301511CA555911C"></script>
					</div>
				</main><!-- #main -->
			</div>
		</div>
	</div><!-- #primary -->

<?php get_footer();
