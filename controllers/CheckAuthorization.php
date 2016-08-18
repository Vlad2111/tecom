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

	
	function index($registry) {
		
		$answer=$this->checkUser($registry);
		
		if($answer==true){
			$this->checkDB($registry);
			$_GET['route']='list/index';
		}
		unset($this->registry['GET']);
		unset($this->registry['POST']);
		include 'index.php';
	}
	
	/** Проверка пользователя и запрос роли. */
	private function checkUser($registry) {
		if (($_POST['login']!=null)AND($_POST['password']!=null)){
			$ldap = new LdapOperations();
			$ldap->connect();
			$check = $ldap->checkUser($_POST['login'], $_POST['password']);
			if($check==true){
				$names = $ldap->getLDAPAccountNamesByPrefix($_POST['login']);
				$_GET['nameUser'] = $names['0']['sn'].' '.$names['0']['givenName'];
				$role = $this->postgreSQL->getRoleName($_POST['login']);
				$_GET['roleUser']=$role;
				unset($_POST);
				return true;
			}
		}
	}
	
	/** Проверка базы данных. */
	private function checkDB($registry) {
		$registry['date'] = new DateTime();
		$rowsEmployee = $this->postgreSQL->getEmployeeNames($registry['date']);
		if($rowsEmployee['user_name']==null){
			$ldap = new LdapOperations();
			$ldap->connect();
			if($rowsEmployee!=null){
				foreach ($rowsEmployee as $key=>$arr){
					$rows = $ldap->getLDAPAccountNamesByPrefix($arr['user_id']);
					if($arr['user_name']==null){
						if (count($rows)>1){
							$registry['departmwent']=$arr['department_id'];
							$registry['editId']=$arr['employee_id'];
							$registry['actionEmployeeFalse']=true;
							$this->template->vars('rows', $rows);
							$this->template->view('selectLoginInLDAP', 'selectLoginInLDAPLayout');
							break;
						}else{
							$rowsEmployee[$key]['user_name'] = $rows['0']['sn'].' '.$rows['0']['givenName'];
							$this->postgreSQL->changeEmployeeInfo($rowsEmployee[$key]['employee_id'], $registry['date'], 
									$rowsEmployee[$key]['user_id'], $rowsEmployee[$key]['user_name'], 
										$rowsEmployee[$key]['department_id']);
						}
					}else{
						if (count($rows)>1){
							$registry['departmwent']=$arr['department_id'];
							$registry['editId']=$arr['employee_id'];
							$registry['actionEmployeeFalse']=true;
							$this->template->vars('rows', $rows);
							$this->template->view('selectLoginInLDAP', 'selectLoginInLDAPLayout');
							break;
						}
					}
				}
			}
		}
	}
	
}