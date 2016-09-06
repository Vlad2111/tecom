<?php
/*
* Copyright (c) 2016 Tecom LLC
* All rights reserved
*
* Исключительное право (c) 2016 пренадлежит ООО Теком
* Все права защищены
*/
/**
Класс контроллер, Авторизация.

@author ershov.v
*/
Class Controller_Index Extends Controller_Base {
	
	function index() {
		if ($_GET['action'] == "Exit")
		{
			session_start();
			session_unset();
			session_destroy();
		}
		require '3pty/Smarty/libs/Smarty.class.php';
		$smarty = new Smarty;
		$smarty->force_compile = true;
		$smarty->debugging = false;
		$smarty->caching = false;
		$smarty->cache_lifetime = 120;
		$smarty->display('3pty/Smarty/demo/templates/authorization.tpl');
	}
}