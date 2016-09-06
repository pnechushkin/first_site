<?php
$mes = null;
function vaildpasw($pasw1, $pasw2)
{
	if ($pasw1 === $pasw2) {
		return true;
	} else {
		return false;
	}
}

function uniqueness_login($login)
{
	$file = __DIR__ . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'users.txt';
	if (!is_file($file)) {
		return true;
	} else {
		$fo = fopen($file, 'r');
		while (false !== ($row = fgets($fo))) {
			$login = trim($login);
			$rez = json_decode($row, true);
			if ($rez['login'] === $login) {
				fclose($fo);
				return false;
			}
		}
		fclose($fo);
	}
	return true;
}

function edd_user($login, $pasw1, $email, $name)
{
	$userinf = array(
		'login' => $login,
		'pasw' => md5($pasw1),
		'email' => $email,
		'role' => 'user',
		'role' => $name,

	);
	$userinfval = json_encode($userinf) . PHP_EOL;
	$file = __DIR__ . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'users.txt';
	$fp = fopen($file, "a");
	fwrite($fp, $userinfval);
	fclose($fp);
}


if (!empty($_POST)) {
	$er = 0;
	if (empty($_POST['login']) ||
		empty($_POST['pasw1']) ||
		empty($_POST['pasw2']) ||
		empty($_POST['name']) ||
		empty($_POST['email'])
	) {
		$mes .= 'Не все поля заполнены<br/>';
		$er += 1;
	}
	if (!uniqueness_login($_POST['login'])) {
		$mes .= 'Пользователь под логином ' . $_POST['login'] . 'уже есть<br/>';
		$er += 1;
	}
	if (!vaildpasw($_POST['pasw1'], $_POST['pasw2'])) {
		$mes .= 'Пароли не совпадают<br/>';
		$er += 1;
	}
	if (!empty($_POST['login']) &&
		!empty($_POST['pasw1']) &&
		!empty($_POST['pasw2']) &&
		!empty($_POST['name']) &&
		!empty($_POST['email']) && $er == 0
	) {
		edd_user($_POST['login'], $_POST['pasw1'], $_POST['email'], $_POST['name']);
		$mes .= 'Регистрация прошла успешно<br/>';
	}
}
?>
<?php
include_once('head.php');
?>
<title>Задачи по функциям и формам</title>

<div>
	<h2>Форма регистрации</h2>
</div>
<div>
	<form method="post">
		<label>Имя</label><br/>
		<input name="name" type="text"><br/>
		<label>Login</label><br/>
		<input name="login" type="text"><br/>
		<label>Пароль</label><br/>
		<input name="pasw1" type="password"><br/>
		<label>Пароль еще раз</label><br/>
		<input name="pasw2" type="password"><br/>
		<label>Ваш email</label><br/>
		<input name="email" type="email"><br/>
		<input type="submit" value="Go">
	</form>
</div>
<div>
	<?= $mes ?>
</div>
<?php
include_once('footer.php')
?>
