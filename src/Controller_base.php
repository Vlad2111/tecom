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
	protected $registry;
	protected $template;
	protected $log;
	
	public $vars = array();

	function __construct($registry) {
		$this->postgreSQL = new PostgreSQLOperations();
		$this->postgreSQL->connect();
        $this->registry = $registry;
		$this->template = new Template(get_class($this), $registry);
		$this->log = Logger::getLogger(__CLASS__);
	}
}