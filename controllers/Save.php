<?php
/*
* Copyright (c) 2016 Tecom LLC
* All rights reserved
*
* Исключительное право (c) 2016 пренадлежит ООО Теком
* Все права защищены
*/
/**
Класс контроллер, сохранение.

@author ershov.v
*/
Class Controller_save Extends Controller_Base {
	
	public $layouts = "index";
	public  $log;
	
	function index($registry) {
		if(($registry['GET']['nameUser']!=null)AND($registry['GET']['roleUser']!=null)){
			$registry['roleName']=$registry['GET']['roleUser'];
			$registry['userName']=$registry['GET']['nameUser'];
			if (($registry['GET']['Month']!=null)AND($registry['GET']['Year']!=null)){
				$registry['date'] = new DateTime('01.'.$registry['GET']['Month'].'.'.$registry['GET']['Year'], new DateTimeZone('UTC'));
			}
			if ($registry['date']){
				$model = new Model_PostgreSQLOperations();
				$model->connect();
				$ldap = new LdapOperations();
				$ldap->connect();
				switch($registry['GET']['content']){
					case 'Department':
						if($registry['GET']['action']=='New'){
							$model->newDepartment($registry['date'], $registry['GET']['newName']);
						}
						if($registry['GET']['action']=='Edit'){
							$model->changeDepartmentName($registry['GET']['editId'], $registry['date'], $registry['GET']['newName']);
							$registry['newNameDepForDep']=$registry['GET']['newName'];
						}
						break;
					case 'Employee':
						$rows = $ldap->getLDAPAccountNamesByPrefix($registry['GET']['newLogin']);
						if (count($rows)>1){
							$this->template->vars('rows', $rows);
							$this->template->view('selectLoginInLDAP');
						}else{
							if($registry['GET']['action']=='New'){
								$model->newEmployee($registry['date'], $registry['GET']['newLogin'], $registry['GET']['newDepartmwent']);
							}
							if($registry['GET']['action']=='Edit'){
								$model->changeEmployeeInfo($registry['GET']['editId'], $registry['date'], $registry['GET']['newLogin'],
									$registry['GET']['newDepartmwent']);
								$registry['newLoginEmpForEmp']=$registry['GET']['newLogin'];
								$names = $ldap->getLDAPAccountNamesByPrefix($registry['newLoginEmpForEmp']);
								$registry['newNameEmpForEmp'] = $names['0']['sn'].' '.$names['0']['givenName'];
							}
							$rowsEmployee = $model->getEmployeeNames($registry['date']);
							if($rowsEmployee!=null){
								foreach ($rowsEmployee as $key=>$arr){
									$rows = $ldap->getLDAPAccountNamesByPrefix($arr['user_id']);
									if (count($rows)>1){
										$registry['departmwent']=$arr['department_id'];
										$registry['editId']=$arr['employee_id'];
										$registry['actionEmployeeFalse']=true;
										$this->template->vars('rows', $rows);
										$this->template->view('selectLoginInLDAP');
										break;
									}
								}
							}
						}
						break;
					case 'Project':
						if($registry['GET']['action']=='New'){
							$model->newProject($registry['date'], $registry['GET']['newName'], $registry['GET']['newDepartmwent']);
						}
						if($registry['GET']['action']=='Edit'){
							$model->changeProjectNameAndDepartmentId($registry['GET']['editId'], $registry['date'], 
								$registry['GET']['newName'], $registry['GET']['newDepartmwent']);
						}
						break;
					case 'Percent':
						if($registry['GET']['action']=='New'){
							$model->newTimeDistribution($registry['date'], $registry['GET']['projectId'], 
								$registry['GET']['employeeId'], $registry['GET']['newTime']);
						}
						if($registry['GET']['action']=='Edit'){
							$model->changeEployeeTimeForProject($registry['GET']['employeeId'], $registry['GET']['projectId'],
									$registry['date'], $registry['GET']['newTime']);
						}
						break;
					default:
						$header = 'Unknown page';
						break;
				}
				if($registry['GET']['lastPage']=='Department'){
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
								}else{
									$names = $ldap->getLDAPAccountNamesByPrefix($rows1[$i]['user_id']);
									$rows1[$i]['user_name'] = $names['0']['sn'].' '.$names['0']['givenName'];
								}
								$rows[$i] = array_merge($rows1[$i], $rows2[$i]);
							}
							$this->template->vars('rows', $rows);
						}else{
							for ($i=0; $i<count($rows1);$i++){
								if ($rows2[$i]==null){
									$rows2[$i]['project_id']=null;
									$rows2[$i]['project_name']=null;
								}
								$rows[$i] = array_merge($rows1[$i], $rows2[$i]);
								$names = $ldap->getLDAPAccountNamesByPrefix($rows[$i]['user_id']);
								$rows[$i]['user_name'] = $names['0']['sn'].' '.$names['0']['givenName'];
							}
							$this->template->vars('rows', $rows);
						}
					}else{
						if($rows1!=null){
							$rows=$rows1;
							for ($i=0; $i<count($rows);$i++){
								$names = $ldap->getLDAPAccountNamesByPrefix($rows[$i]['user_id']);
								$rows[$i]['user_name'] = $names['0']['sn'].' '.$names['0']['givenName'];
								$this->template->vars('rows', $rows);
							}
						}else{
							if($rows2!=null){
								$rows=$rows1;
								$this->template->vars('rows', $rows);
							}
						}
					}
					$this->template->view('Department');
				}
				if($registry['GET']['lastPage']=='Employee'){
					$rows = $model->getDepartmentNames($registry['date']);
					$registry['selectDepartment'] = $rows;
					$rows = $model->getProjectNames($registry['date']);
					$registry['selectProject'] = $rows;
					$rows = $model->getEmployeeInfo($registry['GET']['employeeId'], $registry['date']);
					$employeePercentSum = 0;
					for ($i=0; $i<count($rows); $i++){
						$employeePercentSum = $employeePercentSum + $rows[$i]['time'];
					}
					$registry['employeePercent'] = $employeePercentSum;
					$this->template->vars('rows', $rows);
					$this->template->view('Employee');
				}
				if($registry['GET']['lastPage']=='Project'){
					$rows = $model->getEmployeeNames($registry['date']);
					if($rows!=null){
						for ($i=0; $i<count($rows);$i++){
							$names = $ldap->getLDAPAccountNamesByPrefix($rows[$i]['user_id']);
							$rows[$i]['user_name'] = $names['0']['sn'].' '.$names['0']['givenName'];
						}
					}
					$registry['selectEmployee'] = $rows;
					$rows = $model->getDepartmentNames($registry['date']);
					$registry['selectDepartment'] = $rows;
					$rows = $model->getEployeeNamesAndPercentsForProject($registry['GET']['projectId'], $registry['date']);
					if($rows!=null){
						foreach ($rows as $key=>$arr){
							$names = $ldap->getLDAPAccountNamesByPrefix($arr['user_id']);
							$rows[$key]['user_name'] = $names['0']['sn'].' '.$names['0']['givenName'];
						}
					}
					$this->template->vars('rows', $rows);
					$this->template->view('Project');
				}
				if($registry['GET']['lastPage']=='list'){
					switch($registry['GET']['content']){
						case 'Department':
							$rows = $model->getDepartmentNames($registry['date']);
							$this->template->vars('rows', $rows);
							$this->template->view('listDepartments');
							break;
						case 'Employee':
							$rows = $model->getDepartmentNames($registry['date']);
							$registry['selectDepartment'] = $rows;
							$rows = $model->getEmployeeNames($registry['date']);
							if($rows!=null){
								foreach ($rows as $key=>$arr){
									$names = $ldap->getLDAPAccountNamesByPrefix($arr['user_id']);
									$rows[$key]['user_name'] = $names['0']['sn'].' '.$names['0']['givenName'];
								}
							}
							$this->template->vars('rows', $rows);
							$this->template->view('listEmployees');
							break;
						case 'Project':
							$rows = $model->getDepartmentNames($registry['date']);
							$registry['selectDepartment'] = $rows;
							$rows = $model->getProjectNames($registry['date']);
							$this->template->vars('rows', $rows);
							$this->template->view('listProjects');
							break;
						default:
							$header = 'Unknown page';
							break;
					}
				}
			}
		}		
	}
	
}