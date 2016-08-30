<?php

/** Файл со Смарти переменными и обычными переменными повторяющиеся в каждом Layout. */
require '3pty/Smarty/demo/layouts/SmartyRepeatVariables.php';

/** Переменные для доступа к функционалу ролей. */
{
	if($_GET['roleIdUser']=='0'){
		$smarty->assign('accessDep', 'disabled');
		$smarty->assign('accessPro', 'disabled');
	}
	if($_GET['roleIdUser']=='1'){
		$smarty->assign('accessDep', 'disabled');
		$smarty->assign('accessPro', 'disabled');
	}
	if($_GET['roleIdUser']=='2'){
		$smarty->assign('accessPro', 'disabled');
	}
	if($_GET['roleIdUser']=='3'){}
	if($_GET['roleIdUser']=='4'){}
}

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