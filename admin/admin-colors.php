<?php

global $uds_colors_options;

?>
<div class="wrap">
	<h2><?php echo UDS_TEMPLATE_NAME ?> - Color Options</h2>
	<?php uds_render_options_form($uds_colors_options) ?>
</div>
<?php uds_render_js_support() ?>