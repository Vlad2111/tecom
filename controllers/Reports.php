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
		
		$range=$this->getDateRange();

		$sheet->setTitle($range['to']->format('Y'));
		
		$this->rowOfHeaders($sheet, $range['from'], $range['to']);
		$this->cellOfEmployeeAndDepartment($sheet, $range['from'], $range['to']);

		ob_end_clean();
		header("Content-Type:application/vnd.ms-excel");
		$dateNow = new DateTime();
		header("Content-Disposition:attachment; filename='Распределение_ресурсов_".$range['from']->format('m.Y').'-'.$range['to']->format('m.Y')."_Текомыч ".$dateNow->format('d.m.Y').".xlsx'");
		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
	}

	/** Получение даты. */
	private function getDateRange() {
		if ($_GET['datefrom']!=null){
			$dayMonthYear = explode('/', $_GET['datefrom']);
			$datefrom = new DateTime('01.'.$dayMonthYear['0'].'.'.$dayMonthYear['1'], new DateTimeZone('UTC'));
		}else{
			$datefrom = new DateTime();
			$convertDate=date_parse_from_format("d.m.Y H:i:s",$datefrom->format("d.m.Y H:i:s"));
			$datefrom = new DateTime($convertDate['year']."-01-01",
					new DateTimeZone('UTC'));
		}
		if ($_GET['dateto']!=null){
			$dayMonthYear = explode('/', $_GET['dateto']);
			$dateto = new DateTime('01.'.$dayMonthYear['0'].'.'.$dayMonthYear['1'], new DateTimeZone('UTC'));
		}else{
			$dateto = new DateTime();
			$convertDate=date_parse_from_format("d.m.Y H:i:s",$dateto->format("d.m.Y H:i:s"));
			$dateto = new DateTime($convertDate['year']."-".$convertDate['month']."-01",
					new DateTimeZone('UTC'));
		}
		$range['from']=$datefrom;
		$range['to']=$dateto;
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
	
	/** Запись шапки таблицы. */
	private function rowOfHeaders($sheet, $datefrom, $dateto){
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$datefrom->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01",
				new DateTimeZone('UTC'));
			$i=4;
		while ($date->format("U") <= $dateto->format("U")) {
			$sheet->setCellValueByColumnAndRow($i, 1, PHPExcel_Shared_Date::PHPToExcel($date));
			$i++;
			$date->add(new DateInterval('P33D'));
			$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
			$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01",
					new DateTimeZone('UTC'));
		}
	}
	
	/** Запись сотрудников. */
	private function cellOfEmployeeAndDepartment($sheet, $datefrom, $dateto){
		$this->numRow=2;
		$infoForReport = $this->postgreSQL->getInfoForReport($datefrom, $dateto);
		foreach ($infoForReport as $key => $row) {
			$userName[$key]  = $row['user_name'];
		}
		array_multisort($userName, SORT_ASC, SORT_STRING, $infoForReport);
		foreach ($infoForReport as $employee){
			$this->cellOfProjectAndTimeForEmployee($sheet, $employee);
		}
	}
	
	/** Запись проектов. */
	private function cellOfProjectAndTimeForEmployee($sheet, $employee){
		foreach ($employee['projects'] as $project){
			$sheet->setCellValueByColumnAndRow(1, $this->numRow, $employee['user_name']);
			$sheet->setCellValueByColumnAndRow(2, $this->numRow, $employee['department_name']);
			$sheet->setCellValueByColumnAndRow(3, $this->numRow, $project['project_name']);
			$i=4;
			foreach($project['time'] as $time){
				$sheet->setCellValueByColumnAndRow($i, $this->numRow, $time/100);
				$i++;
			}
			$this->numRow = $this->numRow+1;
		}
	}
}
