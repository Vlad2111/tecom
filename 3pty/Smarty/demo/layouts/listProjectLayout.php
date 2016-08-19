<?php

/** Файл со Смарти переменными и обычными переменными повторяющиеся в каждом Layout. */
require '3pty/Smarty/demo/layouts/SmartyRepeatVariables.php';

/** Переменные для отображения списка проектов. */
{
	$smarty->assign('arrayProjectNames', $arrayProjectNames);
	$smarty->assign('arrayDepartmentNamesForSelect', $arrayDepartmentNames);
	$smarty->assign('countArrayDepartmentNamesForSelect', count($arrayDepartmentNames));
	$smarty->assign('status3', 'active');	
	$smarty->assign('title', 'Список Проетов');
	$smarty->display($contentPage);
}