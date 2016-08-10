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
			$names = $ldap->getLDAPAccountNamesByPrefix($registry['POST']['login']);
			$registry['userName'] = $names['0']['sn'].' '.$names['0']['givenName'];
			$model = new Model_PostgreSQLOperations();
			$model->connect();
			$role = $model->getRoleName($registry['POST']['login']);
			$registry['roleName']=$role;
			$this->template->view('listDepartments');
		}
		if(($registry['GET']['nameUser']!=null)AND($registry['GET']['roleUser']!=null)){
			$registry['roleName']=$registry['GET']['roleUser'];
			$registry['userName']=$registry['GET']['nameUser'];
		}
		if(($registry['roleName']!=null)AND($registry['userName']!=null)){
			//$registry['date'] = $registry['GET']['date'];
			$registry['date'] = new DateTime('01.01.2016', new DateTimeZone('UTC'));
			if ($registry['date']!=null){
				$model = new Model_PostgreSQLOperations();
				$model->connect();
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
						$rows = $model->getEmployeeNames($registry['date']);
						$ldap = new LdapOperations();
						$ldap->connect();
						foreach ($rows as $key=>$arr){
							$names = $ldap->getLDAPAccountNamesByPrefix($arr['user_id']);
							$rows[$key]['user_id'] = $names['0']['sn'].' '.$names['0']['givenName'];
						}
							$this->template->vars('rows', $rows);
						$this->template->view('listEmployees');
						break;
					case 'Project':
						if($registry['GET']['action']=='remove'){
							$model->deleteProject($registry['date'], $registry['GET']['projectId']);
						}
						$rows = $model->getProjectNames($registry['date']);
						$this->template->vars('rows', $rows);
						$this->template->view('listProjects');
						break;
					default:
						$header = 'Unknown page';
						break;
				}
			}else{
				switch($registry['GET']['content']){
					case 'Department':
						$this->template->view('listDepartments');
						break;
					case 'Employee':
						$this->template->view('listEmployees');
						break;
					case 'Project':
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