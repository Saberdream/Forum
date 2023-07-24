<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "header" );?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-push-3 col-md-7 col-md-push-4 col-lg-6 col-lg-push-4">
			<ol class="breadcrumb">
			  <li><a href="http://forum.prog/adm/index.php"><?php echo $lang_menu_top["admin_cp"];?></a></li>
			  <li class="active"><?php echo $lang_logs["site_errors"];?></li>
			</ol>
			<div class="panel panel-default">
			<div class="panel-body">
			<?php if( $nb > 0 ){ ?>
			<div class="row">
				<div class="col-sm-9 col-md-9 col-lg-9"><ul class="pagination"><?php echo $pagination;?></ul></div>
				<div class="hidden-xs col-sm-3 col-md-3 col-lg-3 text-right">
				  <p><?php echo $lang_logs["total"];?>: <strong><?php echo $nb;?></strong></p>
				  <p><?php echo $lang_logs["rows"];?> <strong><?php echo $offset+1;?> - <?php echo $end;?></strong></p>
				</div>
			</div>

			<form method="post" action="http://forum.prog/adm/logs.php">
			<input type="hidden" name="token" value="<?php echo $token;?>" />
			<input type="hidden" name="action" value="delete" />
			<div class="form-group">
			<button class="action-submit btn btn-danger" data-toggle="tooltip" title="<?php echo $lang_logs["delete_selection"];?>"><?php echo $lang_logs["delete"];?></button>
			</div>
			<table class="table table-striped table-bordered table-hover text-center">
			<tr>
			<th><input type="checkbox" id="selectall" /></th>
			<th><?php echo $lang_logs["name"];?></th>
			<th><?php echo $lang_logs["date"];?></th>
			<th><?php echo $lang_logs["size"];?></th>
			<th><?php echo $lang_logs["text"];?></th>
			</tr>
			<?php $counter1=-1; if( isset($rows) && is_array($rows) && sizeof($rows) ) foreach( $rows as $key1 => $value1 ){ $counter1++; ?>
			<tr>
			<td><input class="checkbox-item" type="checkbox" name="sup[]" value="<?php echo $value1["file_id"];?>" /></td>
			<td><?php echo display( $value1["file_name"] );?></td>
			<td><?php echo date('d/m/Y H:i', $value1["file_time"]); ?></td>
			<td><?php echo $value1["file_size"];?> Byte</td>
			<td class="text-left text-toggle"><a href="" class="button-text-toggle"><img src="http://forum.prog/adm/style/images/bt_plus.gif" /></a> <span class="text-toggle" style="display:none;"><?php echo display( $value1["file_text"] );?></span></td>
			</tr>
			<?php } ?>
			</table>
			</form>

			<div class="row">
				<div class="col-sm-9 col-md-9 col-lg-9"><ul class="pagination"><?php echo $pagination;?></ul></div>
				<div class="hidden-xs col-sm-3 col-md-3 col-lg-3 text-right">
				  <p><?php echo $lang_logs["total"];?>: <strong><?php echo $nb;?></strong></p>
				  <p><?php echo $lang_logs["rows"];?> <strong><?php echo $offset+1;?> - <?php echo $end;?></strong></p>
				</div>
			</div>

			<script>
			var text_action_confirmation = '<?php echo escape_quotes( $lang_logs["confirm_action"] );?>';
			var text_select_element = '<?php echo escape_quotes( $lang_logs["select_element"] );?>';
			var text_select_action = '<?php echo escape_quotes( $lang_logs["select_action"] );?>';
			var text_cancel = '<?php echo escape_quotes( $lang_logs["cancel"] );?>';
			
			$(document).on('click', '.button-text-toggle', function(e) {
				e.preventDefault();
				var Text = $(this).next('.text-toggle');
				var Img = $(this).children('img')[0];

				if(Text.css('display') == 'none') {
					Text.css('display', 'inline');
					Img.src = Img.src.replace(/\/style\/images\/bt_plus.gif/g, '/style/images/bt_minus.gif');
				}
				else {
					Text.css('display', 'none');
					Img.src = Img.src.replace(/\/style\/images\/bt_minus.gif/g, '/style/images/bt_plus.gif');
				}

				return false;
			});
			</script>
			<div id="dialog-confirm" title="<?php echo $lang_logs["alert"];?>"></div>
			<?php }else{ ?>
			<div class="alert alert-danger text-center"><?php echo $lang_logs["no_files"];?></div>
			<?php } ?>
			</div>
			</div>
		</div>

		<div class="col-sm-3 col-sm-pull-9 col-md-3 col-md-pull-6 col-lg-2 col-lg-pull-4">
			<div class="list-group">
			<a class="list-group-item" href="http://forum.prog/adm/configuration.php"><?php echo $lang_logs["site_configuration"];?></a>
			<a class="list-group-item" href="http://forum.prog/adm/system.php"><?php echo $lang_menu_top["system"];?></a>
			<a class="list-group-item active" href="http://forum.prog/adm/logs.php"><?php echo $lang_logs["error_logs"];?></a>
			</div>
		</div>
	</div>
</div>
<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "footer" );?>