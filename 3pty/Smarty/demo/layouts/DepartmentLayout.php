<?php

/** Файл со Смарти переменными и обычными переменными повторяющиеся в каждом Layout. */
require '3pty/Smarty/demo/layouts/SmartyRepeatVariables.php';

/** Переменные для отображения информации об отделе. */
{
	if ($registry['newNameDepForDep']!=null){
		$smarty->assign('departmentName', $registry['newNameDepForDep']);
	}else{
		$smarty->assign('departmentName', $registry['GET']['departmentName']);
	}
	$smarty->assign('departmentId',	$registry['GET']['departmentId']);
	$smarty->assign('array', $$key);
	$smarty->assign('select', $registry['selectDepartment']);
	$smarty->assign('countselect', count($registry['selectDepartment']));
	$smarty->assign('title', 'Отдел: '.	$registry['GET']['departmentName']);
	$smarty->display($contentPage);
}