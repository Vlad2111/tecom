 
			<link rel="stylesheet" href="3pty/AdminLTE-2.3.5/plugins/select2/select2.min.css">
			<link rel="stylesheet" href="3pty/AdminLTE-2.3.5/plugins/bootstrap-slider/slider.css">
			<link rel="stylesheet" href="3pty/AdminLTE-2.3.5/plugins/datepicker/datepicker3.css">

			<div class="content-wrapper">
				<section class="content-header">
					<div align="right">
						<b style="font-size:23px">Selected date: {"$selectedDate"}</b>
					</div>
					<div align="center">
						<div class="col-lg-100 col-xs-100">
							<div class="small-box bg-green">
								<div class="inner">
									<h2>{"$header"}</h2>
								</div>
							</div>
						</div>
						<ol class="breadcrumb">
							<li><a href="/index/?action='return'"><i class="fa fa-dashboard"></i>Home</a></li>
							{"$lastPage"}
							<li class="active">{"$header"}</li>
						</ol>
					</div>
				</section>

				<section class="content">
					<form action="/save/?content='{"$action"}{"$modName"}'{if $action='Edit'}&editId='{"$editId"}'{/if}" method="post">
						<div class="box box-default">
							<div class="box-header with-border">
								<h3 class="box-title">{"$header"}</h3>
							</div>
							<div class="box-body">
								{if $cloneInfo = true}
								<div class="form-group">
									<label>Date From:</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input type="text" class="form-control pull-right" id="datepicker1">
									</div>
									<label>Date To:</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input type="text" class="form-control pull-right" id="datepicker2">
									</div>
								</div>
								{/if}
								{if $setName = true}
								<div class="form-group">
									<label>Name of {$modName}</label>
									<p>{$message}</p>
									<input type="text" name="newName"class="form-control" placeholder="{$lastName}">
								</div>
								{/if}
								<div class="row">
									<div class="col-md-12">
										{if $setDepartment = true}
										<div class="form-group">
											<label>{$modName}'s Department</label>
											<select name="newDepartmwent" class="form-control select2" style="width: 100%;">
												{foreach from=$array item=foo}
												
												<option>{$foo.department_name}</option>
												{/foreach}
											</select>
										</div>
										{/if}
										{if $setEmployee = true}
										<div class="form-group">
											<label>Employee</label>
											<select name="newEmployee" placeholder="{$lastNameEmployee}" class="form-control select2" style="width: 100%;">
												{foreach from=$array item=foo}
												
												<option>{$foo.user_id}</option>
												{/foreach}
											</select>
										</div>
										{/if}
										{if $setProject = true}
										<div class="form-group">
											<label>Project</label>
											<select name="newProject" placeholder="{$lastNameProject}" class="form-control select2" style="width: 100%;">
												{foreach from=$array item=foo}
												
												<option>{$foo.project_name}</option>
												{/foreach}
											</select>
										</div>
										{/if}
										{if $setPercent = true}
										<label>Percent</label>
										<div class="form-group">
											<input id="range_1" type="text" name="range_1" value="{$lastPercent}">
										</div>
 										{/if}
									</div>
								</div>
							</div>
							<div align="center">
								<a class="btn btn-app bg-green">
									<i class="fa fa-save"></i> Save
								</a>
							</div>
						</div>
					</form>
				</section>
			</div>

			<script src="3pty/AdminLTE-2.3.5/plugins/select2/select2.full.min.js"></script>
			<script src="3pty/AdminLTE-2.3.5/plugins/ionslider/ion.rangeSlider.min.js"></script>
			<script src="3pty/AdminLTE-2.3.5/plugins/datepicker/bootstrap-datepicker.js"></script>
			<script>
				$(function () {
					$(".select2").select2();
					$("#range_1").ionRangeSlider({
						min: 0,
						max: 100,
						from: {$lastPercent},
						type: 'single',
						postfix: "%",
						grid: true,
						grid_num: 20
	    			});
					$('#datepicker1').datepicker({
						autoclose: true
					});
					$('#datepicker2').datepicker({
						autoclose: true
					});
				});
			</script>
			