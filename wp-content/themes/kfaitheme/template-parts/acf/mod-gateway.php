<div class="module widget-page-gateway-content widget-image-content clearfix">

	<div class="row-section popular-program-categories column-narrow-spaces clearfix">
			<div class="row">
				<?php
				if( have_rows('gateway_blocks_gateway_blocks') ):
					while ( have_rows('gateway_blocks_gateway_blocks') ) : the_row();
						$boxc = get_sub_field('block_boxes');
						if( have_rows('block_boxes') ):
							$cnt = 1;
							$row_count = count($boxc);
							$sls = "col-lg-4 col-sm-4";
							if($row_count == 2){
								$sls = "col-sm-6";
							}else{
								$sls = "col-lg-4 col-sm-4";
							}
							while ( have_rows('block_boxes') ) : the_row();
								$block_title = get_sub_field('block_title');
								$block_image = get_sub_field('block_image');
								$page_link = get_sub_field('page_link'); ?> 
								<div class="gateway-block <?php echo $sls; ?> eq-height">
									<div class="gb-content" style="background-image: url(<?php echo $block_image["url"]; ?>);">
										<div class="gb-detail">
											<a href="<?php echo $page_link; ?>"><span><?php echo $block_title; ?></span></a>
										</div>
									</div>
								</div>
								<?php
								$cnt = $cnt + 1;
							endwhile;
						endif;
					endwhile;
				endif; ?>
			</div>
	</div>

</div>