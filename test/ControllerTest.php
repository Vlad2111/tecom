<?php
/*Для контроллера Index*/
{
	$_POST['login'] = 'ershov.v';
	$_POST['password'] = '123';
}
/*Для остальных контроллеров */
{
	$_GET['date'] = new DateTime('01.01.2016');	
}
/*Для контроллера List*/
{
	
	//$_GET['content'] = 'Department';
	//$_GET['content'] = 'Employee';
	//$_GET['content'] = 'Project';
	
	//$_GET['action'] = 'remove';
	{
		//$_GET['departmentId'] = '1';
		//$_GET['employeeId'] = '1';
		//$_GET['projectId'] = '2';
	}
	
}
/*Для контроллера Department*/
{
	
	//$_GET['departmentName'] = 'Отдел';
	//$_GET['departmentId'] = '0';
	
}
/*Для контроллера Employee*/
{
	
	//$_GET['employeeName'] = 'Ершов Владислав' ;
	//$_GET['employeeId'] = '2';
	//$_GET['action']='remove';
	{
	//	$_GET['employeeId'] = '0';
	//	$_GET['projectId'] = '0';
	}
	
}
/*Для контроллера Project*/
{
	
	//$_GET['projectName'] = 'Проект' ;
	//$_GET['projectId'] = '0';
	//$_GET['action']='remove';
	{
		//$_GET['employeeId'] = '0';
	}
	
}