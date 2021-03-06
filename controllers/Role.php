<?php
if(isset($_COOKIE[session_name()])) {session_start();}
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
	function viewRole() {
		$this->checkSession();
		
		$date = $this->getDate();
		$this->template->vars('date', $date);
		
		$arrayEmployeeNames = $this->postgreSQL->getEmployeeNames($date);
		$this->template->vars('arrayEmployeeNames', $arrayEmployeeNames);
			
		$arrayDepartmentNames = $this->postgreSQL->getDepartmentNames($date);
		$this->template->vars('arrayDepartmentNames', $arrayDepartmentNames);
			
		$arrayRoleDef = $this->postgreSQL->getRoleDef();
		$this->template->vars('arrayRoleDef', $arrayRoleDef);
			
		$arrayEmployeeRoleNamesAndId = $this->postgreSQL->getEmployeeRoleNamesAndId($date);
		$this->template->vars('arrayEmployeeRoleNamesAndId', $arrayEmployeeRoleNamesAndId);
			
		$this->template->view('role', 'RoleLayout');
	}
	
	/** Получение даты. */
	private function getDate() {
		if (($_GET['Month']!=null)AND($_GET['Year']!=null)){
			$date = new DateTime('01.'.$_GET['Month'].'.'.$_GET['Year'], new DateTimeZone('UTC'));
		}else{
			if ($_GET['date']!=null){
				$dayMonthYear = explode('/', $_GET['date']);
				$date = new DateTime('01.'.$dayMonthYear['0'].'.'.$dayMonthYear['1'], new DateTimeZone('UTC'));
			}else{
				$date = new DateTime();
				$date->setTimezone(new DateTimeZone('UTC'));
			}
		}
		return $date;
	}

	/** Проверка сессии. */
	private function checkSession() {
		if(($_SESSION[session_name()] != $_COOKIE[session_name()])OR(($_SESSION == null)AND($_COOKIE == null))){
			session_start();
			session_unset();
			session_destroy();
			$_GET['route']='Index';
			include 'index.php';
			exit;
		}
	}
	
	/* Действия с ролями */
	/** ->Добавление роли. */
	function newRole(){
		$date = $this->getDate();
		$this->postgreSQL->newRole($_GET['employeeId'], $_GET['roleId']);
		if($_GET['roleId']=='1'){
			foreach($_GET['headDepartmentId'] as $headDepartmentId){
				$this->postgreSQL->newHeadDepartment($date, $_GET['employeeId'], $headDepartmentId);
			}
		}
		$this->viewRole();
	}
		
	/** -->Редактирование роли. */
	function editRole(){
		$date = $this->getDate();
		if(($_GET['lastHeadDepartmentId']!=null)AND($_GET['roleId']!='1')){
			$this->postgreSQL->deleteHeadDepartment($date, $_GET['employeeId']);
		}
		
		if(($_GET['lastHeadDepartmentId']==null)AND($_GET['roleId']=='1')){
			foreach($_GET['headDepartmentId'] as $headDepartmentId){
				$this->postgreSQL->newHeadDepartment($date, $_GET['employeeId'], $headDepartmentId);
			}
		}
		
		if(($_GET['lastHeadDepartmentId']!=null)AND($_GET['roleId']=='1')){
			$this->postgreSQL->deleteHeadDepartment($date, $_GET['employeeId']);
			foreach($_GET['headDepartmentId'] as $headDepartmentId){
				$this->postgreSQL->newHeadDepartment($date, $_GET['employeeId'], $headDepartmentId);
			}
		}
		
		$this->postgreSQL->changeRole($_GET['employeeId'], $_GET['roleId']);
		$this->viewRole();
	}
		
	/** -->Удаление роли. */
	function removeRole() {
		$date = $this->getDate();
		$this->postgreSQL->deleteRole($_GET['employeeId']);
		if($_GET['lastHeadDepartmentId']!=null){
			$this->postgreSQL->deleteHeadDepartment($date, $_GET['employeeId']);
		}
		$this->viewRole();
	}
	
}
