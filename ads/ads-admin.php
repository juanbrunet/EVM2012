<?
	$table = $wpdb->prefix . UDS_ADS_TABLE_NAME;
	
	$id = (int)$_GET['id'];
	if($id != 0 && wp_verify_nonce($_GET['nonce'], 'ads_delete')){
		delete_ad($id);
	}

	$ads = $wpdb->get_results("SELECT * FROM $table ORDER BY created DESC");
	$nonce = wp_create_nonce('ads_delete');
?>
<div class="wrap">
	<h2>Ads Management</h2>
<? if(!empty($ads)): ?>
	<table class="uds-ads">
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Showing</th>
			<th>Display From/To</th>
			<th>Click Limit</th>
			<th>Times Clicked</th>
			<th>Created</th>
			<th>Modified</th>
			<th>Actions</th>
		</tr>
		<? foreach($ads as $ad): ?>
			<tr>
				<td><?=$ad->id?></td>
				<td><?=$ad->name?></td>
				<td><?=$ad->showing == 1 ? "Yes" : "No"?></td>
				<td>
					<? if($ad->ignore_date == 0): ?>
						<?=date('Y/m/d', strtotime($ad->display_from))?> - <?=date('Y/m/d', strtotime($ad->display_from))?>
					<? else: ?>
						-
					<? endif; ?>
				</td>
				<td><?=$ad->click_limit?></td>
				<td><?=$ad->times_clicked?></td>
				<td><?=date('d M Y H:i', strtotime($ad->created))?></td>
				<td><?=date('d M Y H:i', strtotime($ad->modified))?></td>
				<td>
					<a href="admin.php?page=uds_ads_view&id=<?=$ad->id?>"><img src="<?php echo get_template_directory_uri().'/ads/images/view.png'?>" alt="View" /></a>
					<a href="admin.php?page=uds_ads_create&id=<?=$ad->id?>"><img src="<?php echo get_template_directory_uri().'/ads/images/edit.png'?>" alt="Edit" /></a>
					<a href="admin.php?page=uds_ads&id=<?=$ad->id?>&nonce=<?=$nonce?>" onclick="return confirm('Really delete?')"><img src="<?php echo get_template_directory_uri().'/ads/images/delete.png'?>" alt="Delete" /></a>
				</td>
			</tr>
		<? endforeach; ?>
	</table>
<? else: ?>
	<p>There are no ads defined yet.</p>
	<p>You can create your first ad <a href="<? bloginfo('url') ?>/wp-admin/admin.php?page=uds_ads_create">here</a>.</p>
<? endif; ?>
</div>