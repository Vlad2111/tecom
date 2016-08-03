 
			<link rel="stylesheet" href="../plugins/select2/select2.min.css">
			<link rel="stylesheet" href="../plugins/bootstrap-slider/slider.css">

			<div class="content-wrapper">
				<section class="content-header">
					<div align="right">
						<b style="font-size:23px">Selected date: </b>
					</div>
					<div align="center">
						<div class="col-lg-100 col-xs-100">
							<div class="small-box bg-green">
								<div class="inner">
									<h2>Edit Or Create</h2>
								</div>
							</div>
						</div>
						<ol class="breadcrumb">
							<li><a href="mainPage.html"><i class="fa fa-dashboard"></i> Home</a></li>
							<li><a href=#>***</a></li>
							<li class="active">EditAndCreate</li>
						</ol>
					</div>
				</section>

				<section class="content">
					<div class="box box-default">
						<div class="box-header with-border">
							<h3 class="box-title">***</h3>
						</div>
						<div class="box-body">
							<div class="form-group">
								<label>Name of ***</label>
								<input type="text" class="form-control" placeholder="***">
							</div>
							<div class="row">
								<div class="col-md-12">
									{if ******}
									<div class="form-group">
										<label>***'s Department</label>
										<select class="form-control select2" style="width: 100%;">
											{foreach from=$array item=foo}
											
											<option>{$foo.department_name}</option>
											{/foreach}
										</select>
									</div>
									{/if}
									{if ******}
									<label>Percent</label>
									<div class="form-group">
										<input type="text" class="form-control" placeholder="50" style="width:60px;">
										<input type="text" value="" class="slider form-control" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="[0,50]" data-slider-orientation="horizontal" data-slider-selection="before" data-slider-tooltip="show" data-slider-id="red">
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
				</section>
			</div>

			<script src="../plugins/select2/select2.full.min.js"></script>
			<script src="../plugins/bootstrap-slider/bootstrap-slider.js"></script>
			<script>
				$(function () {
					$('.slider').slider();
					$(".select2").select2();
				});
			</script>