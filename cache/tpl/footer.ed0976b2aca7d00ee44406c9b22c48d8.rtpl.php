<?php if(!class_exists('raintpl')){exit;}?>
	<div class="container">
		<footer>
		<p><?php echo $lang_footer["developped_by"];?> <?php echo $lang_footer["script_licensed"];?> <a href="http://creativecommons.org/licenses/by-nc-sa/2.0/fr/" target="_blank">Creative Commons</a>.<br />
		<?php echo $lang_footer["contact"];?></p>
		<?php if( $user["user_rank"] >= ADMIN ){ ?><p><a href="http://forum.prog/adm/"><?php echo $lang_footer["admin_cp"];?></a></p><?php } ?>
		</footer>
	</div>
</body>
</html>