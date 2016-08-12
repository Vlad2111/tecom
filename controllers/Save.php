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
						$ldap = new LdapOperations();
						$ldap->connect();
						$rows = $ldap->getLDAPAccountNamesByPrefix($registry['GET']['newLogin']);
						if (count($rows)>1){
							$this->template->vars('rows', $rows);
							$this->template->view('selectLoginInLDAP');
						}else{
							if($registry['GET']['action']=='New'){
								$model->newEmployee($registry['date'], $registry['GET']['newLogin'], $registry['GET']['newDepartmwent']);
							}
							if($registry['GET']['action']=='Edit'){
								$model->changeEmployeeInfo($registry['GET']['editId'], $registry['date'], $registry['GET']['newLogin'],
									$registry['GET']['newDepartmwent']);
							}
							$rowsEmployee = $model->getEmployeeNames($registry['date']);
							if($rowsEmployee!=null){
								foreach ($rowsEmployee as $key=>$arr){
									$rows = $ldap->getLDAPAccountNamesByPrefix($arr['user_id']);
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
							$registry['correctDataInBD']=true;
							$rows = $model->getDepartmentNames($registry['date']);
							$registry['selectDepartment'] = $rows;
							$rows = $model->getEmployeeNames($registry['date']);
							if($rows!=null){
								foreach ($rows as $key=>$arr){
									$names = $ldap->getLDAPAccountNamesByPrefix($arr['user_id']);
									$rows[$key]['user_name'] = $names['0']['sn'].' '.$names['0']['givenName'];
								}
							}
							$this->template->vars('rows', $rows);
							$this->template->view('listEmployees');
						}
						break;
					case 'Project':
						if($registry['GET']['action']=='New'){
							$model->newProject($registry['date'], $registry['GET']['newName'], $registry['GET']['newDepartmwent']);
						}
						if($registry['GET']['action']=='Edit'){
							$model->changeProjectNameAndDepartmentId($registry['GET']['editId'], $registry['date'], 
								$registry['GET']['newName'], $registry['GET']['newDepartmwent']);
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