<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "header" );?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-push-3 col-md-7 col-md-push-4 col-lg-6 col-lg-push-4">
			<ol class="breadcrumb">
			  <li class="active"><span class="glyphicon glyphicon-user"></span> <?php echo $lang_settings["account"];?></li>
			  <li class="active"><?php echo $lang_settings["edit_settings"];?></li>
			</ol>
			<div class="panel panel-default">
			<div class="panel-body">
			<?php if( !empty($form["ok"]) ){ ?>
			<div class="alert alert-success"><?php echo $form["ok"];?></div>
			<?php }else{ ?>
			<?php if( !empty($form["error"]) ){ ?>
			<div class="alert alert-danger">
			<?php echo $lang_settings["errors_occured"];?>:
			<ul><?php $counter1=-1; if( isset($form["error"]) && is_array($form["error"]) && sizeof($form["error"]) ) foreach( $form["error"] as $key1 => $value1 ){ $counter1++; ?><li><?php echo $value1;?></li><?php } ?></ul>
			</div>
			<?php } ?>
			<div class="row">
			  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<form class="form form-horizontal" method="post" action="http://forum.prog/settings">
				<div class="form-group">
				<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
				<label for="password"><?php echo $lang_settings["password"];?></label>
				<input type="password" class="form-control" name="data[password]" id="password" placeholder="<?php echo $lang_settings["enter_password"];?>" />
				<span class="help-block"><?php echo $lang_settings["password_desc"];?></span>
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
				<label for="email"><?php echo $lang_settings["email"];?></label>
				<input type="text" class="form-control" name="data[email]" id="email" value="<?php echo display( $data["user_email"] );?>" placeholder="<?php echo $lang_settings["enter_email"];?>" />
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<label for="birth_d"><?php echo $lang_settings["birthday"];?></label>
					<div class="form-inline">
						<div class="form-group">
						<div class="col-xs-12 col-sm-4 col-md-2 col-lg-2">
						<select class="form-control input-sm" name="data[birth_d]" id="birth_d">
						<option value=""><?php echo $lang_settings["day"];?></option>
						<?php $counter1=-1; if( isset($form["birth_days"]) && is_array($form["birth_days"]) && sizeof($form["birth_days"]) ) foreach( $form["birth_days"] as $key1 => $value1 ){ $counter1++; ?>
						<option value="<?php echo $value1;?>"<?php if( !empty($data["user_birth_d"]) && $value1 == $data["user_birth_d"] ){ ?> selected<?php } ?>><?php echo $value1;?></option>
						<?php } ?>
						</select>
						</div>
						</div>
						
						<div class="form-group">
						<div class="col-xs-12 col-sm-4 col-md-2 col-lg-2">
						<select class="form-control input-sm" name="data[birth_m]" id="birth_m">
						<option value=""><?php echo $lang_settings["month"];?></option>
						<?php $counter1=-1; if( isset($form["birth_months"]) && is_array($form["birth_months"]) && sizeof($form["birth_months"]) ) foreach( $form["birth_months"] as $key1 => $value1 ){ $counter1++; ?>
						<option value="<?php echo $value1;?>"<?php if( !empty($data["user_birth_m"]) && $value1 == $data["user_birth_m"] ){ ?> selected<?php } ?>><?php echo $value1;?></option>
						<?php } ?>
						</select>
						</div>
						</div>
						
						<div class="form-group">
						<div class="col-xs-12 col-sm-4 col-md-2 col-lg-2">
						<select class="form-control input-sm" name="data[birth_y]" id="birth_y">
						<option value=""><?php echo $lang_settings["year"];?></option>
						<?php $counter1=-1; if( isset($form["birth_years"]) && is_array($form["birth_years"]) && sizeof($form["birth_years"]) ) foreach( $form["birth_years"] as $key1 => $value1 ){ $counter1++; ?>
						<option value="<?php echo $value1;?>"<?php if( !empty($data["user_birth_y"]) && $value1 == $data["user_birth_y"] ){ ?> selected<?php } ?>><?php echo $value1;?></option>
						<?php } ?>
						</select>
						</div>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
				<label for="birth_d"><?php echo $lang_settings["sex"];?>:</label>
				<select class="form-control input-sm" name="data[sex]" id="sex">
				<option value=""><?php echo $lang_settings["not_specified"];?></option>
				<?php $counter1=-1; if( isset($form["sexes"]) && is_array($form["sexes"]) && sizeof($form["sexes"]) ) foreach( $form["sexes"] as $key1 => $value1 ){ $counter1++; ?>
				<option value="<?php echo $key1;?>"<?php if( $key1 == $data["user_sex"] ){ ?> selected<?php } ?>><?php echo $value1;?></option>
				<?php } ?>
				</select>
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<label for="sign"><?php echo $lang_settings["forum_signature"];?></label>
				<textarea class="form-control input-sm" name="data[sign]" id="sign"><?php echo display( $data["user_sign"] );?></textarea>
				<span class="help-block"><?php echo $lang_settings["forum_signature_desc"];?></span>
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<label for="desc"><?php echo $lang_settings["description"];?></label>
				<textarea class="form-control input-sm" name="data[desc]" id="desc"><?php echo display( $data["user_desc"] );?></textarea>
				<span class="help-block"><?php echo $lang_settings["description_desc"];?></span>
				</div>
				</div>

				<div class="form-group">
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<label for=""><?php echo $lang_settings["avatar"];?></label>
				<?php if( !empty($data["user_avatar"]) ){ ?>
				<p><a class="image-upload" href="http://forum.prog/gallery/avatars/<?php echo $data["user_avatar"];?>"><img src="http://forum.prog/gallery/avatars/thumbnails/<?php echo $data["user_avatar"];?>" class="img-rounded" alt="Avatar" /></a></p>
				<?php }else{ ?>
				<p><img src="http://forum.prog/gallery/avatars/default.png" class="img-rounded" alt="Avatar" /></p>
				<p class="text-muted"><?php echo $lang_settings["no_avatar"];?></p>
				<?php } ?>
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
				<label for="country"><?php echo $lang_settings["country"];?></label>
				<input type="text" class="form-control input-sm" name="data[country]" id="country" value="<?php echo display( $data["user_country"] );?>" />
				<span class="help-block"><?php echo $lang_settings["country_desc"];?></span>
				</div>
				</div>

				<div class="form-group">
				<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
				<label for="style"><?php echo $lang_settings["style"];?></label>
				<select class="form-control input-sm" name="data[style]" id="style">
				<option value=""></option>
				<?php $counter1=-1; if( isset($form["styles"]) && is_array($form["styles"]) && sizeof($form["styles"]) ) foreach( $form["styles"] as $key1 => $value1 ){ $counter1++; ?>
				<option value="<?php echo $key1;?>"<?php if( $data["user_style"] == $key1 ){ ?> selected="selected"<?php } ?>><?php echo $value1;?></option>
				<?php } ?>
				</select>
				</div>
				</div>

				<div class="form-group">
				<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
				<label for="lang"><?php echo $lang_settings["lang"];?></label>
				<select class="form-control input-sm" name="data[lang]" id="lang">
				<option value=""></option>
				<?php $counter1=-1; if( isset($form["langs"]) && is_array($form["langs"]) && sizeof($form["langs"]) ) foreach( $form["langs"] as $key1 => $value1 ){ $counter1++; ?>
				<option value="<?php echo $key1;?>"<?php if( $data["user_lang"] == $key1 ){ ?> selected="selected"<?php } ?>><?php echo $value1;?></option>
				<?php } ?>
				</select>
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
				<label for="timezone"><?php echo $lang_settings["timezone"];?></label>
				<select class="form-control input-sm" name="data[timezone]" id="timezone">
				<option value=""></option>
				<?php $counter1=-1; if( isset($form["timezones"]) && is_array($form["timezones"]) && sizeof($form["timezones"]) ) foreach( $form["timezones"] as $key1 => $value1 ){ $counter1++; ?>
				<option value="<?php echo $key1;?>"<?php if( $data["user_timezone"] == $key1 ){ ?> selected="selected"<?php } ?>><?php echo $value1;?></option>
				<?php } ?>
				</select>
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<p><a class="btn btn-info btn-xs" onclick="document.getElementById('captcha').src=document.getElementById('captcha').src+'?'+Math.random();return false">Demander un nouveau code</a></p>
				<p><img src="http://forum.prog/captcha.php" alt="Captcha" id="captcha" /></p>
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<input type="text" class="form-control" name="captcha" placeholder="<?php echo $lang_settings["copy_code"];?>" />
				</div>
				</div>
				
				<button type="submit" class="btn btn-success"><?php echo $lang_settings["validate"];?></button>
				<input type="hidden" name="token" value="<?php echo $form["token"];?>" />
				</form>
			  </div>
			</div>
			<?php } ?>
			</div>
			</div>
		</div>
		
		<div class="col-sm-3 col-sm-pull-9 col-md-3 col-md-pull-6 col-lg-2 col-lg-pull-4">
			<div class="list-group">
			<a class="list-group-item active" href="http://forum.prog/settings"><?php echo $lang_settings["account"];?></a>
			<a class="list-group-item" href="http://forum.prog/notifications"><?php echo $lang_settings["notifications"];?></a>
			<a class="list-group-item" href="http://forum.prog/subscriptions"><?php echo $lang_settings["subscriptions"];?></a>
			<a class="list-group-item" href="http://forum.prog/avatars"><?php echo $lang_settings["avatars"];?></a>
			</div>
		</div>
	</div>
</div>
<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "footer" );?>