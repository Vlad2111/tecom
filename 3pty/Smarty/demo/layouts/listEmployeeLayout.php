<?php

/** Файл со Смарти переменными и обычными переменными повторяющиеся в каждом Layout. */
require '3pty/Smarty/demo/layouts/SmartyRepeatVariables.php';

/** Переменные для доступа к функционалу ролей. */
{
	if($_GET['roleIdUser']=='0'){
		$smarty->assign('access', 'disabled');
	}
	if($_GET['roleIdUser']=='1'){
		$smarty->assign('access', 'disabled');
	}
	if($_GET['roleIdUser']=='2'){}
	if($_GET['roleIdUser']=='3'){}
	if($_GET['roleIdUser']=='4'){}
}

/** Переменные для отображения списка сотрудников. */
{
	$smarty->assign('arrayEmployeeNames', $arrayEmployeeNames);
	$smarty->assign('arrayDepartmentNamesForSelect', $arrayDepartmentNames);
	$smarty->assign('countArrayDepartmentNamesForSelect', count($arrayDepartmentNames));
	$smarty->assign('status2', 'active');
	$smarty->assign('title', 'Список Сотрудников');
	$smarty->display($contentPage);
}