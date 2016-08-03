
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
 									<h2>List of Employees</h2>
 									<a class="btn btn-app" href="/EditAndCreate/?content='createEmployee'">
 										<i class="fa fa-pencil"></i> New Employee
 									</a>
			 					</div>
 		 					</div>
		 				</div>
		 				<ol class="breadcrumb">
							<li><a href="/index/?action='return'"><i class="fa fa-dashboard"></i>Home</a></li>
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
												<th>{$foo.employee_id}</th>
												<th><a href="/employee/?employeeId={$foo.employee_id}&employeeName={$foo.user_id}>{$foo.user_id}</a></th>
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
