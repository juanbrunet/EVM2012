
<?php get_header() ?>
<body id="dos">
 

	<?php include 'page-tagline.php' ?>
	<div id="content">
		<div id="main">
		
						  <?php if (have_posts()) : ?>
<h2><?php single_tag_title(); ?></h2><p></p>
<?php
$current_category = single_tag_title("", false);
$image = '/wp-content/uploads/images/' . strtolower(str_replace(' ', '-', $current_category)) . '.jpg';
if (file_exists(ABSPATH . $image)) {
echo '<img src="' . get_bloginfo('url') . $image . '" alt="' . $current_category . '" />';
}
?>
<ol>
<?php while (have_posts()) : the_post(); ?>
<li>
<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
<?php the_title(); ?></a></li>
<?php endwhile; ?>
</ol>
<?php endif; ?>
					<div class="clear"></div>
		
	  </div>
		<?php get_sidebar(); ?>
		<div class="clear"></div>
	</div>
<?php get_footer() ?>