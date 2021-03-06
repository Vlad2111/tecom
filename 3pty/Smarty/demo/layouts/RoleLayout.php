<?php

/** Файл со Смарти переменными и обычными переменными, которые повторяются в каждом Layout. */
require '3pty/Smarty/demo/layouts/SmartyRepeatVariables.php';

/** Переменные для отображения списка пользователей и ролей. */
{
	$smarty->assign('status4', 'active');
	$smarty->assign('changeData', 'f');	
	$smarty->assign('arrayEmployeeRoleNamesAndId', $arrayEmployeeRoleNamesAndId);
	
	$smarty->assign('arrayEmployeeNamesForSelect', $arrayEmployeeNames);
	$smarty->assign('arrayDepartmentNamesForSelect', $arrayDepartmentNames);
	$smarty->assign('countArrayDepartmentNamesForSelect', count($arrayDepartmentNames));
	$smarty->assign('arrayRoleDefForSelect', $arrayRoleDef);
	$smarty->assign('countArrayRoleDefForSelect', count($arrayRoleDef));
	
	$smarty->assign('title', 'Пользователи и Роли');
	$smarty->display($contentPage);
}
