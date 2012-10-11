<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="<?php bloginfo('text_direction'); ?>" xml:lang="<?php bloginfo('language'); ?>">
<head profile="http://gmpg.org/xfn/11">	<meta name="google-site-verification" content="vv75-co1iqfBLS3kpzXB8SC3NqdTlciuWKlGy5i2mA4" />
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta http-equiv="Content-language" content="<?php bloginfo('language'); ?>" />
	<meta name="description" content="<?php bloginfo('description') ?>" />
	<title><?php bloginfo('name') ?> <?php wp_title() ?></title>
	<script type="text/javascript">
		var base_url = "<?php echo bloginfo('url')?>";
		var template_url = "<?php echo get_template_directory_uri()?>";
	</script>
<?php wp_head() ?>
<!--[if lte IE 8]>
		<link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/css/ie8.css" type="text/css" media="screen" charset="utf-8"/>
	<![endif]-->
    <!--[if lte IE 9]>
	    <link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/css/ie8.css" type="text/css" media="screen" charset="utf-8"/>
	<![endif]-->
	<!--[if lte IE 7]>
	    <link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/css/ie7.css" type="text/css" media="screen" charset="utf-8"/>
	<![endif]-->
	<!--[if IE 6]>
	    <link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/css/ie6.css" type="text/css" media="screen" charset="utf-8"/>
	<![endif]-->
	<!--[if lte IE 8]>
<![endif]-->
	<?php if(get_option('uds-use-user-colors') == 'on'): ?>
	<style type="text/css">
		.heading,
		#header-wrapper {
			background-color: #<?php echo get_option('uds-color-header-bg', ''); ?>;
		}
		#header, .nav li a {
			color: #<?php echo get_option('uds-color-header-text', ''); ?>;
		}
		body {
			background-color: #<?php echo get_option('uds-color-bg', ''); ?>;
		}
		body, #content p, #content {
			color: #<?php echo get_option('uds-color-text', ''); ?>;
		}
		a {
			color: #<?php echo get_option('uds-color-link', ''); ?>;
		}
		.heading-inner h2 a {
			color: #<?php echo get_option('uds-color-page-heading', ''); ?>;
		}
		#content h1, #content h2, #content h3, #content h4, #content h5, #content h6, #content h3.post-heading a {
			color: #<?php echo get_option('uds-color-heading', ''); ?>;
		}
		hr.divider,
		.sidebar-wrapper .widget,
		#comments .comment-meta,
		#content .widget_uds_twitter .uds-twitter-widget ul li.tweet .source,
		#content .meta {
			border-color: #<?php echo get_option('uds-color-borders', ''); ?>;
			color: #<?php echo get_option('uds-color-meta', ''); ?>;
		}
		#authorbox,
		#add-comment input, #add-comment textarea,
		#comments .comment-meta	{
			background-color: #<?php echo get_option('uds-color-comment-heading-bg', ''); ?>;
		}
		#authorbox h4,
		#comments .comment-text {
			background-color: #<?php echo get_option('uds-color-comment-body-bg', ''); ?>;
		}
		#footer-wrapper {
			background-color: #<?php echo get_option('uds-color-footer-bg', ''); ?>;
		}
		#footer-inner,
		#footer-inner ul li a {
			color: #<?php echo get_option('uds-color-footer-text', ''); ?>;
		}
		
		.nav li ul {
			border-color: #<?php echo get_option('uds-color-header-bg', ''); ?>;
		}
		#add-comment .buttons button,
		a.read-more {
			color: #<?php echo get_option('uds-color-bg', ''); ?>;
			background-color: #<?php echo get_option('uds-color-link', ''); ?>;
		}
		a.read-more:active {
			background: #<?php echo get_option('uds-color-bg', ''); ?>;
			color: #<?php echo get_option('uds-color-link', ''); ?>;
			border: 1px solid #<?php echo get_option('uds-color-bg', ''); ?>;
		}
		.terms-tag-main {
			background-color: #<?php echo get_option('uds-color-header-bg', ''); ?>;
			color: #<?php echo get_option('uds-color-text', ''); ?>;
		}
		.terms-tag.current .terms-tag-main {
			background-color: #<?php echo get_option('uds-color-link', ''); ?>;
			color: #<?php echo get_option('uds-color-bg', ''); ?>;
		}
	</style>
	<?php endif; ?>
	<link rel="SHORTCUT ICON" href="<?php echo get_option('uds-favicon')?>"/>
    <script type="text/javascript" src="https://apis.google.com/js/plusone.js">
  {lang: 'es'}
