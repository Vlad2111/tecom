<?php
/*
* Copyright (c) 2016 Tecom LLC
* All rights reserved
*
* Исключительное право (c) 2016 пренадлежит ООО Теком
* Все права защищены
*/
/**
Класс контроллер, информация о сотруднике.

@author ershov.v
*/
Class Controller_Employee Extends Controller_Base {

	public $layouts = "index";
	public $log;

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
			if($registry['date']!=null){
				$model = new Model_PostgreSQLOperations();
				$model->connect();
				if($registry['GET']['action']=='remove'){
					$model->deleteTimeDistribution($registry['date'], $registry['GET']['projectId'], $registry['GET']['employeeId']);
				}
				$rows = $model->getDepartmentNames($registry['date']);
				$registry['selectDepartment'] = $rows;
				$rows = $model->getProjectNames($registry['date']);
				$registry['selectProject'] = $rows;
				$rows = $model->getEmployeeInfo($registry['GET']['employeeId'], $registry['date']);
				$employeePercentSum = 0;
				for ($i=0; $i<count($rows); $i++){
					$employeePercentSum = $employeePercentSum + $rows[$i]['time'];
				}
				$registry['employeePercent'] = $employeePercentSum;
				$this->template->vars('rows', $rows);
				$this->template->view('Employee');
			}
		}
	}
}