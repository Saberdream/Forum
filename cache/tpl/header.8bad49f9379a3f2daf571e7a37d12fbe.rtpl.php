<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html lang="<?php echo $site_lang;?>">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php if( !empty($title) ){ ?><?php echo display( $title );?> - <?php } ?><?php echo $lang_menu_top["admin_cp"];?></title>
<meta name="description" content="Prototype de page html contenant un design évolutif et adaptable aux différentes machines." />
<link rel="stylesheet" href="http://forum.prog/adm/style/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="http://forum.prog/adm/style/css/jquery-ui.min.css" type="text/css">
<link rel="stylesheet" href="http://forum.prog/adm/style/css/jquery.uploadifive.css" type="text/css">
<link rel="stylesheet" href="http://forum.prog/adm/style/css/jquery.tagit.css" type="text/css">
<link rel="stylesheet" href="http://forum.prog/adm/style/css/jquery.colorbox.css" type="text/css">
<link rel="stylesheet" href="http://forum.prog/adm/style/css/base.css" type="text/css">
<script type="text/javascript" src="http://forum.prog/adm/style/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="http://forum.prog/adm/style/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://forum.prog/adm/style/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://forum.prog/adm/style/js/jquery.jeditable.min.js"></script>
<script type="text/javascript" src="http://forum.prog/adm/style/js/jquery.uploadifive.min.js"></script>
<script type="text/javascript" src="http://forum.prog/adm/style/js/jquery.tagit.min.js"></script>
<script type="text/javascript" src="http://forum.prog/adm/style/js/jquery.colorbox.min.js"></script>
<script type="text/javascript" src="http://forum.prog/adm/style/js/script.js"></script>
</head>

<body>
	<nav class="navbar navbar-default">
	  <div class="container">
	   <div class="row">
	   <div class="col-sm-12">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#header-navbar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>                        
		  </button>
		  <span class="navbar-brand hidden-sm"><?php echo $lang_menu_top["admin_cp"];?></span>
		</div>
		<div class="collapse navbar-collapse" id="header-navbar">
		  <?php if( $user["admin"] ){ ?>
		  <ul class="nav navbar-nav">
			<li><a href="http://forum.prog/adm/index.php" tabindex="-1"><?php echo $lang_menu_top["home"];?></a></li>
			<li><a href="http://forum.prog/adm/categories.php" tabindex="-1"><?php echo $lang_menu_top["forums"];?></a></li>
			<li><a href="http://forum.prog/adm/users.php" tabindex="-1"><?php echo $lang_menu_top["users"];?></a></li>
			<li><a href="http://forum.prog/adm/pictures.php" tabindex="-1"><?php echo $lang_menu_top["images"];?></a></li>
			<li><a href="http://forum.prog/adm/system.php" tabindex="-1"><?php echo $lang_menu_top["system"];?></a></li>
		  </ul>
		  <?php } ?>
		  <ul class="nav navbar-nav navbar-right">
			<?php if( $user["admin"] ){ ?>
			<li><a href="http://forum.prog/adm/alerts.php"><span class="glyphicon glyphicon-exclamation-sign"></span> <?php echo $lang_menu_top["alerts"];?> <span class="badge"><?php echo $nb_alerts;?></span></a></li>
			<?php } ?>
			<li class="dropdown">
			  <a href="" class="dropdown-toggle" data-toggle="dropdown"><?php echo $lang_menu_top["welcome"];?>, <b class="text-primary"><?php echo $user["user_name"];?></b> <span class="caret"></span></a>
			  <ul class="dropdown-menu">
				<li class="dropdown-header"><?php echo $lang_menu_top["session_time_left"];?></li>
				<li class="divider"></li>
				<li><a href="http://forum.prog/adm/user-edit.php?id=<?php echo $user["user_id"];?>" tabindex="-1"><span class="glyphicon glyphicon-cog"></span> <?php echo $lang_menu_top["modify_account"];?></a></li>
				<li><a href="http://forum.prog/logout.php?sid=<?php echo encrypt( $user["sessionid"] );?>" tabindex="-1"><span class="glyphicon glyphicon-log-out"></span> <?php echo $lang_menu_top["logout"];?></a></li>
			  </ul>
			</li>
		  </ul>
		</div>
	   </div>
	   </div>
	  </div>
	</nav>
