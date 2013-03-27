<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta property="og:title" content="<?=$title?>" /> 
        <meta property="og:description" content="<?=(!empty($meta_description))?$meta_description:'S'?>" /> 
        <meta property="og:video" content="<?=$meta_video?>"/>
        <meta name="keywords" content="<?=(!empty($meta_keywords))?$meta_keywords:''?>" />
        <meta name="description" content="<?=(!empty($meta_description))?$meta_description:'.'?>" />
        <base href="<?=PATH_URL ?>" />
		<link rel="stylesheet" href="<?=PATH_URL?>static/css/reset.css" type="text/css">
		<link rel="stylesheet" href="<?=PATH_URL?>static/css/jRating.jquery.css" type="text/css">
        <link rel="stylesheet" href="<?=PATH_URL?>static/css/styles.css" type="text/css">       
        <link rel="icon" href="static/images/icon/favicon.gif" type="image/x-icon"/>

		<script type="text/javascript" src="<?=PATH_URL?>static/js/jquery-1.8.1.min.js"></script>
		<script type="text/javascript" src="<?=PATH_URL?>static/js/jquery.bxslider.min.js"></script>
		<script type="text/javascript" src="<?=PATH_URL?>static/js/jRating.jquery.min.js"></script>
		<script type="text/javascript" src="<?=PATH_URL?>static/js/script.js"></script>

        <script type="text/javascript">
         var root='<?=PATH_URL?>';
        </script>
        <title><?= $title ?></title>
        <!--[if ie 6]>
        <style>
        html, body{
        behavior: url('<?php echo PATH_URL . 'static/css/csshover3.htc' ?>');
        }
        
        .png{
        behavior: url('<?php echo PATH_URL . 'static/css/iepngfix.htc' ?>');
        }
        </style>
        <script type="text/javascript" src="<?php echo PATH_URL . 'static/js/iepngfix_tilebg.js' ?>"></script>
        <![endif]-->
       
    </head>
    <body>
       
        <div class="wrapper">
			<div class="header">
				<?=Modules::run('news/block_header') ?>
			</div>
            <div class="content">
                <?= $content ?>
            </div>
			<div class="footer">
				<?=Modules::run('news/block_footer') ?>
			</div>
        </div>
		
    </body>
</html>