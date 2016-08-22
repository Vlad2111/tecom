<?php

/** Файл со Смарти переменными и обычными переменными, которые повторяются в каждом Layout. */
require '3pty/Smarty/demo/layouts/SmartyRepeatVariables.php';

/** Переменные для отображения списка пользователей и ролей. */
{
	$smarty->assign('falseList', $falseList);
	$smarty->assign('title', 'Ошибки в базе данных');
	$smarty->display($contentPage);
}