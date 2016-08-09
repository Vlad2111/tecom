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
	switch($name){
		case 'mainPage':
			$header = 'Main Page';
			break;
		case 'listDepartments':
			$smarty->assign('selectedMonthForGet', $registry['date']->format('m'));
			$smarty->assign('selectedYearForGet', $registry['date']->format('Y'));
			$smarty->assign('selectedDate', $registry['date']->format('m-Y'));
			$smarty->assign('array', $$key);
			$header = 'List of Department`s.';
			break;
		case 'listEmployees':
			$smarty->assign('selectedMonthForGet', $registry['date']->format('m'));
			$smarty->assign('selectedYearForGet', $registry['date']->format('Y'));
			$smarty->assign('selectedDate', $registry['date']->format('m-Y'));
			$smarty->assign('array', $$key);
			$header = 'List of Employee`s.';
			break;
		case 'listProjects':
			$smarty->assign('selectedMonthForGet', $registry['date']->format('m'));
			$smarty->assign('selectedYearForGet', $registry['date']->format('Y'));
			$smarty->assign('selectedDate', $registry['date']->format('m-Y'));
			$smarty->assign('array', $$key);
			$header = 'List of Project`s.';
			break;	
		case 'Department':
			$smarty->assign('selectedMonthForGet', $registry['date']->format('m'));
			$smarty->assign('selectedYearForGet', $registry['date']->format('Y'));
			$smarty->assign('selectedDate', $registry['date']->format('m-Y'));
			$smarty->assign('departmentName', $registry['GET']['departmentName']);
			$smarty->assign('departmentId', $registry['GET']['departmentId']);
			$smarty->assign('array', $$key);
			$header = 'Department: '. $registry['GET']['departmentName'];
			break;
		case 'Employee':
			$smarty->assign('selectedMonthForGet', $registry['date']->format('m'));
			$smarty->assign('selectedYearForGet', $registry['date']->format('Y'));
			$smarty->assign('selectedDate', $registry['date']->format('m-Y'));
			$smarty->assign('employeeName', $registry['GET']['employeeName']);
			$smarty->assign('employeeId', $registry['GET']['employeeId']);
			$smarty->assign('employeePercent', $registry['employeePercent']);
			$smarty->assign('array', $$key);
			$header = 'Employee: '. $registry['GET']['employeeName'];
			unset($registry['employeePercent']);
			break;
		case 'Project':
			$smarty->assign('selectedMonthForGet', $registry['date']->format('m'));
			$smarty->assign('selectedYearForGet', $registry['date']->format('Y'));
			$smarty->assign('selectedDate', $registry['date']->format('m-Y'));
			$smarty->assign('projectName', $registry['GET']['projectName']);
			$smarty->assign('projectId', $registry['GET']['projectId']);
			$smarty->assign('array', $$key);
			$header = 'Project: '. $registry['GET']['projectName'];
			break;
		case 'EditAndCreate':
			$smarty->assign('selectedMonthForGet', $registry['date']->format('m'));
			$smarty->assign('selectedYearForGet', $registry['date']->format('Y'));
			$smarty->assign('selectedDate', $registry['date']->format('m-Y'));
			$smarty->assign('cloneInfo', false);
			$smarty->assign('setName', false);
			$smarty->assign('setDepartment', false);
			$smarty->assign('setEmployee', false);
			$smarty->assign('setProject', false);
			$smarty->assign('setPercent', false);
			$smarty->assign('message', null);
			$smarty->assign('lastName', null);
			$registry['content'] = $registry['GET']['content'];
			switch($registry['GET']['content']){
				case 'createDepartment':
					$header = 'New Department';
					$lastPage = "<li><a href=\"/index.php?route=list&content=Department\">List of Department`s</a></li>";
					$smarty->assign('setName', true);
					$smarty->assign('action', 'New');
					$smarty->assign('modName', 'Department');
					break;
				case 'createEmployee':
					$header = 'New Employee';
					$lastPage = "<li><a href=\"/index.php?route=list&content=Empoyee\">List of Employee`s</a></li>";
					$smarty->assign('setName', true);
					$smarty->assign('setDepartment', true);
					$smarty->assign('message', 'In this box need`s insert login of new employee');
					$smarty->assign('action', 'New');
					$smarty->assign('modName', 'Employee');
					break;
				case 'createProject':
					$header = 'New Project';
					$lastPage = "<li><a href=\"/index.php?route=list&content=Project\">List of Project`s</a></li>";
					$smarty->assign('setName', true);
					$smarty->assign('setDepartment', true);
					$smarty->assign('action', 'New');
					$smarty->assign('modName', 'Project');
					break;
				case 'cloneInfo':
					$header = 'Clone Information';
					$lastPage = null;
					$smarty->assign('cloneInfo', true);
					$smarty->assign('action', 'Clone');
					$smarty->assign('modName', 'Information');
					break;
				case 'editDepartment':
					$header = 'Edit Department';
					$smarty->assign('departmentName', $registry['GET']['departmentName']);
					$smarty->assign('departmentId', $registry['GET']['departmentId']);
					$smarty->assign('editId', $registry['GET']['departmentId']);
					$smarty->assign('modName', 'Department');
					$smarty->assign('action', 'Edit');
					$smarty->assign('setName', true);
					$smarty->assign('lastName', $registry['GET']['departmentName']);
					$lastPage = "<a href=\"/index.php?route=department&departmentId={\$departmentId}&departmentName={\$departmentName}\"></a>";
					break;
				case 'editEmployee':
					$header = 'Edit Employee';
					$smarty->assign('employeeName', $registry['GET']['employeeName']);
					$smarty->assign('employeeId', $registry['GET']['employeeId']);
					$smarty->assign('editId', $registry['GET']['employeeId']);
					$smarty->assign('modName', 'Employee');
					$smarty->assign('action', 'Edit');
					$smarty->assign('setName', true);
					$smarty->assign('setDepartment', true);
					$smarty->assign('lastName', $registry['GET']['employeeName']);
					$lastPage = "<a href=\"/index.php?route=employee&employeeId={\$employeeId}&employeeName={\$employeeName}\"></a>";
					break;
				case 'editProject':
					$header = 'Edit Project';
					$smarty->assign('projectName', $registry['GET']['projectName']);
					$smarty->assign('projectId', $registry['GET']['projectId']);
					$smarty->assign('editId', $registry['GET']['projectId']);
					$smarty->assign('modName', 'Project');
					$smarty->assign('action', 'Edit');
					$smarty->assign('setName', true);
					$smarty->assign('setDepartment', true);
					$smarty->assign('lastName', $registry['GET']['projectName']);
					$lastPage = "<a href=\"/index.php?route=project&projectId={\$projectId}&projectName={\$projectName}\"></a>";
					break;
				case 'createPercent':
					$header = 'New Employee`s Percent For Project';
					$smarty->assign('modName', 'Percent');
					$smarty->assign('action', 'New');
					$smarty->assign('lastPercent', 0);
					if (($registry['GET']['projectId'])AND($registry['GET']['projectName'])){
						$smarty->assign('projectName', $registry['GET']['projectName']);
						$smarty->assign('projectId', $registry['GET']['projectId']);
						$smarty->assign('setEmployee', true);
						$smarty->assign('setProject', true);
						$smarty->assign('setPercent', true);
						$smarty->assign('lastNameProject', $registry['GET']['projectName']);
						$lastPage = "<a href=\"/index.php?route=project&projectId={\$projectId}&projectName={\$projectName}\"></a>";
					}
					if (($registry['GET']['employeeId'])AND($registry['GET']['employeeName'])){
						$smarty->assign('employeeName', $registry['GET']['employeeName']);
						$smarty->assign('employeeId', $registry['GET']['employeeId']);
						$smarty->assign('setEmployee', true);
						$smarty->assign('setProject', true);
						$smarty->assign('setPercent', true);
						$smarty->assign('lastNameEmployee', $registry['GET']['employeeName']);
						$lastPage = "<a href=\"/index.php?route=employee&employeeId={\$employeeId}&employeeName={\$employeeName}\"></a>";
					}
					break;
				case 'editPercent':
					$header = 'Change Employee`s Percent For Project';
					$smarty->assign('modName', 'Percent');
					$smarty->assign('action', 'Edit');
					$smarty->assign('lastPercent', $registry['GET']['lastPercent']);
					if (($registry['GET']['projectId'])AND($registry['GET']['projectName'])){
						$smarty->assign('projectName', $registry['GET']['projectName']);
						$smarty->assign('projectId', $registry['GET']['projectId']);
						$smarty->assign('setEmployee', true);
						$smarty->assign('setProject', true);
						$smarty->assign('setPercent', true);
						$smarty->assign('lastNameProject', $registry['GET']['projectName']);
						$lastPage = "<a href=\"/index.php?route=project&projectId={\$projectId}&projectName={\$projectName}\"></a>";
					}
					if (($registry['GET']['employeeId'])AND($registry['GET']['employeeName'])){
						$smarty->assign('employeeName', $registry['GET']['employeeName']);
						$smarty->assign('employeeId', $registry['GET']['employeeId']);
						$smarty->assign('setEmployee', true);
						$smarty->assign('setProject', true);
						$smarty->assign('setPercent', true);
						$smarty->assign('lastNameEmployee', $registry['GET']['employeeName']);
						$lastPage = "<a href=\"/index.php?route=employee&employeeId={\$employeeId}&employeeName={\$employeeName}\"></a>";
					}
					break;
				default:
					$header = 'Unknown Editor';
					break;
			}
			$smarty->assign('lastPage', $lastPage);
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
