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

	public $layouts = "index";
	private $log;
	
	function __construct() {
		$this->log = Logger::getLogger(__CLASS__);
	}
	
	function index($registry) {
		$registry['projectName']=$_GET['projectName'];
		$registry['projectId']=$_GET['projectId'];
		if($registry['date']){
			$model = new Model_PostgreSQLOperations();
			$model->connect();
			if($_GET['action']=='remove'){
				$model->deleteTimeDistribution($registry['date'], $_GET['projectId'], $_GET['employeeId']);
			}
			$rows = $model->getEployeeNamesAndPercentsForProject($registry['projectId'], $registry['date']);
		$this->template->vars('rows', $rows);
		$this->template->view('Project');
		}else{
			$this->log->error("Не выбрана дата.");
			throw new Exception("Не выбрана дата.");
		}
	}
}