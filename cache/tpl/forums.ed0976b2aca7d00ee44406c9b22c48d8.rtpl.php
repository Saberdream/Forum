<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "header" );?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-push-3 col-md-7 col-md-push-4 col-lg-6 col-lg-push-4">
			<ol class="breadcrumb">
			  <li class="active"><span class="glyphicon glyphicon-th-list"></span> <?php echo $lang_forums["forums"];?></li>
			</ol>
			<?php if( $nb > 0 ){ ?>
			<?php $counter1=-1; if( isset($rows) && is_array($rows) && sizeof($rows) ) foreach( $rows as $key1 => $value1 ){ $counter1++; ?>
			<?php if( $counter1 == 0 || (!empty($current_cat) && $value1["cat_name"] != $current_cat) ){ ?>
			<?php if( $counter1 > 0 ){ ?></table><?php } ?>
			<table class="table table-bordered table-hover text-center">
			<tr>
			  <th>&nbsp;</th>
			  <th><?php echo display( $value1["cat_name"] );?></th>
			  <th><?php echo $lang_forums["topics"];?></th>
			  <th><?php echo $lang_forums["posts"];?></th>
			  <th><?php echo $lang_forums["last_post"];?></th>
			</tr>
			<?php $current_cat=$this->var['current_cat']=$value1["cat_name"];?>
			<?php } ?>
			<tr>
			  <td><?php if( !empty($value1["forum_icon"]) ){ ?><img src="http://forum.prog/styles/base/<?php echo display( $value1["forum_icon"] );?>" /><?php }else{ ?><img src="http://forum.prog/styles/base/images/forum/default.png" /><?php } ?></td>
			  <td class="text-left"><a href="http://forum.prog/forum/<?php echo $value1["forum_slug"];?>/<?php echo $value1["forum_id"];?>/1"><?php echo display( $value1["forum_name"] );?></a><?php if( $value1["forum_closed"]==1 ){ ?> <i class="fa fa-lock" aria-hidden="true"></i><?php } ?><?php if( !empty($value1["forum_desc"]) ){ ?><br><small class="text-muted"><?php echo display( $value1["forum_desc"] );?></small><?php } ?></td>
			  <td><?php echo $value1["forum_topics_visible"];?></td>
			  <td><?php echo $value1["forum_posts_visible"];?></td>
			  <td><?php echo date('d/m/Y H:i', $value1["forum_last"]); ?></td>
			</tr>
			<?php } ?>
			</table>
			<?php }else{ ?>
			<span class="text-center"><?php echo $lang_forums["no_forum"];?></span>
			<?php } ?>
		</div>
		
		<div class="col-sm-3 col-sm-pull-9 col-md-3 col-md-pull-6 col-lg-2 col-lg-pull-4">
			<div class="list-group">
			<a class="list-group-item" href="http://forum.prog/index"><?php echo $lang_menu_top["home"];?></a>
			<a class="list-group-item" href="http://forum.prog/viewonline"><?php echo $lang_forums["users_connected"];?></a>
			</div>
		</div>
	</div>
</div>
<?php $tpl = new RainTPL;$tpl->assign( $this->var );$tpl->draw( "footer" );?>