<?php

/** Файл со Смарти переменными и обычными переменными повторяющиеся в каждом Layout. */
require '3pty/Smarty/demo/layouts/SmartyRepeatVariables.php';

/** Переменные для отображения информации о сотруднике. */
{
	$smarty->assign('employeeId', $employeeId);
	$smarty->assign('employeeLogin', $employeeLogin);
	$smarty->assign('employeeName', $employeeName);
	$smarty->assign('departmentId', $departmentId);
	$smarty->assign('departmentName', $departmentName);
	
	$smarty->assign('employeePercent', $employeePercent);
	
	$smarty->assign('arrayEmployeeInfo', $arrayEmployeeInfo);
	$smarty->assign('arrayDepartmentNamesForSelect', $arrayDepartmentNames);
	$smarty->assign('countArrayDepartmentNamesForSelect', count($arrayDepartmentNames));
	$smarty->assign('arrayProjectNamesForDepartmentForSelect', $arrayProjectNamesForDepartment);
	$smarty->assign('arrayProjectNamesNotForDepartmentForSelect', $arrayProjectNamesNotForDepartment);
	$smarty->assign('countArrayProjectNamesForSelect', count($arrayProjectNamesForDepartment)+count($arrayProjectNamesNotForDepartment));
	$smarty->assign('title', 'Сотрудник: '. $employeeName);
	$smarty->display($contentPage);
}