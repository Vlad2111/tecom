<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Tecomgroup | {$title}</title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- REQUIRED CSS SCRIPTS -->
		<link rel="stylesheet" href="3pty/AdminLTE-2.3.5/dist/css/skins/_all-skins.min.css">
		<link rel="stylesheet" href="3pty/AdminLTE-2.3.5/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
		<link rel="stylesheet" href="3pty/AdminLTE-2.3.5/dist/css/AdminLTE.min.css">
		<link rel="stylesheet" href="3pty/AdminLTE-2.3.5/dist/css/skins/skin-blue.min.css">
		<link rel="stylesheet" href="3pty/AdminLTE-2.3.5/plugins/datatables/dataTables.bootstrap.css">
		<link rel="stylesheet" href="3pty/AdminLTE-2.3.5/plugins/datepicker/datepicker3.css">
		<link rel="stylesheet" href="3pty/AdminLTE-2.3.5/plugins/select2/select2.min.css">
		<!-- REQUIRED JS SCRIPTS -->
		<script src="3pty/AdminLTE-2.3.5/plugins/fastclick/fastclick.js"></script>
		<script src="3pty/AdminLTE-2.3.5/dist/js/demo.js"></script>
		<script src="3pty/AdminLTE-2.3.5/plugins/jQuery/jquery-2.2.3.min.js" type="text/javascript"></script>
		<script src="3pty/AdminLTE-2.3.5/bootstrap/js/bootstrap.min.js"></script>
		<script src="3pty/AdminLTE-2.3.5/dist/js/app.min.js"></script>
		<script src="3pty/AdminLTE-2.3.5/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="3pty/AdminLTE-2.3.5/plugins/datatables/dataTables.bootstrap.min.js"></script>
		<script src="3pty/AdminLTE-2.3.5/plugins/datepicker/bootstrap-datepicker.js"></script>
		<script src="3pty/AdminLTE-2.3.5/plugins/select2/select2.full.min.js"></script>
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
							<h3 class="box-title" style="font-size:23px">Проект: {$projectName}
								<a 
									type="button" 
									class="btn btn-md" 
									data-toggle="modal" 
									data-countselect="{$countArrayDepartmentNamesForSelect}" 
									data-departmentid="{$departmentId}" 
									data-target="#projectModal" 
									title="Редактировать Данные Проекта">
									<i class="glyphicon glyphicon-pencil"></i>
								</a>
								<a 
									type="button" 
									class="btn btn-md" 
									href="/index.php
										?route=list/removeProject
										&nameUser={$name}
										&roleUser={$role}
										&Month={$selectedMonthForGet}
										&Year={$selectedYearForGet}
										&projectId={$projectId}" 
									title="Удалить Данные Проекта">
									<i class="glyphicon glyphicon-trash"></i>
								</a>
							</h3>	
							<p>(Отдел: {$departmentName})</p>
						</div>
							<div class="box-body">
								<table id="project" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>Фамилия и Имя</th>
											<th>Отдел</th>
											<th style="width:20px">Занятость</th>
											<th style="width: 18px"></th>
											<th style="width: 18px"></th>
										</tr>
									</thead>
									<tbody>
									{if $arrayEployeeNamesAndPercentsForProject!=null}
									{foreach from=$arrayEployeeNamesAndPercentsForProject item=foo}
				
										<tr>
											<td>
												<a 
													href="/index.php
														?route=employee
														&employeeId={$foo.employee_id}
														&departmentId={$foo.department_id}
														&departmentName={$foo.department_name}
														&employeeName={$foo.user_name}
														&employeeLogin={$foo.user_id}
														&nameUser={$name}
														&roleUser={$role}
														&Month={$selectedMonthForGet}
														&Year={$selectedYearForGet}">
													{$foo.user_name}
												</a>
											</td>
											<td>
												<a 
													href="/index.php
														?route=department
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
													data-action="Edit" 
													data-lasttime="{$foo.time}" 
													data-countselect="{$countArrayEmployeeNamesForDepartmentForSelect}" 
													data-employeeid="{$foo.employee_id}" 
													data-employeename="{$foo.user_name}" 
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
														?route=employee/removePercent&
														employeeId={$employeeId}
														&employeeName={$employeeName}
														&employeeLogin={$employeeLogin}
														&nameUser={$name}
														&roleUser={$role}
														&Month={$selectedMonthForGet}
														&Year={$selectedYearForGet}
														&projectId={$foo.project_id}" 
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
									data-toggle="modal" 
									data-action="New" 
									data-countselect="{$countArrayEmployeeNamesForDepartmentForSelect}" 
									data-target="#timeDistModal" 
									class="btn btn-md" 
									title="Добавить Распределение Времени">
									<i class="glyphicon glyphicon-plus"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade" id="projectModal" role="dialog" aria-labelledby="projectModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="projectModalLabel">Редактировать Данные Проекта</h4>
							</div>
							<form action="/index.php" method="get">
								<div class="modal-body">
									<div class="form-group">
										<label class="control-label">Название:</label>
										<input name="newName" type="text" class="form-control" id="nameProject" value="{$projectName}">
									</div>
									<div class="form-group">
										<label>Отдел:</label>
										<select name="newDepartmwent" class="form-control select2" id="selectId" style="width: 100%;">
											{foreach from=$arrayDepartmentNamesForSelect item=foo}
											
											<option value="{$foo.department_id}*-*{$foo.department_name}">{$foo.department_name}</option>
											{/foreach}
										</select>
									</div>
								</div>
								<div class="modal-footer">
									<div class="input-group hidden">
										<input name="route" type="hidden" value="project/editProject">
										<input name="action" type="hidden" value="Edit">
										<input name="nameUser" type="hidden" value="{$name}">
										<input name="roleUser" type="hidden" value="{$role}">
										<input name="Month" type="hidden" value="{$selectedMonthForGet}">
										<input name="Year" type="hidden" value="{$selectedYearForGet}">
										<input name="editId" type="hidden" value="{$projectId}">
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
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="timeDistModalLabel"></h4>
							</div>
							<form action="/index.php" method="get">
								<div class="modal-body">
									<div class="form-group" id="employee" ></div>
									<div class="modal-form-group">
										<label for="nameProject">Проект</label>
										<input name="projectName" type="text" class="form-control" id="nameProject" value="{$projectName}" readonly>
									</div>
									<div class="form-group">
										<label for="TimeDistr">Время</label>
										<div class="input-group">
											<input name="newTime" type="text" class="form-control" id="TimeDistr" value="">
											<span class="input-group-addon">%</span>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<div class="input-group hidden">
										<input id="route" name="route" type="hidden" >
										<input id="actionPro" name="action" type="hidden">
										<input name="nameUser" type="hidden" value="{$name}">
										<input name="roleUser" type="hidden" value="{$role}">
										<input name="Month" type="hidden" value="{$selectedMonthForGet}">
										<input name="Year" type="hidden" value="{$selectedYearForGet}">
										<input name="projectId" type="hidden" value="{$projectId}">
										<input name="departmentId" type="hidden" value="{$departmentId}">
										<input name="departmentName" type="hidden" value="{$departmentName}">
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
				<b>Version</b> 2.3.5
			</div>
			<strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
		</footer>
		<script>
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
		</script>
		<script>
			$('#timeDistModal').on('show.bs.modal', function (event) {
				var button = $(event.relatedTarget);
				var action = button.data('action');
				var modal = $(this);
				var lasttime = button.data('lasttime');
				var employeeId = button.data('employeeid');
				var employeeName = button.data('employeename');
				var countSelectPro = button.data('countselect');
				if (action == 'Edit'){
					modal.find('.modal-title').text('Редактировать Данные Распределения Времени');
					document.getElementById('route').value = 'project/editPercent';
					$('#employee').html('<label>Сотрудник:</label><input type="text" class="form-control" id="employeeName" value="" readonly><input name="employeeId" type="hidden" id="employeeId" value="" >'); 
					document.getElementById('employeeId').value = employeeId;
					document.getElementById('employeeName').value = employeeName;
					document.getElementById('TimeDistr').value = lasttime;
					document.getElementById('actionPro').value = action;
				}
				if (action == 'New'){
					modal.find('.modal-title').text('Новое Распределение Времени');
					document.getElementById('route').value = 'project/newPercent';
					$('#employee').html('<label>Сотрудник:</label><select name="employeeId" class="form-control select2" id="selectIdEmp" style="width: 100%;">{foreach from=$arrayEmployeeNamesForDepartmentForSelect item=foo}<option value="{$foo.employee_id}">{$foo.user_name}</option>{/foreach}{foreach from=$arrayEmployeeNamesNotForDepartmentForSelect item=foo}<option value="{$foo.employee_id}">{$foo.user_name}</option>{/foreach}</select>'); 
					document.getElementById('TimeDistr').value = null;
					document.getElementById('actionPro').value = action;
					for (var i = 0; i < countSelectPro; i++) {
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
		</script>
		<script>
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
		</script>
	</div>
	</body>
</html>