<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Tecomgroup | {$title}</title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="stylesheet" href="3pty/AdminLTE-2.3.5/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
		<link rel="stylesheet" href="3pty/AdminLTE-2.3.5/dist/css/AdminLTE.min.css">
		<link rel="stylesheet" href="3pty/AdminLTE-2.3.5/dist/css/skins/skin-blue.min.css">
		<link rel="stylesheet" href="3pty/AdminLTE-2.3.5/plugins/datatables/dataTables.bootstrap.css">
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body class="hold-transition skin-blue layout-top-nav">
		<div class="wrapper">
			<header class="main-header">
				<nav class="navbar navbar-static-top">
					<div class="container">
						<div class="navbar-header">
							<a href="http://www.tecomgroup.com/" class="navbar-brand"><b>Tecom</b>group</a>
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
								<i class="fa fa-bars"></i>
							</button>
						</div>
						{if $role == "Администратор"}<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
							<ul class="nav navbar-nav">
								<li class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown">Admin<span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu">
										<li><b>Role:</b></li>
										<li><a href="#">New Role</a></li>
										<li><a href="#">Change Role</a></li>
										<li><a href="#">Delete Role</a></li>
									</ul>
								</li>
							</ul>
						</div>
						{/if}<div class="navbar-custom-menu">
							<ul class="nav navbar-nav">
								<li>
									<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
								</li>
							</ul>
						</div>
					</div> 
				</nav>
			</header>
			<div class="content-wrapper">
				<section class="content-header">
					<div align="right">
						<b style="font-size:23px">Selected date: {$selectedDate}</b>
					</div>
					<div align="center">
						<div class="col-lg-100 col-xs-100">
 							<div class="small-box bg-yellow">
								<div class="inner">
 									<h2>List of Employees</h2>
 									<a class="btn btn-app" href="/index.php?route=EditAndCreate&content=createEmployee&Month={$selectedMonthForGet}&Year={$selectedYearForGet}">
 										<i class="fa fa-pencil"></i> New Employee
 									</a>
 									<a class="btn btn-app" href="/index.php?route=EditAndCreate&content=cloneInfo&Month={$selectedMonthForGet}&Year={$selectedYearForGet}">
										<i class="fa fa-clone"></i> Clone Information
									</a>
			 					</div>
 		 					</div>
		 				</div>
		 				<ol class="breadcrumb">
							<li><a href="/index.php?route=mainpage&action=return"><i class="fa fa-dashboard"></i>Home</a></li>
							<li class="active">List of Employee`s</li>
						</ol>
					</div>
				</section>
				<section class="content">
 					<div class="row">
						<div class="col-xs-12">
	 						<div class="box">
								<div class="box-body">
									<table id="employee" class="table table-bordered table-striped">
										<thead>
				 			 				<tr>
				 			 					<th style="width: 10px">Id</th>
					 			 				<th>Name of Employee</th>
				 			 				</tr>
				 			 			</thead>
				 			 			<tbody>
				 			 			{foreach from=$array item=foo}
										
											<tr>
												<td>{$foo.employee_id}</td>
												<td><a href="/index.php?route=employee&employeeId={$foo.employee_id}&employeeName={$foo.user_id}&Month={$selectedMonthForGet}&Year={$selectedYearForGet}">{$foo.user_id}</a></td>
											</tr>
										{/foreach}
				 			 			</tbody>
			 			 				<tfoot>
				 			 				<tr>
				 			 					<th>Id</th>
				 			 					<th>Name of Employee</th>
				 			 				</tr>
				 			 			</tfoot>
			 						</table>
			 					</div>
				 			</div>
						</div>
					</div>
				</section>
			</div>		
			<footer class="main-footer">
				<div class="pull-right hidden-xs">
					Anything you want
				</div>
			<strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
			</footer>
			<aside class="control-sidebar control-sidebar-dark">
				<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
					<li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
					<li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="control-sidebar-home-tab">
						<h2 class="control-sidebar-heading">Info about employee:</h2>
						<h4 class="control-sidebar-heading">{$name}</h4>
						<p><h4 class="control-sidebar-heading">{$role}</h4></p>
					</div>
					<div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
					<div class="tab-pane" id="control-sidebar-settings-tab">
						<form method="post">
							<h3 class="control-sidebar-heading">General Settings</h3>
							<div class="form-group">
								<label class="control-sidebar-subheading">
									Report panel usage
									<input type="checkbox" class="pull-right" checked>
								</label>
								<p>Some information about this general settings option</p>
							</div>
						</form>
					</div>
				</div>
			</aside>
		</div>
		
		<!-- REQUIRED JS SCRIPTS -->
		
		<script src="3pty/AdminLTE-2.3.5/plugins/jQuery/jquery-2.2.3.min.js"></script>
		<script src="3pty/AdminLTE-2.3.5/bootstrap/js/bootstrap.min.js"></script>
		<script src="3pty/AdminLTE-2.3.5/dist/js/app.min.js"></script>
		<script src="3pty/AdminLTE-2.3.5/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="3pty/AdminLTE-2.3.5/plugins/datatables/dataTables.bootstrap.min.js"></script>
		<script>
 			$(function () {
 				$('#employee').DataTable({
 					"paging": true,
 					"lengthChange": true,
 					"searching": true,
 					"ordering": true,
 					"info": true,
 					"autoWidth": true
 				});
 			});
		</script>
	</body>
</html>