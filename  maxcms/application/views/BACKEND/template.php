<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="<?=PATH_URL.'static/images/admin/'?>favicon.ico" type="image/x-icon" rel="icon" />
<link href="<?=PATH_URL.'static/images/admin/'?>favicon.ico" type="image/x-icon" rel="shortcut icon" />
<link rel="stylesheet" href="<?=PATH_URL.'static/css/admin/'?>styles.css" type="text/css">
<link rel="stylesheet" href="<?=PATH_URL.'static/css/'?>jquery-ui.css" type="text/css">

<script type="text/javascript">
var root = '<?=PATH_URL?>';
<?php if($this->uri->segment(2)!='update_profile' && $this->uri->segment(2)!='setting'){ ?>
var module = '<?=$module?>';
<?php } ?>
</script>
<script type="text/javascript" src="<?=PATH_URL.'static/js/jquery-1.8.1.min.js'?>"></script>
<script type="text/javascript" src="<?=PATH_URL.'static/js/jquery-ui-1.8.custom.min.js'?>"></script>
<script type="text/javascript" src="<?=PATH_URL.'static/editor/scripts/innovaeditor.js'?>"></script>
<script type="text/javascript" src="<?=PATH_URL.'static/js/admin/jquery.ToTop.js'?>"></script>
<script type="text/javascript" src="<?=PATH_URL.'static/js/admin/custom_forms.js'?>"></script>
<script type="text/javascript" src="<?=PATH_URL.'static/js/admin/jquery.form.js'?>"></script>
<script type="text/javascript" src="<?=PATH_URL.'static/js/admin/jquery.url.js'?>"></script>
<script type="text/javascript" src="<?=PATH_URL.'static/js/admin/jquery.fancybox-1.3.4.pack.js'?>"></script>
<script type="text/javascript" src="<?=PATH_URL.'static/js/admin/admin.js'?>"></script>
<script type="text/javascript" src="<?=PATH_URL.'static/js/admin/timepicker.js'?>"></script>

<script type="text/javascript" src="<?=PATH_URL.'static/js/jquery.upload.js'?>"></script>
<script type="text/javascript" src="<?=PATH_URL.'static/js/flowplayer/flowplayer-3.2.11.min.js'?>"></script>
<?php echo $_scripts; ?>
<title>Admin Control Panel</title>
<!--[if ie 6]>
<style>
html, body{
behavior: url('<?php echo PATH_URL.'static/css/' ?>csshover3.htc');
}

.png{
behavior: url('<?php echo PATH_URL.'static/css/' ?>iepngfix.htc');
}
</style>
<script type="text/javascript" src="<?php echo PATH_URL.'static/js/' ?>iepngfix_tilebg.js"></script>
<![endif]-->
</head>
<body>

<div class="topNav">
	<div class="nameNav"><?=modules::run('admincp/getSetting','title-admincp')?></div>
	<div class="userNav">
		<ul>
			<li class="profile"><a href="<?=PATH_URL.'admincp/update_profile'?>"><img alt="profile" src="<?=PATH_URL.'static/images/admin/userPic.png'?>" /><span><?=$this->session->userdata('userInfo')?></span></a></li>
			<li class="li_last_child"><a href="<?=PATH_URL.'admincp/logout'?>"><img alt="profile" src="<?=PATH_URL.'static/images/admin/logout.png'?>" /><span>Logout</span></a></li>
		</ul>
	</div>
</div>

<div class="header">
	<div class="logo"><img alt="" src="<?=PATH_URL.'static/images/admin/logo.png'?>" /></div>
	<?php if($this->uri->segment(2)!='permission'){ ?>
	<div class="midNav">
		<?php
			if($this->uri->segment(3)!='update' && $this->uri->segment(3)!='answer' && $this->uri->segment(2)!='update_profile' && $this->uri->segment(2)!='setting'){
				if($this->uri->segment(2)!='manager_modules' && $this->uri->segment(2)!='logs'){
		?>
		<ul>
			<?php if($this->uri->segment(2)!='contact'){ ?>
			<li><a href="<?=PATH_URL.'admincp/'.$module.'/update/'?>"><span class="add_new">Thêm Mới</span></a></li>
			<li><a href="javascript:void(0)" onclick="showStatusAll()"><span class="show_items">&nbsp;Hiện&nbsp;</span></a></li>
			<li><a href="javascript:void(0)" onclick="hideStatusAll()"><span class="hide_items">&nbsp;&nbsp;Ẩn&nbsp;&nbsp;</span></a></li>
			<?php } ?>
			<li class="midNav_last_child"><a href="javascript:void(0)" onclick="deleteAll()"><span class="delete_items">&nbsp;&nbsp;Xóa&nbsp;&nbsp;</span></a></li>
		</ul>
		<?php }}else{ ?>
		<ul>
			<?php if($this->uri->segment(2)!='update_profile' && $this->uri->segment(2)!='setting'){ ?>
			<li <?php ($this->uri->segment(2)=='contact') ? print 'class="midNav_last_child"' : print '' ?>><a href="<?=PATH_URL.'admincp/'.$module.'/#/back'?>"><span class="back">Quay Lại</span></a></li>
			<?php } ?>
			
			<?php if($this->uri->segment(2)=='accounts' && $this->uri->segment(4)!=''){ ?>
			<li><a href="javascript:void(0)" onclick="resetPerm()"><span class="reset">Reset Permission</span></a></li>
			<?php } ?>
			
	
				<li><a href="javascript:void(0)" onclick="apply()"><span id="applyContent" class="apply">Áp Dụng</span></a></li>	
				<li><a href="javascript:void(0)" onclick="save()"><span id="saveContent" class="save">Lưu & Thoát</span></a></li>
				<li class="midNav_last_child"><a href="javascript:void(0)" onclick="save_new()"><span id="save_newContent" class="save">Lưu & Thêm Mới</span></a></li>
			
		</ul>
		<?php } ?>
	</div>
	<?php } ?>
</div>

<div id="content">
	<table cellspacing="0" cellpadding="0" border="0" width="100%">
		<tr>
			<td valign="top" width="237">
				<div class="left_content">
				<ul id="grouped_menu">
					<li class="menu_level_1"><a <?php if($this->uri->segment(2)=='news'){ ?>class="active"<?php } ?> href="<?=PATH_URL.'admincp/news/'?>"><span class="menu_items">Tin Tức</span></a></li>
					<li class="menu_level_1"><a <?php if($this->uri->segment(2)=='category_news'){ ?>class="active"<?php } ?> href="<?=PATH_URL.'admincp/category_news/'?>"><span class="menu_items">Danh Mục Tin Tức</span></a></li>
					<li class="menu_level_1"><a <?php if($this->uri->segment(2)=='banner_position'){ ?>class="active"<?php } ?> href="<?=PATH_URL.'admincp/banner_position/'?>"><span class="menu_items">Quản Lý Banner</span></a></li>
				</ul>	
				</div>
			</td>

			<td valign="top">
				<div class="right_content">
					<?=$content?>
				</div>
			</td>
		</tr>
	</table>
</div>

<div class="footer"><div class="text_footer">&copy; Copyright 2012. All rights reserved. Developed by <a target="_blank" href="http://climaxinteractive.com">Climax</a></div></div>

<div id="loader">
	<div class="bg_mask"></div>
	<div class="processing">
		<div class="bg_processing"><img alt="Loading" src="<?=PATH_URL.'static/images/admin/ajax-loader.gif'?>" /><br/>System is processing...</div>
	</div>
</div>
</body>
</html>