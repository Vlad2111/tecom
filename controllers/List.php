<?php
/*
* Copyright (c) 2016 Tecom LLC
* All rights reserved
*
* Исключительное право (c) 2016 пренадлежит ООО Теком
* Все права защищены
*/
/**
Класс контроллер, список.

@author ershov.v
*/
Class Controller_List Extends Controller_Base {

	public $layouts = "index";
	public $log;

	function index($registry) {
		if (($registry['POST']['login']!=null)AND($registry['POST']['password']!=null)){
			$ldap = new LdapOperations();
			$ldap->connect();
			$check = $ldap->checkUser($registry['POST']['login'], $registry['POST']['password']);
			if($check==true){
				$names = $ldap->getLDAPAccountNamesByPrefix($registry['POST']['login']);
				$registry['userName'] = $names['0']['sn'].' '.$names['0']['givenName'];
				$model = new PostgreSQLOperations();
				$model->connect();
				$role = $model->getRoleName($registry['POST']['login']);
				$registry['roleName']=$role;
			}
		}
		if(($registry['GET']['nameUser']!=null)AND($registry['GET']['roleUser']!=null)){
			$registry['roleName']=$registry['GET']['roleUser'];
			$registry['userName']=$registry['GET']['nameUser'];
		}
		$model = new PostgreSQLOperations();
		$model->connect();
		if(($registry['roleName']!=null)AND($registry['userName']!=null)){
			if (($registry['GET']['dateFrom']!=null)AND($registry['GET']['dateTo']!=null)){
				$dayMonthYear = explode('/', $registry['GET']['dateFrom']);
				$dateFrom = new DateTime('01.'.$dayMonthYear['0'].'.'.$dayMonthYear['2'], new DateTimeZone('UTC'));
				$dayMonthYear = explode('/', $registry['GET']['dateTo']);
				$dateTo = new DateTime('01.'.$dayMonthYear['0'].'.'.$dayMonthYear['2'], new DateTimeZone('UTC'));
				$model->cloneModelData($dateFrom, $dateTo);
				$registry['date'] = $dateTo;
			}else{
				if (($registry['GET']['Month']!=null)AND($registry['GET']['Year']!=null)){
					$registry['date'] = new DateTime('01.'.$registry['GET']['Month'].'.'.$registry['GET']['Year'], new DateTimeZone('UTC'));
				}else{
					if ($registry['GET']['date']!=null){
						$dayMonthYear = explode('/', $registry['GET']['date']);
						$registry['date'] = new DateTime('01.'.$dayMonthYear['0'].'.'.$dayMonthYear['2'], new DateTimeZone('UTC'));
					}else{
						$registry['date'] = new DateTime();
					}
				}
			}
			if ($registry['date']!=null){
				$rowsEmployee = $model->getEmployeeNames($registry['date']);
				if($rowsEmployee['user_name']==null){
					$ldap = new LdapOperations();
					$ldap->connect();
					if($rowsEmployee!=null){
						foreach ($rowsEmployee as $key=>$arr){
							$rows = $ldap->getLDAPAccountNamesByPrefix($arr['user_id']);
							if($arr['user_name']==null){
								if (count($rows)>1){
									$registry['departmwent']=$arr['department_id'];
									$registry['editId']=$arr['employee_id'];
									$registry['actionEmployeeFalse']=true;
									$this->template->vars('rows', $rows);
									$this->template->view('selectLoginInLDAP');
									break;
								}else{
									$rowsEmployee[$key]['user_name'] = $rows['0']['sn'].' '.$rows['0']['givenName'];
									$model->changeEmployeeInfo($rowsEmployee[$key]['employee_id'], $registry['date'], 
											$rowsEmployee[$key]['user_id'], $rowsEmployee[$key]['user_name'], 
												$rowsEmployee[$key]['department_id']);
								}
							}else{
								if (count($rows)>1){
									$registry['departmwent']=$arr['department_id'];
									$registry['editId']=$arr['employee_id'];
									$registry['actionEmployeeFalse']=true;
									$this->template->vars('rows', $rows);
									$this->template->view('selectLoginInLDAP');
									break;
								}
							}
						}
					}
				}
				switch($registry['GET']['content']){
					case 'Department':
						if($registry['GET']['action']=='remove'){
							$model->deleteDepartment($registry['date'], $registry['GET']['departmentId']);
						}
						$rows = $model->getDepartmentNames($registry['date']);
						$this->template->vars('rows', $rows);
						$this->template->view('listDepartments');
						break;
					case 'Employee':
						if($registry['GET']['action']=='remove'){
							$model->deleteEmployee($registry['date'], $registry['GET']['employeeId']);
						}
						$rows = $model->getDepartmentNames($registry['date']);
						$registry['selectDepartment'] = $rows;
						$rows = $model->getEmployeeNames($registry['date']);
						$this->template->vars('rows', $rows);
						$this->template->view('listEmployees');
						break;
					case 'Project':
						if($registry['GET']['action']=='remove'){
							$model->deleteProject($registry['date'], $registry['GET']['projectId']);
						}
						$rows = $model->getDepartmentNames($registry['date']);
						$registry['selectDepartment'] = $rows;
						$rows = $model->getProjectNames($registry['date']);
						$this->template->vars('rows', $rows);
						$this->template->view('listProjects');
						break;
					default:
						$header = 'Unknown page';
						break;
				}
			}
		}
	}
}