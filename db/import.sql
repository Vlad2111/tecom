INSERT INTO "Departments" (date, department_id, department_name)
values ('01.01.2016', 0, 'ОтделХ');
INSERT INTO "Employee" (date, employee_id, user_id, department_id)
values ('01.01.2016', 0, 'user',0);
INSERT INTO "Role_def" (role_id, role_name)
values (0, 'Глава ОтделаХ');
INSERT INTO "Role" (user_id, role_id)
values ('user', 0);
INSERT INTO "Projects" (date, project_id, project_name, department_id)
values ('01.01.2016', 0, 'ПроектХ', 0);
INSERT INTO "Head_departments" (user_id, department_id)
values ('user', 0);
INSERT INTO "Time_distribution" (date, project_id, employee_id, time)
values ('01.01.2016', 0, 0, 100);