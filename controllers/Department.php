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
		if(($registry['GET']['nameUser']!=null)AND($registry['GET']['roleUser']!=null)){
			$registry['roleName']=$registry['GET']['roleUser'];
			$registry['userName']=$registry['GET']['nameUser'];
		}
		if(($registry['roleName']!=null)AND($registry['userName']!=null)){
			if (($registry['GET']['Month']!=null)AND($registry['GET']['Year']!=null)){
				$registry['date'] = new DateTime('01.'.$registry['GET']['Month'].'.'.$registry['GET']['Year'], new DateTimeZone('UTC'));
			}else{
				if ($registry['GET']['date']!=null){
					$dayMonthYear = explode('/', $registry['GET']['date']);
					$registry['date'] = new DateTime('01.'.$dayMonthYear['0'].'.'.$dayMonthYear['2'], new DateTimeZone('UTC'));
				}else{
					$registry['date'] = new DateTime();
				}
			}
			if($registry['date']){
				$model = new Model_PostgreSQLOperations();
				$model->connect();
				if($registry['GET']['action']=='removeEmpl'){
					$model->deleteEmployee($registry['date'], $registry['GET']['employeeId']);
				}
				if($registry['GET']['action']=='removeProj'){
					$model->deleteProject($registry['date'], $registry['GET']['projectId']);
				}
				$rows = $model->getDepartmentNames($registry['date']);
				$registry['selectDepartment'] = $rows;
				$rows1 = $model->getEmployeeNamesForDepartment($registry['GET']['departmentId'], $registry['date']);
				$rows2 = $model->getProjectNamesForDepartment($registry['GET']['departmentId'], $registry['date']);
				if(($rows1!=null)AND($rows2!=null)){
					if (count($rows1) < count($rows2)){
						for ($i=0; $i<count($rows2);$i++){
							if ($rows1[$i]==null){
								$rows1[$i]['employee_id']=null;
								$rows1[$i]['user_id']=null;
								$rows1[$i]['user_name']=null;
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
						}
					}
				}else{
					if($rows1!=null){
						$rows=$rows1;
					}
					if($rows2!=null){
						$rows=$rows1;
					}
				}
				$this->template->vars('rows', $rows);
				$this->template->view('Department');
			}
		}
	}
}