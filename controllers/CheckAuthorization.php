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
		unset($this->registry['GET']);
		unset($this->registry['POST']);
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
		$rowsEmployee = $this->postgreSQL->getEmployeeNames($date);
		if($rowsEmployee!=null){
			$ldap = new LdapOperations();
			$ldap->connect();
			foreach ($rowsEmployee as $key=>$array){
				$arrayLDAPAccountNames = $ldap->getLDAPAccountNamesByPrefix($array['user_id']);
				if (count($arrayLDAPAccountNames)>1){
					$falseArrayDB['id']=$array['employee_id'];
					$falseArrayDB['login']=$array['user_id'];
					$falseArrayDB['name']=$array['user_name'];
					$falseArrayDB['departmwent']=$array['department_id'];
				}else{
					if($array['user_name']==null){
						$rowsEmployee[$key]['user_name'] = $arrayLDAPAccountNames['0']['sn'].' '.$arrayLDAPAccountNames['0']['givenName'];
						$this->postgreSQL->changeEmployeeInfo($rowsEmployee[$key]['employee_id'], $date, 
							$rowsEmployee[$key]['user_id'], $rowsEmployee[$key]['user_name'], 
								$rowsEmployee[$key]['department_id']);
					}
				}
			}
			if($falseArrayDB!=null){
				$this->template->vars('date', $date);
				$this->template->vars('falseArrayDB', $falseArrayDB);
				$this->template->view('falseList', 'falseListLayout');
			}
		}
	}
	
}