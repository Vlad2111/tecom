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
									<h3 class="box-title" style="font-size:23px">Список Проектов</h3>	
								</div>
								<div class="box-body">
									<table id="project" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>Название</th>
												<th>Отдел</th>
												<th style="width: 18px"></th>
												<th style="width: 18px"></th>
											</tr>
										</thead>
										<tbody>
										{if $arrayProjectNames!=null}
										{foreach from=$arrayProjectNames item=foo}
										
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
															?route=department/viewDepartment
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
														{if $access == null || $headId == $foo.department_id}
														data-toggle="modal" 
														data-editid="{$foo.project_id}" 
														data-lastname="{$foo.project_name}" 
														data-departmentid="{$foo.department_id}" 
														data-countselect="{$countArrayDepartmentNamesForSelect}" 
														data-target="#projectModal" 
														{/if}
														title="Редактировать Данные Проекта"
														{if $headId != $foo.department_id}
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
														{if $access == null || $headId == $foo.department_id}
														data-toggle="modal" 
														data-projectid="{$foo.project_id}" 
														data-projectname="{$foo.project_name}" 
														data-target="#removeModal" 
														{/if}
														title="Удалить Данные Проекта"
														{if $headId != $foo.department_id}
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
										{if $access == null}
										data-toggle="modal" 
										data-countselect="{$countArrayDepartmentNamesForSelect}" 
										data-target="#projectModal" 
										{/if}
										title="Добавить Проект"
										{$access}>
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
									<h4 class="modal-title" id="projectModalLabel"></h4>
								</div>
								<form action="/index.php" method="get" onsubmit="diactive()">
									<div class="modal-body">
										<div class="form-group">
											<label class="control-label">Название:</label>
											<input 
												id="nameProject"
												name="newName" 
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
											<input name="route" type="hidden" value="list/removeProject">
											<input id="projectId" name="projectId" type="hidden">
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
											<input name="route" type="hidden" value="list/changeDataStatusForEditing">
											<input name="lastStatus" type="hidden" value="{$status}">
											<input name="lastPage" type="hidden" value="Project">
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
				$('#projectModal').on('show.bs.modal', function (event) {
					var button = $(event.relatedTarget);
					var modal = $(this);
					var	 editId = button.data('editid');
					var lastName = button.data('lastname');
					var departmentId = button.data('departmentid');
					var countSelect = button.data('countselect');
					if (editId != null){
						modal.find('.modal-title').text('Редактировать Данные Проекта');
						document.getElementById('route').value = 'list/editProject';
						document.getElementById('editId').value = editId;
						document.getElementById('nameProject').value = lastName;
					}else{
						modal.find('.modal-title').text('Новый Проект');
						document.getElementById('route').value = 'list/newProject';
						document.getElementById('nameProject').value = null;
						document.getElementById('editId').value = null;
					}
					for (var i = 0; i < countSelect; i++) {
					var val = document.getElementById('selectId').options[i].value;
						if (val == departmentId){
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
				function diactive() {
					document.getElementById('buttonModalS').disabled = 1;
					document.getElementById('buttonModalF').disabled = 1;
					document.getElementById("nameProject").setAttribute("readonly", "readonly");
				}
			</script>
			<script>
				$('#removeModal').on('show.bs.modal', function (event) {
					var button = $(event.relatedTarget);
					var modal = $(this);
					var projectId = button.data('projectid');
					var projectName = button.data('projectname');
					modal.find('.modal-title').html('Вы уверены, что хотите удалить данные проекта: <u><b>'+projectName+'</u></b>');
					document.getElementById('projectId').value = projectId;
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