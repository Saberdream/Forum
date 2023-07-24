<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "header" );?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-push-3 col-md-7 col-md-push-4 col-lg-6 col-lg-push-4">
			<ol class="breadcrumb">
			  <li><a href="http://forum.prog/adm/index.php"><?php echo $lang_menu_top["admin_cp"];?></a></li>
			  <li><a href="http://forum.prog/adm/forums.php"><?php echo $lang_smilies["manage_forums"];?></a></li>
			  <li><a href="http://forum.prog/adm/smilies.php"><?php echo $lang_smilies["smilies"];?></a></li>
			  <li class="active"><?php echo $lang_smilies["add_smilies"];?></li>
			</ol>
			<div class="panel panel-default">
			<div class="panel-body">
			<h4 class="text-primary"><?php echo $lang_smilies["add_smilies"];?></h4>
			<p class="text-muted"><?php echo $lang_smilies["page_description"];?></p>
			<?php if( !empty($form["error"]) ){ ?>
			<div class="alert alert-danger">
			<?php echo $lang_smilies["errors_occurred"];?>:
			<ul><?php $counter1=-1; if( isset($form["error"]) && is_array($form["error"]) && sizeof($form["error"]) ) foreach( $form["error"] as $key1 => $value1 ){ $counter1++; ?><li><?php echo $value1;?></li><?php } ?></ul>
			</div>
			<?php }elseif( !empty($form["ok"]) ){ ?>
			<div class="alert alert-success"><?php echo $form["ok"];?></div>
			<?php } ?>
			<?php if( count($rows) > 0 ){ ?>
			<form method="post" action="http://forum.prog/adm/smilies-add.php">
			<input type="hidden" name="token" value="<?php echo $form["token"];?>" />
			<table class="table table-striped table-bordered table-hover text-center">
			<tr>
			<th><input type="checkbox" id="selectall" /></th>
			<th><?php echo $lang_smilies["smiley"];?></th>
			<th><?php echo $lang_smilies["name"];?></th>
			<th><?php echo $lang_smilies["code"];?></th>
			<th><?php echo $lang_smilies["order"];?></th>
			</tr>
			<?php $counter1=-1; if( isset($rows) && is_array($rows) && sizeof($rows) ) foreach( $rows as $key1 => $value1 ){ $counter1++; ?>
			<tr>
			<td><input class="checkbox-item" type="checkbox" name="data[<?php echo $key1;?>][add]" value="1" /></td>
			<td><img src="http://forum.prog/gallery/smilies/<?php echo $key1;?>" alt="<?php echo $key1;?>" /></td>
			<td><?php echo $key1;?></td>
			<td><input class="form-control input-sm" type="text" name="data[<?php echo $key1;?>][code]" value="<?php echo display( $value1 );?>" /></td>
			<td><input class="form-control input-sm" type="text" name="data[<?php echo $key1;?>][order]" value="<?php echo $counter1+$nb+1;?>" /></td>
			</tr>
			<?php } ?>
			</table>
			<div class="text-center">
			  <button type="submit" class="btn btn-success"><?php echo $lang_smilies["save"];?></button>
			</div>
			</form>
			<?php }else{ ?>
			<div class="alert alert-warning text-center"><?php echo $lang_smilies["no_file"];?></div>
			<?php } ?>
			</div>
			</div>
		</div>

		<div class="col-sm-3 col-sm-pull-9 col-md-3 col-md-pull-6 col-lg-2 col-lg-pull-4">
			<div class="list-group">
			<a class="list-group-item" href="http://forum.prog/adm/categories.php"><?php echo $lang_menu_top["forums"];?></a>
			<a class="list-group-item" href="http://forum.prog/adm/smilies.php"><?php echo $lang_smilies["smilies"];?></a>
			<a class="list-group-item active" href="http://forum.prog/adm/smilies-add.php"><?php echo $lang_smilies["add_smilies"];?></a>
			</div>
		</div>
	</div>
</div>
<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "footer" );?>