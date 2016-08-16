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
								<h3 class="box-title" style="font-size:23px">Пользователи и Роли</h3>
							</div>
							<div class="box-body">
								<table id="role" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>Пользователь</th>
											<th>Отдел</th>
											<th>Роль</th>
											<th style="width: 18px"></th>
											<th style="width: 18px"></th>
										</tr>
									</thead>
									<tbody>
									{if $array!=null}
									{foreach from=$array item=foo}
										
										<tr>
											<td>{$foo.user_name}</td>
											<td>{$foo.department_name}</td>
											<td>{$foo.role_name}</td>
											<td><a type="button" class="btn btn-md" data-toggle="modal" data-action="Edit" data-lastroleid="{$foo.role_id}" data-countselectrole="{$countselectRole}" data-employeeid="{$foo.employee_id}" data-employeename="{$foo.user_name}" data-target="#RoleModal" title="Редактировать Роль Сотрудника"><i class="glyphicon glyphicon-pencil"></i></a></td>
											<td><a type="button" class="btn btn-md" href="/index.php?route=role&nameUser={$name}&roleUser={$role}&Month={$selectedMonthForGet}&Year={$selectedYearForGet}&action=Delete&employeeId={$foo.employee_id}" title="Удалить Роль Сотрудника"><i class="glyphicon glyphicon-trash"></i></a></td>
										</tr>
									{/foreach}
									{/if}
									</tbody>
								</table>
								<a type="button" data-toggle="modal" data-action="New" data-target="#RoleModal" class="btn btn-md" title="Добавить Роль Пользователя"><i class="glyphicon glyphicon-plus"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade" id="RoleModal" role="dialog" aria-labelledby="RoleModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="RoleModalLabel"></h4>
							</div>
							<form action="/index.php" method="get">
								<div class="modal-body">
									<div class="form-group" id="employee"></div>
									<div class="form-group">
										<label>Роль:</label>
										<select name="roleId" class="form-control select2" id="selectIdRole" style="width: 100%;">
											{foreach from=$selectRole item=foo}
											
											<option value="{$foo.role_id}">{$foo.role_name}</option>
											{/foreach}
										</select>
									</div>
								</div>
								<div class="modal-footer">
									<div class="input-group hidden">
										<input name="route" type="hidden" value="role">
										<input id="action" name="action" type="hidden">
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
				<b>Version</b> 2.3.5
			</div>
			<strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
		</footer>
		<script>
			$('#RoleModal').on('show.bs.modal', function (event) {
				var button = $(event.relatedTarget);
				var action = button.data('action');
				var modal = $(this);
				var lastRoleId = button.data('lastroleid');
				var employeeName = button.data('employeename');
				var employeeId = button.data('employeeid');
				var countSelectRole = button.data('countselectrole');
				if (action == 'New'){
					modal.find('.modal-title').text('Новая Роль Пользователя');
					$('#employee').html('<label>Пользователь:<\/label><select name="employeeId" class="form-control select2" id="selectIdEmp" style="width: 100%;">{foreach from=$selectEmp item=foo}<option value="{$foo.employee_id}">{$foo.user_name}</option>{/foreach}</select>'); 
					document.getElementById('action').value = action;
					var n = document.getElementById('selectIdEmp').options.selectedIndex;
					document.getElementById('selectIdEmp').options[n].selected=false;
					var n = document.getElementById('selectIdRole').options.selectedIndex;
					document.getElementById('selectIdRole').options[n].selected=false;
				}
				if (action == 'Edit'){
					modal.find('.modal-title').text('Редактировать Роль Пользоателя');
					$('#employee').html('<label>Пользователь:<\/label><input type="text" class="form-control" id="employeeName" value="" disabled><input type="hidden" class="form-control" name="employeeId" id="employeeId" value="">'); 
					document.getElementById('employeeName').value = employeeName;
					document.getElementById('employeeId').value = employeeId;
					document.getElementById('action').value = action;
					for (var i = 0; i < countSelectRole; i++) {
					var val = document.getElementById('selectIdRole').options[i].value;
						if (val == lastRoleId){
							document.getElementById('selectIdRole').options[i].selected=true;
						}else{
							document.getElementById('selectIdRole').options[i].selected=false;
						}
					}
				}
				$(function () {
					$(".select2").select2({
					modal: true,
					placeholder: "Выбирете....",
					allowClear: true
					});
				});
			});
		</script>

		<script>
			$(function () {
				$('#role').DataTable({
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