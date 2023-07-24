<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html lang="<?php echo $site_lang;?>">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $lang_smileys["smileys_list"];?> - <?php echo display( $site_name );?></title>
<meta name="description" content="" />
<link rel="icon" type="image/png" href="http://forum.prog/favicon.ico" />
<link rel="stylesheet" href="http://forum.prog/styles/base/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="http://forum.prog/styles/base/css/jquery.colorbox.css" type="text/css">
<script type="text/javascript" src="http://forum.prog/styles/base/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="http://forum.prog/styles/base/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://forum.prog/styles/base/js/jquery.colorbox.min.js"></script>
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
.table>tbody>tr>td {
	padding: 1px;
}
</style>
<script type="text/javascript">
$(document).on('click', '.smileys-table a', function(e){
	e.preventDefault();
	var editor = $('#message', window.parent.document);
	var code = $(this).children('img').attr('alt');
	$(editor).val($(editor).val()+' '+code+' ');
	parent.$.colorbox({
		onClosed: function(){$(editor).focus();}
	});
	parent.$.colorbox.close();
	return false;
});
</script>
</head>

<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="panel panel-default">
				<div class="panel-heading"><?php echo $lang_smileys["smileys_list"];?></div>
				<div class="panel-body">
				<?php if( $smileys ){ ?>
				<p class="text-muted"><?php echo $lang_smileys["smileys_info"];?></p>
				
				<table class="smileys-table table table-striped table-bordered table-hover text-center">
				<?php $counter1=-1; if( isset($smileys) && is_array($smileys) && sizeof($smileys) ) foreach( $smileys as $key1 => $value1 ){ $counter1++; ?>
				<tr>
				<?php $counter2=-1; if( isset($value1) && is_array($value1) && sizeof($value1) ) foreach( $value1 as $key2 => $value2 ){ $counter2++; ?>
				  <td><a href=""><img src="http://forum.prog/gallery/smilies/<?php echo $value2["smiley_filename"];?>" alt="<?php echo $value2["smiley_code"];?>" /></a></td>
				  <td><?php echo $value2["smiley_code"];?></td>
				<?php } ?>
				</tr>
				<?php } ?>
				</table>
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