<div class="sidebar-wrapper">
	<div class="sidebar-top"></div>
	<div class="sidebar">
		<?php $sidebar = is_page() ? (is_front_page() ? 'home' : 'page') : (get_post_type() == 'uds-portfolio' ? 'portfolio' : 'blog') ?>
       
		<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar)): ?>
        <!--h4 class="actualidad">Actualidad EVM</h4>
		<ul>
<?php $recent = new WP_Query("cat=7&showposts=5"); while($recent->have_posts()) : $recent->the_post();?>
<li><a href="<?php the_permalink() ?>" rel="bookmark">
<?php the_title(); ?>
</a></li>
<?php endwhile; ?>
</ul-->
<h4 class="actualidad">Enlaces de Inter&eacute;s</h4>
<ul>
<li><a href="http://aula.evm.net" target="_blank" title="Aula Virtual EVM">Aula Virtual EVM</a></li>
</uL>
        <h4 class="ultimos">Últimos Artículos</h4>
		<ul>
<?php $recent = new WP_Query("cat=8&showposts=5"); while($recent->have_posts()) : $recent->the_post();?>
<li><a href="<?php the_permalink() ?>" rel="bookmark">
<?php the_title(); ?>
</a></li>
<?php endwhile; ?>
</ul>
        <h4 class="otros">Otros Contenidos</h4>
	
<div id="fb-root"></div><script src="http://connect.facebook.net/es_ES/all.js#xfbml=1" type="text/javascript"></script><fb:like-box href="http://www.facebook.com/evmnet" width="220" show_faces="true" border_color="" stream="false" header="true"></fb:like-box>

		<?php endif; ?>
		<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('common')): ?>
			<!-- Static sidebar items -->
		<?php endif; ?>
   
	</div>
	<div class="sidebar-bottom"></div>
	</div>