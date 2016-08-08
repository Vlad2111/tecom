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
Class Controller_list Extends Controller_Base {

	public $layouts = "index";
	private $log;
	
	function __construct() {
		$this->log = Logger::getLogger(__CLASS__);
	}

	function index($registry) {
		if ($registry['GET']['date']){
			$model = new Model_PostgreSQLOperations();
			$model->connect();
			switch($registry['content']){
				case 'Department':
					if($_GET['action']=='remove'){
						$model->deleteDepartment($registry['date'], $_GET['departmentId']);
					}
					$rows = $model->getDepartmentNames($registry['date']);
					$this->template->vars('rows', $rows);
					$this->template->view('listDepartments');
					break;
				case 'Employee':
					if($_GET['action']=='remove'){
						$model->deleteEmployee($registry['date'], $_GET['employeeId']);
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
					if($_GET['action']=='remove'){
						$model->deleteProject($registry['date'], $_GET['projectId']);
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