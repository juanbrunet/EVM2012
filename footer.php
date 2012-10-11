</div>	
	<div id="footer-wrapper">
	    <div id="footer-top"></div>
	    <?php $footer_config = get_option('uds-footer-config', 3); ?>
	    <div id="footer-inner" class="footer-config-<?php echo $footer_config ?>">
	    	<p>
	    	  <?php 
				for($i = 1; $i <= $footer_config; $i++){
					dynamic_sidebar('footer'.$i);
				}
	    	?>
    	  </p>
	    	<p>
    	  </p>
	    	<div class="clear"></div>
</div>
	    <div id="footer-bottom">
	    	<div id="footer-bottom-inner">
	    		<div class="left">
	    			<p class="copyright">&copy;<?php echo date('Y') ?> <?php echo get_option('uds-copyright') ?> | <a href="http://www.evm.net/?p=2335"> Aviso Legal</a></p>
    		  </div>
	    		<div class="right">
	    			<?php echo '' != get_option('uds-rss') ? '<a href="'.get_option('uds-rss').'"><img src="'.get_template_directory_uri().'/images/footer-rss.png" alt="png" class="social"/></a>' : '' ?>
	    			<?php echo '' != get_option('uds-skype') ? '<a href="callto://'.get_option('uds-skype').'"><img src="'.get_template_directory_uri().'/images/footer-skype.png" alt="png" class="social"/></a>' : '' ?>
	    			<?php echo '' != get_option('uds-facebook') ? '<a href="'.get_option('uds-facebook').'"><img src="'.get_template_directory_uri().'/images/footer-facebook.png" alt="png" class="social"/></a>' : '' ?>
	    			<?php echo '' != get_option('uds-twitter') ? '<a href="'.get_option('uds-twitter').'"><img src="'.get_template_directory_uri().'/images/footer-twitter.png" alt="png" class="social"/></a>' : '' ?>
	    			<?php echo '' != get_option('uds-youtube') ? '<a href="'.get_option('uds-youtube').'"><img src="'.get_template_directory_uri().'/images/footer-youtube.png" alt="png" class="social"/></a>' : '' ?>
	    			<?php echo '' != get_option('uds-flickr') ? '<a href="'.get_option('uds-flickr').'"><img src="'.get_template_directory_uri().'/images/footer-flickr.png" alt="png" class="social"/></a>' : '' ?>
	    			<?php echo '' != get_option('uds-linkedin') ? '<a href="'.get_option('uds-linkedin').'"><img src="'.get_template_directory_uri().'/images/footer-linkedin.png" alt="png" class="social"/></a>' : '' ?>
	    		</div>
	    		<div class="clear"></div>
	    	</div>
	    </div>
	</div>
	
	<?php wp_footer() ?>
	
	<script type="text/javascript">
	    //<![CDATA[
	    // GMap widget support
	    uds_google_map_lat = jQuery('#uds-google-map-lat').remove().text();
	    uds_google_map_lng = jQuery('#uds-google-map-lng').remove().text();
	    uds_google_map_zoom = jQuery('#uds-google-map-zoom').remove().text();
	    
	    if(jQuery("#uds-google-map").size() > 0 && typeof google != 'undefined'){
	    	google.load("maps", 2);
	    	
	    	google.setOnLoadCallback(function(){
	    		if (GBrowserIsCompatible()) {
	    			var map = new GMap2(document.getElementById("uds-google-map"));
	    			var latlng = new GLatLng(uds_google_map_lat, uds_google_map_lng);
	    			map.setCenter(latlng, parseInt(uds_google_map_zoom));
	    			map.addOverlay(new GMarker(latlng));
	    		}
	    	});
	    }
	    //]]>
	</script>
	
	<?php if(get_option('uds-ga') == 'on'): ?>
	<?php $ga = get_option('uds-ga-tracking-code'); ?>
	<script type="text/javascript">
	    var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
	    document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
	</script>
	<script type="text/javascript">
	    try {
	    	var pageTracker = _gat._getTracker("<?php echo $ga?>");
	    	<?php $tracking_domain = get_option("uds-ga-tracking-domain") ?>
	    	<?php if(!empty($tracking_domain)): ?>
	    		pageTracker._setDomainName("<?php echo $tracking_domain ?>");
	    	<?php endif; ?>
	    	pageTracker._trackPageview();
	    } catch(err) {}
	</script>
	<?php endif; ?>
</body>
</html>