<?php
/*
* Copyright (c) 2016 Tecom LLC
* All rights reserved
*
* Исключительное право (c) 2016 пренадлежит ООО Теком
* Все права защищены
*/
/**
Класс контроллер, проверка после авторизации.

@author ershov.v
*/
Class Controller_CheckAuthorization Extends Controller_Base {

	public $log;
	public $postgreSQL;

	
	function index() {
		
		$answer=$this->checkUser($_POST['login'], $_POST['password']);
		
		if($answer==true){
			$this->checkDB();
			$_GET['route']='list/viewListDepartment';
		}else{
			$_GET['route']='index';
		}
		include 'index.php';
	}
	
	/** Проверка пользователя и запрос роли. */
	private function checkUser($login, $password) {
		if (($login!=null)AND($password!=null)){
			$ldap = new LdapOperations();
			$ldap->connect();
			$check = $ldap->checkUser($login, $password);
			if($check==true){
				$names = $ldap->getLDAPAccountNamesByPrefix($login);
				$_GET['nameUser'] = $names['0']['sn'].' '.$names['0']['givenName'];
				$role = $this->postgreSQL->getRoleName($login);
				$_GET['roleUser']=$role;
				return true;
			}
		}
	}
	
	/** Проверка базы данных. */
	private function checkDB() {
		$date = new DateTime();
		$rowsDepartment = $this->postgreSQL->getDepartmentNames($date);
		if($rowsDepartment!=null){
			foreach ($rowsDepartment as $key=>$array){
				if (($array['department_id']!=null)AND($array['department_name']==null)){
					$falseArrayDB['department'][$key]=$array;
				}
			}
		}
		$rowsEmployee = $this->postgreSQL->getEmployeeNames($date);
		if($rowsEmployee!=null){
			$ldap = new LdapOperations();
			$ldap->connect();
			foreach ($rowsEmployee as $key=>$array){
				if (($array['user_id']!=null)AND($array['department_id']!=null)){
					$arrayLDAPAccountNames = $ldap->getLDAPAccountNamesByPrefix($array['user_id']);
					if (count($arrayLDAPAccountNames)!=1){
						$falseArrayDB['employee'][$key]=$array;
					}else{
						if($array['user_name']==null){
							$rowsEmployee[$key]['user_name'] = $arrayLDAPAccountNames['0']['sn'].' '.$arrayLDAPAccountNames['0']['givenName'];
							$this->postgreSQL->changeEmployeeInfo($rowsEmployee[$key]['employee_id'], $date, 
								$rowsEmployee[$key]['user_id'], $rowsEmployee[$key]['user_name'], 
									$rowsEmployee[$key]['department_id']);
						}	
					}
				}else{
					$falseArrayDB['employee'][$key]=$array;
				}
			}
		}
		$rowsProject = $this->postgreSQL->getProjectNames($date);
		if($rowsProject!=null){
			foreach ($rowsProject as $key=>$array){
				if (($array['project_id']!=null)AND(($array['project_name']==null)OR($array['department_id']==null))){
					$falseArrayDB['project'][$key]=$array;
				}
			}
		}
		if($falseArrayDB!=null){
			$_GET['falseList']=$falseArrayDB;
			$_GET['route']='falseList/viewFalseList';
			$_GET['date']=$date;
			include 'index.php';
		}
	}
	
}