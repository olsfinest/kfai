<div class="section-content flex-content flex-content-fullwidth">
	<?php if(get_sub_field("fulltitle", get_the_ID())):?><h2><?php echo get_sub_field("fulltitle", get_the_ID()); ?></h2><?php endif; ?>
	<?php echo get_sub_field("full_width_content", get_the_ID()); ?>
</div>