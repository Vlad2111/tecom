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
			if($_SESSION['roleIdUser']=='2'){
				$smarty->assign('access', 'disabled');
			}
			if($_SESSION['roleIdUser']=='3'){}
			if($_SESSION['roleIdUser']=='4'){}
		}

	}
}

/** Переменные для отображения информации о проекте. */
{
	$smarty->assign('projectId', $projectId);
	$smarty->assign('projectName', $projectName);
	$smarty->assign('departmentId', $departmentId);
	$smarty->assign('departmentName', $departmentName);
	
	$smarty->assign('arrayEployeeNamesAndPercentsForProject', $arrayEployeeNamesAndPercentsForProject);
	
	$smarty->assign('arrayDepartmentNamesForSelect', $arrayDepartmentNames);
	$smarty->assign('countArrayDepartmentNamesForSelect', count($arrayDepartmentNames));
	$smarty->assign('arrayEmployeeNamesForDepartmentForSelect', $arrayEmployeeNamesForDepartment);
	$smarty->assign('arrayEmployeeNamesNotForDepartmentForSelect', $arrayEmployeeNamesNotForDepartment);
	$smarty->assign('countArrayEmployeeNamesForDepartmentForSelect', count($arrayEmployeeNamesForDepartment)+count($arrayEmployeeNamesNotForDepartment));
	
	$smarty->assign('title', 'Проект: '. $projectName);
	$smarty->display($contentPage);
}
