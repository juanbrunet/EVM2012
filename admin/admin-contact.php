<?php

global $uds_contact_options;

?>
<div class="wrap">
	<h2><?php echo UDS_TEMPLATE_NAME ?> - Contact Form Options</h2>
	<?php uds_render_options_form($uds_contact_options) ?>
</div>
<?php uds_render_js_support() ?>