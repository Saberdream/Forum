<?php
		// //
		foreach($_POST['smilies'] as $key => $val) {
			echo $key.' => <br>';
			$i = 0;
			foreach($val as $key2 => $val2) {
				echo 'clé n°'.$i.' : '.$key2.' => '.$val2.'<br><br>';
				$i++;
			}
			unset($i);
			unset($key2, $val2);
			echo '<br><br><br>';
		}
		unset($key, $val);
		// //