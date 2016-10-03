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
				$smarty->assign('accessEmp', 'disabled');
				$smarty->assign('accessPro', 'disabled');
			}
			if($_SESSION['roleIdUser']=='1'){
				$smarty->assign('accessEmp', 'disabled');
				$smarty->assign('accessPro', 'disabled');
			}
			if($_SESSION['roleIdUser']=='2'){
				$smarty->assign('accessPro', 'disabled');
			}
			if($_SESSION['roleIdUser']=='3'){}
			if($_SESSION['roleIdUser']=='4'){}
		}
		
	}
}

/** Переменные для отображения информации о сотруднике. */
{
	$smarty->assign('employeeId', $employeeId);
	$smarty->assign('employeeLogin', $employeeLogin);
	$smarty->assign('employeeName', $employeeName);
	$smarty->assign('departmentId', $departmentId);
	$smarty->assign('departmentName', $departmentName);
	
	$smarty->assign('arrayEmployeeInfo', $arrayEmployeeInfo);
	$smarty->assign('arrayDepartmentNamesForSelect', $arrayDepartmentNames);
	$smarty->assign('countArrayDepartmentNamesForSelect', count($arrayDepartmentNames));
	$smarty->assign('arrayProjectNamesForDepartmentForSelect', $arrayProjectNamesForDepartment);
	$smarty->assign('arrayProjectNamesNotForDepartmentForSelect', $arrayProjectNamesNotForDepartment);
	$smarty->assign('countArrayProjectNamesForSelect', count($arrayProjectNamesForDepartment)+count($arrayProjectNamesNotForDepartment));
	$smarty->assign('title', 'Сотрудник: '. $employeeName);
	$smarty->display($contentPage);
}
