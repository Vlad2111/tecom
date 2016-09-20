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
Класс контроллер, создание отчетов.

@author ershov.v
*/
Class Controller_Reports Extends Controller_Base {

	public $log;
	public $postgreSQL;
	public $numRow;

	
	function createReports() {
		$this->checkSession();
		
		require_once '3pty/PHPExcel/Classes/PHPExcel.php';
		require_once '3pty/PHPExcel/Classes/PHPExcel/Writer/Excel2007.php';
		
		$file_type = PHPExcel_IOFactory::identify('report/modelReports.xlsx');
		$objReader = PHPExcel_IOFactory::createReader( $file_type );
		$objPHPExcel = $objReader->load( 'report/modelReports.xlsx' );
		$sheet = $objPHPExcel->getSheetByName('date');
		
		$date = new DateTime('01.'.$_GET['Month'].'.'.$_GET['Year'], new DateTimeZone('UTC'));
		
		$sheet->setTitle($date->format('Y'));
		
		$this->rowOfHeaders($sheet, $date);
		$this->cellOfEmployeeAndDepartment($sheet, $date);

		ob_end_clean();
		header("Content-Type:application/vnd.ms-excel");
		$dateNow = new DateTime();
		header("Content-Disposition:attachment; filename='Распределение_ресурсов_".$date->format('m.Y')."_Текомыч ".$dateNow->format('d.m.Y').".xlsx'");
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
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
	
	/** Запись шапки таблицы. */
	private function rowOfHeaders($sheet, $date){
		$date=
		$sheet->setCellValue("E1", PHPExcel_Shared_Date::PHPToExcel($date));
	}
	
	/** Запись сотрудников. */
	private function cellOfEmployeeAndDepartment($sheet, $date){
		$this->numRow=2;
		$arrayEmployeeNames = $this->postgreSQL->getEmployeeNames($date);
		foreach ($arrayEmployeeNames as $key => $row) {
			$userName[$key]  = $row['user_name'];
		}
		array_multisort($userName, SORT_ASC, SORT_STRING, $arrayEmployeeNames);
		foreach ($arrayEmployeeNames as $employee){
			$this->cellOfProjectAndTimeForEmployee($sheet, $date, $employee);
		}
	}
	
	/** Запись проектов. */
	private function cellOfProjectAndTimeForEmployee($sheet, $date, $employee){
		$arrayEmployeeInfo = $this->postgreSQL->getEmployeeInfo($employee['employee_id'], $date);
		foreach ($arrayEmployeeInfo as $project){
			 $sheet->setCellValueByColumnAndRow(1, $this->numRow, $employee['user_name']);
			 $sheet->setCellValueByColumnAndRow(2, $this->numRow, $employee['department_name']);
			 $sheet->setCellValueByColumnAndRow(3, $this->numRow, $project['project_name']);
			 $sheet->setCellValueByColumnAndRow(4, $this->numRow, $project['time']/100);
			 $this->numRow = $this->numRow+1;
		}
	}
}
