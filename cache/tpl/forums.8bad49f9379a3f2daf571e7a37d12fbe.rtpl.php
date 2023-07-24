<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "header" );?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-push-3 col-md-7 col-md-push-4 col-lg-6 col-lg-push-4">
			<ol class="breadcrumb">
			  <li><a href="http://forum.prog/adm/index.php"><?php echo $lang_menu_top["admin_cp"];?></a></li>
			  <li class="active"><?php echo $lang_forums["manage_forums"];?></li>
			  <li class="active"><a href="http://forum.prog/adm/categories.php"><?php echo $lang_forums["categories"];?></a></li>
			  <li class="active"><?php echo display( $cat["cat_name"] );?></li>
			</ol>
			<div class="panel panel-default">
			<div class="panel-body">
			<p class="text-muted"><?php echo $lang_forums["page_description"];?></p>
			<?php if( $nb > 0 ){ ?>
			<table class="table table-striped table-bordered table-hover text-center">
			<tr>
			<th><?php echo $lang_forums["name"];?></th>
			<th><?php echo $lang_forums["topics"];?></th>
			<th><?php echo $lang_forums["posts"];?></th>
			<th><?php echo $lang_forums["order"];?></th>
			<th><?php echo $lang_forums["action"];?></th>
			</tr>
			<?php $counter1=-1; if( isset($rows) && is_array($rows) && sizeof($rows) ) foreach( $rows as $key1 => $value1 ){ $counter1++; ?>
			<tr>
			<td class="text-left"><a href="http://forum.prog/forum/<?php echo $value1["forum_slug"];?>/<?php echo $value1["forum_id"];?>/1"><?php echo display( $value1["forum_name"] );?></a><?php if( $value1["forum_closed"]==1 ){ ?> <span class="glyphicon glyphicon-lock"></span><?php } ?></td>
			<td><?php echo intval( $value1["forum_topics"] );?></td>
			<td><?php echo intval( $value1["forum_posts"] );?></td>
			<td><?php echo intval( $value1["forum_order"] );?></td>
			<td>
			<?php if( $value1["forum_order"] >= $nb ){ ?>
			<a href="" class="btn btn-info btn-xs disabled"><span class="glyphicon glyphicon-triangle-bottom"></span></a>
			<?php }else{ ?>
			<a href="http://forum.prog/adm/forums.php?cat=<?php echo $cat["cat_id"];?>&amp;action=order_down&amp;id=<?php echo $value1["forum_id"];?>&amp;token=<?php echo $token;?>" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-triangle-bottom"></span></a>
			<?php } ?>
			<?php if( $value1["forum_order"] == 1 ){ ?>
			<a href="" class="btn btn-info btn-xs disabled"><span class="glyphicon glyphicon-triangle-top"></span></a>
			<?php }else{ ?>
			<a href="http://forum.prog/adm/forums.php?cat=<?php echo $cat["cat_id"];?>&amp;action=order_up&amp;id=<?php echo $value1["forum_id"];?>&amp;token=<?php echo $token;?>" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-triangle-top"></span></a>
			<?php } ?>
			<a href="http://forum.prog/adm/forums.php?cat=<?php echo $cat["cat_id"];?>&amp;action=synchronize&amp;id=<?php echo $value1["forum_id"];?>&amp;token=<?php echo $token;?>" class="synchronize btn btn-warning btn-xs" data-toggle="tooltip" title="<?php echo $lang_forums["sync_forum"];?>"><span class="glyphicon glyphicon-refresh"></span></a>
			<a href="http://forum.prog/adm/forum-edit.php?id=<?php echo $value1["forum_id"];?>" class="btn btn-success btn-xs" data-toggle="tooltip" title="<?php echo $lang_forums["modify_parameters"];?>"><span class="glyphicon glyphicon-cog"></span></a>
			<a href="http://forum.prog/adm/forums.php?cat=<?php echo $cat["cat_id"];?>&amp;action=delete&amp;id=<?php echo $value1["forum_id"];?>&amp;token=<?php echo $token;?>" class="delete btn btn-danger btn-xs" data-toggle="tooltip" title="<?php echo $lang_forums["delete_forum"];?>"><span class="glyphicon glyphicon-remove"></span></a>
			</td>
			</tr>
			<?php } ?>
			</table>
			<script>
			var text_action_confirmation = '<?php echo escape_quotes( $lang_forums["confirm_action"] );?>';
			var text_delete_confirmation = '<?php echo escape_quotes( $lang_forums["confirm_delete"] );?>';
			var text_cancel = '<?php echo escape_quotes( $lang_forums["cancel"] );?>';
			</script>
			<div id="dialog-confirm" title="<?php echo $lang_forums["alert"];?>"></div>
			<?php }else{ ?>
			<div class="alert alert-danger"><?php echo $lang_forums["no_forum"];?></div>
			<?php } ?>
			</div>
			</div>

			<div class="panel panel-default">
			<div class="panel-body">
			<h4 class="text-primary"><?php echo $lang_forums["add_new_forum"];?></h4>
			<?php if( !empty($form["error"]) ){ ?>
			<div class="alert alert-danger">
			<?php echo $lang_forums["errors_occurred"];?>:
			<ul><?php $counter1=-1; if( isset($form["error"]) && is_array($form["error"]) && sizeof($form["error"]) ) foreach( $form["error"] as $key1 => $value1 ){ $counter1++; ?><li><?php echo $value1;?></li><?php } ?></ul>
			</div>
			<?php }elseif( !empty($form["ok"]) ){ ?>
			<div class="alert alert-success"><?php echo $form["ok"];?></div>
			<?php } ?>
			<form method="post" action="http://forum.prog/adm/forums.php?cat=<?php echo intval( $cat["cat_id"] );?>">
			<div class="form-group">
			<label class="sr-only" for="new_forum"><?php echo $lang_forums["forum_name"];?></label>
			<input type="text" class="form-control" name="new_forum" id="new_forum" value="" placeholder="<?php echo $lang_forums["enter_newforum_name"];?>" />
			</div>
			<button type="submit" class="btn btn-sm btn-primary"><?php echo $lang_forums["add"];?></button>
			<input type="hidden" name="token" value="<?php echo $form["token"];?>" />
			</form>
			</div>
			</div>
		</div>

		<div class="col-sm-3 col-sm-pull-9 col-md-3 col-md-pull-6 col-lg-2 col-lg-pull-4">
			<div class="list-group">
			<a class="list-group-item active" href="http://forum.prog/adm/categories.php"><?php echo $lang_menu_top["forums"];?></a>
			<a class="list-group-item" href="http://forum.prog/adm/smilies.php"><?php echo $lang_forums["smilies"];?></a>
			<a class="list-group-item" href="http://forum.prog/adm/smilies-add.php"><?php echo $lang_forums["add_smilies"];?></a>
			</div>
		</div>
	</div>
</div>
<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "footer" );?>