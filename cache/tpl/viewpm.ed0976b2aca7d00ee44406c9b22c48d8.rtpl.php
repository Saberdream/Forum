<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "header" );?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-push-3 col-md-7 col-md-push-4 col-lg-6 col-lg-push-4">
			<ol class="breadcrumb">
			  <li><a href="http://forum.prog/pm"><?php echo $lang_menu_top["private_messages"];?></a></li>
			  <li class="active"><?php echo display( $lang_viewpm["read_message"] );?></li>
			</ol>
			<?php if( $user["user_rank"] >= USER && $in_pm ){ ?>
			<h4 class="forum-topic-title"><?php echo $lang_viewpm["subject"];?> : <span class="text-primary"><?php echo display( $pm["pm_name"] );?></span></h4>
			
			<div class="row">
			  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				  <div class="panel panel-default">
				  <div class="panel-body pm-participants">
				  <p><?php echo $lang_viewpm["message_author"];?>: <strong><?php echo display( $pm["user_name"] );?></strong></p>
				  <p><?php echo $lang_viewpm["participants_list"];?>: <?php $counter1=-1; if( isset($participants) && is_array($participants) && sizeof($participants) ) foreach( $participants as $key1 => $value1 ){ $counter1++; ?><span class="btn btn-default btn-xs"><span class="username"><?php echo display( $value1 );?></span><?php if( $pm["pm_closed"] == 0 && $pm["pm_userid"] == $user["user_id"] ){ ?> <button type="button" data-user="<?php echo display( $value1 );?>" class="close btn-exclude" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php } ?></span><?php } ?></p>
				  <?php if( $pm["pm_closed"] == 0 && $pm["pm_userid"] == $user["user_id"] ){ ?>
					<?php if( !empty($form_add["error"]) ){ ?>
					<div class="alert alert-danger">
					<?php echo $lang_viewpm["errors_detected"];?>:
					<ul><?php $counter1=-1; if( isset($form_add["error"]) && is_array($form_add["error"]) && sizeof($form_add["error"]) ) foreach( $form_add["error"] as $key1 => $value1 ){ $counter1++; ?><li><?php echo $value1;?></li><?php } ?></ul>
					</div>
					<?php }elseif( !empty($form_add["ok"]) ){ ?>
					<div class="alert alert-success"><?php echo $form_add["ok"];?></div>
					<?php } ?>
					<form class="form-horizontal" method="post" action="http://forum.prog/viewpm?id=<?php echo $pm["pm_id"];?>&amp;page=<?php echo $page;?>">
					<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<label for="participants"><?php echo $lang_viewpm["add_participants"];?></label>
					<input class="form-control" type="text" name="participants" id="participants" value="<?php echo display( $form_add["participants"] );?>" placeholder="<?php echo $lang_viewpm["participants"];?>" />
					<button type="submit" class="btn btn-warning"><?php echo $lang_viewpm["add"];?></button>
					</div>
					</div>
					<input type="hidden" name="token" value="<?php echo $form_add["token"];?>" />
					</form>
				  <?php } ?>
				  </div>
				  </div>
			  </div>
			</div>
			
			<div class="row">
			  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
			  <?php if( $nb > 0 ){ ?><ul class="forum-pagination"><?php echo $pagination;?></ul><?php } ?>
			  </div>
			</div>
			
			<div class="row forum-buttons">
			<div class="hidden-xs col-sm-7 col-md-7 col-lg-7">
			<?php if( $pm["pm_closed"] == 0 && $pm["pm_userid"] == $user["user_id"] ){ ?><a class="bt-forum btn btn-danger btn-sm" href="http://forum.prog/viewpm?id=<?php echo $pm["pm_id"];?>&amp;action=close&amp;token=<?php echo $token;?>"><b><?php echo mb_strtoupper( $lang_viewpm["close_discussion"] );?></b></a><?php } ?>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5 text-right">
			<?php if( $pm["pm_closed"] == 0 ){ ?><a class="btn btn-warning btn-sm" href="http://forum.prog/viewpm?id=<?php echo $pm["pm_id"];?>&amp;page=<?php echo $page;?>#form_post"><b><?php echo mb_strtoupper( $lang_viewpm["reply"] );?></b></a><?php } ?>
			<a class="btn btn-black btn-sm bt-refresh" href="<?php echo $current_url;?>"><b><?php echo mb_strtoupper( $lang_viewpm["refresh"] );?></b></a>
			</div>
			</div>

			<?php if( $nb > 0 ){ ?>
			<?php $counter1=-1; if( isset($rows) && is_array($rows) && sizeof($rows) ) foreach( $rows as $key1 => $value1 ){ $counter1++; ?>
			<div id="post_<?php echo $value1["post_id"];?>" <?php if( $key1 % 2 == 1 ){ ?>class="post post2"<?php }else{ ?>class="post post1"<?php } ?>>
				<div class="row post_header">
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 post_user">
					<?php if( !empty($value1["user_avatar"]) ){ ?><a class="user_avatar" href="http://forum.prog/gallery/avatars/<?php echo display( $value1["user_avatar"] );?>"><img src="http://forum.prog/gallery/avatars/thumbnails/<?php echo display( $value1["user_avatar"] );?>" alt="<?php echo $lang_viewpm["avatar"];?>" /></a><?php }else{ ?><a class="user_avatar" href="http://forum.prog/gallery/avatars/default.png"><img src="http://forum.prog/gallery/avatars/default.png" alt="<?php echo $lang_viewpm["avatar"];?>" /></a><?php } ?>
					<span class="username"><a class="user-profile" href="http://forum.prog/profil/<?php echo strtolower( $value1["post_username"] );?>"><strong<?php if( $value1["post_rank"] >= ADMIN && $value1["user_rank"] >= ADMIN ){ ?> class="admin"<?php }elseif( $value1["post_rank"] == MODERATOR && $value1["user_rank"] >= MODERATOR ){ ?> class="moderator"<?php } ?>><?php echo $value1["post_username"];?></strong></a></span>
					<span class="userip hidden-xs"><?php if( $user["user_rank"] >= ADMIN ){ ?>IP : <?php echo $value1["post_ip"];?><?php } ?></span>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 post_date">
					<a href="<?php echo $current_url;?>#post_<?php echo $value1["post_id"];?>"><?php echo date_formatted( $value1["post_time"] );?> #<?php echo $value1["post_id"];?></a>
					<span class="hidden-xs">
					<?php if( $pm["pm_closed"] == 0 && $pm["pm_userid"] == $user["user_id"] && $value1["post_userid"] != $user["user_id"] ){ ?><a class="bt-topic" title="<?php echo $lang_viewpm["exclude_user"];?>" href="http://forum.prog/viewpm?id=<?php echo $pm["pm_id"];?>&amp;user=<?php echo strtolower( $value1["post_username"] );?>&amp;action=exclude&amp;token=<?php echo $token;?>"><img src="http://forum.prog/styles/base/images/forum/bt_bann_defi.gif" alt="<?php echo $lang_viewpm["exclude"];?>" /></a><?php } ?>
					</span>
					</div>
				</div>
				<div class="post_body"><?php echo $value1["post_text_parsed"];?></div>
			</div>
			<?php } ?>
			<?php }else{ ?>
			<div class="alert alert-warning text-center"><?php echo $lang_viewpm["no_post"];?></div>
			<?php } ?>

			<div id="dialog-confirm" title="<?php echo $lang_viewpm["alert"];?>"></div>
			<script>
			<?php if( $pm["pm_closed"] == 0 && $pm["pm_userid"] == $user["user_id"] ){ ?>
			$(document).on('click', '.btn-exclude', function(e){
				e.preventDefault();
				var username = $(this).data('user').toLowerCase();
				var url = site_root + 'viewpm?id=<?php echo $pm["pm_id"];?>&user=' + username + '&action=exclude&token=<?php echo $token;?>';
				$('#dialog-confirm').text(text_action_confirmation).dialog({
					buttons: {
						OK: function(){
							$(this).dialog('close');
							$.get(url, function(data){
								$('#dialog-confirm').text(data).dialog({ buttons: [] }).dialog('open');
								setTimeout(function(){$('#dialog-confirm').dialog('close');}, 1500);
							});
						},
						Cancel: {
							text: text_cancel,
							click: function(){
								$(this).dialog('close');
							}
						}
					}
				}).dialog('open');
			});
			$(function(){
				$('#participants').tagit({
				  singleFieldDelimiter: ';',
				  placeholderText: '<?php echo escape_quotes( $lang_viewpm["participants"] );?>'
				});
			});
			<?php } ?>
			var text_enlarge_image = '<?php echo escape_quotes( $lang_viewpm["click_to_enlarge"] );?>';
			var text_action_confirmation = '<?php echo escape_quotes( $lang_viewpm["confirm_action"] );?>';
			var text_cancel = '<?php echo escape_quotes( $lang_viewpm["cancel"] );?>';
			var text_spoiler_show = '<?php echo escape_quotes( $lang_viewpm["show"] );?>';
			var text_spoiler_hide = '<?php echo escape_quotes( $lang_viewpm["hide"] );?>';
			</script>

			<div class="row forum-buttons">
			<div class="hidden-xs col-sm-8 col-md-8 col-lg-8">
			<?php if( $pm["pm_closed"] == 0 && $pm["pm_userid"] == $user["user_id"] ){ ?><a class="bt-forum btn btn-danger btn-sm" href="http://forum.prog/viewpm?id=<?php echo $pm["pm_id"];?>&amp;action=close&amp;token=<?php echo $token;?>"><b><?php echo mb_strtoupper( $lang_viewpm["close_discussion"] );?></b></a><?php } ?>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-right">
			<a class="btn btn-black btn-sm bt-refresh" href="<?php echo $current_url;?>"><b><?php echo mb_strtoupper( $lang_viewpm["refresh"] );?></b></a>
			</div>
			</div>
			
			<div class="row">
			  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
			  <?php if( $nb > 0 ){ ?><ul class="forum-pagination"><?php echo $pagination;?></ul><?php } ?>
			  </div>
			</div>
			
			<?php if( $pm["pm_closed"] == 0 ){ ?>
			<div id="message-preview" class="post post1">
			  <div class="post_header"><h4><?php echo $lang_viewpm["preview"];?></h4></div>
			  <div class="post_body"></div>
			</div>
			<input type="hidden" name="token_preview" value="<?php echo $preview_token;?>" />
			<?php } ?>
			
			<div class="panel panel-default">
			<div class="panel-heading"><b><?php echo $lang_viewpm["reply_to_message"];?></b></div>
			<div class="panel-body">
			<?php if( $pm["pm_closed"] == 0 ){ ?>
			<?php if( !empty($form["error"]) ){ ?>
			<div class="alert alert-danger">
			<?php echo $lang_viewpm["errors_detected"];?>:
			<ul><?php $counter1=-1; if( isset($form["error"]) && is_array($form["error"]) && sizeof($form["error"]) ) foreach( $form["error"] as $key1 => $value1 ){ $counter1++; ?><li><?php echo $value1;?></li><?php } ?></ul>
			</div>
			<?php } ?>
			<form class="form-horizontal" id="form_post" method="post" action="http://forum.prog/viewpm?id=<?php echo $pm["pm_id"];?>#form_post">
			<div class="form-group">
			<div class="col-sm-12 col-md-12 col-lg-12">
			<label for="message" class="text-danger"><?php echo $lang_viewpm["message"];?></label>
			<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "bbcode" );?>
			<textarea class="form-control" rows="4" name="message" id="message" placeholder="<?php echo $lang_viewpm["type_message"];?>"><?php echo display( $form["message"] );?></textarea>
			</div>
			</div>
			<?php if( $form["captcha"] ){ ?>
			<div class="form-group">
			<div class="col-sm-12 col-md-6 col-lg-4">
			<a class="btn btn-info btn-xs" onclick="document.getElementById('captcha').src=document.getElementById('captcha').src+'?'+Math.random();return false"><?php echo $lang_viewpm["request_new_code"];?></a>
			</div>
			</div>
			<div class="form-group">
			<div class="col-sm-12 col-md-6 col-lg-4">
			<img src="http://forum.prog/captcha.php" alt="Captcha" id="captcha" />
			</div>
			</div>
			<div class="form-group">
			<div class="col-sm-12 col-md-6 col-lg-4">
			<input type="text" class="form-control" name="captcha" placeholder="<?php echo $lang_viewpm["copy_code"];?>" autocomplete="off" />
			</div>
			</div>
			<?php } ?>
			<div class="form-group">
			<div class="col-sm-12 col-md-6 col-lg-4">
			<button type="submit" class="btn btn-warning"><?php echo $lang_viewpm["post"];?></button>
			<button type="button" class="btn btn-primary" id="button-preview"><i class="fa fa-eye"></i> <?php echo $lang_viewpm["preview"];?></button>
			</div>
			</div>
			<input type="hidden" name="token" value="<?php echo $form["token"];?>" />
			<input type="hidden" name="topic" value="<?php echo $pm["pm_id"];?>" />
			</form>
			<?php }else{ ?>
			<div class="alert alert-warning text-center"><?php echo $lang_viewpm["pm_closed"];?></div>
			<?php } ?>
			</div>
			</div>
			<?php }else{ ?>
			<div class="alert alert-warning text-center"><?php echo $lang_viewpm["not_authorized_access"];?></div>
			<?php } ?>
		</div>
		
		<div class="col-sm-3 col-sm-pull-9 col-md-3 col-md-pull-6 col-lg-2 col-lg-pull-4">
			<div class="list-group">
			<a class="list-group-item" href="http://forum.prog/newpm"><?php echo $lang_viewpm["new_message"];?></a>
			<a class="list-group-item active" href="http://forum.prog/pm"><?php echo $lang_viewpm["mailbox"];?></a>
			<a class="list-group-item" href="http://forum.prog/blacklist"><?php echo $lang_viewpm["blacklist"];?></a>
			</div>
		</div>
	</div>
</div>
<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "footer" );?>