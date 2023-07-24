<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "header" );?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-push-3 col-md-7 col-md-push-4 col-lg-6 col-lg-push-4">
			<ol class="breadcrumb">
			  <li><a href="http://forum.prog/adm/index.php"><?php echo $lang_menu_top["admin_cp"];?></a></li>
			  <li class="active"><?php echo $lang_pictures["manage_pictures"];?></li>
			</ol>
			<div class="panel panel-default">
			<div class="panel-body">
			<?php if( $total > 0 ){ ?>
			<form class="form-inline form-search" method="get" action="http://forum.prog/adm/pictures.php">
			  <div class="form-group">
				<input type="text" name="search" id="search" value="<?php echo display( $search["keywords"] );?>" class="form-control input-sm" placeholder="<?php echo $lang_pictures["search"];?>" />
			  </div>
			  <div class="form-group">
				<select class="form-control input-sm" name="type">
				  <?php $counter1=-1; if( isset($search["types"]) && is_array($search["types"]) && sizeof($search["types"]) ) foreach( $search["types"] as $key1 => $value1 ){ $counter1++; ?>
				  <option value="<?php echo $key1;?>"<?php if( !empty($search["keywords"]) && $search["type"]==$key1 ){ ?> selected<?php } ?>><?php echo $value1;?></option>
				  <?php } ?>
				</select>
			  </div>
			  <div class="form-group">
				<label for="exact"><input type="checkbox" name="exact" id="exact" value="1" <?php if( !empty($search["keywords"]) && $search["exact"] ){ ?>checked <?php } ?>/> <?php echo $lang_pictures["exact"];?></label>
			  </div>
			  <button class="btn btn-default btn-sm" type="submit"><span class="glyphicon glyphicon-search"></span></button>
			  <?php if( !empty($search["keywords"]) ){ ?><a class="btn btn-primary btn-sm pull-right hidden-xs" href="http://forum.prog/adm/pictures.php?page=1"><b><?php echo $lang_pictures["back"];?></b></a><?php } ?>
			</form>

			<?php if( $nb > 0 ){ ?>
			<?php if( !empty($search["keywords"]) ){ ?>
			<div class="alert alert-success text-center"><?php echo $lang_pictures["search_results"];?></div>
			<?php } ?>
			<div class="row">
				<div class="col-sm-9 col-md-9 col-lg-9"><ul class="pagination"><?php echo $pagination;?></ul></div>
				<div class="hidden-xs col-sm-3 col-md-3 col-lg-3 text-right">
				  <p><?php echo $lang_pictures["total"];?>: <strong><?php echo $nb;?></strong></p>
				  <p><?php echo $lang_pictures["rows"];?> <strong><?php echo $offset+1;?> - <?php echo $end;?></strong></p>
				</div>
			</div>
			<form method="post" action="http://forum.prog/adm/pictures.php">
			<input type="hidden" name="token" value="<?php echo $token;?>" />
			<input type="hidden" name="action" value="delete" />
			<div class="form-group">
			<button class="action-submit btn btn-danger" data-toggle="tooltip" title="<?php echo $lang_pictures["delete_selection"];?>"><?php echo $lang_pictures["delete"];?></button>
			</div>
			<table class="table table-striped table-bordered table-hover text-center">
			<tr>
			<th><input type="checkbox" id="selectall" /></th>
			<th><?php echo $lang_pictures["thumbnail"];?></th>
			<th><?php echo $lang_pictures["size"];?></th>
			<th><?php echo $lang_pictures["weight"];?></th>
			<th><?php echo $lang_pictures["username"];?></th>
			<th><?php echo $lang_pictures["date"];?></th>
			</tr>
			<?php $counter1=-1; if( isset($rows) && is_array($rows) && sizeof($rows) ) foreach( $rows as $key1 => $value1 ){ $counter1++; ?>
			<tr>
			<td><input class="checkbox-item" type="checkbox" name="sup[]" value="<?php echo display( $value1["file_id"] );?>" /></td>
			<td><a class="image-upload" href="http://forum.prog/<?php echo $upload_dir;?><?php echo display( $value1["file_name"] );?>" title="<?php echo display( $value1["file_name"] );?>"><img src="http://forum.prog/<?php echo $upload_dir;?>thumbnails/<?php echo display( $value1["file_name"] );?>" alt="Miniature" class="img-thumbnail" /></a></td>
			<td><?php echo intval( $value1["file_width"] );?>x<?php echo intval( $value1["file_height"] );?></td>
			<td><?php if( $value1["file_size"] >= 1048576 ){ ?><?php echo round($value1["file_size"]/1048576, 1); ?> Mio<?php }else{ ?><?php echo round($value1["file_size"]/1024, 1); ?> kio<?php } ?></td>
			<td><?php echo display( $value1["user_name"] );?></td>
			<td><?php echo date('d/m/Y H:i', $value1["file_time"]); ?></td>
			</tr>
			<?php } ?>
			</table>
			</form>
			<script>
			var text_enlarge_image = '<?php echo escape_quotes( $lang_pictures["click_to_enlarge"] );?>';
			var text_action_confirmation = '<?php echo escape_quotes( $lang_pictures["confirm_action"] );?>';
			var text_select_element = '<?php echo escape_quotes( $lang_pictures["select_element"] );?>';
			var text_select_action = '<?php echo escape_quotes( $lang_pictures["select_action"] );?>';
			var text_cancel = '<?php echo escape_quotes( $lang_pictures["cancel"] );?>';
			</script>
			<div id="dialog-confirm" title="<?php echo $lang_pictures["alert"];?>"></div>
			<div class="row">
				<div class="col-sm-9 col-md-9 col-lg-9"><ul class="pagination"><?php echo $pagination;?></ul></div>
				<div class="hidden-xs col-sm-3 col-md-3 col-lg-3 text-right">
				  <p><?php echo $lang_pictures["total"];?>: <strong><?php echo $nb;?></strong></p>
				  <p><?php echo $lang_pictures["rows"];?> <strong><?php echo $offset+1;?> - <?php echo $end;?></strong></p>
				</div>
			</div>
			<?php }elseif( !empty($search["keywords"]) ){ ?>
			<div class="alert alert-warning text-center"><?php echo $lang_pictures["search_no_result"];?></div>
			<?php } ?>
			<?php }else{ ?>
			<div class="alert alert-danger text-center"><?php echo $lang_pictures["no_data"];?></div>
			<?php } ?>
			</div>
			</div>
		</div>

		<div class="col-sm-3 col-sm-pull-9 col-md-3 col-md-pull-6 col-lg-2 col-lg-pull-4">
			<div class="list-group">
			<a class="list-group-item active" href="http://forum.prog/adm/pictures.php"><?php echo $lang_menu_top["images"];?></a>
			<a class="list-group-item" href="http://forum.prog/adm/pictures-upload.php"><?php echo $lang_pictures["send_pictures"];?></a>
			</div>
		</div>
	</div>
</div>
<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "footer" );?>