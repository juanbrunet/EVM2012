
<?php get_header() ?>
<body id="dos">
 

	<?php include 'page-tagline.php' ?>
	<div id="content">
		<div id="main">
		
	
		<?php if(have_posts()): ?>
			<?php while(have_posts()): the_post() ?>
<div id="post-<?php the_ID() ?>" <?php post_class('') ?>>
					<h3 class="post-heading"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
                    <div class="entryDate">
                     <span class="postDay"><?php the_time('d') ?></span>
                     <span class="postMonth"><?php the_time('M') ?></span>
                     <span class="postYear"><?php the_time('Y') ?></span>
   
  
  
</div>

			   		 <div class="post_info">
            	<ul> 
                <li><img src="<?php echo  get_template_directory_uri() . "/images/author.png" ?>" class="meta-img" alt="" /> Autor:  <?php the_author(); ?> </li>
                         <li><?php echo get_the_category_list('');?></li>
                   
                    <?php if( has_tag() )  { ?>
						<li><?php echo the_tags(__('Tags: '), ', '); ?></li>
					<?php } ?>
                    
                    
                    
                </ul></div>
	
			   		<div class="post-content">
					    <?php the_content() ?>
					    <div class="clear"></div>
					</div>
					<?php if(is_single()): ?>
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
					    <?php if(get_option('uds-show-authorbox') == 'on'): ?><div class="clear"></div>
					    <div id="authorbox">  					    	  
					    	<div>
					    		<?php if (function_exists('get_avatar')) { echo get_avatar(get_the_author_meta('user_email'), '80'); }?>  
					    		<h4>Acerca<a href="<?php the_author_meta('user_url'); ?>"> <?php the_author_meta('display_name'); ?></a></h4>  
					    		<p><?php the_author_meta('description'); ?></p>  
					    	</div>
					    </div>
					    <?php endif; ?>
					    <?php comments_template() ?>
					<?php endif; ?>
					<div class="clear"></div>
				</div>
			<?php endwhile; ?>
			<div class="post-pages">
			    <div class="pages-prev"><?php next_posts_link(__("&laquo; Entradas Anteriores"))?></div>
			    <div class="pages-next"><?php previous_posts_link(__("Nuevas entradas &raquo;"))?></div>
			    <div class="clear"></div>
			</div>
		<?php else: ?>
			<p>Lo sentimos no hay resultados bajo ese criterio de búsqueda.</p>
		<?php endif; ?>
	</div>
	<?php get_sidebar(); ?>
	<div class="clear"></div>
</div>
<?php get_footer() ?>
