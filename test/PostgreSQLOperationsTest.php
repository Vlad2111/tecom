<?php
include_once 'ApplicationInit.php';
ApplicationInit::init();

include_once 'dao/PostgreSQLOperations.php';

$db = new PostgreSQLOperations();
$db->connect();
print_r($db->getRoleNameAndId('user'));
print_r($db->getDepartmentHead('user2'));
//print_r($db->getDepartmentNames('01'));
?>