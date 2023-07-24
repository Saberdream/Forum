<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "header" );?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-push-3 col-md-7 col-md-push-4 col-lg-6 col-lg-push-4">
			<ol class="breadcrumb">
			  <li><a href="http://forum.prog/adm/index.php"><?php echo $lang_menu_top["admin_cp"];?></a></li>
			  <li class="active"><?php echo $lang_categories["manage_forums"];?></a></li>
			  <li class="active"><?php echo $lang_categories["categories"];?></li>
			</ol>
			<div class="panel panel-default">
			<div class="panel-body">
			<p class="text-muted"><?php echo $lang_categories["page_description"];?></p>
			<?php if( $nb > 0 ){ ?>
			<table class="table table-striped table-bordered table-hover text-center">
			<tr>
			<th><?php echo $lang_categories["name"];?></th>
			<th>&nbsp;</th>
			<th><?php echo $lang_categories["order"];?></th>
			<th><?php echo $lang_categories["action"];?></th>
			</tr>
			<?php $counter1=-1; if( isset($rows) && is_array($rows) && sizeof($rows) ) foreach( $rows as $key1 => $value1 ){ $counter1++; ?>
			<tr>
			<td class="name text-left"><a href="http://forum.prog/adm/forums.php?cat=<?php echo intval( $value1["cat_id"] );?>"><?php echo display( $value1["cat_name"] );?></a></td>
			<td><a href="http://forum.prog/adm/categories.php?action=edit&amp;id=<?php echo intval( $value1["cat_id"] );?>&amp;token=<?php echo $token;?>" class="edit-cat btn btn-success btn-xs" data-toggle="tooltip" title="<?php echo $lang_categories["edit_category"];?>"><span class="glyphicon glyphicon-cog"></span></a></td>
			<td><?php echo intval( $value1["cat_order"] );?></td>
			<td>
			<?php if( $value1["cat_order"] >= $nb ){ ?>
			<a href="" class="btn btn-info btn-xs disabled"><span class="glyphicon glyphicon-triangle-bottom"></span></a>
			<?php }else{ ?>
			<a href="http://forum.prog/adm/categories.php?action=order_down&amp;id=<?php echo intval( $value1["cat_id"] );?>&amp;token=<?php echo $token;?>" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-triangle-bottom"></span></a>
			<?php } ?>
			<?php if( $value1["cat_order"] == 1 ){ ?>
			<a href="" class="btn btn-info btn-xs disabled"><span class="glyphicon glyphicon-triangle-top"></span></a>
			<?php }else{ ?>
			<a href="http://forum.prog/adm/categories.php?action=order_up&amp;id=<?php echo intval( $value1["cat_id"] );?>&amp;token=<?php echo $token;?>" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-triangle-top"></span></a>
			<?php } ?>
			<a href="http://forum.prog/adm/categories.php?action=delete&amp;id=<?php echo intval( $value1["cat_id"] );?>&amp;token=<?php echo $token;?>" class="delete btn btn-danger btn-xs" data-toggle="tooltip" title="<?php echo $lang_categories["delete_category"];?>"><span class="glyphicon glyphicon-remove"></span></a>
			</td>
			</tr>
			<?php } ?>
			</table>
			<script>
			var text_action_confirmation = '<?php echo escape_quotes( $lang_categories["confirm_action"] );?>';
			var text_delete_confirmation = '<?php echo escape_quotes( $lang_categories["confirm_delete"] );?>';
			var text_cancel = '<?php echo escape_quotes( $lang_categories["cancel"] );?>';
			</script>
			<div id="dialog-confirm" title="<?php echo $lang_categories["alert"];?>"></div>
			<?php }else{ ?>
			<div class="alert alert-danger"><?php echo $lang_categories["no_category"];?></div>
			<?php } ?>
			</div>
			</div>
			
			<div class="panel panel-default">
			<div class="panel-body">
			<h4 class="text-primary"><?php echo $lang_categories["add_new_category"];?></h4>
			<?php if( !empty($form["error"]) ){ ?>
			<div class="alert alert-danger">
			<?php echo $lang_categories["errors_occurred"];?>:
			<ul><?php $counter1=-1; if( isset($form["error"]) && is_array($form["error"]) && sizeof($form["error"]) ) foreach( $form["error"] as $key1 => $value1 ){ $counter1++; ?><li><?php echo $value1;?></li><?php } ?></ul>
			</div>
			<?php }elseif( !empty($form["ok"]) ){ ?>
			<div class="alert alert-success"><?php echo $form["ok"];?></div>
			<?php } ?>
			<form method="post" action="http://forum.prog/adm/categories.php">
			<div class="form-group">
			<label class="sr-only" for="new_category"><?php echo $lang_categories["new_category_name"];?></label>
			<input type="text" class="form-control" name="new_category" id="new_category" value="" placeholder="<?php echo $lang_categories["enter_newcategory_name"];?>" />
			</div>
			<button type="submit" class="btn btn-sm btn-primary"><?php echo $lang_categories["add"];?></button>
			<input type="hidden" name="token" value="<?php echo $form["token"];?>" />
			</form>
			</div>
			</div>
		</div>

		<div class="col-sm-3 col-sm-pull-9 col-md-3 col-md-pull-6 col-lg-2 col-lg-pull-4">
			<div class="list-group">
			<a class="list-group-item active" href="http://forum.prog/adm/categories.php"><?php echo $lang_menu_top["forums"];?></a>
			<a class="list-group-item" href="http://forum.prog/adm/smilies.php"><?php echo $lang_categories["smilies"];?></a>
			<a class="list-group-item" href="http://forum.prog/adm/smilies-add.php"><?php echo $lang_categories["add_smilies"];?></a>
			</div>
		</div>
	</div>
</div>
<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "footer" );?>