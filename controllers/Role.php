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
	function viewRole() {
		$date = $this->getDate();
		$this->template->vars('date', $date);
		
		$arrayEmployeeNames = $this->postgreSQL->getEmployeeNames($date);
		$this->template->vars('arrayEmployeeNames', $arrayEmployeeNames);
		
		$arrayRoleDef = $this->postgreSQL->getRoleDef();
		$this->template->vars('arrayRoleDef', $arrayRoleDef);
		
		$arrayEmployeeRoleNamesAndId = $this->postgreSQL->getEmployeeRoleNamesAndId($date);
		$this->template->vars('arrayEmployeeRoleNamesAndId', $arrayEmployeeRoleNamesAndId);
		
		$this->template->view('Role', 'RoleLayout');
	}
	
	/** Получение даты. */
	private function getDate() {
		if (($_GET['Month']!=null)AND($_GET['Year']!=null)){
			$date = new DateTime('01.'.$_GET['Month'].'.'.$_GET['Year'], new DateTimeZone('UTC'));
		}else{
			if ($_GET['date']!=null){
				$dayMonthYear = explode('/', $_GET['date']);
				$date = new DateTime('01.'.$dayMonthYear['0'].'.'.$dayMonthYear['2'], new DateTimeZone('UTC'));
			}else{
				$date = new DateTime();
			}
		}
		return $date;
	}
	
	/* Действия с ролями */
	/** ->Добавление роли. */
	function newRole(){
		$date = $this->getDate();
		$this->postgreSQL->newRole($_GET['employeeId'], $_GET['roleId']);
		$this->viewRole();
	}
		
	/** -->Редактирование роли. */
	function editRole(){
		$date = $this->getDate();
		$this->postgreSQL->changeRole($_GET['employeeId'], $_GET['roleId']);
		$this->viewRole();
	}
		
	/** -->Удаление роли. */
	function removeRole() {
		$date = $this->getDate();
		$this->postgreSQL->deleteRole($_GET['employeeId']);
		$this->viewRole();
	}
	
}