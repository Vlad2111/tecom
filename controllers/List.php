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
		//$registry['date'] = $registry['GET']['date'];
		$registry['date'] = new DateTime('01.01.2016', new DateTimeZone('UTC'));
		if ($registry['date']){
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
			$this->log->error("Не выбрана дата.");
			throw new Exception("Не выбрана дата.");
		}		
	}
}