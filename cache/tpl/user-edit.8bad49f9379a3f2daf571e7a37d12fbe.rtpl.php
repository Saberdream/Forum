<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "header" );?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-push-3 col-md-7 col-md-push-4 col-lg-6 col-lg-push-4">
			<ol class="breadcrumb">
			  <li><a href="http://forum.prog/adm/index.php"><?php echo $lang_menu_top["admin_cp"];?></a></li>
			  <li><a href="http://forum.prog/adm/users.php"><?php echo $lang_user_edit["manage_users"];?></a></li>
			  <li class="active"><?php echo $lang_user_edit["edit_user"];?></li>
			</ol>
			<div class="panel panel-default">
			<div class="panel-body">
			<?php if( isset($data["user_id"]) ){ ?>
			<?php if( !empty($form["error"]) ){ ?>
			<div class="alert alert-danger">
			<?php echo $lang_user_edit["errors_occurred"];?>:
			<ul><?php $counter1=-1; if( isset($form["error"]) && is_array($form["error"]) && sizeof($form["error"]) ) foreach( $form["error"] as $key1 => $value1 ){ $counter1++; ?><li><?php echo $value1;?></li><?php } ?></ul>
			</div>
			<?php }elseif( !empty($form["ok"]) ){ ?>
			<div class="alert alert-success"><?php echo $form["ok"];?></div>
			<?php } ?>
			<div class="row">
			  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h4><?php echo $lang_user_edit["user_informations"];?> <span class="text-primary"><?php echo display( $data["user_name"] );?></span></h4>
				<form class="form form-horizontal" method="post" action="http://forum.prog/adm/user-edit.php?id=<?php echo $data["user_id"];?>">
				
				<div class="form-group">
				<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
				<label for="password"><?php echo $lang_user_edit["password"];?></label>
				<input type="text" class="form-control input-sm" name="data[password]" id="password" value="<?php echo display( $data["user_password"] );?>" />
				<span class="help-block"><?php echo $lang_user_edit["password_desc"];?></span>
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
				<label for="email"><?php echo $lang_user_edit["email"];?></label>
				<input type="text" class="form-control input-sm" name="data[email]" id="email" value="<?php echo display( $data["user_email"] );?>" />
				<span class="help-block"><?php echo $lang_user_edit["email_desc"];?></span>
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
				<label for="ip"><?php echo $lang_user_edit["ip"];?></label>
				<input type="text" class="form-control input-sm" name="data[ip]" id="ip" value="<?php echo display( $data["user_ip"] );?>" />
				<span class="help-block"><?php echo $lang_user_edit["ip_desc"];?></span>
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
				<label for="time"><?php echo $lang_user_edit["time"];?></label>
				<input type="text" class="form-control input-sm" name="data[time]" id="time" value="<?php echo intval( $data["user_time"] );?>" />
				<span class="help-block"><?php echo $lang_user_edit["time_desc"];?></span>
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
				<label for="last"><?php echo $lang_user_edit["last"];?></label>
				<input type="text" class="form-control input-sm" name="data[last]" id="last" value="<?php echo intval( $data["user_last"] );?>" />
				<span class="help-block"><?php echo $lang_user_edit["last_desc"];?></span>
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
				<label for="rank"><?php echo $lang_user_edit["rank"];?></label>
				<?php if( $data["user_rank"] == FOUNDER ){ ?>
				<p class="text-danger">Fondateur</p>
				<?php }elseif( $data["user_rank"] == GUEST ){ ?>
				<p class="text-primary">Invité</p>
				<?php }else{ ?>
				<select class="form-control input-sm" name="data[rank]" id="rank">
				<?php $counter1=-1; if( isset($form["ranks"]) && is_array($form["ranks"]) && sizeof($form["ranks"]) ) foreach( $form["ranks"] as $key1 => $value1 ){ $counter1++; ?>
				<option value="<?php echo $key1;?>"<?php if( $data["user_rank"] == $key1 ){ ?> selected="selected"<?php } ?>><?php echo $value1;?></option>
				<?php } ?>
				</select>
				<?php } ?>
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
				<label for="sex"><?php echo $lang_user_edit["sex"];?></label>
				<input type="text" class="form-control input-sm" name="data[sex]" id="sex" value="<?php echo display( $data["user_sex"] );?>" />
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
				<label for="birthday"><?php echo $lang_user_edit["birthday"];?></label>
				<input type="text" class="form-control input-sm" name="data[birthday]" id="birthday" value="<?php echo display( $data["user_birthday"] );?>" />
				<span class="help-block"><?php echo $lang_user_edit["birthday_desc"];?></span>
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<label for="sign"><?php echo $lang_user_edit["sign"];?></label>
				<textarea class="form-control input-sm" name="data[sign]" id="sign"><?php echo display( $data["user_sign"] );?></textarea>
				<span class="help-block"><?php echo $lang_user_edit["sign_desc"];?></span>
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<label for="desc"><?php echo $lang_user_edit["desc"];?></label>
				<textarea class="form-control input-sm" name="data[desc]" id="desc"><?php echo display( $data["user_desc"] );?></textarea>
				<span class="help-block"><?php echo $lang_user_edit["desc"];?></span>
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
				<label for="posts"><?php echo $lang_user_edit["posts"];?></label>
				<input type="text" class="form-control input-sm" name="data[posts]" id="posts" value="<?php echo intval( $data["user_posts"] );?>" />
				<span class="help-block"><?php echo $lang_user_edit["posts_desc"];?></span>
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
				<label><?php echo $lang_user_edit["avatar"];?></label>
				<?php if( !empty($data["user_avatar"]) ){ ?>
				<p><a class="image-upload" href="http://forum.prog/gallery/avatars/<?php echo $data["user_avatar"];?>"><img src="http://forum.prog/gallery/avatars/thumbnails/<?php echo $data["user_avatar"];?>" class="img-rounded" alt="Avatar" /></a></p>
				<p class="text-muted"><?php echo display( $data["user_avatar"] );?></p>
				<?php }else{ ?>
				<p><img src="http://forum.prog/gallery/avatars/default.png" class="img-rounded" alt="Avatar" /></p>
				<p class="text-muted">L'utilisateur n'a pas choisi d'avatar.</p>
				<?php } ?>
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
				<label for="country"><?php echo $lang_user_edit["country"];?></label>
				<input type="text" class="form-control input-sm" name="data[country]" id="country" value="<?php echo display( $data["user_country"] );?>" />
				<span class="help-block"><?php echo $lang_user_edit["country"];?></span>
				</div>
				</div>

				<div class="form-group">
				<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
				<label for="style"><?php echo $lang_user_edit["style"];?></label>
				<select class="form-control input-sm" name="data[style]" id="style">
				<option value=""></option>
				<?php $counter1=-1; if( isset($form["styles"]) && is_array($form["styles"]) && sizeof($form["styles"]) ) foreach( $form["styles"] as $key1 => $value1 ){ $counter1++; ?>
				<option value="<?php echo $value1;?>"<?php if( $data["user_style"] == $value1 ){ ?> selected="selected"<?php } ?>><?php echo $value1;?></option>
				<?php } ?>
				</select>
				</div>
				</div>

				<div class="form-group">
				<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
				<label for="lang"><?php echo $lang_user_edit["lang"];?></label>
				<select class="form-control input-sm" name="data[lang]" id="lang">
				<option value=""></option>
				<?php $counter1=-1; if( isset($form["langs"]) && is_array($form["langs"]) && sizeof($form["langs"]) ) foreach( $form["langs"] as $key1 => $value1 ){ $counter1++; ?>
				<option value="<?php echo $value1;?>"<?php if( $data["user_lang"] == $value1 ){ ?> selected="selected"<?php } ?>><?php echo $value1;?></option>
				<?php } ?>
				</select>
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
				<label for="timezone"><?php echo $lang_user_edit["timezone"];?></label>
				<select class="form-control input-sm" name="data[timezone]" id="timezone">
				<option value=""></option>
				<?php $counter1=-1; if( isset($form["timezones"]) && is_array($form["timezones"]) && sizeof($form["timezones"]) ) foreach( $form["timezones"] as $key1 => $value1 ){ $counter1++; ?>
				<option value="<?php echo $key1;?>"<?php if( $data["user_timezone"] == $key1 ){ ?> selected="selected"<?php } ?>><?php echo $value1;?></option>
				<?php } ?>
				</select>
				</div>
				</div>
				
				<div class="text-center">
				  <button type="submit" class="btn btn-success"><?php echo $lang_user_edit["save"];?></button>
				</div>
				<input type="hidden" name="token" value="<?php echo $form["token"];?>" />
				</form>
			  </div>
			</div>
			<?php }else{ ?>
			<div class="alert alert-danger text-center"><?php echo $lang_user_edit["user_not_found"];?> <img src="http://forum.prog/gallery/smilies/1.gif" alt=":)" /></div>
			<?php } ?>
			</div>
			</div>
		</div>
		
		<div class="col-sm-3 col-sm-pull-9 col-md-3 col-md-pull-6 col-lg-2 col-lg-pull-4">
			<div class="list-group">
			<a class="list-group-item active" href="http://forum.prog/adm/users.php"><?php echo $lang_menu_top["users"];?></a>
			<a class="list-group-item" href="http://forum.prog/adm/banlist.php"><?php echo $lang_user_edit["banlist"];?></a>
			<a class="list-group-item" href="http://forum.prog/adm/avatars.php"><?php echo $lang_user_edit["avatars"];?></a>
			</div>
		</div>
	</div>
</div>
<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "footer" );?>