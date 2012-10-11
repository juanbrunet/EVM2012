<?php get_header() ?>
<body id="dos">
	<div class="heading">
		<div class="heading-inner">
			<div id="heading-title">
				<h2><a href="#" rel="bookmark">404 Página no encontrada</a></h2>
				<?php the_breadcrumbs() ?>
			</div>
		<p></p>
			<div class="clear"></div>
		</div>
	</div>
	<div id="content">
		<div id="main">
			<div class="post-content">
				<div class="box info">No encontramos la página que busca</div>
				<p></p>
				<h3>¿Por qué?</h3>
				<ol>
					<li>Ha hecho click en un link equivocado.</li>
					<li>Ha escrito mal la URL.</li>
					<li>LA página ha sido borrada.</li>
				</ol>
				<h3>¿Qué puedo hacer?</h3>
				<p>Puede encontrar lo que busca a través del formulario.</p>
				<p></p>
				<p>O puede entrar en alguna de las siguientes páginas.</p>
				<ul>
					<?php
						wp_list_pages(array(
						    'depth'        => 0,
						    'show_date'    => true,
						    'date_format'  => get_option('date_format'),
						    'child_of'     => 0,
						    'exclude'      => '',
						    'title_li'     => '',
						    'echo'         => 1,
						    'authors'      => '',
						    'sort_column'  => 'menu_order, post_title',
						    'link_before'  => '',
						    'link_after'   => '',
						    'exclude_tree' => '' )
						);
					?>
				</ul>
			</div>
		</div>
		<?php get_sidebar('blog'); ?>
		<div class="clear"></div>
	</div>
<?php get_footer() ?>