<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "header" );?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-push-3 col-md-7 col-md-push-4 col-lg-6 col-lg-push-4">
			<ol class="breadcrumb">
			  <li><a href="http://forum.prog/adm/index.php"><?php echo $lang_menu_top["admin_cp"];?></a></li>
			  <li class="active"><?php echo $lang_menu_top["system"];?></li>
			</ol>
			<div class="panel panel-default">
			<div class="panel-body">
			<h4 class="text-primary"><?php echo $lang_system["system_modules"];?></h4>
			<table class="table table-bordered">
			<tr>
			<th><?php echo $lang_system["name"];?></th>
			<th><?php echo $lang_system["value"];?></th>
			</tr>
			<?php $counter1=-1; if( isset($system_modules) && is_array($system_modules) && sizeof($system_modules) ) foreach( $system_modules as $key1 => $value1 ){ $counter1++; ?>
			<tr>
			<td style="background-color:#ecf6ff;width:50%;"><?php echo $key1;?></td>
			<td style="background-color:#f1f1f1;width:50%;"><?php echo $value1;?></td>
			</tr>
			<?php } ?>
			</table>
			<h4 class="text-primary"><?php echo $lang_system["php_functions"];?></h4>
			<table class="table table-bordered">
			<tr>
			<th><?php echo $lang_system["name"];?></th>
			<th><?php echo $lang_system["value"];?></th>
			</tr>
			<?php $counter1=-1; if( isset($functions) && is_array($functions) && sizeof($functions) ) foreach( $functions as $key1 => $value1 ){ $counter1++; ?>
			<tr>
			<td style="background-color:#ecf6ff;width:50%;"><?php echo $key1;?></td>
			<td style="background-color:#f1f1f1;width:50%;"><?php echo $value1;?></td>
			</tr>
			<?php } ?>
			</table>
			</div>
			</div>
		</div>

		<div class="col-sm-3 col-sm-pull-9 col-md-3 col-md-pull-6 col-lg-2 col-lg-pull-4">
			<div class="list-group">
			<a class="list-group-item" href="http://forum.prog/adm/configuration.php"><?php echo $lang_system["site_configuration"];?></a>
			<a class="list-group-item active" href="http://forum.prog/adm/system.php"><?php echo $lang_menu_top["system"];?></a>
			<a class="list-group-item" href="http://forum.prog/adm/logs.php"><?php echo $lang_system["error_logs"];?></a>
			</div>
		</div>
	</div>
</div>
<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "footer" );?>