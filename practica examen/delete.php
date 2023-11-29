<?php
$db = mysqli_connect('localhost', 'root', 'root') or 
    die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, 'moviesite') or die(mysqli_error($db));

if (!isset($_GET['do']) || $_GET['do'] != 1) {
    switch ($_GET['type']) {
        case 'movie':
            echo 'Are you sure you want to delete this movie?<br/>';
            break;
        case 'people':
            echo 'Are you sure you want to delete this person?<br/>';
            break;
    } 
    echo '<a href="' . $_SERVER['REQUEST_URI'] . '&do=1">yes</a> '; 
    echo 'or <a href="admin.php">no</a>';
} else {
    switch ($_GET['type']) {
        
            break;
        case 'empresa':
            // Delete the movie
            $queryDeleteMovie = 'DELETE FROM movie 
                WHERE
                    emp_no = ' . $_GET['id'];
            $resultDeleteEmp = mysqli_query($db, $queryDeleteEmp) or die(mysqli_error($db));
?>
            <p style="text-align: center;">Your employee has been deleted.
                <a href="admin.php">Return to Index</a></p>
<?php
            break;
    }
}
?>