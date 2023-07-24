<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "header" );?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-push-3 col-md-7 col-md-push-4 col-lg-6 col-lg-push-4">
			<ol class="breadcrumb">
			  <li class="active"><span class="glyphicon glyphicon-home"></span> <?php echo $lang_menu_top["home"];?></li>
			  <li class="active"><?php echo $lang_viewonline["users_connected"];?></li>
			</ol>
			<div class="panel panel-default">
			<div class="panel-body">
				<?php if( $nb > 0 ){ ?>
				<p><span class="text-muted"><?php echo $lang_viewonline["number_users_connected"];?></span></p>
				<div class="row">
					<div class="col-sm-9 col-md-9 col-lg-9"><ul class="pagination"><?php echo $pagination;?></ul></div>
					<div class="hidden-xs col-sm-3 col-md-3 col-lg-3 text-right">
					  <p><?php echo $lang_viewonline["total"];?>: <strong><?php echo $nb;?></strong></p>
					  <p><?php echo $lang_viewonline["rows"];?> <strong><?php echo $offset+1;?> - <?php echo $end;?></strong></p>
					</div>
				</div>
				<table class="table table-bordered table-hover text-center">
				<tr>
				  <th><?php echo $lang_viewonline["user"];?></th>
				  <?php if( $user["user_rank"] >= ADMIN ){ ?><th><?php echo $lang_viewonline["ip"];?></th><?php } ?>
				  <th><?php echo $lang_viewonline["last_time"];?></th>
				  <th><?php echo $lang_viewonline["robot"];?></th>
				</tr>
				<?php $counter1=-1; if( isset($rows) && is_array($rows) && sizeof($rows) ) foreach( $rows as $key1 => $value1 ){ $counter1++; ?>
				<tr>
				  <td><?php if( $value1["user_rank"]>GUEST ){ ?><a class="user-profile" href="http://forum.prog/profil/<?php echo strtolower( $value1["user_name"] );?>"><b<?php if( $value1["user_rank"]>USER ){ ?> class="text-danger"<?php } ?>><?php echo $value1["user_name"];?></b></a><?php }else{ ?><?php if( !empty($value1["connected_robot"]) ){ ?><?php echo $lang_viewonline["robot"];?><?php }else{ ?><?php echo $lang_viewonline["anonymous"];?><?php } ?><?php } ?></td>
				  <?php if( $user["user_rank"] >= ADMIN ){ ?><td><a href="http://www.ip-adress.com/whois/<?php echo $value1["connected_ip"];?>" target="_blank"><?php echo $value1["connected_ip"];?></a></td><?php } ?>
				  <td><?php echo date('d/m/Y H:i', $value1["connected_last"]); ?></td>
				  <td><?php if( !empty($value1["connected_robot"]) ){ ?><b><?php echo $value1["connected_robot"];?></b><?php }else{ ?>Non<?php } ?></td>
				</tr>
				<?php } ?>
				</table>
				<div class="row">
					<div class="col-sm-9 col-md-9 col-lg-9"><ul class="pagination"><?php echo $pagination;?></ul></div>
					<div class="hidden-xs col-sm-3 col-md-3 col-lg-3 text-right">
					  <p><?php echo $lang_viewonline["total"];?>: <strong><?php echo $nb;?></strong></p>
					  <p><?php echo $lang_viewonline["rows"];?> <strong><?php echo $offset+1;?> - <?php echo $end;?></strong></p>
					</div>
				</div>
				<?php } ?>
			</div>
			</div>
		</div>
		
		<div class="col-sm-3 col-sm-pull-9 col-md-3 col-md-pull-6 col-lg-2 col-lg-pull-4">
			<div class="list-group">
			<a class="list-group-item" href="http://forum.prog/index"><?php echo $lang_menu_top["home"];?></a>
			<a class="list-group-item active" href="http://forum.prog/viewonline"><?php echo $lang_viewonline["users_connected"];?></a>
			</div>
		</div>
	</div>
</div>
<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "footer" );?>