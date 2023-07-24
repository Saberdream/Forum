<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "header" );?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-push-3 col-md-7 col-md-push-4 col-lg-6 col-lg-push-4">
			<ol class="breadcrumb">
			  <li class="active"><span class="glyphicon glyphicon-user"></span> <?php echo $lang_login["account"];?></li>
			  <li class="active"><?php if( !$connect_adm ){ ?><?php echo $lang_login["connect"];?><?php }else{ ?><?php echo $lang_login["connect_acp"];?><?php } ?></li>
			</ol>
			<div class="panel panel-default">
			<div class="panel-body">
			<?php if( $user["user_rank"]<USER || ($connect_adm && !$user["admin"]) ){ ?>
			<p class="text-muted"><?php if( !$connect_adm ){ ?><?php echo $lang_login["page_description"];?><?php }else{ ?><?php echo $lang_login["page_description_acp"];?><?php } ?></p>
			<?php if( !empty($form["error"]) ){ ?>
			<div class="alert alert-danger">
			<?php echo $lang_login["errors_occurred"];?>:
			<ul><?php $counter1=-1; if( isset($form["error"]) && is_array($form["error"]) && sizeof($form["error"]) ) foreach( $form["error"] as $key1 => $value1 ){ $counter1++; ?><li><?php echo $value1;?></li><?php } ?></ul>
			</div>
			<?php } ?>
			<div class="row">
				<form class="col-xs-12 col-sm-6 col-md-6 col-lg-5" method="post" action="http://forum.prog/login<?php if( $connect_adm ){ ?>?mode=admin<?php } ?>">
				<div class="form-group">
				<label class="sr-only" for="username"><?php echo $lang_login["username"];?></label>
				<input type="text" class="form-control" name="username" id="username" value="<?php echo display( $form["username"] );?>" placeholder="<?php echo $lang_login["enter_username"];?>" />
				</div>

				<div class="form-group">
				<label class="sr-only" for="password"><?php echo $lang_login["password"];?></label>
				<input type="password" class="form-control" name="password" id="password" placeholder="<?php echo $lang_login["password"];?>" />
				</div>

				<?php if( !$connect_adm ){ ?>
				<div class="form-group">
				<label for="remember"><input type="checkbox" name="remember" id="remember"<?php if( $form["remember"] ){ ?> checked<?php } ?> /> <?php echo $lang_login["automatic_connection"];?></label>
				</div>
				<?php } ?>

				<div class="form-group">
				<a href="" class="btn btn-info btn-xs" onclick="document.getElementById('captcha').src=document.getElementById('captcha').src+'?'+Math.random();return false"><?php echo $lang_login["ask_new_code"];?></a>
				</div>

				<div class="form-group">
				<img src="http://forum.prog/captcha.php" alt="Captcha" id="captcha" />
				</div>

				<div class="form-group">
				<input type="text" class="form-control" name="captcha" placeholder="<?php echo $lang_login["copy_code"];?>" autocomplete="off" />
				</div>

				<button type="submit" class="btn btn-default"><?php echo $lang_login["validate"];?></button>
				<input type="hidden" name="token" value="<?php echo $form["token"];?>" />
				<?php if( !$connect_adm ){ ?><input type="hidden" name="previous" value="<?php echo display( $form["previous"] );?>" /><?php } ?>
				</form>
			</div>
			<?php }else{ ?>
			<div class="alert alert-danger"><?php if( $connect_adm && $user["admin"] ){ ?><?php echo $lang_login["already_connected_acp"];?><?php }else{ ?><?php echo $lang_login["already_connected"];?><?php } ?></div>
			<?php } ?>
			</div>
			</div>
		</div>
		
		<div class="col-sm-3 col-sm-pull-9 col-md-3 col-md-pull-6 col-lg-2 col-lg-pull-4">
			<div class="list-group">
			<a class="list-group-item" href="http://forum.prog/index"><?php echo $lang_menu_top["home"];?></a>
			<a class="list-group-item" href="http://forum.prog/viewonline"><?php echo $lang_login["users_connected"];?></a>
			</div>
		</div>
	</div>
</div>
<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "footer" );?>