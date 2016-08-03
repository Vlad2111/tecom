<?php
/*
 * Copyright (c) 2016 Tecom LLC
 * All rights reserved
 *
 * Исключительное право (c) 2016 пренадлежит ООО Теком
 * Все права защищены
 */
/**
 Класс хранения глобальных переменных.

 @author ershov.v
 */
Class Registry Implements ArrayAccess {
	
	private $vars = array();
	 
	/* Запись данных. */
	function set($key, $var) {
		if (isset($this->vars[$key]) == true) {
			throw new Exception('Ключ '.$key.' массива var уже занят.');
		}
		$this->vars[$key] = $var;
		return true;
	}

	/* Получение данных. */
	function get($key) {
		if (isset($this->vars[$key]) == false) {
			return null;
		}
		return $this->vars[$key];
	}

	/* Доступ к классу, как массиву с помощью этих функций. */
	function offsetExists($offset) {
		return isset($this->vars[$offset]);
	}
	
	function offsetGet($offset) {
		return $this->get($offset);
	}
	
	function offsetSet($offset, $value) {
		$this->set($offset, $value);
	}
	
	function offsetUnset($offset) {
		unset($this->vars[$offset]);
	}
}
	
