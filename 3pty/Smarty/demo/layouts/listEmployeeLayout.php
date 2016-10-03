<?php

/** Файл со Смарти переменными и обычными переменными повторяющиеся в каждом Layout. */
require '3pty/Smarty/demo/layouts/SmartyRepeatVariables.php';

/** Проверка на возможность редактирования месяца. */
{
	if($statusEditingData==t){

		$smarty->assign('statusEditing', 'Данные месяца заблокированы для редактирования!');
		$smarty->assign('status', TRUE);

	}else{

		/** Переменные для доступа к функционалу ролей. */
		{
			if($_SESSION['roleIdUser']=='0'){
				$smarty->assign('access', 'disabled');
			}
			if($_SESSION['roleIdUser']=='1'){
				$smarty->assign('access', 'disabled');
			}
			if($_SESSION['roleIdUser']=='2'){}
			if($_SESSION['roleIdUser']=='3'){}
			if($_SESSION['roleIdUser']=='4'){}
		}

	}
}

/** Переменные для отображения списка сотрудников. */
{
	if($error!=null){
		$smarty->assign('errorAlert', $error['alert']);
		$smarty->assign('errorMessage', $error['message']);
	}
	$smarty->assign('arrayEmployeeNames', $arrayEmployeeNames);
	$smarty->assign('arrayDepartmentNamesForSelect', $arrayDepartmentNames);
	$smarty->assign('countArrayDepartmentNamesForSelect', count($arrayDepartmentNames));
	$smarty->assign('status2', 'active');
	$smarty->assign('title', 'Список Сотрудников');
	$smarty->display($contentPage);
}
