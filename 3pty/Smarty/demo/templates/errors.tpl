<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Tecomgroup | {$title}</title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		{include file='3pty/Smarty/demo/templates/header.tpl'}
		<div class="content-wrapper">
			<section class="content">
				<div class="row">
					<div class="col-xs-12">
						<div class="box">
							<div class="box-header">
								<h3 class="box-title" style="font-size:23px">Пользователи с Ошибками в Логинах</h3>
							</div>
							<div class="box-body">
								<table id="errors" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>№</th>
											<th>Коментарий</th>
											<th>Месяц</th>
											<th>Название</th>
											<th>Отдел\Распределение времени</th>
											<th>Ошибка</th>
										</tr>
									</thead>
									<tbody>
									{if $errors!=null}
									{foreach from=$errors item=foo}
										
										<tr>
											<td>{$foo.id}</td>
											<td>{$foo.comment}</td>
											<td>{$foo.info.date}</td>
											<td>{$foo.info.name}</td>
											<td>{$foo.info.department}</td>
											<td>{$foo.message}</td>
										</tr>
									{/foreach}
									{/if}
									</tbody>
								</table>
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
				$('#errors').DataTable({
					"paging": true,
					"lengthChange": true,
					"searching": true,
					"ordering": true,
					"info": true,
					"autoWidth": true,
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
			});
		</script>
	</div>
	</body>
</html>