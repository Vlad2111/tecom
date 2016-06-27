<?php
/*
* Copyright (c) 2016 Tecom LLC
* All rights reserved
*
* �������������� ����� (c) 2016 ����������� ��� �����
* ��� ����� ��������
*/
/**
����� Singleton

@author ershov.v
*/
class Configuration
{
	public $config = array();

	function __construct() {
	}

	/** ������������ ����������� � ���� ������ PostgreSQL.*/
	public static function instance()
	{
		static $instance = null;
		if ($instance === null) {
			$instance = new Configuration();
  			$instance->readConfigAndDBConnection();
		}
		return $instance;
	}
	
	/** ������ ���������� �� ����� config.php � ����������� � ���� ������.*/
	private function readConfigAndDBConnection()
	{
		$dbConnect = null;
		
		$ConfigurationArray= parse_ini_file("config.ini");
		$dbConnect = pg_connect($ConfigurationArray);
		if (!$dbConnect) {
			throw new Exception("�� ������� ����������� � ���� ������");
		}
		return $dbConnect;
	}
}

Configuration::instance()->config;
?>