<?php
require '3pty/Smarty/libs/Smarty.class.php';

$smarty = new Smarty;
if ($name != 'authorization'){
	$smarty->assign('contentPage', $contentPage);
	switch($name){
		case'mainPage':
			$header = 'Main Page';
			break;
		case 'List':
			$header = 'List of '.$registry['list'].'`s.';
			unset($registry['list']);
			break;	
		case 'Department':
			$smarty->assign('departmentName', $registry['departmentName']);
			$smarty->assign('departmentId', $registry['departmentId']);
			$header = 'Department: '. $registry['departmentName'];
			unset($registry['departmentId']);
			unset($registry['departmentName']);
			break;
		case 'Employee':
			$smarty->assign('employeeName', $registry['employeeName']);
			$smarty->assign('employeeId', $registry['employeeId']);
			$smarty->assign('$employeePercent', $registry['employeePercent']);
			$header = 'Employee: '. $registry['employeeName'];
			unset($registry['employeetId']);
			unset($registry['employeetName']);
			unset($registry['employeePercent']);
			break;
		case 'Project':
			$smarty->assign('projectName', $registry['projectName']);
			$smarty->assign('projectId', $registry['projectId']);
			$header = 'Project: '. $registry['projectName'];
			unset($registry['projectName']);
			unset($registry['projectId']);
			break;
		case 'EditAndCreate':
			$header = 'Edit And Create';
			break;
		default:
			$header = 'Unknown Page';
			break;
	}
	$smarty->assign('title', $header);
	$smarty->assign('name', $registry['userName']);
	$smarty->assign('role', $registry['roleName']);
	if($name != 'mainPage'){
		$smarty->assign('selectedDate', $registry['date']);
		$smarty->assign('array', $$key);
	}
	$smarty->force_compile = false;
	$smarty->debugging = false;
	$smarty->caching = false;
	$smarty->cache_lifetime = 120;
	
	$smarty->display('3pty/Smarty/demo/templates/index.tpl');
}else{
	$smarty->display('3pty/Smarty/demo/templates/authorization.tpl');
}
