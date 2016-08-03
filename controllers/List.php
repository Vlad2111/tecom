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

	function index() {
		if ($_GET['date']){
			$registry['date'] = $_GET['date'];
		}
		if ($registry['date']){
			$model = new Model_PostgreSQLOperations();
			$model->connect();
			switch($_GET['content']){
				case 'Department':
					$registry['list'] = 'Department';
					if($_GET['action']=='remove'){
						$model->deleteDepartment($registry['date'], $_GET['departmentId']);
						unset($registry['departmentId']);
					}
					$rows = $model->getDepartmentNames($registry['date']);
					$this->template->vars('rows', $rows);
					$this->template->view('listDepartments');
					break;
				case 'Employee':
					$registry['list'] = 'Employee';
					if($_GET['action']=='remove'){
						$model->deleteEmployee($registry['date'], $_GET['employeeId']);
						unset($registry['employeeId']);
					}
					$rows = $model->getEmployeeNames($registry['date']);
					$ldap = new LdapOperations();
					$ldap->connect();
					foreach ($rows as $a){
						$names = $ldap->getLDAPAccountNamesByPrefix($rows[$a]['user_id']);
						$rows[$a]['user_id'] = $names['0']['sn'].' '.$names['0']['givenName'];
					}
					$this->template->vars('rows', $rows);
					$this->template->view('listEmployees');
					break;
				case 'Project':
					$registry['list'] = 'Project';
					$rows = $model->getProjectNames($registry['date']);
					$this->template->vars('rows', $rows);
					$this->template->view('listProjects');
					break;
				default:
					$header = 'Unknown page';
					break;
			}
		}else{
			$rows = false;
			throw new Exception("Не выбрана дата.");
		}		
	}
	
}