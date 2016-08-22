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
								<h3 class="box-title" style="font-size:23px">Пользователи с Ошибками в Логинах</h3>
							</div>
							<div class="box-body">
								<table id="employee" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>Пользователь</th>
											<th>Отдел</th>
											<th>Логин</th>
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
											<td>{$foo.user_id}</td>
											<td>
												<a 
													type="button" 
													class="btn btn-md" 
													data-toggle="modal" 
													data-action="Edit" 
													data-lastname="{$foo.user_name}" 
													data-lastlogin="{$foo.user_id}" 
													data-countselect="{$countArrayDepartmentNamesForSelect}" 
													data-departmentid="{$foo.department_id}" 
													data-departmentname="{$foo.department_name}" 
													data-editid="{$foo.employee_id}" 
													data-target="#employeeModal" 
													title="Редактировать Данные Сотрудника">
													<i class="glyphicon glyphicon-pencil"></i>
												</a>
											</td>
										</tr>
									{/foreach}
									{/if}
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade" id="employeeModal" role="dialog" aria-labelledby="employeeModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="employeeModalLabel">Редактировать Данные Сотрудника</h4>
							</div>
							<form action="/index.php" method="get">
								<div class="modal-body">
									<div class="modal-form-group">
										<label for="nameEmployee">Фамилия и Имя:</label>
										<input type="text" class="form-control" id="nameEmployee" value="" disabled>
									</div>
									<div class="form-group">
										<label>Логин:</label>
										<input name="newLogin" type="text" class="form-control" id="loginEmployee" value="" >
									</div>
									<div class="form-group">
										<label>Отдел:</label>
										<input type="text" id="departmentName" value="" disabled>
										<input name="newDepartmwent" type="hidden" id="departmentId" value="" >
									</div>
								</div>
								<div class="modal-footer">
									<div class="input-group hidden">
										<input name="route" type="hidden" value="falseList/editEmployee">
										<input id="action" name="action" type="hidden">
										<input name="nameUser" type="hidden" value="{$name}">
										<input name="roleUser" type="hidden" value="{$role}">
										<input name="Month" type="hidden" value="{$selectedMonthForGet}">
										<input name="Year" type="hidden" value="{$selectedYearForGet}">
										<input id="editId" name="editId" type="hidden">
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
				var action = button.data('action');
				var modal = $(this);
				var lastName = button.data('lastname');
				var lastLogin = button.data('lastlogin');
				var editId = button.data('editid');
				var departmentId = button.data('departmentid');
				var departmentName = button.data('departmentname');
				if (action == 'Edit'){
					document.getElementById('nameEmployee').value = lastName;
					document.getElementById('loginEmployee').value = lastLogin;
					document.getElementById('editId').value = editId;
					document.getElementById('action').value = action;
					document.getElementById('departmentName').value = departmentName;
					document.getElementById('departmentId').value = departmentId;
				}
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