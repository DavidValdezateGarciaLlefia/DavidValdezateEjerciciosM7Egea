<?php
$db = mysqli_connect('localhost', 'root', 'root', 'moviesite') or die('No se pudo conectar mira los parametros.');

$query = "SELECT
    m.movie_name,
    p1.people_fullname AS lead_actor,
    p2.people_fullname AS director
FROM movie AS m
LEFT JOIN people AS p1 ON m.movie_leadactor = p1.people_id
LEFT JOIN people AS p2 ON m.movie_director = p2.people_id";

$result = mysqli_query($db, $query);

if (!$result) {
    die('Error: ' . mysqli_error($db));
}

echo "<table border='1'>";
echo "<tr><th>Pelicula</th><th>Actor</th><th>Director</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['movie_name'] . "</td>";
    echo "<td>" . $row['lead_actor'] . "</td>";
    echo "<td>" . $row['director'] . "</td>";
    echo "</tr>";
}

echo "</table>";
mysqli_close($db);
?>