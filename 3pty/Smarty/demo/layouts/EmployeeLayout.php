<?php

/** Файл со Смарти переменными и обычными переменными повторяющиеся в каждом Layout. */
require '3pty/Smarty/demo/layouts/SmartyRepeatVariables.php';

/** Переменные для отображения информации о сотруднике. */
{
	if (($registry['newLoginEmpForEmp']!=null)AND($registry['newNameEmpForEmp']!=null)){
		$smarty->assign('employeeLogin', $registry['newLoginEmpForEmp']);
		$smarty->assign('employeeName', $registry['newNameEmpForEmp']);
		$smarty->assign('departmentId', $registry['newIdDepForEmp']);
		$smarty->assign('departmentName', $registry['newNameDepForEmp']);
	}else{
		$smarty->assign('employeeLogin', $registry['GET']['employeeLogin']);
		$smarty->assign('employeeName', $registry['GET']['employeeName']);
		$smarty->assign('departmentId', $registry['GET']['departmentId']);
		$smarty->assign('departmentName', $registry['GET']['departmentName']);
	}
	$smarty->assign('employeeId', $registry['GET']['employeeId']);
	$smarty->assign('employeePercent', $registry['employeePercent']);
	$smarty->assign('array', $$key);
	$smarty->assign('select', $registry['selectDepartment']);
	$smarty->assign('countselect', count($registry['selectDepartment']));
	$smarty->assign('selectPro', $registry['selectProject']);
	$smarty->assign('selectProNot', $registry['selectProjectNot']);
	$smarty->assign('countselectPro', count($registry['selectProject'])+count($registry['selectProjectNot']));
	$smarty->assign('title', 'Сотрудник: '. $registry['GET']['employeeName']);
	$smarty->display($contentPage);
}