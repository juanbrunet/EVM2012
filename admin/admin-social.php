<?php

global $uds_social_options;

?>
<div class="wrap">
	<h2><?php echo UDS_TEMPLATE_NAME ?> - Social Networks</h2>
	<?php uds_render_options_form($uds_social_options) ?>
</div>
<?php uds_render_js_support() ?>