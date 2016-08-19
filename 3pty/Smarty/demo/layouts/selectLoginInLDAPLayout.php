<?php
/** Файл со Смарти переменными и обычными переменными, которые повторяются в каждом Layout. */
require '3pty/Smarty/demo/layouts/SmartyRepeatVariables.php';

/** Переменные для отображения списка пользователей LDAP. */
{
	$smarty->assign('arrayLDAPAccountNames', $arrayLDAPAccountNames);
	$smarty->assign('action', $_GET['action']);
	if ($_GET['lastPage']!=null){
		if($_GET['lastPage']=='Department'){
			$smarty->assign('lastPage', 'department');
			$smarty->assign('lastAction', 'index');
			$smarty->assign('departmentName', $_GET['departmentName']);
			$smarty->assign('departmentId', $_GET['departmentId']);
		}
		if($_GET['lastPage']=='Employee'){
			$smarty->assign('lastPage', 'employee');
			$smarty->assign('lastAction', 'index');
			$smarty->assign('employeeId', $_GET['employeeId']);
		}
	}else{
		$smarty->assign('lastPage', 'list');
		$smarty->assign('lastAction', 'listEmployee');
	}
	$smarty->assign('editId', $_GET['editId']);
	$smarty->assign('newDepartmwent', $_GET['newDepartmwent']);
	if ($registry['actionEmployeeFalse']==true){
		$smarty->assign('action', 'Edit');
		$smarty->assign('editId', $registry['editId']);
		$smarty->assign('newDepartmwent', $registry['departmwent']);
	}
	$smarty->assign('title', 'Список Логинов из LDAP');
	$smarty->display($contentPage);
}