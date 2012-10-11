<?php
if(!empty($_POST['nonce']) && !wp_verify_nonce($_POST['nonce'], 'uds-billboard')){
	die('Security check failed');
}

$column_classes = array(
	'green' => 'Green background',
	'green bold' => 'Green background, Bold',
	'red' => 'Red background'
);

$row_classes = array(
	'green' => 'Green background',
	'green bold' => 'Green background, Bold',
	'red' => 'Red background'
);

add_option('uds-tables', array());
$tables = maybe_unserialize(get_option('uds-tables', array()));

$table = false;
$table_name = '';

if(!empty($tables)){
	$table = current($tables);
	$table_name = key($tables);
	
	if(!empty($_GET['table']) && $_GET['table'] != 'uds_new'){
		if(!empty($tables[$_GET['table']])){
			$table = $tables[$_GET['table']];
			$table_name = $_GET['table'];
		}
	}
}

if(!empty($_POST)){
	$table = array(
		'headerx' => $_POST['headerx'],
		'headery' => $_POST['headery'],
		'cell' => $_POST['cell']
	);
	
	$table_name = $_POST['name'];
	
	$tables[$table_name] = $table;
	
	update_option('uds-tables', maybe_serialize($tables));
}

if($table === false || $_GET['table'] == 'uds_new'){
	$table_name = '';
	$table = array(
		'headerx' => array(''),
		'headery' => array(''),
		'cell' => array('')
	);
}
//d($tables);
//d($table);
?>
<div class="wrap">
	<h2><?php echo UDS_TEMPLATE_NAME ?> - Table Creator</h2>
	<div class="controls">
		<a href="#" class="add-column">Add column</a>
		<a href="#" class="add-row">Add row</a>
		<form action="admin.php" method="get">
			<input type="hidden" name="page" value="uds_theme_admin_table" />
		<?php if(!empty($tables)): ?>
			<select class="table-selector" name="table">
				<option value="uds_new">Create new</option>
				<?php foreach($tables as $name => $value): ?>
					<option value="<?php echo $name ?>" <?php echo $table_name == $name ? "selected='selected'" : '' ?>><?php echo $name ?></option>
				<?php endforeach;?>
			</select>
		<?php endif; ?>
		</form>
	</div>
	<form action="" method="post">
		<input type="hidden" name="nonce" value="<?php echo wp_create_nonce('uds-billboard') ?>" />
		<?php if($table_name != ''): ?>
			<input type="hidden" name="name" value="<?php echo $table_name ?>" />
		<?php else: ?>
			<label for="table_name">Table name</label>
			<input type="input" name="name" id="table_name" value="" />
		<?php endif; ?>
		<table class="table-creator">
			<tr>
				<th></th>
				<?php foreach($table['headerx'] as $header): ?>
				<th>
					<select name="headerx[]">
						<?php foreach($column_classes as $key => $value): ?>
							<option value="<?php echo $key ?>" <?php echo $header == $key ? 'selected="selected"' : '' ?>><?php echo $value ?></option>
						<?php endforeach; ?>
					</select>
					<a href="#" class="remove-column">x</a>
				</th>
				<?php endforeach; ?>
			</tr>
			<?php for($i = 0; $i < count($table['headery']); $i++): ?>
			<tr>
				<th>
					<select name="headery[]">
						<?php foreach($row_classes as $key => $value): ?>
							<option value="<?php echo $key ?>" <?php echo $table['headery'][$i] == $key ? 'selected="selected"' : '' ?>><?php echo $value ?></option>
						<?php endforeach; ?>
					</select>
					<a href="#" class="remove-row">x</a>
				</th>
				<?php for($j = 0; $j < count($table['cell'][$i]); $j++): ?>
				<td class="cell">
					<textarea name="cell[]"><?php echo stripslashes($table['cell'][$i][$j]); ?></textarea>
				</td>
				<?php endfor; ?>
			</tr>
			<?php endfor; ?>
		</table>
		<input type="submit" />
	</form>
</div>