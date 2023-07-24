<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "header" );?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-push-3 col-md-7 col-md-push-4 col-lg-6 col-lg-push-4">
			<ol class="breadcrumb">
			  <li class="active"><span class="glyphicon glyphicon-user"></span> <?php echo $lang_register["account"];?></li>
			  <li class="active"><?php echo $lang_register["registration"];?></li>
			</ol>
			<div class="panel panel-default">
			<div class="panel-body">
			<?php if( $open == 1 ){ ?>
			<?php if( !empty($form["ok"]) ){ ?>
			<div class="alert alert-success"><?php echo $form["ok"];?></div>
			<?php }else{ ?>
			<?php if( !empty($form["error"]) ){ ?>
			<div class="alert alert-danger">
			<?php echo $lang_register["errors_occured"];?>:
			<ul><?php $counter1=-1; if( isset($form["error"]) && is_array($form["error"]) && sizeof($form["error"]) ) foreach( $form["error"] as $key1 => $value1 ){ $counter1++; ?><li><?php echo $value1;?></li><?php } ?></ul>
			</div>
			<?php } ?>
			<div class="row">
			  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<form class="form form-horizontal" method="post" action="http://forum.prog/register">
				<div class="form-group">
				<div class="col-xs-12 col-sm-8 col-md-6 col-lg-5">
				<label class="sr-only" for="username"><?php echo $lang_register["username"];?></label>
				<input type="text" class="form-control" name="username" id="username" value="<?php echo display( $form["username"] );?>" placeholder="<?php echo $lang_register["enter_username"];?>" />
				</div>
				</div>

				<div class="form-group">
				<div class="col-xs-12 col-sm-8 col-md-6 col-lg-5">
				<label class="sr-only" for="pass"><?php echo $lang_register["password"];?></label>
				<input type="password" class="form-control" name="pass" id="pass" placeholder="<?php echo $lang_register["enter_password"];?>" />
				</div>
				</div>

				<div class="form-group">
				<div class="col-xs-12 col-sm-8 col-md-6 col-lg-5">
				<label class="sr-only" for="pass_confirm"><?php echo $lang_register["password_confirmation"];?></label>
				<input type="password" class="form-control" name="pass_confirm" id="pass_confirm" placeholder="<?php echo $lang_register["confirm_password"];?>" />
				</div>
				</div>

				<div class="form-group">
				<div class="col-xs-12 col-sm-8 col-md-6 col-lg-5">
				<label class="sr-only" for="email"><?php echo $lang_register["email"];?></label>
				<input type="text" class="form-control" name="email" id="email" value="<?php echo display( $form["email"] );?>" placeholder="<?php echo $lang_register["enter_email"];?>" />
				</div>
				</div>

				<div class="form-group">
				<div class="col-xs-12 col-sm-8 col-md-6 col-lg-5">
				<a class="btn btn-info btn-xs" onclick="document.getElementById('captcha').src=document.getElementById('captcha').src+'?'+Math.random();return false"><?php echo $lang_register["ask_new_code"];?></a>
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-xs-12 col-sm-8 col-md-6 col-lg-5">
				<img src="http://forum.prog/captcha.php" alt="Captcha" id="captcha" />
				</div>
				</div>

				<div class="form-group">
				<div class="col-xs-12 col-sm-8 col-md-6 col-lg-5">
				<input type="text" class="form-control" name="captcha" placeholder="<?php echo $lang_register["copy_code"];?>" autocomplete="off" />
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h4><?php echo $lang_register["terms_of_use"];?></h4>
				<div id="terms">
				<?php echo $lang_register["terms_text"];?>
				</div>
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<label for="accept_terms"><input type="checkbox" name="accept_terms" id="accept_terms"<?php if( $form["accept_terms"] ){ ?> checked<?php } ?> /> <?php echo $lang_register["accept_terms"];?></label>
				</div>
				</div>

				<div class="form-group">
				<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
				<button type="submit" class="btn btn-success"><?php echo $lang_register["validate"];?></button>
				</div>
				</div>
				
				<input type="hidden" name="token" value="<?php echo $form["token"];?>" />
				</form>
			  </div>
			</div>
			<?php } ?>
			<?php }else{ ?>
			<div class="alert alert-danger text-center"><b><?php echo $lang_register["registration_closed"];?></b></div>
			<?php } ?>
			</div>
			</div>
		</div>
		
		<div class="col-sm-3 col-sm-pull-9 col-md-3 col-md-pull-6 col-lg-2 col-lg-pull-4">
			<div class="list-group">
			<a class="list-group-item" href="http://forum.prog/index"><?php echo $lang_menu_top["home"];?></a>
			</div>
		</div>
	</div>
</div>
<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "footer" );?>