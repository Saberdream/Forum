<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html lang="<?php echo $site_lang;?>">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $lang_alert["report_post"];?> - <?php echo display( $site_name );?></title>
<meta name="description" content="" />
<link rel="icon" type="image/png" href="http://forum.prog/favicon.ico" />
<link rel="stylesheet" href="http://forum.prog/styles/base/css/bootstrap.min.css" type="text/css">
<style type="text/css">
a:hover, a:link, a:focus {
	text-decoration: none;
}
th {
	text-align: center;
}
form {
	margin-bottom: 10px;
}
body {
	padding: 10px 0;
}
</style>
</head>

<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="panel panel-default">
				<div class="panel-heading"><?php echo $lang_alert["notify_administrator"];?></div>
				<div class="panel-body">
				<?php if( $user["user_rank"] >= $forum["auth_view"] && $user["user_rank"] >= $forum["auth_alert"] ){ ?>
				<?php if( $topic["invisible"] == 0 && $post["invisible"] == 0 ){ ?>
				<?php if( $nb == 0 ){ ?>
				<?php if( !empty($form["ok"]) ){ ?>
				<div class="alert alert-success text-center"><?php echo $form["ok"];?></div>
				<?php }else{ ?>
				<?php if( !empty($form["error"]) ){ ?><div class="alert alert-danger text-center"><?php echo $form["error"];?></div><?php } ?>
				<p class="text-muted"><?php echo $lang_alert["alert_info"];?></p>
				<form class="form-inline" method="post" action="http://forum.prog/alert?postid=<?php echo $post["id"];?>">
				<div class="form-group">
				<label class="sr-only" for="reason"><?php echo $lang_alert["reason"];?>:</label>
				<select class="form-control input-sm" name="reason" id="reason">
				<option value=""><?php echo $lang_alert["choose_reason"];?></option>
				<?php $counter1=-1; if( isset($reasons) && is_array($reasons) && sizeof($reasons) ) foreach( $reasons as $key1 => $value1 ){ $counter1++; ?>
				<option value="<?php echo $value1["reason_id"];?>"><?php echo display( $value1["reason_name"] );?></option>
				<?php } ?>
				</select>
				</div>
				<button type="submit" class="btn btn-sm btn-default"><?php echo $lang_alert["validate"];?></button>
				<input type="hidden" name="token" value="<?php echo $form["token"];?>" />
				</form>
				
				<table class="table table-striped table-bordered table-hover text-center">
				<tr>
				  <th><?php echo $lang_alert["reason"];?></th>
				  <th><?php echo $lang_alert["description"];?></th>
				</tr>
				<?php $counter1=-1; if( isset($reasons) && is_array($reasons) && sizeof($reasons) ) foreach( $reasons as $key1 => $value1 ){ $counter1++; ?>
				<tr>
				  <td><?php echo display( $value1["reason_name"] );?></td>
				  <td class="text-left"><?php echo display( $value1["reason_desc"] );?></td>
				</tr>
				<?php } ?>
				</table>
				<?php } ?>
				<?php }else{ ?>
				<div class="alert alert-danger text-center"><?php echo $lang_alert["post_already_reported"];?></div>
				<?php } ?>
				<?php }else{ ?>
				<div class="alert alert-danger text-center"><?php echo $lang_alert["post_not_exists"];?></div>
				<?php } ?>
				<?php }else{ ?>
				<div class="alert alert-danger text-center"><?php echo $lang_alert["not_authorized_report"];?></div>
				<?php } ?>
				</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>