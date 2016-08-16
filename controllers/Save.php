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
						$ldap = new LdapOperations();
						$ldap->connect();
						$rows = $ldap->getLDAPAccountNamesByPrefix($registry['GET']['newLogin']);
						if (count($rows)>1){
							$this->template->vars('rows', $rows);
							$this->template->view('selectLoginInLDAP');
						}else{
							if($registry['GET']['action']=='New'){
								$userName = $rows['0']['sn'].' '.$rows['0']['givenName'];
								$userLogin = $rows['0']['sAMAccountName'];
								$model->newEmployee($registry['date'], $userLogin, $userName, $registry['GET']['newDepartmwent']);
							}
							if($registry['GET']['action']=='Edit'){
								$userName = $rows['0']['sn'].' '.$rows['0']['givenName'];
								$userLogin = $rows['0']['sAMAccountName'];
								$idNameDepartment = explode('*-*', $registry['GET']['newDepartmwent']);
								if($idNameDepartment['1']!=null){
									$departmentId=$idNameDepartment['0'];
									$departmentName=$idNameDepartment['1'];
								}else{
									$departmentId=$registry['GET']['newDepartmwent'];
								}
								$model->changeEmployeeInfo($registry['GET']['editId'], $registry['date'], $userLogin, 
										$userName, $departmentId);
								$registry['newLoginEmpForEmp']=$userLogin;
								$registry['newNameEmpForEmp']=$userName;
								$registry['newIdDepForEmp']=$departmentId;
								$registry['newNameDepForEmp']=$departmentName;
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
							$idNameDepartment = explode('*-*', $registry['GET']['newDepartmwent']);
							if($idNameDepartment['1']!=null){
								$departmentId=$idNameDepartment['0'];
								$departmentName=$idNameDepartment['1'];
							}else{
								$departmentId=$registry['GET']['newDepartmwent'];
							}
							$model->changeProjectNameAndDepartmentId($registry['GET']['editId'], $registry['date'], 
								$registry['GET']['newName'], $departmentId);
							$registry['newIdDepForPro']=$departmentId;
							$registry['newNameDepForPro']=$departmentName;
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
				if($registry['GET']['lastPage']=='Employee'){
					$rows = $model->getDepartmentNames($registry['date']);
					$registry['selectDepartment'] = $rows;
					if($registry['newIdDepForEmp']!=null){
						$rows = $model->getProjectNamesForDepartment($registry['newIdDepForEmp'], $registry['date']);
						$registry['selectProject'] = $rows;
						$rows = $model->getProjectNamesNotForDepartment($registry['newIdDepForEmp'], $registry['date']);
						$registry['selectProjectNot'] = $rows;
						$rows = $model->getEmployeeInfo($registry['newIdDepForEmp'], $registry['date']);
					}else{
						$rows = $model->getProjectNamesForDepartment($registry['GET']['departmentId'], $registry['date']);
						$registry['selectProject'] = $rows;
						$rows = $model->getProjectNamesNotForDepartment($registry['GET']['departmentId'], $registry['date']);
						$registry['selectProjectNot'] = $rows;
						$rows = $model->getEmployeeInfo($registry['GET']['employeeId'], $registry['date']);
					}
					$employeePercentSum = 0;
					for ($i=0; $i<count($rows); $i++){
						$employeePercentSum = $employeePercentSum + $rows[$i]['time'];
					}
					$registry['employeePercent'] = $employeePercentSum;
					$this->template->vars('rows', $rows);
					$this->template->view('Employee');
				}
				if($registry['GET']['lastPage']=='Project'){
					$rows = $model->getDepartmentNames($registry['date']);
					$registry['selectDepartment'] = $rows;
					if($registry['newIdDepForPro']!=null){
						$rows = $model->getEmployeeNamesForDepartment($registry['newIdDepForPro'], $registry['date']);
						$registry['selectEmployee'] = $rows;
						$rows = $model->getEmployeeNamesNotForDepartment($registry['newIdDepForPro'], $registry['date']);
						$registry['selectEmployeeNot'] = $rows;
						$rows = $model->getEployeeNamesAndPercentsForProject($registry['newIdDepForPro'], $registry['date']);
					}else{
						$rows = $model->getEmployeeNamesForDepartment($registry['GET']['departmentId'], $registry['date']);
						$registry['selectEmployee'] = $rows;
						$rows = $model->getEmployeeNamesNotForDepartment($registry['GET']['departmentId'], $registry['date']);
						$registry['selectEmployeeNot'] = $rows;
						$rows = $model->getEployeeNamesAndPercentsForProject($registry['GET']['projectId'], $registry['date']);
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