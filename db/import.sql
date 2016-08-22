INSERT INTO "Departments" (date, department_id, department_name)
values ('08.01.2016', 0, 'Отдел33');
INSERT INTO "Departments" (date, department_id, department_name)
values ('07.01.2016', 1, 'Отдел1');
INSERT INTO "Departments" (date, department_id, department_name)
values ('07.01.2016', 0, 'Отдел33');
INSERT INTO "Departments" (date, department_id, department_name)
values ('08.01.2016', 1, 'Отдел1');


INSERT INTO "Employee" (date, employee_id, user_id, department_id)
values ('07.01.2016', 0, 'er',1);
INSERT INTO "Employee" (date, employee_id, user_id, department_id)
values ('08.01.2016', 1, 'smi',0);
INSERT INTO "Employee" (date, employee_id, user_id, department_id)
values ('08.01.2016', 0, 'er',1);
INSERT INTO "Employee" (date, employee_id, user_id, department_id)
values ('07.01.2016', 1, 'smi',0);
INSERT INTO "Employee" (date, employee_id, user_id, department_id)
values ('08.01.2016', 2, 'ershov.v', 0);
INSERT INTO "Employee" (date, employee_id, user_id, department_id)
values ('07.01.2016', 2, 'ershov.v', 0);



INSERT INTO "Role_def" (role_id, role_name)
values (0, 'Пользователь');
INSERT INTO "Role_def" (role_id, role_name)
values (1, 'Глава отдела');
INSERT INTO "Role_def" (role_id, role_name)
values (2, 'Сотрудник Отдела Кадров');
INSERT INTO "Role_def" (role_id, role_name)
values (3, 'Директор Компании');
INSERT INTO "Role_def" (role_id, role_name)
values (4, 'Администратор');


INSERT INTO "Role" (employee_id, role_id)
values (0, 0);
INSERT INTO "Role" (employee_id, role_id)
values (1, 1);
INSERT INTO "Role" (employee_id, role_id)
values (2, 4);


INSERT INTO "Projects" (date, project_id, project_name, department_id)
values ('07.01.2016', 0, 'Проект33', 0);
INSERT INTO "Projects" (date, project_id, project_name, department_id)
values ('07.01.2016', 1, 'Проект1', 1);
INSERT INTO "Projects" (date, project_id, project_name, department_id)
values ('08.01.2016', 0, 'Проект33', 0);
INSERT INTO "Projects" (date, project_id, project_name, department_id)
values ('08.01.2016', 1, 'Проект1', 1);


INSERT INTO "Head_departments" (date, employee_id, department_id)
values ('07.01.2016', 1, 0);
INSERT INTO "Head_departments" (date, employee_id, department_id)
values ('08.01.2016', 1, 0);


INSERT INTO "Time_distribution" (date, project_id, employee_id, time)
values ('07.01.2016', 0, 0, 40);
INSERT INTO "Time_distribution" (date, project_id, employee_id, time)
values ('08.01.2016', 1, 0, 50);
INSERT INTO "Time_distribution" (date, project_id, employee_id, time)
values ('07.01.2016', 0, 1, 30);
INSERT INTO "Time_distribution" (date, project_id, employee_id, time)
values ('07.01.2016', 1, 1, 20);
INSERT INTO "Time_distribution" (date, project_id, employee_id, time)
values ('08.01.2016', 0, 0, 10);
INSERT INTO "Time_distribution" (date, project_id, employee_id, time)
values ('07.01.2016', 1, 0, 15);
INSERT INTO "Time_distribution" (date, project_id, employee_id, time)
values ('08.01.2016', 0, 1, 95);
INSERT INTO "Time_distribution" (date, project_id, employee_id, time)
values ('08.01.2016', 1, 1, 90);