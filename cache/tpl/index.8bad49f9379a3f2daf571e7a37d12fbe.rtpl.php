<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "header" );?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-10 col-sm-push-1 col-md-8 col-md-push-2 col-lg-8 col-lg-push-2">
			<ol class="breadcrumb">
			  <li><a href="http://forum.prog/adm/index.php"><?php echo $lang_menu_top["admin_cp"];?></a></li>
			  <li class="active"><?php echo $lang_menu_top["home"];?></li>
			</ol>
			<div class="panel panel-default">
			<div class="panel-body">
				<p class="text-muted"><?php echo $lang_index["welcome_message"];?></p>
				<h4><?php echo $lang_index["rapid_links"];?>:</h4>
				<div class="list-group">
				   <a class="list-group-item" href="http://forum.prog/adm/pictures-upload.php"><span class="glyphicon glyphicon-level-up"></span> <?php echo $lang_index["send_images"];?></a>
				   <a class="list-group-item" href="http://forum.prog/adm/users.php"><span class="glyphicon glyphicon-user"></span> <?php echo $lang_index["members_list"];?></a>
				   <a class="list-group-item" href="http://forum.prog/adm/alerts.php"><span class="glyphicon glyphicon-exclamation-sign"></span> <?php echo $lang_index["alerts_list"];?></a>
				   <a class="list-group-item" href="http://forum.prog/adm/configuration.php"><span class="glyphicon glyphicon-cog"></span> <?php echo $lang_index["site_configuration"];?></a>
				   <a class="list-group-item" href="http://forum.prog/adm/system.php"><span class="glyphicon glyphicon-wrench"></span> <?php echo $lang_index["server_informations"];?></a>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>
<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "footer" );?>