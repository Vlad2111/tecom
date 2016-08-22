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
							<div class="box">
								<div class="box-header">
									<h3 class="box-title" style="font-size:23px">Сотрудник: {$employeeName}
										<a 
											type="button" 
											class="btn btn-md" 
											data-toggle="modal" 
											data-departmentid="{$departmentId}" 
											data-countselect="{$countArrayDepartmentNamesForSelect}" 
											data-target="#employeeModal" 
											title="Редактировать Данные Сотрудника">
											<i class="glyphicon glyphicon-pencil"></i>
										</a>
										<a 
											type="button" 
											class="btn btn-md" 
											href="/index.php
												?route=list/removeEmployee
												&employeeId={$employeeId}
												&nameUser={$name}
												&roleUser={$role}
												&Month={$selectedMonthForGet}
												&Year={$selectedYearForGet}" 
											title="Удалить Данные Сотрудника">
											<i class="glyphicon glyphicon-trash"></i>
										</a>
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
												<th style="width: 18px"></th>
												<th style="width: 18px"></th>
											</tr>
										</thead>
										<tbody>
										{if $arrayEmployeeInfo!=null}
										{foreach from=$arrayEmployeeInfo item=foo}
											
											<tr>
												<td>
													<a 
														href="/index.php
															?route=project/viewProject
															&projectId={$foo.project_id}
															&projectName={$foo.project_name}
															&departmentId={$foo.department_id}
															&departmentName={$foo.department_name}
															&nameUser={$name}
															&roleUser={$role}
															&Month={$selectedMonthForGet}
															&Year={$selectedYearForGet}">
														{$foo.project_name}
													</a>
												</td>
												<td>
													<a 
														href="/index.php
															?route=department/viewDepartment
															&departmentId={$foo.department_id}
															&departmentName={$foo.department_name}
															&nameUser={$name}
															&roleUser={$role}
															&Month={$selectedMonthForGet}
															&Year={$selectedYearForGet}">
														{$foo.department_name}
													</a>
												</td>
												<td>{$foo.time}%</td>
												<td>
													<a 
														type="button" 
														class="btn btn-md" 
														data-toggle="modal" 
														data-lasttime="{$foo.time}" 
														data-projectid="{$foo.project_id}" 
														data-projectname="{$foo.project_name}" 
														data-target="#timeDistModal" 
														title="Редактировать Данные Распределения Времени">
														<i class="glyphicon glyphicon-pencil"></i>
													</a>
												</td>
												<td>
													<a 
														type="button" 
														class="btn btn-md" 
														href="/index.php
															?route=employee/removePercent
															&projectId={$foo.project_id}
															&employeeId={$employeeId}
															&employeeName={$employeeName}
															&employeeLogin={$employeeLogin}
															&nameUser={$name}
															&roleUser={$role}
															&Month={$selectedMonthForGet}
															&Year={$selectedYearForGet}" 
														title="Удалить Данные Распределения Времени">
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
										data-countselect="{$countArrayProjectNamesForSelect}" 
										data-target="#timeDistModal" 
										title="Добавить Распределение Времени">
										<i class="glyphicon glyphicon-plus"></i>
									</a>
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
											<label for="nameEmployee">Фамилия и Имя:</label>
											<input 
												type="text" 
												class="form-control" 
												name="employeeName" 
												value="{$employeeName}" 
												disabled>
										</div>
										<div class="form-group">
											<label>Логин:</label>
											<input 
												name="newLogin" 
												type="text" 
												class="form-control" 
												value="{$employeeLogin}">
										</div>
										<div class="form-group">
											<label>Отдел:</label>
											<select 
												id="selectId" 
												name="newDepartmwent" 
												class="form-control select2" 
												style="width: 100%;">
												{foreach from=$arrayDepartmentNamesForSelect item=foo}
												
												<option value="{$foo.department_id}*-*{$foo.department_name}">{$foo.department_name}</option>
												{/foreach}
											</select>
										</div>
									</div>
									<div class="modal-footer">
										<div class="input-group hidden">
											<input name="route" type="hidden" value="employee/editEmployee">
											<input name="editId" type="hidden" value="{$employeeId}">
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
					<div class="modal fade" id="timeDistModal" role="dialog" aria-labelledby="timeDistModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title" id="timeDistModalLabel"></h4>
								</div>
								<form action="/index.php" method="get">
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
													class="form-control">
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
				$('#employeeModal').on('show.bs.modal', function (event) {
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
						document.getElementById('route').value = 'project/editPercent';
						$('#project').html('<label>Проект:</label><input id="projectName" type="text" class="form-control" readonly><input id="projectId" name="projectId" type="hidden">'); 
						document.getElementById('projectId').value = projectId;
						document.getElementById('projectName').value = projectName;
						document.getElementById('TimeDistr').value = lasttime;
					}else{
						modal.find('.modal-title').text('Новое Распределение Времени');
						document.getElementById('route').value = 'project/newPercent';
						$('#project').html('<label>Проект:</label><select id="selectIdPro" name="projectId" class="form-control select2" style="width: 100%;">{foreach from=$arrayProjectNamesForDepartmentForSelect item=foo}<option value="{$foo.project_id}">{$foo.project_name}</option>{/foreach}{foreach from=$arrayProjectNamesNotForDepartmentForSelect item=foo}<option value="{$foo.project_id}">{$foo.project_name}</option>{/foreach}</select>'); 
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