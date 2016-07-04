<?php
include_once 'dao/PostgreSQLOperations.php';

$db = new PostgreSQLOperations();
$db->connect();
print_r($db->getRoleNameAndId('user'));
print_r($db->getDepartmentHead('user'));
print_r($db->getDepartmentNames(''));
?>