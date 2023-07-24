<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "header" );?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-push-3 col-md-7 col-md-push-4 col-lg-6 col-lg-push-4">
			<ol class="breadcrumb">
			  <li><a href="http://forum.prog/forums"><span class="glyphicon glyphicon-th-list"></span> <?php echo $lang_topic["forums"];?></a></li>
			  <li class="active"><?php echo display( $topic["cat_name"] );?></li>
			  <?php if( $user["user_rank"] >= $topic["forum_auth_view"] ){ ?>
			  <li><a href="http://forum.prog/forum/<?php echo $topic["forum_slug"];?>/<?php echo $topic["topic_forumid"];?>/1"><?php echo $lang_topic["forum"];?> <?php echo display( $topic["forum_name"] );?></a></li>
			  <li class="active"><?php echo display( $topic["topic_name"] );?></li>
			  <?php } ?>
			</ol>
			<?php if( $user["user_rank"] >= $topic["forum_auth_view"] ){ ?>
			<h4 class="forum-topic-title"><?php echo $lang_topic["subject"];?> : <span class="text-primary"><?php echo display( $topic["topic_name"] );?></span></h4>
			
			<div class="forum-separator"></div>
			<div class="row">
			  <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3"><?php if( $user["user_rank"] >= $topic["forum_auth_topic"] ){ ?><a class="btn btn-black btn-sm" href="http://forum.prog/forum/<?php echo $topic["forum_slug"];?>/<?php echo $topic["topic_forumid"];?>/1#form_post"><b><?php echo mb_strtoupper( $lang_topic["new_topic"] );?></b></a><?php } ?></div>
			  <div class="col-xs-6 col-sm-3 col-sm-push-6 col-md-3 col-md-push-6 col-lg-3 col-lg-push-6 text-right"><a class="btn btn-black btn-sm" href="http://forum.prog/forum/<?php echo $topic["forum_slug"];?>/<?php echo $topic["topic_forumid"];?>/1"><b><?php echo mb_strtoupper( $lang_topic["list_topics"] );?></b></a></div>
			  <div class="col-xs-12 hidden-sm hidden-md hidden-lg">
			    <div class="forum-separator"></div>
			  </div>
			  <div class="col-xs-12 col-sm-6 col-sm-pull-3 col-md-6 col-md-pull-3 col-lg-6 col-lg-pull-3 text-center"><?php if( $nb > 0 ){ ?><ul class="forum-pagination"><?php echo $pagination;?></ul><?php } ?></div>
			</div>
			<div class="forum-separator"></div>
			
			<div class="row forum-buttons">
			<div class="hidden-xs col-sm-7 col-md-7 col-lg-7">
			<?php if( $topic["topic_invisible"] == 0 ){ ?>
			<?php if( $moderator ){ ?>
			<?php if( $user["user_rank"] >= $topic["forum_auth_lock_topic"] ){ ?>
			<?php if( $topic["topic_lock"] == 0 ){ ?>
			<a class="bt-forum btn btn-danger btn-sm" href="http://forum.prog/mod.php?forum=<?php echo $topic["topic_forumid"];?>&amp;topic=<?php echo $topic["topic_id"];?>&amp;action=lock-topic&amp;token=<?php echo $token;?>"><b><?php echo mb_strtoupper( $lang_topic["lock"] );?></b></a>
			<?php }else{ ?>
			<a class="bt-forum btn btn-danger btn-sm" href="http://forum.prog/mod.php?forum=<?php echo $topic["topic_forumid"];?>&amp;topic=<?php echo $topic["topic_id"];?>&amp;action=unlock-topic&amp;token=<?php echo $token;?>"><b><?php echo mb_strtoupper( $lang_topic["unlock"] );?></b></a>
			<?php } ?>
			<?php } ?>
			<?php if( $user["user_rank"] >= $topic["forum_auth_stick_topic"] ){ ?>
			<?php if( $topic["topic_sticky"] == 0 ){ ?>
			<a class="bt-forum btn btn-success btn-sm" href="http://forum.prog/mod.php?forum=<?php echo $topic["topic_forumid"];?>&amp;topic=<?php echo $topic["topic_id"];?>&amp;action=stick-topic&amp;token=<?php echo $token;?>"><b><?php echo mb_strtoupper( $lang_topic["stick"] );?></b></a>
			<?php }else{ ?>
			<a class="bt-forum btn btn-success btn-sm" href="http://forum.prog/mod.php?forum=<?php echo $topic["topic_forumid"];?>&amp;topic=<?php echo $topic["topic_id"];?>&amp;action=unstick-topic&amp;token=<?php echo $token;?>"><b><?php echo mb_strtoupper( $lang_topic["unstick"] );?></b></a>
			<?php } ?>
			<?php } ?>
			<?php } ?>
			<a class="bt-forum-subscribe btn btn-primary btn-sm" href="http://forum.prog/viewtopic.php?id=<?php echo $topic["topic_id"];?>&amp;subscribe=1&amp;token=<?php echo $subscribe_token;?>"><b><?php echo mb_strtoupper( $lang_topic["alert"] );?></b></a>
			<?php } ?>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5 text-right">
			<?php if( $user["user_rank"] >= $topic["forum_auth_topic"] && $topic["topic_invisible"] == 0 && ($topic["topic_lock"] == 0 || $moderator) ){ ?><a class="btn btn-warning btn-sm" href="http://forum.prog/topic/<?php echo $topic["topic_slug"];?>/<?php echo $topic["topic_id"];?>/<?php echo $page;?>#form_post"><b><?php echo mb_strtoupper( $lang_topic["reply"] );?></b></a><?php } ?>
			<a class="btn btn-black btn-sm bt-refresh" href="<?php echo $current_url;?>"><b><?php echo mb_strtoupper( $lang_topic["refresh"] );?></b></a>
			</div>
			</div>

			<?php if( $nb > 0 ){ ?>
			<?php if( $moderator ){ ?>
			<form method="post" class="moder-form" action="http://forum.prog/mod.php?forum=<?php echo $topic["topic_forumid"];?>&amp;topic=<?php echo $topic["topic_id"];?>&amp;token=<?php echo $token;?>">
			<div class="navbar-fixed-bottom text-center" style="display:none;background-color:#eee;opacity:0.9;padding:10px;">
			<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<div class="form-inline">
			<div class="form-group">
				<input type="checkbox" id="selectall" />
				<label for="selectall"><?php echo $lang_topic["check_all"];?></label>
			</div>
			<div class="form-group">
				<select class="form-control input-sm" name="action">
				<option value=""><?php echo $lang_topic["action"];?></option>
				<?php if( $user["user_rank"] >= $topic["forum_auth_delete_post"] ){ ?><option value="delete"><?php echo $lang_topic["delete"];?></option><?php } ?>
				<?php if( $user["user_rank"] >= $topic["forum_auth_restore_post"] ){ ?><option value="restore"><?php echo $lang_topic["restore"];?></option><?php } ?>
				<?php if( $user["user_rank"] >= $topic["forum_auth_ban"] ){ ?><option value="ban"><?php echo $lang_topic["ban"];?></option>
				<option value="ban-tempo"><?php echo $lang_topic["ban_temporarily"];?></option><?php } ?>
				</select>
			</div>
			<div class="form-group">
				<button class="action-submit btn btn-sm btn-primary"><?php echo $lang_topic["validate"];?></button>
			</div>
			</div>
			</div>
			<?php } ?>

			<?php $counter1=-1; if( isset($rows) && is_array($rows) && sizeof($rows) ) foreach( $rows as $key1 => $value1 ){ $counter1++; ?>
			<?php if( !empty($alert) && $alert == $value1["post_id"] ){ ?>
			<?php if( $value1["post_invisible"] == 1 || $topic["topic_invisible"] == 1 ){ ?><div id="alert" class="post post_alert_invisible"><?php }else{ ?><div id="alert" class="post post_alert"><?php } ?>
			<?php }else{ ?>
			<?php if( $value1["post_invisible"] == 1 || $topic["topic_invisible"] == 1 ){ ?><div id="post_<?php echo $value1["post_id"];?>" class="post post_invisible"><?php }else{ ?><div id="post_<?php echo $value1["post_id"];?>" <?php if( $key1 % 2 == 1 ){ ?>class="post post2"<?php }else{ ?>class="post post1"<?php } ?>><?php } ?>
			<?php } ?>
				<div class="row post_header">
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 post_user">
					<?php if( $moderator && $topic["topic_postid"] != $value1["post_id"] ){ ?><input class="checkbox-item" type="checkbox" name="post[]" value="<?php echo $value1["post_id"];?>" /><?php } ?>
					<?php if( !empty($value1["user_avatar"]) ){ ?><a class="user_avatar" href="http://forum.prog/gallery/avatars/<?php echo display( $value1["user_avatar"] );?>"><img src="http://forum.prog/gallery/avatars/thumbnails/<?php echo display( $value1["user_avatar"] );?>" alt="<?php echo $lang_topic["avatar"];?>" /></a><?php }else{ ?><a class="user_avatar" href="http://forum.prog/gallery/avatars/default.png"><img src="http://forum.prog/gallery/avatars/default.png" alt="<?php echo $lang_topic["avatar"];?>" /></a><?php } ?>
					<span class="username"><a class="user-profile" href="http://forum.prog/profil/<?php echo strtolower( $value1["post_username"] );?>"><strong<?php if( $value1["post_rank"] >= ADMIN && $value1["user_rank"] >= ADMIN ){ ?> class="admin"<?php }elseif( $value1["post_rank"] == MODERATOR && $value1["user_rank"] >= MODERATOR ){ ?> class="moderator"<?php } ?>><?php echo $value1["post_username"];?></strong></a></span>
					<span class="userip hidden-xs"><?php if( $user["user_rank"] >= ADMIN ){ ?>IP : <?php echo $value1["post_ip"];?><?php } ?></span>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 post_date">
					<a href="<?php echo $current_url;?>#post_<?php echo $value1["post_id"];?>"><?php echo date_formatted( $value1["post_time"] );?> #<?php echo $value1["post_id"];?></a>
					<?php if( $moderator ){ ?>
					<?php if( $topic["topic_invisible"] == 1 || $value1["post_invisible"] == 1 ){ ?>
					<?php if( $topic["topic_invisible"] == 1 && $topic["topic_postid"] == $value1["post_id"] ){ ?>
					<?php if( $user["user_rank"] >= $topic["forum_auth_restore_topic"] ){ ?><a class="bt-forum" title="<?php echo $lang_topic["restore_topic"];?>" href="http://forum.prog/mod.php?forum=<?php echo $topic["topic_forumid"];?>&amp;topic=<?php echo $topic["topic_id"];?>&amp;action=restore-topic&amp;token=<?php echo $token;?>"><img src="http://forum.prog/styles/base/images/forum/bt_visible.gif" alt="<?php echo $lang_topic["restore"];?>" /></a><?php } ?>
					<?php }else{ ?>
					<?php if( $user["user_rank"] >= $topic["forum_auth_restore_post"] ){ ?><a class="bt-topic" title="<?php echo $lang_topic["restore_message"];?>" href="http://forum.prog/mod.php?forum=<?php echo $topic["topic_forumid"];?>&amp;topic=<?php echo $topic["topic_id"];?>&amp;post=<?php echo $value1["post_id"];?>&amp;action=restore-post&amp;token=<?php echo $token;?>"><img src="http://forum.prog/styles/base/images/forum/bt_visible.gif" alt="<?php echo $lang_topic["restore"];?>" /></a><?php } ?>
					<?php } ?>
					<?php }else{ ?>
					<span class="hidden-xs">
					<?php if( $topic["topic_postid"] == $value1["post_id"] ){ ?>
					<?php if( $user["user_rank"] >= $topic["forum_auth_delete_topic"] ){ ?><a class="bt-forum" title="<?php echo $lang_topic["delete_topic"];?>" href="http://forum.prog/mod.php?forum=<?php echo $topic["topic_forumid"];?>&amp;topic=<?php echo $topic["topic_id"];?>&amp;action=delete-topic&amp;token=<?php echo $token;?>"><img src="http://forum.prog/styles/base/images/forum/bt_delete.gif" alt="<?php echo $lang_topic["delete"];?>" /></a><?php } ?>
					<?php }else{ ?>
					<?php if( $user["user_rank"] >= $topic["forum_auth_delete_post"] ){ ?><a class="bt-topic" title="<?php echo $lang_topic["delete_message"];?>" href="http://forum.prog/mod.php?forum=<?php echo $topic["topic_forumid"];?>&amp;topic=<?php echo $topic["topic_id"];?>&amp;post=<?php echo $value1["post_id"];?>&amp;action=delete-post&amp;token=<?php echo $token;?>"><img src="http://forum.prog/styles/base/images/forum/bt_delete.gif" alt="<?php echo $lang_topic["delete"];?>" /></a><?php } ?>
					<?php } ?>
					<?php if( $user["user_rank"] >= $topic["forum_auth_ban"] ){ ?>
					<a class="bt-forum" title="<?php echo $lang_topic["ban_user"];?>" href="http://forum.prog/mod.php?forum=<?php echo $topic["topic_forumid"];?>&amp;topic=<?php echo $topic["topic_id"];?>&amp;userid=<?php echo $value1["post_userid"];?>&amp;action=ban-user&amp;token=<?php echo $token;?>"><img src="http://forum.prog/styles/base/images/forum/bt_bann_defi.gif" alt="<?php echo $lang_topic["ban_user"];?>" /></a>
					<a class="bt-forum" title="<?php echo $lang_topic["ban_user_temporarily"];?>" href="http://forum.prog/mod.php?forum=<?php echo $topic["topic_forumid"];?>&amp;topic=<?php echo $topic["topic_id"];?>&amp;userid=<?php echo $value1["post_userid"];?>&amp;action=ban-user-tempo&amp;token=<?php echo $token;?>"><img src="http://forum.prog/styles/base/images/forum/bt_bann_tempo.gif" alt="<?php echo $lang_topic["ban_user_temporarily"];?>" /></a>
					<?php } ?>
					</span>
					<?php } ?>
					<?php } ?>
					<?php if( $user["user_rank"] >= USER ){ ?>
					<?php if( $user["user_rank"] >= $topic["forum_auth_edit"] && ($value1["post_userid"] == $user["user_id"] || $user["user_rank"] >= ADMIN) ){ ?><a data-toggle="tooltip" class="bt-edit-post" title="<?php echo $lang_topic["modify_message"];?>" href="http://forum.prog/posting?mode=edit&amp;forum=<?php echo $topic["topic_forumid"];?>&amp;topic=<?php echo $topic["topic_id"];?>&amp;id=<?php echo $value1["post_id"];?>&amp;token=<?php echo $edit_token;?>"><img src="http://forum.prog/styles/base/images/forum/bt_modify.gif" alt="<?php echo $lang_topic["modify"];?>" /></a><?php } ?>
					<?php if( $user["user_rank"] >= $topic["forum_auth_alert"] ){ ?><a data-toggle="tooltip" class="bt-alert-post" title="<?php echo $lang_topic["alert_admin"];?>" href="http://forum.prog/alert?postid=<?php echo $value1["post_id"];?>"><img src="http://forum.prog/styles/base/images/forum/bt_alert.gif" alt="<?php echo $lang_topic["alert"];?>" /></a><?php } ?>
					<?php } ?>
					</div>
				</div>
				<div class="post_body"><?php echo $value1["post_text_parsed"];?></div>
				<div class="post_footer">
					<?php if( $value1["post_time_edit"]>0 ){ ?><div class="post_edit"><?php echo $lang_topic["last_modification"];?> <?php echo date_formatted( $value1["post_time_edit"] );?></div><?php } ?>
				</div>
			</div>
			<?php } ?>
			<?php if( $moderator ){ ?>
			</form>
			<?php } ?>
			<?php if( $user["user_rank"] >= $topic["forum_auth_edit"] ){ ?><input type="hidden" name="get_post_token" value="<?php echo $get_post_token;?>" /><?php } ?>
			<div id="dialog-confirm" title="<?php echo $lang_topic["alert"];?>"></div>
			<script>
			var text_enlarge_image = '<?php echo escape_quotes( $lang_topic["click_to_enlarge"] );?>';
			var text_action_confirmation = '<?php echo escape_quotes( $lang_topic["confirm_action"] );?>';
			var text_select_element = '<?php echo escape_quotes( $lang_topic["select_element"] );?>';
			var text_select_action = '<?php echo escape_quotes( $lang_topic["select_action"] );?>';
			var text_cancel = '<?php echo escape_quotes( $lang_topic["cancel"] );?>';
			var text_modify = '<?php echo escape_quotes( $lang_topic["modify"] );?>';
			var text_spoiler_show = '<?php echo escape_quotes( $lang_topic["show"] );?>';
			var text_spoiler_hide = '<?php echo escape_quotes( $lang_topic["hide"] );?>';
			</script>
			<?php }else{ ?>
			<div class="alert alert-warning text-center"><?php echo $lang_topic["no_post"];?></div>
			<?php } ?>
			
			<div class="row forum-buttons">
			<div class="hidden-xs col-sm-8 col-md-8 col-lg-8">
			<?php if( $topic["topic_invisible"] == 0 ){ ?>
			<?php if( $moderator ){ ?>
			<?php if( $user["user_rank"] >= $topic["forum_auth_lock_topic"] ){ ?>
			<?php if( $topic["topic_lock"] == 0 ){ ?>
			<a class="bt-forum btn btn-danger btn-sm" href="http://forum.prog/mod.php?forum=<?php echo $topic["topic_forumid"];?>&amp;topic=<?php echo $topic["topic_id"];?>&amp;action=lock-topic&amp;token=<?php echo $token;?>"><b><?php echo mb_strtoupper( $lang_topic["lock"] );?></b></a>
			<?php }else{ ?>
			<a class="bt-forum btn btn-danger btn-sm" href="http://forum.prog/mod.php?forum=<?php echo $topic["topic_forumid"];?>&amp;topic=<?php echo $topic["topic_id"];?>&amp;action=unlock-topic&amp;token=<?php echo $token;?>"><b><?php echo mb_strtoupper( $lang_topic["unlock"] );?></b></a>
			<?php } ?>
			<?php } ?>
			<?php if( $user["user_rank"] >= $topic["forum_auth_stick_topic"] ){ ?>
			<?php if( $topic["topic_sticky"] == 0 ){ ?>
			<a class="bt-forum btn btn-success btn-sm" href="http://forum.prog/mod.php?forum=<?php echo $topic["topic_forumid"];?>&amp;topic=<?php echo $topic["topic_id"];?>&amp;action=stick-topic&amp;token=<?php echo $token;?>"><b><?php echo mb_strtoupper( $lang_topic["stick"] );?></b></a>
			<?php }else{ ?>
			<a class="bt-forum btn btn-success btn-sm" href="http://forum.prog/mod.php?forum=<?php echo $topic["topic_forumid"];?>&amp;topic=<?php echo $topic["topic_id"];?>&amp;action=unstick-topic&amp;token=<?php echo $token;?>"><b><?php echo mb_strtoupper( $lang_topic["unstick"] );?></b></a>
			<?php } ?>
			<?php } ?>
			<?php } ?>
			<a class="bt-forum-subscribe btn btn-primary btn-sm" href="http://forum.prog/viewtopic.php?id=<?php echo $topic["topic_id"];?>&amp;subscribe=1&amp;token=<?php echo $subscribe_token;?>"><b><?php echo mb_strtoupper( $lang_topic["alert"] );?></b></a>
			<?php } ?>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-right">
			<a class="btn btn-black btn-sm bt-refresh" href="<?php echo $current_url;?>"><b><?php echo mb_strtoupper( $lang_topic["refresh"] );?></b></a>
			</div>
			</div>
			
			<div class="forum-separator"></div>
			<div class="row">
			  <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3"><?php if( $user["user_rank"] >= $topic["forum_auth_topic"] ){ ?><a class="btn btn-black btn-sm" href="http://forum.prog/forum/<?php echo $topic["forum_slug"];?>/<?php echo $topic["topic_forumid"];?>/1#form_post"><b><?php echo mb_strtoupper( $lang_topic["new_topic"] );?></b></a><?php } ?></div>
			  <div class="col-xs-6 col-sm-3 col-sm-push-6 col-md-3 col-md-push-6 col-lg-3 col-lg-push-6 text-right"><a class="btn btn-black btn-sm" href="http://forum.prog/forum/<?php echo $topic["forum_slug"];?>/<?php echo $topic["topic_forumid"];?>/1"><b><?php echo mb_strtoupper( $lang_topic["list_topics"] );?></b></a></div>
			  <div class="col-xs-12 hidden-sm hidden-md hidden-lg">
			    <div class="forum-separator"></div>
			  </div>
			  <div class="col-xs-12 col-sm-6 col-sm-pull-3 col-md-6 col-md-pull-3 col-lg-6 col-lg-pull-3 text-center"><?php if( $nb > 0 ){ ?><ul class="forum-pagination"><?php echo $pagination;?></ul><?php } ?></div>
			</div>
			<div class="forum-separator"></div>
			
			<?php if( $topic["topic_invisible"] == 0 && $user["user_rank"] >= $topic["forum_auth_reply"] && ($topic["topic_lock"] == 0 || $moderator == true) ){ ?>
			<div id="message-preview" class="post post1">
			  <div class="post_header"><h4><?php echo $lang_topic["preview"];?></h4></div>
			  <div class="post_body"></div>
			</div>
			<input type="hidden" name="token_preview" value="<?php echo $preview_token;?>" />
			<?php } ?>
			
			<div class="panel panel-default">
			<div class="panel-heading"><b><?php echo $lang_topic["reply_to_subject"];?></b></div>
			<div class="panel-body">
			<?php if( $topic["topic_invisible"] == 0 ){ ?>
			<?php if( $user["user_rank"] >= $topic["forum_auth_reply"] ){ ?>
			<?php if( $topic["topic_lock"] == 0 || $moderator == true ){ ?>
			<form class="form-horizontal" id="form_post" method="post" action="http://forum.prog/posting">
			<div class="form-group">
			<div class="col-sm-12 col-md-12 col-lg-12">
			<label for="message" class="text-danger"><?php echo $lang_topic["message"];?></label>
			<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "bbcode" );?>
			<textarea class="form-control" rows="4" name="message" id="message" placeholder="<?php echo $lang_topic["message_rules"];?>"></textarea>
			</div>
			</div>
			<?php if( $form["captcha"] ){ ?>
			<div class="form-group">
			<div class="col-sm-12 col-md-6 col-lg-4">
			<a class="btn btn-info btn-xs" onclick="document.getElementById('captcha').src=document.getElementById('captcha').src+'?'+Math.random();return false"><?php echo $lang_topic["request_new_code"];?></a>
			</div>
			</div>
			<div class="form-group">
			<div class="col-sm-12 col-md-6 col-lg-4">
			<img src="http://forum.prog/captcha.php" alt="Captcha" id="captcha" />
			</div>
			</div>
			<div class="form-group">
			<div class="col-sm-12 col-md-6 col-lg-4">
			<input type="text" class="form-control" name="captcha" placeholder="<?php echo $lang_topic["copy_code"];?>" autocomplete="off" />
			</div>
			</div>
			<?php } ?>
			<div class="form-group">
			<div class="col-sm-12 col-md-6 col-lg-4">
			<button type="submit" class="btn btn-warning"><?php echo $lang_topic["post"];?></button>
			<button type="button" class="btn btn-primary" id="button-preview"><i class="fa fa-eye"></i> <?php echo $lang_topic["preview"];?></button>
			</div>
			</div>
			<input type="hidden" name="token" value="<?php echo $form["token"];?>" />
			<input type="hidden" name="forum" value="<?php echo $topic["topic_forumid"];?>" />
			<input type="hidden" name="topic" value="<?php echo $topic["topic_id"];?>" />
			<input type="hidden" name="page" value="<?php echo $page;?>" />
			<input type="hidden" name="mode" value="reply" />
			</form>
			<?php }else{ ?>
			<div class="alert alert-warning text-center"><?php echo $lang_topic["subject_locked"];?></div>
			<?php } ?>
			<?php }elseif( $user["user_rank"] == GUEST ){ ?>
			<div class="alert alert-warning text-center"><?php echo $lang_topic["login_required"];?></div>
			<?php }else{ ?>
			<div class="alert alert-warning text-center"><?php echo $lang_topic["not_authorized_reply"];?></div>
			<?php } ?>
			<?php }else{ ?>
			<div class="alert alert-warning text-center"><?php echo $lang_topic["subject_deleted"];?></div>
			<?php } ?>
			</div>
			</div>
			<?php }else{ ?>
			<div class="alert alert-warning text-center"><?php echo $lang_topic["not_authorized_access"];?></div>
			<?php } ?>
		</div>
		
		<div class="col-sm-3 col-sm-pull-9 col-md-3 col-md-pull-6 col-lg-2 col-lg-pull-4">
			<div class="list-group">
			<a class="list-group-item" href="http://forum.prog/index"><?php echo $lang_menu_top["home"];?></a>
			<a class="list-group-item" href="http://forum.prog/forums"><?php echo $lang_topic["all_forums"];?></a>
			<a class="list-group-item" href="http://forum.prog/subscriptions"><?php echo $lang_topic["followed_topics"];?></a>
			<a class="list-group-item" href="http://forum.prog/viewonline"><?php echo $lang_topic["users_connected"];?></a>
			</div>
		</div>
	</div>
</div>
<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "footer" );?>