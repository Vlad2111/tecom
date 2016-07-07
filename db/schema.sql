DROP TABLE "Role";
DROP TABLE "Role_def";
DROP TABLE "Head_departments";
DROP TABLE "Time_distribution";
DROP TABLE "Projects";
DROP TABLE "Employee";
DROP TABLE "Departments";
CREATE TABLE "Departments" (
    date date,
    department_id integer NOT NULL,
    department_name character varying(100)
);

CREATE TABLE "Employee" (
    date date,
    employee_id integer NOT NULL,
    user_id character varying(100),
    department_id integer
);

CREATE TABLE "Head_departments" (
    user_id character varying(100),
    department_id integer
);

CREATE TABLE "Projects" (
    date date,
    project_id integer NOT NULL,
    project_id character varying(100),
    department_id integer
);

CREATE TABLE "Role" (
    user_id character varying(100),
    role_id integer
);

CREATE TABLE "Time_distribution" (
    date date,
    project_id integer,
    employee_id integer,
    "time" smallint
);

CREATE TABLE "Role_def" (
    role_id smallint NOT NULL,
    role_name character varying(100)
);

DROP SEQUENCE "Departments_department_id_seq";
DROP SEQUENCE "Employee_employee_id_seq";
DROP SEQUENCE "Project_project_id_seq";
DROP SEQUENCE "Role_def_role_id_seq";
CREATE SEQUENCE "Departments_department_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

CREATE SEQUENCE "Employee_employee_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

CREATE SEQUENCE "Project_project_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
    
CREATE SEQUENCE "Role_def_role_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER TABLE ONLY "Departments" ALTER COLUMN department_id SET DEFAULT nextval('"Departments_department_id_seq"'::regclass);

ALTER TABLE ONLY "Employee" ALTER COLUMN employee_id SET DEFAULT nextval('"Employee_employee_id_seq"'::regclass);

ALTER TABLE ONLY "Projects" ALTER COLUMN project_id SET DEFAULT nextval('"Project_project_id_seq"'::regclass);

ALTER TABLE ONLY "Role_def" ALTER COLUMN role_id SET DEFAULT nextval('"Role_def_role_id_seq"'::regclass);

ALTER TABLE ONLY "Departments"
    ADD CONSTRAINT department_id_pk PRIMARY KEY (department_id);

ALTER TABLE ONLY "Employee"
    ADD CONSTRAINT employee_id_pk PRIMARY KEY (employee_id);

ALTER TABLE ONLY "Projects"
    ADD CONSTRAINT project_id_pk PRIMARY KEY (project_id);

ALTER TABLE ONLY "Role_def"
    ADD CONSTRAINT role_id_pk PRIMARY KEY (role_id);

ALTER TABLE ONLY "Time_distribution"
    ADD CONSTRAINT project_employee_pk PRIMARY KEY (project_id, employee_id);

ALTER TABLE ONLY "Role"
    ADD CONSTRAINT user_role_pk PRIMARY KEY (user_id, role_id);

ALTER TABLE ONLY "Head_departments"
    ADD CONSTRAINT user_department_pk PRIMARY KEY (user_id, department_id);    
 
ALTER TABLE ONLY "Employee"
    ADD CONSTRAINT user_id_uniqie UNIQUE (user_id);

ALTER TABLE ONLY "Employee"
    ADD CONSTRAINT department_id_vk FOREIGN KEY (department_id) REFERENCES "Departments"(department_id) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE ONLY "Head_departments"
    ADD CONSTRAINT department_id_vk FOREIGN KEY (department_id) REFERENCES "Departments"(department_id) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE ONLY "Projects"
    ADD CONSTRAINT department_id_vk FOREIGN KEY (department_id) REFERENCES "Departments"(department_id) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE ONLY "Time_distribution"
    ADD CONSTRAINT employee_id_vk FOREIGN KEY (employee_id) REFERENCES "Employee"(employee_id) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE ONLY "Time_distribution"
    ADD CONSTRAINT project_id_vk FOREIGN KEY (project_id) REFERENCES "Projects"(project_id) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE ONLY "Head_departments"
    ADD CONSTRAINT user_id_vk FOREIGN KEY (user_id) REFERENCES "Employee"(user_id) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE ONLY "Role"
    ADD CONSTRAINT user_id_vk FOREIGN KEY (user_id) REFERENCES "Employee"(user_id) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE ONLY "Role"
    ADD CONSTRAINT role_id_vk FOREIGN KEY (role_id) REFERENCES "Role_def"(role_id) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE;
    
    