<?php
$db = mysqli_connect('localhost', 'root', 'root') or die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, 'moviesite') or die(mysqli_error($db));

// Inicializar variables
$people_fullname = '';
$people_isactor = 0;
$people_isdirector = 0;

if ($_GET['action'] == 'edit') {
    // Recuperar la información del registro
    $query = 'SELECT
            people_fullname, people_isactor, people_isdirector
        FROM
            people
        WHERE
            people_id = ' . $_GET['id'];
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    
    // Si hay resultados, extraer la información
    if ($row = mysqli_fetch_assoc($result)) {
        extract($row);
    }
}

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si el checkbox de actor está seleccionado
    $people_isactor = isset($_POST["people_isactor"]) ? 1 : 0;

    // Verificar si el checkbox de director está seleccionado
    $people_isdirector = isset($_POST["people_isdirector"]) ? 1 : 0;

    // Resto del código para procesar el formulario, almacenar en la base de datos, etc.

    // Puedes mostrar o almacenar los valores como desees
    echo "Full Name: " . $_POST["people_fullname"] . "<br>";
    echo "Is Actor: " . $people_isactor . "<br>";
    echo "Is Director: " . $people_isdirector . "<br>";
}
?>

<html>
<head>
    <title><?php echo ucfirst($_GET['action']); ?> Person</title>
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
<form action="N6P105commit.php?action=<?php echo $_GET['action']; ?>&type=people" method="post">
    <table>
        <tr>
            <td>Full Name</td>
            <td><input type="text" name="people_fullname" value="<?php echo $people_fullname; ?>"/></td>
        </tr>
        <tr>
            <td>Is Actor</td>
            <td><input type="checkbox" name="people_isactor" value="1" <?php echo $people_isactor ? 'checked' : ''; ?> /></td>
        </tr>
        <tr>
            <td>Is Director</td>
            <td><input type="checkbox" name="people_isdirector" value="1" <?php echo $people_isdirector ? 'checked' : ''; ?> /></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">
                <?php
                if ($_GET['action'] == 'edit') {
                    echo '<input type="hidden" value="' . $_GET['id'] . '" name="people_id" />';
                }
                ?>
                <input type="submit" name="submit" value="<?php echo ucfirst($_GET['action']); ?>" />
            </td>
        </tr>
    </table>
</form>
</body>
</html>