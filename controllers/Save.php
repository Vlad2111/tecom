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
		if(($registry['GET']['nameUser']!=null)AND($registry['GET']['roleUser']!=null)){
			$registry['roleName']=$registry['GET']['roleUser'];
			$registry['userName']=$registry['GET']['nameUser'];
			if (($registry['GET']['Month']!=null)AND($registry['GET']['Year']!=null)){
				$registry['date'] = new DateTime('01.'.$registry['GET']['Month'].'.'.$registry['GET']['Year'], new DateTimeZone('UTC'));
			}
			if ($registry['date']){
				$model = new Model_PostgreSQLOperations();
				$model->connect();
				switch($registry['GET']['content']){
					case 'Department':
						if($registry['GET']['action']=='New'){
							$model->newDepartment($registry['date'], $registry['GET']['newName']);
						}
						if($registry['GET']['action']=='Edit'){
							$model->changeDepartmentName($registry['GET']['editId'], $registry['date'], $registry['GET']['newName']);
						}
						$rows = $model->getDepartmentNames($registry['date']);
						$this->template->vars('rows', $rows);
						$this->template->view('listDepartments');
						break;
					case 'Employee':
						if($registry['GET']['action']=='New'){
							$model->newEmployee($registry['date'], $registry['GET']['newName'], $registry['GET']['newDepartmwent']);
						}
						if($registry['GET']['action']=='Edit'){
							$model->changeEmployeeInfo($registry['GET']['editId'], $registry['date'], $registry['GET']['newName'],
								$registry['GET']['newDepartmwent']);
						
						}
						$rows = $model->getEmployeeNames($registry['date']);
						if($rows!=null){
							$ldap = new LdapOperations();
							$ldap->connect();
							foreach ($rows as $a){
								$names = $ldap->getLDAPAccountNamesByPrefix($rows[$a]['user_id']);
								$rows[$a]['user_id'] = $names['0']['sn'].' '.$names['0']['givenName'];
							}
						}
						$this->template->vars('rows', $rows);
						$this->template->view('listEmployees');
						break;
					case 'Project':
						if($registry['GET']['action']=='New'){
							$model->newProject($registry['date'], $registry['GET']['newName'], $registry['GET']['newDepartmwent']);
						}
						if($registry['GET']['action']=='Edit'){
							$model->changeProjectNameAndDepartmentId($registry['GET']['newProject'], $registry['date'], 
								$registry['GET']['newName'], $registry['GET']['newDepartmwent']);
						
						}
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