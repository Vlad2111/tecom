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
			$_GET['route']='List/viewListDepartment';
		}else{
			$_GET['route']='Index';
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
				if ($role['0']['role_name'] == "Глава Отдела"){
					$department = $this->postgreSQL->getDepartmentHead(new DateTime(), $login);
					$role['0']['role_name'] = $role['0']['role_name'].': '.$department['0']['department_name'];
					$_GET['headId']=$department['0']['department_id'];
				}
				$_GET['roleUser']=$role['0']['role_name'];
				$_GET['roleIdUser']=$role['0']['role_id'];
				return true;
			}
		}
	}
}