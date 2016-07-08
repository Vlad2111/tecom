INSERT INTO "Departments" (date, department_id, department_name)
values ('01.01.2016', 0, 'Отдел');
INSERT INTO "Departments" (date, department_id, department_name)
values ('01.01.2016', 1, 'Отдел1');
INSERT INTO "Departments" (date, department_id, department_name)
values ('02.01.2016', 0, 'Отдел');
INSERT INTO "Departments" (date, department_id, department_name)
values ('02.01.2016', 1, 'Отдел1');


INSERT INTO "Employee" (date, employee_id, user_id, department_id)
values ('01.01.2016', 0, 'user',1);
INSERT INTO "Employee" (date, employee_id, user_id, department_id)
values ('01.01.2016', 1, 'user1',0);
INSERT INTO "Employee" (date, employee_id, user_id, department_id)
values ('02.01.2016', 0, 'user',1);
INSERT INTO "Employee" (date, employee_id, user_id, department_id)
values ('02.01.2016', 1, 'user1',0);


INSERT INTO "Role_def" (role_id, role_name)
values (0, 'Пользователь');
INSERT INTO "Role_def" (role_id, role_name)
values (1, 'Глава отдела');


INSERT INTO "Role" (employee_id, role_id)
values (0, 0);
INSERT INTO "Role" (employee_id, role_id)
values (1, 1);


INSERT INTO "Projects" (date, project_id, project_name, department_id)
values ('01.01.2016', 0, 'Проект', 0);
INSERT INTO "Projects" (date, project_id, project_name, department_id)
values ('01.01.2016', 1, 'Проект1', 1);
INSERT INTO "Projects" (date, project_id, project_name, department_id)
values ('02.01.2016', 0, 'Проект', 0);
INSERT INTO "Projects" (date, project_id, project_name, department_id)
values ('02.01.2016', 1, 'Проект1', 1);


INSERT INTO "Head_departments" (date, employee_id, department_id)
values ('01.01.2016', 1, 0);
INSERT INTO "Head_departments" (date, employee_id, department_id)
values ('02.01.2016', 1, 0);


INSERT INTO "Time_distribution" (date, project_id, employee_id, time)
values ('01.01.2016', 0, 0, 100);
INSERT INTO "Time_distribution" (date, project_id, employee_id, time)
values ('01.01.2016', 1, 0, 100);
INSERT INTO "Time_distribution" (date, project_id, employee_id, time)
values ('01.01.2016', 0, 1, 0);
INSERT INTO "Time_distribution" (date, project_id, employee_id, time)
values ('01.01.2016', 1, 1, 0);
INSERT INTO "Time_distribution" (date, project_id, employee_id, time)
values ('02.01.2016', 0, 0, 10);
INSERT INTO "Time_distribution" (date, project_id, employee_id, time)
values ('02.01.2016', 1, 0, 10);
INSERT INTO "Time_distribution" (date, project_id, employee_id, time)
values ('02.01.2016', 0, 1, 90);
INSERT INTO "Time_distribution" (date, project_id, employee_id, time)
values ('02.01.2016', 1, 1, 90);