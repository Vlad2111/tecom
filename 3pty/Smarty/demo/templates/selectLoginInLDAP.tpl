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
		<!-- REQUIRED JS SCRIPTS -->
		<script src="3pty/AdminLTE-2.3.5/plugins/fastclick/fastclick.js"></script>
		<script src="3pty/AdminLTE-2.3.5/dist/js/demo.js"></script>
		<script src="3pty/AdminLTE-2.3.5/plugins/jQuery/jquery-2.2.3.min.js"></script>
		<script src="3pty/AdminLTE-2.3.5/bootstrap/js/bootstrap.min.js"></script>
		<script src="3pty/AdminLTE-2.3.5/dist/js/app.min.js"></script>
		<script src="3pty/AdminLTE-2.3.5/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="3pty/AdminLTE-2.3.5/plugins/datatables/dataTables.bootstrap.min.js"></script>
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<header class="main-header">
			<a class="logo">
				<span class="logo-mini"><small>Теком</small></span>
				<span class="logo-lg"><b>Текомыч</b></span>
			</a>
			<nav class="navbar navbar-static-top">
				<a class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<li>
							<a class="btn btn-lg text-grey" title="Выбрать Дату" disabled><i class="glyphicon glyphicon-calendar"></i></a>				
						</li>
					{if ($selectedMonth!=null)&&($selectedYearForGet!=null)}
						<li>
							<div style="margin-right:100px;">
								<b style="font-size:35px">{$selectedMonth}-{$selectedYearForGet}</b>
							</div>
						</li>
					{/if}
					</ul>
				</div>
			</nav>
		</header>
		<aside class="main-sidebar">
			<section class="sidebar">
				<ul class="sidebar-menu">		
					<li class="{$status1}"><a><i class="fa fa-th-list text-blue"></i><span>Список отделов</span></a></li>
					<li class="{$status2}"><a><i class="fa fa-th-list text-blue"></i><span>Список сотрудников</span></a></li>
					<li class="{$status3}"><a><i class="fa fa-th-list text-blue"></i><span>Список проектов</span></a></li>
				</ul>
				<ul class="sidebar-menu" style="position: fixed; bottom:0;">
					<li><a class="user"><i class="glyphicon glyphicon-user text-blue" aria-hidden="true"></i><span>Пользователь: <p><b>{$name}</b></p></span></a></li>
					<li><a class="user"><i class="glyphicon glyphicon-briefcase text-blue" aria-hidden="true"></i><span>Роль: <p><b>{$role}</b></p></span></a></li>
					<li><a class="user" href="/index.php"><i class="glyphicon glyphicon-log-out text-blue" aria-hidden="true" disabled></i> <span>Выход</span></a></li>
				</ul>
			</section>
		</aside>
		<div class="content-wrapper">
			<section class="content">
				<div class="row">
					<div class="col-xs-12">
						<div class="box">
							<div class="box-header">
								<h3 class="box-title">Список Логинов из LDAP</h3>	
							</div>
							<div class="box-body">
								<table id="LDAP" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>Фамилия и Имя</th>
											<th>Логин</th>
											<th style="width: 18px"></th>
										</tr>
									</thead>
									<tbody>
									{if $array!=null}
									{foreach from=$array item=foo}
									
										<tr>
											<td>{$foo.sn} {$foo.givenName}</td>
											<td>{$foo.sAMAccountName}</td>
											<td><a href="/index.php?route=save&content=Employee&action={$action}&nameUser={$name}&roleUser={$role}&Month={$selectedMonthForGet}&Year={$selectedYearForGet}&editId={$editId}&newDepartmwent={$newDepartmwent}&newLogin={$foo.sAMAccountName}&lastPage={$lastPage}{if $lastPage=='Department'}&departmentId={$departmentId}&departmentName={$departmentName}{/if}{if $lastPage=='Employee'}&employeeId={$employeeId}{/if}" class="btn btn-lg">Выбрать</a></td>
										</tr>
									{/foreach}
									{/if}
									</tbody>
								</table>
								<div align="right">
									<a type="button" href="/index.php?route={$lastPage}&content=Employee&nameUser={$name}&roleUser={$role}&Month={$selectedMonthForGet}&Year={$selectedYearForGet}" class="btn btn-info" data-dismiss="modal">Отмена</a>
								</div>
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
			<strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
		</footer>
		<script>
			$(function () {
				$('#LDAP').DataTable({
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