
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
									<h2>List of Projects</h2>
									<a class="btn btn-app" href="/EditAndCreate/?content='createProject'">
										<i class="fa fa-pencil"></i> New Project
									</a>
									<a class="btn btn-app" href="/EditAndCreate/?content='cloneInfo'">
										<i class="fa fa-clone"></i> Clone Information
									</a>
								</div>
							</div>
						</div>
						<ol class="breadcrumb">
							<li><a href="/index/?action='return'"><i class="fa fa-dashboard"></i>Home</a></li>
							<li class="active">List Project`s</li>
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
												<th style="width:10px; font-size:15px">Id</th>
												<th>Name of Project</th>
												<th>Project`s Department/th>
											</tr>
										</thead>
										<tbody>
										{foreach from=$array item=foo}
										
											<tr>
												<th>{$foo.project_id}</th>
												<th><a href="/project/?projectId={$foo.project_id}&projectName={$foo.project_name}>{$foo.project_name}</a></th>
												<th><a href="/department/?departmentId={$foo.department_id}&departmentName={$foo.department_name}>{$foo.department_name}</a></th>
											</tr>
										{/foreach}
										</tbody>
										<tfoot>
											<tr>
												<th>Id</th>
												<th>Name of Project</th>
												<th>Project`s Department</th>
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
