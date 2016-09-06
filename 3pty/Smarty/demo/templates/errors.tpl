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
								<h3 class="box-title" style="font-size:23px">Ошибки</h3>
							</div>
							<div class="box-body">
							<h3> {$message} </h3>
							{if $errors != null}
								<table id="errors" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>Коментарий</th>
											<th>Месяц</th>
											<th>Сотрудник</th>
											<th>Проект</th>
											<th>Время</th>
											<th>Ошибка</th>
										</tr>
									</thead>
									<tbody>
									{foreach from=$errors item=foo}
										
										<tr>
											<td>{$foo.comment}</td>
											<td>{$foo.info.date}</td>
											<td>{$foo.info.nameEmp}</td>
											<td>{$foo.info.namePro}</td>											
											<td>{$foo.info.time}</td>
											<td>{$foo.message}</td>
										</tr>
									{/foreach}
									</tbody>
								</table>
							{/if}
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