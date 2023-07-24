<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html lang="<?php echo $site_lang;?>">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php if( !$error_invalid_user && !$error_user_not_exists && $ban == 0 ){ ?>Profil de <?php echo $profile_user["user_name"];?> - <?php } ?><?php echo display( $site_name );?></title>
<meta name="description" content="Prototype de page html contenant un design évolutif et adaptable aux différentes machines." />
<link rel="icon" type="image/png" href="http://forum.prog/favicon.ico" />
<link rel="stylesheet" href="http://forum.prog/styles/base/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="http://forum.prog/styles/base/css/jquery.colorbox.css" type="text/css">
<link rel="stylesheet" href="http://forum.prog/styles/base/css/profile.css" type="text/css">
<script type="text/javascript" src="http://forum.prog/styles/base/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="http://forum.prog/styles/base/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://forum.prog/styles/base/js/jquery.colorbox.min.js"></script>
</head>

<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-4 col-lg-push-4 col-md-8 col-md-push-2 col-sm-12 col-xs-12">
				<?php if( !$error_invalid_user ){ ?>
					<?php if( !$error_user_not_exists ){ ?>
						<?php if( $ban == 0 ){ ?>
						<div class="profile_header text-center"><span<?php if( !empty($profile_user["user_sex"]) ){ ?> class="profile_<?php echo $profile_user["user_sex"];?>"<?php } ?>><?php echo $profile_user["user_name"];?></span></div>
						<div class="profile_panel">
						<div class="row">
							<div class="col-lg-4 col-md-2 col-sm-3 col-xs-4">
							<?php if( !empty($profile_user["user_avatar"]) ){ ?>
							<a class="avatar" href="http://forum.prog/gallery/avatars/<?php echo $profile_user["user_avatar"];?>"><img class="img-rounded" src="http://forum.prog/gallery/avatars/thumbnails/<?php echo $profile_user["user_avatar"];?>" alt="Avatar" /></a>
							<?php }else{ ?>
							<img class="img-rounded" src="http://forum.prog/gallery/avatars/default.png" alt="Avatar" />
							<?php } ?>
							</div>
							
							<div class="col-lg-8 col-md-10 col-sm-9 col-xs-8">
							<table class="table profile_infos">
							<?php if( !empty($profile_user["user_birthday"]) ){ ?>
							<tr>
							<td>Age</td>
							<td><?php echo age($profile_user["user_birthday"]); ?> ans</td>
							</tr>
							<?php } ?>
							<?php if( !empty($profile_user["user_country"]) ){ ?>
							<tr>
							<td>Pays</td>
							<td><?php echo $profile_user["user_country"];?></td>
							</tr>
							<?php } ?>
							<tr>
							<td>Membre depuis</td>
							<td><?php echo date('d/m/Y', $profile_user["user_time"]); ?></td>
							</tr>
							<tr>
							<td>Dernier passage</td>
							<td><?php echo date('d/m/Y', $profile_user["user_last"]); ?></td>
							</tr>
							</table>
							</div>
						</div>
						</div>
						
						<?php if( !empty($profile_user["user_desc"]) ){ ?>
						<div class="profile_panel">
						<b class="text-danger">Description personnelle</b>
						<div class="profile_separator"></div>
						<div class="profile_desc"><?php echo smileys(bbcode($profile_user["user_desc"])); ?></div>
						</div>
						<?php } ?>
						
						<div class="profile_panel">
							<b><span class="text-danger">Nombre de messages postés sur les forums :</span> <?php echo number_format($profile_user["user_posts"], 0, ',', '.'); ?></b>
							<div class="profile_separator"></div>
							<div class="profile_posts_bar"><span style="width:<?php echo $posts_width;?>%;"></span></div>
						</div>

						<script type="text/javascript">
						$(function(){
							$('.avatar').colorbox({
								maxWidth: '95%',
								maxHeight: '95%',
								rel: true,
								title: false
							});
						});
						</script>
						<?php }else{ ?>
						<div class="alert alert-danger text-center">Cet utilisateur est banni.</div>
						<?php } ?>
					<?php }else{ ?>
					<div class="alert alert-danger text-center">Cet utilisateur n'existe pas.</div>
					<?php } ?>
				<?php }else{ ?>
				<div class="alert alert-danger text-center">Le nom d'utilisateur est invalide.</div>
				<?php } ?>
			</div>
		</div>
	</div>
</body>
</html>