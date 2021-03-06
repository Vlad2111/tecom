<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Tecomgroup | {$title}</title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	</head>
	<body style="height:100%;" class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			{include file='3pty/Smarty/demo/templates/header.tpl'}
			<div class="content-wrapper">
				<section class="content">
					<div class="row">
						<div class="col-xs-12">
						{if $statusEditing != null}
						{$statusEditing}
						{/if}
							<div class="box">
								<div class="box-header">
									<h3 class="box-title" style="font-size:23px">{$title}</h3>	
								</div>
								<div class="box-body">
									<table id="total" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>Дата</th>
												<th>Дата</th>
												<th>Колличество сотрудников</th>
											</tr>
										</thead>
										<tbody>
										{if $arrayTotal!=null}
										{foreach from=$arrayTotal item=foo}
											
											<tr>
												<td>{$foo.date}</td>
												<td>
													<a 
														href="/index.php
															?route=List/viewListEmployee
															&date={$foo.date}">
														{$foo.month}
													</a>
												</td>
												<td>{$foo.count}</td>
											</tr>
										{/foreach}
										{/if}
										</tbody>
									</table>
									
									<form action="/index.php" method="get" onsubmit="diactive()">			
										<div class="modal-body" >
											<div class="form-group">
												<table style="width:100%"><tr ><td>
												<label>Начало интервала</label>
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input name="date1" type="text" class="form-control pull-right" id="datepicker11">
												</div></td><td>
												<label>Конец интервала</label>
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input name="date2" type="text" class="form-control pull-right" id="datepicker22">
												</div>
												<div class="input-group hidden">
													<input name="route" type="hidden" value="Total/viewTotal">
													<input name="Month" type="hidden" value="{$selectedMonthForGet}">
													<input name="Year" type="hidden" value="{$selectedYearForGet}">
												</div></td></tr></table>
											</div>
										</div>
										<div class="modal-footer">
											<button id="buttonFcopy" type="button" class="btn btn-default pull-left" data-dismiss="modal" style="width: 200px">Отмена</button>
											<button id="buttonScopy" type="submit" class="btn btn-primary" style="width: 200px">Сохранить</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
			<footer class="main-footer">
				<div class="pull-right hidden-xs">
				</div>
			</footer>
			<script>
				$(function () {
					$('#datepicker11').datepicker({
						autoclose: true
					});
				});
			</script>
			<script>
				$(function () {
					$('#datepicker22').datepicker({
						autoclose: true
					});
				});
			</script>
			<script>
				function diactive() {
					document.getElementById('buttonScopy').disabled = 1;
					document.getElementById('buttonFcopy').disabled = 1;
				}
			</script>
			<script>
				$(function () {
					var table = $('#total').DataTable({
						"paging": false,
						"lengthChange": true,
						"searching": false,
						"ordering": false,
						"info": true,
						"autoWidth": true,
						"stateSave": true,
						"stateDuration": -1,
						"language": {
							"lengthMenu": "Показать _MENU_ элементов",
							"zeroRecords": "Ничего не найдено",
							"info": "С _START_ по _END_ из _TOTAL_",
							"infoEmpty": "Нет доступных данных",
							"infoFiltered": "(Отфильтровано из _MAX_ записей)",
							"paginate": {
								"first":"Первый",
								"last": "Последний",
								"next": "Следующая",
								"previous": "Предыдущая"
								},
							"loadingRecords": "Загрузка...",
							"processing": "Обработка...",
							"search": "Поиск:"
						}
					});
					var column = table.column(0);
					column.visible(false);
					column.order('asc');
				});
			</script>
		</div>
	</body>
</html>
