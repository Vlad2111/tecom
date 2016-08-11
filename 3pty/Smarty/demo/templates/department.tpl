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
						<div class="box box-primary">
							<div class="box-header">
									<h3 class="box-title">Отдел: {$departmentName}</h3>	
							</div>
							<div class="box-body">
								<div class="col-xs-6">
									<div class="box">
										<div class="box-header">
											<h3 class="box-title">Сотрудники</h3>	
										</div>
										<div class="box-body">
											<table id="employee" class="table table-bordered table-striped">
												<thead>
													<tr>
														<th>Фамилия и Имя</th>
														<th style="width: 18px"></th>
														<th style="width: 18px"></th>
													</tr>
												</thead>
												<tbody>
												{if $array!=null}
												{foreach from=$array item=foo}
												{if $foo.employee_id != null AND $foo.user_id != null}
													<tr>
														<td><a href="/index.php?route=employee&employeeId={$foo.employee_id}&employeeName={$foo.user_id}&nameUser={$name}&roleUser={$role}&Month={$selectedMonthForGet}&Year={$selectedYearForGet}">{$foo.user_id}</a></td>
														<td><a id="refreshBtn" type="button" class="btn btn-md" data-toggle="modal" data-target="#myModal" title="Редактировать Данные Сотрудника"><i class="glyphicon glyphicon-pencil"></i></a></td>
														<td><a id="refreshBtn" type="button" class="btn btn-md" data-toggle="modal" data-target="#myModal" title="Удалить Данные Сотрудника"><i class="glyphicon glyphicon-trash"></i></a></td>
													</tr>
												{/if}
												{/foreach}
												{/if}
												</tbody>
											</table>
											<a id="refreshBtn" type="button" data-toggle="modal" data-target="#myModal" class="btn btn-md" title="Добавить Информацию о Сотруднике"><i class="glyphicon glyphicon-plus"></i></a>
										</div>
									</div>
								</div>
								<div class="col-xs-6">
									<div class="box">
										<div class="box-header">
											<h3 class="box-title">Проекты</h3>	
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
														<td><a href="/index.php?route=project&projectId={$foo.project_id}&projectName={$foo.project_name}&nameUser={$name}&roleUser={$role}&Month={$selectedMonthForGet}&Year={$selectedYearForGet}">{$foo.project_name}</a></td>
														<td><a id="refreshBtn" type="button" class="btn btn-md" data-toggle="modal" data-target="#myModal" title="Редактировать Данные Проекта"><i class="glyphicon glyphicon-pencil"></i></a></td>
														<td><a id="refreshBtn" type="button" class="btn btn-md" data-toggle="modal" data-target="#myModal" title="Удалить Данные Проекта"><i class="glyphicon glyphicon-trash"></i></a></td>
													</tr>
												{/if}
												{/foreach}
												{/if}
												</tbody>
											</table>
											<a id="refreshBtn" type="button" data-toggle="modal" data-target="#myModal" class="btn btn-md" title="Добавить Проект"><i class="glyphicon glyphicon-plus"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content" style="z-index:1000;">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel">Modal title</h4>
							</div>
							<form action="/index.php?route=list&content=Department&nameUser={$name}&roleUser={$role}" method="get">			
								<div class="modal-body">
									<div class="form-group">
										<label>Date:</label>
										<div class="input-group date" style="z-index:2000;">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input name="date" type="text" class="form-control pull-right" id="datepicker">
											<input name="route" type="hidden" value="list">
											<input name="content" type="hidden" value="Department">
											<input name="nameUser" type="hidden" value="{$name}">
											<input name="roleUser" type="hidden" value="{$role}">
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary" >Save changes</button>
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
			$(function () {
				$('#datepicker').datepicker({
					autoclose: true
				});
			});
		</script>
		<script>
			$(function () {
				$(".select2").select2();
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