<?php
echo"/*/*/*/*/";
print_r($_GET);
print_r($_POST);
echo"/*/*/*/*/";
/** Смарти подключение и настройка. */
{
	require '3pty/Smarty/libs/Smarty.class.php';
	$smarty = new Smarty;
	$smarty->force_compile = true;
	$smarty->debugging = false;
	$smarty->caching = false;
	$smarty->cache_lifetime = 120;
}
/** Имя и роль пользователя для отбражения и передачи. */
{
	$smarty->assign('name', $_GET['nameUser']);
	$smarty->assign('role', $_GET['roleUser']);
}
/** Переменные для выделения в левом меню активного списка. */
{
	$smarty->assign('status1', 'deactivate');
	$smarty->assign('status2', 'deactivate');
	$smarty->assign('status3', 'deactivate');
}
/** Дата для отбражения и передачи. */
{
	$smarty->assign('selectedMonthForGet', $registry['date']->format('m'));
	$smarty->assign('selectedYearForGet', $registry['date']->format('Y'));
	switch($registry['date']->format('m')){
		case '01':
			$smarty->assign('selectedMonth', 'Январь');
			break;
		case '02':
			$smarty->assign('selectedMonth', 'Февраль');
			break;
		case '03':
			$smarty->assign('selectedMonth', 'Март');
			break;
		case '04':
			$smarty->assign('selectedMonth', 'Апрель');
			break;
		case '05':
			$smarty->assign('selectedMonth', 'Май');
			break;
		case '06':
			$smarty->assign('selectedMonth', 'Июнь');
			break;
		case '07':
			$smarty->assign('selectedMonth', 'Июль');
			break;
		case '08':
			$smarty->assign('selectedMonth', 'Август');
			break;
		case '09':
			$smarty->assign('selectedMonth', 'Сентябрь');
			break;
		case '10':
			$smarty->assign('selectedMonth', 'Октябрь');
			break;
		case '11':
			$smarty->assign('selectedMonth', 'Ноябрь');
			break;
		case '12':
			$smarty->assign('selectedMonth', 'Декабрь');
			break;
	}
}