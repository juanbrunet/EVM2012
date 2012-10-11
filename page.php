
<?php get_header() ?>
<body id="dos">
 

	<?php include 'page-tagline.php' ?>
	<div id="content">
		<div id="main">	
        <div class="post-side"> 
<p style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; color:#000"><b>CONTENIDO RELACIONADO</b></p>
<<h6 class="articulos">Artículos</h6>
<ul>
  <?php do_action(
    'related_posts_by_category',
    array(
      'orderby' => 'post_date',
      'order' => 'DESC',
      'limit' => 5,
      'echo' => true,
     
      'inside' => '&raquo; ',
      'outside' => '',
      'after' => '<br>',
      'rel' => 'nofollow',
      'type' => 'post',
     
      'message' => 'No matches'
    )
  ) ?>
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
					<div class="clear"></div>
				</div>
			<?php endwhile; ?>
			<?php if(!is_front_page()) comments_template(); ?>
		<?php else: ?>
			<p>Lo sentimos no hay resultados bajo ese criterio de búsqueda.</p>
		<?php endif; ?>
		</div>
		<?php get_sidebar(); ?>
		<div class="clear"></div>
	</div>
<?php get_footer() ?>