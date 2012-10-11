<div <?php comment_class();?> id="comment-<?php comment_ID(); ?>">
	<?php echo get_avatar($comment, '80', get_template_directory_uri().'/images/avatar.jpg')?>
    
	<div class="comment-meta">
		<p class="comment-author"><?php comment_author(); ?></p>
		<p class="comment-date"><?php comment_time('d/m/Y | H:i:s'); ?></p>
		<div class="clear"></div>
	</div>
	<div class="comment-text">
		<?php comment_text(); ?>
		<p class="comment-action"><?php comment_reply_link(array_merge(  $args, array('depth' => $depth, 'max_depth' => $args['max_depth'])))  ?><p><br />
		<p class="comment-action"><?php edit_comment_link(__('(Edit)'),'','') ?></p>
	</div>
	
	<div class="clear"></div>