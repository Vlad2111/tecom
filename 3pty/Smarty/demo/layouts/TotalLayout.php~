<?php

/** Файл со Смарти переменными и обычными переменными повторяющиеся в каждом Layout. */
require '3pty/Smarty/demo/layouts/SmartyRepeatVariables.php';

/** Переменные для отображения информации о итогах. */
{	
	$smarty->assign('status5', 'active');	
	$smarty->assign('title', 'Общее количество сотрудников за интервал <b>'.$arrayTotal[1]['month'].' - '.$arrayTotal[count($arrayTotal)]['month'].'</b>');
	$smarty->assign('arrayTotal', $arrayTotal);
	$smarty->display($contentPage);
}
