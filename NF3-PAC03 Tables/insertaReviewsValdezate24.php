<?php
$db = mysqli_connect('localhost', 'root', 'root');
if (!$db) {
    die('Error al conectar a la base de datos: ' . mysqli_connect_error());
}

// Reemplaza 'nombre_de_tu_base_de_datos' con el nombre de tu base de datos.
mysqli_select_db($db, 'moviesite') or die('Error al seleccionar la base de datos: ' . mysqli_error($db));

$query = <<<ENDSQL
INSERT INTO reviews
    (review_movie_id, review_date, reviewer_name, review_comment, review_rating)
VALUES 
    (1, '2023-09-11', 'David King', 'I thought this was a great movie Even though my girlfriend made me see it against my will.', 4),
    (1, '2023-02-23', 'Michael Myers', 'I liked Eraserhead better.', 2),
    (1, '2023-05-28', 'The Singularity', 'I wish I\'d have seen it sooner!', 5);
ENDSQL;

$result = mysqli_query($db, $query);

if (!$result) {
    die('Error al ejecutar la consulta: ' . mysqli_error($db));
}

echo 'Base de datos de películas actualizada con éxito!';
?>