<?php
/* Smarty version 3.1.28, created on 2016-09-22 18:18:33
  from "/var/www/hr-timetrack-dev/3pty/Smarty/demo/templates/department.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_57e3f649769538_12748052',
  'file_dependency' => 
  array (
    'be0faf38ae70b56dfedeb6ac460b3f1e362a8e9b' => 
    array (
      0 => '/var/www/hr-timetrack-dev/3pty/Smarty/demo/templates/department.tpl',
      1 => 1474556628,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:3pty/Smarty/demo/templates/header.tpl' => 1,
  ),
),false)) {
function content_57e3f649769538_12748052 ($_smarty_tpl) {
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
							<div class="col-xs-12">
								<div class="box">
									<div class="box-header">
										<h3 class="box-title" style="font-size:23px">Отдел: <b><?php echo $_smarty_tpl->tpl_vars['departmentName']->value;?>
</b>	
											<?php if ($_smarty_tpl->tpl_vars['status']->value == FALSE) {?>
											<a 
												type="button" 
												class="btn btn-md" 
												<?php if ($_smarty_tpl->tpl_vars['accessDep']->value == null) {?>
												data-toggle="modal" 
												data-target="#departmentModal"
												<?php }?>
												title="Редактировать Данные Отдела"
												<?php echo $_smarty_tpl->tpl_vars['accessDep']->value;?>
>
												<i class="glyphicon glyphicon-pencil"></i>
											</a>
											<a 
												type="button" 
												class="btn btn-md" 
												<?php if ($_smarty_tpl->tpl_vars['accessDep']->value == null) {?>
												data-toggle="modal" 
												data-target="#removeModalDep" 
												<?php }?>
												title="Удалить Данные Отдела"
												<?php echo $_smarty_tpl->tpl_vars['accessDep']->value;?>
>
												<i class="glyphicon glyphicon-trash"></i>
											</a>											
											<?php }?>
										</h3>
									</div>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="box">
									<div class="box-header">
										<h3 class="box-title" style="font-size:20px">Сотрудники</h3>	
									</div>
									<div class="box-body">
										<table id="employee" class="table table-bordered table-striped">
											<thead>
												<tr>
													<th style="width: 5px"></th>
													<th>ФИО</th>
													<th style="width: 25px"></th>
													<th style="width: 18px"></th>
													<th style="width: 18px"></th>
												</tr>
											</thead>
											<tbody>
											<?php if ($_smarty_tpl->tpl_vars['arrayEmployeeNamesForDepartment']->value != null) {?>
											<?php
$_from = $_smarty_tpl->tpl_vars['arrayEmployeeNamesForDepartment']->value;
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
													<td><?php if ($_smarty_tpl->tpl_vars['foo']->value['summ'] < 100) {?><i class="glyphicon glyphicon-info-sign text-blue"></i><?php }
if ($_smarty_tpl->tpl_vars['foo']->value['summ'] == 100) {?><i class="glyphicon glyphicon-ok-sign text-green"></i><?php }
if ($_smarty_tpl->tpl_vars['foo']->value['summ'] > 100) {?><i class="glyphicon glyphicon-exclamation-sign text-red" ></i><?php }?></td>
													<td>
														<a 
															href="/index.php
																?route=Employee/viewEmployee
																&employeeId=<?php echo $_smarty_tpl->tpl_vars['foo']->value['employee_id'];?>

																&employeeName=<?php echo $_smarty_tpl->tpl_vars['foo']->value['user_name'];?>

																&employeeLogin=<?php echo $_smarty_tpl->tpl_vars['foo']->value['user_id'];?>

																&departmentId=<?php echo $_smarty_tpl->tpl_vars['departmentId']->value;?>

																&departmentName=<?php echo $_smarty_tpl->tpl_vars['departmentName']->value;?>

																&Month=<?php echo $_smarty_tpl->tpl_vars['selectedMonthForGet']->value;?>

																&Year=<?php echo $_smarty_tpl->tpl_vars['selectedYearForGet']->value;?>
">
															<?php echo $_smarty_tpl->tpl_vars['foo']->value['user_name'];?>

														</a>
													</td>
													<td><?php echo $_smarty_tpl->tpl_vars['foo']->value['summ'];?>
%</td>
													<td>
														<?php if ($_smarty_tpl->tpl_vars['status']->value == FALSE) {?>
														<a 
															type="button" 
															class="btn btn-md" 
															<?php if ($_smarty_tpl->tpl_vars['accessDep']->value == null) {?>
															data-toggle="modal" 
															data-editid="<?php echo $_smarty_tpl->tpl_vars['foo']->value['employee_id'];?>
" 
															data-lastname="<?php echo $_smarty_tpl->tpl_vars['foo']->value['user_name'];?>
" 
															data-lastlogin="<?php echo $_smarty_tpl->tpl_vars['foo']->value['user_id'];?>
" 
															data-departmentid="<?php echo $_smarty_tpl->tpl_vars['departmentId']->value;?>
" 
															data-countselect="<?php echo $_smarty_tpl->tpl_vars['countArrayDepartmentNamesForSelect']->value;?>
" 
															data-target="#employeeModal" 
															<?php }?>
															title="Редактировать Данные Сотрудника"
															<?php echo $_smarty_tpl->tpl_vars['accessDep']->value;?>
>
															<i class="glyphicon glyphicon-pencil"></i>
														</a>
														<?php }?>
													</td>
													<td>
														<?php if ($_smarty_tpl->tpl_vars['status']->value == FALSE) {?>
														<a 
															type="button" 
															class="btn btn-md" 
															<?php if ($_smarty_tpl->tpl_vars['accessDep']->value == null) {?>
															data-toggle="modal" 
															data-employeeid="<?php echo $_smarty_tpl->tpl_vars['foo']->value['employee_id'];?>
" 
															data-employeename="<?php echo $_smarty_tpl->tpl_vars['foo']->value['user_name'];?>
" 
															data-target="#removeModalEmp" 
															<?php }?>																
															title="Удалить Данные Сотрудника"
															<?php echo $_smarty_tpl->tpl_vars['accessDep']->value;?>
>
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
											<?php if ($_smarty_tpl->tpl_vars['accessDep']->value == null) {?>
											data-toggle="modal" 
											data-departmentid="<?php echo $_smarty_tpl->tpl_vars['departmentId']->value;?>
" 
											data-countselect="<?php echo $_smarty_tpl->tpl_vars['countArrayDepartmentNamesForSelect']->value;?>
" 
											data-target="#employeeModal" 
											<?php }?>
											title="Добавить Сотрудника"
											<?php echo $_smarty_tpl->tpl_vars['accessDep']->value;?>
>
											<i class="glyphicon glyphicon-plus"></i>
										</a>
										<?php }?>
									</div>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="box">
									<div class="box-header">
										<h3 class="box-title" style="font-size:20px">Проекты</h3>	
									</div>
									<div class="box-body">
										<table id="project" class="table table-bordered table-striped">
											<thead>
												<tr>
													<th>Название</th>
													<th style="width: 18px"></th>
													<th style="width: 18px"></th>
												</tr>
											</thead>
											<tbody>
											<?php if ($_smarty_tpl->tpl_vars['arrayProjectNamesForDepartment']->value != null) {?>
											<?php
$_from = $_smarty_tpl->tpl_vars['arrayProjectNamesForDepartment']->value;
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
												<tr>
													<td>
														<a 
															href="/index.php
																?route=Project/viewProject
																&projectId=<?php echo $_smarty_tpl->tpl_vars['foo']->value['project_id'];?>

																&projectName=<?php echo $_smarty_tpl->tpl_vars['foo']->value['project_name'];?>

																&departmentId=<?php echo $_smarty_tpl->tpl_vars['departmentId']->value;?>

																&departmentName=<?php echo $_smarty_tpl->tpl_vars['departmentName']->value;?>

																&Month=<?php echo $_smarty_tpl->tpl_vars['selectedMonthForGet']->value;?>

																&Year=<?php echo $_smarty_tpl->tpl_vars['selectedYearForGet']->value;?>
">
															<?php echo $_smarty_tpl->tpl_vars['foo']->value['project_name'];?>

														</a>
													</td>
													<td>
														<?php if ($_smarty_tpl->tpl_vars['status']->value == FALSE) {?>
														<a 
															type="button" 
															class="btn btn-md" 
															<?php if ($_smarty_tpl->tpl_vars['accessPro']->value == null || $_smarty_tpl->tpl_vars['headId']->value == $_smarty_tpl->tpl_vars['departmentId']->value) {?>
															data-toggle="modal" 
															data-editid="<?php echo $_smarty_tpl->tpl_vars['foo']->value['project_id'];?>
" 
															data-lastname="<?php echo $_smarty_tpl->tpl_vars['foo']->value['project_name'];?>
" 
															data-departmentid="<?php echo $_smarty_tpl->tpl_vars['departmentId']->value;?>
" 
															data-countselect="<?php echo $_smarty_tpl->tpl_vars['countArrayDepartmentNamesForSelect']->value;?>
" 
															data-target="#projectModal" 
															<?php }?>
															title="Редактировать Данные Проекта"
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
															data-target="#removeModalPro" 
															<?php }?>
															title="Удалить Данные Проекта"
															<?php if ($_smarty_tpl->tpl_vars['headId']->value != $_smarty_tpl->tpl_vars['departmentId']->value) {?>
															<?php echo $_smarty_tpl->tpl_vars['accessPro']->value;?>

															<?php }?>>
															<i class="glyphicon glyphicon-trash"></i>
														</a>
														<?php }?>
													</td>
												</tr>
											<?php
$_smarty_tpl->tpl_vars['foo'] = $__foreach_foo_1_saved_local_item;
}
}
if ($__foreach_foo_1_saved_item) {
$_smarty_tpl->tpl_vars['foo'] = $__foreach_foo_1_saved_item;
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
											data-departmentid="<?php echo $_smarty_tpl->tpl_vars['departmentId']->value;?>
" 
											data-countselect="<?php echo $_smarty_tpl->tpl_vars['countArrayDepartmentNamesForSelect']->value;?>
" 
											data-target="#projectModal" 
											<?php }?>
											title="Добавить Проект"
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
					</div>
					<div class="modal fade" id="employeeModal" role="dialog" aria-labelledby="employeeModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title" id="employeeModalLabel"></h4>
								</div>
								<form action="/index.php" method="get" onsubmit="diactiveEmp()">
									<div class="modal-body">
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
										<div class="form-group">
											<label>Логин:</label>
											<input 
												id="loginEmployee"
												name="newLogin" 
												type="text" 
												class="form-control"
												required="required">
										</div>
										<div class="form-group">
											<label>Отдел:</label>
											<select 
												id="selectIdEmp" 
												name="newDepartmwent" 
												class="form-control select2" 
												style="width: 100%;"
												required="required">
												<?php
$_from = $_smarty_tpl->tpl_vars['arrayDepartmentNamesForSelect']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_foo_2_saved_item = isset($_smarty_tpl->tpl_vars['foo']) ? $_smarty_tpl->tpl_vars['foo'] : false;
$_smarty_tpl->tpl_vars['foo'] = new Smarty_Variable();
$__foreach_foo_2_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
if ($__foreach_foo_2_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['foo']->value) {
$__foreach_foo_2_saved_local_item = $_smarty_tpl->tpl_vars['foo'];
?>
												
												<option value="<?php echo $_smarty_tpl->tpl_vars['foo']->value['department_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['foo']->value['department_name'];?>
</option>
												<?php
$_smarty_tpl->tpl_vars['foo'] = $__foreach_foo_2_saved_local_item;
}
}
if ($__foreach_foo_2_saved_item) {
$_smarty_tpl->tpl_vars['foo'] = $__foreach_foo_2_saved_item;
}
?>
											</select>
										</div>
									</div>
									<div class="modal-footer">
										<div class="input-group hidden">
											<input id="routeEmp" name="route" type="hidden">
											<input id="editIdEmp" name="editId" type="hidden">
											<input name="departmentId" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['departmentId']->value;?>
">
											<input name="departmentName" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['departmentName']->value;?>
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
					<div class="modal fade" id="projectModal" role="dialog" aria-labelledby="projectModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title" id="projectModalLabel"></h4>
								</div>
								<form action="/index.php" method="get" onsubmit="diactivePro()">
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
												id="selectIdPro" 
												name="newDepartmwent" 
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
											<input id="routePro" name="route" type="hidden" >
											<input id="editIdPro" name="editId" type="hidden">
											<input name="departmentId" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['departmentId']->value;?>
">
											<input name="departmentName" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['departmentName']->value;?>
">
											<input name="Month" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['selectedMonthForGet']->value;?>
">
											<input name="Year" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['selectedYearForGet']->value;?>
">		
										</div>
										<button id="buttonModalFPro" type="button" style="width: 200px" class="btn btn-default pull-left" data-dismiss="modal">Отмена</button>
										<button id="buttonModalSPro" type="submit" style="width: 200px" class="btn btn-primary">Сохранить</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="modal fade" id="departmentModal" tabindex="-1" role="dialog" aria-labelledby="departmentModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title" id="departmentModalLabel">Редактировать Данные Отдела</h4>
								</div>
								<form action="/index.php" method="get" onsubmit="diactiveDep()">
									<div class="modal-body">
										<div class="form-group">
											<label class="control-label">Название:</label>
											<input 
												name="newName" 
												type="text" 
												class="form-control" 
												value="<?php echo $_smarty_tpl->tpl_vars['departmentName']->value;?>
"
												required="required">
										</div>
									</div>
									<div class="modal-footer">
										<div class="input-group hidden">
											<input name="route" type="hidden" value="Department/editDepartment">
											<input name="editId" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['departmentId']->value;?>
">
											<input name="Month" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['selectedMonthForGet']->value;?>
">
											<input name="Year" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['selectedYearForGet']->value;?>
">
										</div>
										<button id="buttonModalFDep" type="button" style="width: 200px" class="btn btn-default pull-left" data-dismiss="modal">Отмена</button>
										<button id="buttonModalSDep" type="submit" style="width: 200px" class="btn btn-primary">Сохранить</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="modal fade" id="removeModalDep" tabindex="-1" role="dialog" style="margin: 0 auto;">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title" >Вы уверены, что хотите удалить данные отдела: <u><b><?php echo $_smarty_tpl->tpl_vars['departmentName']->value;?>
</u></b></h4>
								</div>							
								<form action="/index.php" method="get" onsubmit="diactiveRemoveDep()">
									<div class="modal-body">
									</div>
									<div class="modal-footer">
										<div class="input-group hidden">
											<input name="route" type="hidden" value="List/removeDepartment">
											<input name="departmentId" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['departmentId']->value;?>
">
											<input name="Month" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['selectedMonthForGet']->value;?>
">
											<input name="Year" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['selectedYearForGet']->value;?>
">
										</div>
										<button id="buttonModalFRemoveDep" type="button" class="btn btn-default pull-left" data-dismiss="modal" style="width: 200px">Отмена</button>
										<button id="buttonModalSRemoveDep" type="submit" class="btn btn-primary" style="width: 200px">Да</button>
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
									<h4 class="modal-title" id="removeModalEmpLabel"></h4>
								</div>							
								<form action="/index.php" method="get" onsubmit="diactiveRemoveEmp()">
									<div class="modal-body">
									</div>
									<div class="modal-footer">
										<div class="input-group hidden">
											<input name="route" type="hidden" value="Department/removeEmployee">
											<input id="employeeId" name="employeeId" type="hidden">
											<input name="departmentId" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['departmentId']->value;?>
">
											<input name="departmentName" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['departmentName']->value;?>
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
					<div class="modal fade" id="removeModalPro" tabindex="-1" role="dialog" style="margin: 0 auto;">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title" id="removeModalProLabel"></h4>
								</div>							
								<form action="/index.php" method="get" onsubmit="diactiveRemovePro()">
									<div class="modal-body">
									</div>
									<div class="modal-footer">
										<div class="input-group hidden">
											<input name="route" type="hidden" value="Department/removeProject">
											<input id="projectId" name="projectId" type="hidden">
											<input name="departmentId" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['departmentId']->value;?>
">
											<input name="departmentName" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['departmentName']->value;?>
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
											<input name="route" type="hidden" value="Department/changeDataStatusForEditing">
											<input name="lastStatus" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['status']->value;?>
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
				function diactiveDep() {
					document.getElementById('buttonModalSDep').disabled = 1;
					document.getElementById('buttonModalFDep').disabled = 1;
					document.getElementById("nameDepartment").setAttribute("readonly", "readonly");
				}
			<?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
>
				$('#projectModal').on('show.bs.modal', function (event) {
					var button = $(event.relatedTarget);
					var modal = $(this);
					var editId = button.data('editid');
					var lastName = button.data('lastname');
					var departmentId = button.data('departmentid');
					var countSelect = button.data('countselect');
					for (var i = 0; i < countSelect; i++) {
						var val = document.getElementById('selectIdPro').options[i].value;
						if (val == departmentId){
							document.getElementById('selectIdPro').options[i].selected=true;
						}else{
							document.getElementById('selectIdPro').options[i].selected=false;
						}
					}
					if (editId != null){
						modal.find('.modal-title').text('Редактировать Данные Проекта');
						document.getElementById('routePro').value = 'Department/editProject';
						document.getElementById('nameProject').value = lastName;
						document.getElementById('editIdPro').value = editId;
						
					}else{
						modal.find('.modal-title').text('Новый Проект');
						document.getElementById('routePro').value = 'Department/newProject';
						document.getElementById('nameProject').value = null;
						document.getElementById('editIdPro').value = null;
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
				$('#employeeModal').on('show.bs.modal', function (event) {
					var button = $(event.relatedTarget);
					var modal = $(this);
					var editId = button.data('editid');
					var lastName = button.data('lastname');
					var lastLogin = button.data('lastlogin');
					var departmentId = button.data('departmentid');
					var countSelect = button.data('countselect');
					for (var i = 0; i < countSelect; i++) {
						var val = document.getElementById('selectIdEmp').options[i].value;
						if (val == departmentId){
								document.getElementById('selectIdEmp').options[i].selected=true;
						}else{
								document.getElementById('selectIdEmp').options[i].selected=false;
						}
					}
					if (editId != null){
						modal.find('.modal-title').text('Редактировать Данные Сотрудника');
						document.getElementById('routeEmp').value = 'Department/editEmployee';
						document.getElementById('editIdEmp').value = editId;
						lastName=lastName.split(' ');
						document.getElementById('nameEmployeeF').value = lastName[1];
						document.getElementById('nameEmployeeS').value = lastName[0];
						document.getElementById('nameEmployeeM').value = lastName[2];
						document.getElementById('loginEmployee').value = lastLogin;
					}else{
						modal.find('.modal-title').text('Новый Сотрудник');
						document.getElementById('routeEmp').value = 'Department/newEmployee';
						document.getElementById('editIdEmp').value = null;
						document.getElementById('nameEmployeeF').value = null;
						document.getElementById('nameEmployeeS').value = null;
						document.getElementById('nameEmployeeM').value = null;
						document.getElementById('loginEmployee').value = null;
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
				function diactiveEmp() {
					document.getElementById('buttonModalSEmp').disabled = 1;
					document.getElementById('buttonModalFEmp').disabled = 1;
					document.getElementById("loginEmployee").setAttribute("readonly", "readonly");
					document.getElementById("nameEmployeeM").setAttribute("readonly", "readonly");
					document.getElementById("nameEmployeeF").setAttribute("readonly", "readonly");
					document.getElementById("nameEmployeeS").setAttribute("readonly", "readonly");
				}
			<?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
>
				function diactiveRemoveDep() {
					document.getElementById('buttonModalSRemoveDep').disabled = 1;
					document.getElementById('buttonModalFRemoveDep').disabled = 1;
				}
			<?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
>
				$('#removeModalEmp').on('show.bs.modal', function (event) {
					var button = $(event.relatedTarget);
					var modal = $(this);
					var employeeId = button.data('employeeid');
					var employeeName = button.data('employeename');
					modal.find('.modal-title').html('Вы уверены, что хотите удалить данные сотрудника: <u><b>'+employeeName+'</u></b>');
					document.getElementById('employeeId').value = employeeId;
				});
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
				$('#removeModalPro').on('show.bs.modal', function (event) {
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
				function diactiveRemovePro() {
					document.getElementById('buttonModalSRemovePro').disabled = 1;
					document.getElementById('buttonModalFRemovePro').disabled = 1;
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
