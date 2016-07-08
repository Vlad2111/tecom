<?php
include_once 'ApplicationInit.php';
ApplicationInit::init();

include_once 'dao/PostgreSQLOperations.php';

$db = new PostgreSQLOperations();
$db->connect();

echo "getRoleNameAndId(user)\n";
print_r($db->getRoleNameAndId('user'));
echo "getRoleNameAndId(user1)\n";
print_r($db->getRoleNameAndId('user'));

$date = new DateTime('23.01.2016 20:10:43');
echo "date = ".$date->format('d.m.Y H:i:s')."\n\n";
echo "getDepartmentHead(date, 1)\n";
print_r($db->getDepartmentHead($date, 1));

$datefrom = new DateTime('23.01.2016 20:10:43');
$dateto = new DateTime('12.03.2016 21:11:53');
echo "datefrom = ".$datefrom->format('d.m.Y H:i:s')."\n\n";
echo "dateto = ".$datefrom->format('d.m.Y H:i:s')."\n\n";

echo "cloneModelData(datefrom ,datefrom)\n\n";
$db->cloneModelData($datefrom ,$dateto);

echo "getDepartmentNames(datefrom)\n";
print_r($db->getDepartmentNames($datefrom));

echo "getEmployeeNames(datefrom)\n";
print_r($db->getEmployeeNames($datefrom));

echo "getProjectNamesForDepartment(0, datefrom)\n";
print_r($db->getProjectNamesForDepartment(0, $datefrom));

echo "getEmployeeNamesForDepartment(0, datefrom)\n";
print_r($db->getEmployeeNamesForDepartment(0, $datefrom));

echo "getEployeeNamesAndPercentsForProject(0, datefrom)\n";
print_r($db->getEployeeNamesAndPercentsForProject(0, $datefrom));

echo "getEmployeeInfo(0, datefrom)\n";
print_r($db->getEmployeeInfo(0, $datefrom));

?>