<?php
require '3pty/Smarty/libs/Smarty.class.php';

$smarty = new Smarty;
$smarty->force_compile = false;
$smarty->debugging = false;
$smarty->caching = false;
$smarty->cache_lifetime = 120;
if ($name != 'authorization'){
	$smarty->assign('contentPage', $contentPage);
	$smarty->assign('name', $registry['userName']);
	$smarty->assign('role', $registry['roleName']);
	switch($name){
		case 'mainPage':
			$header = 'Main Page';
			break;
		case 'List':
			$smarty->assign('selectedDate', $registry['date']);
			$smarty->assign('array', $$key);
			$header = 'List of '.$registry['list'].'`s.';
			unset($registry['list']);
			break;	
		case 'Department':
			$smarty->assign('departmentName', $registry['departmentName']);
			$smarty->assign('departmentId', $registry['departmentId']);
			$smarty->assign('selectedDate', $registry['date']);
			$smarty->assign('array', $$key);
			$header = 'Department: '. $registry['departmentName'];
			unset($registry['departmentId']);
			unset($registry['departmentName']);
			break;
		case 'Employee':
			$smarty->assign('employeeName', $registry['employeeName']);
			$smarty->assign('employeeId', $registry['employeeId']);
			$smarty->assign('$employeePercent', $registry['employeePercent']);
			$smarty->assign('selectedDate', $registry['date']);
			$smarty->assign('array', $$key);
			$header = 'Employee: '. $registry['employeeName'];
			unset($registry['employeetId']);
			unset($registry['employeetName']);
			unset($registry['employeePercent']);
			break;
		case 'Project':
			$smarty->assign('projectName', $registry['projectName']);
			$smarty->assign('projectId', $registry['projectId']);
			$smarty->assign('selectedDate', $registry['date']);
			$smarty->assign('array', $$key);
			$header = 'Project: '. $registry['projectName'];
			unset($registry['projectName']);
			unset($registry['projectId']);
			break;
		case 'EditAndCreate':
			$smarty->assign('selectedDate', $registry['date']);
			$smarty->assign('cloneInfo', false);
			$smarty->assign('setName', false);
			$smarty->assign('setDepartment', false);
			$smarty->assign('setEmployee', false);
			$smarty->assign('setProject', false);
			$smarty->assign('setPercent', false);
			$smarty->assign('message', null);
			$smarty->assign('lastName', null);
			switch($registry['content']){
				case 'createDepartment':
					$header = 'New Department';
					$lastPage = "<li><a href=\"/list/?content='Department'\">List of Department`s</a></li>\"";
					$smarty->assign('setName', true);
					$smarty->assign('action', 'New');
					$smarty->assign('modName', 'Department');
					break;
				case 'createEmployee':
					$header = 'New Employee';
					$lastPage = "<li><a href=\"/list/?content='Empoyee'\">List of Employee`s</a></li>\"";
					$smarty->assign('setName', true);
					$smarty->assign('setDepartment', true);
					$smarty->assign('message', 'In this box need`s insert login of new employee');
					$smarty->assign('action', 'New');
					$smarty->assign('modName', 'Employee');
					break;
				case 'createProject':
					$header = 'New Project';
					$lastPage = "<li><a href=\"/list/?content='Project'\">List of Project`s</a></li>\"";
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
					$smarty->assign('departmentName', $registry['departmentName']);
					$smarty->assign('departmentId', $registry['departmentId']);
					$smarty->assign('editId', $registry['departmentId']);
					$smarty->assign('modName', 'Department');
					$smarty->assign('action', 'Edit');
					$smarty->assign('setName', true);
					$smarty->assign('lastName', $registry['departmentName']);
					$lastPage = "<a href=\"/department/?departmentId=\{\"\$departmentId\"}&departmentName=\{\"\$departmentName\"}\"></a>";
					unset($registry['departmentId']);
					unset($registry['departmentName']);
					break;
				case 'editEmployee':
					$header = 'Edit Employee';
					$smarty->assign('employeeName', $registry['employeeName']);
					$smarty->assign('employeeId', $registry['employeeId']);
					$smarty->assign('editId', $registry['employeeId']);
					$smarty->assign('modName', 'Employee');
					$smarty->assign('action', 'Edit');
					$smarty->assign('setName', true);
					$smarty->assign('setDepartment', true);
					$smarty->assign('lastName', $registry['employeeName']);
					$lastPage = "<a href=\"/employee/?employeeId=\{\"\$employeeId\"}&employeeName=\{\"\$employeeName\"}\"></a>";
					unset($registry['employeeId']);
					unset($registry['employeeName']);
					break;
				case 'editProject':
					$header = 'Edit Project';
					$smarty->assign('projectName', $registry['projectName']);
					$smarty->assign('projectId', $registry['projectId']);
					$smarty->assign('editId', $registry['projectId']);
					$smarty->assign('modName', 'Project');
					$smarty->assign('action', 'Edit');
					$smarty->assign('setName', true);
					$smarty->assign('setDepartment', true);
					$smarty->assign('lastName', $registry['projectName']);
					$lastPage = "<a href=\"/project/?projectId=\{\"\$projectId\"}&projectName=\{\"\$projectName\"}\"></a>";
					unset($registry['projectId']);
					unset($registry['projectName']);
					break;
				case 'createPercent':
					$header = 'New Employee`s Percent For Project';
					$smarty->assign('modName', 'Percent');
					$smarty->assign('action', 'New');
					if (($registry['projectId'])AND($registry['projectName'])){
						$smarty->assign('projectName', $registry['projectName']);
						$smarty->assign('projectId', $registry['projectId']);
						$smarty->assign('setEmployee', true);
						$smarty->assign('setProject', true);
						$smarty->assign('setPercent', true);
						$smarty->assign('lastNameProject', $registry['projectName']);
						$lastPage = "<a href=\"/project/?projectId=\{\"\$projectId\"}&projectName=\{\"\$projectName\"}\"></a>";
						unset($registry['projectId']);
						unset($registry['projectName']);
					}
					if (($registry['employeeId'])AND($registry['employeeName'])){
						$smarty->assign('employeeName', $registry['employeeName']);
						$smarty->assign('employeeId', $registry['employeeId']);
						$smarty->assign('setEmployee', true);
						$smarty->assign('setProject', true);
						$smarty->assign('setPercent', true);
						$smarty->assign('lastNameEmployee', $registry['employeeName']);
						$lastPage = "<a href=\"/employee/?employeeId=\{\"\$employeeId\"}&employeeName=\{\"\$employeeName\"}\"></a>";
						unset($registry['employeeId']);
						unset($registry['employeeName']);
					}
				break;
					
				default:
					$header = 'Unknown Page';
					break;
			}
			break;
		default:
			$header = 'Unknown Page';
			break;
	}
	$smarty->assign('lastPage', $lastPage);
	$smarty->assign('title', $header);
	
	$smarty->display('3pty/Smarty/demo/templates/index.tpl');
}else{
	$smarty->display('3pty/Smarty/demo/templates/authorization.tpl');
}
