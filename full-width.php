<?php
/*
Template Name: Full wdth
*/
?>
<?php get_header() ?>
<body id="dos">
	<?php if(!is_front_page()): ?>
    
		<div class="heading-full">
			<div class="heading-inner">
				<div id="heading-title">
					<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title() ?></a></h2>
					<?php the_breadcrumbs() ?>
				</div>
		
				<div class="clear"></div>
			</div>
		</div>
	<?php endif; ?>
	<div id="content" class="full-width">
		<div id="main">	
		<?php if(have_posts()): ?>
			<?php while(have_posts()): the_post() ?>
				<div id="post-<?php the_ID() ?>" <?php post_class('') ?>>
						<div class="post-contentfull">
						    <?php the_content() ?>
						    <div class="clear"></div>
						</div>
					    <?php wp_link_pages(array(
					    	'before'			=> '<p class="center" id="post-pager">',
					    	'after'				=> '</p>',
					    	'link_before'		=> ' ',
					    	'link_after'		=> ' ',
					    	'next_or_number'	=> 'number',
					    	'nextpagelink'		=> __('Next page &raquo;'),
					    	'previouspagelink'	=> __('&laquo; Previous page'),
					    	'pagelink'			=> '%',
					    	'more_file'			=> '',
					    	'echo'				=> 1 )
					    ); 
					    ?>
					<div class="clear"></div>
				</div>
			<?php endwhile; ?>
			<?php if(!is_front_page()) comments_template(); ?>
		<?php else: ?>
			<p>Lo sentimos no hay resultados bajo ese criterio de búsqueda.</p>
		<?php endif; ?>
		</div>
		<div class="clear"></div>
	</div>
<?php get_footer() ?>