<?php
$db = mysqli_connect('localhost', 'root', 'root') or die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, 'empresa') or die(mysqli_error($db));

$emp_no = 0;
$birth_date = '2023-11-29';
$first_name = '';
$last_name = '';
$gender = '';
$hire_date = '2023-11-29';

if ($_GET['action'] == 'edit') {
    // Recuperar la información del registro
    $query = 'SELECT
            birth_date, first_name, last_name, gender, hire_date 
        FROM
            employees
        WHERE
            emp_no = ' . $_GET['id'];
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    
    // Si hay resultados, extraer la información
    if ($row = mysqli_fetch_assoc($result)) {
        extract($row);
    }
}

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si el checkbox de actor está seleccionado
    $gender = isset($_POST["gender"]) ? 'M' : 'F';

    echo "Emp number: " . $_POST["emp_no"] . "<br>";
    echo "Birth date: " . $_POST["birth_date"] . "<br>";
    echo "First name: " . $_POST["first_name"] . "<br>";
    echo "Last name: " . $_POST["last_name"] . "<br>";
    echo "Gender: " . $_POST["gender"] . "<br>";
    echo "Hire date: " . $_POST["hire_date"] . "<br>";
    
}
?>

<html>
<head>
    <title><?php echo ucfirst($_GET['action']); ?> Employee</title>
    <style type="text/css">
        <!--
        #error { background-color: #600; border: 1px solid #FF0; color: #FFF;
         text-align: center; margin: 10px; padding: 10px; }
        -->
    </style>
</head>
<body>
<?php
if (isset($_GET['error']) && $_GET['error'] != '') {
    echo '<div id="error">' . $_GET['error'] . '</div>';
}
?>
<form action="commit.php?action=<?php echo $_GET['action']; ?>&type=empresa" method="post">
    <table>
        <tr>
            <td>Emp number</td>
            <td><input type="number" name="emp_no" value="<?php echo $emp_no; ?>"/></td>
        </tr>
        <tr>
            <td>Birth date</td>
            <td><input type="date" name="birth_date" value="<?php echo $birth_date; ?>"/></td>
        </tr>
        <tr>
            <td>First name</td>
            <td><input type="text" name="first_name" value="<?php echo $first_name; ?>"/></td>
        </tr>
        <tr>
            <td>Last name</td>
            <td><input type="text" name="last_name" value="<?php echo $last_name; ?>"/></td>
        </tr>
        <tr>
            <td>Gender if pressed you are male if not you are female</td>
            <td><input type="checkbox" name="gender" value="M" <?php echo $gender ? 'checked' : ''; ?> /></td>
        </tr>
        <tr>
            <td>Hire date</td>
            <td><input type="date" name="hire_date" value="<?php echo $birth_date; ?>"/></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">
                <?php
                if ($_GET['action'] == 'edit') {
                    echo '<input type="hidden" value="' . $_GET['id'] . '" name="emp_no" />';
                }
                ?>
                <input type="submit" name="submit" value="<?php echo ucfirst($_GET['action']); ?>" />
            </td>
        </tr>
    </table>
</form>
</body>
</html>