<?php
function count_rows($userid, $clauses = array(), $keywords = null, $exact = false) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT COUNT(participant_id) FROM '.$config['table_prefix'].'pm_participants
	LEFT JOIN '.$config['table_prefix'].'pm ON '.$config['table_prefix'].'pm.pm_id = '.$config['table_prefix'].'pm_participants.participant_pmid'
	.(count($clauses) > 0 ? ' WHERE '.implode(' AND ', $clauses) : ''));

	$sth->bindValue(':userid', (int) $userid, PDO::PARAM_INT);

	if(!empty($keywords))
		$sth->bindValue(':keywords', $exact ? $keywords : '%'.$keywords.'%', PDO::PARAM_STR);
	
	$sth->execute();
	$nb = $sth->fetchColumn();
	unset($sth);
	
	return $nb;
}

function get_rows($userid, $offset, $limit, $clauses = array(), $order = 'pm_last DESC', $keywords = null, $exact = false) {
	global $dbh, $config;

	$sth = $dbh->prepare('SELECT participant_id, participant_userid, participant_pmid, participant_last, participant_read, pm_postid, pm_userid, pm_username, pm_name, pm_first, pm_last, pm_closed, pm_rank, pm_posts, pm_nb_participants, pm_participants
	FROM '.$config['table_prefix'].'pm_participants
	LEFT JOIN '.$config['table_prefix'].'pm ON '.$config['table_prefix'].'pm.pm_id = '.$config['table_prefix'].'pm_participants.participant_pmid'
	.(count($clauses) > 0 ? ' WHERE '.implode(' AND ', $clauses) : '').
	' ORDER BY '.$order.' LIMIT :offset, :limit');
	$sth->bindValue(':userid', (int) $userid, PDO::PARAM_INT);
	$sth->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
	$sth->bindValue(':limit', (int) $limit, PDO::PARAM_INT);

	if(!empty($keywords))
		$sth->bindValue(':keywords', $exact ? $keywords : '%'.$keywords.'%', PDO::PARAM_STR);

	$sth->execute();
	$rows = $sth->fetchAll(PDO::FETCH_ASSOC);
	unset($sth);

	return $rows;
}

function update_read($userid, $ids, $read) {
	global $dbh, $config;

	$values = array($read, $userid);
	$values = array_merge($values, $ids);

	$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'pm_participants SET participant_read = ? WHERE participant_userid = ? AND participant_pmid IN ('.placeholders('?', sizeof($ids)).')');
	$sth->execute(array_values($values));
	unset($sth);

	return true;
}

function delete_pm($userid, $username, $ids) {
	global $dbh, $config;

	$sth = $dbh->prepare('SELECT pm_id, pm_userid, pm_participants FROM '.$config['table_prefix'].'pm WHERE pm_id IN ('.placeholders('?', sizeof($ids)).')');
	$sth->execute(array_values($ids));
	$data = $sth->fetchAll(PDO::FETCH_ASSOC);
	unset($sth);

	if($data) {
		$participants = $ids2 = array();
		$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'pm SET pm_participants = ? WHERE pm_id = ?');

		foreach($data as $key => $value) {
			$participants[$key] = explode(';', $value['pm_participants']);
			$participants[$key] = array_map('strtolower', $participants[$key]);
			
			if(in_array(strtolower($username), $participants[$key])) {
				foreach($participants[$key] as $key2 => $value2) {
					if($value2 == strtolower($username))
						unset($participants[$key][$key2]);
				}

				unset($key2, $value2);

				if(sizeof($participants[$key]) == 0)
					$ids2[] = $value['pm_id'];
				else
					$sth->execute(array(implode(';', $participants[$key]), $value['pm_id']));
			}
		}
		
		unset($sth, $key, $value);
	}

	if(sizeof($ids2) > 0) {
		// prevent from keeping pm with no participant in db (we don't like orpheline data)
		$sth = $dbh->prepare('DELETE FROM '.$config['table_prefix'].'pm WHERE pm_id IN ('.placeholders('?', sizeof($ids2)).')');
		$sth->execute(array_values($ids2));
		unset($sth);
		
		$sth = $dbh->prepare('DELETE FROM '.$config['table_prefix'].'pm_participants WHERE participant_pmid IN ('.placeholders('?', sizeof($ids2)).')');
		$sth->execute(array_values($ids2));
		unset($sth);
		
		$sth = $dbh->prepare('DELETE FROM '.$config['table_prefix'].'pm_posts WHERE post_pmid IN ('.placeholders('?', sizeof($ids2)).')');
		$sth->execute(array_values($ids2));
		unset($sth);
	}

	$values = array($userid);
	$values = array_merge($values, $ids);

	$sth = $dbh->prepare('DELETE FROM '.$config['table_prefix'].'pm_participants WHERE participant_userid = ? AND participant_pmid IN ('.placeholders('?', sizeof($ids)).')');
	$sth->execute(array_values($values));
	unset($sth);

	return true;
}
