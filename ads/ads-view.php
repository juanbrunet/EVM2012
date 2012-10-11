<?php
	$id = (int)$_GET['id'];

	$ad = null;
	if($id != 0){
		$ad = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix . UDS_ADS_TABLE_NAME ." WHERE id=$id");
	}
	
	if($ad != null):
?>
<div class="wrap">
	<h2>View Ad</h2>
	
	<table class="uds-ads-view">
	    <tr>
	    	<td>Name</td>
	    	<td><?php echo $ad->name ?></td>
	    </tr>
	    <tr>
	    	<td>Image</td>
	    	<td><img id="image" src="<?php echo $ad->image_url ?>" alt="" />
	    	</td>
	    </tr>
	    <tr>
	    	<td>Destination URL</td>
	    	<td><?php echo $ad->destination_url ?></td>
	    </tr>
	    <tr>
	    	<td>Format</td>
	    	<td><?php echo  $uds_ads_resolutions[$ad->format] ?></td>
	    </tr>
	    <tr>
	    	<td>Click limit</td>
	    	<td><?php echo $ad->click_limit ?></td>
	    </tr>
	    <tr>
	    	<td>Showing</td>
	    	<td><?php echo $ad->showing == '1' ? "Yes" : "No" ?></td>
	    </tr>
	    <tr>
	    	<td>Position</td>
	    	<td><?php echo $ad->position + 1 ?></td>
	    </tr>
	    <tr>
	    	<td>Priority</td>
	    	<td><?php echo  $ad->priority + 1 ?></td>
	    </tr>
	    <tr>
	    	<td>Display from</td>
	    	<td><?php echo $ad->display_from ?></td>
	    </tr>
	    <tr>
	    	<td>Display to</td>
	    	<td><?php echo $ad->display_to ?></td>
	    </tr>
	    <tr>
	    	<td>Ignore Date</td>
	    	<td><?php echo $ad->ignore_date == '1' ? "Yes" : "No" ?></td>
	    </tr>
	    <tr>
	    	<td>Open in new window</td>
	    	<td><?php echo $ad->new_window == '1' ? "Yes" : "No" ?></td>
	    </tr>
	</table>
</div>
<?php endif; ?>