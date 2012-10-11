<?php
$post = $wp_query->post;
if (in_category(15)) {
	include (TEMPLATEPATH.'/single_ideas.php');
	return;
}
?>
<?php if(is_ajax()):?>
 <?php the_post(); the_content(); ?>
  <? else : ?>  
  <?php rewind_posts() ?>

<?php
class WP_Title_2_Widget_Recent_Posts extends WP_Widget {
function WP_Title_2_Widget_Recent_Posts() {
		$widget_ops = array('classname' => 'widget_recent_entries', 'description' => __( "The most recent posts on your blog") );
		$this->WP_Widget('wptitle2-recent-posts', 'WP Title 2 '.__('Recent Posts'), $widget_ops);
		$this->alt_option_name = 'wptitle2_widget_recent_entries';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}
function widget($args, $instance) {
		$cache = wp_cache_get('wptitle2_widget_recent_posts', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( isset($cache[$args['widget_id']]) ) {
			echo $cache[$args['widget_id']];
			return;
		}
ob_start();
		extract($args);
$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts') : $instance['title']);
		if ( !$number = (int) $instance['number'] )
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;
$r = new WP_Query(array('showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'caller_get_posts' => 1));
		if ($r->have_posts()) :
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<ul>
		<?php  while ($r->have_posts()) : $r->the_post(); ?>
		<li>
			<a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>">
				<?php 
				remove_filter('the_title', 'wptitle2_the_title',999); 
				if ( get_the_title() ) the_title(); else the_ID(); 
				add_filter('the_title', 'wptitle2_the_title',999);
				?> 
			</a>
		</li>
		<?php endwhile; ?>
		</ul>
		<?php echo $after_widget; ?>
<?php
			wp_reset_query();  // Restore global post data stomped by the_post().
		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_add('wptitle2_widget_recent_posts', $cache, 'widget');
	}
function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['wptitle2_widget_recent_entries']) )
			delete_option('wptitle2_widget_recent_entries');
return $instance;
	}
function flush_widget_cache() {
		wp_cache_delete('wptitle2_widget_recent_posts', 'widget');
	}
function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 5;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /><br />
		<small><?php _e('(at most 15)'); ?></small></p>
<?php
	}
}
?>
<?php get_header() ?>
		<?php include 'page-tagline.php' ?>
<body id="dos">

  
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
			    <div class="pages-prev"><?php next_posts_link(__("&laquo; Older entries"))?></div>
			    <div class="pages-next"><?php previous_posts_link(__("Newer entries &raquo;"))?></div>
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
<?php endif; ?>