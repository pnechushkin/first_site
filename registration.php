<?php

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
		while (false !== ($row = fgets($fo, 4096))) {
			$login = trim($login);
			$rez = json_decode($row, true);
			$file_login = $rez['login'];
			if ($file_login === $login) {
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
	if (!empty($_POST) && vaild_data() == 0) {
		$userinf = array(
			'login' => $login,
			'pasw' => md5($pasw1),
			'email' => $email,
			'role' => 'user',
			'name' => $name,

		);
		$userinfval = json_encode($userinf) . PHP_EOL;
		$file = __DIR__ . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'users.txt';
		$fp = fopen($file, "a");
		fwrite($fp, $userinfval);
		fclose($fp);
		return true;
	} else {
		return false;
	}
}

function vaild_data()
{
	if (empty($_POST['login']) ||
		empty($_POST['pasw1']) ||
		empty($_POST['pasw2']) ||
		empty($_POST['name']) ||
		empty($_POST['email'])
	) {
		return 1;
	}
	if (!uniqueness_login($_POST['login'])) {
		return 2;
	}
	if (!vaildpasw($_POST['pasw1'], $_POST['pasw2'])) {
		return 3;
	}
	return 0;
}

?>
<?php
include_once('head.php');
?>
<title>Регистрация пользователя</title>

<div>
	<h2>Форма регистрации</h2>
</div>
<div>
	<form method="post" class="form-horizontal">
		<div class="form-group">
			<label class="col-sm-2 control-label">Имя</label>
			<div class="col-sm-10"><input class="form-control" name="name" type="text"><span class="help-inline">Укажите Ваше имя</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Login</label>
			<div class="col-sm-10"><input class="form-control" name="login" type="text"><span class="help-inline">Придумайте логин</span>
			</div>
		</div>
		<div class="form-group">
			<label for="inputPassword1" class="col-sm-2 control-label">Пароль</label>
			<div class="col-sm-10"><input class="form-control" name="pasw1" type="password" id="inputPassword1"><span
					class="help-inline">Придумайте пароль</span></div>
		</div>
		<div class="form-group">
			<label for="inputPassword2" class="col-sm-2 control-label">Пароль еще раз</label>
			<div class="col-sm-10"><input class="form-control" name="pasw2" type="password" id="inputPassword2"><span
					class="help-inline">Повторите пароль</span></div>
		</div>
		<div class="form-group">
			<label for="inputEmail" class="col-sm-2 control-label">Ваш email</label>
			<div class="col-sm-10"><input class="form-control" name="email" type="email" id="inputEmail"><span
					class="help-inline">Укажите Email</span></div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<div class="col-sm-10">
					<button type="submit" class="btn">Зарегистрироваться</button>
				</div>
			</div>
		</div>
	</form>
</div>
<?php if (!empty($_POST)):
	if (edd_user($_POST['login'], $_POST['pasw1'], $_POST['email'], $_POST['name'])):?>
		<div class="alert alert-success">
			Регистрация прошла успешно! Перейти на страницу  <a href="/authorization.php">авторизации</a>
		</div>
		<?php ;
	else: ?>
		<div class="alert alert-danger">
			Ошибка регистрации!<br/>
			<?php if (vaild_data() == 1): ?>
				Не все поля заполнены!<br/>
			<?php endif;
			?>
			<?php if (vaild_data() == 2): ?>
				Такой логин уже есть!<br/>
			<?php endif;
			?>
			<?php if (vaild_data() == 3): ?>
				Пароли не совпадают!<br/>
			<?php endif;
			?>
		</div>
		<?php
	endif;
endif;
?>
<?php
include_once('footer.php')
?>
