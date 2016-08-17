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
		<script src="3pty/AdminLTE-2.3.5/plugins/jQuery/jquery-2.2.3.min.js"></script>
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
										{if $array!=null}
										{foreach from=$array item=foo}
										
											<tr>
												<td><a href="/index.php?route=project&projectId={$foo.project_id}&projectName={$foo.project_name}&departmentName={$foo.department_name}&departmentId={$foo.department_id}&nameUser={$name}&roleUser={$role}&Month={$selectedMonthForGet}&Year={$selectedYearForGet}">{$foo.project_name}</a></td>
												<td><a href="/index.php?route=department&departmentId={$foo.department_id}&departmentName={$foo.department_name}&nameUser={$name}&roleUser={$role}&Month={$selectedMonthForGet}&Year={$selectedYearForGet}">{$foo.department_name}</a></td>
												<td><a type="button" class="btn btn-md" data-toggle="modal" data-action="Edit" data-lastname="{$foo.project_name}" data-countselect="{$countselect}" data-departmentid="{$foo.department_id}" data-editid="{$foo.project_id}" data-target="#projectModal" title="Редактировать Данные Проекта"><i class="glyphicon glyphicon-pencil"></i></a></td>
												<td><a type="button" class="btn btn-md" href="/index.php?route=list&content=Project&nameUser={$name}&roleUser={$role}&Month={$selectedMonthForGet}&Year={$selectedYearForGet}&action=remove&projectId={$foo.project_id}" title="Удалить Данные Проекта"><i class="glyphicon glyphicon-trash"></i></a></td>
											</tr>
										{/foreach}
										{/if}
										</tbody>
									</table>
								<a type="button" data-toggle="modal" data-countselect="{$countselect}" data-action="New" data-target="#projectModal" class="btn btn-md" title="Добавить Проект"><i class="glyphicon glyphicon-plus"></i></a>
							</div>
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
										<select name="newDepartmwent" class="form-control select2" id="selectId" style="width: 100%;">
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
										<input name="lastPage" type="hidden" value="list">
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
				if (action == 'Edit'){
					modal.find('.modal-title').text('Редактировать Данные Проекта');
					document.getElementById('nameProject').value = lastName;
					document.getElementById('editId').value = editId;
					document.getElementById('action').value = action;
					for (var i = 0; i < countSelect; i++) {
					var val = document.getElementById('selectId').options[i].value;
						if (val == departmentId){
							document.getElementById('selectId').options[i].selected=true;
						}else{
							document.getElementById('selectId').options[i].selected=false;
						}
					}
				}
				if (action == 'New'){
					modal.find('.modal-title').text('Новый Проект');
					document.getElementById('nameProject').value = null;
					document.getElementById('editId').value = null;
					document.getElementById('action').value = action;
					for (var i = 0; i < countSelect; i++) {
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
	</body>
</html>								