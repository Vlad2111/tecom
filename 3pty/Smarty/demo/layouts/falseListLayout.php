<?php

/** Файл со Смарти переменными и обычными переменными, которые повторяются в каждом Layout. */
require '3pty/Smarty/demo/layouts/SmartyRepeatVariables.php';

/** Переменные для отображения списка пользователей и ролей. */
{
	$smarty->assign('array', $$key);
	$smarty->assign('title', 'Пользователи с Ошибками в Логинах');
	$smarty->display($contentPage);
}