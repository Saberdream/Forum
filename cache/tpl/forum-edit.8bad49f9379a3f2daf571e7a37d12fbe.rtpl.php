<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "header" );?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-push-3 col-md-7 col-md-push-4 col-lg-6 col-lg-push-4">
			<ol class="breadcrumb">
			  <li><a href="http://forum.prog/adm/index.php"><?php echo $lang_menu_top["admin_cp"];?></a></li>
			  <li class="active"><?php echo $lang_forum_edit["manage_forums"];?></li>
			  <li class="active"><a href="http://forum.prog/adm/categories.php"><?php echo $lang_forum_edit["categories"];?></a></li>
			  <li><a href="http://forum.prog/adm/forums.php?cat=<?php echo intval( $data["forum_catid"] );?>"><?php echo display( $data["cat_name"] );?></a></li>
			  <li class="active"><?php echo $lang_forum_edit["edit_forum"];?></li>
			</ol>
			<div class="panel panel-default">
			<div class="panel-body">
			<?php if( $data ){ ?>
			<?php if( !empty($form["error"]) ){ ?>
			<div class="alert alert-danger">
			<?php echo $lang_forum_edit["error_occurred"];?>:
			<ul><?php $counter1=-1; if( isset($form["error"]) && is_array($form["error"]) && sizeof($form["error"]) ) foreach( $form["error"] as $key1 => $value1 ){ $counter1++; ?><li><?php echo $value1;?></li><?php } ?></ul>
			</div>
			<?php }elseif( !empty($form["ok"]) ){ ?><div class="alert alert-success"><?php echo $form["ok"];?></div>
			<?php } ?>
			<div class="row">
			  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<form class="form form-horizontal" method="post" action="http://forum.prog/adm/forum-edit.php?id=<?php echo $data["forum_id"];?>">
				<h4><?php echo $lang_forum_edit["forum"];?>: <span class="text-primary"><?php echo display( $data["forum_name"] );?></span></h4>
				
				<div class="form-group">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<label for="name"><?php echo $lang_forum_edit["forum_name"];?></label>
				<input type="text" class="form-control input-sm" name="data[name]" id="name" value="<?php echo $data["forum_name"];?>" />
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<label for="catid"><?php echo $lang_forum_edit["category"];?></label>
				<?php if( !empty($cats) ){ ?>
				<select class="form-control input-sm" name="data[catid]" id="catid">
				<?php $counter1=-1; if( isset($cats) && is_array($cats) && sizeof($cats) ) foreach( $cats as $key1 => $value1 ){ $counter1++; ?>
				<option value="<?php echo intval( $value1["cat_id"] );?>"<?php if( $data["forum_catid"] == $value1["cat_id"] ){ ?> selected="selected"<?php } ?>><?php echo display( $value1["cat_name"] );?></option>
				<?php } ?>
				</select>
				<?php }else{ ?>
				<span class="help-block"><?php echo $lang_forum_edit["no_category_created"];?></span>
				<?php } ?>
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<label for="desc"><?php echo $lang_forum_edit["description"];?></label>
				<input type="text" class="form-control input-sm" name="data[desc]" id="desc" value="<?php echo $data["forum_desc"];?>" />
				<span class="help-block"><?php echo $lang_forum_edit["description_desc"];?></span>
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<label for="icon"><?php echo $lang_forum_edit["icon"];?></label>
				<input type="text" class="form-control input-sm" name="data[icon]" id="icon" value="<?php echo $data["forum_icon"];?>" />
				<span class="help-block"><?php echo $lang_forum_edit["icon_desc"];?></span>
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<label for="rules"><?php echo $lang_forum_edit["rules"];?></label>
				<textarea class="form-control input-sm" name="data[rules]" id="rules"><?php echo $data["forum_rules"];?></textarea>
				<span class="help-block"><?php echo $lang_forum_edit["rules_desc"];?></span>
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<label for="alerts"><?php echo $lang_forum_edit["alerts"];?></label>
				<select class="form-control input-sm" name="data[alerts]" id="alerts">
				<option value="1"<?php if( $data["forum_alerts"] == 1 ){ ?> selected="selected"<?php } ?>>Oui</option>
				<option value="0"<?php if( $data["forum_alerts"] == 0 ){ ?> selected="selected"<?php } ?>>Non</option>
				</select>
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<label for="moderators"><?php echo $lang_forum_edit["moderators"];?></label>
				<input type="text" name="data[moderators]" id="moderators" value="<?php echo display( $data["forum_moderators"] );?>" />
				</div>
				</div>
				
				<label for="forum_auth"><?php echo $lang_forum_edit["auths"];?></label>
				<span class="help-block"><?php echo $lang_forum_edit["auth_desc"];?></span>
				<table class="table table-bordered table-striped text-center">
				<tr>
				  <th></th>
				  <th><?php echo $lang_forum_edit["auth_guests"];?></th>
				  <th><?php echo $lang_forum_edit["auth_users"];?></th>
				  <th><?php echo $lang_forum_edit["auth_moderators"];?></th>
				  <th><?php echo $lang_forum_edit["auth_admins"];?></th>
				</tr>
				<?php $counter1=-1; if( isset($forum_auth) && is_array($forum_auth) && sizeof($forum_auth) ) foreach( $forum_auth as $key1 => $value1 ){ $counter1++; ?>
				<tr>
				  <th scope="row" class="text-left"><?php echo $value1["name"];?></th>
				  <td class="bg-success"><input type="radio" name="data[<?php echo $key1;?>]" value="<?php  echo GUEST;?>"<?php if( $value1["auth_min"] > GUEST ){ ?> disabled<?php }elseif( $value1["auth"] == GUEST ){ ?> checked<?php } ?> /></td>
				  <td class="bg-info"><input type="radio" name="data[<?php echo $key1;?>]" value="<?php  echo USER;?>"<?php if( $value1["auth_min"] > USER ){ ?> disabled<?php }elseif( $value1["auth"] == USER ){ ?> checked<?php } ?> /></td>
				  <td class="bg-warning"><input type="radio" name="data[<?php echo $key1;?>]" value="<?php  echo MODERATOR;?>"<?php if( $value1["auth_min"] > MODERATOR ){ ?> disabled<?php }elseif( $value1["auth"] == MODERATOR ){ ?> checked<?php } ?> /></td>
				  <td class="bg-danger"><input type="radio" name="data[<?php echo $key1;?>]" value="<?php  echo ADMIN;?>"<?php if( $value1["auth"] == ADMIN ){ ?> checked<?php } ?> /></td>
				</tr>
				<?php } ?>
				</table>
				
				<div class="form-group">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<label for="alerts"><?php echo $lang_forum_edit["closed"];?></label>
				<select class="form-control input-sm" name="data[closed]" id="closed">
				<option value="1"<?php if( $data["forum_closed"] == 1 ){ ?> selected="selected"<?php } ?>>Oui</option>
				<option value="0"<?php if( $data["forum_closed"] == 0 ){ ?> selected="selected"<?php } ?>>Non</option>
				</select>
				</div>
				</div>
				
				<div class="text-center">
				  <button type="submit" class="btn btn-success"><?php echo $lang_forum_edit["save"];?></button>
				</div>
				<input type="hidden" name="token" value="<?php echo $form["token"];?>" />
				</form>
			  </div>
			</div>
			<?php }else{ ?>
			<div class="alert alert-danger text-center"><?php echo $lang_forum_edit["forum_not_exists"];?></div>
			<?php } ?>
			</div>
			</div>
		</div>
		
		<div class="col-sm-3 col-sm-pull-9 col-md-3 col-md-pull-6 col-lg-2 col-lg-pull-4">
			<div class="list-group">
			<a class="list-group-item active" href="http://forum.prog/adm/categories.php"><?php echo $lang_menu_top["forums"];?></a>
			<a class="list-group-item" href="http://forum.prog/adm/smilies.php"><?php echo $lang_forum_edit["smilies"];?></a>
			<a class="list-group-item" href="http://forum.prog/adm/smilies-add.php"><?php echo $lang_forum_edit["add_smilies"];?></a>
			</div>
		</div>
	</div>
</div>
<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "footer" );?>