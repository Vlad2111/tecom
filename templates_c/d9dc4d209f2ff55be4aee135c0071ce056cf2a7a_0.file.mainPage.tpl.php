<?php
/* Smarty version 3.1.28, created on 2016-08-04 13:36:16
  from "C:\Users\ershov.v\workspace\tecom\3pty\Smarty\demo\templates\mainPage.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_57a31aa0cfa9e3_40685068',
  'file_dependency' => 
  array (
    'd9dc4d209f2ff55be4aee135c0071ce056cf2a7a' => 
    array (
      0 => 'C:\\Users\\ershov.v\\workspace\\tecom\\3pty\\Smarty\\demo\\templates\\mainPage.tpl',
      1 => 1470225185,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57a31aa0cfa9e3_40685068 ($_smarty_tpl) {
?>

			<link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
			
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
			
			<?php echo '<script'; ?>
 src="../plugins/datepicker/bootstrap-datepicker.js"><?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
>
				$(function () {
					//Date picker
					$('#datepicker').datepicker({
						autoclose: true
					});
				});
			<?php echo '</script'; ?>
>
			<?php }
}
