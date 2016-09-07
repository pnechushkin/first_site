<?php
include_once('head.php')
?>
<?php if ($_SESSION): ?>
	<head>
		<title>Обратная связь</title>
	</head>
	<div align="center"><p>
		<h3>Обратная связь:</h3></p></div>
	<div>
		<form action="/feedback.php" method="post" class="form-horizontal">
			<div class="form-group">
				<label class="col-sm-2">Ваше сообщение</label>
				<div class="col-sm-10">
					<textarea class="form-control" rows="3"></textarea>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-6 col-sm-6">
					<button type="submit" class="btn btn-primary">Отправить</button>
				</div>
			</div>
		</form>
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