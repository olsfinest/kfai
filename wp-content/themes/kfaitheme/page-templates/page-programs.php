<?php
/**
 * Template Name: Programs Template
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

	get_header();

	$origid = get_the_ID(); 
?>

<div class="row-section search-filters program-search-filters column-narrow-spaces clearfix">
	<div class="container">
		<div class="row">
			<div class="col-lg-10">
				<div class="row">
					<div class="col-filter filter-search col-lg-3 col-xs-6">
						<form id="filterform-search" role="search" class="search-form" method="GET">
							<input type="search" class="search-field text-search" value="<?php echo isset( $_REQUEST[ 'search' ] ) ? $_REQUEST[ 'search' ] : ''; ?>" name="search" placeholder="Search" />
							<button type="submit" class="search-submit" id="submit-search"><span class="fa fa-search"></span></button>  
						</form>
					</div>
					<div class="col-filter filter-alpha col-lg-3 col-xs-6">
						<form id="filterform-order" class="search-form" method="GET">
							<input type="hidden" name="filter" value="alphabitical" />
							<select name="programorder" id="orderalphabetical" class="selectpicker">
								<option value="alpha|ASC">Sort</option>
								<option value="alpha|ASC" <?php echo isset( $_REQUEST[ 'order' ] ) && $_REQUEST[ 'order' ] == "alpha|ASC" ? "selected" : ''; ?>>Alphabetically: Ascending</option>
								<option value="alpha|DESC" <?php echo isset( $_REQUEST[ 'order' ] ) && $_REQUEST[ 'order' ] == "alpha|DESC" ? "selected" : ''; ?>>Alphabetically: Decending</option>
								<option value="starttime|ASC" <?php echo isset( $_REQUEST[ 'order' ] ) && $_REQUEST[ 'order' ] == "starttime|ASC" ? "selected" : ''; ?>>Start Time: Ascending</option>
								<option value="starttime|DESC" <?php echo isset( $_REQUEST[ 'order' ] ) && $_REQUEST[ 'order' ] == "starttime|DESC" ? "selected" : ''; ?>>Start Time: Decending</option>
							</select>
						</form>
					</div>
					<div class="col-filter filter-day col-lg-3 col-xs-6">
						<form id="filterform-day" class="search-form" method="GET">
							<input type="hidden" name="filter" value="day" />
							<select name="day" id="filterbyday" class="selectpicker">
								<option value="">Filter by Day</option>
								<option value="0" <?php echo isset( $_REQUEST[ 'day' ] ) && $_REQUEST[ 'day' ] == "0" ? "selected" : ''; ?>>Sunday</option>
								<option value="1" <?php echo isset( $_REQUEST[ 'day' ] ) && $_REQUEST[ 'day' ] == "1" ? "selected" : ''; ?>>Monday</option>
								<option value="2" <?php echo isset( $_REQUEST[ 'day' ] ) && $_REQUEST[ 'day' ] == "2" ? "selected" : ''; ?>>Tuesday</option>
								<option value="3" <?php echo isset( $_REQUEST[ 'day' ] ) && $_REQUEST[ 'day' ] == "3" ? "selected" : ''; ?>>Wednesday</option>
								<option value="4" <?php echo isset( $_REQUEST[ 'day' ] ) && $_REQUEST[ 'day' ] == "4" ? "selected" : ''; ?>>Thursday</option>
								<option value="5" <?php echo isset( $_REQUEST[ 'day' ] ) && $_REQUEST[ 'day' ] == "5" ? "selected" : ''; ?>>Friday</option>
								<option value="6" <?php echo isset( $_REQUEST[ 'day' ] ) && $_REQUEST[ 'day' ] == "6" ? "selected" : ''; ?>>Saturday</option>
							</select>
						</form>
					</div>
					<div class="col-filter filter-time col-lg-3 col-xs-6">
						<form id="filterform-starttime" class="search-form" method="GET">
							<input type="hidden" name="filter" value="starttime" />
							<select name="starttime" id="filterbystarttime" class="selectpicker">
								<option value="">Filter by Start Time</option>
								<option value="00:00:00">12 am</option>
								<option value="01:00:00">1 am</option>
								<option value="02:00:00">2 am</option>
								<option value="03:00:00">3 am</option>
								<option value="04:00:00">4 am</option>
								<option value="05:00:00">5 am</option>
								<option value="06:00:00">6 am</option>
								<option value="07:00:00">7 am</option>
								<option value="08:00:00">8 am</option>
								<option value="09:00:00">9 am</option>
								<option value="10:00:00">10 am</option>
								<option value="11:00:00">11 am</option>
								<option value="12:00:00">12 pm</option>
								<option value="13:00:00">1 pm</option>
								<option value="14:00:00">2 pm</option>
								<option value="15:00:00">3 pm</option>
								<option value="16:00:00">4 pm</option>
								<option value="17:00:00">5 pm</option>
								<option value="18:00:00">6 pm</option>
								<option value="19:00:00">7 pm</option>
								<option value="20:00:00">8 pm</option>
								<option value="21:00:00">9 pm</option>
								<option value="22:00:00">10 pm</option>
								<option value="23:00:00">11 pm</option>
							</select>
						</form>
					</div>
				</div>
			</div>
			<div class="col-lg-2">
				<div class="col-filter"><a href="<?php echo get_the_permalink(); ?>" class="btn" id="filterclear">Clear Filters</a></div>
			</div>
		</div>
	</div>
</div>

<?php
	$ignore_programs = array();

	$onaircurid = kfai_get_on_air_now();

	array_push($ignore_programs, $onaircurid);

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$args = array(
		'posts_per_page' => 12,
		'post_type' => 'program',
		'post_status' => 'publish',
		'suppress_filters' => true,
		'paged' => $paged,
		'order' => 'ASC',
		'orderby' => 'title',
		'post__not_in' => $ignore_programs,
	);

	$results = new WP_Query($args);

	$progs = array();
	$progcount = 0;
?>

<div class="row-section program-gateway-blocks column-narrow-spaces clearfix">
	<div class="container">
		<div id="filter-initial-results" class="row">
			<div class="filteroverlayloadmore"></div>

			<div class="column-md-flex">
				<div class="gateway-block gateway-block-lg col-md-6">
					<?php kfai_print_program_block($onaircurid, "ON AIR NOW:"); ?>
				</div>

				<div class="col-md-6">
					<div class="row">
						<?php
							for($i=0;$i<4;$i++)
							{
								$results->the_post();
								
								?>
									<div class="gateway-block gateway-block-sm col-xs-6  eq-height">
										<?php kfai_print_program_block(get_the_ID(), ""); ?>
									</div>
								<?php
							}
						?>
					</div>
				</div>
			</div>
			<div class="wrap-program-posts">
				<?php
					for($i=4;$i<12;$i++)
					{
						$results->the_post();
						
						?>
							<div class="gateway-block program-post gateway-block-sm col-md-3 col-xs-6 eq-height">
								<?php kfai_print_program_block(get_the_ID(), ""); ?>
							</div>
						<?php
					}
				?>
			</div>
			<?php
				echo '<div class="filter-filter-navigation">';
		        $big = 999999999;
		        echo paginate_links( array(
		            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		            'format' => '?paged=%#%',
		            'current' => max(1, $paged),
		            'total' => $results->max_num_pages
		        ) );
		        echo '</div>';
			?>
			<!--
			<nav class="post-pagination post-pagination-program text-center clearfix">
				<ul class="nav-links nav-links-program">
					<li class="previous previous-program"><?php echo get_previous_posts_link('Recent Post &raquo;'); ?></li>
					<li class="next next-program"><?php echo get_next_posts_link('&laquo; Older Post', $wp_query2->max_num_pages); ?></li>
				</ul>
			</nav>-->
		</div><?php wp_reset_query(); ?>
		<div id="filter-results" class="row">
			<div class="filterloadmore"></div>
		</div>
	</div>
</div>


<?php if(!is_front_page()): ?>
<?php get_template_part( 'template-parts/page/content', "support" ); ?>
<?php endif; ?>

<?php
	wp_reset_postdata();

	get_footer();
?>