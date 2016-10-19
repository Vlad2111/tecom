<?php
if(isset($_COOKIE[session_name()])) {session_start();}
/*
* Copyright (c) 2016 Tecom LLC
* All rights reserved
*
* Исключительное право (c) 2016 пренадлежит ООО Теком
* Все права защищены
*/
/**
Класс контроллер, итоговое колличество сотрудников.

@author ershov.v
*/
Class Controller_Total Extends Controller_Base {

	public $log;
	public $postgreSQL;
	
	/** Отображение колличествa сотрудников. */
	function viewTotal() {
		$this->checkSession();
		
		$date = $this->getDate();
		$this->template->vars('date', $date);

		$range = $this->getDateRange();
		$this->template->vars('range', $range);
		
		$arrayTotal = $this->postgreSQL->getTotalEmployees($range[1], $range[2]);
		$this->template->vars('arrayTotal', $arrayTotal);

		$status = $this->checkDataEditingForDate($date);
		$this->template->vars('statusEditingData', $status);
	
		$this->template->view('total', 'TotalLayout');
	}

	/** Получение даты. */
	private function getDate() {
		if (($_GET['Month']!=null)AND($_GET['Year']!=null)){
			$date = new DateTime('01.'.$_GET['Month'].'.'.$_GET['Year'], new DateTimeZone('UTC'));
		}else{
			if ($_GET['date']!=null){
				$dayMonthYear = explode('/', $_GET['date']);
				$date = new DateTime('01.'.$dayMonthYear['0'].'.'.$dayMonthYear['1'], new DateTimeZone('UTC'));
			}else{
				$date = new DateTime();
				$date->setTimezone(new DateTimeZone('UTC'));
			}
		}
		return $date;
	}

	/** Изменение даты. */
	private function getDateRange() {
		if ($_GET['date1']!=null){
			$dayMonthYear = explode('/', $_GET['date1']);
			$date1 = new DateTime('01.'.$dayMonthYear['0'].'.'.$dayMonthYear['1'], new DateTimeZone('UTC'));
		}else{
			$date1 = new DateTime('01.01.'.$_GET['Year'], new DateTimeZone('UTC'));
		}
		if ($_GET['date2']!=null){
			$dayMonthYear = explode('/', $_GET['date2']);
			$date2 = new DateTime('01.'.$dayMonthYear['0'].'.'.$dayMonthYear['1'], new DateTimeZone('UTC'));
		}else{
			$date2 = new DateTime();
			$date2->setTimezone(new DateTimeZone('UTC'));
		}
		$range[1]=$date1;
		$range[2]=$date2;
		return $range;
	}

	/** Проверка сессии. */
	private function checkSession() {
		if(($_SESSION[session_name()] != $_COOKIE[session_name()])OR(($_SESSION == null)AND($_COOKIE == null))){
			session_start();
			session_unset();
			session_destroy();
			$_GET['route']='Index';
			include 'index.php';
			exit;
		}
	}

	/** Проверка данных для даты на возможность редактирования. */
	private function checkDataEditingForDate(DateTime $date) {
		$status = $this->postgreSQL->getDataStatusForEditing($date);
		if($status == null){
			$this->postgreSQL->newDataStatusForEditing($date, 0);
			return FALSE;
		}else{
			return $status['0']['editing_status'];
		}
	}
	
	/** Изменение возможности редактирования данных. */
	function changeDataStatusForEditing() {
		$date = $this->getDate();
		if($_GET['lastStatus']==FALSE){
			$status = $this->postgreSQL->changeDataStatusForEditing($date, 1);
		}else{
			$status = $this->postgreSQL->changeDataStatusForEditing($date, 0);
		}
		$this->viewProject();
	}
}
