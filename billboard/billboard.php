<?php
	$bb = maybe_unserialize(get_option(UDS_BILLBOARD_OPTION));
	
	if(!empty($bb)):
?>
	<div id="uds-billboard-wrapper">
		<div id="uds-loader"><div id="uds-progress"></div></div>
		<div id="uds-next-slide"></div>
		<div id="uds-billboard">
			<?php foreach($bb as $b): ?>
				<?php if($b->image != ''): ?>
					<div class="uds-slide">
						<input type="hidden" class="uds-billboard-option" name="uds-billboard-delay" value="<?php echo $b->delay ?>" />
						<input type="hidden" class="uds-billboard-option" name="uds-billboard-transition" value="<?php echo $b->transition ?>" />
						<input type="hidden" class="uds-billboard-option" name="uds-billboard-layout" value="<?php echo $b->layout ?>" />
						<img src="<?php echo $b->image ?>" alt="" />
						<div class="uds-descr-wrapper">
							<div class="uds-descr">
								<?php if(stripslashes($b->title) != ''): ?><h2><?php echo htmlspecialchars(stripslashes($b->title))?></h2>
								<?php endif; ?>
								<?php echo htmlspecialchars(stripslashes($b->text)) ?>
								<?php if(stripslashes($b->link) != ''): ?><a href="<?php echo htmlspecialchars(stripslashes($b->link))?>" class="read-more">Ver más</a><?php endif; ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
		<div id="uds-billboard-controls"></div>
	</div>
</div>
<?php endif; ?>