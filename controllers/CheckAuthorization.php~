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
				session_start();
				$_SESSION[session_name()] = session_id();
				$names = $ldap->getLDAPAccountNamesByPrefix($login);
				$_SESSION['nameUser'] = $names['0']['sn'].' '.$names['0']['givenName'];
				$role = $this->postgreSQL->getRoleName($login);
				if ($role['0']['role_name'] == "Глава Отдела"){
					$date = new DateTime();
					$date->setTimezone(new DateTimeZone('UTC'));
					$department = $this->postgreSQL->getDepartmentHead($date, $login);
					$countHeadId = 0;
					foreach($department as $key=>$dep){
						if($countHeadId == 0){
							if(count($department)!=1){
								$role['0']['role_name'] = 'Глава Отделов: <br>'.$dep['department_name'].'<br>';
							}else{
								$role['0']['role_name'] = $role['0']['role_name'].': <br>'.$dep['department_name'].'<br>';
							}
							$_SESSION['headId'.$countHeadId]=$dep['department_id'];
						}else{
							$role['0']['role_name'] = $role['0']['role_name'].' '.$dep['department_name'].'<br>';
							$_SESSION['headId'.$countHeadId]=$dep['department_id'];
						}
						$countHeadId = $countHeadId+1;
					}
				}
				$_SESSION['countHeadId']=$countHeadId;
				$_SESSION['roleUser']=$role['0']['role_name'];
				$_SESSION['roleIdUser']=$role['0']['role_id'];
				return true;
			}
		}
	}
}
