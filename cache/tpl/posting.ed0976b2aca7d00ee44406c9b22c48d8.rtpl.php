<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "header" );?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-push-3 col-md-7 col-md-push-4 col-lg-6 col-lg-push-4">
			<ol class="breadcrumb">
			  <li><a href="http://forum.prog/forums"><span class="glyphicon glyphicon-th-list"></span> <?php echo $lang_posting["forums"];?></a></li>
			  <li class="active"><?php echo display( $forum["cat_name"] );?></li>
			  <?php if( $user["user_rank"] >= $forum["forum_auth_view"] ){ ?><li class="active"><a href="http://forum.prog/forum/<?php echo $forum["forum_slug"];?>/<?php echo $forum["forum_id"];?>/1"><?php echo $lang_posting["forum"];?> <?php echo display( $forum["forum_name"] );?></a></li><?php } ?>
			</ol>
			<?php if( $user["user_rank"] >= $forum["forum_auth_view"] ){ ?>
			<?php if( $user["user_rank"] == GUEST ){ ?>
			<div class="alert alert-warning text-center"><?php echo $lang_posting["not_logged_in"];?></div>
			<?php }elseif( $forum["forum_auth_topic"] > $user["user_rank"] && $mode == 'new' ){ ?>
			<div class="alert alert-warning text-center"><?php echo $lang_posting["not_authorized_newtopic"];?></div>
			<?php }elseif( $forum["forum_auth_reply"] > $user["user_rank"] && $mode == 'reply' ){ ?>
			<div class="alert alert-warning text-center"><?php echo $lang_posting["not_authorized_reply"];?></div>
			<?php }else{ ?>
			<div id="message-preview" class="post post1">
			  <div class="post_header"><h4><?php echo $lang_posting["preview"];?></h4></div>
			  <div class="post_body"></div>
			</div>
			<input type="hidden" name="token_preview" value="<?php echo $preview_token;?>" />

			<div class="panel panel-default">
			<div class="panel-heading"><b><?php if( $mode == 'new' ){ ?><?php echo $lang_posting["create_new_topic"];?><?php }elseif( $mode == 'reply' ){ ?><?php echo $lang_posting["reply_topic"];?><?php } ?></b></div>
			<div class="panel-body">
			<?php if( !empty($form["error"]) ){ ?>
			<div class="alert alert-danger">
			<?php echo $lang_posting["errors_detected"];?>:
			<ul><?php $counter1=-1; if( isset($form["error"]) && is_array($form["error"]) && sizeof($form["error"]) ) foreach( $form["error"] as $key1 => $value1 ){ $counter1++; ?><li><?php echo $value1;?></li><?php } ?></ul>
			</div>
			<?php } ?>
			<form class="form-horizontal" method="post" action="http://forum.prog/posting">
			<?php if( $mode == 'new' ){ ?>
			<div class="form-group">
			<div class="col-sm-12 col-md-12 col-lg-12">
			<label for="subject" class="sr-only"><?php echo $lang_posting["subject"];?></label>
			<input class="form-control" type="text" name="subject" id="subject" value="<?php echo display( $form["subject"] );?>" placeholder="<?php echo $lang_posting["type_subject"];?>" />
			</div>
			</div>
			<?php } ?>
			<div class="form-group">
			<div class="col-sm-12 col-md-12 col-lg-12">
			<label for="message" class="text-danger"><?php echo $lang_posting["message"];?></label>
			<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "bbcode" );?>
			<textarea class="form-control" rows="4" name="message" id="message" placeholder="<?php echo $lang_posting["message_rules"];?>"><?php echo display( $form["message"] );?></textarea>
			</div>
			</div>
			<?php if( $form["captcha"] ){ ?>
			<div class="form-group">
			<div class="col-sm-12 col-md-6 col-lg-4">
			<a class="btn btn-info btn-xs" onclick="document.getElementById('captcha').src=document.getElementById('captcha').src+'?'+Math.random(); return false"><?php echo $lang_posting["request_new_code"];?></a>
			</div>
			</div>
			<div class="form-group">
			<div class="col-sm-12 col-md-6 col-lg-4">
			<img src="http://forum.prog/captcha.php" alt="Captcha" id="captcha" />
			</div>
			</div>
			<div class="form-group">
			<div class="col-sm-12 col-md-6 col-lg-4">
			<input type="text" class="form-control" name="captcha" placeholder="<?php echo $lang_posting["copy_code"];?>" autocomplete="off" />
			</div>
			</div>
			<?php } ?>
			<div class="form-group">
			<div class="col-sm-12 col-md-6 col-lg-6">
			<button type="submit" class="btn btn-warning"><?php echo $lang_posting["post"];?></button>
			<button type="button" class="btn btn-primary" id="button-preview"><i class="fa fa-eye"></i> <?php echo $lang_posting["preview"];?></button>
			<a class="btn btn-black" href="http://forum.prog/<?php if( $mode == 'new' ){ ?>forum/<?php echo $forum["forum_slug"];?>/<?php echo $forum["forum_id"];?>/1<?php }elseif( $mode == 'reply' && !empty($topic) ){ ?>topic/<?php echo $topic["topic_slug"];?>/<?php echo $topic["topic_id"];?>/<?php echo $last_page;?><?php }else{ ?>forums<?php } ?>"><?php echo $lang_posting["back"];?></a>
			</div>
			</div>
			<input type="hidden" name="token" value="<?php echo $form["token"];?>" />
			<input type="hidden" name="mode" value="<?php echo $mode;?>" />
			<input type="hidden" name="forum" value="<?php echo $forum["forum_id"];?>" />
			<?php if( $mode == 'reply' && !empty($topic) ){ ?>
			<input type="hidden" name="topic" value="<?php echo $topic["topic_id"];?>" />
			<input type="hidden" name="page" value="<?php echo $last_page;?>" />
			<?php } ?>
			</form>
			</div>
			</div>
			<?php } ?>
			<?php }else{ ?>
			<div class="alert alert-warning text-center"><?php echo $lang_posting["not_authorized_access"];?></div>
			<?php } ?>
		</div>
		
		<div class="col-sm-3 col-sm-pull-9 col-md-3 col-md-pull-6 col-lg-2 col-lg-pull-4">
			<div class="list-group">
			<a class="list-group-item" href="http://forum.prog/index"><?php echo $lang_menu_top["home"];?></a>
			<a class="list-group-item" href="http://forum.prog/forums"><?php echo $lang_posting["all_forums"];?></a>
			<a class="list-group-item" href="http://forum.prog/subscriptions"><?php echo $lang_posting["followed_topics"];?></a>
			<a class="list-group-item" href="http://forum.prog/viewonline"><?php echo $lang_posting["users_connected"];?></a>
			</div>
		</div>
	</div>
</div>
<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "footer" );?>