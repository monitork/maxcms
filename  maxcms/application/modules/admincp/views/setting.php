<script type="text/javascript">
function save(){
	var options = {
		success:       showResponse  // post-submit callback 
    };
	$('#frmManagement').ajaxSubmit(options);
}

function showResponse(responseText, statusText, xhr, $form) {
	if(responseText=='success-setting'){
		var url = $.url(document.location.href);
		if(url.fsegment(1)=='save'){
			location.reload();
		}else{
			location.href=root+"admincp/setting/#/save";
		}
	}
}
function create_sitemap()
{
   var url = root+"site_map/";
   $.post(url,{},function(data){
		alert("Tạo SiteMap Thành Công !"); 
        $(".link_sitemap").show();
     });
}
</script>
<div class="gr_perm_error" style="display:none;">
	<p><strong>FAILURE: </strong><span id="txt_error">Permission Denied.</span></p>
</div>
<div class="gr_perm_success" style="display:none;">
	<p><strong>SAVE SUCCESS.</strong></p>
</div>
<div class="table">
	<div class="head_table"><div class="head_title_edit">Setting</div></div>
	<div class="clearAll"></div>

	<form id="frmManagement" action="<?=PATH_URL.'admincp/setting/'?>" method="post" enctype="multipart/form-data">
	<div class="row_text_field_first">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<input type="hidden" value="title-admincp" name="hd_slugAdmincp[]" />
				<td class="left_text_field">Title Admincp:</td>
				<td class="right_text_field"><input value="<?php if(isset($setting[0]->content)){ print $setting[0]->content; }else{ print'Name of website'; } ?>" type="text" name="contentAdmincp[]" /></td>
			</tr>
		</table>
	</div>
    <div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Site Map:</td>
				<td class="right_text_field"><a class="a_addnew" href="javascript:void(0)" onclick="create_sitemap();" >Create</a>  </td>
			</tr>
		</table>
	</div>
    <div class="row_text_field link_sitemap">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Link Site Map:</td>
				<td class="right_text_field"><a href="<?=PATH_URL?>sitemap.xml" target="_blank"><?=PATH_URL?>sitemap.xml</a></td>
			</tr>
		</table>
	</div>
	</form>
</div>