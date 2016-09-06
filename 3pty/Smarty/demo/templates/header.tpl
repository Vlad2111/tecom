			<!-- REQUIRED CSS SCRIPTS -->
			<link rel="stylesheet" href="3pty/AdminLTE-2.3.5/dist/css/skins/_all-skins.min.css">
			<link rel="stylesheet" href="3pty/AdminLTE-2.3.5/bootstrap/css/bootstrap.min.css">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
			<link rel="stylesheet" href="3pty/AdminLTE-2.3.5/dist/css/AdminLTE.min.css">
			<link rel="stylesheet" href="3pty/AdminLTE-2.3.5/dist/css/skins/skin-blue.min.css">
			<link rel="stylesheet" href="3pty/AdminLTE-2.3.5/plugins/datatables/dataTables.bootstrap.css">
			<link rel="stylesheet" href="3pty/AdminLTE-2.3.5/plugins/daterangepicker/daterangepicker.css">
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
			<script src="3pty/AdminLTE-2.3.5/plugins/daterangepicker/moment.min.js"></script>
			<script src="3pty/AdminLTE-2.3.5/plugins/daterangepicker/daterangepicker.js"></script>
			<script src="3pty/AdminLTE-2.3.5/plugins/select2/select2.full.min.js"></script>
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
								<a data-toggle="modal" data-target="#dateChoose" class="btn btn-lg text-grey" title="Выбрать Дату"><i class="glyphicon glyphicon-calendar"></i></a>					
							</li>
							{if ($selectedMonth!=null)&&($selectedYearForGet!=null)}
							<li>
								<div style="margin-right:100px;">
									<b style="font-size:35px">{$selectedMonth}-{$selectedYearForGet}</b>
								</div>
							</li>
							<li>
								<a data-toggle="modal" data-target="#changeDataMonthEditing" class="btn btn-lg text-grey" title="Изменить статус редактирования данных для данного месяца">
									<i class="glyphicon glyphicon-refresh"></i>
								</a>
							</li>
							{/if}
						</ul>
					</div>
				</nav>
			</header>
			<aside class="main-sidebar">
				<section class="sidebar">
					<ul class="sidebar-menu">		
						<li class="{$status1}">
							<a 
								href="/index.php
									?route=List/viewListDepartment
									&Month={$selectedMonthForGet}
									&Year={$selectedYearForGet}">
								<i class="fa fa-th-list text-blue"></i>
								<span>Список отделов</span>
							</a>
						</li>
						<li class="{$status2}">
							<a 
								href="/index.php
									?route=List/viewListEmployee
									&Month={$selectedMonthForGet}
									&Year={$selectedYearForGet}">
								<i class="fa fa-th-list text-blue"></i>
								<span>Список сотрудников</span>
							</a>
						</li>
						<li class="{$status3}">
							<a 
								href="/index.php
									?route=List/viewListProject
									&Month={$selectedMonthForGet}
									&Year={$selectedYearForGet}">
								<i class="fa fa-th-list text-blue"></i>
								<span>Список проектов</span>
							</a>
						</li>
						{if $role=="Администратор" || $role=="Директор Компании" || $role=="Отдел Кадров"}
							<li>
								<a 
									data-toggle="modal" 
									data-target="#cloneInfo" 
									title="Копирование Информации Базы Данных из Одного Месяца в Другой">
									<i class="fa fa-clone text-blue"></i>
									<span>Новый месяц</span>
								</a>
							</li>
						{/if}
						{if $role=="Администратор" || $role=="Директор Компании" || $role=="Отдел Кадров"}
							<li>
								<a 
									data-toggle="modal" 
									data-target="#fileReaderXLSX" 
									title="Чтение Excel файла">
									<i class="glyphicon glyphicon-open-file text-blue"></i>
									<span>Загрузить Excel файл</span>
								</a>
							</li>
						{/if}
						{if $role=="Администратор" || $role=="Директор Компании"}
							<li class="{$status4}">
								<a 
									href="/index.php
										?route=Role/viewRole
										&Month={$selectedMonthForGet}
										&Year={$selectedYearForGet}">
									<i class="fa fa-user-secret text-blue"></i>
									<span>Пользователи и Роли</span>
								</a>
							</li>
						{/if}
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown">
								<i class="glyphicon glyphicon-file text-blue"></i>
								<span>Отчеты</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="#">Список отделов</a></li>
								<li><a href="#">Список сотрудников</a></li>
								<li><a href="#">список проектов</a></li>
							</ul>
						</li>
					</ul>
					<ul class="sidebar-menu" style="position: fixed; bottom:0;">
						<li style="width:230px;">
							<a class="user">
								<i class="glyphicon glyphicon-user text-blue" aria-hidden="true"></i>
								<span>Пользователь: <p><b>{$name}</b></p></span>
							</a>
						</li>
						<li>
							<a class="user">
								<i class="glyphicon glyphicon-briefcase text-blue" aria-hidden="true"></i>
								<span>Роль: <p><b>{$role}</b></p></span>
							</a>
						</li>
						<li>
							<a class="user" href="/index.php?action=Exit">
								<i class="glyphicon glyphicon-log-out text-blue" aria-hidden="true"></i>
								<span>Выход</span>
							</a>
						</li>
					</ul>
				</section>
			</aside>
			<div class="modal fade" id="dateChoose" tabindex="-1" role="dialog" aria-labelledby="dateChooseLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content" style="z-index:1000;">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="dateChooseLabel">Выбор Даты</h4>
						</div>
						<form action="/index.php" method="get" onsubmit="diactivedate()">			
							<div class="modal-body">
								<div class="form-group">
									<label>Дата:</label>
									<div class="input-group date" style="z-index:2000;">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input name="date" type="text" class="form-control pull-right" id="datepicker" required="required">
									</div>
									<div class="input-group hidden">
										<input name="route" type="hidden" value="List/viewListDepartment">
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button id="buttonModalFdate" type="button" class="btn btn-default pull-left" data-dismiss="modal" style="width: 200px">Отмена</button>
								<button id="buttonModalSdate" type="submit" class="btn btn-primary" style="width: 200px">Сохранить</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal fade" id="cloneInfo" tabindex="-1" role="dialog" aria-labelledby="cloneInfoLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content" style="z-index:1000;">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="cloneInfoLabel">Копирование Информации из Месяца в Месяц</h4>
						</div>
						<form action="/index.php" method="get" onsubmit="diactivecopy()">			
							<div class="modal-body">
								<div class="form-group">
									<label>Дата Откуда Копируем:</label>
									<div class="input-group date" style="z-index:2000;">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input name="dateFrom" type="text" class="form-control pull-right" id="datepicker1" required="required">
									</div>
									<label>Дата Куда Копируем:</label>
									<div class="input-group date" style="z-index:2000;">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input name="dateTo" type="text" class="form-control pull-right" id="datepicker2" required="required">
									</div>
									<div class="input-group hidden">
										<input name="route" type="hidden" value="List/cloneData">
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button id="buttonModalFcopy" type="button" class="btn btn-default pull-left" data-dismiss="modal" style="width: 200px">Отмена</button>
								<button id="buttonModalScopy" type="submit" class="btn btn-primary" style="width: 200px">Сохранить</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal fade" id="fileReaderXLSX" tabindex="-1" role="dialog" aria-labelledby="fileReaderXLSXLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content" style="z-index:1000;">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="fileReaderXLSXLabel">Загрузка файла</h4>
						</div>
						<form 
							action="/index.php
								?route=SaveXLSX/readerXLSXFile
								&Month={$selectedMonthForGet}
								&Year={$selectedYearForGet} "
							role="form" 
							enctype="multipart/form-data" 
							method="post"
							onsubmit="diactivefile()">			
							<div class="modal-body">
								<div class="form-group">
									<label>Файл:</label>
									<input type="file" id="inputFile" name="file" accept=".xlsx, .xls, .csv" required="required">
								</div>
								<div class="form-group">
									<label>Название листа с таблицей распределения времени:</label>
									<input id="nameSheet" name="nameSheet" type="text" class="form-control" required="required">
								</div>
								<div class="form-group">
									<label>Даты для импорта:</label>
									<div class="row">
										<div class="col-xs-6">
											<label>C:</label>
											<div class="input-group date" style="z-index:2000;">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input name="date1" type="text" class="form-control pull-right" id="datepickerXLSX1">
											</div>
										</div>
										<div class="col-xs-6">
											<label>До:</label>
											<div class="input-group date" style="z-index:2000;">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input name="date2" type="text" class="form-control pull-right" id="datepickerXLSX2">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button id="buttonModalFfile" type="button" class="btn btn-default pull-left" data-dismiss="modal" style="width: 200px">Отмена</button>
								<button id="buttonModalSfile" type="submit" class="btn btn-primary" style="width: 200px">Сохранить</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<script>
				$(function () {
					$('#datepicker').datepicker({
						autoclose: true
					});
				});
			</script>
			<script>
				$(function () {
					$('#datepicker1').datepicker({
						autoclose: true
					});
				});
			</script>
			<script>
				$(function () {
					$('#datepicker2').datepicker({
						autoclose: true
					});
				});
			</script>
			<script>
				$(function () {
					$('#datepickerXLSX1').datepicker({
						autoclose: true
					});
				});
			</script>
			<script>
				$(function () {
					$('#datepickerXLSX2').datepicker({
						autoclose: true
					});
				});
			</script>
			<script>
				function diactivefile() {
					document.getElementById('buttonModalSfile').disabled = 1;
					document.getElementById('buttonModalFfile').disabled = 1;
					document.getElementById("nameSheet").setAttribute("readonly", "readonly");
				}
			</script>
			<script>
				function diactivecopy() {
					document.getElementById('buttonModalScopy').disabled = 1;
					document.getElementById('buttonModalFcopy').disabled = 1;
				}
			</script>
			<script>
				function diactivedate() {
					document.getElementById('buttonModalSdate').disabled = 1;
					document.getElementById('buttonModalFdate').disabled = 1;
				}
			</script>