<?php
include '../includes/functions.php';

if(isset($_POST['titre']))
	echo '<p align="center">'.remove_spec(mb_strtolower($_POST['titre'], 'UTF-8'), '_').'</p>';
?>
<form method="post">
<p align="center">
<input type="text" name="titre" value="<?php echo isset($_POST['titre'])? display($_POST['titre']):''; ?>" size="150" />
<input type="submit" value="OK">
</p>
</form>