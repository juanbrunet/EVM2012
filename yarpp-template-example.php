<?php /*
Example template
Author: mitcho (Michael Yoshitaka Erlewine)
*/ 
?><h3>Contenido relacionado</h3>
<?php if ($related_query->have_posts()):?>
<ol>
	<?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
	<li><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a><!-- (<?php the_score(); ?>)--></li>
	<?php endwhile; ?>
</ol>
<?php else: ?>
<p>No hay contenido relacionado.</p>
<?php endif; ?>
