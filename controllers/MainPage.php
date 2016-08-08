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
Class Controller_MainPage Extends Controller_Base {

	public $layouts = "index";
	
	function index($registry) {
		//if($registry['POST']){
			$registry['login'] = 'ershov.v';
			$registry['password']= '123';			
			if (($registry['login']!=null)AND($registry['password']!=null)){
				$ldap = new LdapOperations();
				$ldap->connect();
				$names = $ldap->getLDAPAccountNamesByPrefix($registry['login']);
				$registry['userName'] = $names['0']['sn'].' '.$names['0']['givenName'];
				$model = new Model_PostgreSQLOperations();
				$model->connect();
				$role = $model->getRoleName($registry['login']);
				$registry['roleName']=$role;
				unset($registry['date']);
				$this->template->view('mainPage');
			}else{
				if($_GET){
					if($registry['action']=='return'){	
						unset($registry['date']);
						$this->template->view('mainPage');
					}
				}
			}
		//}else{
		//	$this->template->view('authorization');
		//}
	}
}