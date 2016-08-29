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
										{if $arrayEmployeeRoleNamesAndId!=null}
										{foreach from=$arrayEmployeeRoleNamesAndId item=foo}
											
											<tr>
												<td>{$foo.user_name}</td>
												<td>{$foo.department_name}</td>
												{if $foo.head.department_id != null}
												<td>{$foo.role_name}: {$foo.head.department_name}</td>
												<td>
													<a 
														type="button" 
														class="btn btn-md" 
														data-toggle="modal" 
														data-action="Edit" 
														data-lastroleid="{$foo.role_id}" 
														data-lastheadid="{$foo.head.department_id}" 
														data-countselectrole="{$countArrayRoleDefForSelect}" 
														data-countselectdep="{$countArrayDepartmentForSelect}" 
														data-employeeid="{$foo.employee_id}" 
														data-employeename="{$foo.user_name}" 
														data-target="#RoleModal" 
														title="Редактировать Роль Сотрудника">
														<i class="glyphicon glyphicon-pencil"></i>
													</a>
												</td>
												{/if}
												{if $foo.head.department_name == null}
												<td>{$foo.role_name}</td>
												<td>
													<a 
														type="button" 
														class="btn btn-md" 
														data-toggle="modal" 
														data-action="Edit" 
														data-lastroleid="{$foo.role_id}" 
														data-countselectrole="{$countArrayRoleDefForSelect}" 
														data-employeeid="{$foo.employee_id}" 
														data-employeename="{$foo.user_name}" 
														data-target="#RoleModal" 
														title="Редактировать Роль Сотрудника">
														<i class="glyphicon glyphicon-pencil"></i>
													</a>
												</td>
												{/if}
												<td>
													<a 
														type="button" 
														class="btn btn-md" 
														href="/index.php
															?route=role/removeRole
															&nameUser={$name}
															&roleUser={$role}
															&Month={$selectedMonthForGet}
															&Year={$selectedYearForGet}
															&employeeId={$foo.employee_id}" 
														title="Удалить Роль Сотрудника">
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
										data-countselectrole="{$countArrayRoleDefForSelect}" 
										data-target="#RoleModal" 
										class="btn btn-md" 
										title="Добавить Роль Пользователя">
										<i class="glyphicon glyphicon-plus"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class="modal fade" id="RoleModal" role="dialog" aria-labelledby="RoleModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title" id="RoleModalLabel"></h4>
								</div>
								<form action="/index.php" method="get">
									<div class="modal-body">
										<div class="form-group" id="employee"></div>
										<div class="form-group">
											<label>Роль:</label>
											<select 
												id="selectIdRole" 
												name="roleId" 
												class="form-control select2" 
												style="width: 100%;">
												{foreach from=$arrayRoleDefForSelect item=foo}
												
												<option value="{$foo.role_id}">{$foo.role_name}</option>
												{/foreach}
											</select>
										</div>
										<div class="form-group" id="headDepartment"></div>
									</div>
									<div class="modal-footer">
										<div class="input-group hidden">
											<input id="route" name="route" type="hidden" >
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
				$('#RoleModal').on('show.bs.modal', function (event) {
					var button = $(event.relatedTarget);
					var modal = $(this);
					var lastRoleId = button.data('lastroleid');
					var lastHeadId = button.data('lastheadid');
					var employeeName = button.data('employeename');
					var employeeId = button.data('employeeid');
					var countSelectRole = button.data('countselectrole');
					var countSelectDep = button.data('countselectdep');
					if (lastRoleId == null){
						modal.find('.modal-title').text('Новая Роль Пользователя');
						document.getElementById('route').value = 'role/newRole';
						$('#employee').html('<label>Пользователь:<\/label><select name="employeeId" class="form-control select2" id="selectIdEmp" style="width: 100%;">{foreach from=$arrayEmployeeNamesForSelect item=foo}<option value="{$foo.employee_id}">{$foo.user_name}</option>{/foreach}</select>'); 
						var n = document.getElementById('selectIdEmp').options.selectedIndex;
						if (n!=null){
							document.getElementById('selectIdEmp').options[n].selected=false;
						}
						for (var i = 0; i < countSelectRole; i++) {
							document.getElementById('selectIdRole').options[i].selected=false;
						}
					}else{
						modal.find('.modal-title').text('Редактировать Роль Пользоателя');
						document.getElementById('route').value = 'role/editRole';
						$('#employee').html('<label>Пользователь:<\/label><input type="text" class="form-control" id="employeeName" value="" disabled><input type="hidden" class="form-control" name="employeeId" id="employeeId" value="">'); 
						document.getElementById('employeeName').value = employeeName;
						document.getElementById('employeeId').value = employeeId;
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