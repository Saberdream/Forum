<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "header" );?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-push-3 col-md-7 col-md-push-4 col-lg-6 col-lg-push-4">
			<ol class="breadcrumb">
			  <li><a href="http://forum.prog/adm/index.php"><?php echo $lang_menu_top["admin_cp"];?></a></li>
			  <li class="active"><?php echo $lang_alerts["manage_alerts"];?></li>
			  <?php if( $mode == 'closed' ){ ?><li class="active"><?php echo $lang_alerts["alerts_treated"];?></li><?php } ?>
			</ol>
			<div class="panel panel-default">
			<div class="panel-body">
			<?php if( $total > 0 ){ ?>
			<form class="form-inline form-search" method="get" action="http://forum.prog/adm/alerts.php?mode=<?php echo $mode;?>">
			  <input type="hidden" name="mode" value="<?php echo $mode;?>" />
			  <div class="form-group">
				<input type="text" name="search" id="search" value="<?php echo display( $search["keywords"] );?>" class="form-control input-sm" placeholder="<?php echo $lang_alerts["search"];?>" />
			  </div>
			  <div class="form-group">
				<select class="form-control input-sm" name="type">
				  <?php $counter1=-1; if( isset($search["types"]) && is_array($search["types"]) && sizeof($search["types"]) ) foreach( $search["types"] as $key1 => $value1 ){ $counter1++; ?>
				  <option value="<?php echo $key1;?>"<?php if( !empty($search["keywords"]) && $search["type"]==$key1 ){ ?> selected<?php } ?>><?php echo $value1;?></option>
				  <?php } ?>
				</select>
			  </div>
			  <div class="form-group">
				<label for="exact"><input type="checkbox" name="exact" id="exact" value="1" <?php if( !empty($search["keywords"]) && $search["exact"] ){ ?>checked <?php } ?>/> <?php echo $lang_alerts["exact"];?></label>
			  </div>
			  <button class="btn btn-default btn-sm" type="submit"><span class="glyphicon glyphicon-search"></span></button>
			  <?php if( !empty($search["keywords"]) ){ ?><a class="btn btn-primary btn-sm pull-right hidden-xs" href="http://forum.prog/adm/alerts.php?mode=<?php echo $mode;?>&page=1"><?php echo $lang_alerts["back"];?></a><?php } ?>
			</form>
			
			<?php if( $nb > 0 ){ ?>
			<?php if( !empty($search["keywords"]) ){ ?>
			<div class="alert alert-success text-center"><?php echo $lang_alerts["search_results"];?></div>
			<?php } ?>
			<div class="row">
				<div class="col-sm-9 col-md-9 col-lg-9"><ul class="pagination"><?php echo $pagination;?></ul></div>
				<div class="hidden-xs col-sm-3 col-md-3 col-lg-3 text-right">
				  <p><?php echo $lang_alerts["total"];?>: <strong><?php echo $nb;?></strong></p>
				  <p><?php echo $lang_alerts["rows"];?> <strong><?php echo $offset+1;?> - <?php echo $end;?></strong></p>
				</div>
			</div>
			<form method="post" action="http://forum.prog/adm/alerts.php?mode=<?php echo $mode;?>">
			<input type="hidden" name="mode" value="<?php echo $mode;?>" />
			<input type="hidden" name="token" value="<?php echo $token;?>" />
			<div class="form-group">
			<div class="form-inline">
			<select class="form-control input-sm" name="action">
			<option><?php echo $lang_alerts["action"];?></option>
			<?php if( $mode == 'new' ){ ?><option value="close"><?php echo $lang_alerts["mark_as_treated"];?></option><?php } ?>
			<option value="delete"><?php echo $lang_alerts["delete"];?></option>
			</select>
			<button class="action-submit btn btn-sm btn-default"><?php echo $lang_alerts["validate"];?></button>
			</div>
			</div>
			
			<table class="table table-striped table-bordered table-hover text-center">
			<tr>
			<th><input type="checkbox" id="selectall" /></th>
			<th><?php echo $lang_alerts["id"];?></th>
			<th><?php echo $lang_alerts["reason"];?></th>
			<th><?php echo $lang_alerts["username"];?></th>
			<th><?php echo $lang_alerts["author"];?></th>
			<th><?php echo $lang_alerts["date"];?></th>
			<th><?php echo $lang_alerts["ip"];?></th>
			<th><?php echo $lang_alerts["action"];?></th>
			</tr>
			<?php $counter1=-1; if( isset($rows) && is_array($rows) && sizeof($rows) ) foreach( $rows as $key1 => $value1 ){ $counter1++; ?>
			<tr>
			<td><input class="checkbox-item" type="checkbox" name="sup[]" value="<?php echo display( $value1["alert_id"] );?>" /></td>
			<td><?php echo display( $value1["alert_id"] );?></td>
			<td><?php echo display( $value1["alert_reason"] );?></td>
			<td><?php echo display( $value1["post_username"] );?></td>
			<td><strong<?php if( $value1["alert_rank"]>=MODERATOR ){ ?> class="moderator"<?php } ?>><?php echo display( $value1["user_name"] );?></strong></td>
			<td><?php echo date('d/m/Y H:i', $value1["alert_time"]); ?></td>
			<td><?php echo display( $value1["alert_ip"] );?></td>
			<td><a data-toggle="tooltip" title="<?php echo $lang_alerts["go_to_alert_page"];?>" href="http://forum.prog/adm/viewalert.php?id=<?php echo display( $value1["alert_id"] );?>" class="btn btn-info btn-xs"><?php echo $lang_alerts["view"];?></a></td>
			</tr>
			<?php } ?>
			</table>
			</form>
			<div class="row">
				<div class="col-sm-9 col-md-9 col-lg-9"><ul class="pagination"><?php echo $pagination;?></ul></div>
				<div class="hidden-xs col-sm-3 col-md-3 col-lg-3 text-right">
				  <p><?php echo $lang_alerts["total"];?>: <strong><?php echo $nb;?></strong></p>
				  <p><?php echo $lang_alerts["rows"];?> <strong><?php echo $offset+1;?> - <?php echo $end;?></strong></p>
				</div>
			</div>
			<script>
			var text_action_confirmation = '<?php echo escape_quotes( $lang_alerts["confirm_action"] );?>';
			var text_select_element = '<?php echo escape_quotes( $lang_alerts["select_element"] );?>';
			var text_select_action = '<?php echo escape_quotes( $lang_alerts["select_action"] );?>';
			var text_cancel = '<?php echo escape_quotes( $lang_alerts["cancel"] );?>';
			</script>
			<div id="dialog-confirm" title="<?php echo $lang_alerts["alert"];?>"></div>
			<?php }elseif( !empty($search["keywords"]) ){ ?>
			<div class="alert alert-warning text-center"><?php echo $lang_alerts["search_no_result"];?></div>
			<?php } ?>
			<?php }else{ ?>
			<div class="alert alert-danger text-center"><?php echo $lang_alerts["no_data"];?></div>
			<?php } ?>
			</div>
			</div>
		</div>
		
		<div class="col-sm-3 col-sm-pull-9 col-md-3 col-md-pull-6 col-lg-2 col-lg-pull-4">
			<div class="list-group">
			<a class="list-group-item<?php if( $mode == 'new' ){ ?> active<?php } ?>" href="http://forum.prog/adm/alerts.php"><?php echo $lang_menu_top["alerts"];?></a>
			<a class="list-group-item<?php if( $mode == 'closed' ){ ?> active<?php } ?>" href="http://forum.prog/adm/alerts.php?mode=closed"><?php echo $lang_alerts["alerts_treated"];?></a>
			<a class="list-group-item" href="http://forum.prog/adm/banlist.php"><?php echo $lang_alerts["banlist"];?></a>
			</div>
		</div>
	</div>
</div>
<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "footer" );?>