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

	public $layouts = "index";
	public  $log;
	
	function index($registry) {
		if(($registry['GET']['nameUser']!=null)AND($registry['GET']['roleUser']!=null)){
			$registry['roleName']=$registry['GET']['roleUser'];
			$registry['userName']=$registry['GET']['nameUser'];
		}
		if(($registry['roleName']!=null)AND($registry['userName']!=null)){
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
				$model = new Model_PostgreSQLOperations();
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
				$this->template->view('Project');
			}
		}
	}
}