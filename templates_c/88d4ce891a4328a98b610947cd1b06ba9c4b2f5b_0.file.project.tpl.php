<?php
/* Smarty version 3.1.28, created on 2016-09-20 11:34:16
  from "/var/www/hr-timetrack-dev/3pty/Smarty/demo/templates/project.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_57e0f488edc291_25921664',
  'file_dependency' => 
  array (
    '88d4ce891a4328a98b610947cd1b06ba9c4b2f5b' => 
    array (
      0 => '/var/www/hr-timetrack-dev/3pty/Smarty/demo/templates/project.tpl',
      1 => 1473166564,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:3pty/Smarty/demo/templates/header.tpl' => 1,
  ),
),false)) {
function content_57e0f488edc291_25921664 ($_smarty_tpl) {
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
						<?php if ($_smarty_tpl->tpl_vars['statusEditing']->value != null) {?>
						<?php echo $_smarty_tpl->tpl_vars['statusEditing']->value;?>

						<?php }?>
							<div class="box">
								<div class="box-header">
									<h3 class="box-title" style="font-size:23px">Проект: <?php echo $_smarty_tpl->tpl_vars['projectName']->value;?>

										<?php if ($_smarty_tpl->tpl_vars['status']->value == FALSE) {?>
										<a 
											type="button" 
											class="btn btn-md"
											<?php if ($_smarty_tpl->tpl_vars['access']->value == null || $_smarty_tpl->tpl_vars['headId']->value == $_smarty_tpl->tpl_vars['departmentId']->value) {?>										
											data-toggle="modal" 
											data-departmentid="<?php echo $_smarty_tpl->tpl_vars['departmentId']->value;?>
" 
											data-countselect="<?php echo $_smarty_tpl->tpl_vars['countArrayDepartmentNamesForSelect']->value;?>
" 
											data-target="#projectModal" 
											<?php }?>
											title="Редактировать Данные Проекта"
											<?php if ($_smarty_tpl->tpl_vars['headId']->value != $_smarty_tpl->tpl_vars['departmentId']->value) {?>
											<?php echo $_smarty_tpl->tpl_vars['access']->value;?>

											<?php }?>>
											<i class="glyphicon glyphicon-pencil"></i>
										</a>
										<a 
											type="button" 
											class="btn btn-md" 
											<?php if ($_smarty_tpl->tpl_vars['access']->value == null || $_smarty_tpl->tpl_vars['headId']->value == $_smarty_tpl->tpl_vars['departmentId']->value) {?>
											data-toggle="modal"  
											data-target="#removeModalPro" 
											<?php }?>
											title="Удалить Данные Проекта"
											<?php if ($_smarty_tpl->tpl_vars['headId']->value != $_smarty_tpl->tpl_vars['departmentId']->value) {?>
											<?php echo $_smarty_tpl->tpl_vars['access']->value;?>

											<?php }?>>
											<i class="glyphicon glyphicon-trash"></i>
										</a>
										<?php }?>
									</h3>	
									<p>(Отдел: <?php echo $_smarty_tpl->tpl_vars['departmentName']->value;?>
)</p>
								</div>
								<div class="box-body">
									<table id="project" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>ФИО</th>
												<th>Отдел</th>
												<th style="width:20px">Занятость</th>
												<th style="width: 18px"></th>
												<th style="width: 18px"></th>
											</tr>
										</thead>
										<tbody>
										<?php if ($_smarty_tpl->tpl_vars['arrayEployeeNamesAndPercentsForProject']->value != null) {?>
										<?php
$_from = $_smarty_tpl->tpl_vars['arrayEployeeNamesAndPercentsForProject']->value;
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
															?route=Employee/viewEmployee
															&employeeId=<?php echo $_smarty_tpl->tpl_vars['foo']->value['employee_id'];?>

															&employeeName=<?php echo $_smarty_tpl->tpl_vars['foo']->value['user_name'];?>

															&employeeLogin=<?php echo $_smarty_tpl->tpl_vars['foo']->value['user_id'];?>

															&departmentId=<?php echo $_smarty_tpl->tpl_vars['foo']->value['department_id'];?>

															&departmentName=<?php echo $_smarty_tpl->tpl_vars['foo']->value['department_name'];?>

															&Month=<?php echo $_smarty_tpl->tpl_vars['selectedMonthForGet']->value;?>

															&Year=<?php echo $_smarty_tpl->tpl_vars['selectedYearForGet']->value;?>
">
														<?php echo $_smarty_tpl->tpl_vars['foo']->value['user_name'];?>

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
												<td><?php echo $_smarty_tpl->tpl_vars['foo']->value['time'];?>
%</td>
												<td>
													<?php if ($_smarty_tpl->tpl_vars['status']->value == FALSE) {?>
													<a 
														type="button" 
														class="btn btn-md" 
														<?php if ($_smarty_tpl->tpl_vars['access']->value == null || $_smarty_tpl->tpl_vars['headId']->value == $_smarty_tpl->tpl_vars['departmentId']->value) {?>
														data-toggle="modal" 
														data-lasttime="<?php echo $_smarty_tpl->tpl_vars['foo']->value['time'];?>
" 
														data-employeeid="<?php echo $_smarty_tpl->tpl_vars['foo']->value['employee_id'];?>
" 
														data-employeename="<?php echo $_smarty_tpl->tpl_vars['foo']->value['user_name'];?>
" 
														data-target="#timeDistModal" 
														<?php }?>
														title="Редактировать Данные Распределения Времени"
														<?php if ($_smarty_tpl->tpl_vars['headId']->value != $_smarty_tpl->tpl_vars['departmentId']->value) {?>
														<?php echo $_smarty_tpl->tpl_vars['access']->value;?>

														<?php }?>>
														<i class="glyphicon glyphicon-pencil"></i>
													</a>
													<?php }?>
												</td>
												<td>
													<?php if ($_smarty_tpl->tpl_vars['status']->value == FALSE) {?>
													<a 
														type="button" 
														class="btn btn-md"
														<?php if ($_smarty_tpl->tpl_vars['access']->value == null || $_smarty_tpl->tpl_vars['headId']->value == $_smarty_tpl->tpl_vars['departmentId']->value) {?>
														data-toggle="modal"  
														data-projectname="<?php echo $_smarty_tpl->tpl_vars['projectName']->value;?>
" 
														data-employeeid="<?php echo $_smarty_tpl->tpl_vars['foo']->value['employee_id'];?>
" 
														data-employeename="<?php echo $_smarty_tpl->tpl_vars['foo']->value['user_name'];?>
"
														data-target="#removeModalTime" 
														<?php }?>
														title="Удалить Данные Распределения Времени"
														<?php if ($_smarty_tpl->tpl_vars['headId']->value != $_smarty_tpl->tpl_vars['departmentId']->value) {?>
														<?php echo $_smarty_tpl->tpl_vars['access']->value;?>

														<?php }?>>
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
										<?php if ($_smarty_tpl->tpl_vars['access']->value == null || $_smarty_tpl->tpl_vars['headId']->value == $_smarty_tpl->tpl_vars['departmentId']->value) {?>
										data-toggle="modal" 
										data-countselect="<?php echo $_smarty_tpl->tpl_vars['countArrayEmployeeNamesForDepartmentForSelect']->value;?>
" 
										data-target="#timeDistModal" 
										<?php }?>
										title="Добавить Распределение Времени"
										<?php if ($_smarty_tpl->tpl_vars['headId']->value != $_smarty_tpl->tpl_vars['departmentId']->value) {?>
										<?php echo $_smarty_tpl->tpl_vars['access']->value;?>

										<?php }?>>
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
									<h4 class="modal-title" id="projectModalLabel">Редактировать Данные Проекта</h4>
								</div>
								<form action="/index.php" method="get" onsubmit="diactivePro()">
									<div class="modal-body">
										<div class="form-group">
											<label class="control-label">Название:</label>
											<input 
												name="newName" 
												type="text"
												class="form-control" 
												value="<?php echo $_smarty_tpl->tpl_vars['projectName']->value;?>
"
												required="required">
										</div>
										<div class="form-group">
											<label>Отдел:</label>
											<select 
													id="selectId" 
													name="newDepartmwent" 
													class="form-control select2" 
													style="width: 100%;"
													required="required">
												<?php
$_from = $_smarty_tpl->tpl_vars['arrayDepartmentNamesForSelect']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_foo_1_saved_item = isset($_smarty_tpl->tpl_vars['foo']) ? $_smarty_tpl->tpl_vars['foo'] : false;
$_smarty_tpl->tpl_vars['foo'] = new Smarty_Variable();
$__foreach_foo_1_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
if ($__foreach_foo_1_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['foo']->value) {
$__foreach_foo_1_saved_local_item = $_smarty_tpl->tpl_vars['foo'];
?>
												
												<option value="<?php echo $_smarty_tpl->tpl_vars['foo']->value['department_id'];?>
*-*<?php echo $_smarty_tpl->tpl_vars['foo']->value['department_name'];?>
"><?php echo $_smarty_tpl->tpl_vars['foo']->value['department_name'];?>
</option>
												<?php
$_smarty_tpl->tpl_vars['foo'] = $__foreach_foo_1_saved_local_item;
}
}
if ($__foreach_foo_1_saved_item) {
$_smarty_tpl->tpl_vars['foo'] = $__foreach_foo_1_saved_item;
}
?>
											</select>
										</div>
									</div>
									<div class="modal-footer">
										<div class="input-group hidden">
											<input name="route" type="hidden" value="Project/editProject">
											<input name="editId" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['projectId']->value;?>
">
											<input name="Month" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['selectedMonthForGet']->value;?>
">
											<input name="Year" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['selectedYearForGet']->value;?>
">
										</div>
										<button id="buttonModalSPro" type="button" style="width: 200px" class="btn btn-default pull-left" data-dismiss="modal">Отмена</button>
										<button id="buttonModalFPro" type="submit" style="width: 200px" class="btn btn-primary">Сохранить</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="modal fade" id="timeDistModal" role="dialog" aria-labelledby="timeDistModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title" id="timeDistModalLabel"></h4>
								</div>
								<form action="/index.php" method="get" onsubmit="diactiveTime()">
									<div class="modal-body">
										<div class="form-group" id="employee" >
										</div>
										<div class="modal-form-group">
											<label for="nameProject">Проект</label>
											<input 
												name="projectName" 
												type="text" 
												class="form-control" 
												value="<?php echo $_smarty_tpl->tpl_vars['projectName']->value;?>
" 
												readonly>
										</div>
										<div class="form-group">
											<label for="TimeDistr">Время</label>
											<div class="input-group">
												<input 
													id="TimeDistr"
													name="newTime" 
													type="text" 
													class="form-control" 
													required="required">
												<span class="input-group-addon">%</span>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<div class="input-group hidden">
											<input id="route" name="route" type="hidden" >
											<input name="projectId" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['projectId']->value;?>
">
											<input name="departmentId" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['departmentId']->value;?>
">
											<input name="departmentName" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['departmentName']->value;?>
">
											<input name="Month" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['selectedMonthForGet']->value;?>
">
											<input name="Year" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['selectedYearForGet']->value;?>
">
										</div>
										<button id="buttonModalFTime" type="button" style="width: 200px" class="btn btn-default pull-left" data-dismiss="modal">Отмена</button>
										<button id="buttonModalSTime" type="submit" style="width: 200px" class="btn btn-primary">Сохранить</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="modal fade" id="removeModalPro" tabindex="-1" role="dialog" style="margin: 0 auto;">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title" id="removeModalProLabel">Вы уверены, что хотите удалить данные проекта: <u><b><?php echo $_smarty_tpl->tpl_vars['projectName']->value;?>
</u></b></h4>
								</div>							
								<form action="/index.php" method="get" onsubmit="diactiveRemovePro()">
									<div class="modal-body">
									</div>
									<div class="modal-footer">
										<div class="input-group hidden">
											<input name="route" type="hidden" value="List/removeProject">
											<input name="projectId" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['projectId']->value;?>
">
											<input name="Month" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['selectedMonthForGet']->value;?>
">
											<input name="Year" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['selectedYearForGet']->value;?>
">
										</div>
										<button id="buttonModalFRemovePro" type="button" class="btn btn-default pull-left" data-dismiss="modal" style="width: 200px">Отмена</button>
										<button id="buttonModalSRemovePro" type="submit" class="btn btn-primary" style="width: 200px">Да</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="modal fade" id="removeModalTime" tabindex="-1" role="dialog" style="margin: 0 auto;">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title" id="removeModalTimeLabel"></h4>
								</div>							
								<form action="/index.php" method="get" onsubmit="diactiveRemoveTime()">
									<div class="modal-body">
									</div>
									<div class="modal-footer">
										<div class="input-group hidden">
											<input name="route" type="hidden" value="Employee/removePercent">
											<input id="employeeId" name="employeeId" type="hidden">
											<input name="projectId" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['projectId']->value;?>
">
											<input name="projectName" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['projectName']->value;?>
">
											<input name="departmentId" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['departmentId']->value;?>
">
											<input name="departmentName" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['departmentName']->value;?>
">
											<input name="Month" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['selectedMonthForGet']->value;?>
">
											<input name="Year" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['selectedYearForGet']->value;?>
">
										</div>
										<button id="buttonModalFRemoveTime" type="button" class="btn btn-default pull-left" data-dismiss="modal" style="width: 200px">Отмена</button>
										<button id="buttonModalSRemoveTime" type="submit" class="btn btn-primary" style="width: 200px">Да</button>
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
											<input name="route" type="hidden" value="Project/changeDataStatusForEditing">
											<input name="lastStatus" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['status']->value;?>
">
											<input name="projectId" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['projectId']->value;?>
">
											<input name="projectName" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['projectName']->value;?>
">
											<input name="departmentId" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['departmentId']->value;?>
">
											<input name="departmentName" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['departmentName']->value;?>
">
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
					var departmentId = button.data('departmentid');
					var countSelect = button.data('countselect');
					for (var i = 0; i < countSelect; i++) {
						var val = document.getElementById('selectId').options[i].value;
						valArr = val.split('*-*')
						if (valArr[0] == departmentId){
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
				function diactivePro() {
					document.getElementById('buttonModalSPro').disabled = 1;
					document.getElementById('buttonModalFPro').disabled = 1;
					document.getElementById("nameProject").setAttribute("readonly", "readonly");
				}
			<?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
>
				$('#timeDistModal').on('show.bs.modal', function (event) {
					var button = $(event.relatedTarget);
					var modal = $(this);
					var lasttime = button.data('lasttime');
					var employeeId = button.data('employeeid');
					var employeeName = button.data('employeename');
					var countSelectEmp = button.data('countselect');
					if (employeeName != null){
						modal.find('.modal-title').text('Редактировать Данные Распределения Времени');
						document.getElementById('route').value = 'Project/editPercent';
						$('#employee').html('<label>Сотрудник:</label><input id="employeeName" type="text" class="form-control" readonly><input id="employeeId" name="employeeId" type="hidden">'); 
						document.getElementById('employeeId').value = employeeId;
						document.getElementById('employeeName').value = employeeName;
						document.getElementById('TimeDistr').value = lasttime;
					}else{
						modal.find('.modal-title').text('Новое Распределение Времени');
						document.getElementById('route').value = 'Project/newPercent';
						$('#employee').html('<label>Сотрудник:</label><select id="selectIdEmp" name="employeeId" class="form-control select2" style="width: 100%;" required="required"><?php
$_from = $_smarty_tpl->tpl_vars['arrayEmployeeNamesForDepartmentForSelect']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_foo_2_saved_item = isset($_smarty_tpl->tpl_vars['foo']) ? $_smarty_tpl->tpl_vars['foo'] : false;
$_smarty_tpl->tpl_vars['foo'] = new Smarty_Variable();
$__foreach_foo_2_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
if ($__foreach_foo_2_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['foo']->value) {
$__foreach_foo_2_saved_local_item = $_smarty_tpl->tpl_vars['foo'];
?><option value="<?php echo $_smarty_tpl->tpl_vars['foo']->value['employee_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['foo']->value['user_name'];?>
</option><?php
$_smarty_tpl->tpl_vars['foo'] = $__foreach_foo_2_saved_local_item;
}
}
if ($__foreach_foo_2_saved_item) {
$_smarty_tpl->tpl_vars['foo'] = $__foreach_foo_2_saved_item;
}
$_from = $_smarty_tpl->tpl_vars['arrayEmployeeNamesNotForDepartmentForSelect']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_foo_3_saved_item = isset($_smarty_tpl->tpl_vars['foo']) ? $_smarty_tpl->tpl_vars['foo'] : false;
$_smarty_tpl->tpl_vars['foo'] = new Smarty_Variable();
$__foreach_foo_3_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
if ($__foreach_foo_3_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['foo']->value) {
$__foreach_foo_3_saved_local_item = $_smarty_tpl->tpl_vars['foo'];
?><option value="<?php echo $_smarty_tpl->tpl_vars['foo']->value['employee_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['foo']->value['user_name'];?>
</option><?php
$_smarty_tpl->tpl_vars['foo'] = $__foreach_foo_3_saved_local_item;
}
}
if ($__foreach_foo_3_saved_item) {
$_smarty_tpl->tpl_vars['foo'] = $__foreach_foo_3_saved_item;
}
?></select>'); 
						document.getElementById('TimeDistr').value = null;
						for (var i = 0; i < countSelectEmp; i++) {
							document.getElementById('selectIdEmp').options[i].selected=false;
						}
					}
					$(function () {
						$(".select2").select2({
							modal: true,
							placeholder: "Выберите Сотрудника",
							allowClear: true
						});
					});
				});
			<?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
>
				function diactiveTime() {
					document.getElementById('buttonModalSTime').disabled = 1;
					document.getElementById('buttonModalFTime').disabled = 1;
					document.getElementById("TimeDistr").setAttribute("readonly", "readonly");
				}
			<?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
>
				function diactiveRemovePro() {
					document.getElementById('buttonModalSRemovePro').disabled = 1;
					document.getElementById('buttonModalFRemovePro').disabled = 1;
				}
			<?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
>
				$('#removeModalTime').on('show.bs.modal', function (event) {
					var button = $(event.relatedTarget);
					var modal = $(this);
					var employeeId = button.data('employeeid');
					var projectName = button.data('projectname');
					var employeeName = button.data('employeename');
					modal.find('.modal-title').html('Вы уверены, что хотите удалить данные распредеения времени сотрудника: <u><b>'+employeeName+'</u></b> для проекта: <u><b>'+projectName+'</u></b>');
					document.getElementById('employeeId').value = employeeId;
				});
			<?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
>
				function diactiveRemoveTime() {
					document.getElementById('buttonModalSRemoveTime').disabled = 1;
					document.getElementById('buttonModalFRemoveTime').disabled = 1;
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
					$('#project').DataTable({
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
</html>
<?php }
}
