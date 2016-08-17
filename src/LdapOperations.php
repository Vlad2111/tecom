<?php
/*
* Copyright (c) 2015 Tecom LLC
* All rights reserved
*
* Исключительное право (c) 2015 пренадлежит ООО Теком
* Все права защищены
*/

/**
Класс, инкапсулирующий операции с сервером LDAP

@author smirnov.a
*/
class LdapOperations
{
	private $ldaphost;
	private $ldapport;
	private $login;
	private $password;
	private $base;

	private $ldap = null;

	/** Подключение к серверу LDAP. Метод обязательно должен быть вызван перед вызовом любых других методов */
	const LDAP_OPT_DIAGNOSTIC_MESSAGE = 0x0032;
	public function connect()
	{
		$LDAPConfiguration = Configuration::instance()->config;
		$this->ldaphost=$LDAPConfiguration['ldaphost'];
		$this->ldapport=$LDAPConfiguration['ldapport'];
		$this->login=$LDAPConfiguration['login'];
		$this->password=$LDAPConfiguration['password'];
		$this->base=$LDAPConfiguration['base'];
		$this->ldap=ldap_connect($this->ldaphost, $this->ldapport);
		if (!$this->ldap) {
			throw new Exception("Cant connect to ldap Server");
		}
		ldap_set_option($this->ldap, LDAP_OPT_REFERRALS, 0);
		ldap_set_option($this->ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
		$bind = ldap_bind($this->ldap, $this->login, $this->password);

		if (!$bind) {
			if (ldap_get_option($this->$ldap, self::LDAP_OPT_DIAGNOSTIC_MESSAGE, $extended_error)) {
				$this->ldap = null;
				throw new Exception("Error Binding to LDAP: $extended_error");
			} else {
				$this->ldap = null;
				throw new Exception("Error Binding to LDAP: No additional information is available");
			}
		}
	}
	
	/** Проверка данных пользователя входящего в систему
	@return Boolean
	*/
	public function checkUser($getLogin, $getPasswordLDAP)
	{
	    $ldap = ldap_connect($this->ldaphost, $this->ldapport);
		if (!$ldap) {
			throw new Exception("Cant connect to ldap Server");
		}
		
        @$bind = ldap_bind($ldap, "TECOM\\".$getLogin, $getPasswordLDAP);
        
        ldap_unbind($ldap); 
        return $bind;   
        
    }
	
	/** Вспомогательный метод для работы с поиском в LDAP */
	private function searchLDAP($query, $returnProperties)
	{
		$result = ldap_search($this->ldap, $this->base, $query, $returnProperties);
		if (!$result) {
			throw new Exception("Error performing LDAP search");
		}

		$result_ent = ldap_get_entries($this->ldap,$result);
		if (!$result_ent) {
			throw new Exception("Error fetching LDAP search result");
		}

		return $result_ent;
	}
	 

	/** Возвращает список аккаунтов, начинающихся с заданного префикса как список массивов следующего вида:
	(
		[ 
			'name' => 'Luke Skywalker', <- человеко-читаемое имя для отображения в интерфейсе
			'sAMAccountName' => 'skyluke',  <- название аккаунта
			'sn' => 'Скайвокер', <- фамилия
			'givenName' => 'Люк', <- имя
			'mail' => 'skyluke@tecomgroup.ru' <- аккаутн почты
		]
	)
	*/
	const UF_ACCOUNT_DISABLED=2;
	const UF_WORKSTATION_TRUST_ACCOUNT=4096;
	const TECH_ACCOUNT='OU=service connections users';
	public function getLDAPAccountNamesByPrefix($prefix) 
	{
		if (!$this->ldap) {
			throw new Exception("Not connected to LDAP server");
		}

		$result_ent = $this->searchLDAP("(&(objectClass=person)(sAMAccountName=*{$prefix}*))", 
			array('name', 'useraccountcontrol', 'sAMAccountName', 'sn', 'givenName', 'mail'));
        
		$names = array();
		$iter = function($value, $key) use (&$names) 
		{
			if (is_array($value) && 
				isset($value['useraccountcontrol']) &&
				($value['useraccountcontrol'][0] & self::UF_ACCOUNT_DISABLED) != self::UF_ACCOUNT_DISABLED && 
				($value['useraccountcontrol'][0] & self::UF_WORKSTATION_TRUST_ACCOUNT) != self::UF_WORKSTATION_TRUST_ACCOUNT &&
				!stristr($value['dn'], self::TECH_ACCOUNT)) 
			{
				array_push($names, array('name'=>$value['name'][0], 'sAMAccountName'=>$value['samaccountname'][0], 'sn'=>$value['sn'][0], 'givenName'=>$value['givenname'][0], 'mail'=>$value['mail'][0]));
			}
		};

		array_walk($result_ent, $iter);
		return $names;
	}
	
	/**Возвращает список логинов, по ФИО */
	public function getLDAPAccountNamesByFullName($fullName)
	{
		if (!$this->ldap) {
			throw new Exception("Not connected to LDAP server");
		}
		$nameFST = explode(' ', $fullName);
		$firstName = $nameFST['1'];
		$secondName = $nameFST['0'];
		$thirdName = $nameFST['2'];
		$result_ent = $this->searchLDAP("(&(objectClass=person)(givenName=*{$firstName}*)(sn=*{$secondName}*))",
		array('name', 'useraccountcontrol', 'sAMAccountName', 'sn', 'givenName', 'mail'));
	
		$names = array();
		$iter = function($value, $key) use (&$names)
		{
			if (is_array($value) &&
					isset($value['useraccountcontrol']) &&
					($value['useraccountcontrol'][0] & self::UF_ACCOUNT_DISABLED) != self::UF_ACCOUNT_DISABLED &&
					($value['useraccountcontrol'][0] & self::UF_WORKSTATION_TRUST_ACCOUNT) != self::UF_WORKSTATION_TRUST_ACCOUNT &&
					!stristr($value['dn'], self::TECH_ACCOUNT))
			{
				array_push($names, array('name'=>$value['name'][0], 'sAMAccountName'=>$value['samaccountname'][0], 'sn'=>$value['sn'][0], 'givenName'=>$value['givenname'][0], 'mail'=>$value['mail'][0]));
			}
		};
	
		array_walk($result_ent, $iter);
		return $names;
	}
}
?>

