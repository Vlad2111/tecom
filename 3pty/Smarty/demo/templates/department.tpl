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
						<div class="col-xs-12">
							<div class="box">
								<div class="box-header">
									<h3 class="box-title" style="font-size:23px">Отдел: {$departmentName}	
										<a type="button" class="btn btn-md" data-toggle="modal" data-target="#departmentModal" title="Редактировать Данные Отдела"><i class="glyphicon glyphicon-pencil"></i></a>
										<a type="button" class="btn btn-md" href="/index.php?route=list&content=Department&nameUser={$name}&roleUser={$role}&Month={$selectedMonthForGet}&Year={$selectedYearForGet}&action=remove&departmentId={$departmentId}" title="Удалить Данные Отдела"><i class="glyphicon glyphicon-trash"></i></a>	
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
										{if $array!=null}
										{foreach from=$array item=foo}
										{if $foo.employee_id != null AND $foo.user_name != null}
											<tr>
												<td>{if $foo.summ<100}<i class="glyphicon glyphicon-info-sign text-blue"></i>{/if}{if $foo.summ==100}<i class="glyphicon glyphicon-ok-sign text-green"></i>{/if}{if $foo.summ>100}<i class="glyphicon glyphicon-exclamation-sign text-red" ></i>{/if}</td>
												<td><a href="/index.php?route=employee&employeeId={$foo.employee_id}&employeeName={$foo.user_name}&employeeLogin={$foo.user_id}&departmentId={$departmentId}&nameUser={$name}&roleUser={$role}&Month={$selectedMonthForGet}&Year={$selectedYearForGet}">{$foo.user_name}</a></td>
												<td>{$foo.summ}%</td>
												<td><a type="button" class="btn btn-md" data-toggle="modal" data-action="Edit" data-lastname="{$foo.user_name}" data-lastlogin="{$foo.user_id}" data-countselect="{$countselect}" data-departmentid="{$departmentId}" data-editid="{$foo.employee_id}" data-target="#employeeModal" title="Редактировать Данные Сотрудника"><i class="glyphicon glyphicon-pencil"></i></a></td>
												<td><a type="button" class="btn btn-md" href="/index.php?route=department&departmentId={$departmentId}&departmentName={$departmentName}&nameUser={$name}&roleUser={$role}&Month={$selectedMonthForGet}&Year={$selectedYearForGet}&action=removeEmpl&employeeId={$foo.employee_id}" title="Удалить Данные Сотрудника"><i class="glyphicon glyphicon-trash"></i></a></td>
											</tr>
										{/if}
										{/foreach}
										{/if}
										</tbody>
									</table>
									<a type="button" data-toggle="modal" data-action="New" data-countselect="{$countselect}" data-departmentid="{$departmentId}" data-target="#employeeModal" class="btn btn-md" title="Добавить Сотрудника"><i class="glyphicon glyphicon-plus"></i></a>
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
										{if $array!=null}
										{foreach from=$array item=foo}
										{if $foo.project_id != null AND $foo.project_name != null}
											<tr>
												<td><a href="/index.php?route=project&projectId={$foo.project_id}&projectName={$foo.project_name}&departmentId={$foo.department_id}&nameUser={$name}&roleUser={$role}&Month={$selectedMonthForGet}&Year={$selectedYearForGet}">{$foo.project_name}</a></td>
												<td><a type="button" class="btn btn-md" data-toggle="modal" data-action="Edit" data-lastname="{$foo.project_name}" data-countselect="{$countselect}" data-departmentid="{$departmentId}" data-editid="{$foo.project_id}" data-target="#projectModal" title="Редактировать Данные Проекта"><i class="glyphicon glyphicon-pencil"></i></a></td>
												<td><a type="button" class="btn btn-md" href="/index.php?route=department&departmentId={$departmentId}&departmentName={$departmentName}&nameUser={$name}&roleUser={$role}&Month={$selectedMonthForGet}&Year={$selectedYearForGet}&action=removeProj&projectId={$foo.project_id}" title="Удалить Данные Сотрудника"><i class="glyphicon glyphicon-trash"></i></a></td>
											</tr>
										{/if}
										{/foreach}
										{/if}
										</tbody>
									</table>
								<a type="button" data-toggle="modal" data-action="New" data-countselect="{$countselect}" data-departmentid="{$departmentId}" data-target="#projectModal" class="btn btn-md" title="Добавить Проект"><i class="glyphicon glyphicon-plus"></i></a>
							</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade" id="employeeModal" role="dialog" aria-labelledby="employeeModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="employeeModalLabel"></h4>
							</div>
							<form action="/index.php" method="get">
								<div class="modal-body">
									<div class="modal-form-group">
										<label for="nameEmployee"></label>
										<input type="text" class="form-control" id="nameEmployee" value="" disabled>
									</div>
									<div class="form-group">
										<label>Логин:</label>
										<input name="newLogin" type="text" class="form-control" id="loginEmployee" value="" >
									</div>
									<div class="form-group">
										<label>Отдел:</label>
										<select name="newDepartmwent" class="form-control select2" id="selectIdEmp" style="width: 100%;">
											{foreach from=$select item=foo}
											
											<option value="{$foo.department_id}">{$foo.department_name}</option>
											{/foreach}
										</select>
									</div>
								</div>
								<div class="modal-footer">
									<div class="input-group hidden">
										<input name="route" type="hidden" value="save">
										<input name="content" type="hidden" value="Employee">
										<input name="lastPage" type="hidden" value="Department">
										<input id="actionEmp" name="action" type="hidden">
										<input id="editIdEmp" name="editId" type="hidden">
										<input name="nameUser" type="hidden" value="{$name}">
										<input name="roleUser" type="hidden" value="{$role}">
										<input name="Month" type="hidden" value="{$selectedMonthForGet}">
										<input name="Year" type="hidden" value="{$selectedYearForGet}">
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
				<div class="modal fade" id="projectModal" role="dialog" aria-labelledby="projectModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="projectModalLabel"></h4>
							</div>
							<form action="/index.php" method="get">
								<div class="modal-body">
									<div class="form-group">
										<label class="control-label">Название:</label>
										<input name="newName" type="text" class="form-control" id="nameProject" value="">
									</div>
									<div class="form-group">
										<label>Отдел:</label>
										<select name="newDepartmwent" class="form-control select2" id="selectIdPro" style="width: 100%;">
											{foreach from=$select item=foo}
											
											<option value="{$foo.department_id}">{$foo.department_name}</option>
											{/foreach}
										</select>
									</div>
								</div>
								<div class="modal-footer">
									<div class="input-group hidden">
										<input name="route" type="hidden" value="save">
										<input name="content" type="hidden" value="Project">
										<input name="lastPage" type="hidden" value="Department">
										<input name="departmentId" type="hidden" value="{$departmentId}">
										<input name="departmentName" type="hidden" value="{$departmentName}">
										<input id="actionPro" name="action" type="hidden">
										<input id="editIdPro" name="editId" type="hidden">
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
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="departmentModalLabel">Редактировать Данные Отдела</h4>
								</div>
								<form action="/index.php" method="get">
									<div class="modal-body">
										<div class="form-group">
											<label class="control-label">Название:</label>
											<input name="newName" type="text" class="form-control" id="nameDepartment" value="{$departmentName}">
										</div>
									</div>
									<div class="modal-footer">
										<div class="input-group hidden">
											<input name="route" type="hidden" value="save">
											<input name="content" type="hidden" value="Department">
											<input name="lastPage" type="hidden" value="Department">
											<input name="action" type="hidden" value="Edit">
											<input name="editId" type="hidden" value="{$departmentId}">
											<input name="nameUser" type="hidden" value="{$name}">
											<input name="roleUser" type="hidden" value="{$role}">
											<input name="Month" type="hidden" value="{$selectedMonthForGet}">
											<input name="Year" type="hidden" value="{$selectedYearForGet}">
											<input name="departmentId" type="hidden" value="{$departmentId}">
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
				var action = button.data('action');
				var modal = $(this);
				var lastName = button.data('lastname');
				var editId = button.data('editid');
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
				document.getElementById('actionPro').value = action;
				if (action == 'Edit'){
					modal.find('.modal-title').text('Редактировать Данные Проекта');
					document.getElementById('nameProject').value = lastName;
					document.getElementById('editIdPro').value = editId;
					
				}
				if (action == 'New'){
					modal.find('.modal-title').text('Новый Проект');
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
				var action = button.data('action');
				var modal = $(this);
				var lastName = button.data('lastname');
				var lastLogin = button.data('lastlogin');
				var editId = button.data('editid');
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
				document.getElementById('actionEmp').value = action;
				if (action == 'Edit'){
					modal.find('.modal-title').text('Редактировать Данные Сотрудника');
					modal.find('.modal-form-group label').text('Фамилия и Имя:');
					document.getElementById('nameEmployee').type = "text";
					document.getElementById('nameEmployee').value = lastName;
					document.getElementById('loginEmployee').value = lastLogin;
					document.getElementById('editIdEmp').value = editId;
				}
				if (action == 'New'){
					modal.find('.modal-title').text('Новый Сотрудник');
					modal.find('.modal-form-group label').text('');
					document.getElementById('nameEmployee').type = "hidden";
					document.getElementById('nameEmployee').value = null;
					document.getElementById('loginEmployee').value = null;
					document.getElementById('editIdEmp').value = null;
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