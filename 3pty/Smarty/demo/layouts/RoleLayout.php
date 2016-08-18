<?php

/** Файл со Смарти переменными и обычными переменными, которые повторяются в каждом Layout. */
require '3pty/Smarty/demo/layouts/SmartyRepeatVariables.php';

/** Переменные для отображения списка пользователей и ролей. */
{
	$smarty->assign('status4', 'active');
	$smarty->assign('array', $$key);
	$smarty->assign('selectEmp', $registry['selectEmployee']);
	$smarty->assign('selectRole', $registry['selectRole']);
	$smarty->assign('countselectEmp', count($registry['selectEmployee']));
	$smarty->assign('countselectRole', count($registry['selectRole']));
	$smarty->assign('title', 'Пользователи и Роли');
	$smarty->display($contentPage);
}