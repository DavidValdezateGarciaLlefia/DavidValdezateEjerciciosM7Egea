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
        case 'people':
            // Update movies that have this person as a lead actor
            $queryUpdateMovies = 'UPDATE movie SET
                    movie_leadactor = 0 
                WHERE
                    movie_leadactor = ' . $_GET['id'];
            $resultUpdateMovies = mysqli_query($db, $queryUpdateMovies) or die(mysqli_error($db));

            // Delete the person
            $queryDeletePeople = 'DELETE FROM people 
                WHERE
                    people_id = ' . $_GET['id'];
            $resultDeletePeople = mysqli_query($db, $queryDeletePeople) or die(mysqli_error($db));
?>
            <p style="text-align: center;">Your person has been deleted.
                <a href="admin.php">Return to Index</a></p>
<?php
            break;
        case 'movie':
            // Delete the movie
            $queryDeleteMovie = 'DELETE FROM movie 
                WHERE
                    movie_id = ' . $_GET['id'];
            $resultDeleteMovie = mysqli_query($db, $queryDeleteMovie) or die(mysqli_error($db));
?>
            <p style="text-align: center;">Your movie has been deleted.
                <a href="admin.php">Return to Index</a></p>
<?php
            break;
    }
}
?>
