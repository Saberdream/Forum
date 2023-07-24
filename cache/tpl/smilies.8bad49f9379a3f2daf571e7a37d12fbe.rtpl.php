<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "header" );?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-push-3 col-md-7 col-md-push-4 col-lg-6 col-lg-push-4">
			<ol class="breadcrumb">
			  <li><a href="http://forum.prog/adm/index.php"><?php echo $lang_menu_top["admin_cp"];?></a></li>
			  <li><a href="http://forum.prog/adm/forums.php"><?php echo $lang_smilies["manage_forums"];?></a></li>
			  <li class="active"><?php echo $lang_smilies["smilies"];?></li>
			</ol>
			<div class="panel panel-default">
			<div class="panel-body">
			<p class="text-muted"><?php echo $lang_smilies["page_description"];?></p>
			<?php if( $nb > 0 ){ ?>
			<form method="post" action="http://forum.prog/adm/smilies.php">
			<input type="hidden" name="token" value="<?php echo $token2;?>" />
			<div class="form-group">
			<div class="form-inline">
			<select class="form-control input-sm" name="action">
			<option><?php echo $lang_smilies["action"];?></option>
			<option value="set_order"><?php echo $lang_smilies["modify_order"];?></option>
			<option value="delete"><?php echo $lang_smilies["remove"];?></option>
			</select>
			<button class="action-submit btn btn-sm btn-success"><?php echo $lang_smilies["validate"];?></button>
			</div>
			</div>
			<table class="table table-striped table-bordered table-hover text-center">
			<tr>
			  <th><input type="checkbox" id="selectall" /></th>
			  <th><?php echo $lang_smilies["smiley"];?></th>
			  <th><?php echo $lang_smilies["code"];?></th>
			  <th>&nbsp;</th>
			  <th><?php echo $lang_smilies["name"];?></th>
			  <th><?php echo $lang_smilies["organise"];?></th>
			  <th><?php echo $lang_smilies["order"];?></th>
			</tr>
			<?php $counter1=-1; if( isset($rows) && is_array($rows) && sizeof($rows) ) foreach( $rows as $key1 => $value1 ){ $counter1++; ?>
			<tr>
			  <td><input class="checkbox-item" type="checkbox" name="sup[]" value="<?php echo intval( $value1["smiley_id"] );?>" /></td>
			  <td><img src="http://forum.prog/gallery/smilies/<?php echo display( $value1["smiley_filename"] );?>" alt="<?php echo display( $value1["smiley_code"] );?>" /></td>
			  <td class="code"><?php echo display( $value1["smiley_code"] );?></td>
			  <td><a href="http://forum.prog/adm/smilies.php?action=edit&amp;id=<?php echo intval( $value1["smiley_id"] );?>&amp;token=<?php echo $token;?>" class="edit-code btn btn-success btn-xs" data-toggle="tooltip" title="<?php echo $lang_smilies["edit_code"];?>"><span class="glyphicon glyphicon-cog"></span></a></td>
			  <td><?php echo display( $value1["smiley_filename"] );?></td>
			  <td>
			    <?php if( $value1["smiley_order"] >= $nb ){ ?>
				<a href="" class="btn btn-info btn-xs disabled"><span class="glyphicon glyphicon-triangle-bottom"></span></a>
				<?php }else{ ?>
				<a href="http://forum.prog/adm/smilies.php?id=<?php echo intval( $value1["smiley_id"] );?>&amp;action=order_down&amp;token=<?php echo $token;?>" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-triangle-bottom"></span></a>
				<?php } ?>
				<?php if( $value1["smiley_order"] == 1 ){ ?>
				<a href="" class="btn btn-info btn-xs disabled"><span class="glyphicon glyphicon-triangle-top"></span></a>
				<?php }else{ ?>
				<a href="http://forum.prog/adm/smilies.php?id=<?php echo intval( $value1["smiley_id"] );?>&amp;action=order_up&amp;token=<?php echo $token;?>" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-triangle-top"></span></a>
				<?php } ?>
			  </td>
			  <td><input class="form-control input-sm" type="text" name="order[<?php echo intval( $value1["smiley_id"] );?>]" value="<?php echo intval( $value1["smiley_order"] );?>" /></td>
			</tr>
			<?php } ?>
			</table>
			</form>
			<script>
			var text_action_confirmation = '<?php echo escape_quotes( $lang_smilies["confirm_action"] );?>';
			var text_select_element = '<?php echo escape_quotes( $lang_smilies["select_element"] );?>';
			var text_select_action = '<?php echo escape_quotes( $lang_smilies["select_action"] );?>';
			var text_cancel = '<?php echo escape_quotes( $lang_smilies["cancel"] );?>';
			</script>
			<div id="dialog-confirm" title="<?php echo $lang_smilies["alert"];?>"></div>
			<?php }else{ ?>
			<div class="alert alert-warning text-center"><?php echo $lang_smilies["no_smiley"];?></div>
			<?php } ?>
			</div>
			</div>
		</div>

		<div class="col-sm-3 col-sm-pull-9 col-md-3 col-md-pull-6 col-lg-2 col-lg-pull-4">
			<div class="list-group">
			<a class="list-group-item" href="http://forum.prog/adm/categories.php"><?php echo $lang_menu_top["forums"];?></a>
			<a class="list-group-item active" href="http://forum.prog/adm/smilies.php"><?php echo $lang_smilies["smilies"];?></a>
			<a class="list-group-item" href="http://forum.prog/adm/smilies-add.php"><?php echo $lang_smilies["add_smilies"];?></a>
			</div>
		</div>
	</div>
</div>
<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "footer" );?>