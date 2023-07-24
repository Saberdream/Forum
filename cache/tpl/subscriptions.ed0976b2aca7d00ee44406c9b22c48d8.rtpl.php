<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "header" );?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-push-3 col-md-7 col-md-push-4 col-lg-6 col-lg-push-4">
			<ol class="breadcrumb">
			  <li class="active"><span class="glyphicon glyphicon-user"></span> <?php echo $lang_subscriptions["account"];?></li>
			  <li class="active"><?php echo $lang_subscriptions["subscriptions"];?></li>
			</ol>

			<?php if( $user["user_rank"] >= USER ){ ?>
			<?php if( $nb > 0 ){ ?>
			<div class="panel panel-default">
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-9 col-md-9 col-lg-9"><ul class="pagination"><?php echo $pagination;?></ul></div>
					<div class="hidden-xs col-sm-3 col-md-3 col-lg-3 text-right">
					  <p><?php echo $lang_subscriptions["total"];?> : <strong><?php echo $nb;?></strong></p>
					  <p><?php echo $lang_subscriptions["rows"];?> <strong><?php echo $offset+1;?> - <?php echo $end;?></strong></p>
					</div>
				</div>
				
				<form method="post" action="http://forum.prog/subscriptions">
				<input type="hidden" name="token" value="<?php echo $token;?>" />
				<div class="form-group">
				<button class="action-submit btn btn-danger" data-toggle="tooltip" title="<?php echo $lang_subscriptions["delete_selection"];?>"><?php echo $lang_subscriptions["delete"];?></button>
				</div>

				<table class="table table-bordered table-hover text-center">
				<tr>
				  <th><input type="checkbox" id="selectall" /></th>
				  <th><?php echo $lang_subscriptions["topic"];?></th>
				</tr>
				<?php $counter1=-1; if( isset($rows) && is_array($rows) && sizeof($rows) ) foreach( $rows as $key1 => $value1 ){ $counter1++; ?>
				<tr>
				  <td><input class="checkbox-item" type="checkbox" name="sup[]" value="<?php echo $value1["sub_id"];?>" /></td>
				  <td class="text-left"><a href="http://forum.prog/topic/<?php echo $value1["topic_slug"];?>/<?php echo $value1["sub_topicid"];?>/1"><?php echo wordwrap(display($value1["topic_name"]), 25, "\n", true); ?></a></td>
				</tr>
				<?php } ?>
				</table>
				</form>

				<div class="row">
					<div class="col-sm-9 col-md-9 col-lg-9"><ul class="pagination"><?php echo $pagination;?></ul></div>
					<div class="hidden-xs col-sm-3 col-md-3 col-lg-3 text-right">
					  <p><?php echo $lang_subscriptions["total"];?> : <strong><?php echo $nb;?></strong></p>
					  <p><?php echo $lang_subscriptions["rows"];?> <strong><?php echo $offset+1;?> - <?php echo $end;?></strong></p>
					</div>
				</div>

				<div id="dialog-confirm" title="<?php echo $lang_subscriptions["alert"];?>"></div>
				<script>
				var text_action_confirmation = '<?php echo escape_quotes( $lang_subscriptions["confirm_action"] );?>';
				var text_select_element = '<?php echo escape_quotes( $lang_subscriptions["select_element"] );?>';
				var text_select_action = '<?php echo escape_quotes( $lang_subscriptions["select_action"] );?>';
				var text_cancel = '<?php echo escape_quotes( $lang_subscriptions["cancel"] );?>';
				</script>
			</div>
			</div>
			<?php }else{ ?>
			<div class="alert alert-warning text-center"><?php echo $lang_subscriptions["no_topic_followed"];?></div>
			<?php } ?>
			<?php }else{ ?>
			<div class="alert alert-warning text-center"><?php echo $lang_subscriptions["not_logged_in"];?></div>
			<?php } ?>
		</div>
		
		<div class="col-sm-3 col-sm-pull-9 col-md-3 col-md-pull-6 col-lg-2 col-lg-pull-4">
			<div class="list-group">
			<a class="list-group-item" href="http://forum.prog/settings"><?php echo $lang_subscriptions["account"];?></a>
			<a class="list-group-item" href="http://forum.prog/notifications"><?php echo $lang_subscriptions["notifications"];?></a>
			<a class="list-group-item active" href="http://forum.prog/subscriptions"><?php echo $lang_subscriptions["subscriptions"];?></a>
			<a class="list-group-item" href="http://forum.prog/avatars"><?php echo $lang_subscriptions["avatars"];?></a>
			</div>
		</div>
	</div>
</div>
<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "footer" );?>