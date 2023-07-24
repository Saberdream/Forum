<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "header" );?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-push-3 col-md-7 col-md-push-4 col-lg-6 col-lg-push-4">
			<ol class="breadcrumb">
			  <li><a href="http://forum.prog/pm"><?php echo $lang_menu_top["private_messages"];?></a></li>
			  <li class="active"><?php echo $lang_pm["mailbox"];?></li>
			</ol>
			<div class="panel panel-default">
			<div class="panel-body">
			<?php if( $user["user_rank"] >= USER ){ ?>
			<?php if( $total > 0 ){ ?>
			<form class="form-inline form-search" method="get" action="http://forum.prog/pm">
			  <div class="form-group">
				<input type="text" name="search" id="search" value="<?php echo display( $search["keywords"] );?>" class="form-control input-sm" placeholder="<?php echo $lang_pm["search"];?>" />
			  </div>
			  <div class="form-group">
				<select class="form-control input-sm" name="type">
				  <?php $counter1=-1; if( isset($search["types"]) && is_array($search["types"]) && sizeof($search["types"]) ) foreach( $search["types"] as $key1 => $value1 ){ $counter1++; ?>
				  <option value="<?php echo $key1;?>"<?php if( !empty($search["keywords"]) && $search["type"]==$key1 ){ ?> selected<?php } ?>><?php echo $value1;?></option>
				  <?php } ?>
				</select>
			  </div>
			  <div class="form-group">
				<label for="exact"><input type="checkbox" name="exact" id="exact" value="1" <?php if( !empty($search["keywords"]) && $search["exact"] ){ ?>checked <?php } ?>/> <?php echo $lang_pm["exact"];?></label>
			    <button class="btn btn-default btn-sm" type="submit"><span class="glyphicon glyphicon-search"></span></button>
			  </div>
			  <?php if( !empty($search["keywords"]) ){ ?><a class="btn btn-primary btn-sm pull-right hidden-xs" href="http://forum.prog/pm?page=1"><?php echo $lang_pm["back"];?></a><?php } ?>
			</form>

			<?php if( $nb > 0 ){ ?>
			<?php if( !empty($search["keywords"]) ){ ?>
			<div class="alert alert-success text-center"><?php echo $lang_pm["search_results"];?></div>
			<?php } ?>
			<div class="row">
				<div class="col-sm-9 col-md-9 col-lg-9"><ul class="pagination"><?php echo $pagination;?></ul></div>
				<div class="hidden-xs col-sm-3 col-md-3 col-lg-3 text-right">
				  <p><?php echo $lang_pm["total"];?>: <strong><?php echo $nb;?></strong></p>
				  <p><?php echo $lang_pm["rows"];?> <strong><?php echo $offset+1;?> - <?php echo $end;?></strong></p>
				</div>
			</div>

			<form method="post" action="http://forum.prog/pm">
			<input type="hidden" name="token" value="<?php echo $token;?>" />
			<div class="form-group hidden-xs">
			<div class="form-inline">
			<select class="form-control input-sm" name="action">
			<option><?php echo $lang_pm["action"];?></option>
			<option value="mark_read"><?php echo $lang_pm["mark_read"];?></option>
			<option value="mark_unread"><?php echo $lang_pm["mark_unread"];?></option>
			<option value="delete"><?php echo $lang_pm["delete"];?></option>
			</select>
			<button class="action-submit btn btn-sm btn-success"><?php echo $lang_pm["validate"];?></button>
			</div>
			</div>

			<table class="list-topics table text-center">
			<tr>
			<th class="check hidden-xs"><input type="checkbox" id="selectall" /></th>
			<th><?php echo $lang_pm["title"];?></th>
			<th class="author hidden-xs"><?php echo $lang_pm["author"];?></th>
			<th class="last hidden-xs"><?php echo $lang_pm["last"];?></th>
			<th class="participants hidden-xs"><?php echo $lang_pm["participants"];?></th>
			</tr>
			<?php $counter1=-1; if( isset($rows) && is_array($rows) && sizeof($rows) ) foreach( $rows as $key1 => $value1 ){ $counter1++; ?>
			<tr<?php if( $value1["participant_read"]==0 ){ ?> class="topic_unread"<?php } ?>>
			<td class="hidden-xs"><input class="checkbox-item" type="checkbox" name="sup[]" value="<?php echo $value1["participant_pmid"];?>" /></td>
			<td class="topic-name text-left <?php if( $value1["pm_closed"] == 1 ){ ?>topic_lock<?php }else{ ?>topic1<?php } ?>"><a href="http://forum.prog/viewpm?id=<?php echo $value1["participant_pmid"];?>&amp;page=1"><?php echo display( $value1["pm_name"] );?></a></td>
			<td class="small hidden-xs"><strong<?php if( $value1["pm_rank"] >= ADMIN ){ ?> class="text-success"<?php }elseif( $value1["pm_rank"] == MODERATOR ){ ?> class="text-danger"<?php }else{ ?> class="text-muted"<?php } ?>><?php echo $value1["pm_username"];?></strong></td>
			<td class="small hidden-xs"><a href="http://forum.prog/viewpm?id=<?php echo $value1["participant_pmid"];?>&amp;page=<?php if( $value1["pm_posts"]>$posts_per_page ){ ?><?php echo ceil($value1["pm_posts"]/$posts_per_page); ?><?php }else{ ?>1<?php } ?>"><?php echo date('d/m/Y H:i', $value1["pm_last"]); ?></a></td>
			<td class="small hidden-xs"><?php echo implode(', ', array_slice(explode(';', $value1["pm_participants"]), 0, 3)); ?><?php if( $value1["pm_nb_participants"]>3 ){ ?>...<?php } ?> (<?php echo $value1["pm_nb_participants"];?>)</td>
			</tr>
			<?php } ?>
			</table>
			</form>

			<div class="row">
				<div class="col-sm-9 col-md-9 col-lg-9"><ul class="pagination"><?php echo $pagination;?></ul></div>
				<div class="hidden-xs col-sm-3 col-md-3 col-lg-3 text-right">
				  <p><?php echo $lang_pm["total"];?>: <strong><?php echo $nb;?></strong></p>
				  <p><?php echo $lang_pm["rows"];?> <strong><?php echo $offset+1;?> - <?php echo $end;?></strong></p>
				</div>
			</div>

			<script>
			var text_action_confirmation = '<?php echo escape_quotes( $lang_pm["confirm_action"] );?>';
			var text_select_element = '<?php echo escape_quotes( $lang_pm["select_element"] );?>';
			var text_select_action = '<?php echo escape_quotes( $lang_pm["select_action"] );?>';
			var text_cancel = '<?php echo escape_quotes( $lang_pm["cancel"] );?>';
			</script>
			<div id="dialog-confirm" title="<?php echo $lang_pm["alert"];?>"></div>
			<?php }elseif( !empty($search["keywords"]) ){ ?>
			<div class="alert alert-warning text-center"><?php echo $lang_pm["search_no_result"];?></div>
			<?php } ?>
			<?php }else{ ?>
			<div class="alert alert-warning text-center"><?php echo $lang_pm["no_pm"];?></div>
			<?php } ?>
			<?php }else{ ?>
			<div class="alert alert-warning text-center"><?php echo $lang_pm["not_logged_in"];?></div>
			<?php } ?>
			</div>
			</div>
		</div>

		<div class="col-sm-3 col-sm-pull-9 col-md-3 col-md-pull-6 col-lg-2 col-lg-pull-4">
			<div class="list-group">
			<a class="list-group-item" href="http://forum.prog/newpm"><?php echo $lang_pm["new_message"];?></a>
			<a class="list-group-item active" href="http://forum.prog/pm"><?php echo $lang_pm["mailbox"];?></a>
			<a class="list-group-item" href="http://forum.prog/blacklist"><?php echo $lang_pm["blacklist"];?></a>
			</div>
		</div>
	</div>
</div>
<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "footer" );?>