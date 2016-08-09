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

	protected $registry;
	protected $template;
	protected $layouts;
	protected $log;
	
	public $vars = array();

	function __construct($registry) {
        $this->registry = $registry;
		$this->template = new Template($this->layouts, get_class($this), $registry);
		$this->log = Logger::getLogger(__CLASS__);
	}

	abstract function index($registry);
	
}