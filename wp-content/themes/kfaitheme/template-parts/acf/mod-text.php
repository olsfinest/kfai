<?php
if ( ! get_sub_field( 'content' ) ) {
	return;
} 
?>
	<div class="module text-content clearfix wow fadeIn">
		<div class="module-content">
			<?php echo get_sub_field( 'content' ); ?>
		</div>
	</div>