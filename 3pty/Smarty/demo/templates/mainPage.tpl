
			<link rel="stylesheet" href="3pty/AdminLTE-2.3.5/plugins/datepicker/datepicker3.css">
			
			<div class="content-wrapper">
				<section class="content-header">
					<div align="center">
						<h1>Start page</h1>
						<ol class="breadcrumb">
							<li class="active">Home</li>
						</ol>
					</div>
				</section>
				<section class="content">
					<div class="box box-primary">
						<div class="box-body">
							<div class="form-group">
								<label>Date:</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right" id="datepicker">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
 						<div align="center">
							<div class="col-lg-12 col-xs-12">
								<div class="small-box bg-aqua">
									<div class="inner">
										<h2>List of Departments</h2>
									</div>
									<div class="icon">
										<i class="fa ion-stats-bars"></i>
									</div>
									<a href="/list/?content='Department'" class="small-box-footer"> More info<i class="fa fa-arrow-circle-right"></i></a>
								</div>
							</div>
							<div class="col-lg-12 col-xs-12">
								<div class="small-box bg-yellow">
									<div class="inner">
										<h2>List of Employees</h2>
									</div>
									<div class="icon">
										<i class="ion ion-stats-bars"></i>
									</div>
										<a href="/list/?content='Employee'" class="small-box-footer"> More info<i class="fa fa-arrow-circle-right"></i></a>
								</div>
							</div>
							<div class="col-lg-12 col-xs-12">
								<div class="small-box bg-red">
									<div class="inner">
										<h2>List of Projects</h2>
									</div>
									<div class="icon">
										<i class="ion ion-stats-bars"></i>
									</div>
										<a href="/list/?content='Project'" class="small-box-footer"> More info<i class="fa fa-arrow-circle-right"></i></a>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
			
			<script src="3pty/AdminLTE-2.3.5/plugins/datepicker/bootstrap-datepicker.js"></script>
			<script>
				$(function () {
					$('#datepicker').datepicker({
						autoclose: true
					});
				});
			</script>
			