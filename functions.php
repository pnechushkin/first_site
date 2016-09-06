<?php
define(ADMIN_DIR, __DIR__ . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR );
define(USERS_DIR, __DIR__ . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR );
define(USERS_FILE, __DIR__ . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'users.txt');
function find_user($user)
{
	$userdata = array();
	$file = USERS_FILE;
	$fo = fopen($file, 'r');
	while (false !== ($row = fgets($fo))) {
		$login = trim($user);
		$rez = json_decode($row, true);
		$file_login = $rez['login'];
		if ($file_login === $login) {
			$userdata = $rez;
			fclose($fo);
			session_start();
			$_SESSION['login'] = $login;
			$_SESSION['role'] = $rez['role'];
			$_SESSION['name'] = $rez['name'];
			return $userdata;
		}
	}
	fclose($fo);
	return false;
}

function vaild_avtor()
{
	if (!empty($_POST)) {
		find_user($_POST['login']);
		$userdata = find_user($_POST['login']);
		$er = 0;
		if (empty($_POST['login']) || empty($_POST['pasw1'])) {
			$er += 1;
			return 1;
		}
		if (count($userdata) == 0) {
			$er += 1;
			return 2;
		} else {
			if (md5($_POST['pasw1']) != $userdata['pasw']) {
				$er += 1;
				return 3;
			}
		}
		return 0;
	}
}