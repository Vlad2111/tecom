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
Class Controller_Project Extends Controller_Base {

	public  $log;
	
	function index($registry) {
		if(($_GET['roleUser']!=null)AND($_GET['nameUser']!=null)){
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
			if($registry['date']){
				$model = new PostgreSQLOperations();
				$model->connect();
				$ldap = new LdapOperations();
				$ldap->connect();
				if($registry['GET']['action']=='remove'){
					$model->deleteTimeDistribution($registry['date'], $registry['GET']['projectId'], $registry['GET']['employeeId']);
				}
				$rows = $model->getDepartmentNames($registry['date']);
				$registry['selectDepartment'] = $rows;
				$rows = $model->getEmployeeNamesForDepartment($registry['GET']['departmentId'], $registry['date']);
				$registry['selectEmployee'] = $rows;
				$rows = $model->getEmployeeNamesNotForDepartment($registry['GET']['departmentId'], $registry['date']);
				$registry['selectEmployeeNot'] = $rows;
				$rows = $model->getEployeeNamesAndPercentsForProject($registry['GET']['projectId'], $registry['date']);
				$this->template->vars('rows', $rows);
				$this->template->view('Project', 'ProjectLayout');
			}
		}
	}
}