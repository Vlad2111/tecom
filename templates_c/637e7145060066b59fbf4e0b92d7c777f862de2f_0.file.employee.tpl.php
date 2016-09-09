<?php
/* Smarty version 3.1.28, created on 2016-09-08 18:45:57
  from "/var/www/hr-timetrack-dev/3pty/Smarty/demo/templates/employee.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_57d187b51c12d6_84355888',
  'file_dependency' => 
  array (
    '637e7145060066b59fbf4e0b92d7c777f862de2f' => 
    array (
      0 => '/var/www/hr-timetrack-dev/3pty/Smarty/demo/templates/employee.tpl',
      1 => 1473166564,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:3pty/Smarty/demo/templates/header.tpl' => 1,
  ),
),false)) {
function content_57d187b51c12d6_84355888 ($_smarty_tpl) {
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
									<h3 class="box-title" style="font-size:23px">Сотрудник: <?php echo $_smarty_tpl->tpl_vars['employeeName']->value;?>

										<?php if ($_smarty_tpl->tpl_vars['status']->value == FALSE) {?>
										<a 
											type="button" 
											class="btn btn-md" 
											<?php if ($_smarty_tpl->tpl_vars['accessEmp']->value == null) {?>	
											data-toggle="modal" 
											data-lastname="<?php echo $_smarty_tpl->tpl_vars['employeeName']->value;?>
"
											data-departmentid="<?php echo $_smarty_tpl->tpl_vars['departmentId']->value;?>
" 
											data-countselect="<?php echo $_smarty_tpl->tpl_vars['countArrayDepartmentNamesForSelect']->value;?>
" 
											data-target="#employeeModal" 
											<?php }?>
											title="Редактировать Данные Сотрудника"
											<?php echo $_smarty_tpl->tpl_vars['accessEmp']->value;?>
>
											<i class="glyphicon glyphicon-pencil"></i>
										</a>
										<a 
											type="button" 
											class="btn btn-md" 
											<?php if ($_smarty_tpl->tpl_vars['accessEmp']->value == null) {?>	
											data-toggle="modal"  
											data-target="#removeModalEmp" 
											<?php }?>
											title="Удалить Данные Сотрудника"
											<?php echo $_smarty_tpl->tpl_vars['accessEmp']->value;?>
>
											<i class="glyphicon glyphicon-trash"></i>
										</a>
										<?php }?>
									</h3>
									<p style="text-align:justify;">
										<table class="text" style="width:100%; border-spacing:0;">
											<tr style="vertical-align: top;">
												<td style="text-align: left;">(Отдел: <?php echo $_smarty_tpl->tpl_vars['departmentName']->value;?>
)</td>
												<td style="text-align: right;">
													<?php echo $_smarty_tpl->tpl_vars['employeePercent']->value;?>
%
													<?php if ($_smarty_tpl->tpl_vars['employeePercent']->value < 100) {?>
														<i class="glyphicon glyphicon-info-sign text-blue"></i>
														Время не распределено до конца
														<i class="glyphicon glyphicon-info-sign text-blue"></i>
													<?php }?>
													<?php if ($_smarty_tpl->tpl_vars['employeePercent']->value == 100) {?>
														<i class="glyphicon glyphicon-ok-sign text-green"></i>
														Время распределено
														<i class="glyphicon glyphicon-ok-sign text-green"></i>
													<?php }?>
													<?php if ($_smarty_tpl->tpl_vars['employeePercent']->value > 100) {?>
														<i class="glyphicon glyphicon-exclamation-sign text-red" ></i>
														Ошибка
														<i class="glyphicon glyphicon-exclamation-sign text-red" ></i>
													<?php }?>	
												</td>
											</tr>
										</table>
									</p>									
								</div>
								<div class="box-body">
									<table id="employee" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>Название Проекта</th>
												<th>Отдел</th>
												<th style="width:20px">Занятость</th>
												<th style="width:18px"></th>
												<th style="width:18px"></th>
											</tr>
										</thead>
										<tbody>
										<?php if ($_smarty_tpl->tpl_vars['arrayEmployeeInfo']->value != null) {?>
										<?php
$_from = $_smarty_tpl->tpl_vars['arrayEmployeeInfo']->value;
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
												<td><?php echo $_smarty_tpl->tpl_vars['foo']->value['time'];?>
%</td>
												<td>
													<?php if ($_smarty_tpl->tpl_vars['status']->value == FALSE) {?>
													<a 
														type="button" 
														class="btn btn-md" 
														<?php if ($_smarty_tpl->tpl_vars['accessPro']->value == null || $_smarty_tpl->tpl_vars['headId']->value == $_smarty_tpl->tpl_vars['departmentId']->value) {?>
														data-toggle="modal" 
														data-lasttime="<?php echo $_smarty_tpl->tpl_vars['foo']->value['time'];?>
" 
														data-projectid="<?php echo $_smarty_tpl->tpl_vars['foo']->value['project_id'];?>
" 
														data-projectname="<?php echo $_smarty_tpl->tpl_vars['foo']->value['project_name'];?>
" 
														data-target="#timeDistModal" 
														<?php }?>
														title="Редактировать Данные Распределения Времени"
														<?php if ($_smarty_tpl->tpl_vars['headId']->value != $_smarty_tpl->tpl_vars['departmentId']->value) {?>
														<?php echo $_smarty_tpl->tpl_vars['accessPro']->value;?>

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
														<?php if ($_smarty_tpl->tpl_vars['accessPro']->value == null || $_smarty_tpl->tpl_vars['headId']->value == $_smarty_tpl->tpl_vars['departmentId']->value) {?>
														data-toggle="modal"  
														data-projectid="<?php echo $_smarty_tpl->tpl_vars['foo']->value['project_id'];?>
"
														data-projectname="<?php echo $_smarty_tpl->tpl_vars['foo']->value['project_name'];?>
" 
														data-employeename="<?php echo $_smarty_tpl->tpl_vars['employeeName']->value;?>
"
														data-target="#removeModalTime" 
														<?php }?>
														title="Удалить Данные Распределения Времени"
														<?php if ($_smarty_tpl->tpl_vars['headId']->value != $_smarty_tpl->tpl_vars['departmentId']->value) {?>
														<?php echo $_smarty_tpl->tpl_vars['accessPro']->value;?>

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
										<?php if ($_smarty_tpl->tpl_vars['accessPro']->value == null || $_smarty_tpl->tpl_vars['headId']->value == $_smarty_tpl->tpl_vars['departmentId']->value) {?>
										data-toggle="modal" 
										data-countselect="<?php echo $_smarty_tpl->tpl_vars['countArrayProjectNamesForSelect']->value;?>
" 
										data-target="#timeDistModal" 
										<?php }?>
										title="Добавить Распределение Времени"
										<?php if ($_smarty_tpl->tpl_vars['headId']->value != $_smarty_tpl->tpl_vars['departmentId']->value) {?>
										<?php echo $_smarty_tpl->tpl_vars['accessPro']->value;?>

										<?php }?>>
										<i class="glyphicon glyphicon-plus"></i>
									</a>
									<?php }?>
								</div>
							</div>
						</div>
					</div>
					<div class="modal fade" id="employeeModal" role="dialog" aria-labelledby="employeeModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title" id="employeeModalLabel">Редактировать Данные Сотрудника</h4>
								</div>
								<form action="/index.php" method="get">
									<div class="modal-body">
										<div class="modal-form-group">
											<div class="row">
												<div class="col-xs-4">
													<label for="nameEmployeeS">Фамилия</label>
													<input 
														id="nameEmployeeS" 
														name="nameEmployeeS"
														type="text" 
														class="form-control" 
														required="required">
												</div>
												<div class="col-xs-4">
													<label for="nameEmployeeF">Имя</label>
													<input 
														id="nameEmployeeF" 
														name="nameEmployeeF" 
														type="text" 
														class="form-control" 
														required="required">
												</div>
												<div class="col-xs-4">
													<label for="nameEmployeeM">Отчество</label>
													<input 
														id="nameEmployeeM" 
														name="nameEmployeeM"
														type="text" 
														class="form-control"
														required="required">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label>Логин:</label>
											<input 
												id="newLogin"
												name="newLogin" 
												type="text" 
												class="form-control" 
												value="<?php echo $_smarty_tpl->tpl_vars['employeeLogin']->value;?>
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
											<input name="route" type="hidden" value="Employee/editEmployee">
											<input name="editId" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['employeeId']->value;?>
">
											<input name="Month" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['selectedMonthForGet']->value;?>
">
											<input name="Year" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['selectedYearForGet']->value;?>
">
										</div>
										<button id="buttonModalFEmp" type="button" style="width: 200px" class="btn btn-default pull-left" data-dismiss="modal">Отмена</button>
										<button id="buttonModalSEmp" type="submit" style="width: 200px" class="btn btn-primary">Сохранить</button>
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
										<div class="modal-form-group">
											<label for="nameEmployee">Сотрудник</label>
											<input 
												name="employeeName" 
												type="text" 
												class="form-control" 
												value="<?php echo $_smarty_tpl->tpl_vars['employeeName']->value;?>
" 
												readonly>
										</div>
										<div class="form-group" id="project">
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
											<input name="employeeId" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['employeeId']->value;?>
">
											<input name="employeeLogin" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['employeeLogin']->value;?>
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
					<div class="modal fade" id="removeModalEmp" tabindex="-1" role="dialog" style="margin: 0 auto;">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title" id="removeModalEmpLabel">Вы уверены, что хотите удалить данные сотрудника: <u><b><?php echo $_smarty_tpl->tpl_vars['employeeName']->value;?>
</u></b></h4>
								</div>							
								<form action="/index.php" method="get" onsubmit="diactiveRemoveEmp()">
									<div class="modal-body">
									</div>
									<div class="modal-footer">
										<div class="input-group hidden">
											<input name="route" type="hidden" value="List/removeEmployee">
											<input name="employeeId" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['employeeId']->value;?>
">
											<input name="Month" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['selectedMonthForGet']->value;?>
">
											<input name="Year" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['selectedYearForGet']->value;?>
">
										</div>
										<button id="buttonModalFRemoveEmp" type="button" class="btn btn-default pull-left" data-dismiss="modal" style="width: 200px">Отмена</button>
										<button id="buttonModalSRemoveEmp" type="submit" class="btn btn-primary" style="width: 200px">Да</button>
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
											<input name="employeeId" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['employeeId']->value;?>
">
											<input id="projectId" name="projectId" type="hidden">
											<input name="employeeName" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['employeeName']->value;?>
">
											<input name="employeeLogin" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['employeeLogin']->value;?>
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
											<input name="route" type="hidden" value="Employee/changeDataStatusForEditing">
											<input name="lastStatus" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['status']->value;?>
">
											<input name="employeeId" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['employeeId']->value;?>
">
											<input name="employeeName" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['employeeName']->value;?>
">
											<input name="employeeLogin" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['employeeLogin']->value;?>
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
				$('#employeeModal').on('show.bs.modal', function (event) {
					var button = $(event.relatedTarget);
					var modal = $(this);
					var lastName = button.data('lastname');
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
					lastName=lastName.split(' ');
					document.getElementById('nameEmployeeF').value = lastName[1];
					document.getElementById('nameEmployeeS').value = lastName[0];
					document.getElementById('nameEmployeeM').value = lastName[2];
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
				function diactiveEmp() {
					document.getElementById('buttonModalSEmp').disabled = 1;
					document.getElementById('buttonModalFEmp').disabled = 1;
					document.getElementById("nameEmployeeF").setAttribute("readonly", "readonly");
					document.getElementById("nameEmployeeS").setAttribute("readonly", "readonly");
					document.getElementById("nameEmployeeM").setAttribute("readonly", "readonly");
					document.getElementById("newLogin").setAttribute("readonly", "readonly");
				}
			<?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
>
				$('#timeDistModal').on('show.bs.modal', function (event) {
					var button = $(event.relatedTarget);
					var modal = $(this);
					var lasttime = button.data('lasttime');
					var projectId = button.data('projectid');
					var projectName = button.data('projectname');
					var countSelectPro = button.data('countselect');
					if (projectName != null){
						modal.find('.modal-title').text('Редактировать Данные Распределения Времени');
						document.getElementById('route').value = 'Project/editPercent';
						$('#project').html('<label>Проект:</label><input id="projectName" type="text" class="form-control" readonly><input id="projectId" name="projectId" type="hidden">'); 
						document.getElementById('projectId').value = projectId;
						document.getElementById('projectName').value = projectName;
						document.getElementById('TimeDistr').value = lasttime;
					}else{
						modal.find('.modal-title').text('Новое Распределение Времени');
						document.getElementById('route').value = 'Project/newPercent';
						$('#project').html('<label>Проект:</label><select id="selectIdPro" name="projectId" class="form-control select2" style="width: 100%;" required="required"><?php
$_from = $_smarty_tpl->tpl_vars['arrayProjectNamesForDepartmentForSelect']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_foo_2_saved_item = isset($_smarty_tpl->tpl_vars['foo']) ? $_smarty_tpl->tpl_vars['foo'] : false;
$_smarty_tpl->tpl_vars['foo'] = new Smarty_Variable();
$__foreach_foo_2_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
if ($__foreach_foo_2_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['foo']->value) {
$__foreach_foo_2_saved_local_item = $_smarty_tpl->tpl_vars['foo'];
?><option value="<?php echo $_smarty_tpl->tpl_vars['foo']->value['project_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['foo']->value['project_name'];?>
</option><?php
$_smarty_tpl->tpl_vars['foo'] = $__foreach_foo_2_saved_local_item;
}
}
if ($__foreach_foo_2_saved_item) {
$_smarty_tpl->tpl_vars['foo'] = $__foreach_foo_2_saved_item;
}
$_from = $_smarty_tpl->tpl_vars['arrayProjectNamesNotForDepartmentForSelect']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_foo_3_saved_item = isset($_smarty_tpl->tpl_vars['foo']) ? $_smarty_tpl->tpl_vars['foo'] : false;
$_smarty_tpl->tpl_vars['foo'] = new Smarty_Variable();
$__foreach_foo_3_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
if ($__foreach_foo_3_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['foo']->value) {
$__foreach_foo_3_saved_local_item = $_smarty_tpl->tpl_vars['foo'];
?><option value="<?php echo $_smarty_tpl->tpl_vars['foo']->value['project_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['foo']->value['project_name'];?>
</option><?php
$_smarty_tpl->tpl_vars['foo'] = $__foreach_foo_3_saved_local_item;
}
}
if ($__foreach_foo_3_saved_item) {
$_smarty_tpl->tpl_vars['foo'] = $__foreach_foo_3_saved_item;
}
?></select>'); 
						document.getElementById('TimeDistr').value = null;
						for (var i = 0; i < countSelectPro; i++) {
							document.getElementById('selectIdPro').options[i].selected=false;
						}
					}
					$(function () {
						$(".select2").select2({
							modal: true,
							placeholder: "Выберите проект",
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
				function diactiveRemoveEmp() {
					document.getElementById('buttonModalSRemoveEmp').disabled = 1;
					document.getElementById('buttonModalFRemoveEmp').disabled = 1;
				}
			<?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
>
				$('#removeModalTime').on('show.bs.modal', function (event) {
					var button = $(event.relatedTarget);
					var modal = $(this);
					var projectId = button.data('projectid');
					var projectName = button.data('projectname');
					var employeeName = button.data('employeename');
					modal.find('.modal-title').html('Вы уверены, что хотите удалить данные распредеения времени сотрудника: <u><b>'+employeeName+'</u></b> для проекта: <u><b>'+projectName+'</u></b>');
					document.getElementById('projectId').value = projectId;
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
					$('#employee').DataTable({
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
