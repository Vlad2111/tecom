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
Класс контроллер, Ошибки.

@author ershov.v
*/
Class Controller_Errors Extends Controller_Base {

	
	/** Отображение списка XLSX ошибок . */
	function viewListErrorsXLSX() {
		$this->checkSession();
		
		$date = $this->getDate();
		$this->template->vars('errors', $_GET['errors']);
		
		$this->template->vars('date', $date);
		$this->template->view('errors', 'ErrorsLayout');
	}
	
	/** Отображение списка XLSX ошибок . */
	function uncorrectDate() {
		$this->checkSession();
	
		$date = $this->getDate();
		$this->template->vars('date', $date);
		
		$this->template->vars('message', "Даты выбраны некорректно. Первая дата: <b><u>".$_POST['date1']->format('m-y')."</b></u> больше второй: <b><u>".$_POST['date2']->format('m-y')."</b></u>.<br>Пожалуйста повторите попытку снова.");
		$this->template->view('errors', 'ErrorsLayout');
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
}
