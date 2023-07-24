<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "header" );?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-push-3 col-md-7 col-md-push-4 col-lg-6 col-lg-push-4">
			<ol class="breadcrumb">
			  <li><a href="http://forum.prog/adm/index.php"><?php echo $lang_menu_top["admin_cp"];?></a></li>
			  <li><a href="http://forum.prog/adm/alerts.php"><?php echo $lang_viewalert["manage_alerts"];?></a></li>
			  <li class="active"><?php echo $lang_viewalert["view_alert"];?></li>
			</ol>
			<div class="panel panel-default">
			<div class="panel-body">
			<?php if( isset($data["alert_id"]) ){ ?>
			<p class="text-muted"><?php echo $lang_viewalert["page_description"];?></p>
			<?php if( $data["alert_closed"] == 0 ){ ?><p class="text-muted"><?php echo $lang_viewalert["actions_description"];?></p><?php } ?>
			<?php if( !empty($form["error"]) ){ ?>
			<div class="alert alert-danger">
			<?php echo $lang_viewalert["errors_occurred"];?>:
			<ul><?php $counter1=-1; if( isset($form["error"]) && is_array($form["error"]) && sizeof($form["error"]) ) foreach( $form["error"] as $key1 => $value1 ){ $counter1++; ?><li><?php echo $value1;?></li><?php } ?></ul>
			</div>
			<?php }elseif( !empty($form["ok"]) ){ ?>
			<div class="alert alert-success"><?php echo $form["ok"];?></div>
			<?php } ?>
			<h3><?php echo $lang_viewalert["alert_informations"];?></h3>
			<table class="table table-bordered">
			<tr>
			<td class="text-right" style="background-color:#ecf6ff;width:50%;"><?php echo $lang_viewalert["alert_forum"];?></td>
			<td style="background-color:#f1f1f1;width:50%;"><?php echo display( $data["forum_name"] );?></td>
			</tr>
			<tr>
			<td class="text-right" style="background-color:#ecf6ff;width:50%;"><?php echo $lang_viewalert["alert_subject"];?></td>
			<td style="background-color:#f1f1f1;width:50%;"><?php echo display( $data["topic_name"] );?></td>
			</tr>
			<tr>
			<td class="text-right" style="background-color:#ecf6ff;width:50%;"><?php echo $lang_viewalert["alert_reason"];?></td>
			<td class="text-danger" style="background-color:#f1f1f1;width:50%;"><?php echo display( $data["alert_reason"] );?></td>
			</tr>
			<tr>
			<td class="text-right" style="background-color:#ecf6ff;width:50%;"><?php echo $lang_viewalert["alert_author"];?></td>
			<td style="background-color:#f1f1f1;width:50%;"><?php echo $data["user_name"];?></td>
			</tr>
			<tr>
			<td class="text-right" style="background-color:#ecf6ff;width:50%;"><?php echo $lang_viewalert["alert_date"];?></td>
			<td style="background-color:#f1f1f1;width:50%;"><?php echo date_formatted( $data["alert_time"] );?></td>
			</tr>
			<tr>
			<td class="text-right" style="background-color:#ecf6ff;width:50%;"><?php echo $lang_viewalert["alert_author_ip"];?></td>
			<td style="background-color:#f1f1f1;width:50%;"><?php echo $data["alert_ip"];?></td>
			</tr>
			<tr>
			<td class="text-right" style="background-color:#ecf6ff;width:50%;"><?php echo $lang_viewalert["alert_author_id"];?></td>
			<td style="background-color:#f1f1f1;width:50%;"><?php echo $data["alert_userid"];?></td>
			</tr>
			<tr>
			<td class="text-right" style="background-color:#ecf6ff;width:50%;"><?php echo $lang_viewalert["forum_id"];?></td>
			<td style="background-color:#f1f1f1;width:50%;"><?php echo $data["alert_forumid"];?></td>
			</tr>
			<tr>
			<td class="text-right" style="background-color:#ecf6ff;width:50%;"><?php echo $lang_viewalert["subject_id"];?></td>
			<td style="background-color:#f1f1f1;width:50%;"><?php echo $data["alert_topicid"];?></td>
			</tr>
			<tr>
			<td class="text-right" style="background-color:#ecf6ff;width:50%;"><?php echo $lang_viewalert["message_id"];?></td>
			<td style="background-color:#f1f1f1;width:50%;"><?php echo $data["alert_postid"];?></td>
			</tr>
			<tr>
			<td class="text-right" style="background-color:#ecf6ff;width:50%;"><?php echo $lang_viewalert["poster_id"];?></td>
			<td style="background-color:#f1f1f1;width:50%;"><?php echo $data["post_userid"];?></td>
			</tr>
			</table>
			
			<h3><?php echo $lang_viewalert["alert_message"];?></h3>
			<p><a href="" id="post-toggle"><?php echo $lang_viewalert["hide_message"];?></a></p>
			<div id="post" class="post post1" style="max-height:400px;overflow:auto;">
			<div class="post_header">
			<div class="post_user">
			<?php if( !empty($data["user_avatar"]) ){ ?><a href="http://forum.prog/gallery/avatars/<?php echo display( $data["user_avatar"] );?>" class="image-upload"><img src="http://forum.prog/gallery/avatars/thumbnails/<?php echo display( $data["user_avatar"] );?>" class="avatar" /></a><?php }else{ ?><img src="http://forum.prog/gallery/avatars/default.png" class="avatar" /><?php } ?>
			<span class="username"><a href="http://forum.prog/adm/user-edit.php?id=<?php echo intval( $data["post_userid"] );?>"><strong<?php if( $data["post_rank"] >= MODERATOR ){ ?> class="moderator"<?php } ?>><?php echo $data["post_username"];?></strong></a> IP : <a href="https://whois.domaintools.com/<?php echo $data["post_ip"];?>" title="<?php echo $lang_viewalert["show_ipadress_whois"];?>" target="_blank"><?php echo $data["post_ip"];?></a></span>
			</div>
			<div class="post_date"><?php echo date_formatted( $data["post_time"] );?> #<?php echo $data["alert_postid"];?></div>
			</div>
			<div class="post_body"><?php echo smileys(bbcode($data["alert_text"])); ?></div>
			<div class="post_footer">
			<?php if( $data["post_time_edit"]>0 ){ ?><div class="post_edit">Dernière modification le <?php echo date_formatted( $data["post_time_edit"] );?></div><?php } ?>
			</div>
			</div>
			
			<?php if( $data["alert_closed"] == 0 ){ ?>
			<h3>Actions</h3>
			<form class="form-inline" method="post" action="http://forum.prog/adm/viewalert.php?id=<?php echo $data["alert_id"];?>">
			  <div class="form-group">
				<label for="new_reason"><?php echo $lang_viewalert["modify_alert_reason"];?>:</label>
				<select class="form-control input-sm" name="new_reason" id="new_reason">
				  <option value=""></option>
				  <?php $counter1=-1; if( isset($form["reasons"]) && is_array($form["reasons"]) && sizeof($form["reasons"]) ) foreach( $form["reasons"] as $key1 => $value1 ){ $counter1++; ?>
				  <option value="<?php echo $key1;?>"><?php echo $value1;?></option>
				  <?php } ?>
				</select>
				<button class="btn btn-sm btn-primary" type="submit"><?php echo $lang_viewalert["validate"];?></button>
				<p class="help-block"><?php echo $lang_viewalert["modify_reason_description"];?></p>
			  </div>
			  <input type="hidden" name="token" value="<?php echo $form["token"];?>" />
			</form>
			<p class="text-center">
			<a href="http://forum.prog/viewtopic.php?id=<?php echo $data["alert_topicid"];?>&amp;page=<?php echo $data["alert_page"];?>&amp;alert=<?php echo $data["alert_postid"];?>#alert" target="_blank" class="btn btn-default btn-sm"><?php echo $lang_viewalert["view_message"];?></a>
			<a href="http://forum.prog/adm/viewalert.php?id=<?php echo $data["alert_id"];?>&amp;action=close&amp;token=<?php echo $token;?>" class="alert-action btn btn-success btn-sm"><?php echo $lang_viewalert["do_nothing"];?></a>
			<a href="http://forum.prog/adm/viewalert.php?id=<?php echo $data["alert_id"];?>&amp;action=delete&amp;token=<?php echo $token;?>" class="alert-action btn btn-primary btn-sm"><?php echo $lang_viewalert["delete_message"];?></a>
			<a href="http://forum.prog/adm/viewalert.php?id=<?php echo $data["alert_id"];?>&amp;action=ban-tempo&amp;token=<?php echo $token;?>" class="alert-action btn btn-warning btn-sm"><?php echo $lang_viewalert["ban_temporarily"];?></a>
			<a href="http://forum.prog/adm/viewalert.php?id=<?php echo $data["alert_id"];?>&amp;action=ban&amp;token=<?php echo $token;?>" class="alert-action btn btn-danger btn-sm"><?php echo $lang_viewalert["ban_definitely"];?></a>
			</p>
			<div id="dialog-confirm" title="<?php echo $lang_viewalert["alert"];?>"></div>
			<?php }else{ ?>
			<div class="alert alert-danger text-center"><?php echo $lang_viewalert["alert_treated"];?></div>
			<?php } ?>
			<script>
			var text_enlarge_image = '<?php echo escape_quotes( $lang_viewalert["click_to_enlarge"] );?>';
			var text_action_confirmation = '<?php echo escape_quotes( $lang_viewalert["confirm_action"] );?>';
			var text_cancel = '<?php echo escape_quotes( $lang_viewalert["cancel"] );?>';
			var text_show = '<?php echo escape_quotes( $lang_viewalert["show_message"] );?>';
			var text_hide = '<?php echo escape_quotes( $lang_viewalert["hide_message"] );?>';
			var text_spoiler_show = '<?php echo escape_quotes( $lang_viewalert["show"] );?>';
			var text_spoiler_hide = '<?php echo escape_quotes( $lang_viewalert["hide"] );?>';
			
			$('#post-toggle').on('click', function(e){
				e.preventDefault();
				if($('#post').css('display') == 'block') {
					$('#post').css('display', 'none');
					$(this).text(text_show);
				}
				else {
					$('#post').css('display', 'block');
					$(this).text(text_hide);
				}
				return false;
			});
			</script>
			<?php }else{ ?>
			<div class="alert alert-danger text-center"><?php echo $lang_viewalert["no_alert"];?> <img src="http://forum.prog/gallery/smilies/1.gif" alt=":)" /></div>
			<?php } ?>
			</div>
			</div>
		</div>
		
		<div class="col-sm-3 col-sm-pull-9 col-md-3 col-md-pull-6 col-lg-2 col-lg-pull-4">
			<div class="list-group">
			<a class="list-group-item active" href="http://forum.prog/adm/alerts.php"><?php echo $lang_menu_top["alerts"];?></a>
			<a class="list-group-item" href="http://forum.prog/adm/alerts.php?mode=closed"><?php echo $lang_viewalert["alerts_treated"];?></a>
			<a class="list-group-item" href="http://forum.prog/adm/banlist.php"><?php echo $lang_viewalert["banlist"];?></a>
			</div>
		</div>
	</div>
</div>
<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "footer" );?>