<?php
/*
* Copyright (c) 2016 Tecom LLC
* All rights reserved
*
* Исключительное право (c) 2016 пренадлежит ООО Теком
* Все права защищены
*/
/**
Класс Контроллеров

@author ershov.v
*/
Abstract Class Controller_Base {

	protected $postgreSQL;
	protected $template;
	protected $log;
	protected $errors;
	protected $errorsNum;
	
	public $vars = array();

	function __construct() {
		$this->postgreSQL = new PostgreSQLOperations();
		$this->postgreSQL->connect();
		$this->template = new Template(get_class($this));
		$this->log = Logger::getLogger(__CLASS__);
	}
}
