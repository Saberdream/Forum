<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "header" );?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-push-3 col-md-7 col-md-push-4 col-lg-6 col-lg-push-4">
			<ol class="breadcrumb">
			  <li><a href="http://forum.prog/adm/index.php"><?php echo $lang_menu_top["admin_cp"];?></a></li>
			  <li class="active"><?php echo $lang_pictures["send_pictures"];?></li>
			</ol>
			<div class="panel panel-default">
			<div class="panel-body">
			<form>
			<div id="queue"></div>
			<p align="center">
			<input id="file_upload" name="file_upload" multiple="true" type="file">
			<a class="btn btn-success" id="uploadifive"><span class="glyphicon glyphicon-plus"></span> <?php echo $lang_pictures["select_files"];?></a>
			<a class="btn btn-primary" href="javascript:$('#file_upload').uploadifive('upload')"><span class="glyphicon glyphicon-upload"></span> <?php echo $lang_pictures["send"];?></a>
			<a class="btn btn-warning" href="javascript:$('#file_upload').uploadifive('clearQueue')"><span class="glyphicon glyphicon-ban-circle"></span> <?php echo $lang_pictures["reset"];?></a></p>
			</form>
			<script type="text/javascript">
			$(function() {
				$('#file_upload').uploadifive({
					'auto'             : false,
					'formData'         : {
										   'token'     : '<?php echo $token;?>'
										 },
					'queueID'          : 'queue',
					'uploadScript'     : 'pictures-upload.php',
					'buttonText'	   : '<?php echo escape_quotes( $lang_pictures["select_files"] );?>'
				});
			});
			</script>
			</div>
			</div>
		</div>
		
		<div class="col-sm-3 col-sm-pull-9 col-md-3 col-md-pull-6 col-lg-2 col-lg-pull-4">
			<div class="list-group">
			<a class="list-group-item" href="http://forum.prog/adm/pictures.php"><?php echo $lang_menu_top["images"];?></a>
			<a class="list-group-item active" href="http://forum.prog/adm/pictures-upload.php"><?php echo $lang_pictures["send_pictures"];?></a>
			</div>
		</div>
	</div>
</div>
<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "footer" );?>