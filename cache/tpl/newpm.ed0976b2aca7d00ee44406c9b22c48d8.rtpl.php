<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "header" );?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-push-3 col-md-7 col-md-push-4 col-lg-6 col-lg-push-4">
			<ol class="breadcrumb">
			  <li><a href="http://forum.prog/pm"><?php echo $lang_menu_top["private_messages"];?></a></li>
			  <li class="active"><?php echo $lang_newpm["send_new_pm"];?></li>
			</ol>
			<?php if( $user["user_rank"] >= USER ){ ?>
			<div id="message-preview" class="post post1">
			  <div class="post_header"><h4><?php echo $lang_newpm["preview"];?></h4></div>
			  <div class="post_body"></div>
			</div>
			<input type="hidden" name="token_preview" value="<?php echo $preview_token;?>" />

			<div class="panel panel-default">
			<div class="panel-heading"><b><?php echo $lang_newpm["send_new_pm"];?></b></div>
			<div class="panel-body">
			<?php if( !empty($form["error"]) ){ ?>
			<div class="alert alert-danger">
			<?php echo $lang_newpm["errors_detected"];?>:
			<ul><?php $counter1=-1; if( isset($form["error"]) && is_array($form["error"]) && sizeof($form["error"]) ) foreach( $form["error"] as $key1 => $value1 ){ $counter1++; ?><li><?php echo $value1;?></li><?php } ?></ul>
			</div>
			<?php } ?>
			<form class="form-horizontal" method="post" action="http://forum.prog/newpm">
			<div class="form-group">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<label for="recipients"><?php echo $lang_newpm["recipients"];?></label>
			<input class="form-control" type="text" name="recipients" id="recipients" value="<?php echo display( $form["recipients"] );?>" placeholder="<?php echo $lang_newpm["recipients"];?>" />
			</div>
			</div>
			<div class="form-group">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<label for="subject" class="sr-only"><?php echo $lang_newpm["subject"];?></label>
			<input class="form-control" type="text" name="subject" id="subject" value="<?php echo display( $form["subject"] );?>" placeholder="<?php echo $lang_newpm["type_subject"];?>" />
			</div>
			</div>
			<div class="form-group">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<label for="message" class="text-danger"><?php echo $lang_newpm["message"];?></label>
			<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "bbcode" );?>
			<textarea class="form-control" rows="4" name="message" id="message" placeholder="<?php echo $lang_newpm["message_rules"];?>"><?php echo display( $form["message"] );?></textarea>
			</div>
			</div>
			<?php if( $form["captcha"] ){ ?>
			<div class="form-group">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
			<a class="btn btn-info btn-xs" onclick="document.getElementById('captcha').src=document.getElementById('captcha').src+'?'+Math.random(); return false"><?php echo $lang_newpm["request_new_code"];?></a>
			</div>
			</div>
			<div class="form-group">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
			<img src="http://forum.prog/captcha.php" alt="Captcha" id="captcha" />
			</div>
			</div>
			<div class="form-group">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
			<input type="text" class="form-control" name="captcha" placeholder="<?php echo $lang_newpm["copy_code"];?>" autocomplete="off" />
			</div>
			</div>
			<?php } ?>
			<div class="form-group">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<button type="submit" class="btn btn-warning"><?php echo $lang_newpm["post"];?></button>
			<button type="button" class="btn btn-primary" id="button-preview"><i class="fa fa-eye"></i> <?php echo $lang_newpm["preview"];?></button>
			</div>
			</div>
			<input type="hidden" name="token" value="<?php echo $form["token"];?>" />
			</form>
			</div>
			</div>
			
			<script>
			$(function(){
				$('#recipients').tagit({
				  singleFieldDelimiter: ';',
				  placeholderText: '<?php echo escape_quotes( $lang_newpm["recipients"] );?>'
				});
			});
			</script>
			<?php }else{ ?>
			<div class="alert alert-warning text-center"><?php echo $lang_newpm["not_logged_in"];?></div>
			<?php } ?>
		</div>
		
		<div class="col-sm-3 col-sm-pull-9 col-md-3 col-md-pull-6 col-lg-2 col-lg-pull-4">
			<div class="list-group">
			<a class="list-group-item active" href="http://forum.prog/newpm"><?php echo $lang_newpm["new_message"];?></a>
			<a class="list-group-item" href="http://forum.prog/pm"><?php echo $lang_newpm["mailbox"];?></a>
			<a class="list-group-item" href="http://forum.prog/blacklist"><?php echo $lang_newpm["blacklist"];?></a>
			</div>
		</div>
	</div>
</div>
<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "footer" );?>