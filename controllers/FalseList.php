<?php
/*
* Copyright (c) 2016 Tecom LLC
* All rights reserved
*
* Исключительное право (c) 2016 пренадлежит ООО Теком
* Все права защищены
*/
/**
Класс контроллер, список пользователей и ролей.

@author ershov.v
*/
Class Controller_Role Extends Controller_Base {

	public $log;
	public $postgreSQL;
	
	/** Отображение списка пользоваьелей и ролей. */
	function index() {
		if($date['date']==null){
			$this->getDate();
		}
		$arrayEmployeeNames = $this->postgreSQL->getEmployeeNames($date);
		$this->template->vars('arrayEmployeeNames', $arrayEmployeeNames);
		$this->template->view('FalseList', 'FalseListLayout');
	}
	
	/** Получение даты. */
	private function getDate() {
		if (($date['GET']['Month']!=null)AND($date['GET']['Year']!=null)){
			$date['date'] = new DateTime('01.'.$date['GET']['Month'].'.'.$date['GET']['Year'], new DateTimeZone('UTC'));
		}else{
			if ($date['GET']['date']!=null){
				$dayMonthYear = explode('/', $date['GET']['date']);
				$date['date'] = new DateTime('01.'.$dayMonthYear['0'].'.'.$dayMonthYear['2'], new DateTimeZone('UTC'));
			}else{
				$date['date'] = new DateTime();
			}
		}
	}
	
	/** Редактирование информации сотрудника. */
	function editEmployee(){
		$date = $this->getDate();
		$user = $this->checkLoginLdapForEmployee();
		if ($user != null){
			$idNameDepartment = explode('*-*', $_GET['newDepartmwent']);
			if($idNameDepartment['1']!=null){
				$departmentId = $idNameDepartment['0'];
				$departmentName = $idNameDepartment['1'];
			}else{
				$departmentId=$_GET['newDepartmwent'];
			}
			$this->postgreSQL->changeEmployeeInfo($_GET['editId'], $date, $user['Login'], $user['Name'], $departmentId);
			$this->index();
		}
	}
	
	/** Проверка логина сотрудника в LDAP при создании и редактировании. */
	private function checkLoginLdapForEmployee() {
		$ldap = new LdapOperations();
		$ldap->connect();
		$arrayLDAPAccountNames = $ldap->getLDAPAccountNamesByPrefix($_GET['newLogin']);
		if (count($arrayLDAPAccountNames)>1){
			$date = $this->getDate();
			$this->template->vars('date', $date);
			$this->template->vars('arrayLDAPAccountNames', $arrayLDAPAccountNames);
			$this->template->view('selectLoginInLDAP', 'selectLoginInLDAPLayout');
		}else{
			$user['Name'] = $arrayLDAPAccountNames['0']['sn'].' '.$arrayLDAPAccountNames['0']['givenName'];
			$user['Login'] = $arrayLDAPAccountNames['0']['sAMAccountName'];
			return $user;
		}
	}
	
}