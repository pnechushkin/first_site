<?php
ob_start();
include_once('functions.php');
session_start();
if (isset($_GET['exit'])) {
	session_destroy();
	header('Location: http://' . $_SERVER['HTTP_HOST']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<link rel="stylesheet" href="<?php __DIR__ ?>/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php __DIR__ ?>/css/bootstrap-theme.min.css">
	<script src="<?php __DIR__ ?>/js/bootstrap.js"></script>
	<link rel="stylesheet" href="<?php __DIR__ ?>/css/css.css" type="text/css">
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<ul class="nav nav-pills nav-justified">
			<li><a href="/"><H3>Главная</H3></a></li>
			<?php if (!$_SESSION): ?>
				<li><a href="/authorization.php"><H3>Авторизация</H3></a></li>
				<li><a href="/registration.php"><H3>Регистрация</H3></a></li>
				<?php ;
			else :
				if ($_SESSION['role'] == 'admin') :
					; ?>
					<li><a href="/admin/message.php"><H3>Вопросы</H3></a></li>
				<?php else : ?>
					<li><a href="/feedback.php"><H3>Обратная связь</H3></a></li>
				<?php endif; ?>
				<li><a href="/?exit"><H3> Выход</H3></a></li>
				<?php
			endif; ?>
		</ul>
	</div>
</nav>
<div class="container">