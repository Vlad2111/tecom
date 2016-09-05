<?php
/* Smarty version 3.1.28, created on 2016-09-05 12:31:40
  from "/var/www/hr-timetrack/3pty/Smarty/demo/templates/errors.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_57cd3b7c5b2301_50897668',
  'file_dependency' => 
  array (
    '5992022e3282ecc39e0a506e939acfbb8ab0dcdb' => 
    array (
      0 => '/var/www/hr-timetrack/3pty/Smarty/demo/templates/errors.tpl',
      1 => 1472722627,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:3pty/Smarty/demo/templates/header.tpl' => 1,
  ),
),false)) {
function content_57cd3b7c5b2301_50897668 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Tecomgroup | <?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:3pty/Smarty/demo/templates/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

		<div class="content-wrapper">
			<section class="content">
				<div class="row">
					<div class="col-xs-12">
						<div class="box">
							<div class="box-header">
								<h3 class="box-title" style="font-size:23px">Ошибки</h3>
							</div>
							<div class="box-body">
								<table id="errors" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>Коментарий</th>
											<th>Месяц</th>
											<th>Сотрудник</th>
											<th>Проект</th>
											<th>Время</th>
											<th>Ошибка</th>
										</tr>
									</thead>
									<tbody>
									<?php
$_from = $_smarty_tpl->tpl_vars['errors']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_foo_0_saved_item = isset($_smarty_tpl->tpl_vars['foo']) ? $_smarty_tpl->tpl_vars['foo'] : false;
$_smarty_tpl->tpl_vars['foo'] = new Smarty_Variable();
$__foreach_foo_0_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
if ($__foreach_foo_0_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['foo']->value) {
$__foreach_foo_0_saved_local_item = $_smarty_tpl->tpl_vars['foo'];
?>
										
										<tr>
											<td><?php echo $_smarty_tpl->tpl_vars['foo']->value['comment'];?>
</td>
											<td><?php echo $_smarty_tpl->tpl_vars['foo']->value['info']['date'];?>
</td>
											<td><?php echo $_smarty_tpl->tpl_vars['foo']->value['info']['nameEmp'];?>
</td>
											<td><?php echo $_smarty_tpl->tpl_vars['foo']->value['info']['namePro'];?>
</td>											
											<td><?php echo $_smarty_tpl->tpl_vars['foo']->value['info']['time'];?>
</td>
											<td><?php echo $_smarty_tpl->tpl_vars['foo']->value['message'];?>
</td>
										</tr>
									<?php
$_smarty_tpl->tpl_vars['foo'] = $__foreach_foo_0_saved_local_item;
}
}
if ($__foreach_foo_0_saved_item) {
$_smarty_tpl->tpl_vars['foo'] = $__foreach_foo_0_saved_item;
}
?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<footer class="main-footer">
			<div class="pull-right hidden-xs">
			</div>
		</footer>
		<?php echo '<script'; ?>
>
			$(function () {
				$('#errors').DataTable({
					"paging": true,
					"lengthChange": true,
					"searching": true,
					"ordering": true,
					"info": true,
					"autoWidth": true,
					"language": {
						"lengthMenu": "Показать _MENU_ элементов",
						"zeroRecords": "Ничего не найдено",
						"info": "С _START_ по _END_ из _TOTAL_",
						"infoEmpty": "Нет доступных данных",
						"infoFiltered": "(Отфильтровано из _MAX_ записей)",
						"paginate": {
							"first":"Первый",
							"last": "Последний",
							"next": "Следующая",
							"previous": "Предыдущая"
							},
						"loadingRecords": "Загрузка...",
						"processing": "Обработка...",
						"search": "Поиск:"
					}
				});
			});
		<?php echo '</script'; ?>
>
	</div>
	</body>
</html><?php }
}
