<?php
function cfunc_acf_content(){
if( have_rows('modules') ):

    while( have_rows('modules') ) : the_row();
		
		$layout = get_row_layout();
		
		switch ( $layout ) {
			case 'divider':
				include(locate_template('template-parts/acf/mod-divider.php'));
				break;
			case 'fullwidth_content':
				include(locate_template('template-parts/acf/mod-text.php'));
				break;
			case 'Sub_title':
				include(locate_template('template-parts/acf/mod-sub-heading.php'));
				break;
			case 'gateway_blocks':
				include(locate_template('template-parts/acf/mod-gateway.php'));
				break;
			case 'contentaccordion':
				if( have_rows('list_items') ): ?>
				<div class="accordion content-accordion">
				<?php
				while ( have_rows('list_items') ) : the_row();
				$liheading = get_sub_field('liheading');
				$liheading = $liheading ? $liheading : "-";
				$licontent = get_sub_field('licontent');
				?> 
				<h3 class="liheading"><?php echo $liheading; ?></h3>
				<div class="licontent"><?php echo $licontent; ?></div>
				<?php
				endwhile; ?>
				</div>
				<?php
				endif;
				break;
		}
	endwhile;
endif;
}
add_action('Theme_module_content','cfunc_acf_content');