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
	
	public $layouts = "index";
	public  $log;
	
	function index($registry) {
		$registry['date'] = new DateTime('01.'.$registry['GET']['Month'].'.'.$registry['GET']['Year']);
		if ($registry['date']){
			$model = new Model_PostgreSQLOperations();
			$model->connect();
			switch($registry['content']){
				case 'NewDepartment':
					$model->newDepartment($registry['date'], $registry['POST']['newName']);

					$rows = $model->getDepartmentNames($registry['date']);
					$this->template->vars('rows', $rows);
					$this->template->view('listDepartments');
					break;
				case 'NewEmployee':
					$model->newEmployee($registry['date'], $registry['POST']['newName'], $registry['POST']['newDepartmwent']);
						
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
					$model->newProject($registry['date'], $registry['POST']['newName'], $registry['POST']['newDepartmwent']);
					
					$rows = $model->getProjectNames($registry['date']);
					$this->template->vars('rows', $rows);
					$this->template->view('listProjects');
					break;
				case 'CloneInformation':
					$model->cloneModelData($registry['POST']['datepicker1'], $registry['POST']['datepicker2']);
						
					unset($registry['date']);
					$this->template->view('mainPage');
					break;
				case 'EditDepartment':
					$model->changeDepartmentName($registry['POST']['editId'], $registry['date'], $registry['POST']['newName']);
						
					$rows = $model->getDepartmentNames($registry['date']);
					$this->template->vars('rows', $rows);
					$this->template->view('listDepartments');
					break;
				case 'EditEmployee':
					$model->changeEmployeeInfo($registry['POST']['editId'], $registry['date'], $registry['POST']['newName'],
						$registry['POST']['newDepartmwent']);
				
					$rows = $model->getEmployeeNames($registry['date']);
					$this->template->vars('rows', $rows);
					$this->template->view('listEmployees');
					break;
				case 'EditProject':
					$model->changeProjectNameAndDepartmentId($registry['POST']['newProject'], $registry['date'], 
						$registry['POST']['newName'], $registry['POST']['newDepartmwent']);
				
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