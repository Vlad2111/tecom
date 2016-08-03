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

	function index() {
		$registry['employeeName']=$_GET['employeeName'];
		$registry['employeeId']=$_GET['employeeId'];
		if($registry['date']){
			$model = new Model_PostgreSQLOperations();
			$model->connect();
			if($_GET['action']=='remove'){
				$model->deleteTimeDistribution($registry['date'], $_GET['projectId'], $_GET['employeeId']);
			}
			$rows = $model->getEmployeeInfo($registry['employeeId'], $registry['date']);
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