<script type="text/javascript">
var is_apply = false;
var is_new = false;
function save(){
	var options = {
		beforeSubmit:  showRequest,  // pre-submit callback 
		success:       showResponse  // post-submit callback 
    };
	$('#frmManagement').ajaxSubmit(options);
}

function save_new(){
		is_new = true;
		save();
		
	}

function apply(){
	is_apply = true;
	save();
}

function showRequest(formData, jqForm, options) {
	var form = jqForm[0];
	if(form.name.value == ''){
		$('#txt_error').html('Please enter information!!!');
		$('#loader').fadeOut(300);
		show_perm_denied();
		return false;
	}
}

function showResponse(result, statusText, xhr, $form) {
	 var result;
		var responseText;
		try {
			result = $.parseJSON(result);
			responseText = result.message;
		} catch(e){
			 responseText = result;
		}
		if(result && responseText == 'success'){
			if(is_apply){
				location.href=root+"admincp/"+module+"/update/"+result.id;
			} else if(is_new){
				location.href=root+"admincp/"+module+"/update";
			} else {
				location.href=root+"admincp/"+module+"/#/save";
			}
		}
	
	
	if(responseText=='error-name-exists'){
		$('#txt_error').html('Title already exists!!!');
		$('#loader').fadeOut(300);
		show_perm_denied();
		$('#nameAdmincp').focus();
		return false;
	}
	
	if(responseText=='SLUG_EXIST'){
		$('#txt_error').html('Slug already exists!!!');
		$('#loader').fadeOut(300);
		show_perm_denied();
		$('#slugAdmincp').focus();
		return false;
	}

	if(responseText=='permission-denied'){
		show_perm_denied();
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
	<div class="row_text_field_first">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Trạng thái:</td>
				<td class="right_text_field"><input <?php if(isset($result->status)){ if($result->status==1){ ?>checked="checked"<?php }}else{ ?>checked="checked"<?php } ?> type="checkbox" class="custom_chk" name="statusAdmincp" /></td>
			</tr>
		</table>
	</div>
	
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Loại:</td>
				<td class="right_text_field">
					<select name="type" id="type" style="padding:5px;">
						<option value="1" <?if(!empty($result->type)){ ($result->type=='1')? print 'selected':''; }?>>[ Show style 1 ]</option>
						<option value="2" <?if(!empty($result->type)){ ($result->type=='2')? print 'selected':''; }?>>[ Show style 2 ]</option>
					</select>
				</td>
			</tr>
		</table>
	</div>	
	
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Tên:</td>
				<td class="right_text_field"><input value="<?php if(isset($result->name)) { print $result->name; }else{ print '';} ?>" type="text" name="name" /></td>
			</tr>
		</table>
	</div>		
	
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Sắp xếp:</td>
				<td class="right_text_field"><input value="<?php if(isset($result->order)) { print $result->order; }else{ print '';} ?>" type="text" name="order" /></td>
			</tr>
		</table>
	</div>		
	</form>
</div>