<?php

/** Файл со Смарти переменными и обычными переменными повторяющиеся в каждом Layout. */
require '3pty/Smarty/demo/layouts/SmartyRepeatVariables.php';

/** Переменные для отображения списка сотрудников. */
{
	$smarty->assign('arrayEmployeeNames', $arrayEmployeeNames);
	$smarty->assign('arrayDepartmentNamesForSelect', $arrayDepartmentNames);
	$smarty->assign('countArrayDepartmentNamesForSelect', count($arrayDepartmentNames));
	$smarty->assign('status2', 'active');
	$smarty->assign('title', 'Список Сотрудников');
	$smarty->display($contentPage);
}