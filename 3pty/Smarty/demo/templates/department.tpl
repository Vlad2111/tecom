<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Tecomgroup | {$title}</title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			{include file='3pty/Smarty/demo/templates/header.tpl'}
			<div class="content-wrapper">
				<section class="content">
					<div class="row">
						<div class="col-xs-12">
						{if $statusEditing != null}
						{$statusEditing}
						{/if}
							<div class="col-xs-12">
								<div class="box">
									<div class="box-header">
										<h3 class="box-title" style="font-size:23px">Отдел: {$departmentName}	
											{if $status == FALSE}
											<a 
												type="button" 
												class="btn btn-md" 
												{if $accessDep == null}
												data-toggle="modal" 
												data-target="#departmentModal"
												{/if}
												title="Редактировать Данные Отдела"
												{$accessDep}>
												<i class="glyphicon glyphicon-pencil"></i>
											</a>
											<a 
												type="button" 
												class="btn btn-md" 
												{if $accessDep == null}
												data-toggle="modal" 
												data-target="#removeModalDep" 
												{/if}
												title="Удалить Данные Отдела"
												{$accessDep}>
												<i class="glyphicon glyphicon-trash"></i>
											</a>											
											{/if}
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
											{if $arrayEmployeeNamesForDepartment!=null}
											{foreach from=$arrayEmployeeNamesForDepartment item=foo}
												<tr>
													<td>{if $foo.summ<100}<i class="glyphicon glyphicon-info-sign text-blue"></i>{/if}{if $foo.summ==100}<i class="glyphicon glyphicon-ok-sign text-green"></i>{/if}{if $foo.summ>100}<i class="glyphicon glyphicon-exclamation-sign text-red" ></i>{/if}</td>
													<td>
														<a 
															href="/index.php
																?route=Employee/viewEmployee
																&employeeId={$foo.employee_id}
																&employeeName={$foo.user_name}
																&employeeLogin={$foo.user_id}
																&departmentId={$departmentId}
																&departmentName={$departmentName}
																&nameUser={$name}
																&roleUser={$role}
																&headId={$headId}
																&roleIdUser={$roleId}
																&Month={$selectedMonthForGet}
																&Year={$selectedYearForGet}">
															{$foo.user_name}
														</a>
													</td>
													<td>{$foo.summ}%</td>
													<td>
														{if $status == FALSE}
														<a 
															type="button" 
															class="btn btn-md" 
															{if $accessDep == null}
															data-toggle="modal" 
															data-editid="{$foo.employee_id}" 
															data-lastname="{$foo.user_name}" 
															data-lastlogin="{$foo.user_id}" 
															data-departmentid="{$departmentId}" 
															data-countselect="{$countArrayDepartmentNamesForSelect}" 
															data-target="#employeeModal" 
															{/if}
															title="Редактировать Данные Сотрудника"
															{$accessDep}>
															<i class="glyphicon glyphicon-pencil"></i>
														</a>
														{/if}
													</td>
													<td>
														{if $status == FALSE}
														<a 
															type="button" 
															class="btn btn-md" 
															{if $accessDep == null}
															data-toggle="modal" 
															data-employeeid="{$foo.employee_id}" 
															data-employeename="{$foo.user_name}" 
															data-target="#removeModalEmp" 
															{/if}																
															title="Удалить Данные Сотрудника"
															{$accessDep}>
															<i class="glyphicon glyphicon-trash"></i>
														</a>
														{/if}
													</td>
												</tr>
											{/foreach}
											{/if}
											</tbody>
										</table>
										{if $status == FALSE}
										<a 
											type="button" 
											class="btn btn-md"
											{if $accessDep == null}
											data-toggle="modal" 
											data-departmentid="{$departmentId}" 
											data-countselect="{$countArrayDepartmentNamesForSelect}" 
											data-target="#employeeModal" 
											{/if}
											title="Добавить Сотрудника"
											{$accessDep}>
											<i class="glyphicon glyphicon-plus"></i>
										</a>
										{/if}
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
											{if $arrayProjectNamesForDepartment!=null}
											{foreach from=$arrayProjectNamesForDepartment item=foo}
												<tr>
													<td>
														<a 
															href="/index.php
																?route=Project/viewProject
																&projectId={$foo.project_id}
																&projectName={$foo.project_name}
																&departmentId={$departmentId}
																&departmentName={$departmentName}
																&nameUser={$name}
																&roleUser={$role}
																&headId={$headId}
																&roleIdUser={$roleId}
																&Month={$selectedMonthForGet}
																&Year={$selectedYearForGet}">
															{$foo.project_name}
														</a>
													</td>
													<td>
														{if $status == FALSE}
														<a 
															type="button" 
															class="btn btn-md" 
															{if $accessPro == null || $headId == $departmentId}
															data-toggle="modal" 
															data-editid="{$foo.project_id}" 
															data-lastname="{$foo.project_name}" 
															data-departmentid="{$departmentId}" 
															data-countselect="{$countArrayDepartmentNamesForSelect}" 
															data-target="#projectModal" 
															{/if}
															title="Редактировать Данные Проекта"
															{if $headId != $departmentId}
															{$accessPro}
															{/if}>
															<i class="glyphicon glyphicon-pencil"></i>
														</a>
														{/if}
													</td>
													<td>
														{if $status == FALSE}
														<a 
															type="button" 
															class="btn btn-md" 
															{if $accessPro == null || $headId == $departmentId}
															data-toggle="modal" 
															data-projectid="{$foo.project_id}" 
															data-projectname="{$foo.project_name}" 
															data-target="#removeModalPro" 
															{/if}
															title="Удалить Данные Проекта"
															{if $headId != $departmentId}
															{$accessPro}
															{/if}>
															<i class="glyphicon glyphicon-trash"></i>
														</a>
														{/if}
													</td>
												</tr>
											{/foreach}
											{/if}
											</tbody>
										</table>
										{if $status == FALSE}
										<a 
											type="button" 
											class="btn btn-md" 
											{if $accessPro == null || $headId == $departmentId}
											data-toggle="modal" 
											data-departmentid="{$departmentId}" 
											data-countselect="{$countArrayDepartmentNamesForSelect}" 
											data-target="#projectModal" 
											{/if}
											title="Добавить Проект"
											{if $headId != $departmentId}
											{$accessPro}
											{/if}>
											<i class="glyphicon glyphicon-plus"></i>
										</a>
										{/if}
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
												{foreach from=$arrayDepartmentNamesForSelect item=foo}
												
												<option value="{$foo.department_id}">{$foo.department_name}</option>
												{/foreach}
											</select>
										</div>
									</div>
									<div class="modal-footer">
										<div class="input-group hidden">
											<input id="routeEmp" name="route" type="hidden">
											<input id="editIdEmp" name="editId" type="hidden">
											<input name="departmentId" type="hidden" value="{$departmentId}">
											<input name="departmentName" type="hidden" value="{$departmentName}">
											<input name="nameUser" type="hidden" value="{$name}">
											<input name="roleUser" type="hidden" value="{$role}">
											<input name="headId" type="hidden" value="{$headId}">
											<input name="roleIdUser" type="hidden" value="{$roleId}">
											<input name="Month" type="hidden" value="{$selectedMonthForGet}">
											<input name="Year" type="hidden" value="{$selectedYearForGet}">
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
												{foreach from=$arrayDepartmentNamesForSelect item=foo}
												
												<option value="{$foo.department_id}">{$foo.department_name}</option>
												{/foreach}
											</select>
										</div>
									</div>
									<div class="modal-footer">
										<div class="input-group hidden">
											<input id="routePro" name="route" type="hidden" >
											<input id="editIdPro" name="editId" type="hidden">
											<input name="departmentId" type="hidden" value="{$departmentId}">
											<input name="departmentName" type="hidden" value="{$departmentName}">
											<input name="nameUser" type="hidden" value="{$name}">
											<input name="roleUser" type="hidden" value="{$role}">
											<input name="headId" type="hidden" value="{$headId}">
											<input name="roleIdUser" type="hidden" value="{$roleId}">
											<input name="Month" type="hidden" value="{$selectedMonthForGet}">
											<input name="Year" type="hidden" value="{$selectedYearForGet}">		
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
												value="{$departmentName}"
												required="required">
										</div>
									</div>
									<div class="modal-footer">
										<div class="input-group hidden">
											<input name="route" type="hidden" value="Department/editDepartment">
											<input name="editId" type="hidden" value="{$departmentId}">
											<input name="nameUser" type="hidden" value="{$name}">
											<input name="roleUser" type="hidden" value="{$role}">
											<input name="headId" type="hidden" value="{$headId}">
											<input name="roleIdUser" type="hidden" value="{$roleId}">
											<input name="Month" type="hidden" value="{$selectedMonthForGet}">
											<input name="Year" type="hidden" value="{$selectedYearForGet}">
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
									<h4 class="modal-title" >Вы уверены, что хотите удалить данные отдела: <u><b>{$departmentName}</u></b></h4>
								</div>							
								<form action="/index.php" method="get" onsubmit="diactiveRemoveDep()">
									<div class="modal-body">
									</div>
									<div class="modal-footer">
										<div class="input-group hidden">
											<input name="route" type="hidden" value="List/removeDepartment">
											<input name="departmentId" type="hidden" value="{$departmentId}">
											<input name="nameUser" type="hidden" value="{$name}">
											<input name="roleUser" type="hidden" value="{$role}">
											<input name="Month" type="hidden" value="{$selectedMonthForGet}">
											<input name="Year" type="hidden" value="{$selectedYearForGet}">
											<input name="roleIdUser" type="hidden" value="{$roleId}">
											<input name="headId" type="hidden" value="{$headId}">
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
											<input name="departmentId" type="hidden" value="{$departmentId}">
											<input name="departmentName" type="hidden" value="{$departmentName}">
											<input name="nameUser" type="hidden" value="{$name}">
											<input name="roleUser" type="hidden" value="{$role}">
											<input name="Month" type="hidden" value="{$selectedMonthForGet}">
											<input name="Year" type="hidden" value="{$selectedYearForGet}">
											<input name="roleIdUser" type="hidden" value="{$roleId}">
											<input name="headId" type="hidden" value="{$headId}">
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
											<input name="departmentId" type="hidden" value="{$departmentId}">
											<input name="departmentName" type="hidden" value="{$departmentName}">
											<input name="nameUser" type="hidden" value="{$name}">
											<input name="roleUser" type="hidden" value="{$role}">
											<input name="Month" type="hidden" value="{$selectedMonthForGet}">
											<input name="Year" type="hidden" value="{$selectedYearForGet}">
											<input name="roleIdUser" type="hidden" value="{$roleId}">
											<input name="headId" type="hidden" value="{$headId}">
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
										{if $statusEditing == null}
											заблокировать
										{/if}
										{if $statusEditing != null}
											разблокировать
										{/if}
										 данные месяца <b>({$selectedMonth}-{$selectedYearForGet})</b> для редактирования.
									</h4>
								</div>							
								<form action="/index.php" method="get" onsubmit="diactiveChangeDataMonthEditing()">
									<div class="modal-body">
									</div>
									<div class="modal-footer">
										<div class="input-group hidden">
											<input name="route" type="hidden" value="Department/changeDataStatusForEditing">
											<input name="lastStatus" type="hidden" value="{$status}">
											<input name="departmentId" type="hidden" value="{$departmentId}">
											<input name="departmentName" type="hidden" value="{$departmentName}">
											<input name="nameUser" type="hidden" value="{$name}">
											<input name="roleUser" type="hidden" value="{$role}">
											<input name="Month" type="hidden" value="{$selectedMonthForGet}">
											<input name="Year" type="hidden" value="{$selectedYearForGet}">
											<input name="roleIdUser" type="hidden" value="{$roleId}">
											<input name="headId" type="hidden" value="{$headId}">
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
			<script>
				function diactiveDep() {
					document.getElementById('buttonModalSDep').disabled = 1;
					document.getElementById('buttonModalFDep').disabled = 1;
					document.getElementById("nameDepartment").setAttribute("readonly", "readonly");
				}
			</script>
			<script>
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
			</script>
			<script>
				function diactivePro() {
					document.getElementById('buttonModalSPro').disabled = 1;
					document.getElementById('buttonModalFPro').disabled = 1;
					document.getElementById("nameProject").setAttribute("readonly", "readonly");
				}
			</script>
			<script>
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
			</script>
			<script>
				function diactiveEmp() {
					document.getElementById('buttonModalSEmp').disabled = 1;
					document.getElementById('buttonModalFEmp').disabled = 1;
					document.getElementById("loginEmployee").setAttribute("readonly", "readonly");
					document.getElementById("nameEmployeeM").setAttribute("readonly", "readonly");
					document.getElementById("nameEmployeeF").setAttribute("readonly", "readonly");
					document.getElementById("nameEmployeeS").setAttribute("readonly", "readonly");
				}
			</script>
			<script>
				function diactiveRemoveDep() {
					document.getElementById('buttonModalSRemoveDep').disabled = 1;
					document.getElementById('buttonModalFRemoveDep').disabled = 1;
				}
			</script>
			<script>
				$('#removeModalEmp').on('show.bs.modal', function (event) {
					var button = $(event.relatedTarget);
					var modal = $(this);
					var employeeId = button.data('employeeid');
					var employeeName = button.data('employeename');
					modal.find('.modal-title').html('Вы уверены, что хотите удалить данные сотрудника: <u><b>'+employeeName+'</u></b>');
					document.getElementById('employeeId').value = employeeId;
				});
			</script>
			<script>
				function diactiveRemoveEmp() {
					document.getElementById('buttonModalSRemoveEmp').disabled = 1;
					document.getElementById('buttonModalFRemoveEmp').disabled = 1;
				}
			</script>
			<script>
				$('#removeModalPro').on('show.bs.modal', function (event) {
					var button = $(event.relatedTarget);
					var modal = $(this);
					var projectId = button.data('projectid');
					var projectName = button.data('projectname');
					modal.find('.modal-title').html('Вы уверены, что хотите удалить данные проекта: <u><b>'+projectName+'</u></b>');
					document.getElementById('projectId').value = projectId;
				});
			</script>
			<script>
				function diactiveRemovePro() {
					document.getElementById('buttonModalSRemovePro').disabled = 1;
					document.getElementById('buttonModalFRemovePro').disabled = 1;
				}
			</script>
			<script>
				function diactiveChangeDataMonthEditing() {
					document.getElementById('buttonModalSData').disabled = 1;
					document.getElementById('buttonModalFData').disabled = 1;
				}
			</script>
			<script>
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
			</script>
		</div>
	</body>
</html>
