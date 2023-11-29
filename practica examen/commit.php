<?php

print_r($_POST);

$db = mysqli_connect('localhost', 'root', 'root') or 
    die('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, 'empresa') or die(mysqli_error($db));

switch ($_GET['action']) {
    case 'add':
        switch ($_GET['type']) {
            case 'empresa':
                
                $error = array();
                $emp_no = isset($_POST['emp_no']) ? trim($_POST['emp_no']) : '';
                if (empty($emp_no)) {
                    $error[] = urlencode('Please enter a emp number.');
                }
                $birth_date = isset($_POST['birth_date']) ? $_POST['birth_date'] : '';
                if (empty($birth_date)) {
                    $error[] = urlencode('Please enter a birth date.');
                }
                $first_name = isset($_POST['first_name']) ? trim($_POST['first_name']) : '';
                if (empty($first_name)) {
                    $error[] = urlencode('Please enter a full name.');
                }
                if (strlen($first_name) > 20) {
                    $error[] = urlencode('Please do not use more than 20 chars');
                }
                $last_name = isset($_POST['last_name']) ? trim($_POST['last_name']) : '';
                if (empty($last_name)) {
                    $error[] = urlencode('Please enter a full last name.');
                }
                if (strlen($last_name) > 20) {
                    $error[] = urlencode('Please do not use more than 20 chars');
                }
                $gender = empty($gender) ? 'F' : $gender;

                if (isset($_POST['gender'])) {
                    $gender = $_POST['gender'];
                }

                if (!in_array($gender, ['M', 'F'])) {
                    $error[] = urlencode('Invalid value for gender. Please use M or F.');
                }

                if (empty($error)) {
                    echo $emp_no;
                    $query = "INSERT INTO
                        employees
                            (emp_no, birth_date, first_name, last_name, gender, hire_date)
                        VALUES
                            ('$emp_no','$birth_date', '$first_name', '$last_name', '$gender', NOW())";
                } else {
                    if (!is_array($error)) {
                        $error = [$error];
                    }

                    $errorString = join('<br/>', array_map('urlencode', $error));
                    header('Location: empresa.php?action=add' . '&error=' . $errorString);
                    exit();
                }
                echo $query;
                break;
        }
        break;

    case 'edit':
        switch ($_GET['type']) {
            case 'empresa':
                $error = array();
                $birth_date = isset($_POST['birth_date']) ? $_POST['birth_date'] : '';
                if (empty($birth_date)) {
                    $error[] = urlencode('Please enter a birth date.');
                }
                $first_name = isset($_POST['first_name']) ? trim($_POST['first_name']) : '';
                if (empty($first_name)) {
                    $error[] = urlencode('Please enter a full name.');
                }
                if (strlen($first_name) > 20) {
                    $error[] = urlencode('Please do not use more than 20 chars');
                }
                $last_name = isset($_POST['last_name']) ? trim($_POST['last_name']) : '';
                if (empty($last_name)) {
                    $error[] = urlencode('Please enter a full last name.');
                }
                if (strlen($last_name) > 20) {
                    $error[] = urlencode('Please do not use more than 20 chars');
                }
                $gender = empty($gender) ? 'F' : $gender;

                if (isset($_POST['gender'])) {
                    $gender = $_POST['gender'];
                }

                if (!in_array($gender, ['M', 'F'])) {
                    $error[] = urlencode('Invalid value for gender. Please use M or F.');
                }

                if (empty($error)) {
                    $query = "UPDATE
                            employees
                        SET 
                            birth_date = '$birth_date',
                            first_name = '$first_name',
                            last_name = '$last_name',
                            gender = '$gender',
                            hire_date = NOW()
                        WHERE
                            emp_no = " . $_POST['emp_no'];
                } else {
                    if (!is_array($error)) {
                        $error = [$error];
                    }
                    echo $query;
                    $errorString = join('<br/>', array_map('urlencode', $error));
                    header('Location: empresa.php?action=add' . '&error=' . $errorString);
                    exit();
                }
                break;
        }
        break;
}

if (isset($query)) {
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
}
?>
<html>
<head>
    <title>Commit</title>
</head>
<body>
<p>Done!</p>
</body>
</html>
