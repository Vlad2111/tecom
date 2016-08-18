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
	
	/**Клонирование информации в новый месяц*/
	function cloneData($registry) {
		if (($registry['GET']['dateFrom']!=null)AND($registry['GET']['dateTo']!=null)){
			$dayMonthYear = explode('/', $registry['GET']['dateFrom']);
			$dateFrom = new DateTime('01.'.$dayMonthYear['0'].'.'.$dayMonthYear['2'],
					new DateTimeZone('UTC'));
			$dayMonthYear = explode('/', $registry['GET']['dateTo']);
			$dateTo = new DateTime('01.'.$dayMonthYear['0'].'.'.$dayMonthYear['2'],
					new DateTimeZone('UTC'));
			$this->postgreSQL->cloneModelData($dateFrom, $dateTo);
			$registry['date'] = $dateTo;
			$_GET['route']=$_GET['lastPage'];
			unset($this->registry['GET']);
			unset($this->registry['POST']);
			include 'index.php';
		}
	}
	
	/* Действия с отделами */
	/** -->Добавление отдела. */
	function newDepartment($registry){
		$this->getDate($registry);
		$this->postgreSQL->newDepartment($registry['date'], $registry['GET']['newName']);
		$_GET['route']=$_GET['lastPage'];
		unset($this->registry['GET']);
		unset($this->registry['POST']);
		include 'index.php';
	}
	
	/** -->Редактирование отдела. */
	function editDepartment($registry){
		$this->getDate($registry);
		$this->postgreSQL->changeDepartmentName($registry['GET']['editId'], $registry['date'],
				$registry['GET']['newName']);
		$registry['newNameDepForDep']=$registry['GET']['newName'];
		$_GET['route']=$_GET['lastPage'];
		unset($this->registry['GET']);
		unset($this->registry['POST']);
		include 'index.php';
	}
	
	/** -->Удаление отдела. */
	function removeDepartment($registry) {
		$this->getDate($registry);
		$this->postgreSQL->deleteDepartment($registry['date'], $registry['GET']['departmentId']);
		$_GET['route']=$_GET['lastPage'];
		unset($this->registry['GET']);
		unset($this->registry['POST']);
		include 'index.php';
	}
	
	/* Действия с сотрудниками */
	/** -->Добавление сотрудника. */
	function newEmployee($registry){
		$this->getDate($registry);
		$user=$this->checkLoginLdapForEmployee($registry);
		$this->postgreSQL->newEmployee($registry['date'], $user['Login'], $user['Name'],
				$registry['GET']['newDepartmwent']);
		$_GET['route']=$_GET['lastPage'];
		unset($this->registry['GET']);
		unset($this->registry['POST']);
		include 'index.php';
	}
	
	/** -->Редактирование информации сотрудника. */
	function editEmployee($registry){
		$this->getDate($registry);
		$user=$this->checkLoginLdapForEmployee($registry);
		$idNameDepartment = explode('*-*', $registry['GET']['newDepartmwent']);
		if($idNameDepartment['1']!=null){
			$departmentId=$idNameDepartment['0'];
			$departmentName=$idNameDepartment['1'];
		}else{
			$departmentId=$registry['GET']['newDepartmwent'];
		}
		$this->postgreSQL->changeEmployeeInfo($registry['GET']['editId'], $registry['date'],
				$user['Login'], $userName, $departmentId);
		$registry['newLoginEmpForEmp']=$user['Login'];
		$registry['newNameEmpForEmp']=$user['Name'];
		$registry['newIdDepForEmp']=$departmentId;
		$registry['newNameDepForEmp']=$departmentName;
		$_GET['route']=$_GET['lastPage'];
		unset($this->registry['GET']);
		unset($this->registry['POST']);
		include 'index.php';
	}
	
	/** -->Удаление информации сотрудника. */
	function removeEmployee($registry) {
		$this->getDate($registry);
		$this->postgreSQL->deleteEmployee($registry['date'], $registry['GET']['employeeId']);
		$_GET['route']=$_GET['lastPage'];
		unset($this->registry['GET']);
		unset($this->registry['POST']);
		include 'index.php';
	}
	
	/** Проверка логина сотрудника в LDAP при создании и редактировании. */
	private function checkLoginLdapForEmployee($registry) {
		$ldap = new LdapOperations();
		$ldap->connect();
		$rows = $ldap->getLDAPAccountNamesByPrefix($registry['GET']['newLogin']);
		if (count($rows)>1){
			$this->template->vars('rows', $rows);
			$this->template->view('selectLoginInLDAP', 'index');
		}else{
			$user['Name'] = $rows['0']['sn'].' '.$rows['0']['givenName'];
			$user['Login'] = $rows['0']['sAMAccountName'];
			return $user;
		}
	}
	
	/* Действия с проектами */
	/** -->Добавление проекта. */
	function newProject($registry){
		$this->getDate($registry);
		$this->postgreSQL->newProject($registry['date'], $registry['GET']['newName'],
				$registry['GET']['newDepartmwent']);
		$_GET['route']=$_GET['lastPage'];
		unset($this->registry['GET']);
		unset($this->registry['POST']);
		include 'index.php';
	}
	
	/** -->Редактирование проекта. */
	function editProject($registry){
		$this->getDate($registry);
		$idNameDepartment = explode('*-*', $registry['GET']['newDepartmwent']);
		if($idNameDepartment['1']!=null){
			$departmentId=$idNameDepartment['0'];
			$departmentName=$idNameDepartment['1'];
		}else{
			$departmentId=$registry['GET']['newDepartmwent'];
		}
		$this->postgreSQL->changeProjectNameAndDepartmentId($registry['GET']['editId'],
				$registry['date'], $registry['GET']['newName'], $departmentId);
		$registry['newIdDepForPro']=$departmentId;
		$registry['newNameDepForPro']=$departmentName;
		$_GET['route']=$_GET['lastPage'];
		unset($this->registry['GET']);
		unset($this->registry['POST']);
		include 'index.php';
	}
	
	/** -->Удаление проекта. */
	function removeProject($registry) {
		$this->getDate($registry);
		$this->postgreSQL->deleteProject($registry['date'], $registry['GET']['projectId']);
		$_GET['route']=$_GET['lastPage'];
		unset($this->registry['GET']);
		unset($this->registry['POST']);
		include 'index.php';
	}
	
	/* Действия с процентами */
	/** -->Добавление времени. */
	function newPercent($registry){
		$this->getDate($registry);
		$model->newTimeDistribution($registry['date'], $registry['GET']['projectId'],
				$registry['GET']['employeeId'], $registry['GET']['newTime']);
		$_GET['route']=$_GET['lastPage'];
		unset($this->registry['GET']);
		unset($this->registry['POST']);
		include 'index.php';
	}
	
	/** -->Редактирование времени. */
	function editPercent($registry){
		$this->getDate($registry);
		$model->changeEployeeTimeForProject($registry['GET']['employeeId'], $registry['GET']['projectId'],
				$registry['date'], $registry['GET']['newTime']);
		$_GET['route']=$_GET['lastPage'];
		unset($this->registry['GET']);
		unset($this->registry['POST']);
		include 'index.php';
	}
	
	/** -->Удаление времени. */
	function removePercent($registry) {
		$this->getDate($registry);
		$this->postgreSQL->deleteTimeDistribution($registry['date'], $registry['GET']['projectId'], $registry['GET']['employeeId']);
		$_GET['route']=$_GET['lastPage'];
		unset($this->registry['GET']);
		unset($this->registry['POST']);
		include 'index.php';
	}
}