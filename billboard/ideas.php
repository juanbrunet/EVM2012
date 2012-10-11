<?php /* Template Name: Ideas */ ?>

<body id="tres"><?php if(is_ajax()):?>

  <?php the_post(); the_content(); ?>
  <? else : ?>

  <?php get_header() ?>
	  

	  
  <?php rewind_posts() ?>



		<div class="heading-full">
			<div class="heading-inner">
				<div id="heading-title">
                <h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title() ?></a></h2>
					<?php the_breadcrumbs() ?>
                
				</div>
		
				<div class="clear"></div>
			</div>
		</div>
<div id="content" class="full-width">

<div style="text-align:center;">
                
 <ul id="menu" style="padding:0; margin:0;">
		
	<?php wp_list_categories('sort_column=name&child_of=129&sort_order=asc&style=list&children=true&hierarchical=true&title_li=0'); ?>
    </ul> </div>
 <div class="clear"></div>
<div id="mainp">


	<?php
query_posts('cat=129');?>
	<?php while (have_posts()) : the_post();?>


<div class="postp">
					<h3 class="post-heading"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
                    <div class="entryDate">
                     <span class="postDay"><?php the_time('d') ?></span>
                     <span class="postMonth"><?php the_time('M') ?></span>
                     <span class="postYear"><?php the_time('Y') ?></span>
   
  
  
</div>

			   		 <div class="post_info">
            	</div>
			   		
			   		<div class="post-contentp">
					    <?php the_excerpt() ?>
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
			
					    <?php endif; ?>
					    <?php comments_template() ?>
					<?php endif; ?>
					<div class="clear"></div>
				</div>
			<?php endwhile; ?>
			<div class="post-pages">
			    <div class="pages-prev"><?php next_posts_link(__("&laquo; Older entries"))?></div>
			    <div class="pages-next"><?php previous_posts_link(__("Newer entries &raquo;"))?></div>
			    <div class="clear"></div>
			</div>
		
			
		<?php endif; ?>
	</div>
	
	<div class="clear"></div>
</div>
<?php get_footer() ?>
