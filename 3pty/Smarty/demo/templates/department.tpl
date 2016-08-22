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
							<div class="col-xs-12">
								<div class="box">
									<div class="box-header">
										<h3 class="box-title" style="font-size:23px">Отдел: {$departmentName}	
											<a 
												type="button" 
												class="btn btn-md" 
												data-toggle="modal" 
												data-target="#departmentModal"
												title="Редактировать Данные Отдела">
												<i class="glyphicon glyphicon-pencil"></i>
											</a>
											<a 
												type="button" 
												class="btn btn-md" 
												href="/index.php
													?route=list/removeDepartment
													&departmentId={$departmentId}
													&nameUser={$name}
													&roleUser={$role}
													&Month={$selectedMonthForGet}
													&Year={$selectedYearForGet}" 
												title="Удалить Данные Отдела">
												<i class="glyphicon glyphicon-trash"></i>
											</a>	
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
													<th>Фамилия и Имя</th>
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
																?route=employee/viewEmployee
																&employeeId={$foo.employee_id}
																&employeeName={$foo.user_name}
																&employeeLogin={$foo.user_id}
																&departmentId={$departmentId}
																&departmentName={$departmentName}
																&nameUser={$name}
																&roleUser={$role}
																&Month={$selectedMonthForGet}
																&Year={$selectedYearForGet}">
															{$foo.user_name}
														</a>
													</td>
													<td>{$foo.summ}%</td>
													<td>
														<a 
															type="button" 
															class="btn btn-md" 
															data-toggle="modal" 
															data-editid="{$foo.employee_id}" 
															data-lastname="{$foo.user_name}" 
															data-lastlogin="{$foo.user_id}" 
															data-departmentid="{$departmentId}" 
															data-countselect="{$countArrayDepartmentNamesForSelect}" 
															data-target="#employeeModal" 
															title="Редактировать Данные Сотрудника">
															<i class="glyphicon glyphicon-pencil"></i>
														</a>
													</td>
													<td>
														<a 
															type="button" 
															class="btn btn-md" 
															href="/index.php
																?route=department/removeEmployee
																&employeeId={$foo.employee_id}
																&departmentId={$departmentId}
																&departmentName={$departmentName}
																&nameUser={$name}
																&roleUser={$role}
																&Month={$selectedMonthForGet}
																&Year={$selectedYearForGet}" 
															title="Удалить Данные Сотрудника">
															<i class="glyphicon glyphicon-trash"></i>
														</a>
													</td>
												</tr>
											{/foreach}
											{/if}
											</tbody>
										</table>
										<a 
											type="button" 
											class="btn btn-md"
											data-toggle="modal" 
											data-departmentid="{$departmentId}" 
											data-countselect="{$countArrayDepartmentNamesForSelect}" 
											data-target="#employeeModal" 
											title="Добавить Сотрудника">
											<i class="glyphicon glyphicon-plus"></i>
										</a>
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
																?route=project/viewProject
																&projectId={$foo.project_id}
																&projectName={$foo.project_name}
																&departmentId={$departmentId}
																&departmentName={$departmentName}
																&nameUser={$name}
																&roleUser={$role}
																&Month={$selectedMonthForGet}
																&Year={$selectedYearForGet}">
															{$foo.project_name}
														</a>
													</td>
													<td>
														<a 
															type="button" 
															class="btn btn-md" 
															data-toggle="modal" 
															data-editid="{$foo.project_id}" 
															data-lastname="{$foo.project_name}" 
															data-departmentid="{$departmentId}" 
															data-countselect="{$countArrayDepartmentNamesForSelect}" 
															data-target="#projectModal" 
															title="Редактировать Данные Проекта">
															<i class="glyphicon glyphicon-pencil"></i>
														</a>
													</td>
													<td>
														<a 
															type="button" 
															class="btn btn-md" 
															href="/index.php
																?route=department/removeProject
																&projectId={$foo.project_id}
																&departmentId={$departmentId}
																&departmentName={$departmentName}
																&nameUser={$name}
																&roleUser={$role}
																&Month={$selectedMonthForGet}
																&Year={$selectedYearForGet}" 
															title="Удалить Данные Сотрудника">
															<i class="glyphicon glyphicon-trash"></i>
														</a>
													</td>
												</tr>
											{/foreach}
											{/if}
											</tbody>
										</table>
										<a 
											type="button" 
											class="btn btn-md" 
											data-toggle="modal" 
											data-departmentid="{$departmentId}" 
											data-countselect="{$countArrayDepartmentNamesForSelect}" 
											data-target="#projectModal" 
											title="Добавить Проект">
											<i class="glyphicon glyphicon-plus"></i>
										</a>
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
								<form action="/index.php" method="get">
									<div class="modal-body">
										<div class="modal-form-group">
											<label for="nameEmployee"></label>
											<input 
												id="nameEmployee" 
												type="text" 
												class="form-control" 
												disabled>
										</div>
										<div class="form-group">
											<label>Логин:</label>
											<input 
												id="loginEmployee"
												name="newLogin" 
												type="text" 
												class="form-control">
										</div>
										<div class="form-group">
											<label>Отдел:</label>
											<select 
												id="selectIdEmp" 
												name="newDepartmwent" 
												class="form-control select2" 
												style="width: 100%;">
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
											<input name="Month" type="hidden" value="{$selectedMonthForGet}">
											<input name="Year" type="hidden" value="{$selectedYearForGet}">
										</div>
										<button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
										<button type="submit" class="btn btn-primary">Сохранить</button>
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
								<form action="/index.php" method="get">
									<div class="modal-body">
										<div class="form-group">
											<label class="control-label">Название:</label>
											<input  
												id="nameProject"
												name="newName" 
												type="text" 
												class="form-control">
										</div>
										<div class="form-group">
											<label>Отдел:</label>
											<select 
												id="selectIdPro" 
												name="newDepartmwent" 
												class="form-control select2" 
												style="width: 100%;">
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
											<input name="Month" type="hidden" value="{$selectedMonthForGet}">
											<input name="Year" type="hidden" value="{$selectedYearForGet}">		
										</div>
										<button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
										<button type="submit" class="btn btn-primary">Сохранить</button>
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
								<form action="/index.php" method="get">
									<div class="modal-body">
										<div class="form-group">
											<label class="control-label">Название:</label>
											<input 
												name="newName" 
												type="text" 
												class="form-control" 
												value="{$departmentName}">
										</div>
									</div>
									<div class="modal-footer">
										<div class="input-group hidden">
											<input name="route" type="hidden" value="department/editDepartment">
											<input name="editId" type="hidden" value="{$departmentId}">
											<input name="nameUser" type="hidden" value="{$name}">
											<input name="roleUser" type="hidden" value="{$role}">
											<input name="Month" type="hidden" value="{$selectedMonthForGet}">
											<input name="Year" type="hidden" value="{$selectedYearForGet}">
										</div>
										<button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
										<button type="submit" class="btn btn-primary">Сохранить</button>
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
						document.getElementById('routePro').value = 'department/editProject';
						document.getElementById('nameProject').value = lastName;
						document.getElementById('editIdPro').value = editId;
						
					}else{
						modal.find('.modal-title').text('Новый Проект');
						document.getElementById('routePro').value = 'department/newProject';
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
						document.getElementById('routeEmp').value = 'department/editEmployee';
						modal.find('.modal-form-group label').text('Фамилия и Имя:');
						document.getElementById('nameEmployee').type = "text";
						document.getElementById('editIdEmp').value = editId;
						document.getElementById('nameEmployee').value = lastName;
						document.getElementById('loginEmployee').value = lastLogin;
					}else{
						modal.find('.modal-title').text('Новый Сотрудник');
						document.getElementById('routeEmp').value = 'department/newEmployee';
						modal.find('.modal-form-group label').text('');
						document.getElementById('nameEmployee').type = "hidden";
						document.getElementById('editIdEmp').value = null;
						document.getElementById('nameEmployee').value = null;
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