</script>
</head>
<body <?php body_class() ?>>
	<div id="header-wrapper">
		<div id="header">
			<div id="logo">
				<?php if(get_option('uds-heading-type') == 'image'): ?>
					<a href="<?php bloginfo('url') ?>" class="logo"><img src="<?php echo get_option('uds-logo') ?>" alt="" /></a>
				<?php else: ?>
					<h1><a href="<?php bloginfo('url') ?>"><?php echo get_option('uds-heading')?></a></h1>
					<h3><a href="<?php bloginfo('url') ?>"><?php echo get_option('uds-subheading')?></a></h3>
				<?php endif; ?>
			</div>
          <div class="rightup">
          
          <div style="text-align:right" class="idioma"><?php echo qtrans_generateLanguageSelectCode('dropdown'); ?><br /></div>
         <div style="float:right"> <?php echo '' != get_option('uds-rss') ? '<a href="'.get_option('uds-rss').'" target="_blank"><img src="'.get_template_directory_uri().'/images/footer-rss.png" alt="png" class="social"/></a>' : '' ?>
	    			<?php echo '' != get_option('uds-skype') ? '<a href="callto://'.get_option('uds-skype').'" target="_blank"><img src="'.get_template_directory_uri().'/images/footer-skype.png" alt="png" class="social"/></a>' : '' ?>
	    			<?php echo '' != get_option('uds-facebook') ? '<a href="'.get_option('uds-facebook').'" target="_blank"><img src="'.get_template_directory_uri().'/images/footer-facebook.png" alt="png" class="social"/></a>' : '' ?>
	    			<?php echo '' != get_option('uds-twitter') ? '<a href="'.get_option('uds-twitter').'" target="_blank"><img src="'.get_template_directory_uri().'/images/footer-twitter.png" alt="png" class="social"/></a>' : '' ?>
	    			<?php echo '' != get_option('uds-youtube') ? '<a href="'.get_option('uds-youtube').'" target="_blank"><img src="'.get_template_directory_uri().'/images/footer-youtube.png" alt="png" class="social"/></a>' : '' ?>
	    			<?php echo '' != get_option('uds-flickr') ? '<a href="'.get_option('uds-flickr').'" target="_blank"><img src="'.get_template_directory_uri().'/images/footer-flickr.png" alt="png" class="social"/></a>' : '' ?>
	    			<?php echo '' != get_option('uds-linkedin') ? '<a href="'.get_option('uds-linkedin').'" target="_blank"><img src="'.get_template_directory_uri().'/images/footer-linkedin.png" alt="png" class="social"/></a>' : '' ?>
   		    </div></div>
			<div class="nav"> 			
<?php 
/*if(qtrans_getLanguage()=='es'): wp_nav_menu( array( 'menu' => 'mainmenu-es' ) );			
else: wp_nav_menu( array( 'menu' => 'mainmenu-en' ) );
endif; */
?>
				<?php 
				wp_nav_menu(array(
					'theme_location' => 'main-menu',
					'container'=>'ul'
				)); 				
				?>
              <div class="right">  	<form style="text-align:right;" action="<?php bloginfo('url') ?>" method="get" class="searchbox">
				<fieldset>
					<div class="bg-search-left"></div>
					<input  type="text" name="s" value="buscar..." id="top-search" />
					<button type="submit"></button>
					<div class="bg-search-right"></div>
					<div class="clear"></div>
				</fieldset>
			</form>	</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div id="wrapper">
		<?php if(is_front_page()): ?>
			<?php get_billboard() ?>
		
			
				<div class="clear"></div>
			
		<?php if(get_option('uds-show-tagline') == 'on'): ?>
			<div id="tagline">
				<h2 class="tagline-text"><?php echo htmlspecialchars(stripslashes(get_option('uds-tagline-text'))) ?></h2>
				<a href="<?php echo get_option('uds-tagline-button-link') ?>" id="tagline-link">
					<img src="<?php echo get_option('uds-tagline-button-image') ?>" alt="" />
				</a>
				<div class="clear"></div>
			</div>
			<?php endif; ?>
		<?php endif; ?>