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
	public  $log;

	function index($registry) {
		//$registry['date'] = new DateTime('01.'.$registry['GET']['Month'].'.'.$registry['GET']['Year']);
		if($registry['date']){
			$model = new Model_PostgreSQLOperations();
			$model->connect();
			$rows1 = $model->getEmployeeNamesForDepartment($registry['GET']['departmentId'], $registry['date']);
			$rows2 = $model->getProjectNamesForDepartment($registry['GET']['departmentId'], $registry['date']);
			print_r($rows1);
			print_r($rows2);
			$ldap = new LdapOperations();
			$ldap->connect();
			if (count($rows1) < count($rows2)){
				for ($i=0; $i<count($rows2);$i++){
					if ($rows1[$i]==null){
						$rows1[$i]['employee_id']=null;
						$rows1[$i]['user_id']=null;
					}else{
						$names = $ldap->getLDAPAccountNamesByPrefix($rows1[$i]['user_id']);
						$rows1[$i]['user_id'] = $names['0']['sn'].' '.$names['0']['givenName'];
					}
					$rows[$i] = array_merge($rows1[$i], $rows2[$i]);
				}
			}else{
				for ($i=0; $i<count($rows1);$i++){			
					if ($rows2[$i]==null){
						$rows2[$i]['project_id']=null;
						$rows2[$i]['project_name']=null;
					}
					$rows[$i] = array_merge($rows1[$i], $rows2[$i]);
					$names = $ldap->getLDAPAccountNamesByPrefix($rows[$i]['user_id']);
					$rows[$i]['user_id'] = $names['0']['sn'].' '.$names['0']['givenName'];
				}
				
			}
			$this->template->vars('rows', $rows);
			$this->template->view('Department');
		}else{
			$this->log->error("Не выбрана дата.");
			$this->template->view('Department');
		}
	}
}