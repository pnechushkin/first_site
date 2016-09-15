<?php
define(ADMIN_DIR, __DIR__ . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR);
define(USERS_DIR, __DIR__ . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR);
define(USERS_FILE, __DIR__ . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'users.txt');
define(MES_FILE, __DIR__ . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'message.txt');

function need_answ($id)
{
	$answer = true;
	$fo = fopen(MES_FILE, 'r');
	while (false !== ($row = fgets($fo))) {
		$rez = json_decode($row, true);
		if ($rez['id_mes'] == $id && $rez['role'] == 'admin') {
			$answer = false;
			break;
		}
	}
	fclose($fo);

	return $answer;
}

function find_mes($id)
{
	$fo = fopen(MES_FILE, 'r');
	$answ='<div class="col-md-6 col-md-offset-3"></div>';
	while (false !== ($row = fgets($fo))) {
		$rez = json_decode($row, true);
		if ($rez['id_mes'] == $id && $rez['role'] == 'admin') {
			$answ= '<div class="col-md-6 col-md-offset-3"><b>Ответ администратора: <br/></b>' . $rez['text'] . '</div>';
		}
	}
	fclose($fo);
	return $answ;
}
function show_users_mes ($id) {
	$fo = fopen(MES_FILE, 'r');
	while (false !== ($row = fgets($fo))) {
		$rez = json_decode($row, true);
		if ($rez['id_mes'] == $id && $rez['role'] != 'admin') {
			return $rez['text'];
		}
	}
	fclose($fo);
}

function findfreemes()
{
	$idmes = array();
	$fo = @fopen(MES_FILE, 'r');
	while (false !== ($row = @fgets($fo))) {
		$rez = json_decode($row, true);
		$id = $rez['id_mes'];
		if (need_answ($id) && !empty($id)) {
			$idmes[] = $rez;

		}
	}
	@fclose($fo);

	return $idmes;
}

function findmes($user)
{   $arr= array();
	$fo = @fopen(MES_FILE, 'r');
	while (false !== ($row = @fgets($fo))) {

		$rez = json_decode($row, true);
		if ($rez['login'] == $user) {
			$mes='<div class="col-md-6"><b>Ваше сообщение: <br/></b>' . $rez['text'] . '</div>';
			$mes.=find_mes($rez['id_mes']);
			array_unshift($arr, $mes);
		}
	}
	@fclose($fo);
	return $mes=implode ($arr);
}

function find_user($user, $param = null)
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
			if (empty($_SESSION)) {
				session_start();
				$_SESSION['login'] = $login;
				$_SESSION['role'] = $rez['role'];
				$_SESSION['name'] = $rez['name'];
			}
			if ($param == null) {
				return $userdata;
			} else {
				return $userdata[$param];
			}
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

function save_mes($mes, $role, $login, $id_mes)
{
	$mes = strip_tags($mes);
	$arr_mes = array(
		'login' => $login,
		'text' => $mes,
		'role' => $role,
		'id_mes' => $id_mes,
	);

	$fp = fopen(MES_FILE, "a");
	fwrite($fp, json_encode($arr_mes) . PHP_EOL);
	fclose($fp);
}

function last_id_mes()
{
	if (!is_file(MES_FILE)) {
		return 1;
	} else {
		$id = 1;
		$fo = fopen(MES_FILE, 'r');

		while (false !== ($row = fgets($fo))) {

			$rez = json_decode($row, true);
			if ($id <= $rez['id_mes']) {
				$id = $rez['id_mes'] + 1;
			}

		}
		fclose($fo);

		return $id;
	}

}