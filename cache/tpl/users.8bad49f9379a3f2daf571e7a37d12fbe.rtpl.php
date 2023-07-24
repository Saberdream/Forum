<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "header" );?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-push-3 col-md-7 col-md-push-4 col-lg-6 col-lg-push-4">
			<ol class="breadcrumb">
			  <li><a href="http://forum.prog/adm/index.php"><?php echo $lang_menu_top["admin_cp"];?></a></li>
			  <li class="active"><?php echo $lang_users["manage_users"];?></li>
			</ol>
			<div class="panel panel-default">
			<div class="panel-body">
			<?php if( $total > 0 ){ ?>
			<form class="form-inline form-search" method="get" action="http://forum.prog/adm/users.php">
			  <div class="form-group">
				<input type="text" name="search" id="search" value="<?php echo display( $search["keywords"] );?>" class="form-control input-sm" placeholder="<?php echo $lang_users["search"];?>" />
			  </div>
			  <div class="form-group">
				<select class="form-control input-sm" name="type">
				  <?php $counter1=-1; if( isset($search["types"]) && is_array($search["types"]) && sizeof($search["types"]) ) foreach( $search["types"] as $key1 => $value1 ){ $counter1++; ?>
				  <option value="<?php echo $key1;?>"<?php if( !empty($search["keywords"]) && $search["type"]==$key1 ){ ?> selected<?php } ?>><?php echo $value1;?></option>
				  <?php } ?>
				</select>
			  </div>
			  <div class="form-group">
				<label for="exact"><input type="checkbox" name="exact" id="exact" value="1" <?php if( !empty($search["keywords"]) && $search["exact"] ){ ?>checked <?php } ?>/> <?php echo $lang_users["exact"];?></label>
			  </div>
			  <button class="btn btn-default btn-sm" type="submit"><span class="glyphicon glyphicon-search"></span></button>
			  <?php if( !empty($search["keywords"]) ){ ?><a class="btn btn-primary btn-sm pull-right hidden-xs" href="http://forum.prog/adm/users.php?page=1"><?php echo $lang_users["back"];?></a><?php } ?>
			</form>

			<?php if( $nb > 0 ){ ?>
			<?php if( !empty($search["keywords"]) ){ ?>
			<div class="alert alert-success text-center"><?php echo $lang_users["search_results"];?></div>
			<?php } ?>
			<div class="row">
				<div class="col-sm-9 col-md-9 col-lg-9"><ul class="pagination"><?php echo $pagination;?></ul></div>
				<div class="hidden-xs col-sm-3 col-md-3 col-lg-3 text-right">
				  <p><?php echo $lang_users["total"];?>: <strong><?php echo $nb;?></strong></p>
				  <p><?php echo $lang_users["rows"];?> <strong><?php echo $offset+1;?> - <?php echo $end;?></strong></p>
				</div>
			</div>
			<form method="post" action="http://forum.prog/adm/users.php">
			<input type="hidden" name="token" value="<?php echo $token;?>" />
			<div class="form-group">
			<div class="form-inline">
			<select class="form-control input-sm" name="action">
			<option><?php echo $lang_users["action"];?></option>
			<option value="ban"><?php echo $lang_users["ban"];?></option>
			<option value="deban"><?php echo $lang_users["unban"];?></option>
			<option value="delete"><?php echo $lang_users["delete"];?></option>
			</select>
			<button class="action-submit btn btn-sm btn-success"><?php echo $lang_users["validate"];?></button>
			</div>
			</div>
			<table class="table table-striped table-bordered table-hover text-center">
			<tr>
			<th><input type="checkbox" id="selectall" /></th>
			<th><?php echo $lang_users["id"];?></th>
			<th><?php echo $lang_users["username"];?></th>
			<th><?php echo $lang_users["ip"];?></th>
			<th><?php echo $lang_users["date"];?></th>
			<th><?php echo $lang_users["last"];?></th>
			<th><?php echo $lang_users["action"];?></th>
			</tr>
			<?php $counter1=-1; if( isset($rows) && is_array($rows) && sizeof($rows) ) foreach( $rows as $key1 => $value1 ){ $counter1++; ?>
			<tr>
			<td><input class="checkbox-item" type="checkbox" name="sup[]" value="<?php echo display( $value1["user_id"] );?>"<?php if( $value1["user_rank"] == FOUNDER || $value1["user_rank"] == GUEST ){ ?> disabled<?php } ?> /></td>
			<td><?php echo display( $value1["user_id"] );?></td>
			<td><a class="user-profile" href="http://forum.prog/profil/<?php echo strtolower( $value1["user_name"] );?>"><strong<?php if( $value1["user_rank"] >= ADMIN ){ ?> class="text-success"<?php }elseif( $value1["user_rank"] == MODERATOR ){ ?> class="text-danger"<?php }else{ ?> class="text-muted"<?php } ?>><?php echo $value1["user_name"];?></strong></a></td>
			<td><?php echo display( $value1["user_ip"] );?></td>
			<td><?php echo date('d/m/Y H:i', $value1["user_time"]); ?></td>
			<td><?php echo date('d/m/Y H:i', $value1["user_last"]); ?></td>
			<td><a href="http://forum.prog/adm/user-edit.php?id=<?php echo display( $value1["user_id"] );?>" class="btn btn-info btn-xs" data-toggle="tooltip" title="<?php echo $lang_users["edit_user_informations"];?>"><span class="glyphicon glyphicon-cog"></span></a></td>
			</tr>
			<?php } ?>
			</table>
			</form>
			<div class="row">
				<div class="col-sm-9 col-md-9 col-lg-9"><ul class="pagination"><?php echo $pagination;?></ul></div>
				<div class="hidden-xs col-sm-3 col-md-3 col-lg-3 text-right">
				  <p><?php echo $lang_users["total"];?>: <strong><?php echo $nb;?></strong></p>
				  <p><?php echo $lang_users["rows"];?> <strong><?php echo $offset+1;?> - <?php echo $end;?></strong></p>
				</div>
			</div>
			<script>
			var text_action_confirmation = '<?php echo escape_quotes( $lang_users["confirm_action"] );?>';
			var text_select_element = '<?php echo escape_quotes( $lang_users["select_element"] );?>';
			var text_select_action = '<?php echo escape_quotes( $lang_users["select_action"] );?>';
			var text_cancel = '<?php echo escape_quotes( $lang_users["cancel"] );?>';
			
			$(function(){
				$('.user-profile').colorbox({
					iframe: true,
					width: '100%',
					maxWidth: '590px',
					height: '75%'
				});
			});
			</script>
			<div id="dialog-confirm" title="<?php echo $lang_users["alert"];?>"></div>
			<?php }elseif( !empty($search["keywords"]) ){ ?>
			<div class="alert alert-warning text-center"><?php echo $lang_users["search_no_result"];?></div>
			<?php } ?>
			<?php }else{ ?>
			<div class="alert alert-danger text-center"><?php echo $lang_users["no_user"];?></div>
			<?php } ?>
			</div>
			</div>
		</div>

		<div class="col-sm-3 col-sm-pull-9 col-md-3 col-md-pull-6 col-lg-2 col-lg-pull-4">
			<div class="list-group">
			<a class="list-group-item active" href="http://forum.prog/adm/users.php"><?php echo $lang_menu_top["users"];?></a>
			<a class="list-group-item" href="http://forum.prog/adm/banlist.php"><?php echo $lang_users["banlist"];?></a>
			<a class="list-group-item" href="http://forum.prog/adm/avatars.php"><?php echo $lang_users["avatars"];?></a>
			</div>
		</div>
	</div>
</div>
<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "footer" );?>