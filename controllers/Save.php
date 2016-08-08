<?php
/*
* Copyright (c) 2016 Tecom LLC
* All rights reserved
*
* Исключительное право (c) 2016 пренадлежит ООО Теком
* Все права защищены
*/
/**
Класс контроллер, сохранение.

@author ershov.v
*/
Class Controller_save Extends Controller_Base {
	
	private $log;
	
	function __construct() {
		$this->log = Logger::getLogger(__CLASS__);
	}
	
	function index($registry) {
		if ($registry['date']){
			$model = new Model_PostgreSQLOperations();
			$model->connect();
			switch($_POST['content']){
				case 'NewDepartment':
					$model->newDepartment($registry['date'], $_POST['newName']);
					
					$registry['list'] = 'Department';
					$rows = $model->getDepartmentNames($registry['date']);
					$this->template->vars('rows', $rows);
					$this->template->view('listDepartments');
					break;
				case 'NewEmployee':
					$model->newEmployee($registry['date'], $_POST['newName'], $_POST['newDepartmwent']);
						
					$registry['list'] = 'Employee';
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
				case 'NewProject':
					$model->newProject($registry['date'], $_POST['newName'], $_POST['newDepartmwent']);
					
					$registry['list'] = 'Project';
					$rows = $model->getProjectNames($registry['date']);
					$this->template->vars('rows', $rows);
					$this->template->view('listProjects');
					break;
				case 'CloneInformation':
					$model->cloneModelData($_POST['datepicker1'], $_POST['datepicker2']);
						
					unset($registry['date']);
					$this->template->view('mainPage');
					break;
				case 'EditDepartment':
					$model->changeDepartmentName($_POST['editId'], $registry['date'], $_POST['newName']);
						
					$registry['list'] = 'Department';
					$rows = $model->getDepartmentNames($registry['date']);
					$this->template->vars('rows', $rows);
					$this->template->view('listDepartments');
					break;
				case 'EditEmployee':
					$model->changeEmployeeInfo($_POST['editId'], $registry['date'], $_POST['newName'],
						$_POST['newDepartmwent']);
				
					$registry['list'] = 'Employee';
					$rows = $model->getEmployeeNames($registry['date']);
					$this->template->vars('rows', $rows);
					$this->template->view('listEmployees');
					break;
				case 'EditProject':
					$model->changeProjectNameAndDepartmentId($_POST['newProject'], $registry['date'], 
						$_POST['newName'], $_POST['newDepartmwent']);
				
					$registry['list'] = 'Project';
					$rows = $model->getProjectNames($registry['date']);
					$this->template->vars('rows', $rows);
					$this->template->view('listProjects');
					break;
				case 'EditProject':
					$model->changeEployeeTime($_POST['newEmployee'], $_POST['editId'], $registry['date'], 
						$_POST['range_1']);
				
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
			$this->log->error("Не выбрана дата.");
			throw new Exception("Не выбрана дата.");
		}		
	}
	
}