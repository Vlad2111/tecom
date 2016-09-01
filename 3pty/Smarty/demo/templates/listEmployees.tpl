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
									<h3 class="box-title" style="font-size:23px">Список Сотрудников</h3>	
								</div>
								<div class="box-body">
									<table id="employee" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>Фамилия и Имя</th>
												<th>Отдел</th>
												<th style="width: 18px"></th>
												<th style="width: 18px"></th>
											</tr>
										</thead>
										<tbody>
										{if $arrayEmployeeNames!=null}
										{foreach from=$arrayEmployeeNames item=foo}
										
											<tr>
												<td>
													<a 
														href="/index.php
															?route=Employee/viewEmployee
															&employeeId={$foo.employee_id}
															&employeeName={$foo.user_name}
															&employeeLogin={$foo.user_id}
															&departmentId={$foo.department_id}
															&departmentName={$foo.department_name}
															&nameUser={$name}
															&roleUser={$role}
															&headId={$headId}
															&roleIdUser={$roleId}
															&Month={$selectedMonthForGet}
															&Year={$selectedYearForGet}">
														{$foo.user_name}
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
												<td>
													{if $status == FALSE}
													<a 
														type="button" 
														class="btn btn-md" 
														{if $access == null}
														data-toggle="modal" 
														data-editid="{$foo.employee_id}"
														data-lastlogin="{$foo.user_id}" 
														data-lastname="{$foo.user_name}" 
														data-departmentid="{$foo.department_id}" 
														data-countselect="{$countArrayDepartmentNamesForSelect}"  
														data-target="#employeeModal" 
														{/if}
														title="Редактировать Данные Сотрудника"
														{$access}>
														<i class="glyphicon glyphicon-pencil"></i>
													</a>
													{/if}
												</td>
												<td>
													{if $status == FALSE}
													<a 
														type="button" 
														class="btn btn-md" 
														{if $access == null}
														data-toggle="modal" 
														data-employeeid="{$foo.employee_id}" 
														data-employeename="{$foo.user_name}" 
														data-target="#removeModal" 
														{/if}
														title="Удалить Данные Сотрудника"
														{$access}>
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
										{if $access == null}
										data-toggle="modal" 
										data-countselect="{$countArrayDepartmentNamesForSelect}" 
										data-target="#employeeModal" 
										{/if}
										title="Добавить Сотрудника"
										{$access}>
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
									<h4 class="modal-title" id="employeeModalLabel"></h4>
								</div>
								<form action="/index.php" method="get" onsubmit="diactive()">
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
												id="loginEmployee"
												name="newLogin" 
												type="text" 
												class="form-control"
												required="required">
										</div>
										<div class="form-group">
											<label>Отдел:</label>
											<select 
												id="selectId" 
												name="newDepartment" 
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
											<input id="route" name="route" type="hidden">
											<input id="editId" name="editId" type="hidden">
											<input name="nameUser" type="hidden" value="{$name}">
											<input name="roleUser" type="hidden" value="{$role}">
											<input name="headId" type="hidden" value="{$headId}">
											<input name="roleIdUser" type="hidden" value="{$roleId}">
											<input name="Month" type="hidden" value="{$selectedMonthForGet}">
											<input name="Year" type="hidden" value="{$selectedYearForGet}">
										</div>
										<button id="buttonModalF" style="width: 200px" type="button" class="btn btn-default pull-left" data-dismiss="modal">Отмена</button>
										<button id="buttonModalS" style="width: 200px" type="submit" class="btn btn-primary">Сохранить</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="modal fade" id="removeModal" tabindex="-1" role="dialog" style="margin: 0 auto;">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title" id="removeModalLabel"></h4>
								</div>							
								<form action="/index.php" method="get" onsubmit="diactiveRemove()">
									<div class="modal-body">
									</div>
									<div class="modal-footer">
										<div class="input-group hidden">
											<input name="route" type="hidden" value="List/removeEmployee">
											<input id="employeeId" name="employeeId" type="hidden">
											<input name="nameUser" type="hidden" value="{$name}">
											<input name="roleUser" type="hidden" value="{$role}">
											<input name="Month" type="hidden" value="{$selectedMonthForGet}">
											<input name="Year" type="hidden" value="{$selectedYearForGet}">
											<input name="roleIdUser" type="hidden" value="{$roleId}">
											<input name="headId" type="hidden" value="{$headId}">
										</div>
										<button id="buttonModalFRemove" type="button" class="btn btn-default pull-left" data-dismiss="modal" style="width: 200px">Отмена</button>
										<button id="buttonModalSRemove" type="submit" class="btn btn-primary" style="width: 200px">Да</button>
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
									<h4 class="modal-title" id="changeDataMonthEditingLabel">Вы уверены что хотите заблокировать данные месяца <b>({$selectedMonth}-{$selectedYearForGet})</b> для редактирования.</h4>
								</div>							
								<form action="/index.php" method="get" onsubmit="diactiveChangeDataMonthEditing()">
									<div class="modal-body">
									</div>
									<div class="modal-footer">
										<div class="input-group hidden">
											<input name="route" type="hidden" value="List/changeDataStatusForEditing">
											<input name="lastStatus" type="hidden" value="{$status}">
											<input name="lastPage" type="hidden" value="Employee">
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
					var editId = button.data('editid');
					var lastName = button.data('lastname');
					var lastLogin = button.data('lastlogin');
					var departmentId = button.data('departmentid');
					var countSelect = button.data('countselect');
					for (var i = 0; i < countSelect; i++) {
						var val = document.getElementById('selectId').options[i].value;
						if (val == departmentId){
							document.getElementById('selectId').options[i].selected=true;
						}else{
							document.getElementById('selectId').options[i].selected=false;
						}
					}
					if (editId != null){
						modal.find('.modal-title').text('Редактировать Данные Сотрудника');
						document.getElementById('route').value = 'List/editEmployee';
						document.getElementById('editId').value = editId;
						lastName=lastName.split(' ');
						document.getElementById('nameEmployeeF').value = lastName[1];
						document.getElementById('nameEmployeeS').value = lastName[0];
						document.getElementById('nameEmployeeM').value = lastName[2];
						document.getElementById('loginEmployee').value = lastLogin;
					}else{
						modal.find('.modal-title').text('Новый Сотрудник');
						document.getElementById('route').value = 'List/newEmployee';						
						document.getElementById('editId').value = null;
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
				function diactive() {
					document.getElementById('buttonModalS').disabled = 1;
					document.getElementById('buttonModalF').disabled = 1;
					document.getElementById("loginEmployee").setAttribute("readonly", "readonly");
					document.getElementById("nameEmployeeM").setAttribute("readonly", "readonly");
					document.getElementById("nameEmployeeF").setAttribute("readonly", "readonly");
					document.getElementById("nameEmployeeS").setAttribute("readonly", "readonly");
				}
			</script>
			<script>
				$('#removeModal').on('show.bs.modal', function (event) {
					var button = $(event.relatedTarget);
					var modal = $(this);
					var employeeId = button.data('employeeid');
					var employeeName = button.data('employeename');
					modal.find('.modal-title').html('Вы уверены, что хотите удалить данные сотрудника: <u><b>'+employeeName+'</u></b>');
					document.getElementById('employeeId').value = employeeId;
				});
			</script>
			<script>
				function diactiveRemove() {
					document.getElementById('buttonModalSRemove').disabled = 1;
					document.getElementById('buttonModalFRemove').disabled = 1;
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
		</body>
</html>