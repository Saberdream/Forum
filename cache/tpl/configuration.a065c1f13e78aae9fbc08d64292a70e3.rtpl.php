<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "header" );?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-push-3 col-md-7 col-md-push-4 col-lg-6 col-lg-push-4">
			<ol class="breadcrumb">
			  <li><a href="http://forum.pro/adm/index.php"><?php echo $lang_menu_top["admin_cp"];?></a></li>
			  <li class="active"><?php echo $lang_config["site_configuration"];?></li>
			</ol>
			
			<div class="panel-group">
			<p class="text-muted"><?php echo $lang_config["page_description"];?></p>
			<?php if( !empty($form["error"]) ){ ?>
			<div class="alert alert-danger">
			<?php echo $lang_config["errors_occurred"];?>:
			<ul><?php $counter1=-1; if( isset($form["error"]) && is_array($form["error"]) && sizeof($form["error"]) ) foreach( $form["error"] as $key1 => $value1 ){ $counter1++; ?><li><?php echo $value1;?></li><?php } ?></ul>
			</div>
			<?php }elseif( !empty($form["ok"]) ){ ?>
			<div class="alert alert-success"><?php echo $form["ok"];?></div>
			<?php } ?>
			<div class="row">
			  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<form class="form form-horizontal" method="post" action="http://forum.pro/adm/configuration.php">
				<?php $counter1=-1; if( isset($config) && is_array($config) && sizeof($config) ) foreach( $config as $key1 => $value1 ){ $counter1++; ?>
				<?php if( !isset($current_cat) || (isset($current_cat) && $value1["cat_name"] != $current_cat) ){ ?>
				<?php if( isset($current_cat) ){ ?>
				</div>
				</div>
				<?php } ?>
				<div class="panel panel-default">
				<div class="panel-heading"><a href="javascript:void(0);" onclick="javascript:category_toggle(<?php echo $value1["config_catid"];?>);"><?php echo display( $value1["cat_name"] );?> <img src="http://forum.pro/adm/style/images/bt_plus.gif" id="button_toggle_<?php echo $value1["config_catid"];?>" /></a></div>
				<div class="panel-body" id="configuration_category_<?php echo $value1["config_catid"];?>" style="display:none;">
				<?php $current_cat=$this->var['current_cat']=$value1["cat_name"];?>
				<?php } ?>
				<?php if( $value1["config_type"] == 's' ){ ?>
					<?php if( $value1["config_form_type"] == 'textarea' ){ ?>
					<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<label for="<?php echo $key1;?>"><?php echo display( $value1["config_name"] );?></label>
					<textarea class="form-control" name="config[<?php echo $key1;?>]" id="<?php echo $key1;?>"><?php echo display( $value1["config_value"] );?></textarea>
					<?php }elseif( $value1["config_form_type"] == 'select' ){ ?>
					<?php $select_value=$this->var['select_value']=$value1["config_value"];?>
					<div class="form-group">
					<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
					<label for="<?php echo $key1;?>"><?php echo display( $value1["config_name"] );?></label>
					<select class="form-control input-sm" name="config[<?php echo $key1;?>]" id="<?php echo $key1;?>">
					<?php $counter2=-1; if( isset($value1["config_options"]) && is_array($value1["config_options"]) && sizeof($value1["config_options"]) ) foreach( $value1["config_options"] as $key2 => $value2 ){ $counter2++; ?>
					<option value="<?php echo $key2;?>"<?php if( $select_value == $key2 ){ ?> selected="selected"<?php } ?>><?php echo $value2;?></option>
					<?php } ?>
					</select>
					<?php }elseif( $value1["config_form_type"] == 'tag' ){ ?>
					<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<label for="<?php echo $key1;?>"><?php echo display( $value1["config_name"] );?></label>
					<input type="text" name="config[<?php echo $key1;?>]" id="<?php echo $key1;?>" value="<?php echo display( $value1["config_value"] );?>" />
					<?php }else{ ?>
					<div class="form-group">
					<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
					<label for="<?php echo $key1;?>"><?php echo display( $value1["config_name"] );?></label>
					<input type="text" class="form-control input-sm" name="config[<?php echo $key1;?>]" id="<?php echo $key1;?>" value="<?php echo display( $value1["config_value"] );?>" />
					<?php } ?>
				<?php }elseif( $value1["config_type"] == 'd' ){ ?>
					<div class="form-group">
					<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
					<label for="<?php echo $key1;?>"><?php echo display( $value1["config_name"] );?></label>
					<input type="text" class="form-control input-sm" name="config[<?php echo $key1;?>]" id="<?php echo $key1;?>" value="<?php echo display( $value1["config_value"] );?>" />
				<?php }elseif( $value1["config_type"] == 'b' ){ ?>
					<div class="form-group">
					<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
					<label for="<?php echo $key1;?>"><?php echo display( $value1["config_name"] );?></label>
					<select class="form-control input-sm" name="config[<?php echo $key1;?>]" id="<?php echo $key1;?>">
					<option value="1"<?php if( $value1["config_value"] ){ ?> selected="selected"<?php } ?>><?php echo $lang_config["yes"];?></option>
					<option value="0"<?php if( !$value1["config_value"] ){ ?> selected="selected"<?php } ?>><?php echo $lang_config["no"];?></option>
					</select>
				<?php } ?>
					<?php if( !empty($value1["config_description"]) ){ ?><span class="help-block"><?php echo display( $value1["config_description"] );?></span><?php } ?>
					</div>
					</div>
				<?php if( $counter1 == sizeof($config)-1 ){ ?>
				</div>
				</div>
				<?php } ?>
				<?php } ?>
				<div class="panel text-center">
				<div class="panel-body">
				  <button type="submit" class="btn btn-success"><?php echo $lang_config["save"];?></button>
				</div>
				</div>
				<input type="hidden" name="token" value="<?php echo $form["token"];?>" />
				</form>
				<script>
				function category_toggle(cat_id) {
					var category = document.getElementById('configuration_category_'+cat_id);
					var Img = document.getElementById('button_toggle_'+cat_id);
	
					if(category.style.display == 'none') {
						category.style.display = 'block';
						Img.src = Img.src.replace(/\/style\/images\/bt_plus.gif/g, '/style/images/bt_minus.gif');
					}
					else {
						category.style.display = 'none';
						Img.src = Img.src.replace(/\/style\/images\/bt_minus.gif/g, '/style/images/bt_plus.gif');
					}

					return false;
				}
				</script>
			  </div>
			</div>
			</div>
		</div>
		
		<div class="col-sm-3 col-sm-pull-9 col-md-3 col-md-pull-6 col-lg-2 col-lg-pull-4">
			<div class="list-group">
			<a class="list-group-item active" href="http://forum.pro/adm/configuration.php"><?php echo $lang_config["site_configuration"];?></a>
			<a class="list-group-item" href="http://forum.pro/adm/system.php"><?php echo $lang_menu_top["system"];?></a>
			<a class="list-group-item" href="http://forum.pro/adm/logs.php"><?php echo $lang_config["error_logs"];?></a>
			</div>
		</div>
	</div>
</div>
<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "footer" );?>