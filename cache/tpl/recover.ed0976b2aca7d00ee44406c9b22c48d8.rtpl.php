<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "header" );?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-push-3 col-md-7 col-md-push-4 col-lg-6 col-lg-push-4">
			<ol class="breadcrumb">
			  <li class="active"><span class="glyphicon glyphicon-user"></span> <?php echo $lang_recover["account"];?></li>
			  <li class="active"><?php echo $lang_recover["password_recovery"];?></li>
			</ol>
			<div class="panel panel-default">
			<div class="panel-body">
			<?php if( !empty($form["ok"]) ){ ?>
			<div class="alert alert-success"><?php echo $form["ok"];?></div>
			<?php }else{ ?>
			<?php if( !empty($form["error"]) ){ ?>
			<div class="alert alert-danger">
			<?php echo $lang_recover["errors_occured"];?>:
			<ul><?php $counter1=-1; if( isset($form["error"]) && is_array($form["error"]) && sizeof($form["error"]) ) foreach( $form["error"] as $key1 => $value1 ){ $counter1++; ?><li><?php echo $value1;?></li><?php } ?></ul>
			</div>
			<?php } ?>
			<div class="row">
				<form class="col-xs-5" method="post" action="http://forum.prog/recover">
				<div class="form-group">
				<label class="sr-only" for="username"><?php echo $lang_recover["username"];?></label>
				<input type="text" class="form-control" name="username" id="username" value="<?php echo display( $form["username"] );?>" placeholder="<?php echo $lang_recover["enter_username"];?>" />
				</div>
				
				<div class="form-group">
				<label class="sr-only" for="email"><?php echo $lang_recover["email"];?></label>
				<input type="text" class="form-control" name="email" id="email" value="<?php echo display( $form["email"] );?>" placeholder="<?php echo $lang_recover["enter_email"];?>" />
				</div>
				
				<div class="form-group">
				<a class="btn btn-info btn-xs" onclick="document.getElementById('captcha').src=document.getElementById('captcha').src+'?'+Math.random();return false"><?php echo $lang_recover["ask_new_code"];?></a>
				</div>
				
				<div class="form-group">
				<img src="http://forum.prog/captcha.php" alt="Captcha" id="captcha" />
				</div>

				<div class="form-group">
				<input type="text" class="form-control" name="captcha" placeholder="<?php echo $lang_recover["copy_code"];?>" />
				</div>
				
				<button type="submit" class="btn btn-success"><?php echo $lang_recover["validate"];?></button>
				<input type="hidden" name="token" value="<?php echo $form["token"];?>" />
				</form>
			</div>
			<?php } ?>
			</div>
			</div>
		</div>
		
		<div class="col-sm-3 col-sm-pull-9 col-md-3 col-md-pull-6 col-lg-2 col-lg-pull-4">
			<div class="list-group">
			<a class="list-group-item" href="http://forum.prog/index"><?php echo $lang_menu_top["home"];?></a>
			<a class="list-group-item" href="http://forum.prog/viewonline"><?php echo $lang_recover["users_connected"];?></a>
			</div>
		</div>
	</div>
</div>
<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "footer" );?>