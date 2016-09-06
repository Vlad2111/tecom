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
									<h3 class="box-title" style="font-size:23px">Проект: {$projectName}
										{if $status == FALSE}
										<a 
											type="button" 
											class="btn btn-md"
											{if $access == null || $headId == $departmentId}										
											data-toggle="modal" 
											data-departmentid="{$departmentId}" 
											data-countselect="{$countArrayDepartmentNamesForSelect}" 
											data-target="#projectModal" 
											{/if}
											title="Редактировать Данные Проекта"
											{if $headId != $departmentId}
											{$access}
											{/if}>
											<i class="glyphicon glyphicon-pencil"></i>
										</a>
										<a 
											type="button" 
											class="btn btn-md" 
											{if $access == null || $headId == $departmentId}
											data-toggle="modal"  
											data-target="#removeModalPro" 
											{/if}
											title="Удалить Данные Проекта"
											{if $headId != $departmentId}
											{$access}
											{/if}>
											<i class="glyphicon glyphicon-trash"></i>
										</a>
										{/if}
									</h3>	
									<p>(Отдел: {$departmentName})</p>
								</div>
								<div class="box-body">
									<table id="project" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>ФИО</th>
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
															?route=Employee/viewEmployee
															&employeeId={$foo.employee_id}
															&employeeName={$foo.user_name}
															&employeeLogin={$foo.user_id}
															&departmentId={$foo.department_id}
															&departmentName={$foo.department_name}
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
														{if $access == null || $headId == $departmentId}
														data-toggle="modal" 
														data-lasttime="{$foo.time}" 
														data-employeeid="{$foo.employee_id}" 
														data-employeename="{$foo.user_name}" 
														data-target="#timeDistModal" 
														{/if}
														title="Редактировать Данные Распределения Времени"
														{if $headId != $departmentId}
														{$access}
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
														{if $access == null || $headId == $departmentId}
														data-toggle="modal"  
														data-projectname="{$projectName}" 
														data-employeeid="{$foo.employee_id}" 
														data-employeename="{$foo.user_name}"
														data-target="#removeModalTime" 
														{/if}
														title="Удалить Данные Распределения Времени"
														{if $headId != $departmentId}
														{$access}
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
										{if $access == null || $headId == $departmentId}
										data-toggle="modal" 
										data-countselect="{$countArrayEmployeeNamesForDepartmentForSelect}" 
										data-target="#timeDistModal" 
										{/if}
										title="Добавить Распределение Времени"
										{if $headId != $departmentId}
										{$access}
										{/if}>
										<i class="glyphicon glyphicon-plus"></i>
									</a>
									{/if}
								</div>
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
									<h4 class="modal-title" id="projectModalLabel">Редактировать Данные Проекта</h4>
								</div>
								<form action="/index.php" method="get" onsubmit="diactivePro()">
									<div class="modal-body">
										<div class="form-group">
											<label class="control-label">Название:</label>
											<input 
												name="newName" 
												type="text"
												class="form-control" 
												value="{$projectName}"
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
											<input name="route" type="hidden" value="Project/editProject">
											<input name="editId" type="hidden" value="{$projectId}">
											<input name="Month" type="hidden" value="{$selectedMonthForGet}">
											<input name="Year" type="hidden" value="{$selectedYearForGet}">
										</div>
										<button id="buttonModalSPro" type="button" style="width: 200px" class="btn btn-default pull-left" data-dismiss="modal">Отмена</button>
										<button id="buttonModalFPro" type="submit" style="width: 200px" class="btn btn-primary">Сохранить</button>
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
										<div class="form-group" id="employee" >
										</div>
										<div class="modal-form-group">
											<label for="nameProject">Проект</label>
											<input 
												name="projectName" 
												type="text" 
												class="form-control" 
												value="{$projectName}" 
												readonly>
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
											<input name="projectId" type="hidden" value="{$projectId}">
											<input name="departmentId" type="hidden" value="{$departmentId}">
											<input name="departmentName" type="hidden" value="{$departmentName}">
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
					<div class="modal fade" id="removeModalPro" tabindex="-1" role="dialog" style="margin: 0 auto;">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title" id="removeModalProLabel">Вы уверены, что хотите удалить данные проекта: <u><b>{$projectName}</u></b></h4>
								</div>							
								<form action="/index.php" method="get" onsubmit="diactiveRemovePro()">
									<div class="modal-body">
									</div>
									<div class="modal-footer">
										<div class="input-group hidden">
											<input name="route" type="hidden" value="List/removeProject">
											<input name="projectId" type="hidden" value="{$projectId}">
											<input name="Month" type="hidden" value="{$selectedMonthForGet}">
											<input name="Year" type="hidden" value="{$selectedYearForGet}">
										</div>
										<button id="buttonModalFRemovePro" type="button" class="btn btn-default pull-left" data-dismiss="modal" style="width: 200px">Отмена</button>
										<button id="buttonModalSRemovePro" type="submit" class="btn btn-primary" style="width: 200px">Да</button>
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
											<input id="employeeId" name="employeeId" type="hidden">
											<input name="projectId" type="hidden" value="{$projectId}">
											<input name="projectName" type="hidden" value="{$projectName}">
											<input name="departmentId" type="hidden" value="{$departmentId}">
											<input name="departmentName" type="hidden" value="{$departmentName}">
											<input name="Month" type="hidden" value="{$selectedMonthForGet}">
											<input name="Year" type="hidden" value="{$selectedYearForGet}">
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
											<input name="route" type="hidden" value="Project/changeDataStatusForEditing">
											<input name="lastStatus" type="hidden" value="{$status}">
											<input name="projectId" type="hidden" value="{$projectId}">
											<input name="projectName" type="hidden" value="{$projectName}">
											<input name="departmentId" type="hidden" value="{$departmentId}">
											<input name="departmentName" type="hidden" value="{$departmentName}">
											<input name="Month" type="hidden" value="{$selectedMonthForGet}">
											<input name="Year" type="hidden" value="{$selectedYearForGet}">
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
				function diactivePro() {
					document.getElementById('buttonModalSPro').disabled = 1;
					document.getElementById('buttonModalFPro').disabled = 1;
					document.getElementById("nameProject").setAttribute("readonly", "readonly");
				}
			</script>
			<script>
				$('#timeDistModal').on('show.bs.modal', function (event) {
					var button = $(event.relatedTarget);
					var modal = $(this);
					var lasttime = button.data('lasttime');
					var employeeId = button.data('employeeid');
					var employeeName = button.data('employeename');
					var countSelectEmp = button.data('countselect');
					if (employeeName != null){
						modal.find('.modal-title').text('Редактировать Данные Распределения Времени');
						document.getElementById('route').value = 'Project/editPercent';
						$('#employee').html('<label>Сотрудник:</label><input id="employeeName" type="text" class="form-control" readonly><input id="employeeId" name="employeeId" type="hidden">'); 
						document.getElementById('employeeId').value = employeeId;
						document.getElementById('employeeName').value = employeeName;
						document.getElementById('TimeDistr').value = lasttime;
					}else{
						modal.find('.modal-title').text('Новое Распределение Времени');
						document.getElementById('route').value = 'Project/newPercent';
						$('#employee').html('<label>Сотрудник:</label><select id="selectIdEmp" name="employeeId" class="form-control select2" style="width: 100%;" required="required">{foreach from=$arrayEmployeeNamesForDepartmentForSelect item=foo}<option value="{$foo.employee_id}">{$foo.user_name}</option>{/foreach}{foreach from=$arrayEmployeeNamesNotForDepartmentForSelect item=foo}<option value="{$foo.employee_id}">{$foo.user_name}</option>{/foreach}</select>'); 
						document.getElementById('TimeDistr').value = null;
						for (var i = 0; i < countSelectEmp; i++) {
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
				function diactiveTime() {
					document.getElementById('buttonModalSTime').disabled = 1;
					document.getElementById('buttonModalFTime').disabled = 1;
					document.getElementById("TimeDistr").setAttribute("readonly", "readonly");
				}
			</script>
			<script>
				function diactiveRemovePro() {
					document.getElementById('buttonModalSRemovePro').disabled = 1;
					document.getElementById('buttonModalFRemovePro').disabled = 1;
				}
			</script>
			<script>
				$('#removeModalTime').on('show.bs.modal', function (event) {
					var button = $(event.relatedTarget);
					var modal = $(this);
					var employeeId = button.data('employeeid');
					var projectName = button.data('projectname');
					var employeeName = button.data('employeename');
					modal.find('.modal-title').html('Вы уверены, что хотите удалить данные распредеения времени сотрудника: <u><b>'+employeeName+'</u></b> для проекта: <u><b>'+projectName+'</u></b>');
					document.getElementById('employeeId').value = employeeId;
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
