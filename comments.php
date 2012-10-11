<div id="comments-wrapper">
<?php if(have_comments()): ?>
	<div id="comments">
		<h3>Comentarios</h3>
		<?php 
		wp_list_comments(array(
			'avatar_size'=>128,
			'style'=> 'div',
			'callback'=>'uds_comment'
		)); 
		?>
	</div>
	<div>
		<div class="align-left"><?php previous_comments_link() ?></div>
		<div class="align-right"><?php next_comments_link() ?></div>
	</div>
	<div class="clear"></div>
<?php else: ?>	
	<?php if(comments_open()): ?>
		<p class="comment-info">No hay comentarios</p>
	<?php else: ?>
		<!-- <p class="comment-info">Comments are closed</p> -->
	<?php endif; ?>
<?php endif; //have comments?>		
	<hr class="comment-divider" />
<?php if(comments_open()): ?>
	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<p>
			<a href="<?php echo wp_login_url( get_permalink() ); ?>">Log in</a> <?php wp_register(' or ', '');?> para enviar un comentario
		</p>
	<?php else : ?>
		<?php if ( is_user_logged_in() ) : ?>
			<p>Logeado como
				<a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. 
				<a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a>
			</p>
		<?php endif; ?>
		<div id="respond">
			<h3><?php comment_form_title('Dejar un comentario', 'Reply to %s') ?></h3>
			<form method="post" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" id="add-comment">
    			<fieldset>
    				<?php comment_id_fields(); ?>
    				<?php if( is_user_logged_in() ): ?>
					<?php global $current_user; ?>
    				<?php wp_get_current_user(); ?>
    				<input type="hidden" name="author" value="<?php echo $current_user->display_name ?>" />
    				<input type="hidden" name="email" value="<?php echo $current_user->user_email ?>" />
   			 		<?php else: ?>
    				<div>
    					<label>Nombre:</label>
    					<input type="text" class="input-text" name="author" />
    				</div>
    				<div>
    					<label>Email:</label>
    					<input type="text" class="input-text" name="email" />
   			 		</div>
   			 		<?php endif; ?>
    				<div>
    					<label>Comentario:</label>
    					<textarea rows="3" cols="54" name="comment" class="comment-text" id="comment"></textarea>
    				</div>
    				<div class="buttons">
    					<button type="reset">Borrar</button>
    					<button type="submit">Enviar</button>
    					<div class="cancel-comment-reply">
						<small><?php cancel_comment_reply_link(); ?></small>
						</div>
    				</div>
    			</fieldset>
			</form>
			
		</div>
	<?php endif; // If registration required and not logged in ?>
<?php endif; ?>
</div>
<div class="clear"></div>