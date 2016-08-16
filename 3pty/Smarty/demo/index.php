<?php
require '3pty/Smarty/libs/Smarty.class.php';
$smarty = new Smarty;
$smarty->force_compile = true;
$smarty->debugging = false;
$smarty->caching = false;
$smarty->cache_lifetime = 120;
if ($name != 'authorization'){
	$smarty->assign('name', $registry['userName']);
	$smarty->assign('role', $registry['roleName']);
	$smarty->assign('status1', 'deactivate');
	$smarty->assign('status2', 'deactivate');
	$smarty->assign('status3', 'deactivate');
	$smarty->assign('selectedMonthForGet', $registry['date']->format('m'));
	$smarty->assign('selectedYearForGet', $registry['date']->format('Y'));
	switch($registry['date']->format('m')){
		case '01':
			$smarty->assign('selectedMonth', 'Январь');
			break;
		case '02':
			$smarty->assign('selectedMonth', 'Февраль');
			break;
		case '03':
			$smarty->assign('selectedMonth', 'Март');
			break;
		case '04':
			$smarty->assign('selectedMonth', 'Апрель');
			break;
		case '05':
			$smarty->assign('selectedMonth', 'Май');
			break;
		case '06':
			$smarty->assign('selectedMonth', 'Июнь');
			break;
		case '07':
			$smarty->assign('selectedMonth', 'Июль');
			break;
		case '08':
			$smarty->assign('selectedMonth', 'Август');
			break;
		case '09':
			$smarty->assign('selectedMonth', 'Сентябрь');
			break;
		case '10':
			$smarty->assign('selectedMonth', 'Октябрь');
			break;
		case '11':
			$smarty->assign('selectedMonth', 'Ноябрь');
			break;
		case '12':
			$smarty->assign('selectedMonth', 'Декабрь');
			break;
	}
	switch($name){
		case 'listDepartments':
			$smarty->assign('array', $$key);
			$header = 'Список Отделов';
			$smarty->assign('status1', 'active');
			break;
		case 'listEmployees':
			$smarty->assign('array', $$key);
			$smarty->assign('select', $registry['selectDepartment']);
			$smarty->assign('countselect', count($registry['selectDepartment']));
			$header = 'Список Сотрудников';
			$smarty->assign('status2', 'active');
			break;
		case 'listProjects':
			$smarty->assign('array', $$key);
			$smarty->assign('select', $registry['selectDepartment']);
			$smarty->assign('countselect', count($registry['selectDepartment']));
			$header = 'Список Проетов';
			$smarty->assign('status3', 'active');
			break;	
		case 'Department':
			if ($registry['newNameDepForDep']!=null){
				$smarty->assign('departmentName', $registry['newNameDepForDep']);
			}else{
				$smarty->assign('departmentName', $registry['GET']['departmentName']);
			}
			$smarty->assign('departmentId', $registry['GET']['departmentId']);
			$smarty->assign('array', $$key);
			$smarty->assign('select', $registry['selectDepartment']);
			$smarty->assign('countselect', count($registry['selectDepartment']));
			$header = 'Отдел: '. $registry['GET']['departmentName'];
			break;
		case 'Employee':
			if (($registry['newLoginEmpForEmp']!=null)AND($registry['newNameEmpForEmp']!=null)){
				$smarty->assign('employeeLogin', $registry['newLoginEmpForEmp']);
				$smarty->assign('employeeName', $registry['newNameEmpForEmp']);
				$smarty->assign('departmentId', $registry['newIdDepForEmp']);
				$smarty->assign('departmentName', $registry['newNameDepForEmp']);
			}else{
				$smarty->assign('employeeLogin', $registry['GET']['employeeLogin']);
				$smarty->assign('employeeName', $registry['GET']['employeeName']);
				$smarty->assign('departmentId', $registry['GET']['departmentId']);
				$smarty->assign('departmentName', $registry['GET']['departmentName']);
			}
			$smarty->assign('employeeId', $registry['GET']['employeeId']);
			$smarty->assign('employeePercent', $registry['employeePercent']);
			$smarty->assign('array', $$key);
			$smarty->assign('select', $registry['selectDepartment']);
			$smarty->assign('countselect', count($registry['selectDepartment']));
			$smarty->assign('selectPro', $registry['selectProject']);
			$smarty->assign('selectProNot', $registry['selectProjectNot']);
			$smarty->assign('countselectPro', count($registry['selectProject'])+count($registry['selectProjectNot']));
			$header = 'Сотрудник: '. $registry['GET']['employeeName'];
			break;
		case 'Project':
			if (($registry['newIdDepForPro']!=null)AND($registry['newNameDepForPro']!=null)){
				$smarty->assign('departmentId', $registry['newIdDepForPro']);
				$smarty->assign('departmentName', $registry['newNameDepForPro']);
			}else{
				$smarty->assign('departmentId', $registry['GET']['departmentId']);
				$smarty->assign('departmentName', $registry['GET']['departmentName']);
			}
			if($registry['GET']['newName']!=null){
				$smarty->assign('projectName', $registry['GET']['newName']);
			}else{
				$smarty->assign('projectName', $registry['GET']['projectName']);
			}
			$smarty->assign('projectId', $registry['GET']['projectId']);
			$smarty->assign('array', $$key);
			$smarty->assign('select', $registry['selectDepartment']);
			$smarty->assign('countselect', count($registry['selectDepartment']));
			$smarty->assign('selectEmp', $registry['selectEmployee']);
			$smarty->assign('selectEmpNot', $registry['selectEmployeeNot']);
			$smarty->assign('countselectEmp', count($registry['selectEmployee'])+count($registry['selectEmployeeNot']));
			$header = 'Проект: '. $registry['GET']['projectName'];
			break;
		case 'selectLoginInLDAP':
			$smarty->assign('array', $$key);
			$smarty->assign('action', $registry['GET']['action']);
			if ($registry['GET']['lastPage']!=null){
				$smarty->assign('lastPage', $registry['GET']['lastPage']);
				if($registry['GET']['lastPage']=='Department'){
					$smarty->assign('departmentName', $registry['GET']['departmentName']);
					$smarty->assign('departmentId', $registry['GET']['departmentId']);
				}
				if($registry['GET']['lastPage']=='Employee'){
					$smarty->assign('employeeId', $registry['GET']['employeeId']);
				}
			}else{
				$smarty->assign('lastPage', 'list');
				$smarty->assign('content', 'Department');
			}
			$smarty->assign('editId', $registry['GET']['editId']);
			$smarty->assign('newDepartmwent', $registry['GET']['newDepartmwent']);
			if ($registry['actionEmployeeFalse']==true){
				$smarty->assign('action', 'Edit');
				$smarty->assign('editId', $registry['editId']);
				$smarty->assign('newDepartmwent', $registry['departmwent']);
			}
			$header = 'Список Логинов из LDAP';
			break;
		case 'Role':
			$header = 'Пользователи и Роли';
			$smarty->assign('array', $$key);
			$smarty->assign('selectEmp', $registry['selectEmployee']);
			$smarty->assign('selectRole', $registry['selectRole']);
			$smarty->assign('countselectEmp', count($registry['selectEmployee']));
			$smarty->assign('countselectRole', count($registry['selectRole']));
			break;
		default:
			$header = 'Unknown Page';
			break;
	}
	$smarty->assign('title', $header);
	$smarty->display($contentPage);
}else{
	$smarty->display('3pty/Smarty/demo/templates/authorization.tpl');
}
