<?php
include_once('head.php');

?>
	<title>Авторизация</title>
	<div align="center"><p>
		<h3>Форма аторизации:</h3></p></div>
	<div>
		<form action="/authorization.php" method="post" class="form-horizontal">
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Email</label>
				<div class="col-sm-10">
					<input name="mail" type="email" class="form-control" id="inputEmail3" placeholder="Email">
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">Password</label>
				<div class="col-sm-10">
					<input name="password" type="password" class="form-control" id="inputPassword3"
					       placeholder="Password">
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Sign in</button>
				</div>
			</div>
		</form>
	</div>
<?php
include_once('footer.php');
?>