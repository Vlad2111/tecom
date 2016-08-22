<?php
/*
* Copyright (c) 2016 Tecom LLC
* All rights reserved
*
* Исключительное право (c) 2016 пренадлежит ООО Теком
* Все права защищены
*/
/**
Класс контроллер, список пользователей и ролей.

@author ershov.v
*/
Class Controller_FalseList Extends Controller_Base {

	public $log;
	public $postgreSQL;
	
	/** Отображение списка пользоваьелей и ролей. */
	function viewFalseList() {
		if ($_GET['falseList']!=null){
			$date = $this->getDate();
			$this->template->vars('falseList', $_GET['falseList']);
			$this->template->view('FalseList', 'FalseListLayout');
		}else{
			$_GET['route']='list/viewListDepartment';
			include 'index.php';
		}
	}
	
	/** Получение даты. */
	private function getDate() {
		if (($_GET['Month']!=null)AND($_GET['Year']!=null)){
			$date = new DateTime('01.'.$_GET['Month'].'.'.$_GET['Year'], new DateTimeZone('UTC'));
		}else{
			if ($_GET['date']!=null){
				$dayMonthYear = explode('/', $_GET['date']);
				$date = new DateTime('01.'.$dayMonthYear['0'].'.'.$dayMonthYear['2'], new DateTimeZone('UTC'));
			}else{
				$date = new DateTime();
			}
		}
		return $date;
	}
}