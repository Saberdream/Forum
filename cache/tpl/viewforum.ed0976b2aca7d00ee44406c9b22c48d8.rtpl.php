<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "header" );?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-push-3 col-md-7 col-md-push-4 col-lg-6 col-lg-push-4">
			<ol class="breadcrumb">
			  <li><a href="http://forum.prog/forums"><span class="glyphicon glyphicon-th-list"></span> <?php echo $lang_forum["forums"];?></a></li>
			  <li class="active"><?php echo display( $forum["cat_name"] );?></li>
			  <?php if( $user["user_rank"] >= $forum["forum_auth_view"] ){ ?><li class="active"><a href="http://forum.prog/forum/<?php echo $forum["forum_slug"];?>/<?php echo $forum["forum_id"];?>/1"><?php echo $lang_forum["forum"];?> <?php echo display( $forum["forum_name"] );?></a></li><?php } ?>
			</ol>
			<?php if( $user["user_rank"] >= $forum["forum_auth_view"] ){ ?>
			<h4 class="text-primary"><?php echo $lang_forum["forum"];?> : <?php echo display( $forum["forum_name"] );?></h4>
			
			<div class="row">
				<div class="hidden-xs col-sm-2 col-md-2 col-lg-2">
					<?php if( !empty($search["keywords"]) ){ ?>
					<a class="btn btn-black btn-sm pull-left" href="http://forum.prog/forum/<?php echo $forum["forum_slug"];?>/<?php echo $forum["forum_id"];?>/1"><b><?php echo mb_strtoupper( $lang_forum["back"] );?></b></a>
					<?php }elseif( $user["user_rank"] >= $forum["forum_auth_topic"] ){ ?>
					<a class="btn btn-black btn-sm pull-left" href="<?php echo $current_url;?>#form_post"><b><?php echo mb_strtoupper( $lang_forum["new"] );?></b></a>
					<?php } ?>
				</div>
				<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 text-center">
					<?php if( $total > 0 ){ ?>
					<form class="form-inline forum-form-search" method="get" action="http://forum.prog/viewforum.php?id=<?php echo $forum["forum_id"];?>">
					<input type="hidden" name="id" value="<?php echo $forum["forum_id"];?>" />
					  <div class="form-group">
						<input type="text" name="search" id="search" value="<?php echo display( $search["keywords"] );?>" class="form-control input-sm" placeholder="<?php echo $lang_forum["search"];?>" />
					  </div>
					  <div class="form-group">
						<select class="form-control input-sm" name="type">
						  <?php $counter1=-1; if( isset($search["types"]) && is_array($search["types"]) && sizeof($search["types"]) ) foreach( $search["types"] as $key1 => $value1 ){ $counter1++; ?>
						  <option value="<?php echo $key1;?>"<?php if( !empty($search["keywords"]) && $search["type"]==$key1 ){ ?> selected<?php } ?>><?php echo $value1;?></option>
						  <?php } ?>
						</select>
					  </div>
					  <div class="form-group">
						<label for="exact"><input type="checkbox" name="exact" id="exact" value="1" <?php if( !empty($search["keywords"]) && $search["exact"] ){ ?>checked <?php } ?>/> <?php echo $lang_forum["exact"];?></label>
					    <button class="btn btn-primary btn-sm" type="submit"><span class="glyphicon glyphicon-search"></span></button>
					  </div>
					</form>
					<?php } ?>
				</div>
				<div class="hidden-xs col-sm-2 col-md-2 col-lg-2 text-right">
					<a class="btn btn-black btn-sm pull-right" href="<?php echo $current_url;?>"><b><?php echo mb_strtoupper( $lang_forum["refresh"] );?></b></a>
				</div>
			</div>
			<div class="forum-separator"></div>
			
			<?php if( $nb > 0 ){ ?>
			<?php if( !empty($search["keywords"]) ){ ?>
			<p class="text-center"><?php echo $lang_forum["search_nb_results"];?></p>
			<?php } ?>
			<div class="text-center"><ul class="forum-pagination"><?php echo $pagination;?></ul></div>
			<?php if( $moderator ){ ?>
			<form method="post" class="moder-form" action="http://forum.prog/mod.php?forum=<?php echo $forum["forum_id"];?>&amp;token=<?php echo $token;?>">
			<div class="navbar-fixed-bottom text-center" style="display:none;background-color:#eee;opacity:0.9;padding:10px;">
			<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<div class="form-inline">
				<div class="form-group">
					<select class="form-control input-sm" name="action">
					<option value=""><?php echo $lang_forum["action"];?></option>
					<?php if( $user["user_rank"] >= $forum["forum_auth_delete_topic"] ){ ?><option value="delete"><?php echo $lang_forum["delete"];?></option><?php } ?>
					<?php if( $user["user_rank"] >= $forum["forum_auth_lock_topic"] ){ ?><option value="lock"><?php echo $lang_forum["lock"];?></option>
					<option value="unlock"><?php echo $lang_forum["unlock"];?></option><?php } ?>
					<?php if( $user["user_rank"] >= $forum["forum_auth_stick_topic"] ){ ?><option value="stick"><?php echo $lang_forum["stick"];?></option>
					<option value="unstick"><?php echo $lang_forum["unstick"];?></option><?php } ?>
					<?php if( $user["user_rank"] >= $forum["forum_auth_restore_topic"] ){ ?><option value="restore"><?php echo $lang_forum["restore"];?></option><?php } ?>
					<?php if( $user["user_rank"] >= $forum["forum_auth_ban"] ){ ?><option value="ban"><?php echo $lang_forum["ban"];?></option><?php } ?>
					</select>
				</div>
				<div class="form-group">
					<button class="action-submit btn btn-sm btn-primary"><?php echo $lang_forum["validate"];?></button>
				</div>
			</div>
			</div>
			<?php } ?>
			<table class="list-topics table text-center">
			<tr>
			<?php if( $moderator ){ ?><th class="check"><input type="checkbox" id="selectall" /></th><?php } ?>
			<?php if( $moderator && ($user["user_rank"] >= $forum["forum_auth_delete_topic"] || $user["user_rank"] >= $forum["forum_auth_restore_topic"]) ){ ?><th class="bt hidden-xs">&nbsp;</th><?php } ?>
			<th><?php echo $lang_forum["subject"];?></th>
			<?php if( $moderator && $user["user_rank"] >= $forum["forum_auth_ban"] ){ ?><th class="bt hidden-xs">&nbsp;</th><?php } ?>
			<th class="author hidden-xs"><?php echo $lang_forum["author"];?></th>
			<th class="nb hidden-xs"><?php echo $lang_forum["number"];?></th>
			<th class="last hidden-xs"><?php echo $lang_forum["last"];?></th>
			</tr>
			<?php $counter1=-1; if( isset($rows) && is_array($rows) && sizeof($rows) ) foreach( $rows as $key1 => $value1 ){ $counter1++; ?>
			<tr<?php if( $value1["topic_invisible"] == 1 ){ ?> class="topic_invisible"<?php } ?>>
			<?php if( $moderator ){ ?><td><input class="checkbox-item" type="checkbox" name="topic[]" value="<?php echo $value1["topic_id"];?>" /></td><?php } ?>
			<?php if( $moderator && ($user["user_rank"] >= $forum["forum_auth_delete_topic"] || $user["user_rank"] >= $forum["forum_auth_restore_topic"]) ){ ?><td class="hidden-xs"><?php if( $value1["topic_invisible"] == 0 && $user["user_rank"] >= $forum["forum_auth_delete_topic"] ){ ?><a class="bt-forum" href="http://forum.prog/mod.php?forum=<?php echo $forum["forum_id"];?>&amp;topic=<?php echo $value1["topic_id"];?>&amp;action=delete-topic&amp;token=<?php echo $token;?>" title="<?php echo $lang_forum["delete_topic"];?>"><img src="http://forum.prog/styles/base/images/forum/bt_delete.gif" alt="<?php echo $lang_forum["delete"];?>" /></a><?php }elseif( $user["user_rank"] >= $forum["forum_auth_restore_topic"] ){ ?><a class="bt-forum" href="http://forum.prog/mod.php?forum=<?php echo $forum["forum_id"];?>&amp;topic=<?php echo $value1["topic_id"];?>&amp;action=restore-topic&amp;token=<?php echo $token;?>" title="<?php echo $lang_forum["restore_topic"];?>"><img src="http://forum.prog/styles/base/images/forum/bt_visible.gif" alt="<?php echo $lang_forum["restore"];?>" /></a><?php } ?></td><?php } ?>
			<td class="topic-name text-left <?php if( $value1["topic_invisible"] == 1 ){ ?>topic_invisible<?php }else{ ?><?php if( $value1["topic_sticky"] == 1 ){ ?><?php if( $value1["topic_lock"] == 1 ){ ?>topic_sticky_lock<?php }else{ ?>topic_sticky<?php } ?><?php }else{ ?><?php if( $value1["topic_lock"] == 1 ){ ?>topic_lock<?php }else{ ?><?php if( $value1["topic_posts"] >= 20 ){ ?>topic2<?php }else{ ?>topic1<?php } ?><?php } ?><?php } ?><?php } ?>"><a href="http://forum.prog/topic/<?php echo $value1["topic_slug"];?>/<?php echo $value1["topic_id"];?>/1"><?php echo display( $value1["topic_name"] );?></a></td>
			<?php if( $moderator && $user["user_rank"] >= $forum["forum_auth_ban"] ){ ?><td class="hidden-xs"><a class="bt-forum" href="http://forum.prog/mod.php?forum=<?php echo $forum["forum_id"];?>&amp;topic=<?php echo $value1["topic_id"];?>&amp;userid=<?php echo $value1["topic_userid"];?>&amp;action=ban-user&amp;token=<?php echo $token;?>" title="<?php echo $lang_forum["ban_user"];?>"><img src="http://forum.prog/styles/base/images/forum/bt_bann_defi.gif" alt="<?php echo $lang_forum["ban"];?>" /></a></td><?php } ?>
			<td class="small hidden-xs"><?php if( $value1["topic_rank"] >= ADMIN && $value1["user_rank"] >= ADMIN ){ ?><span class="admin"><?php echo display( $value1["topic_username"] );?></span><?php }elseif( $value1["topic_rank"] == MODERATOR && $value1["user_rank"] >= MODERATOR ){ ?><span class="moderator"><?php echo display( $value1["topic_username"] );?></span><?php }else{ ?><?php echo display( $value1["topic_username"] );?><?php } ?></td>
			<td class="small hidden-xs"><?php echo $value1["topic_posts_visible"]-1;?></td>
			<td class="small hidden-xs"><a href="http://forum.prog/topic/<?php echo $value1["topic_slug"];?>/<?php echo $value1["topic_id"];?>/<?php if( $moderator && $user["user_rank"]>=$forum["forum_auth_restore_post"] ){ ?><?php if( $value1["topic_posts"]>$posts_per_page ){ ?><?php echo ceil($value1["topic_posts"]/$posts_per_page); ?><?php }else{ ?>1<?php } ?><?php }else{ ?><?php if( $value1["topic_posts_visible"]>$posts_per_page ){ ?><?php echo ceil($value1["topic_posts_visible"]/$posts_per_page); ?><?php }else{ ?>1<?php } ?><?php } ?>" data-toggle="tooltip" data-placement="right" title="Accéder à la dernière page"><?php echo date('d/m/Y H:i', $value1["topic_last"]); ?></a></td>
			</tr>
			<?php } ?>
			</table>
			<?php if( $moderator ){ ?>
			</form>
			<?php } ?>
			<div id="dialog-confirm" title="<?php echo $lang_forum["alert"];?>"></div>
			<script>
			var text_enlarge_image = '<?php echo escape_quotes( $lang_forum["click_to_enlarge"] );?>';
			var text_action_confirmation = '<?php echo escape_quotes( $lang_forum["confirm_action"] );?>';
			var text_select_element = '<?php echo escape_quotes( $lang_forum["select_element"] );?>';
			var text_select_action = '<?php echo escape_quotes( $lang_forum["select_action"] );?>';
			var text_cancel = '<?php echo escape_quotes( $lang_forum["cancel"] );?>';
			var text_spoiler_show = '<?php echo escape_quotes( $lang_forum["show"] );?>';
			var text_spoiler_hide = '<?php echo escape_quotes( $lang_forum["hide"] );?>';
			</script>
			<div class="text-center"><ul class="forum-pagination"><?php echo $pagination;?></ul></div>
			<div class="forum-separator"></div>
			<?php }elseif( !empty($search["keywords"]) ){ ?>
			<div class="alert alert-warning text-center"><?php echo $lang_forum["search_no_results"];?></div>
			<?php }else{ ?>
			<div class="alert alert-warning text-center"><?php echo $lang_forum["no_topic"];?></div>
			<?php } ?>

			<?php if( $user["user_rank"] >= $forum["forum_auth_topic"] ){ ?>
			<div id="message-preview" class="post post1">
			  <div class="post_header"><h4><?php echo $lang_forum["preview"];?></h4></div>
			  <div class="post_body"></div>
			</div>
			<input type="hidden" name="token_preview" value="<?php echo $preview_token;?>" />
			<?php } ?>

			<div class="panel panel-default">
			<div class="panel-heading"><b><?php echo $lang_forum["create_new_topic"];?></b></div>
			<div class="panel-body">
			<?php if( $user["user_rank"] >= $forum["forum_auth_topic"] ){ ?>
			<form class="form-horizontal" id="form_post" method="post" action="http://forum.prog/posting">
			<div class="form-group">
			<div class="col-sm-12 col-md-12 col-lg-12">
			<label for="subject" class="sr-only"><?php echo $lang_forum["subject"];?></label>
			<input class="form-control" type="text" name="subject" id="subject" placeholder="<?php echo $lang_forum["type_subject"];?>" />
			</div>
			</div>
			<div class="form-group">
			<div class="col-sm-12 col-md-12 col-lg-12">
			<label for="message" class="text-danger"><?php echo $lang_forum["message"];?></label>
			<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "bbcode" );?>
			<textarea class="form-control" rows="4" name="message" id="message" placeholder="<?php echo $lang_forum["message_rules"];?>"></textarea>
			</div>
			</div>
			<?php if( $form["captcha"] ){ ?>
			<div class="form-group">
			<div class="col-sm-12 col-md-6 col-lg-4">
			<a class="btn btn-info btn-xs" onclick="document.getElementById('captcha').src=document.getElementById('captcha').src+'?'+Math.random(); return false"><?php echo $lang_forum["request_new_code"];?></a>
			</div>
			</div>
			<div class="form-group">
			<div class="col-sm-12 col-md-6 col-lg-4">
			<img src="http://forum.prog/captcha.php" alt="Captcha" id="captcha" />
			</div>
			</div>
			<div class="form-group">
			<div class="col-sm-12 col-md-6 col-lg-4">
			<input type="text" class="form-control" name="captcha" placeholder="<?php echo $lang_forum["copy_code"];?>" autocomplete="off" />
			</div>
			</div>
			<?php } ?>
			<div class="form-group">
			<div class="col-sm-12 col-md-6 col-lg-4">
			<button type="submit" class="btn btn-warning"><?php echo $lang_forum["post"];?></button>
			<button type="button" class="btn btn-primary" id="button-preview"><i class="fa fa-eye"></i> <?php echo $lang_forum["preview"];?></button>
			</div>
			</div>
			<input type="hidden" name="token" value="<?php echo $form["token"];?>" />
			<input type="hidden" name="forum" value="<?php echo $forum["forum_id"];?>" />
			<input type="hidden" name="mode" value="new" />
			</form>
			<?php }elseif( $user["user_rank"] == GUEST ){ ?>
			<div class="alert alert-warning text-center"><?php echo $lang_forum["login_required"];?></div>
			<?php }else{ ?>
			<div class="alert alert-warning text-center"><?php echo $lang_forum["not_authorized_new_topic"];?></div>
			<?php } ?>
			</div>
			</div>
			<?php }else{ ?>
			<div class="alert alert-warning text-center"><?php echo $lang_forum["not_authorized_access"];?></div>
			<?php } ?>
		</div>
		
		<div class="col-sm-3 col-sm-pull-9 col-md-3 col-md-pull-6 col-lg-2 col-lg-pull-4">
			<div class="list-group">
			<a class="list-group-item" href="http://forum.prog/index"><?php echo $lang_menu_top["home"];?></a>
			<a class="list-group-item" href="http://forum.prog/forums"><?php echo $lang_forum["all_forums"];?></a>
			<a class="list-group-item" href="http://forum.prog/subscriptions"><?php echo $lang_forum["followed_topics"];?></a>
			<a class="list-group-item" href="http://forum.prog/viewonline"><?php echo $lang_forum["users_connected"];?></a>
			</div>
		</div>
	</div>
</div>
<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "footer" );?>