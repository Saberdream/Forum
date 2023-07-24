<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html lang="<?php echo $site_lang;?>">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php if( !empty($title) ){ ?><?php echo display( $title );?> - <?php } ?><?php echo display( $site_name );?></title>
<meta name="description" content="Prototype de page html contenant un design évolutif et adaptable aux différentes machines." />
<link rel="icon" type="image/png" href="http://forum.prog/favicon.ico" />
<link rel="stylesheet" href="http://forum.prog/styles/base/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="http://forum.prog/styles/base/css/jquery-ui.min.css" type="text/css">
<link rel="stylesheet" href="http://forum.prog/styles/base/css/jquery.uploadifive.css" type="text/css">
<link rel="stylesheet" href="http://forum.prog/styles/base/css/jquery.tagit.css" type="text/css">
<link rel="stylesheet" href="http://forum.prog/styles/base/css/jquery.colorbox.css" type="text/css">
<link rel="stylesheet" href="http://forum.prog/styles/base/css/flipswitch.min.css" type="text/css">
<link rel="stylesheet" href="http://forum.prog/styles/base/css/font-awesome.min.css" type="text/css">
<link rel="stylesheet" href="http://forum.prog/styles/base/css/base.css" type="text/css">
<link rel="stylesheet" href="http://forum.prog/styles/base/css/btn-black.css" type="text/css">
<script type="text/javascript" src="http://forum.prog/styles/base/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="http://forum.prog/styles/base/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://forum.prog/styles/base/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://forum.prog/styles/base/js/jquery.jeditable.min.js"></script>
<script type="text/javascript" src="http://forum.prog/styles/base/js/jquery.uploadifive.min.js"></script>
<script type="text/javascript" src="http://forum.prog/styles/base/js/jquery.tagit.min.js"></script>
<script type="text/javascript" src="http://forum.prog/styles/base/js/jquery.colorbox.min.js"></script>
<script type="text/javascript" src="http://forum.prog/styles/base/js/script.js"></script>
</head>

<body>
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
		<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-10 col-md-push-1 col-lg-8 col-lg-push-2">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#header-navbar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>                        
		  </button>
		  <a class="navbar-brand" href=""><?php echo display( $site_name );?></a>
		</div>
		<div class="collapse navbar-collapse" id="header-navbar">
		  <ul class="nav navbar-nav">
			<li><a href="http://forum.prog/index" tabindex="-1"><?php echo $lang_menu_top["home"];?></a></li>
			<li><a href="http://forum.prog/forums" tabindex="-1"><?php echo $lang_menu_top["forums"];?></a></li>
			<li><a href="http://forum.prog/articles" tabindex="-1"><?php echo $lang_menu_top["articles"];?></a></li>
		  </ul>
		  <?php if( $user["user_rank"] >= USER ){ ?>
		  <ul class="nav navbar-nav navbar-right">
			<?php if( $activate_pm == 1 ){ ?><li><a href="http://forum.prog/pm"><span class="glyphicon glyphicon-envelope"></span> <?php echo $lang_menu_top["private_messages"];?></a></li><?php } ?>
			<li><a href="http://forum.prog/notifications"><span class="glyphicon glyphicon-bell"></span> <?php echo $lang_menu_top["notifications"];?> <span class="badge"><?php echo $nb_notifications;?></span></a></li>
			<li class="dropdown">
			  <a class="dropdown-toggle" data-toggle="dropdown" href=""><?php echo $lang_menu_top["welcome"];?>, <b class="text-primary"><?php echo $user["user_name"];?></b> <span class="caret"></span></a>
			  <ul class="dropdown-menu">
				<li class="dropdown-header"><?php echo $lang_menu_top["session_time_left"];?></li>
				<li class="divider"></li>
				<li><a href="http://forum.prog/settings" tabindex="-1"><span class="glyphicon glyphicon-cog"></span> <?php echo $lang_menu_top["modify_account"];?></a></li>
				<li><a href="http://forum.prog/logout?sid=<?php echo encrypt( $user["sessionid"] );?>" tabindex="-1"><span class="glyphicon glyphicon-log-out"></span> <?php echo $lang_menu_top["logout"];?></a></li>
			  </ul>
			</li>
		  </ul>
		  <?php }else{ ?>
		  <ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
			  <a class="dropdown-toggle" data-toggle="dropdown" href=""><span class="glyphicon glyphicon-user"></span> <?php echo $lang_menu_top["my_account"];?> <span class="caret"></span></a>
			  <ul class="dropdown-menu">
				<li><a href="http://forum.prog/register" tabindex="-1"><span class="glyphicon glyphicon-user"></span> <?php echo $lang_menu_top["register"];?></a></li>
				<li><a href="http://forum.prog/login" tabindex="-1"><span class="glyphicon glyphicon-log-in"></span> <?php echo $lang_menu_top["login"];?></a></li>
				<li class="divider"></li>
				<li><a href="http://forum.prog/recover" tabindex="-1"><span class="glyphicon glyphicon-question-sign"></span> <?php echo $lang_menu_top["forgotten_password"];?></a></li>
			  </ul>
			</li>
		  </ul>
		  <?php } ?>
		</div>
		</div>
		</div>
	  </div>
	</nav>
