<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "header" );?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-push-3 col-md-7 col-md-push-4 col-lg-6 col-lg-push-4">
			<ol class="breadcrumb">
			  <li><a href="http://forum.prog/pm"><?php echo $lang_menu_top["private_messages"];?></a></li>
			  <li class="active"><?php echo $lang_bl["blacklist"];?></li>
			</ol>
			
			<?php if( $user["user_rank"] >= USER ){ ?>
			<div class="panel panel-default">
			<div class="panel-body">
				<?php if( $nb > 0 ){ ?>
				<div class="row">
					<div class="col-sm-9 col-md-9 col-lg-9"><ul class="pagination"><?php echo $pagination;?></ul></div>
					<div class="hidden-xs col-sm-3 col-md-3 col-lg-3 text-right">
					  <p><?php echo $lang_bl["total"];?> : <strong><?php echo $nb;?></strong></p>
					  <p><?php echo $lang_bl["rows"];?> <strong><?php echo $offset+1;?> - <?php echo $end;?></strong></p>
					</div>
				</div>
				
				<form method="post" action="http://forum.prog/blacklist">
				<input type="hidden" name="token" value="<?php echo $token;?>" />
				<div class="form-group">
				<button class="action-submit btn btn-danger" data-toggle="tooltip" title="<?php echo $lang_bl["delete_selection"];?>"><?php echo $lang_bl["delete"];?></button>
				</div>

				<table class="table table-striped table-bordered table-hover text-center table-condensed">
				<tr>
				  <th><input type="checkbox" id="selectall" /></th>
				  <th><?php echo $lang_bl["username"];?></th>
				  <th><?php echo $lang_bl["date"];?></th>
				</tr>
				<?php $counter1=-1; if( isset($rows) && is_array($rows) && sizeof($rows) ) foreach( $rows as $key1 => $value1 ){ $counter1++; ?>
				<tr>
				  <td><input class="checkbox-item" type="checkbox" name="sup[]" value="<?php echo $value1["bl_id"];?>" /></td>
				  <td><?php echo display( $value1["user_name"] );?></td>
				  <td><?php echo date('d/m/Y H:i', $value1["bl_time"]); ?></td>
				</tr>
				<?php } ?>
				</table>
				</form>
				
				<div class="row">
					<div class="col-sm-9 col-md-9 col-lg-9"><ul class="pagination"><?php echo $pagination;?></ul></div>
					<div class="hidden-xs col-sm-3 col-md-3 col-lg-3 text-right">
					  <p><?php echo $lang_bl["total"];?> : <strong><?php echo $nb;?></strong></p>
					  <p><?php echo $lang_bl["rows"];?> <strong><?php echo $offset+1;?> - <?php echo $end;?></strong></p>
					</div>
				</div>

				<div id="dialog-confirm" title="<?php echo $lang_bl["alert"];?>"></div>
				<script>
				var text_action_confirmation = '<?php echo escape_quotes( $lang_bl["confirm_action"] );?>';
				var text_select_element = '<?php echo escape_quotes( $lang_bl["select_element"] );?>';
				var text_select_action = '<?php echo escape_quotes( $lang_bl["select_action"] );?>';
				var text_cancel = '<?php echo escape_quotes( $lang_bl["cancel"] );?>';
				</script>
				<?php }else{ ?>
				<div class="alert alert-warning text-center"><?php echo $lang_bl["no_blacklisted_user"];?></div>
				<?php } ?>
			</div>
			</div>
			
			<div class="panel panel-default">
			<div class="panel-body">
			<h4 class="text-primary"><?php echo $lang_bl["add_new_users"];?></h4>
			<?php if( !empty($form["error"]) ){ ?>
			<div class="alert alert-danger">
			<?php echo $lang_bl["error_occurred"];?>:
			<ul><?php $counter1=-1; if( isset($form["error"]) && is_array($form["error"]) && sizeof($form["error"]) ) foreach( $form["error"] as $key1 => $value1 ){ $counter1++; ?><li><?php echo $value1;?></li><?php } ?></ul>
			</div>
			<?php }elseif( !empty($form["ok"]) ){ ?>
			<div class="alert alert-success"><?php echo $form["ok"];?></div>
			<?php } ?>
			<form method="post" action="http://forum.prog/blacklist">
			<div class="form-group">
			<label class="sr-only" for="users"><?php echo $lang_bl["add_new_users"];?></label>
			<input type="text" class="form-control" name="users" id="users" value="<?php echo display( $form["users"] );?>" placeholder="<?php echo $lang_bl["usernames"];?>" />
			</div>
			<button type="submit" class="btn btn-sm btn-primary"><?php echo $lang_bl["add"];?></button>
			<input type="hidden" name="token" value="<?php echo $form["token"];?>" />
			</form>
			</div>
			</div>
			
			<script>
			$(function(){
				$('#users').tagit({
				  singleFieldDelimiter: ';',
				  placeholderText: '<?php echo escape_quotes( $lang_bl["usernames"] );?>'
				});
			});
			</script>
			<?php }else{ ?>
			<div class="alert alert-warning text-center"><?php echo $lang_bl["not_logged_in"];?></div>
			<?php } ?>
		</div>
		
		<div class="col-sm-3 col-sm-pull-9 col-md-3 col-md-pull-6 col-lg-2 col-lg-pull-4">
			<div class="list-group">
			<a class="list-group-item" href="http://forum.prog/newpm"><?php echo $lang_bl["new_message"];?></a>
			<a class="list-group-item" href="http://forum.prog/pm"><?php echo $lang_bl["mailbox"];?></a>
			<a class="list-group-item active" href="http://forum.prog/blacklist"><?php echo $lang_bl["blacklist"];?></a>
			</div>
		</div>
	</div>
</div>
<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "footer" );?>