
			<link rel="stylesheet" href="3pty/AdminLTE-2.3.5/plugins/datatables/dataTables.bootstrap.css">

			<div class="content-wrapper">
				<section class="content-header">
					<div align="right">
						<b style="font-size:23px">Selected date: {"$selectedDate"}</b>
					</div>
					<div align="center">
						<div class="col-lg-100 col-xs-100">
							<div class="small-box bg-purple">
								<div class="inner">
									<h2>{$departmentName}</h2>
								</div>
								<a class="btn btn-app" href="/EditAndCreate/?content='editDepartment'&departmentId='{$departmentId}'&departmentName='{$departmentName}'">
									<i class="fa fa-edit"></i> Edit
								</a>
								<a class="btn btn-app" href="/list/?content='Department'&action='remove'&departmentId='{$departmentId}'">
									<i class="fa fa-remove"></i> Remove
								</a>
								<a class="btn btn-app" href="/EditAndCreate/?content='cloneInfo'">
										<i class="fa fa-clone"></i> Clone Information
								</a>
							</div>
						</div>
						<ol class="breadcrumb">
							<li><a href="/index/?action='return'"><i class="fa fa-dashboard"></i>Home</a></li>
							<li><a href="/list/?content='Department'">List of Department`s</a></li>
							<li class="active">Department: {$departmentName}</li>
						</ol>
					</div>
				</section>
				<section class="content">
 					<div class="row">
						<div class="col-xs-6">
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
										{if $foo.employee_id != null AND $foo.user_id != null}
										
											<tr>
												<td>{$foo.employee_id}</td>
												<td><a href="/employee/?employeeId='{$foo.employee_id}'&employeeName='{$foo.user_id}'">{$foo.user_id}</a></td>
											</tr>
										{/if}
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
						<div class="col-xs-6">
 							<div class="box">
								<div class="box-body">
									<table id="project" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th style="width: 10px">Id</th>
												<th>Name of Project</th>
											</tr>
										</thead>
										<tbody>
										{foreach from=$array item=foo}
										{if $foo.project_id != null AND $foo.project_name != null}
										
											<tr>
												<th>{$foo.project_id}</th>
												<th><a href="/project/?projectId='{$foo.project_id}'&projectName='{$foo.project_name}'">{$foo.project_name}</a></th>
											</tr>
										{/if}
										{/foreach}
										</tbody>
										<tfoot>
											<tr>
												<th>Id</th>
												<th>Name of Project</th>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>

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
					$('#project').DataTable({
						"paging": true,
						"lengthChange": true,
						"searching": true,
						"ordering": true,
						"info": true,
						"autoWidth": true
					});
				});
			</script>