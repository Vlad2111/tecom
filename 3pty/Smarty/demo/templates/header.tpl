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
						{/if}
					</ul>
				</div>
			</nav>
		</header>
		<aside class="main-sidebar">
			<section class="sidebar">
				<ul class="sidebar-menu">		
					<li class="{$status1}"><a href="/index.php?route=list&content=Department&nameUser={$name}&roleUser={$role}&Month={$selectedMonthForGet}&Year={$selectedYearForGet}"><i class="fa fa-th-list text-blue"></i><span>Список отделов</span></a></li>
					<li class="{$status2}"><a href="/index.php?route=list&content=Employee&nameUser={$name}&roleUser={$role}&Month={$selectedMonthForGet}&Year={$selectedYearForGet}"><i class="fa fa-th-list text-blue"></i><span>Список сотрудников</span></a></li>
					<li class="{$status3}"><a href="/index.php?route=list&content=Project&nameUser={$name}&roleUser={$role}&Month={$selectedMonthForGet}&Year={$selectedYearForGet}"><i class="fa fa-th-list text-blue"></i><span>Список проектов</span></a></li>
					<li><a data-toggle="modal" data-target="#cloneInfo" title="Копирование Информации Базы Данных из Одного Месяца в Другой"><i class="fa fa-clone text-blue"></i><span>Возврат Информации</span></a></li>
					{if $role=="Администратор"}
					<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-secret text-blue"></i><span>Действия Администратора</span></a>
						<ul class="treeview-menu">
							<li><a><b>Роли:</b></a></li>
							<li><a href="#">Создать роль</a></li>
							<li><a href="#">Изменить роль</a></li>
							<li><a href="#">Удалить роль</a></li>
						</ul>
					</li>
					{/if}
				</ul>
				<ul class="sidebar-menu" style="position: fixed; bottom:0;">
					<li><a class="user"><i class="glyphicon glyphicon-user text-blue" aria-hidden="true"></i><span>Пользователь: <p><b>{$name}</b></p></span></a></li>
					<li><a class="user"><i class="glyphicon glyphicon-briefcase text-blue" aria-hidden="true"></i><span>Роль: <p><b>{$role}</b></p></span></a></li>
					<li><a class="user" href="/index.php"><i class="glyphicon glyphicon-log-out text-blue" aria-hidden="true"></i> <span>Выход</span></a></li>
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
					<form action="/index.php" method="get">			
						<div class="modal-body">
							<div class="form-group">
								<label>Дата:</label>
								<div class="input-group date" style="z-index:2000;">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input name="date" type="text" class="form-control pull-right" id="datepicker">
								</div>
								<div class="input-group hidden">
									<input name="route" type="hidden" value="list">
									<input name="content" type="hidden" value="Department">
									<input name="nameUser" type="hidden" value="{$name}">
									<input name="roleUser" type="hidden" value="{$role}">
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
							<button type="submit" class="btn btn-primary" >Сохранить</button>
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
					<form action="/index.php" method="get">			
						<div class="modal-body">
							<div class="form-group">
								<label>Дата Откуда Копируем:</label>
								<div class="input-group date" style="z-index:2000;">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input name="dateFrom" type="text" class="form-control pull-right" id="datepicker1">
								</div>
								<label>Дата Куда Копируем:</label>
								<div class="input-group date" style="z-index:2000;">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input name="dateTo" type="text" class="form-control pull-right" id="datepicker2">
								</div>
								<div class="input-group hidden">
									<input name="route" type="hidden" value="list">
									<input name="content" type="hidden" value="Department">
									<input name="nameUser" type="hidden" value="{$name}">
									<input name="roleUser" type="hidden" value="{$role}">
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
							<button type="submit" class="btn btn-primary" >Сохранить</button>
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