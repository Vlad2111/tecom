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
		$date = new DateTime("01-01-2016");
		if($date){
			$model = new Model_PostgreSQLOperations();
			$model->connect();
		}else{
			$rows = false;
		}
		$this->template->vars('rows', $rows);
		$this->template->view('EditAndCreate');
	
	}
	
}