
			<link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">

			<div class="content-wrapper">
				<section class="content-header">
					<div align="right">
						<b style="font-size:23px">Selected date: {"$selectedDate"}</b>
					</div>
					<div align="center">
						<div class="col-lg-100 col-xs-100">
							<div class="small-box bg-yellow">
								<div class="inner">
									<h2>{$employeeName}</h2>
								</div>
								<a class="btn btn-app" href="/EditAndCreate/?content='createPercent'&employeeId={$employeeId}&employeeName={$employeeName}">
									<i class="fa fa-pencil"></i> New Percent
								</a>
								<a class="btn btn-app" href="/EditAndCreate/?content='editEmployee'&employeeId={$employeeId}&employeeName={$employeeName}">
									<i class="fa fa-edit"></i> Edit Employee
								</a>
								<a class="btn btn-app" href="/list/?content='Employee'&action='remove'&employeeId={$employeeId}">
									<i class="fa fa-remove"></i> Remove Employee
								</a>
								<a class="btn btn-app" href="/EditAndCreate/?content='cloneInfo'">
										<i class="fa fa-clone"></i> Clone Information
								</a>
								<div><b>Employee's Time:</b></div>
								<div class="progress" >
									<div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="{$employeePercent}" aria-valuemin="0" aria-valuemax="100" style="width: {$employeePercent}%">
										<span class="sr-only">{$employeePercent}% Complete (success)</span>
									</div>
								</div>
							</div>
						</div>
						<ol class="breadcrumb">
							<li><a href="/index/?action='return'"><i class="fa fa-dashboard"></i>Home</a></li>
							<li><a href="/list/?content='Employee'">List of Employee`s</a></li>
							<li class="active">Employee: {$employeeName}</li>
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
												<th>Name of Project</th>
												<th>Project's Department</th>
												<th style="width:20px">Percent</th>
												<th style="width: 330px"></th>
											</tr>
										</thead>
										<tbody>
										{foreach from=$array item=foo}
											
											<tr>
												<td><a href="/project/?projectId={$foo.project_id}&projectName={$foo.project_name}>{$foo.project_name}</a></td>
												<td><a href="/department/?departmentId={$foo.department_id}&departmentName={$foo.department_name}>{$foo.department_name}</a></td>
												<td>{$foo.time}%</td>
												<td>
													<a href="/EditAndCreate/?content='editPercent'&projectId={$foo.project_id}&projectName={$foo.project_name}&employeeId={$employeeId}&employeeName={$employeeName}" target="_blank">
														<button type="button" style="width:150px" class="btn bg-orange margin btn-xs"><i class="fa fa-edit"></i> Edit Percent</button>
													</a>
													<a href="/employee/?action='remove'&projectId={$foo.project_id}&employeeId={$employeeId}&employeeName={$employeeName}" target="_blank">
														<button type="button" style="width:150px" class="btn bg-red margin btn-xs"><i class="fa fa-remove"></i> Remove Percent</button>
													</a>
												</td>
											</tr>
										{/foreach}
										</tbody>
										<tfoot>
											<tr>
												<th>Name of Project</th>
												<th>Project's Department</th>
												<th>Percent</th>
												<th></th>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>

			<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
			<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
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