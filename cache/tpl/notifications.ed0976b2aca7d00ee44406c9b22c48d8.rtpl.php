<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "header" );?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-push-3 col-md-7 col-md-push-4 col-lg-6 col-lg-push-4">
			<ol class="breadcrumb">
			  <li class="active"><span class="glyphicon glyphicon-user"></span> <?php echo $lang_notifications["account"];?></li>
			  <li class="active"><?php echo $lang_notifications["notifications"];?></li>
			</ol>
			
			<?php if( $user["user_rank"] >= USER ){ ?>
			<div class="panel panel-default">
			<div class="panel-body">
				<?php if( $nb > 0 ){ ?>
				<p><a class="bt-forum btn btn-success btn-sm" href="http://forum.prog/notifications?reset=1&amp;token=<?php echo $token;?>"><?php echo $lang_notifications["reset_notifications"];?></a></p>
				
				<div class="row">
					<div class="col-sm-9 col-md-9 col-lg-9"><ul class="pagination"><?php echo $pagination;?></ul></div>
					<div class="hidden-xs col-sm-3 col-md-3 col-lg-3 text-right">
					  <p><?php echo $lang_notifications["total"];?> : <strong><?php echo $nb;?></strong></p>
					  <p><?php echo $lang_notifications["rows"];?> <strong><?php echo $offset+1;?> - <?php echo $end;?></strong></p>
					</div>
				</div>
				
				<table class="table table-bordered table-hover text-center">
				<tr>
				  <th><?php echo $lang_notifications["notification"];?></th>
				  <th><?php echo $lang_notifications["date"];?></th>
				</tr>
				<?php $counter1=-1; if( isset($rows) && is_array($rows) && sizeof($rows) ) foreach( $rows as $key1 => $value1 ){ $counter1++; ?>
				<tr<?php if( $value1["notif_viewed"] == 0 ){ ?> class="warning"<?php } ?>>
				  <td><?php if( !empty($value1["notif_url"]) ){ ?><a href="http://forum.prog/<?php echo display( $value1["notif_url"] );?>"><?php echo display( $value1["notif_name"] );?></a><?php }else{ ?><?php echo display( $value1["notif_name"] );?><?php } ?><?php if( !empty($value1["notif_desc"]) ){ ?><br><span class="text-muted small"><?php echo display( $value1["notif_desc"] );?></span><?php } ?></td>
				  <td><?php echo date('d/m/Y H:i', $value1["notif_time"]); ?></td>
				</tr>
				<?php } ?>
				</table>
				
				<div class="row">
					<div class="col-sm-9 col-md-9 col-lg-9"><ul class="pagination"><?php echo $pagination;?></ul></div>
					<div class="hidden-xs col-sm-3 col-md-3 col-lg-3 text-right">
					  <p><?php echo $lang_notifications["total"];?> : <strong><?php echo $nb;?></strong></p>
					  <p><?php echo $lang_notifications["rows"];?> <strong><?php echo $offset+1;?> - <?php echo $end;?></strong></p>
					</div>
				</div>
				<?php }else{ ?>
				<div class="text-center"><?php echo $lang_notifications["no_notification"];?></div>
				<?php } ?>
			</div>
			</div>
			<?php }else{ ?>
			<div class="alert alert-warning text-center"><?php echo $lang_notifications["not_logged_in"];?></div>
			<?php } ?>
		</div>
		
		<div class="col-sm-3 col-sm-pull-9 col-md-3 col-md-pull-6 col-lg-2 col-lg-pull-4">
			<div class="list-group">
			<a class="list-group-item" href="http://forum.prog/settings"><?php echo $lang_notifications["account"];?></a>
			<a class="list-group-item active" href="http://forum.prog/notifications"><?php echo $lang_notifications["notifications"];?></a>
			<a class="list-group-item" href="http://forum.prog/subscriptions"><?php echo $lang_notifications["subscriptions"];?></a>
			<a class="list-group-item" href="http://forum.prog/avatars"><?php echo $lang_notifications["avatars"];?></a>
			</div>
		</div>
	</div>
</div>
<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "footer" );?>