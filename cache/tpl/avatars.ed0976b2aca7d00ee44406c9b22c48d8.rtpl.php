<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "header" );?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-push-3 col-md-7 col-md-push-4 col-lg-6 col-lg-push-4">
			<ol class="breadcrumb">
			  <li class="active"><span class="glyphicon glyphicon-user"></span> <?php echo $lang_avatars["my_account"];?></li>
			  <li class="active"><?php echo $lang_avatars["avatars"];?></li>
			</ol>
			
			<?php if( $user["user_rank"] > GUEST ){ ?>
			<?php if( $activate_avatar == 1 ){ ?>
			<div class="panel panel-default">
			<div class="panel-body">
			<form>
			<div id="queue"></div>
			<p align="center">
			<input id="file_upload" name="file_upload" multiple="true" type="file">
			<a class="btn btn-success" id="uploadifive"><span class="glyphicon glyphicon-plus"></span> <?php echo $lang_avatars["select_files"];?></a>
			<a class="btn btn-primary" href="javascript:$('#file_upload').uploadifive('upload')"><span class="glyphicon glyphicon-upload"></span> <?php echo $lang_avatars["send"];?></a>
			<a class="btn btn-warning" href="javascript:$('#file_upload').uploadifive('clearQueue')"><span class="glyphicon glyphicon-ban-circle"></span> <?php echo $lang_avatars["reset"];?></a></p>
			</form>
			<script type="text/javascript">
			$(function(){
				$('#file_upload').uploadifive({
					auto             : false,
					formData         : {
										   'token'     : '<?php echo $upload["token"];?>'
										 },
					queueID          : 'queue',
					uploadScript     : 'avatars.php',
					buttonText	     : '<?php echo escape_quotes( $lang_avatars["select_files"] );?>'
				});
			});
			</script>
			</div>
			</div>

			<div class="panel panel-default">
			<div class="panel-body">
			<?php if( $nb > 0 ){ ?>
			<div class="row">
				<div class="col-sm-9 col-md-9 col-lg-9"><ul class="pagination"><?php echo $pagination;?></ul></div>
				<div class="hidden-xs col-sm-3 col-md-3 col-lg-3 text-right">
				  <p><?php echo $lang_avatars["total"];?> : <strong><?php echo $nb;?></strong></p>
				  <p><?php echo $lang_avatars["rows"];?> <strong><?php echo $offset+1;?> - <?php echo $end;?></strong></p>
				</div>
			</div>
			
			<form method="post" action="http://forum.prog/avatars?page=<?php echo $page;?>">
			<input type="hidden" name="token" value="<?php echo $token;?>" />
			<div class="form-group">
			<button class="action-submit btn btn-danger" data-toggle="tooltip" title="<?php echo $lang_avatars["delete_selected"];?>"><?php echo $lang_avatars["delete"];?></button>
			<a class="btn-reset-avatar btn btn-success" href="http://forum.prog/avatars?use=0&amp;token=<?php echo $token_update;?>"><?php echo $lang_avatars["reset_avatar"];?></a>
			</div>
			<table class="table table-striped table-bordered table-hover text-center">
			<tr>
			<th><input type="checkbox" id="selectall" /></th>
			<th><?php echo $lang_avatars["thumbnail"];?></th>
			<th><?php echo $lang_avatars["dimensions"];?></th>
			<th><?php echo $lang_avatars["size"];?></th>
			<th><?php echo $lang_avatars["time"];?></th>
			<th>&nbsp;</th>
			</tr>
			<?php $counter1=-1; if( isset($rows) && is_array($rows) && sizeof($rows) ) foreach( $rows as $key1 => $value1 ){ $counter1++; ?>
			<tr>
			<td><input class="checkbox-item" type="checkbox" name="sup[]" value="<?php echo $value1["file_id"];?>" /></td>
			<td><a class="image-upload" href="http://forum.prog/<?php echo $upload_dir;?><?php echo display( $value1["file_name"] );?>"><img src="http://forum.prog/<?php echo $upload_dir;?>thumbnails/<?php echo display( $value1["file_name"] );?>" alt="<?php echo $lang_avatars["thumbnail"];?>" class="img-thumbnail" /></a></td>
			<td><?php echo $value1["file_width"];?>x<?php echo $value1["file_height"];?></td>
			<td><?php echo round($value1["file_size"]/1000); ?> ko</td>
			<td><?php echo date('d/m/Y H:i', $value1["file_time"]); ?></td>
			<td><input type="radio" name="use" value="<?php echo $value1["file_id"];?>"<?php if( $user["user_avatarid"] == $value1["file_id"] ){ ?> checked<?php } ?> /></td>
			</tr>
			<?php } ?>
			</table>
			</form>

			<div class="row">
				<div class="col-sm-9 col-md-9 col-lg-9"><ul class="pagination"><?php echo $pagination;?></ul></div>
				<div class="hidden-xs col-sm-3 col-md-3 col-lg-3 text-right">
				  <p><?php echo $lang_avatars["total"];?> : <strong><?php echo $nb;?></strong></p>
				  <p><?php echo $lang_avatars["rows"];?> <strong><?php echo $offset+1;?> - <?php echo $end;?></strong></p>
				</div>
			</div>

			<div id="dialog-confirm" title="<?php echo $lang_avatars["alert"];?>"></div>
			<script type="text/javascript">
			$(function(){
				$('input:radio[name="use"]').change(function(){
					Id = this.value;
					$.get(site_root+'avatars?use='+Id+'&token=<?php echo $token_update;?>', function(data) {
						$('#dialog-confirm').text(data).dialog({ buttons: [] }).dialog('open');
						setTimeout(function(){$('#dialog-confirm').dialog('close');}, 1500);
					});
					return false;
				});
			});
			$('.btn-reset-avatar').click(function(e){
				e.preventDefault();
				var url = $(this).attr('href');
				$.get(url, function(data){
					$('#dialog-confirm').text(data).dialog({ buttons: [] }).dialog('open');
					setTimeout(function(){$('#dialog-confirm').dialog('close');}, 1500);
				});
				return false;
			});
			var text_action_confirmation = '<?php echo escape_quotes( $lang_avatars["confirm_action"] );?>';
			var text_select_element = '<?php echo escape_quotes( $lang_avatars["select_element"] );?>';
			var text_select_action = '<?php echo escape_quotes( $lang_avatars["select_action"] );?>';
			var text_cancel = '<?php echo escape_quotes( $lang_avatars["cancel"] );?>';
			</script>
			<?php }else{ ?>
			<div class="alert alert-danger text-center"><?php echo $lang_avatars["no_avatar_sent"];?></div>
			<?php } ?>
			</div>
			</div>
			<?php }else{ ?>
			<div class="alert alert-danger text-center"><?php echo $lang_avatars["avatar_disabled"];?></div>
			<?php } ?>
			<?php }else{ ?>
			<div class="alert alert-danger text-center"><?php echo $lang_avatars["not_logged_in"];?></div>
			<?php } ?>
		</div>
		
		<div class="col-sm-3 col-sm-pull-9 col-md-3 col-md-pull-6 col-lg-2 col-lg-pull-4">
			<div class="list-group">
			<a class="list-group-item" href="http://forum.prog/settings"><?php echo $lang_avatars["account"];?></a>
			<a class="list-group-item" href="http://forum.prog/notifications"><?php echo $lang_avatars["notifications"];?></a>
			<a class="list-group-item" href="http://forum.prog/subscriptions"><?php echo $lang_avatars["subscriptions"];?></a>
			<a class="list-group-item active" href="http://forum.prog/avatars"><?php echo $lang_avatars["avatars"];?></a>
			</div>
		</div>
	</div>
</div>
<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "footer" );?>