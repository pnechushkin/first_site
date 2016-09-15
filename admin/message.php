<?php
include_once('../head.php');
if (!empty($_POST)) {
	$count = count($_POST['answ']);
	for ($i = 0; $i < $count; $i++) {
		if (!empty($_POST['answ'][$i])) {
			save_mes($_POST['answ'][$i], 'admin', $_SESSION['login'], $_POST['id_mes'][$i]);
		}
	}
}
if ($_SESSION['role'] == 'admin') :
	$mes = findfreemes();
	$mes_count = count($mes);
	?>
	<title>Страница администратора</title>
	<?php if ($mes_count != 0 && empty($_POST)) : ?>
	<form role="form" method="post" class="form-horizontal">
		<?php for ($i = 0; $i < $mes_count; $i++) : ?>
			<div class="form-group">
				<label>Вопрос от <?php echo find_user($mes[$i]['login'], 'name'); ?></label>
				<input type="hidden" class="form-control" name="id_mes[]" value="<?php echo $mes[$i]['id_mes']; ?>">
				<div><?php echo show_users_mes ($mes[$i]['id_mes']); ?></div>
			</div>
			<div class="form-group">
				<label>Ваш ответ</label>
				<textarea class="form-control" name="answ[]" rows="3"></textarea>
			</div>
		<?php endfor; ?>
		<div class="col-sm-offset-6 col-sm-6">
			<button type="submit" class="btn btn-primary">Сохранить</button>
		</div>
	</form>
<?php elseif (!empty($_POST)): ?>
	<div class="alert alert-success">Сохранено! <a href="/admin/message.php">Проверить еще</a></div>
	<?php ; ?>
<?php else: ?>
	<div class="alert alert-success">Вы ответели на все вопросы :)</div>
<?php endif; ?>

	</div>

	<?php
else : ?>
	<div class="alert alert-danger">
		Ошибка доступа!
	</div>
<?php endif;
include_once('../footer.php');
?>
