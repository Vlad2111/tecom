		<header class="main-header">
			<a class="logo">
				<span class="logo-mini"><b>Б.Д.</b></span>
				<span class="logo-lg"><b>Текомыч</b> б.д.</span>
			</a>
			<nav class="navbar navbar-static-top">
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
					 {if $selectedDate != null}
						<li>
							<div align="right">	
								<b style="font-size:35px">Выбрана дата: {$selectedDate}</b>
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
                    <li class="active"><a href="/index.php?route=list&content=Department&nameUser={$name}&roleUser={$role}"><i class="fa fa-th-list text-blue"></i><span>Список отделов</span></a></li>
                    <li><a href="/index.php?route=list&content=Employee&nameUser={$name}&roleUser={$role}"><i class="fa fa-th-list text-blue"></i><span>Список сотрудников</span></a></li>
                    <li><a href="/index.php?route=list&content=Project&nameUser={$name}&roleUser={$role}"><i class="fa fa-th-list text-blue"></i><span>Список проектов</span></a></li>
                    {if $role = "Администратор"}
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