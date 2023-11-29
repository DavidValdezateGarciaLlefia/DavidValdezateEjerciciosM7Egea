<?php
$db = mysqli_connect('localhost', 'root', 'root') or
    die('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, 'empresa') or die(mysqli_error($db));

// Insertar un empleado
$query_insert_employee = "INSERT INTO employees (emp_no, birth_date, first_name, last_name, gender, hire_date)
                          VALUES (101, '1990-01-15', 'John', 'Doe', 'M', '2023-01-01')";
mysqli_query($db, $query_insert_employee) or die(mysqli_error($db));

// Insertar un departamento
$query_insert_department = "INSERT INTO departments (dept_no, dept_name)
                            VALUES ('D001', 'IT')";
mysqli_query($db, $query_insert_department) or die(mysqli_error($db));

// Insertar la asignación del empleado al departamento
$query_insert_dept_emp = "INSERT INTO dept_emp (emp_no, dept_no, from_date, to_date)
                         VALUES (101, 'D001', '2023-01-01', '9999-12-31')";
mysqli_query($db, $query_insert_dept_emp) or die(mysqli_error($db));

echo 'Datos insertados correctamente.';
?>
