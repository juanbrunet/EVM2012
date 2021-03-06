<?php

global $uds_billboard_attributes;

if(!empty($_POST['nonce']) && !wp_verify_nonce($_POST['nonce'], 'uds-billboard')){
	die('Security check failed');
}

uds_billboard_proces_updates();

$billboard_items = maybe_unserialize(get_option(UDS_BILLBOARD_OPTION));

// safety check
if(! is_array($billboard_items)) {
	$billboard_items = array();
}

$billboard_items[] = uds_billboard_default_billboard();

?>
<div class="wrap">
	<h2><?php echo UDS_TEMPLATE_NAME ?> - SLIDESHOW</h2>
	<form action="" method="post" class="uds-billboard-form">
		<input type="hidden" name="nonce" value="<?php echo wp_create_nonce('uds-billboard') ?>" />
		<input type="submit" value="Actualizar"  class="submit button-primary" />
		<table id="uds-billboard-table">
			<?php foreach($billboard_items as $key => $item): ?>
			<tr>
				<td>
					<a href="#" class="billboard-move" title="Reordenar Items">Mover</a>
					<a href="#" class="billboard-delete" title="Borrar Item">Borrar</a>
				</td>
				<td>
					<?php foreach($uds_billboard_attributes as $attrib => $options): ?>
						<?php uds_billboard_render_field($item, $attrib, $key) ?>
					<?php endforeach; ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
		<input type="submit" value="Actualizar"  class="submit button-primary" />
	</form>
</div>
<?php uds_billboard_render_js_support() ?>