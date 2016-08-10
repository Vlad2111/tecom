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
		<link rel="stylesheet" href="/css/jquery.fileupload.css">
		<!-- REQUIRED JS SCRIPTS -->
		<script src="3pty/AdminLTE-2.3.5/plugins/fastclick/fastclick.js"></script>
		<script src="3pty/AdminLTE-2.3.5/dist/js/demo.js"></script>
		<script src="3pty/AdminLTE-2.3.5/plugins/jQuery/jquery-2.2.3.min.js" type="text/javascript"></script>
		<script src="3pty/AdminLTE-2.3.5/bootstrap/js/bootstrap.min.js"></script>
		<script src="3pty/AdminLTE-2.3.5/dist/js/app.min.js"></script>
		<script src="3pty/AdminLTE-2.3.5/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="3pty/AdminLTE-2.3.5/plugins/datatables/dataTables.bootstrap.min.js"></script>
		<script src="3pty/AdminLTE-2.3.5/plugins/datepicker/bootstrap-datepicker.js"></script>
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
      						  <b><h3 class="box-title">Список Отделов</h3></b>	
 						   </div>
							<div class="box-body">
								<table id="department" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th style="width: 10px">№</th>
											<th>Название Отдела</th>
											<th style="width: 15px">Редактировать</th>
										</tr>
									</thead>
									<tbody>
									{foreach from=$array item=foo}
									
										<tr>
											<td>{$foo.department_id}</td>
											<td><a href="/index.php?route=department&departmentId={$foo.department_id}&departmentName={$foo.department_name}&Month={$selectedMonthForGet}&Year={$selectedYearForGet}">{$foo.department_name}</a></td>
											<td><a id="refreshBtn" type="button" class="btn btn-md" data-toggle="modal" data-target="#myModal" title="Изменить название отдела"><i class="fa fa-pencil"></i></a></td>
										</tr>
									{/foreach}
									</tbody>
									<tfoot>
										<tr>
											<th>№</th>
											<th>Название Отдела</th>
											<th>Редактировать</th>
										</tr>
									</tfoot>
								</table>
								<a id="refreshBtn" type="button" data-toggle="modal" data-target="#myModal" class="btn btn-md" title="Добавить отдел"><i class="fa fa-pencil"></i></a>
								<a id="refreshBtn" type="button" data-toggle="modal" data-target="#myModal" class="btn btn-md" title="Возврат информации"><i class="fa fa-clone"></i></a>
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
							<div class="modal-body">
								<div class="form-group">
									<label>Date:</label>
									<div class="input-group date" style="z-index:2000;">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input type="text" class="form-control pull-right" id="datepicker">
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary">Save changes</button>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<footer class="main-footer">
			<div class="pull-right hidden-xs">
				<b>Version</b> 2.3.5
			</div>
			<strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
			reserved.
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
				$('#department').DataTable({
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
							"first":      "Первый",
							"last":       "Последний",
							"next":       "Следующая",
							"previous":   "Предыдущая"
							},
						"loadingRecords": "Загрузка...",
						"processing":     "Обработка...",
						"search":         "Поиск:"
					}
				});
			});
		</script>
	</div>
	</body>
</html>						