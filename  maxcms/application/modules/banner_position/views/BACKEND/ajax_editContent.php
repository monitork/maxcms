<script type="text/javascript" src="<?=PATH_URL.'static/js/admin/jquery.slugit.js'?>"></script>
<script type="text/javascript">
$(document).ready( function() {

});

function save(){
	var options = {
		beforeSubmit:  showRequest,  // pre-submit callback 
		success:       showResponse  // post-submit callback 
    };
	$('#title_ad').val($('#page_ad option:selected').text() + ' ' + $('#position_ad').val());
	$('#frmManagement').ajaxSubmit(options);
}

function showRequest(formData, jqForm, options) {
	var form = jqForm[0];
	if( form.position_ad.value == '0' || form.width_ad.value == '' || form.width_ad.value == 0 || form.height_ad.value == '' || form.height_ad.value == 0){
		$('#txt_error').html('Please enter information!!!');
		$('#loader').fadeOut(300);
		show_perm_denied();
		return false;
	}
}

function showResponse(responseText, statusText, xhr, $form) {
	if(responseText=='success'){
		location.href=root+"admincp/"+module+"/#/save";
	}
	
	if(responseText=='permission-denied'){
		show_perm_denied();
	}
	
	if(responseText=='position-exist'){
		alert('Vị trí đặt banner đã tồn tại.');
		$('#loader').fadeOut(300);
	}
}
</script>
<div class="gr_perm_error" style="display:none;">
	<p><strong>FAILURE: </strong><span id="txt_error">Permission Denied.</span></p>
</div>
<div class="table">
	<div class="head_table"><div class="head_title_edit"><?=$module?></div></div>
	<div class="clearAll"></div>

	<form id="frmManagement" action="<?=PATH_URL.'admincp/'.$module.'/save/'?>" method="post" enctype="multipart/form-data">
	<input type="hidden" value="<?=$id?>" name="hiddenIdAdmincp" />
	<input type="hidden" value="<?php if(isset($result->title)) { print $result->title; }else{ print '';} ?>" name="title_ad" id="title_ad"/>
	<div class="row_text_field_first">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Status:</td>
				<td class="right_text_field"><input <?php if(isset($result->status)){ if($result->status==1){ ?>checked="checked"<?php }}else{ ?>checked="checked"<?php } ?> type="checkbox" class="custom_chk" name="statusAdmincp" /></td>
			</tr>
		</table>
	</div>
	
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Vị trí đặt banner:</td>
				<td class="right_text_field">
					<select name="position_ad" id="position_ad">
						<?php
						$position = array('1','2');
						foreach($position as $item){ ?>
						<option value="<?=$item?>" <?php if(isset($result->position)) if($result->position == $item) echo 'selected="selected"';?>><?=$item?></option>
						<?php
						}
						?>
					</select>
				</td>
			</tr>
		</table>
	</div>
	
		<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">File:</td>
				<td class="right_text_field"><input type="file" id="file_admin" name="fileAdmincp[file]" /><?php if(isset($result->file)){ if($result->file!='' && ($result->type == 'image')){ ?> - <a class="fancyboxClick" href="<?=PATH_URL.'static/uploads/banner/'.$result->type.'/'.$result->file?>">Review</a><?php }
				else { 
				if($result->file!='' && $result->type == 'flash'){ ?> - 
				<a class="fancyboxClick" href="#banner_review">
					Review
				</a>
				<div style="display:none">
					<div id="banner_review" style="width:<?=$page->width?>px; height:<?=$page->height?>px; padding: 10px">
						<object width="<?=$page->width?>" height="<?=$page->height?>" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
						codebase="http://fpdownload.macromedia.com/
						pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0">
							<param name="SRC" value="<?=PATH_URL.'static/uploads/banner/flash/'.$result->file?>">
							<param name="wmode" value="transparent" />
							<embed src="<?=PATH_URL.'static/uploads/banner/flash/'.$result->file?>" width="<?=$page->width?>" height="<?=$page->height?>" wmode="transparent">
							</embed>
						</object> 
					</div>
					
				</div>
				
				<?php }
					}
				} ?></td>
			</tr>
		</table>
	</div>
	
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Loại banner:</td>
				<td class="right_text_field">
					<input type="hidden" id="hdType" value="<?php if(isset($result->type)) { print $result->type; }else{ print 'image';} ?>"/>
					<select name="type_ad" id="type_ad" onchange="checkType()">
						<?php
						$type = array(
									'image'=>'Hình ảnh',
									'flash'=>'Flash',
									'sap-ra-mat'=>'Sắp ra mắt');
						foreach($type as $key=>$item){ ?>
						<option value="<?=$key?>" <?php if(isset($result->type)) if($result->type == $key) echo 'selected="selected"';?>><?=$item?></option>
						<?php
						}
						?>
					</select>
				</td>
			</tr>
		</table>
	</div>

	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Width:</td>
				<td class="right_text_field"><input value="<?php if(isset($result->width)) { print $result->width; }else{ print '';} ?>" type="text" name="width_ad" id="width_ad" /></td>
			</tr>
		</table>
	</div>
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Height:</td>
				<td class="right_text_field"><input value="<?php if(isset($result->height)) { print $result->height; }else{ print '';} ?>" type="text" name="height_ad" id="height_ad" /></td>
			</tr>
		</table>
	</div>
	
	</form>
</div>