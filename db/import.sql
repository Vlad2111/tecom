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


INSERT INTO "Head_departments" (date, employee_id, department_id)
values ('07.01.2016', 1, 0);
INSERT INTO "Head_departments" (date, employee_id, department_id)
values ('08.01.2016', 1, 0);
