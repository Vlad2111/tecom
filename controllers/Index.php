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
		$_POST['login'] = 'ershov.v';
		if ($_POST['login']){
			$ldap = new LdapOperations();
			$ldap->connect();
			$names = $ldap->getLDAPAccountNamesByPrefix($_POST['login']);
			$registry['userName'] = $names['0']['sn'].' '.$names['0']['givenName'];
			$model = new Model_PostgreSQLOperations();
			$model->connect();
			$role = $model->getRoleName($_POST['login']);
			$registry['roleName']=$role;
			unset($registry['date']);
			$this->template->view('mainPage');
		}else{
			if($_GET['action']=='return'){	
				unset($registry['date']);
				$this->template->view('mainPage');
			}else{
				$this->template->view('authorization');
			}
		}
	}
}
	