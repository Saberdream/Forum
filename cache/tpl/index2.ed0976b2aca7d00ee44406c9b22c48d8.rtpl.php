<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "header" );?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-push-3 col-md-7 col-md-push-4 col-lg-6 col-lg-push-4">
			<ol class="breadcrumb">
			  <li class="active"><span class="glyphicon glyphicon-home"></span> <?php echo $lang_menu_top["home"];?></li>
			</ol>
			<div class="panel panel-default">
			<div class="panel-body">
				Bienvenue sur <?php echo display( $site_name );?><?php if( $user["user_rank"] >= USER ){ ?>, <b class="text-primary"><?php echo $user["user_name"];?></b><?php } ?>.
			</div>
			</div>
			
			<table class="table table-bordered table-striped">
				<?php $counter1=-1; if( isset($user) && is_array($user) && sizeof($user) ) foreach( $user as $key1 => $value1 ){ $counter1++; ?>
				<tr>
					<td><?php echo $key1;?></td>
					<td><?php if( $key1=='sessionid' ){ ?><?php echo md5( $value1 );?><?php }else{ ?><?php echo $value1;?><?php } ?></td>
				</tr>
				<?php } ?>
				<?php $counter1=-1; if( isset($debug) && is_array($debug) && sizeof($debug) ) foreach( $debug as $key1 => $value1 ){ $counter1++; ?>
				<tr>
					<td><?php echo $key1;?></td>
					<td><?php echo $value1;?></td>
				</tr>
				<?php } ?>
			</table>
		</div>
		
		<div class="col-sm-3 col-sm-pull-9 col-md-3 col-md-pull-6 col-lg-2 col-lg-pull-4">
			<div class="list-group">
			<a class="list-group-item active" href="http://forum.prog/index"><?php echo $lang_menu_top["home"];?></a>
			<a class="list-group-item" href="http://forum.prog/viewonline"><?php echo $lang_index["users_connected"];?></a>
			</div>
		</div>
	</div>
</div>
<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "footer" );?>