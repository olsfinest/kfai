<?php /* Template Name: Page Cron */ 
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
						
						<?php
						
						$_SERVER['DOCUMENT_ROOT'];
						
						
						
						
						$rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('/mnt/data/vhosts/casite-811391.cloudaccess.net/httpdocs/mp3list/'));

						$files = array(); 

						foreach ($rii as $file) {

							if ($file->isDir()){ 
								continue;
							}

							$files[] = $file->getPathname(); 

						}



						print_r($files);
												
					
						?>
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
