<?php
/*
* Copyright (c) 2016 Tecom LLC
* All rights reserved
*
* Исключительное право (c) 2016 пренадлежит ООО Теком
* Все права защищены
*/
/**
Класс контроллер, проверка после авторизации.

@author ershov.v
*/
Class Controller_SaveXLSX Extends Controller_Base {

	public $log;
	public $postgreSQL;

	
	function index() {
		
		$data = $this->readerXLSXFile('test/testExcel.xlsx');
		$data = $this->readerXLSXFileProject('test/testExcel.xlsx');
		//$array = $this->changeValueForSave($data);
		//print_r($array['January-2016']['date']);
		//print_r($array['January-2016'][0]);
	}
	
	/** Чтение файла. */
	private function readerXLSXFile( $filename ){
		require_once '3pty/PHPExcel/Classes/PHPExcel.php';
		$file_type = PHPExcel_IOFactory::identify( $filename );
		$objReader = PHPExcel_IOFactory::createReader( $file_type );
		$objPHPExcel = $objReader->load( $filename );
		$sheet = $objPHPExcel->getSheetByName('Список проектов');
		for ($i = 0; $i <= $sheet->getHighestRow(); $i++) {
			for ($j = 1; $j < 5; $j++) {
				$value1[$i][$j] = $sheet->getCellByColumnAndRow($j, $i+2)->getValue();
			}
		}
		print_r($value1);
		$sheet = $objPHPExcel->getSheetByName('2016');
		for ($j = 1; $j < 11; $j++) {
			$value['header'][$j] = $sheet->getCellByColumnAndRow($j, 1)->getValue();
			if(PHPExcel_Shared_Date::isDateTime($sheet->getCellByColumnAndRow($j, 1))) {
				$value['date'][$j] = PHPExcel_Shared_Date::ExcelToPHPObject($value['header'][$j]);
				$value['header'][$j] = PHPExcel_Shared_Date::ExcelToPHPObject($value['header'][$j])->format('F-Y');
			}
		}
		for ($i = 0; $i <= $sheet->getHighestRow(); $i++) {

			for ($j = 1; $j < 11; $j++) {
				$value[$i][$value['header'][$j]] = $sheet->getCellByColumnAndRow($j, $i+2)->getValue();
			}
			if (($value[$i]['Сотрудник']==null)AND($value[$i]['Подразделение']==null)AND($value[$i]['Проект']==null)){
				unset($value[$i]);
				unset($value['header']);
				$i = $sheet->getHighestRow();
			}
		}
		return $value;
	}
	
	/** Чтение файла. */
	private function readerXLSXFileProject( $filename ){
		require_once '3pty/PHPExcel/Classes/PHPExcel.php';
		$file_type = PHPExcel_IOFactory::identify( $filename );
		$objReader = PHPExcel_IOFactory::createReader( $file_type );
		$objPHPExcel = $objReader->load( $filename );
		$sheet = $objPHPExcel->getSheetByName('Список проектов');
		for ($i = 0; $i <= $sheet->getHighestRow(); $i++) {
			for ($j = 1; $j < 5; $j++) {
				$value1[$i][$j] = $sheet->getCellByColumnAndRow($j, $i+2)->getValue();
			}
		}
		print_r($value1);
		return $value;
	}
	
	/** Обработчик файла. */
	/** Пример полученных данных
	 * [123] => 
	 * [Сотрудник] => Ершов Владислав Александрович
	 * [Подразделение] => Отдел3333
	 * [Проект] => Проект33
	 * [January-2016] =>
	 * [February-2016] =>
	 * [March-2016] =>
	 * [April-2016] =>
	 * [May-2016] =>
	 * [June-2016] => 1
	 * [July-2016] => 1
	 */
	function changeValueForSave( $value ){
		if ($value!=null){
			$date = $value['date'];
			unset($value['date']);
			foreach ($value as $key=>$row){
				foreach ($date as $keyDate=>$rowDate){
					if($row[$rowDate->format('F-Y')]!=null){
						$array[$rowDate->format('F-Y')]['date']=$rowDate;
						
						$departmentId = $this->postgreSQL->getDepartmentId($rowDate, $row['Подразделение']);
						if ($departmentId == null){
							$this->postgreSQL->newDepartment($rowDate, $row['Подразделение']);
							$departmentId = $this->postgreSQL->getDepartmentId($rowDate, $row['Подразделение']);
						}
						$array[$rowDate->format('F-Y')][$key]['department']['id']=$departmentId;
						$array[$rowDate->format('F-Y')][$key]['department']['name']=$row['Подразделение'];
						
						$employeeIdAndLogin = $this->postgreSQL->getEmployeeId($rowDate, $row['Сотрудник']);
						if ($employeeIdAndLogin == null){
							$ldap = new LdapOperations();
							$ldap->connect();
							$login = $ldap->getLDAPAccountNamesByFullName($row['Сотрудник']);
							$this->postgreSQL->newEmployee($rowDate, $login[0]['sAMAccountName'], $row['Сотрудник'], $departmentId);
							$employeeIdAndLogin = $this->postgreSQL->getEmployeeId($rowDate, $row['Сотрудник']);
						}
						$array[$rowDate->format('F-Y')][$key]['employee']['id']=$employeeIdAndLogin['employee_id'];
						$array[$rowDate->format('F-Y')][$key]['employee']['login']=$employeeIdAndLogin['user_id'];
						$array[$rowDate->format('F-Y')][$key]['employee']['name']=$row['Сотрудник'];
						$array[$rowDate->format('F-Y')][$key]['employee']['department']=$departmentId;

						$array[$rowDate->format('F-Y')][$key]['project']['name']=$row['Проект'];

						$array[$rowDate->format('F-Y')][$key]['timeDist']=$row[$rowDate->format('F-Y')];
					}
				}
			}
		}
		return $array;
	}
}