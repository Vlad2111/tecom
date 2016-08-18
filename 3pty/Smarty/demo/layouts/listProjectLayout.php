<?php

/** Файл со Смарти переменными и обычными переменными повторяющиеся в каждом Layout. */
require '3pty/Smarty/demo/layouts/SmartyRepeatVariables.php';

/** Переменные для отображения списка проектов. */
{
	$smarty->assign('array', $$key);
	$smarty->assign('select', $registry['selectDepartment']);
	$smarty->assign('countselect', count($registry['selectDepartment']));
	$smarty->assign('status3', 'active');	
	$smarty->assign('title', 'Список Проетов');
	$smarty->display($contentPage);
}