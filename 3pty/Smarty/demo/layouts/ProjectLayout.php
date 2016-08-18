<?php

/** Файл со Смарти переменными и обычными переменными повторяющиеся в каждом Layout. */
require '3pty/Smarty/demo/layouts/SmartyRepeatVariables.php';

/** Переменные для отображения информации о проекте. */
{
	if (($registry['newIdDepForPro']!=null)AND($registry['newNameDepForPro']!=null)){
		$smarty->assign('departmentId', $registry['newIdDepForPro']);
		$smarty->assign('departmentName', $registry['newNameDepForPro']);
	}else{
		$smarty->assign('departmentId', $registry['GET']['departmentId']);
		$smarty->assign('departmentName', $registry['GET']['departmentName']);
	}
	if(	$registry['GET']['newName']!=null){
		$smarty->assign('projectName', $registry['GET']['newName']);
	}else{
		$smarty->assign('projectName', $registry['GET']['projectName']);
	}
	$smarty->assign('projectId', $registry['GET']['projectId']);
	$smarty->assign('array', $$key);
	$smarty->assign('select', $registry['selectDepartment']);
	$smarty->assign('countselect', count($registry['selectDepartment']));
	$smarty->assign('selectEmp', $registry['selectEmployee']);
	$smarty->assign('selectEmpNot', $registry['selectEmployeeNot']);
	$smarty->assign('countselectEmp', count($registry['selectEmployee'])+count($registry['selectEmployeeNot']));
	$smarty->assign('title', 'Проект: '. $registry['GET']['projectName']);
	$smarty->display($contentPage);
}