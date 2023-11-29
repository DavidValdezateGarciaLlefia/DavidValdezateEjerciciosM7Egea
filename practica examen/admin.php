<?php
$db = mysqli_connect('localhost', 'root', 'root') or 
    die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, 'empresa') or die(mysqli_error($db));
?>
<html>
<head>
    <title>Empresa Tables</title>
    <style type="text/css">
        th { background-color: #999; }
        .odd_row { background-color: #EEE; }
        .even_row { background-color: #FFF; }
    </style>
</head>
<body>
    <table style="width:100%;">
        <tr>
            <th colspan="2">Employees <a href="empresa.php?action=add">[ADD]</a></th>
        </tr>
        <?php
        $query = 'SELECT * FROM employees';
        $result = mysqli_query($db, $query) or die(mysqli_error($db));

        $odd = true;
        while ($row = mysqli_fetch_assoc($result)) {
            echo ($odd == true) ? '<tr class="odd_row">' : '<tr class="even_row">';
            $odd = !$odd;
            echo '<td style="width:75%;">';
            echo $row['first_name'];
            echo '</td><td>';
            echo ' <a href="empresa.php?action=edit&id=' . $row['emp_no'] . '"> [EDIT]</a>';
            echo ' <a href="delete.php?type=empresa&id=' . $row['emp_no'] . '"> [DELETE]</a>';
            echo '</td></tr>';
        }
        ?>
        
    </table>
</body>
</html>
    