<?php
require '3pty/Smarty/libs/Smarty.class.php';
$smarty = new Smarty;
$smarty->force_compile = true;
$smarty->debugging = false;
$smarty->caching = false;
$smarty->cache_lifetime = 120;
if ($name != 'authorization'){
	$smarty->assign('name', $registry['userName']);
	$smarty->assign('role', $registry['roleName']);
	$smarty->assign('status1', 'deactivate');
	$smarty->assign('status2', 'deactivate');
	$smarty->assign('status3', 'deactivate');
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
	switch($name){
		case 'listDepartments':
			$smarty->assign('array', $$key);
			$header = 'Список Отделов';
			$smarty->assign('status1', 'active');
			break;
		case 'listEmployees':
			$smarty->assign('array', $$key);
			$header = 'Список Сотрудников';
			$smarty->assign('status2', 'active');
			break;
		case 'listProjects':
			$smarty->assign('array', $$key);
			$header = 'Список Проетов';
			$smarty->assign('status3', 'active');
			break;	
		case 'Department':
			$smarty->assign('departmentName', $registry['GET']['departmentName']);
			$smarty->assign('departmentId', $registry['GET']['departmentId']);
			$smarty->assign('array', $$key);
			$header = 'Отдел: '. $registry['GET']['departmentName'];
			break;
		case 'Employee':
			$smarty->assign('employeeName', $registry['GET']['employeeName']);
			$smarty->assign('employeeId', $registry['GET']['employeeId']);
			$smarty->assign('employeePercent', $registry['employeePercent']);
			$smarty->assign('array', $$key);
			$header = 'Сотрудник: '. $registry['GET']['employeeName'];
			unset($registry['employeePercent']);
			break;
		case 'Project':
			$smarty->assign('projectName', $registry['GET']['projectName']);
			$smarty->assign('projectId', $registry['GET']['projectId']);
			$smarty->assign('array', $$key);
			$header = 'Проект: '. $registry['GET']['projectName'];
			break;
		default:
			$header = 'Unknown Page';
			break;
	}
	$smarty->assign('title', $header);
	$smarty->display($contentPage);
}else{
	$smarty->display('3pty/Smarty/demo/templates/authorization.tpl');
}
