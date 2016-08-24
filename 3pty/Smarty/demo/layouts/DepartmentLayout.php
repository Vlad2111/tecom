<?php

/** Файл со Смарти переменными и обычными переменными повторяющиеся в каждом Layout. */
require '3pty/Smarty/demo/layouts/SmartyRepeatVariables.php';

/** Переменные для отображения информации об отделе. */
{
	$smarty->assign('departmentName', $departmentName);
	$smarty->assign('departmentId',	$departmentId);
	$smarty->assign('arrayEmployeeNamesForDepartment', $arrayEmployeeNamesForDepartment);
	$smarty->assign('arrayProjectNamesForDepartment', $arrayProjectNamesForDepartment);
	$smarty->assign('arrayDepartmentNamesForSelect', $arrayDepartmentNames);
	$smarty->assign('countArrayDepartmentNamesForSelect', count($arrayDepartmentNames));
	$smarty->assign('title', 'Отдел: '.	$departmentName);
	$smarty->display($contentPage);
}