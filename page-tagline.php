<?php if(!is_front_page()): ?>
	<?php 
		$tagline_type = get_post_meta($post->ID, 'uds-page-tagline-type');
		$tagline_type = $tagline_type[0];
		
		$tagline = get_post_meta($post->ID, 'uds-page-tagline');
		$tagline = $tagline[0];
	 ?>
	<?php if($tagline_type == 'default' || $tagline_type == ''): ?>
	<div class="heading">
		<div class="heading-inner">
			<div id="heading-title">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php  if (is_page()): the_title(); else: wp_title(''); endif; ?></a></h2>
				<?php the_breadcrumbs() ?>
			</div>
	
			<div class="clear"></div>
		</div>
	</div>
	<?php elseif($tagline_type == 'custom'): ?>
	<div class="heading">
		<div class="heading-inner">
			<div id="heading-title">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php if(is_search()): echo "Search"; elseif(is_page()): the_title(); else: wp_title(''); endif; ?></a></h2>
				<?php the_breadcrumbs() ?>
			</div>
			<div class="custom-tagline"><?php echo $tagline ?></div>
			<div class="clear"></div>
		</div>
	</div>
	<?php endif;?>
<?php endif; ?>