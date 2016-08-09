DROP TABLE "Role";
DROP TABLE "Role_def";
DROP TABLE "Head_departments";
DROP TABLE "Time_distribution";
DROP TABLE "Projects";
DROP TABLE "Employee";
DROP TABLE "Departments";
DROP SEQUENCE "Role_def_role_id_seq";

CREATE SEQUENCE "Role_def_role_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
    
CREATE TABLE "Departments" (
    date timestamp without time zone,
    department_id integer,
    department_name character varying(100),
    CONSTRAINT department_id_date_pk PRIMARY KEY (date, department_id),
	CONSTRAINT department_name_date_unique UNIQUE (date, department_name)

);

CREATE TABLE "Employee" (
    date timestamp without time zone,
    employee_id integer ,
    user_id character varying(100),
    department_id integer,
    CONSTRAINT employee_id_date_pk PRIMARY KEY (date, employee_id),
	CONSTRAINT user_id_date_unique UNIQUE (date, user_id),
    CONSTRAINT department_id_date_vk FOREIGN KEY (date, department_id) REFERENCES "Departments"(date, department_id) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE "Projects" (
    date timestamp without time zone,
    project_id integer ,
    project_name character varying(100),
    department_id integer,
    CONSTRAINT project_id_date_pk PRIMARY KEY (date, project_id),
	CONSTRAINT department_id_project_name_date_unique UNIQUE (date, project_name, department_id),
    CONSTRAINT department_id_date_vk FOREIGN KEY (date, department_id) REFERENCES "Departments"(date, department_id) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE "Time_distribution" (
    date timestamp without time zone,
    project_id integer,
    employee_id integer,
    "time" smallint,
    CONSTRAINT project_employee_id_date_pk PRIMARY KEY (date, project_id, employee_id),
    CONSTRAINT project_id_date_vk FOREIGN KEY (date, project_id) REFERENCES "Projects"(date, project_id) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT employee_id_date_vk FOREIGN KEY (date, employee_id) REFERENCES "Employee"(date, employee_id) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE "Role_def" (
    role_id smallint DEFAULT nextval('"Role_def_role_id_seq"'::regclass),
    role_name character varying(100),
    CONSTRAINT role_id_pk PRIMARY KEY (role_id)
);

CREATE TABLE "Role" (
    employee_id integer,
    role_id integer,
    CONSTRAINT employee_id_pk PRIMARY KEY (employee_id),
    CONSTRAINT role_id_vk FOREIGN KEY (role_id) REFERENCES "Role_def"(role_id) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE "Head_departments" (
    date timestamp without time zone,
    employee_id integer,
    department_id integer,
    CONSTRAINT date_employee_department_id_pk PRIMARY KEY (date, employee_id, department_id),
    CONSTRAINT employee_id_date_vk FOREIGN KEY (date, employee_id) REFERENCES "Employee"(date, employee_id) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT department_id_date_vk FOREIGN KEY (date, department_id) REFERENCES "Departments"(date, department_id) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE
);