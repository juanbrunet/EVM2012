<?php

	$temp = $wp_query;
	
	$base = get_permalink();
	$terms = get_terms('portfolio_category');
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$post_count = wp_count_posts('uds-portfolio');
	$total_pages = ceil((int)($post_count->publish) / 95);
	$active_tags = get_post_meta($post->ID, 'uds-portfolio-show-tags', true);
	$cat_id = '';
	
	if(!empty($active_tags)) {
		$query_vars = $active_tags;
	} else {
		$query_vars = isset($wp_query->query_vars['portfolio_category']) ? $wp_query->query_vars['portfolio_category'] : '';
	}

	foreach($terms as $term){
		//d($term->slug);
		if($term->slug == $query_vars){
			$cat_id = $term->term_id;
		}
	}
	//d($cat_id);
	//d($query_vars);
	$portfolio = new WP_Query(array(
		'post_type' => 'uds-portfolio',
		'portfolio_category' => $query_vars,
		'posts_per_page' => 95,
		'paged' => $paged
	));	

	//d($portfolio);
	//d($terms);
?>
<body id="tres">

<?php if(is_ajax()): ?>
	<?php $wp_query = $portfolio; ?>
  
	<div class="portfolio">
		<?php foreach($portfolio->posts as $key => $portfolio_item): ?>
			<?php 
				$type = get_post_meta($portfolio_item->ID, 'uds-portfolio-content-type');
				$type = isset($type[0]) ? $type[0] : '';
				$noLB = get_post_meta($portfolio_item->ID, 'uds-portfolio-no-lightbox');
				$noLB = isset($noLB[0]) && $noLB[0] == 'on' ? 'no-lightbox' : '';
				$last = $portfolio_type == 'gallery' && ($key + 1) % 3 == 0 ? 'last' : '';
				$last = $portfolio_type == '3-column' && ($key + 1) % 3 == 0 ? 'last' : $last;
				$last = $portfolio_type == '2-column' && ($key + 1) % 2 == 0 ? 'last' : $last;
				$last = $portfolio_type == '1-column' ? '' : $last;
			?>
            			<?php

			$conexion = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
			mysql_select_db(DB_NAME, $conexion);

			$consulta = "SELECT * FROM wp_term_relationships WHERE object_id = " . $portfolio_item->ID;
                        if (trim(get_query_var('portfolio_category')) != "")
                        {
                           $consulta .= " AND term_taxonomy_id IN (SELECT term_taxonomy_id FROM wp_term_taxonomy " .
                            " WHERE term_id IN ( SELECT term_id FROM wp_terms WHERE slug = '".get_query_var('portfolio_category')."'))";
                        }
                        else
                        {
			   if ($_GET["page_id"] == "160")
			      $consulta = "SELECT * FROM wp_term_relationships WHERE term_taxonomy_id in (103, 104, 105) AND object_id = " . $portfolio_item->ID;
			   else
			      $consulta = "SELECT * FROM wp_term_relationships WHERE term_taxonomy_id in (100, 101, 102, 4, 99, 133, 173) AND object_id = " . $portfolio_item->ID;
                        }

			$resultados = mysql_query($consulta);

                        if (mysql_num_rows($resultados) > 0) {
			
			?>
			<div id="data-<?php echo $portfolio_item->ID ?>" class="portfolio-item-wrapper <?php echo $last ?>">
				<div class="portfolio-item <?php echo ' '.$type.' '.$noLB ?>">
					<a href="<?php echo get_permalink($portfolio_item->ID) ?>" type="ajax" class="image">
					<?php
					$dir = get_template_directory_uri();//echo $consulta;
					$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($portfolio_item->ID), 'full');
					$thumb = urlencode($thumb[0]);
					echo "<img src='$dir/images/timthumb.php?src=$thumb&amp;w=450&amp;h=248&amp;zc=0' alt='' />";
					/*
					switch($portfolio_type):
					case '1-column':
						echo "<img src='$dir/images/timthumb.php?src=$thumb&amp;w=450&amp;h=248&amp;zc=0' alt='' />";
						break;
					case '2-column':
						echo "<img src='$dir/images/timthumb.php?src=$thumb&amp;w=225&amp;h=131&amp;zc=0' alt='' />";
						break;
					case '3-column':
						echo "<img src='$dir/images/timthumb.php?src=$thumb&amp;w=290&amp;h=160&amp;zc=0' alt='' />";
						break;
					default:
						echo "<img src='$dir/images/timthumb.php?src=$thumb&amp;w=290&amp;h=160&amp;zc=0' alt='' />";
					endswitch;*/
					?>
					</a>
					<h3 class="portfolio-heading"><a href="<?php echo get_permalink($portfolio_item->ID) ?>"> <?php echo $portfolio_item->post_title ?></a></h3>
					<div class="excerpt"><?php echo $portfolio_item->post_excerpt ?></div>
					<div class="clear"></div>
				</div>
			</div>
                <?php } ?>
		<?php endforeach; ?>
		<div class="clear"></div>
	</div>
