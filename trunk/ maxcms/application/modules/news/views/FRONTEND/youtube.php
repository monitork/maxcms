<!DOCTYPE HTML>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<title>Youtube</title>
<script type="text/javascript" src="<?=PATH_URL?>static/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript">
$(function() {
	$('#_btnYoutube').click(function() {
		post();
	});
});
function post(){
	var count;
	$('#loading').fadeIn();
	$.post(
		'<?=PATH_URL?>news/moveVideo',
		{},
		function(data){
			if(data){
				if(data.st=='SUCCESS'){
					$('#loading').fadeOut();
					count= parseInt($('#count-upload').text()) + 1;
					$('#count-upload').text(count);
					post();
				}
			}
			console.log(data);
		},'json'
	);	
}
</script>
</head>
<body>
	<strong id="count-upload">0</strong> Video upload
	<br/>
	<input type="button" id="_btnYoutube" value="Move video" />

	<img src="<?=PATH_URL?>static/images/icon/loading.gif" align="middle" id="loading" style="display:none;" alt="" />
</body>
</html>