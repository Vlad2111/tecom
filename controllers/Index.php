<?php
/*
* Copyright (c) 2016 Tecom LLC
* All rights reserved
*
* Исключительное право (c) 2016 пренадлежит ООО Теком
* Все права защищены
*/
/**
Класс контроллер, главная станица.

@author ershov.v
*/
Class Controller_Index Extends Controller_Base {

	public $layouts = "index";
	
	function index($registry) {
		$this->template->view('authorization');
	}
}