<?php else: ?>
	<?php get_header(); the_post(); ?>
		<div class="heading">
			  <div class="heading-inner">
			  	<div id="heading-title">
					<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title() ?></a></h2>
					<?php the_breadcrumbs() ?>
				</div>
			  	<div class="clear"></div>
			  </div>
		</div>
		<?php $custom = get_post_custom() ?>
		<?php if(!empty($custom['heading'][0])): ?>
			  <div class="content-heading">
			  	<?php echo $custom['heading'][0]?>
			  </div>
		<?php endif; ?>
		<div id="content">
			<div class="page">
				<?php the_content() ?>
			</div>
			<?php $wp_query = $portfolio; ?>
			<?php if(!empty($terms) && empty($active_tags)): ?>
				<div class="terms">
					<div class="terms-tag <?php if($query_vars == '') echo 'current' ?>">
						<a href="<?php echo $base ?>" class="terms-tag-main">Todos</a>
						<div class="clear"></div>
					</div>
					<?php foreach($terms as $term): ?>
						<?php 
						if ($_GET["page_id"] == "160")
							if (($term->slug == "sector-publico") || ($term->slug == "sector-privado") || ($term->slug == "tercer-sector"))
								$go = true;
							else
								$go = false;
						else
							if (($term->slug == "fundaciones-comprometidas") || ($term->slug == "asociaciones") || ($term->slug == "empresas-excelentes") || ($term->slug == "ciudadesinteligentes") || ($term->slug == "formacion-2"))
								$go = true;
							else
								$go = false;

						if ($go) {
						?>
						<div class="terms-tag <?php if($query_vars == $term->slug) echo 'current' ?>">
							<a href="<?php echo $base . '&portfolio_category=' . $term->slug ?>" class="terms-tag-main"><?php echo $term->name?></a>
							<div class="clear"></div>
						</div>
						<?php } ?>
					<?php endforeach; ?>
					<div class="clear"></div>
				</div>
			<?php endif; ?>
			<div class="layout-switcher">
			
				<a href="#" id="switcher-layout-3-column">3 Columnas</a>
				<a href="#" id="switcher-layout-2-column">2 Columnas</a>
				<a href="#" id="switcher-layout-1-column">1 Columnas</a>
			</div>			
			<div class="clear"></div>
			<?php if(!empty($portfolio)): ?>
				<div class="portfolio layout-<?php echo $portfolio_type ?>">
					<?php foreach($portfolio->posts as $key => $portfolio_item): ?>
						<?php 
							$type = get_post_meta($portfolio_item->ID, 'uds-portfolio-content-type');
							$type = isset($type[0]) ? $type[0] : '';
							$noLB = get_post_meta($portfolio_item->ID, 'uds-portfolio-no-lightbox');
							$noLB = isset($noLB[0]) && $noLB[0] == 'on' ? 'no-lightbox' : '';
							$last = $portfolio_type == 'gallery' && ($key + 1) % 3 == 0 ? 'last' : '';
							$last = $portfolio_type == '3-column' && ($key + 1) % 3 == 0 ? 'last' : $last;
							$last = $portfolio_type == '2-column' && ($key + 1) % 2 == 0 ? 'last' : $last;
							$last = $portfolio_type == '1-column' ? '' : $last;
						?>
						<?php

						$conexion = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
						mysql_select_db(DB_NAME, $conexion);

						if ($_GET["page_id"] == "160")
							$consulta = "SELECT * FROM wp_term_relationships WHERE term_taxonomy_id in (103, 104, 105) AND object_id = " . $portfolio_item->ID;
						else
							$consulta = "SELECT * FROM wp_term_relationships WHERE term_taxonomy_id in (100, 101, 102, 4, 99, 133, 173) AND object_id = " . $portfolio_item->ID;
						$resultados = mysql_query($consulta);

						if (mysql_num_rows($resultados) > 0) {
						?>
						<div id="data1-<?php echo $portfolio_item->ID ?>" class="portfolio-item-wrapper <?php echo $last ?>">
							<div class="portfolio-item <?php echo ' '.$type.' '.$noLB ?>">
								<a href="<?php echo get_permalink($portfolio_item->ID) ?>" type="ajax" class="image">
									<?php 
										$dir = get_template_directory_uri();//echo $consulta;
										$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($portfolio_item->ID), 'full');
										$thumb = urlencode($thumb[0]);
										echo "<img src='$dir/images/timthumb.php?src=$thumb&amp;w=450&amp;h=248&amp;zc=0' alt='' />";
										/*
										switch($portfolio_type):
											case '1-column':
												echo "<img src='$dir/images/timthumb.php?src=$thumb&amp;w=450&amp;h=248&amp;zc=0' alt='' />";
												break;
											case '2-column':
												echo "<img src='$dir/images/timthumb.php?src=$thumb&amp;w=225&amp;h=131&amp;zc=0' alt='' />";
												break;
											case '3-column':
												echo "<img src='$dir/images/timthumb.php?src=$thumb&amp;w=290&amp;h=160&amp;zc=0' alt='' />";
												break;
											default:
												echo "<img src='$dir/images/timthumb.php?src=$thumb&amp;w=290&amp;h=160&amp;zc=0' alt='' />";
										endswitch;*/
									?>
								</a>
								<h3 class="portfolio-heading"><a href="<?php echo get_permalink($portfolio_item->ID) ?>"> <?php echo $portfolio_item->post_title ?></a></h3>
								<div class="excerpt"><?php echo $portfolio_item->post_excerpt ?></div>
								<div class="clear"></div>
							</div>
						</div>
						<?php } ?>
					<?php endforeach; ?>
					<div class="clear"></div>
				</div>
			<?php endif; ?>
			<div class="clear"></div>
			<div class="post-pages">
				<div class="pages-prev">
					<?php next_posts_link(__("&laquo; Más antiguas")) ?>
				</div>
				<div class="pages-next">
					<?php previous_posts_link(__("Más nuevas &raquo;")) ?>
				</div>
				<div class="clear"></div>
			</div>
			<?php $wp_query = $temp ?>
		</div>
	<?php get_footer() ?>
<?php endif; ?>