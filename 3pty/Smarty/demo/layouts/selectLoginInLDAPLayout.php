<?php
/** Файл со Смарти переменными и обычными переменными, которые повторяются в каждом Layout. */
require '3pty/Smarty/demo/layouts/SmartyRepeatVariables.php';

/** Переменные для отображения списка пользователей LDAP. */
{
	$smarty->assign('array', $$key);
	$smarty->assign('action', $registry['GET']['action']);
	if ($registry['GET']['lastPage']!=null){
		$smarty->assign('lastPage', $registry['GET']['lastPage']);
		if($registry['GET']['lastPage']=='Department'){
			$smarty->assign('departmentName', $registry['GET']['departmentName']);
			$smarty->assign('departmentId', $registry['GET']['departmentId']);
		}
		if($registry['GET']['lastPage']=='Employee'){
			$smarty->assign('employeeId', $registry['GET']['employeeId']);
		}
	}else{
		$smarty->assign('lastPage', 'list');
		$smarty->assign('content', 'Department');
	}
	$smarty->assign('editId', $registry['GET']['editId']);
	$smarty->assign('newDepartmwent', $registry['GET']['newDepartmwent']);
	if ($registry['actionEmployeeFalse']==true){
		$smarty->assign('action', 'Edit');
		$smarty->assign('editId', $registry['editId']);
		$smarty->assign('newDepartmwent', $registry['departmwent']);
	}
	$smarty->assign('title', 'Список Логинов из LDAP');
	$smarty->display($contentPage);
}