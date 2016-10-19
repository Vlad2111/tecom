<?php
/* Smarty version 3.1.28, created on 2016-10-17 16:13:56
  from "/var/www/hr-timetrack-dev/3pty/Smarty/demo/templates/listProjects.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_5804ce940922b4_56066698',
  'file_dependency' => 
  array (
    'a5755745a6f050672fac9f49509f19528c5d5a42' => 
    array (
      0 => '/var/www/hr-timetrack-dev/3pty/Smarty/demo/templates/listProjects.tpl',
      1 => 1475491807,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:3pty/Smarty/demo/templates/header.tpl' => 1,
  ),
),false)) {
function content_5804ce940922b4_56066698 ($_smarty_tpl) {
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
									<h3 class="box-title" style="font-size:23px">Список Проектов</h3>	
								</div>
								<div class="box-body">
									<table id="projectList" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>Название</th>
												<th>Отдел</th>
												<th style="width: 18px"></th>
												<th style="width: 18px"></th>
											</tr>
										</thead>
										<tbody>
										<?php if ($_smarty_tpl->tpl_vars['arrayProjectNames']->value != null) {?>
										<?php
$_from = $_smarty_tpl->tpl_vars['arrayProjectNames']->value;
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
												<td>
													<a 
														href="/index.php
															?route=Project/viewProject
															&projectId=<?php echo $_smarty_tpl->tpl_vars['foo']->value['project_id'];?>

															&projectName=<?php echo $_smarty_tpl->tpl_vars['foo']->value['project_name'];?>

															&departmentId=<?php echo $_smarty_tpl->tpl_vars['foo']->value['department_id'];?>

															&departmentName=<?php echo $_smarty_tpl->tpl_vars['foo']->value['department_name'];?>

															&Month=<?php echo $_smarty_tpl->tpl_vars['selectedMonthForGet']->value;?>

															&Year=<?php echo $_smarty_tpl->tpl_vars['selectedYearForGet']->value;?>
">
														<?php echo $_smarty_tpl->tpl_vars['foo']->value['project_name'];?>

													</a>
												</td>
												<td>
													<a 
														href="/index.php
															?route=Department/viewDepartment
															&departmentId=<?php echo $_smarty_tpl->tpl_vars['foo']->value['department_id'];?>

															&departmentName=<?php echo $_smarty_tpl->tpl_vars['foo']->value['department_name'];?>

															&Month=<?php echo $_smarty_tpl->tpl_vars['selectedMonthForGet']->value;?>

															&Year=<?php echo $_smarty_tpl->tpl_vars['selectedYearForGet']->value;?>
">
														<?php echo $_smarty_tpl->tpl_vars['foo']->value['department_name'];?>

													</a>
												</td>
												<td>
													<?php if ($_smarty_tpl->tpl_vars['status']->value == FALSE) {?>
													<a 
														type="button" 
														class="btn btn-md" 
														<?php $_smarty_tpl->tpl_vars['accessJ'] = new Smarty_Variable(0, null);
$_smarty_tpl->ext->_updateScope->updateScope($_smarty_tpl, 'accessJ', 0);?>
														<?php
$_from = $_smarty_tpl->tpl_vars['headId']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_fooo_1_saved_item = isset($_smarty_tpl->tpl_vars['fooo']) ? $_smarty_tpl->tpl_vars['fooo'] : false;
$_smarty_tpl->tpl_vars['fooo'] = new Smarty_Variable();
$__foreach_fooo_1_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
if ($__foreach_fooo_1_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['fooo']->value) {
$__foreach_fooo_1_saved_local_item = $_smarty_tpl->tpl_vars['fooo'];
?>
														<?php if ($_smarty_tpl->tpl_vars['access']->value == null || $_smarty_tpl->tpl_vars['fooo']->value == $_smarty_tpl->tpl_vars['foo']->value['department_id']) {?>
														data-toggle="modal" 
														data-editid="<?php echo $_smarty_tpl->tpl_vars['foo']->value['project_id'];?>
" 
														data-lastname="<?php echo $_smarty_tpl->tpl_vars['foo']->value['project_name'];?>
" 
														data-departmentid="<?php echo $_smarty_tpl->tpl_vars['foo']->value['department_id'];?>
" 
														data-countselect="<?php echo $_smarty_tpl->tpl_vars['countArrayDepartmentNamesForSelect']->value;?>
" 
														data-target="#projectModal" 
														<?php $_smarty_tpl->tpl_vars['accessJ'] = new Smarty_Variable(1, null);
$_smarty_tpl->ext->_updateScope->updateScope($_smarty_tpl, 'accessJ', 0);?>
														<?php }?>
														<?php
$_smarty_tpl->tpl_vars['fooo'] = $__foreach_fooo_1_saved_local_item;
}
}
if ($__foreach_fooo_1_saved_item) {
$_smarty_tpl->tpl_vars['fooo'] = $__foreach_fooo_1_saved_item;
}
?>
														title="Редактировать Данные Проекта"
														<?php if ($_smarty_tpl->tpl_vars['accessJ']->value != 1) {?>
														<?php echo $_smarty_tpl->tpl_vars['access']->value;?>

														<?php }?>
														<?php $_smarty_tpl->tpl_vars['accessJ'] = new Smarty_Variable(0, null);
$_smarty_tpl->ext->_updateScope->updateScope($_smarty_tpl, 'accessJ', 0);?>>
														<i class="glyphicon glyphicon-pencil"></i>
													</a>
													<?php }?>
												</td>
												<td>
													<?php if ($_smarty_tpl->tpl_vars['status']->value == FALSE) {?>
													<a 
														type="button" 
														class="btn btn-md" 
														<?php
$_from = $_smarty_tpl->tpl_vars['headId']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_fooo_2_saved_item = isset($_smarty_tpl->tpl_vars['fooo']) ? $_smarty_tpl->tpl_vars['fooo'] : false;
$_smarty_tpl->tpl_vars['fooo'] = new Smarty_Variable();
$__foreach_fooo_2_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
if ($__foreach_fooo_2_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['fooo']->value) {
$__foreach_fooo_2_saved_local_item = $_smarty_tpl->tpl_vars['fooo'];
?>
														<?php if ($_smarty_tpl->tpl_vars['access']->value == null || $_smarty_tpl->tpl_vars['fooo']->value == $_smarty_tpl->tpl_vars['foo']->value['department_id']) {?>
														data-toggle="modal" 
														data-projectid="<?php echo $_smarty_tpl->tpl_vars['foo']->value['project_id'];?>
" 
														data-projectname="<?php echo $_smarty_tpl->tpl_vars['foo']->value['project_name'];?>
" 
														data-target="#removeModal" 
														<?php $_smarty_tpl->tpl_vars['accessJ'] = new Smarty_Variable(1, null);
$_smarty_tpl->ext->_updateScope->updateScope($_smarty_tpl, 'accessJ', 0);?>
														<?php }?>
														<?php
$_smarty_tpl->tpl_vars['fooo'] = $__foreach_fooo_2_saved_local_item;
}
}
if ($__foreach_fooo_2_saved_item) {
$_smarty_tpl->tpl_vars['fooo'] = $__foreach_fooo_2_saved_item;
}
?>
														title="Удалить Данные Проекта"
														<?php if ($_smarty_tpl->tpl_vars['accessJ']->value != 1) {?>
														<?php echo $_smarty_tpl->tpl_vars['access']->value;?>

														<?php }?>
														<?php $_smarty_tpl->tpl_vars['accessJ'] = new Smarty_Variable(0, null);
$_smarty_tpl->ext->_updateScope->updateScope($_smarty_tpl, 'accessJ', 0);?>>
														<i class="glyphicon glyphicon-trash"></i>
													</a>
													<?php }?>
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
									<?php if ($_smarty_tpl->tpl_vars['status']->value == FALSE) {?>
									<a 
										type="button" 
										class="btn btn-md" 
										<?php if ($_smarty_tpl->tpl_vars['access']->value == null) {?>
										data-toggle="modal" 
										data-countselect="<?php echo $_smarty_tpl->tpl_vars['countArrayDepartmentNamesForSelect']->value;?>
" 
										data-target="#projectModal" 
										<?php }?>
										title="Добавить Проект"
										<?php echo $_smarty_tpl->tpl_vars['access']->value;?>
>
										<i class="glyphicon glyphicon-plus"></i>
									</a>
									<?php }?>
								</div>
							</div>
						</div>
					</div>
					<div class="modal fade" id="projectModal" role="dialog" aria-labelledby="projectModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title" id="projectModalLabel"></h4>
								</div>
								<form action="/index.php" method="get" onsubmit="diactive()">
									<div class="modal-body">
										<div class="form-group">
											<label class="control-label">Название:</label>
											<input 
												id="nameProject"
												name="newName" 
												type="text" 
												class="form-control" 
												required="required">
										</div>
										<div class="form-group">
											<label>Отдел:</label>
											<select 
												id="selectId" 
												name="newDepartment" 
												class="form-control select2" 
												style="width: 100%;"
												required="required">
												<?php
$_from = $_smarty_tpl->tpl_vars['arrayDepartmentNamesForSelect']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_foo_3_saved_item = isset($_smarty_tpl->tpl_vars['foo']) ? $_smarty_tpl->tpl_vars['foo'] : false;
$_smarty_tpl->tpl_vars['foo'] = new Smarty_Variable();
$__foreach_foo_3_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
if ($__foreach_foo_3_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['foo']->value) {
$__foreach_foo_3_saved_local_item = $_smarty_tpl->tpl_vars['foo'];
?>
											
												<option value="<?php echo $_smarty_tpl->tpl_vars['foo']->value['department_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['foo']->value['department_name'];?>
</option>
												<?php
$_smarty_tpl->tpl_vars['foo'] = $__foreach_foo_3_saved_local_item;
}
}
if ($__foreach_foo_3_saved_item) {
$_smarty_tpl->tpl_vars['foo'] = $__foreach_foo_3_saved_item;
}
?>
											</select>
										</div>
									</div>
									<div class="modal-footer">
										<div class="input-group hidden">
											<input id="route" name="route" type="hidden">
											<input id="editId" name="editId" type="hidden">
											<input name="Month" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['selectedMonthForGet']->value;?>
">
											<input name="Year" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['selectedYearForGet']->value;?>
">
										</div>
										<button id="buttonModalF" style="width: 200px" type="button" class="btn btn-default pull-left" data-dismiss="modal">Отмена</button>
										<button id="buttonModalS" style="width: 200px" type="submit" class="btn btn-primary">Сохранить</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="modal fade" id="removeModal" tabindex="-1" role="dialog" style="margin: 0 auto;">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title" id="removeModalLabel"></h4>
								</div>							
								<form action="/index.php" method="get" onsubmit="diactiveRemove()">
									<div class="modal-body">
									</div>
									<div class="modal-footer">
										<div class="input-group hidden">
											<input name="route" type="hidden" value="List/removeProject">
											<input id="projectId" name="projectId" type="hidden">
											<input name="Month" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['selectedMonthForGet']->value;?>
">
											<input name="Year" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['selectedYearForGet']->value;?>
">
										</div>
										<button id="buttonModalFRemove" type="button" class="btn btn-default pull-left" data-dismiss="modal" style="width: 200px">Отмена</button>
										<button id="buttonModalSRemove" type="submit" class="btn btn-primary" style="width: 200px">Да</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="modal fade" id="changeDataMonthEditing" tabindex="-1" role="dialog" style="margin: 0 auto;">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title" id="changeDataMonthEditingLabel">Вы уверены что хотите 
										<?php if ($_smarty_tpl->tpl_vars['statusEditing']->value == null) {?>
											заблокировать
										<?php }?>
										<?php if ($_smarty_tpl->tpl_vars['statusEditing']->value != null) {?>
											разблокировать
										<?php }?>
										 данные месяца <b>(<?php echo $_smarty_tpl->tpl_vars['selectedMonth']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['selectedYearForGet']->value;?>
)</b> для редактирования.
									</h4>
								</div>							
								<form action="/index.php" method="get" onsubmit="diactiveChangeDataMonthEditing()">
									<div class="modal-body">
									</div>
									<div class="modal-footer">
										<div class="input-group hidden">
											<input name="route" type="hidden" value="List/changeDataStatusForEditing">
											<input name="lastStatus" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['status']->value;?>
">
											<input name="lastPage" type="hidden" value="Project">
											<input name="Month" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['selectedMonthForGet']->value;?>
">
											<input name="Year" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['selectedYearForGet']->value;?>
">
										</div>
										<button id="buttonModalFData" type="button" class="btn btn-default pull-left" data-dismiss="modal" style="width: 200px">Отмена</button>
										<button id="buttonModalSData" type="submit" class="btn btn-primary" style="width: 200px">Да</button>
									</div>
								</form>
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
				$('#projectModal').on('show.bs.modal', function (event) {
					var button = $(event.relatedTarget);
					var modal = $(this);
					var	 editId = button.data('editid');
					var lastName = button.data('lastname');
					var departmentId = button.data('departmentid');
					var countSelect = button.data('countselect');
					if (editId != null){
						modal.find('.modal-title').text('Редактировать Данные Проекта');
						document.getElementById('route').value = 'List/editProject';
						document.getElementById('editId').value = editId;
						document.getElementById('nameProject').value = lastName;
					}else{
						modal.find('.modal-title').text('Новый Проект');
						document.getElementById('route').value = 'List/newProject';
						document.getElementById('nameProject').value = null;
						document.getElementById('editId').value = null;
					}
					for (var i = 0; i < countSelect; i++) {
					var val = document.getElementById('selectId').options[i].value;
						if (val == departmentId){
							document.getElementById('selectId').options[i].selected=true;
						}else{
							document.getElementById('selectId').options[i].selected=false;
						}
					}
					$(function () {
						$(".select2").select2({
						modal: true,
						placeholder: "Выберите Отдел",
						allowClear: true
						});
					});
				});
			<?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
>
				function diactive() {
					document.getElementById('buttonModalS').disabled = 1;
					document.getElementById('buttonModalF').disabled = 1;
					document.getElementById("nameProject").setAttribute("readonly", "readonly");
				}
			<?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
>
				$('#removeModal').on('show.bs.modal', function (event) {
					var button = $(event.relatedTarget);
					var modal = $(this);
					var projectId = button.data('projectid');
					var projectName = button.data('projectname');
					modal.find('.modal-title').html('Вы уверены, что хотите удалить данные проекта: <u><b>'+projectName+'</u></b>');
					document.getElementById('projectId').value = projectId;
				});
			<?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
>
				function diactiveRemove() {
					document.getElementById('buttonModalSRemove').disabled = 1;
					document.getElementById('buttonModalFRemove').disabled = 1;
				}
			<?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
>
				function diactiveChangeDataMonthEditing() {
					document.getElementById('buttonModalSData').disabled = 1;
					document.getElementById('buttonModalFData').disabled = 1;
				}
			<?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
>
				$(function () {
					$('#projectList').DataTable({
						"paging": true,
						"lengthChange": true,
						"searching": true,
						"ordering": true,
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
				});
			<?php echo '</script'; ?>
>
		</div>
	</body>
</html>								
<?php }
}
