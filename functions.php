<?php
function find_user($user)
{
	$userdata = array();
	$file = __DIR__ . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'users.txt';
	$fo = fopen($file, 'r');
	while (false !== ($row = fgets($fo))) {
		$login = trim($user);
		$rez = unserialize($row);
		if ($rez['login'] === $login) {
			$userdata = $rez;
			fclose($fo);
			return $userdata;
		}
	}
	fclose($fo);
	return $userdata;
}

function user_valid_autorisation($user, $pasw)
{
	$er = 0;
	if (empty($user) || empty($pasw)) {
		$er += 1;
		return $eror = 1;
	}
	$userdata = find_user($user);
	if (count($userdata) == 0) {
		$er += 1;
		return $eror = 2;
	} else {
		if (md5($_POST['pasw1']) != $userdata['pasw']) {
			$er += 1;
			return $eror = 3;
		}
	}
	if (!empty($_POST['login']) && !empty($_POST['pasw1']) && $er == 0) {
		return $eror = 0;
	}

}