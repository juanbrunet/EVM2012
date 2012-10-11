<?php
	$id = (int)$_GET['id'];
	$ad = array();
	$ad['name'] = '';
	$ad['image_url'] = '';
	$ad['destination_url'] = '';
	$ad['format'] = '125';
	$ad['click_limit'] = '0';
	$ad['showing'] = 1;
	$ad['position'] = '0';
	$ad['priority'] = '0';
	$ad['display_from'] = date("Y-m-d H:i:s");
	$ad['display_to'] = date("Y-m-d H:i:s", time() + 30 * 24 * 3600);
	$ad['ignore_date'] = 0;
	$ad['new_window'] = 1;

	$messages = array();
	$can_go = true;
	if(!empty($_POST)){
		if(!wp_verify_nonce($_POST['nonce'], 'uds-ads-create')){
			$can_go = false;
			$messages[] = 'Security check failed';
		}
		
		if(empty($_POST['name'])){
			$can_go = false;
			$messages[] = 'Name cannot be empty';
		}
		
		if(empty($_POST['image_url'])){
			$can_go = false;
			$messages[] = 'Image cannot be empty';
		}
		
		if(empty($_POST['destination_url'])){
			$can_go = false;
			$messages[] = 'Destination URL cannot be empty';
		}
		
		$ad = array();
		$ad['id'] = $_POST['ad_id'];
		$ad['name'] = $_POST['name'];
		$ad['image_url'] = $_POST['image_url'];
		$ad['destination_url'] = $_POST['destination_url'];
		$ad['format'] = $_POST['format'];
		$ad['click_limit'] = $_POST['click_limit'];
		$ad['showing'] = $_POST['showing'] == 'on' ? 1 : 0;
		$ad['position'] = $_POST['position'];
		$ad['priority'] = $_POST['priority'];
		$ad['display_from'] = $_POST['display_from'];
		$ad['display_to'] = $_POST['display_to'];
		$ad['ignore_date'] = $_POST['ignore_date'] == 'on' ? 1 : 0;
		$ad['times_clicked'] = '0';
		$ad['new_window'] = $_POST['new_window'] == 'on' ? 1 : 0;
		
		if($can_go){
			$result = false;
			$id = (int)$_POST['ad_id'];
			if($id == 0){
				$result = create_ad($ad);
				if($result){
					$messages[] = 'Ad created successfully.';
				} else {
					$messages[] = 'Failed to create ad.';
				}
			} else {
				$result = update_ad($ad);
				if($result){
					$messages[] = 'Ad updated successfully.';
				} else {
					$messages[] = 'Failed to update ad.';
				}
			}
		}
	}
	
	$nonce = wp_create_nonce('uds-ads-create');
	
	if($id != 0){
		$ad = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix . UDS_ADS_TABLE_NAME ." WHERE id=$id");
	}
	
	$ad = array2object($ad);
