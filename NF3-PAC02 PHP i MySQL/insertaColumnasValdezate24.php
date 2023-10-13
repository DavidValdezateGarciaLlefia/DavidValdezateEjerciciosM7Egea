<?php

$db = mysqli_connect('localhost', 'root', 'root', 'moviesite') or die('Unable to connect. Check your connection parameters.');
$query = "INSERT INTO movie (movie_name, movie_type, movie_year, movie_leadactor, movie_director) 
          VALUES 
          ('The Matrix', 1, 1999, 1, 4),
          ('Forrest Gump', 2, 1994, 2, 5),
          ('Pulp Fiction', 3, 1994, 3, 6)";
mysqli_query($db, $query) or die(mysqli_error($db));
$query = "INSERT INTO movietype (movietype_label) 
          VALUES 
          ('Science Fiction'),
          ('Drama'),
          ('Crime')";
mysqli_query($db, $query) or die(mysqli_error($db));

$query = "INSERT INTO people (people_fullname, people_isactor, people_isdirector) 
          VALUES 
          ('Keanu Reeves', 1, 0),
          ('Tom Hanks', 1, 0),
          ('Samuel L. Jackson', 1, 0),
          ('Lana Wachowski', 0, 1),
          ('Robert Zemeckis', 0, 1),
          ('Quentin Tarantino', 0, 1)";
mysqli_query($db, $query) or die(mysqli_error($db));

echo 'Datos insertados correctamente';
?>