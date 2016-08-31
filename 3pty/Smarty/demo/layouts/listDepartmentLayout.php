<?php

/** Файл со Смарти переменными и обычными переменными, которые повторяются в каждом Layout. */
require '3pty/Smarty/demo/layouts/SmartyRepeatVariables.php';

/** Проверка на возможность редактирования месяца. */
{
	if($statusEditingData==t){

		$smarty->assign('statusEditing', 'Данные месяца заблокированы для редактирования!');
		$smarty->assign('status', TRUE);

	}else{

		/** Переменные для доступа к функционалу ролей. */
		{
			if($_GET['roleIdUser']=='0'){
				$smarty->assign('access', 'disabled');
			}
			if($_GET['roleIdUser']=='1'){
				$smarty->assign('access', 'disabled');
			}
			if($_GET['roleIdUser']=='2'){}
			if($_GET['roleIdUser']=='3'){}
			if($_GET['roleIdUser']=='4'){}
		}

	}
}

/** Переменные для отображения списка отделов. */
{
	$smarty->assign('arrayDepartmentNames', $arrayDepartmentNames);
	$smarty->assign('status1', 'active');	
	$smarty->assign('title', 'Список Отделов');
	$smarty->display($contentPage);
}