?>
<div class="wrap">
	<?php if($id == 0): ?>
		<h2>Create Ad</h2>
	<?php else: ?>
		<h2>Update Ad</h2>
	<?php endif; ?>
	
	<div class="messages">
		<?php foreach($messages as $message): ?>
			<div><?php echo $message?></div>
		<?php endforeach; ?>
	</div>
	
	<form action="<? bloginfo('url') ?>/wp-admin/admin.php?page=uds_ads_create<?php if($id != 0) echo '&id='.$id ; ?>" method="POST">
		<input type="hidden" name="nonce" value="<?php echo $nonce ?>" />
		<input type="hidden" name="ad_id" value="<?php echo $id ?>" />
		<table class="uds-ads-create">
			<tr>
				<td>Name</td>
				<td><input type="text" name="name" value="<?php echo $ad->name ?>" /></td>
				<td class="desc"><i>Ad name, does not have to be unique, will be displayed as image title</i></td>
			</tr>
			<tr>
				<td>Image</td>
				<td>
					<a class="thickbox" title="Add an Image" id="ads_image_insert" href="media-upload.php?type=image&TB_iframe=true&width=640&height=345">
					<?php if(!empty($ad->image_url)): ?>
						<img id="image" src="<?php echo $ad->image_url ?>" alt="" />
					<?php else: ?>
						Add Image
					<?php endif; ?>
					</a>
					<input type="hidden" name="image_url" id="ad_image"  value="<?php echo $ad->image_url ?>" />
				</td>
				<td class="desc"><i>Ad Image (required)</i></td>
			</tr>
			<tr>
				<td>Destination URL</td>
				<td><input type="text" name="destination_url"  value="<?php echo $ad->destination_url ?>" /></td>
				<td class="desc"><i>URL that the Ad points to</i></td>
			</tr>
			<tr>
				<td>Format</td>
				<td>
					<select name="format">
					<?php foreach($uds_ads_resolutions as $key => $value): ?>
						<option value="<?php echo $key ?>" <?php echo  $key == $ad->format ? "selected='selected'" : "" ?>><?php echo $value ?></option>
					<?php endforeach; ?>
					</select>
				</td>
				<td class="desc"><i>Ad image resolution</i></td>
			</tr>
			<tr>
				<td>Click limit</td>
				<td>
					<input type="text" name="click_limit" value="<?php echo $ad->click_limit ?>" />
				</td>
				<td class="desc"><i>Ad will automatically stop showing if click limit is reached.</i></td>
			</tr>
			<tr>
				<td>Showing</td>
				<td>
					<input type="checkbox" name="showing" <?php echo $ad->showing == 1 ? "checked='checked'" : "" ?> />
				</td>
				<td class="desc"><i>Unchecked will prevent Ad from showing.</i></td>
			</tr>
			<tr>
				<td>Position</td>
				<td>
					<select name="position">
					<?php for($i = 0; $i < UDS_ADS_MAX_POSITION; $i++): ?>
						<option value="<?php echo $i ?>"<?php echo  $i == $ad->position ? "selected='selected'" : "" ?>><?php echo $i + 1 ?></option>
					<?php endfor; ?>
					</select>
				</td>
				<td class="desc"><i>Shows Ad in widget with this number</i></td>
			</tr>
			<tr>
				<td>Priority</td>
				<td>
					<select name="priority">
						<?php for($i = 0; $i < UDS_ADS_MAX_PRIORITY; $i++): ?>
							<option value="<?php echo $i ?>" <?php echo  $i == $ad->priority ? "selected='selected'" : "" ?>><?php echo $i + 1 ?></option>
						<?php endfor; ?>
					</select>
				</td>
				<td class="desc"><i>This will be used to sort ads</i></td>
			</tr>
			<tr>
				<td>Display from</td>
				<td>
					<input type="text" name="display_from" value="<?php echo $ad->display_from ?>" />
				</td>
				<td class="desc"><i>Don't display the Ad before this date</i></td>
			</tr>
			<tr>
				<td>Display to</td>
				<td>
					<input type="text" name="display_to" value="<?php echo $ad->display_to ?>" />
				</td>
				<td class="desc"><i>Stops showing the Ad after this date</i></td>
			</tr>
			<tr>
				<td>Ignore Date</td>
				<td>
					<input type="checkbox" name="ignore_date" <?php echo $ad->ignore_date == 1 ? "checked='checked'" : "" ?> />
				</td>
				<td class="desc"><i>Ignore previous two fields</i></td>
			</tr>
			<tr>
				<td>Open in new window</td>
				<td>
					<input type="checkbox" name="new_window" <?php echo $ad->new_window == 1 ? "checked='checked'" : "" ?> />
				</td>
				<td class="desc"><i>Adds target=&quot;_blank&quot;</i></td>
			</tr>
		</table>
		<?php if($id == 0): ?>
		<input type="submit" value="Create ad" />
		<?php else: ?>
		<input type="submit" value="Update ad" />
		<?php endif; ?>
	</form>
</div>
<script language='JavaScript' type='text/javascript'>
var send_to_editor = function(img){
	 tb_remove();
	 if(jQuery(jQuery(img)).is('a')){ // work around Link URL supplied
	 	var src = jQuery(jQuery(img)).find('img').attr('src');
	 } else {
	 	var src = jQuery(jQuery(img)).attr('src');
	 }
	 
	 //console.log(window.receiver);
	 jQuery('#ads_image_insert').html('<img src="'+src+'" alt="" />');
	 jQuery("#ad_image").val(src);
}
jQuery('.billboard-image,#uds-logo,#uds-favicon').click(function(){
	set_receiver(this);
});
</script>