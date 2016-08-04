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
Class Controller_EditAndCreate Extends Controller_Base {

	public $layouts = "index";
	
	function index() {
		$registry['content'] = $_GET['content'];
		if($registry['date']){
			$model = new Model_PostgreSQLOperations();
			$model->connect();
			if($registry['content']=='createEmployee'){
				$rows = $model->getDepartmentNames($registry['date']);
				$this->template->vars('rows', $rows);
			}
			if($registry['content']=='createProject'){
				$rows = $model->getDepartmentNames($registry['date']);
				$this->template->vars('rows', $rows);
			}
			if($registry['content']=='editDepartment'){
				$registry['departmentName']=$_GET['departmentName'];
				$registry['departmentId']=$_GET['departmentId'];
			}
			if($registry['content']=='editEmployee'){
				$registry['employeeName']=$_GET['employeeName'];
				$registry['employeeId']=$_GET['employeeId'];
			}
			if($registry['content']=='editProject'){
				$registry['projectName']=$_GET['projectName'];
				$registry['projectId']=$_GET['projectId'];
			}
			if($registry['content']=='createPercent'){
				if (($_GET['projectId'])AND($_GET['projectName'])){
					$registry['projectName']=$_GET['projectName'];
					$registry['projectId']=$_GET['projectId'];
				}
				if (($_GET['employeeId'])AND($_GET['employeeName'])){
					$registry['employeeName']=$_GET['employeeName'];
					$registry['employeeId']=$_GET['employeeId'];
				}
			}
			$this->template->view('EditAndCreate');
		}else{
			$rows = false;
		}
		
	
	}
	
}