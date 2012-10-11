<?php /* Template Name: Mercados */ ?>
<body id="tres"><?php if(is_ajax()):?>

  <?php the_post(); the_content(); ?>
  <? else : ?>

  <?php get_header() ?>
	  

	  
  <?php rewind_posts() ?>
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
	<p><br />
	  <br />
</p>
<div id="content">
<div id="main">

	<?php
query_posts('cat=193');?>
	<?php while (have_posts()) : the_post();?>


<div id="post-<?php the_ID() ?>" <?php post_class('') ?>>
					<h3 class="post-heading"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
                    <div class="entryDate">
                     <span class="postDay"><?php the_time('d') ?></span>
                     <span class="postMonth"><?php the_time('M') ?></span>
                     <span class="postYear"><?php the_time('Y') ?></span>
   
  
  
</div>
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
<?php	
		$conexion = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
		mysql_select_db(DB_NAME, $conexion);

		$consulta = "SELECT * FROM wp_posts WHERE post_type = 'uds-portfolio' ORDER BY id LIMIT 3";
		$resultados = mysql_query($consulta);
		
?>
<ul>
<?php
while ($p = mysql_fetch_assoc($resultados)) {
?>
    <li><a href="?uds-portfolio=<?php echo $p["post_name"]; ?>" title="<?php echo $p["post_title"]; ?>"><?php echo $p["post_title"]; ?></a></li>
<?php
}
?>
</ul>
        <h6 class="ideas">Generador de ideas</h6>
<?php	
$category = get_the_category($post->ID);
$current_post = $post->ID;
$posts = get_posts('numberposts=4&category=8&exclude=' . $current_post);
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
        <h6 class="otross">Otros artículos del autor</h6>
<ul><?php echo do_shortcode('[latestbyauthor]'); ?> </ul></div>
			   		 <div class="post_info">
            	<ul> 
                <li><img src="<?php echo  get_template_directory_uri() . "/images/author.png" ?>" class="meta-img" alt="" /> Autor:  <?php the_author(); ?> </li>
                         <li><?php echo get_the_category_list('');?></li>
                   
                    <?php if( has_tag() )  { ?>
						<li><?php echo the_tags(__('Tags: '), ', '); ?></li>
					<?php } ?>
                    
                    
                    
                </ul></div>
			   		<?php uds_the_post_thumbnail(get_the_ID(), 240, 160) ?>
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
			    <div class="pages-prev"><?php next_posts_link(__("&laquo; Older entries"))?></div>
			    <div class="pages-next"><?php previous_posts_link(__("Newer entries &raquo;"))?></div>
			    <div class="clear"></div>
			</div>
		
			
		<?php endif; ?>
	</div>
	<?php get_sidebar(); ?>
	<div class="clear"></div>
</div>
<?php get_footer() ?>
