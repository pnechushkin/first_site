<?php
include_once('head.php');
?>
	<title>Авторизация</title>
	<div align="center"><p>
		<h3>Форма аторизации:</h3></p></div>
	<div>
		<form action="/authorization.php" method="post" class="form-horizontal">
			<div class="form-group">
				<label class="col-sm-2 control-label">Login</label>
				<div class="col-sm-10"><input class="form-control" name="login" type="text" placeholder="Ваш логин">
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword1" class="col-sm-2 control-label">Пароль</label>
				<div class="col-sm-10"><input class="form-control" name="pasw1" type="password" id="inputPassword1"
				                              placeholder="Ваш пароль"></div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-6 col-sm-6">
					<div class="col-sm-10">
						<button type="submit" class="btn btn-primary">Авторизироватся</button>
					</div>
				</div>
			</div>
		</form>
	</div>
<?php if (!empty($_POST)):
	if (find_user($_POST['login']) && ($valid = vaild_avtor()) == 0):
		if (find_user($_POST['login'],'role')=='admin')  : header('Location: /admin/message.php');
		else :
		header('Location: /feedback.php') ;
		endif;

	else: ?>
		<div class="alert alert-danger">
			Ошибка регистрации!<br/>
			<?php if ($valid == 1): ?>
				Не все поля заполнены!<br/>
			<?php endif;
			?>
			<?php if ($valid == 2): ?>
				Такой логин уже есть!<br/>
			<?php endif;
			?>
			<?php if ($valid == 3): ?>
				Пароли не совпадают!<br/>
			<?php endif;
			?>
		</div>
		<?php
	endif;
endif;
include_once('footer.php');
?>