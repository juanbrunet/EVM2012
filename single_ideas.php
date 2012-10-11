
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
						<div class="post-content">
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
                          <div class="post-side"> 
<p style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; color:#000"><b>CONTENIDO RELACIONADO</b></p>
<h6 class="articulos">Artículos</h6>
<?php	
$category = get_the_category($post->ID);
$current_post = $post->ID;
$posts = get_posts('numberposts=3&category=' . $category[0]->cat_ID . '&exclude=' . $current_post);
?>
<ul>
<?php
foreach($posts as $post) {
?>
    <li><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
<?php
}
?>
</ul>


        <h6 class="proyectos">Proyectos</h6>
		<ul>
<a>No hay contenido relacionados</a>
</ul>
        <h6 class="ideas">Generador de ideas</h6>
		<ul>
<a>No hay contenido relacionados</a>
</ul>
        <h6 class="otross">Otros artículos del autor</h6>
<ul><?php echo do_shortcode('[latestbyauthor]'); ?> </ul></div>
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