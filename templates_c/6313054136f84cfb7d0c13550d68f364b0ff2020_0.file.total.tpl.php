<?php
/* Smarty version 3.1.28, created on 2016-10-19 16:14:51
  from "/var/www/hr-timetrack-dev/3pty/Smarty/demo/templates/total.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_580771cb3907d2_53086598',
  'file_dependency' => 
  array (
    '6313054136f84cfb7d0c13550d68f364b0ff2020' => 
    array (
      0 => '/var/www/hr-timetrack-dev/3pty/Smarty/demo/templates/total.tpl',
      1 => 1476454859,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:3pty/Smarty/demo/templates/header.tpl' => 1,
  ),
),false)) {
function content_580771cb3907d2_53086598 ($_smarty_tpl) {
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
	<body style="height:100%;" class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:3pty/Smarty/demo/templates/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

			<div class="content-wrapper">
				<section class="content">
					<div class="row">
						<div class="col-xs-12">
						<?php if ($_smarty_tpl->tpl_vars['statusEditing']->value != null) {?>
						<?php echo $_smarty_tpl->tpl_vars['statusEditing']->value;?>

						<?php }?>
							<div class="box">
								<div class="box-header">
									<h3 class="box-title" style="font-size:23px"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h3>	
								</div>
								<div class="box-body">
									<table id="total" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>Дата</th>
												<th>Дата</th>
												<th>Колличество сотрудников</th>
											</tr>
										</thead>
										<tbody>
										<?php if ($_smarty_tpl->tpl_vars['arrayTotal']->value != null) {?>
										<?php
$_from = $_smarty_tpl->tpl_vars['arrayTotal']->value;
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
												<td><?php echo $_smarty_tpl->tpl_vars['foo']->value['date'];?>
</td>
												<td>
													<a 
														href="/index.php
															?route=List/viewListEmployee
															&date=<?php echo $_smarty_tpl->tpl_vars['foo']->value['date'];?>
">
														<?php echo $_smarty_tpl->tpl_vars['foo']->value['month'];?>

													</a>
												</td>
												<td><?php echo $_smarty_tpl->tpl_vars['foo']->value['count'];?>
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
										<?php }?>
										</tbody>
									</table>
									
									<form action="/index.php" method="get" onsubmit="diactive()">			
										<div class="modal-body" >
											<div class="form-group">
												<table style="width:100%"><tr ><td>
												<label>Начало интервала</label>
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input name="date1" type="text" class="form-control pull-right" id="datepicker11">
												</div></td><td>
												<label>Конец интервала</label>
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input name="date2" type="text" class="form-control pull-right" id="datepicker22">
												</div>
												<div class="input-group hidden">
													<input name="route" type="hidden" value="Total/viewTotal">
													<input name="Month" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['selectedMonthForGet']->value;?>
">
													<input name="Year" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['selectedYearForGet']->value;?>
">
												</div></td></tr></table>
											</div>
										</div>
										<div class="modal-footer">
											<button id="buttonFcopy" type="button" class="btn btn-default pull-left" data-dismiss="modal" style="width: 200px">Отмена</button>
											<button id="buttonScopy" type="submit" class="btn btn-primary" style="width: 200px">Сохранить</button>
										</div>
									</form>
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
					$('#datepicker11').datepicker({
						autoclose: true
					});
				});
			<?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
>
				$(function () {
					$('#datepicker22').datepicker({
						autoclose: true
					});
				});
			<?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
>
				function diactive() {
					document.getElementById('buttonScopy').disabled = 1;
					document.getElementById('buttonFcopy').disabled = 1;
				}
			<?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
>
				$(function () {
					var table = $('#total').DataTable({
						"paging": false,
						"lengthChange": true,
						"searching": false,
						"ordering": false,
						"info": true,
						"autoWidth": true,
						"stateSave": true,
						"stateDuration": -1,
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
					var column = table.column(0);
					column.visible(false);
					column.order('asc');
				});
			<?php echo '</script'; ?>
>
		</div>
	</body>
</html>
<?php }
}
