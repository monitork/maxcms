<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="<?=PATH_URL.'static/images/admin/'?>favicon.ico" type="image/x-icon" rel="icon" />
<link href="<?=PATH_URL.'static/images/admin/'?>favicon.ico" type="image/x-icon" rel="shortcut icon" />
<link rel="stylesheet" href="<?=PATH_URL.'static/css/admin/login.css'?>" type="text/css">
<script type="text/javascript">
var root = '<?=PATH_URL?>';
</script>
<script type="text/javascript" src="<?=PATH_URL.'static/js/jquery-1.8.1.min.js'?>"></script>
<script type="text/javascript" src="<?=PATH_URL.'static/js/admin/login.js'?>"></script>
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

<div id="body">
	<div id="main">
		<div class="bg_login png">
			<div class="divInpUsername">
				<p>
					<span>Email</span>
					<input  onkeypress="return EnterLogin(event)" class="inpLogin" type="text" id="loginUser" />
				</p>
				<p class="erorr_username"><img src="<?=PATH_URL.'static/images/admin/login/erorr_username.png'?>" /></p>
			</div>

			<div class="divInpPass">
				<p>
					<span>Mật khẩu</span>
					<input style="width: 237px; margin-left: 45px;" onkeypress="return EnterLogin(event)" class="inpLogin" type="password" id="loginPass" />
				</p>
				<p class="erorr_password"><img src="<?=PATH_URL.'static/images/admin/login/erorr_pass.png'?>" /></p>
			</div>

			<div id="divError"></div>
			<div onclick="return login();" class="btLogin"></div>
		</div>
	</div>
</div>
</body>
</html>