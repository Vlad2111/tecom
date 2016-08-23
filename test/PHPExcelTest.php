<?php

function readerXLSXFile( $filename ){
	require_once '../3pty/PHPExcel/Classes/PHPExcel.php';
	$file_type = PHPExcel_IOFactory::identify( $filename );
	$objReader = PHPExcel_IOFactory::createReader( $file_type );
	$objPHPExcel = $objReader->load( $filename );
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
$data = readerXLSXFile('testExcel.xlsx');
changeValueForSave($data);
/** Пример полученных данных
		[Сотрудник] => Кудряшов Алексей Васильевич
		[Подразделение] => Engineering
		[Проект] => Imagine: Nexio
		[January-2016] => 
		[February-2016] => 
		[March-2016] => 
		[April-2016] => 
		[May-2016] => 
		[June-2016] => 
		[July-2016] => 1
*/
function changeValueForSave( $value ){
	if ($value!=null){
		$date = $value['date'];
		unset($value['date']);
		foreach ($value as $key=>$row){
			foreach ($date as $keyDate=>$rowDate){
				if($row[$rowDate->format('F-Y')]!=null){
					$array[$rowDate->format('F-Y')]['Date']=$rowDate;
					$array[$rowDate->format('F-Y')][$key]['department']['name']=$row['Подразделение'];

					$array[$rowDate->format('F-Y')][$key]['employee']['name']=$row['Сотрудник'];

					$array[$rowDate->format('F-Y')][$key]['project']['name']=$row['Проект'];

					$array[$rowDate->format('F-Y')][$key]['timeDist']=$row[$rowDate->format('F-Y')];
				}
			}
		}
	}
	
}