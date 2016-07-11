<?php
include_once 'ApplicationInit.php';
ApplicationInit::init();

include_once 'dao/PostgreSQLOperations.php';

$db = new PostgreSQLOperations();
$db->connect();
/*
echo "getRoleNameAndId('user')\n";
print_r($db->getRoleNameAndId('user'));
echo "getRoleNameAndId('user1')\n";
print_r($db->getRoleNameAndId('user'));
/*
$date = new DateTime('23.01.2016 20:10:43');
echo "date = ".$date->format('d.m.Y H:i:s')."\n\n";
echo "getDepartmentHead(date, 1)\n";
print_r($db->getDepartmentHead($date, 1));
*/
/*
$datefrom = new DateTime('23.01.2016 20:10:43');
$dateto = new DateTime('12.03.2016 21:11:53');
echo "datefrom = ".$datefrom->format('d.m.Y H:i:s')."\n\n";
echo "dateto = ".$dateto->format('d.m.Y H:i:s')."\n\n";
*/
/*
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

print_r($db->getDepartmentNames($dateto));
echo "changeDepartmentName(0, dateto,'Отдел2')\n";
$db->changeDepartmentName(0, $dateto,'Отдел2');
echo "result:\n";
print_r($db->getDepartmentNames($dateto));

print_r($db->getProjectNamesForDepartment(0, $dateto));
echo "changeProjectNameAndDepartmentId(0, dateto,'Проект2', 0)\n";
$db->changeProjectNameAndDepartmentId(0, $dateto,'Проект2', 0);
echo "result:\n";
print_r($db->getProjectNamesForDepartment(0, $dateto));

print_r($db->getEmployeeInfo(0, $dateto));
echo "changeEployeeTime(0, 0, dateto, 50)\n";
$db->changeEployeeTime(0, 0, $dateto, 50);
echo "result:\n";
print_r($db->getEmployeeInfo(0, $dateto));

print_r($db->getEmployeeNamesForDepartment(0, $dateto));
echo "changeEmployeeInfo(0, dateto, 0)\n";
$db->changeEmployeeInfo(0, $dateto, 1);
echo "result:\n";
print_r($db->getEmployeeNamesForDepartment(1, $dateto));

print_r($db->getDepartmentHead($datefrom, 1));
echo "changeDepartmentHead(1, 0, datefrom, 0, 1)\n";
$db->changeDepartmentHead(1, 0, $datefrom, 0, 1);
echo "result:\n";
print_r($db->getDepartmentHead($datefrom, 0));

print_r($db->getRoleNameAndId('user'));
echo "changeRole('user', 1)\n";
$db->changeRole('user', 1);
print_r($db->getRoleNameAndId('user'));

print_r($db->getDepartmentNames($datefrom));
echo "newDepartment(datefrom, 'Отдел2')\n";
$db->newDepartment($datefrom, 'Отдел2');
echo "result:\n";
print_r($db->getDepartmentNames($datefrom));

print_r($db->getEmployeeNames($datefrom));
echo "newEmployee(datefrom, 'user2', 2)\n";
$db->newEmployee($datefrom, 'user2', 2);
echo "result:\n";
print_r($db->getEmployeeNames($datefrom));

print_r($db->getProjectNamesForDepartment(1, $datefrom));
echo "newProject(datefrom, 'Проект2', 1)\n";
$db->newProject($datefrom, 'Проект2', 1);
echo "result:\n";
print_r($db->getProjectNamesForDepartment(1, $datefrom));

print_r($db->getEmployeeInfo(2, $datefrom));
echo "newTimeDistribution(datefrom, 0, 2, 30)\n";
$db->newTimeDistribution($datefrom, 0, 2, 30);
echo "result:\n";
print_r($db->getEmployeeInfo(2, $datefrom));

echo "newRole('user2', 1)\n";
$db->newRole('user2', 1);
print_r($db->getRoleNameAndId('user2'));

echo "newHeadDepartment(datefrom, 0, 1)\n";
$db->newHeadDepartment($datefrom, 2, 2);
echo "result:\n";
print_r($db->getDepartmentHead($datefrom, 2));

print_r($db->getDepartmentNames($datefrom));
echo "deleteDepartment(datefrom,2)\n";
$db->deleteDepartment($datefrom,2);
echo "result:\n";
print_r($db->getDepartmentNames($datefrom));

print_r($db->getEmployeeNames($datefrom));
echo "deleteEmployee(datefrom, 1)\n";
$db->deleteEmployee($datefrom, 1);
echo "result:\n";
print_r($db->getEmployeeNames($datefrom));

print_r($db->getProjectNamesForDepartment(0, $datefrom));
echo "deleteProject(datefrom, 0)\n";
$db->deleteProject($datefrom, 0);
echo "result:\n";
print_r($db->getProjectNamesForDepartment(0, $datefrom));

print_r($db->getEmployeeInfo(0, $datefrom));
echo "deleteTimeDistribution(datefrom, 0, 0)\n";
$db->deleteTimeDistribution($datefrom, 1, 0);
echo "result:\n";
print_r($db->getEmployeeInfo(0, $datefrom));

print_r($db->getRoleNameAndId('user1'));
echo "deleteRole('user1')\n";
$db->deleteRole('user1');
print_r($db->getRoleNameAndId('user1'));

print_r($db->getDepartmentHead($datefrom, 1));
echo "deleteHeadDepartment(datefrom, 0, 1)\n";
$db->deleteHeadDepartment($datefrom, 0, 1);
echo "result:\n";
print_r($db->getDepartmentHead($datefrom, 1));
*/
?>