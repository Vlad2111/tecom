<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Tecomgroup | {$title}</title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	</head>
	<body style="height:100%;" class="hold-transition skin-blue sidebar-mini">
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
										{$i = 0}{if $arrayEmployeeRoleNamesAndId!=null}
										{foreach from=$arrayEmployeeRoleNamesAndId item=foo}
											
											<tr>
												<td>{$foo.user_name}</td>
												<td>{$foo.department_name}</td>
												{if $foo.head.0.department_id != null}
													<td>
													{if $foo.head.1.department_name==null}{$foo.role_name}: {$foo.head.0.department_name}{/if}
													{if $foo.head.1.department_name!=null}Глава Отделов: 
														{foreach from=$foo.head item=foo1} 

															{if $foo1.department_id != $foo.head.0.department_id}, {/if}
															<b><u>{$foo1.department_name}</b></u> 
														{/foreach}
													{/if}
													</td>
													<td>
														<a 
															type="button" 
															class="btn btn-md" 
															data-toggle="modal" 
															data-lastroleid="{$foo.role_id}" 
															{if $foo.head.1.department_name==null}
															data-lastheadid="{$foo.head.0.department_id}" {/if}
															{if $foo.head.1.department_name!=null}
															{$i=0}
															{foreach from=$foo.head item=foo1} {$i=$i+1}
															data-lastheadid{$i}="{$foo1.department_id}" {/foreach}{/if}
															data-countselectrole="{$countArrayRoleDefForSelect}" 
															data-countselectdep="{$countArrayDepartmentNamesForSelect}"
															data-employeeid="{$foo.employee_id}" 
															data-employeename="{$foo.user_name}" 
															data-target="#RoleModal" 
															title="Редактировать Роль Сотрудника">
															<i class="glyphicon glyphicon-pencil"></i>
														</a>
													</td>
													<td>
														<a 
															type="button" 
															class="btn btn-md" 
															data-toggle="modal"  
															data-employeeid="{$foo.employee_id}" 
															data-employeename="{$foo.user_name}" 
															data-rolename="{$foo.role_name}" 
															data-target="#removeModal"
															{if $foo.head.1.department_name==null}
															data-lastheadid="{$foo.head.0.department_id}" {/if}
															{if $foo.head.1.department_name!=null}
															{$i=0}
															{foreach from=$foo.head item=foo1} {$i=$i+1}
															data-lastheadid{$i}="{$foo1.department_name}" {/foreach}{/if}
															title="Удалить Роль Сотрудника">
															<i class="glyphicon glyphicon-trash"></i>
														</a>
													</td>
												{/if}
												{if $foo.head.0.department_name == null}
													<td>{$foo.role_name}</td>
													<td>
														<a 
															type="button" 
															class="btn btn-md" 
															data-toggle="modal" 
															data-lastroleid="{$foo.role_id}" 
															data-countselectrole="{$countArrayRoleDefForSelect}" 
															data-employeeid="{$foo.employee_id}" 
															data-employeename="{$foo.user_name}" 
															data-target="#RoleModal" 
															title="Редактировать Роль Сотрудника">
															<i class="glyphicon glyphicon-pencil"></i>
														</a>
													</td>
													<td>
														<a 
															type="button" 
															class="btn btn-md" 
															data-toggle="modal"  
															data-employeeid="{$foo.employee_id}" 
															data-employeename="{$foo.user_name}" 
															data-rolename="{$foo.role_name}" 
															data-target="#removeModal" 
															title="Удалить Роль Сотрудника">
															<i class="glyphicon glyphicon-trash"></i>
														</a>
													</td>
												{/if}
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
							<div class="modal-content" style="z-index:1000;">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title" id="RoleModalLabel"></h4>
								</div>
								<form action="/index.php" method="get" onsubmit="diactive()">
									<div class="modal-body">
										<div class="form-group" id="employee"></div>
										<div class="form-group">
											<label>Роль:</label>
											<select 
												id="selectIdRole" 
												name="roleId" 
												class="form-control select2" 
												style="width: 100%;"
												onChange="headDepRole()"
												required="required">
												{foreach from=$arrayRoleDefForSelect item=foo}
												
												<option value="{$foo.role_id}">{$foo.role_name}</option>
												{/foreach}
											</select>
										</div>
										<div class="form-group" id="department" style="z-index:2000;"></div>
										<div class="form-group" id="headDepartment"></div>
									</div>
									<div class="modal-footer">
										<div class="input-group hidden">
											<input id="route" name="route" type="hidden" >
											<input id="lastHeadId" name="lastHeadDepartmentId" type="hidden">
											<input name="Month" type="hidden" value="{$selectedMonthForGet}">
											<input name="Year" type="hidden" value="{$selectedYearForGet}">
										</div>
										<button id="buttonModalF" type="button" style="width: 200px" class="btn btn-default pull-left" data-dismiss="modal" style="width: 200px">Отмена</button>
										<button id="buttonModalS" type="submit" style="width: 200px" class="btn btn-primary" style="width: 200px">Сохранить</button>
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
											<input name="route" type="hidden" value="Role/removeRole">
											<input id="employeeId" name="employeeId" type="hidden">
											<input id="lastHeadId" name="lastHeadDepartmentId" type="hidden">
											<input name="Month" type="hidden" value="{$selectedMonthForGet}">
											<input name="Year" type="hidden" value="{$selectedYearForGet}">
										</div>
										<button id="buttonModalFRemove" type="button" class="btn btn-default pull-left" data-dismiss="modal" style="width: 200px">Отмена</button>
										<button id="buttonModalSRemove" type="submit" class="btn btn-primary" style="width: 200px">Да</button>
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
					var countI = {$i};
					var lastHeadId = [];
					for (var i = 1; i <= countI; i++) {
						lastHeadId[i] = button.data('lastheadid'+i);
					}
					var employeeName = button.data('employeename');
					var employeeId = button.data('employeeid');
					var countSelectRole = button.data('countselectrole');
					var countSelectDep = button.data('countselectdep');
					if (lastRoleId == null){
						$('#department').html('');
						modal.find('.modal-title').text('Новая Роль Пользователя');
						document.getElementById('route').value = 'Role/newRole';
						document.getElementById('lastHeadId').value = null;
						$('#employee').html('<label>Пользователь:<\/label><select name="employeeId" class="form-control select2" id="selectIdEmp" style="width: 100%;" required="required">{foreach from=$arrayEmployeeNamesForSelect item=foo}<option value="{$foo.employee_id}">{$foo.user_name}</option>{/foreach}</select>'); 
						var n = document.getElementById('selectIdEmp').options.selectedIndex;
						if (n!=null){
							document.getElementById('selectIdEmp').options[n].selected=false;
						}
						for (var i = 0; i < countSelectRole; i++) {
							document.getElementById('selectIdRole').options[i].selected=false;
						}
					}else{
						modal.find('.modal-title').text('Редактировать Роль Пользоателя');
						document.getElementById('route').value = 'Role/editRole';
						$('#employee').html('<label>Пользователь:<\/label><input type="text" class="form-control" id="employeeName" disabled><input type="hidden" class="form-control" name="employeeId" id="employeeId" value="">'); 
						document.getElementById('employeeName').value = employeeName;
						if(lastHeadId[1]!=null){
							document.getElementById('lastHeadId').value = lastHeadId[1];
							$('#department').html('<label>Отдел:<\/label><select name="headDepartmentId[]" multiple="multiple" class="form-control select2" id="selectIdHead" style="width: 100%;" required="required">{foreach from=$arrayDepartmentNamesForSelect item=foo}<option value="{$foo.department_id}">{$foo.department_name}</option>{/foreach}</select>'); 
							for (var i = 0; i < countSelectDep; i++) {
								var val = document.getElementById('selectIdHead').options[i].value;
								document.getElementById('selectIdHead').options[i].selected=false;
								for (var j = 1; j <= countI; j++) {
									if (val == lastHeadId[j]){
										document.getElementById('selectIdHead').options[i].selected=true;
									}
								}
							}
						}else{
							document.getElementById('lastHeadId').value = null;
							$('#department').html('');
						}
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
				
				function headDepRole() {
					var n = document.getElementById('selectIdRole').options.selectedIndex;
					var val = document.getElementById('selectIdRole').options[n].value;
					if (val == '1'){
						$('#department').html('<label>Отдел:<\/label><select name="headDepartmentId[]" multiple="multiple" class="form-control select2" id="selectIdHead" style="width: 100%;" required="required">{foreach from=$arrayDepartmentNamesForSelect item=foo}<option value="{$foo.department_id}">{$foo.department_name}</option>{/foreach}</select>'); 
					}else{
						$('#department').html('');
					}
					$(function () {
						$(".select2").select2({
						modal: true,
						placeholder: "Выбирете....",
						allowClear: true
						});
					});
				}
			</script>
			<script>
				function diactive() {
					document.getElementById('buttonModalS').disabled = 1;
					document.getElementById('buttonModalF').disabled = 1;
				}
			</script>
			<script>
				$('#removeModal').on('show.bs.modal', function (event) {
					var button = $(event.relatedTarget);
					var modal = $(this);
					var employeeId = button.data('employeeid');
					var employeeName = button.data('employeename');
					var lastHeadId = button.data('lastheadid');
					var roleName = button.data('rolename');
					modal.find('.modal-title').html('Вы уверены, что хотите удалить данные роли сотрудника: <u><b>'+employeeName+'</u></b>. Роль: <u><b>'+roleName+'</u></b>');
					document.getElementById('employeeId').value = employeeId;
					if(lastHeadId!=null){
						document.getElementById('lastHeadId').value = lastHeadId;
					}else{
						document.getElementById('lastHeadId').value = null;
					}
				});
			</script>
			<script>
				function diactiveRemove() {
					document.getElementById('buttonModalSRemove').disabled = 1;
					document.getElementById('buttonModalFRemove').disabled = 1;
				}
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
						"stateSave": true,
						"stateDuration": -1,
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
