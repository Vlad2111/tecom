
			<link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">

			<div class="content-wrapper">
				<section class="content-header">
					<div align="right">
						<b style="font-size:23px">Selected date: {"$selectedDate"}</b>
					</div>
					<div align="center">
						<div class="col-lg-100 col-xs-100">
							<div class="small-box bg-red">
								<div class="inner">
									<h2>Project</h2>
								</div>
								<a class="btn btn-app" href="/EditAndCreate/?content='createPercent'&projectId={$projectId}&projectName={$projectName}">
									<i class="fa fa-pencil"></i>New Percent
								</a>
								<a class="btn btn-app" href="/EditAndCreate/?content='editProject'&projectId={$projectId}&projectName={$projectName}">
									<i class="fa fa-edit"></i>Edit Project
								</a>
								<a class="btn btn-app" href="/list/?content='Project'&action='remove'&projectId={$projectId}>
									<i class="fa fa-remove"></i>Remove Project
								</a>
								<a class="btn btn-app" href="/EditAndCreate/?content='cloneInfo'">
										<i class="fa fa-clone"></i> Clone Information
								</a>
							</div>
						</div>
						<ol class="breadcrumb">
							<li><a href="/index/?action='return'"><i class="fa fa-dashboard"></i>Home</a></li>
							<li><a href="/list/?content='Project'">List of Project</a></li>
							<li class="active">Project: {$projectName}</li>
						</ol>
					</div>
				</section>

				<section class="content">
 					<div class="row">
						<div class="col-xs-12">
 							<div class="box">
								<div class="box-body">
									<table id="project" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>Employee`s Name</th>
												<th style="width:20px">Percent</th>
												<th style="width: 330px"></th>
											</tr>
										</thead>
										<tbody>
										{foreach from=$array item=foo}
				
											<tr>
												<th><a href="/employee/?employeeId={$foo.employee_id}&employeeName={$foo.user_id}>{$foo.user_id}</a></th>
												<td>{$foo.time}%</td>
												<td>
													<a href="/EditAndCreate/?content='editPercent'&projectId={$projectId}&projectName={$projectName}&employeeId={$foo.employee_id}&employeeName={$foo.user_id}" target="_blank">
														<button type="button" style="width:150px" class="btn bg-orange margin btn-xs"><i class="fa fa-edit"></i> Edit Percent</button>
													</a>
													<a href="/project/?action='remove'&projectId={$projectId}&projectName={$projectName}&employeeId={$foo.employee_id}" target="_blank">
														<button type="button" style="width:150px" class="btn bg-red margin btn-xs"><i class="fa fa-remove"></i> Remove Percent</button>
													</a>
												</td>
											</tr>
										{/foreach}
										</tbody>
										<tfoot>
											<tr>
												<th>Employee`s Name</th>
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