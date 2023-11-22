<?php
$db = mysqli_connect('localhost', 'root', 'root') or 
    die('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, 'moviesite') or die(mysqli_error($db));

switch ($_GET['action']) {
    case 'add':
        switch ($_GET['type']) {
            case 'people':
                $error = array();
		
                $people_fullname = isset($_POST['people_fullname']) ?
                    trim($_POST['people_fullname']) : '';
		
                if (empty($people_fullname)) {
                    $error[] = urlencode('Please enter a full name.');
                }
		if (strlen($people_fullname)>50){
		    $error[] = urlencode('Please do not use more than 50 chars');
		}
                $people_isactor = isset($_POST['people_isactor']) ? 1:0;
                    
                if (!is_numeric($people_isactor) || !in_array($people_isactor, [0, 1])) {
                    $error[] = urlencode('Invalid value for Is Actor. Please use 0 or 1.');
                }
                $people_isdirector = isset($_POST['people_isdirector']) ? 1:0;
                    
                if (!is_numeric($people_isdirector) || !in_array($people_isdirector, [0, 1])) {
                    $error[] = urlencode('Invalid value for Is Director. Please use 0 or 1.');
                }

                if (empty($error)) {
                    $query = 'INSERT INTO
                        people
                            (people_fullname, people_isactor, people_isdirector)
                        VALUES
                            ("' . $people_fullname . '",
                             ' . $people_isactor . ',
                             ' . $people_isdirector . ')';
                } else {
                    if (!is_array($error)) {
                        $error = [$error];
                    }

                    $errorString = join('<br/>', array_map('urlencode', $error));
                    header('Location: N6P104people.php?action=add' . '&error=' . $errorString);
                    exit();
                }
                break;
        }
        break;

    case 'edit':
        switch ($_GET['type']) {
            case 'people':
                $error = array();
                $people_fullname = isset($_POST['people_fullname']) ?
                    trim($_POST['people_fullname']) : '';
                if (empty($people_fullname)) {
                    $error[] = urlencode('Please enter a full name.');
                }
                $people_isactor = isset($_POST['people_isactor']) ? 1:0;
             
                if (!is_numeric($people_isactor) || !in_array($people_isactor, [0, 1])) {
                    $error[] = urlencode('Invalid value for Is Actor. Please use 0 or 1.');
                }
                $people_isdirector = isset($_POST['people_isdirector']) ? 1:0;
                    
                if (!is_numeric($people_isdirector) || !in_array($people_isdirector, [0, 1])) {
                    $error[] = urlencode('Invalid value for Is Director. Please use 0 or 1.');
                }

                if (empty($error)) {
                    $query = 'UPDATE
                            people
                        SET 
                            people_fullname = "' . $people_fullname . '",
                            people_isactor = ' . $people_isactor . ',
                            people_isdirector = ' . $people_isdirector . '
                        WHERE
                            people_id = ' . $_POST['people_id'];
                } else {
                    if (!is_array($error)) {
                        $error = [$error];
                    }

                    $errorString = join('<br/>', array_map('urlencode', $error));
                    header('Location: N6P104people.php?action=add' . '&error=' . $errorString);
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