<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage KFAI
 * @since 1.0
 * @version 1.0
 */
 
get_header(); ?>

	<div class="row-section content-area clearfix" id="primary">
		<div class="container">
			<div class="row column-md-flex">
				<main id="main" class="site-main col-md-8 col-sm-7" role="main">
					<div class="main-content clearfix">

						<section class="error-404 not-found">
							<header class="page-header">
								<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'kfaitheme' ); ?></h1>
							</header><!-- .page-header -->
							<div class="page-content">
								<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'kfaitheme' ); ?></p>

								<?php get_search_form(); ?>

							</div><!-- .page-content -->
						</section><!-- .error-404 -->
					</div>
				</main><!-- #main -->

				<?php get_sidebar("blog"); ?>
			</div>
		</div>
	</div><!-- #primary -->

<?php get_footer();
