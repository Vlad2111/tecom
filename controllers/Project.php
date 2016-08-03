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
	
	function index() {
		$registry['projectName']=$_GET['projectName'];
		if($registry['date']){
			$model = new Model_PostgreSQLOperations();
			$model->connect();
			$rows = $model->getEployeeNamesAndPercentsForProject($_GET['projectId'], $registry['date']);
		}
		$this->template->vars('rows', $rows);
		$this->template->view('Project');
	
	}
	
	}