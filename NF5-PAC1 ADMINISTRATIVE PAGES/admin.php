<?php
$db = mysqli_connect('localhost', 'root', 'root') or 
    die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, 'moviesite') or die(mysqli_error($db));
?>
<html>
<head>
    <title>Movie database</title>
    <style type="text/css">
        th { background-color: #999; }
        .odd_row { background-color: #EEE; }
        .even_row { background-color: #FFF; }
    </style>
</head>
<body>
    <table style="width:100%;">
        <tr>
            <th colspan="2">Movies <a href="movie.php?action=add">[ADD]</a></th>
        </tr>
        <?php
        $query = 'SELECT * FROM movie';
        $result = mysqli_query($db, $query) or die(mysqli_error($db));

        $odd = true;
        while ($row = mysqli_fetch_assoc($result)) {
            echo ($odd == true) ? '<tr class="odd_row">' : '<tr class="even_row">';
            $odd = !$odd;
            echo '<td style="width:75%;">';
            echo $row['movie_name'];
            echo '</td><td>';
            echo ' <a href="movie.php?action=edit&id=' . $row['movie_id'] . '"> [EDIT]</a>';
            echo ' <a href="delete.php?type=movie&id=' . $row['movie_id'] . '"> [DELETE]</a>';
            echo '</td></tr>';
        }
        ?>
        <tr>
            <th colspan="2">People <a href="people.php?action=add"> [ADD]</a></th>
        </tr>
        <?php
        $queryPeople = 'SELECT * FROM people';
        $resultPeople = mysqli_query($db, $queryPeople) or die(mysqli_error($db));

        $oddPeople = true;
        while ($rowPeople = mysqli_fetch_assoc($resultPeople)) {
            echo ($oddPeople == true) ? '<tr class="odd_row">' : '<tr class="even_row">';
            $oddPeople = !$oddPeople;
            echo '<td style="width: 25%;">';
            echo $rowPeople['people_fullname'];
            echo '</td><td>';
            echo ' <a href="people.php?action=edit&id=' . $rowPeople['people_id'] .
                '"> [EDIT]</a>';
            echo ' <a href="delete.php?type=people&id=' . $rowPeople['people_id'] .
                '"> [DELETE]</a>';
            echo '</td></tr>';
        }
        ?>
    </table>
</body>
</html>