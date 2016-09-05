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
							<div class="box">
								<div class="box-header">
									<h3 class="box-title" style="font-size:23px">Сотрудник: {$employeeName}
										{if $status == FALSE}
										<a 
											type="button" 
											class="btn btn-md" 
											{if $accessEmp == null}	
											data-toggle="modal" 
											data-lastname="{$employeeName}"
											data-departmentid="{$departmentId}" 
											data-countselect="{$countArrayDepartmentNamesForSelect}" 
											data-target="#employeeModal" 
											{/if}
											title="Редактировать Данные Сотрудника"
											{$accessEmp}>
											<i class="glyphicon glyphicon-pencil"></i>
										</a>
										<a 
											type="button" 
											class="btn btn-md" 
											{if $accessEmp == null}	
											data-toggle="modal"  
											data-target="#removeModalEmp" 
											{/if}
											title="Удалить Данные Сотрудника"
											{$accessEmp}>
											<i class="glyphicon glyphicon-trash"></i>
										</a>
										{/if}
									</h3>
									<p style="text-align:justify;">
										<table class="text" style="width:100%; border-spacing:0;">
											<tr style="vertical-align: top;">
												<td style="text-align: left;">(Отдел: {$departmentName})</td>
												<td style="text-align: right;">
													{$employeePercent}%
													{if $employeePercent<100}
														<i class="glyphicon glyphicon-info-sign text-blue"></i>
														Время не распределено до конца
														<i class="glyphicon glyphicon-info-sign text-blue"></i>
													{/if}
													{if $employeePercent==100}
														<i class="glyphicon glyphicon-ok-sign text-green"></i>
														Время распределено
														<i class="glyphicon glyphicon-ok-sign text-green"></i>
													{/if}
													{if $employeePercent>100}
														<i class="glyphicon glyphicon-exclamation-sign text-red" ></i>
														Ошибка
														<i class="glyphicon glyphicon-exclamation-sign text-red" ></i>
													{/if}	
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
										{if $arrayEmployeeInfo!=null}
										{foreach from=$arrayEmployeeInfo item=foo}
											
											<tr>
												<td>
													<a 
														href="/index.php
															?route=Project/viewProject
															&projectId={$foo.project_id}
															&projectName={$foo.project_name}
															&departmentId={$foo.department_id}
															&departmentName={$foo.department_name}
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
													<a 
														href="/index.php
															?route=Department/viewDepartment
															&departmentId={$foo.department_id}
															&departmentName={$foo.department_name}
															&nameUser={$name}
															&roleUser={$role}
															&headId={$headId}
															&roleIdUser={$roleId}
															&Month={$selectedMonthForGet}
															&Year={$selectedYearForGet}">
														{$foo.department_name}
													</a>
												</td>
												<td>{$foo.time}%</td>
												<td>
													{if $status == FALSE}
													<a 
														type="button" 
														class="btn btn-md" 
														{if $accessPro == null || $headId == $departmentId}
														data-toggle="modal" 
														data-lasttime="{$foo.time}" 
														data-projectid="{$foo.project_id}" 
														data-projectname="{$foo.project_name}" 
														data-target="#timeDistModal" 
														{/if}
														title="Редактировать Данные Распределения Времени"
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
														data-employeename="{$employeeName}"
														data-target="#removeModalTime" 
														{/if}
														title="Удалить Данные Распределения Времени"
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
										data-countselect="{$countArrayProjectNamesForSelect}" 
										data-target="#timeDistModal" 
										{/if}
										title="Добавить Распределение Времени"
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
												value="{$employeeLogin}"
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
												{foreach from=$arrayDepartmentNamesForSelect item=foo}
												
												<option value="{$foo.department_id}*-*{$foo.department_name}">{$foo.department_name}</option>
												{/foreach}
											</select>
										</div>
									</div>
									<div class="modal-footer">
										<div class="input-group hidden">
											<input name="route" type="hidden" value="Employee/editEmployee">
											<input name="editId" type="hidden" value="{$employeeId}">
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
												value="{$employeeName}" 
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
											<input name="employeeId" type="hidden" value="{$employeeId}">
											<input name="employeeLogin" type="hidden" value="{$employeeLogin}">
											<input name="departmentId" type="hidden" value="{$departmentId}">
											<input name="departmentName" type="hidden" value="{$departmentName}">
											<input name="nameUser" type="hidden" value="{$name}">
											<input name="roleUser" type="hidden" value="{$role}">
											<input name="headId" type="hidden" value="{$headId}">
											<input name="roleIdUser" type="hidden" value="{$roleId}">
											<input name="Month" type="hidden" value="{$selectedMonthForGet}">
											<input name="Year" type="hidden" value="{$selectedYearForGet}">
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
									<h4 class="modal-title" id="removeModalEmpLabel">Вы уверены, что хотите удалить данные сотрудника: <u><b>{$employeeName}</u></b></h4>
								</div>							
								<form action="/index.php" method="get" onsubmit="diactiveRemoveEmp()">
									<div class="modal-body">
									</div>
									<div class="modal-footer">
										<div class="input-group hidden">
											<input name="route" type="hidden" value="List/removeEmployee">
											<input name="employeeId" type="hidden" value="{$employeeId}">
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
											<input name="employeeId" type="hidden" value="{$employeeId}">
											<input id="projectId" name="projectId" type="hidden">
											<input name="employeeName" type="hidden" value="{$employeeName}">
											<input name="employeeLogin" type="hidden" value="{$employeeLogin}">
											<input name="departmentId" type="hidden" value="{$departmentId}">
											<input name="departmentName" type="hidden" value="{$departmentName}">
											<input name="nameUser" type="hidden" value="{$name}">
											<input name="roleUser" type="hidden" value="{$role}">
											<input name="Month" type="hidden" value="{$selectedMonthForGet}">
											<input name="Year" type="hidden" value="{$selectedYearForGet}">
											<input name="roleIdUser" type="hidden" value="{$roleId}">
											<input name="headId" type="hidden" value="{$headId}">
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
											<input name="route" type="hidden" value="Employee/changeDataStatusForEditing">
											<input name="lastStatus" type="hidden" value="{$status}">
											<input name="employeeId" type="hidden" value="{$employeeId}">
											<input name="employeeName" type="hidden" value="{$employeeName}">
											<input name="employeeLogin" type="hidden" value="{$employeeLogin}">
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
			</script>
			<script>
				function diactiveEmp() {
					document.getElementById('buttonModalSEmp').disabled = 1;
					document.getElementById('buttonModalFEmp').disabled = 1;
					document.getElementById("nameEmployeeF").setAttribute("readonly", "readonly");
					document.getElementById("nameEmployeeS").setAttribute("readonly", "readonly");
					document.getElementById("nameEmployeeM").setAttribute("readonly", "readonly");
					document.getElementById("newLogin").setAttribute("readonly", "readonly");
				}
			</script>
			<script>
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
						$('#project').html('<label>Проект:</label><select id="selectIdPro" name="projectId" class="form-control select2" style="width: 100%;" required="required">{foreach from=$arrayProjectNamesForDepartmentForSelect item=foo}<option value="{$foo.project_id}">{$foo.project_name}</option>{/foreach}{foreach from=$arrayProjectNamesNotForDepartmentForSelect item=foo}<option value="{$foo.project_id}">{$foo.project_name}</option>{/foreach}</select>'); 
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
			</script>
			<script>
				function diactiveTime() {
					document.getElementById('buttonModalSTime').disabled = 1;
					document.getElementById('buttonModalFTime').disabled = 1;
					document.getElementById("TimeDistr").setAttribute("readonly", "readonly");
				}
			</script>
			<script>
				function diactiveRemoveEmp() {
					document.getElementById('buttonModalSRemoveEmp').disabled = 1;
					document.getElementById('buttonModalFRemoveEmp').disabled = 1;
				}
			</script>
			<script>
				$('#removeModalTime').on('show.bs.modal', function (event) {
					var button = $(event.relatedTarget);
					var modal = $(this);
					var projectId = button.data('projectid');
					var projectName = button.data('projectname');
					var employeeName = button.data('employeename');
					modal.find('.modal-title').html('Вы уверены, что хотите удалить данные распредеения времени сотрудника: <u><b>'+employeeName+'</u></b> для проекта: <u><b>'+projectName+'</u></b>');
					document.getElementById('projectId').value = projectId;
				});
			</script>
			<script>
				function diactiveRemoveTime() {
					document.getElementById('buttonModalSRemoveTime').disabled = 1;
					document.getElementById('buttonModalFRemoveTime').disabled = 1;
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
				});
			</script>
		</div>
	</body>
</html>
