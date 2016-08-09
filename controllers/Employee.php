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
		$registry['date'] = new DateTime('01.'.$registry['GET']['Month'].'.'.$registry['GET']['Year']);
		if($registry['date']){
			$model = new Model_PostgreSQLOperations();
			$model->connect();
			if($registry['GET']['action']=='remove'){
				$model->deleteTimeDistribution($registry['date'], $registry['GET']['projectId'], $registry['GET']['employeeId']);
			}
			$rows = $model->getEmployeeInfo($registry['GET']['employeeId'], $registry['date']);
			$employeePercentSum = 0;
			for ($i=0; $i<count($rows); $i++){
				$employeePercentSum = $employeePercentSum + $rows[$i]['time'];
			}
			$registry['employeePercent'] = $employeePercentSum;
			$this->template->vars('rows', $rows);
			$this->template->view('Employee');
		}else{
			$this->log->error("Не выбрана дата.");
			throw new Exception("Не выбрана дата.");
		}
	}
}