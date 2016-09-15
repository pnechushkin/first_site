<?php
include_once('head.php');
if ($_POST && $_SESSION) {
	save_mes($_POST['mes'], $_SESSION['role'], $_SESSION['login'],last_id_mes());
}
$loginmes = findmes($_SESSION['login']);
?>
<?php if ($_SESSION): ?>
	<head>
		<title>Обратная связь</title>
	</head>
	<div class="ROWS">
		<div class="col-md-12" align="center"><p>
			<h3>Обратная связь:</h3></p></div>
		<div class="col-md-12">
			<form action="/feedback.php" method="post" class="form-horizontal">
				<div class="form-group">
					<label class="col-sm-2">Ваше сообщение</label>
					<div class="col-sm-10">
						<textarea class="form-control" name="mes" rows="3"></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-6 col-sm-6">
						<button type="submit" class="btn btn-primary">Отправить</button>
					</div>
				</div>
			</form>
		</div>
		<div class="col-md-12"><?php echo $loginmes; ?></div>
	</div>
	<div class="ROWS">

	</div>
	<?php ;
else: ?>
	<div class="alert alert-danger">
		Доступно только для зарегестрированых пользователей! <br/>Пожалуйста <a href="/authorization.php">авторизируйтесь</a>
		или <a href="registration.php"> зарегестрируйтесь</a>
	</div>
	<?php
endif;
include_once('footer.php')
?>