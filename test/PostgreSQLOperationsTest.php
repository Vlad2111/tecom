<?php
include_once 'ApplicationInit.php';
ApplicationInit::init();

include_once 'dao/PostgreSQLOperations.php';

$db = new PostgreSQLOperations();
$db->connect();
print_r($db->getRoleNameAndId('user'));
print_r($db->getDepartmentHead('user'));
$datefrom = new DateTime('23.01.2016 20:10:43');
$dateto = new DateTime('12.03.2016 21:11:53');
$db->cloneModelData($datefrom ,$datefrom);
print_r($db->getDepartmentNames($datefrom));
print_r($db->getEmployeeNames($datefrom));
print_r($db->getProjectNamesForDepartment(0, $datefrom));
print_r($db->getEmployeeNamesForDepartment(0, $datefrom));
print_r($db->getEployeeNamesAndPercentsForProject(0, $datefrom));
print_r($db->getEmployeeInfo(0, $datefrom));
?>