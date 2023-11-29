<?php
$db = mysqli_connect('localhost', 'root', 'root') or
    die('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, 'empresa') or die(mysqli_error($db));

$query_employees = 'CREATE TABLE employees (
    emp_no      INT             NOT NULL,  
    birth_date  DATE            NOT NULL,
    first_name  VARCHAR(14)     NOT NULL,
    last_name   VARCHAR(16)     NOT NULL,
    gender      ENUM (\'M\',\'F\')  NOT NULL,  
    hire_date   DATE            NOT NULL,
    PRIMARY KEY (emp_no)
)';  

$query_department = 'CREATE TABLE departments (
    dept_no     CHAR(4)         NOT NULL,  
    dept_name   VARCHAR(40)     NOT NULL,
    PRIMARY KEY (dept_no),                 
    UNIQUE  KEY (dept_name)               
)';

$query_dept_emp = 'CREATE TABLE dept_emp (
    emp_no      INT         NOT NULL,
    dept_no     CHAR(4)     NOT NULL,
    from_date   DATE        NOT NULL,
    to_date     DATE        NOT NULL,
    KEY         (emp_no),   
    KEY         (dept_no),  
    FOREIGN KEY (emp_no) REFERENCES employees (emp_no) ON DELETE CASCADE,
    FOREIGN KEY (dept_no) REFERENCES departments (dept_no) ON DELETE CASCADE,
    PRIMARY KEY (emp_no, dept_no)
)';

$query_dept_manager = 'CREATE TABLE dept_manager (
    dept_no      CHAR(4)  NOT NULL,
    emp_no       INT      NOT NULL,
    from_date    DATE     NOT NULL,
    to_date      DATE     NOT NULL,
    KEY         (emp_no),
    KEY         (dept_no),
    FOREIGN KEY (emp_no)  REFERENCES employees (emp_no)    ON DELETE CASCADE,
    FOREIGN KEY (dept_no) REFERENCES departments (dept_no) ON DELETE CASCADE,
    PRIMARY KEY (emp_no, dept_no)
)';

mysqli_query($db, $query_employees) or die(mysqli_error($db));
mysqli_query($db, $query_department) or die(mysqli_error($db));
mysqli_query($db, $query_dept_emp) or die(mysqli_error($db));
mysqli_query($db, $query_dept_manager) or die(mysqli_error($db));

echo 'Empresa database hecha';
?>


