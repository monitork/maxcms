<link rel="stylesheet" href="<?=PATH_URL.'static/css/admin/'?>jquery.tagsinput.css" type="text/css">
<script type="text/javascript" src="<?=PATH_URL.'static/js/admin/'?>jquery.tagsinput.js"></script>
<script type="text/javascript">
$(function() {
	$('#tags').tagsInput({
		width: 'auto',
		autocomplete_url:root+'admincp/news/get_tags' // jquery ui autocomplete requires a json endpoint
	});
	
	$('#tags_tag').bind('keyup', function(){
		//$('html, body').animate({scrollTop: '680px'}, 10,function(){});
	});
	
	
});

var is_apply = false;
var is_new = false;
function save(){
	var options = {
		beforeSubmit:  showRequest,  // pre-submit callback 
		success:       showResponse  // post-submit callback 
    };
	$('#contentAdmincp').val(oEdit1.getHTMLBody());
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
	if(form.title.value == ''){
		errorFr('Bạn chưa nhập tiêu đề');
		$('input[name="title"]').focus();
		return false;
	}
	if(form.parent_id.value == 0){
		errorFr('Bạn chưa chọn thể loại');scroll(560);
		return false;
	}
	if(form.description.value == ''){
		errorFr('Bạn chưa nhập mô tả');scroll(700);
		return false;
	}	

	if(form.contentAdmincp.value == '<br>'){
		errorFr('Bạn chưa nhập nội dung');scroll(850);
		return false;
	}		
}

function scroll(px){
	var scroll= function(){
		$('html, body').animate({scrollTop: px+'px'}, 300,function(){});
	}
	setTimeout(scroll,1000);
}

function errorFr(txt){
	$('#txt_error').html(txt);
	$('#loader').fadeOut(300);
	show_perm_denied();
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
		
	if(responseText=='SLUG_EXIST'){
		$('#txt_error').html('Tiêu đề bị trùng');
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
	<input type="hidden" value="<?php ($this->session->userdata('category_filter'))? print $this->session->userdata('category_filter') : print '' ?>" class="has_filter_category" id="category_filter"/>
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
				<td class="left_text_field">Tin nổi bật:</td>
				<td class="right_text_field"><input <?php if(isset($result->tinnoibat)){ if($result->tinnoibat==1){ ?>checked="checked"<?php }}else{ ?><?php } ?> type="checkbox" class="custom_chk" name="tinnoibat" /></td>
			</tr>
		</table>
	</div>		
	
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Ngày đăng:</td>
				<td class="right_text_field">
					<input value="<?php if(isset($result->datepost)) { print date('Y-m-d',strtotime($result->datepost)); }else{ print date('Y-m-d');} ?>" type="text" name="datepost" style="width:100px;" class="datepicker" />
				</td>
			</tr>
		</table>
	</div>		
	
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Tiêu đề:</td>
				<td class="right_text_field"><input value="<?php if(isset($result->title)) { print $result->title; }else{ print '';} ?>" type="text" name="title" /></td>
			</tr>
		</table>
	</div>	
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Sắp xếp:</td>
				<td class="right_text_field"><input value="<?php if(isset($result->order)) { print $result->order; }else{ print '0';} ?>" type="text" name="order" /></td>
			</tr>
		</table>
	</div>
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Hình ảnh:</td>
				<td class="right_text_field"><input type="file" name="image" data-type="image" /><?php if(isset($result->image)){ if($result->image!=''){ ?> - <a class="fancyboxClick" href="<?=PATH_URL.DIR_NEWS_IMAGES.$result->image?>">Review</a><?php }} ?></td>
			</tr>
		</table>
	</div>
	
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Thể loại:</td>
				<td class="right_text_field">
					<select name="parent_id" id="parent_id" style="padding:5px;">
						<option value="0">[ Chọn thể loại ]</option>
						<?php
							if(!empty($op_list)){
								foreach($op_list as $row){
								//$parent_id= (!empty($result->parent_id))?$result->parent_id:0;
								$parent_id = ($this->session->userdata('category_filter'))? $this->session->userdata('category_filter') : ((!empty($result->parent_id))?$result->parent_id:0);
								$selected= ($row->id==$parent_id)?'selected':'';
						?>
						<option value="<?=$row->id?>" <?=$selected?>><?=$row->name?></option>
						<?php
								}
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
				<td class="left_text_field">Mô tả:</td>
				<td class="right_text_field"><textarea name="description" cols="" rows="8"><?php if(isset($result->description)) { print $result->description; }else{ print '';} ?></textarea></td>
			</tr>
		</table>
	</div>

	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Nội dung:</td>
				<td class="right_text_field" style="padding-right: 0;">
					<textarea name="contentAdmincp" id="contentAdmincp" cols="" rows="8"><?php if(isset($result->content)) { print $result->content; }else{ print '';} ?></textarea>
					<script type="text/javascript">
						var oEdit1 = new InnovaEditor("oEdit1");
						oEdit1.width = "100%";
						oEdit1.cmdAssetManager="modalDialogShow('"+root+"static/editor/assetmanager/assetmanager.php',640,445);";
						oEdit1.REPLACE("contentAdmincp");
					</script>
				</td>
			</tr>
		</table>
	</div>

	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<?php
					$tags='';
					if(!empty($all_tags))
					{
						foreach($all_tags as $row){
							$tags.= $row->tags.',';
						}
						$tags=  substr($tags, 0, -1);
					}
				?>
				<td class="left_text_field">Tags:</td>
				<td class="right_text_field"><input value="<?=$tags?>" type="text" name="tags" id="tags" /></td>
			</tr>
		</table>
	</div>
	
	</form>
</div>