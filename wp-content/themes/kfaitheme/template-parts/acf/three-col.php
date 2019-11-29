<div class="section-content flex-content-three-column clearfix">
	<div class="row">
		<?php
		if( have_rows('three_column_content') ):
			$cnt = 1;
			while ( have_rows('three_column_content') ) : the_row();
				$tcctitle = get_sub_field('title');
				$tcccontent = get_sub_field('thcccontent');
				?> 
					<div class="col col-md-4">
						<div class="col-content">
							<?php if($tcctitle):?><h2><?php echo $tcctitle; ?></h2><?php endif; ?>
							<?php echo $tcccontent; ?>
						</div>
					</div>
				<?php
				$cnt = $cnt + 1;
			endwhile;
		endif;
		?>
	</div>
</div>