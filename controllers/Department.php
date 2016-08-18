<?php
/*
* Copyright (c) 2016 Tecom LLC
* All rights reserved
*
* Исключительное право (c) 2016 пренадлежит ООО Теком
* Все права защищены
*/
/**
Класс контроллер, информация об отделе.

@author ershov.v
*/
Class Controller_Department Extends Controller_Base {

	public $log;
	public $postgreSQL;

	/** Отображение списка сотрудников и проектов отдела. */
	function index($registry) {
		if($registry['date']==null){
			$this->getDate($registry);
		}
		$rows = $this->postgreSQL->getDepartmentNames($registry['date']);
		$registry['selectDepartment'] = $rows;
		$rows1 = $this->postgreSQL->getEmployeeNamesForDepartment($registry['GET']['departmentId'],
				$registry['date']);
		$rows2 = $this->postgreSQL->getProjectNamesForDepartment($registry['GET']['departmentId'],
				$registry['date']);
		if(($rows1!=null)AND($rows2!=null)){
			if (count($rows1) < count($rows2)){
				for ($i=0; $i<count($rows2);$i++){
					if ($rows1[$i]==null){
						$rows1[$i]['employee_id']=null;
						$rows1[$i]['user_id']=null;
						$rows1[$i]['user_name']=null;
					}
					$rows[$i] = array_merge($rows1[$i], $rows2[$i]);
				}
			}else{
				for ($i=0; $i<count($rows1);$i++){
					if ($rows2[$i]==null){
						$rows2[$i]['project_id']=null;
						$rows2[$i]['project_name']=null;
					}
					$rows[$i] = array_merge($rows1[$i], $rows2[$i]);
				}
			}
		}else{
			if($rows1!=null){
				$rows=$rows1;
			}
			if($rows2!=null){
				$rows=$rows2;
			}
		}
		$this->template->vars('rows', $rows);
		$this->template->view('Department', 'DepartmentLayout');
	}
	
	/** Получение даты. */
	private function getDate($registry) {
		if (($registry['GET']['Month']!=null)AND($registry['GET']['Year']!=null)){
			$registry['date'] = new DateTime('01.'.$registry['GET']['Month'].'.'.$registry['GET']['Year'], new DateTimeZone('UTC'));
		}else{
			if ($registry['GET']['date']!=null){
				$dayMonthYear = explode('/', $registry['GET']['date']);
				$registry['date'] = new DateTime('01.'.$dayMonthYear['0'].'.'.$dayMonthYear['2'], new DateTimeZone('UTC'));
			}else{
				$registry['date'] = new DateTime();
			}
		}
	}
	
	/** Редактирование отдела. */
	function editDepartment($registry){
		$this->getDate($registry);
		$this->postgreSQL->changeDepartmentName($registry['GET']['editId'], $registry['date'],
				$registry['GET']['newName']);
		$registry['newNameDepForDep']=$registry['GET']['newName'];
		$this->index($registry);
	}
	/* Действия с сотрудниками */
	/** Добавление сотрудника. */
	function newEmployee($registry){
		$this->getDate($registry);
		$user=$this->checkLoginLdapForEmployee($registry);
		$this->postgreSQL->newEmployee($registry['date'], $user['Login'], $user['Name'],
				$registry['GET']['newDepartmwent']);
		$this->index($registry);
	}
	
	/** Редактирование информации сотрудника. */
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
		$this->index($registry);
	}
	
	/** Удаление информации сотрудника. */
	function removeEmployee($registry) {
		$this->getDate($registry);
		$this->postgreSQL->deleteEmployee($registry['date'], $registry['GET']['employeeId']);
		$this->index($registry);
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
	/** Добавление проекта. */
	function newProject($registry){
		$this->getDate($registry);
		$this->postgreSQL->newProject($registry['date'], $registry['GET']['newName'],
				$registry['GET']['newDepartmwent']);
		$this->index($registry);
	}
	
	/** Редактирование проекта. */
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
		$this->index($registry);
	}
	
	/** Удаление проекта. */
	function removeProject($registry) {
		$this->getDate($registry);
		$this->postgreSQL->deleteProject($registry['date'], $registry['GET']['projectId']);
		$this->index($registry);
	}
}