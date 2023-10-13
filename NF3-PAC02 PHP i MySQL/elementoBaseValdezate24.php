<?php

$db = mysqli_connect('localhost', 'root', 'root', 'moviesite') or die('No se pudo conectar.');


$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 10; 


$offset = ($page - 1) * $records_per_page;


$query = "SELECT
    m.movie_name,
    p1.people_fullname AS lead_actor,
    p2.people_fullname AS director
FROM movie AS m
LEFT JOIN people AS p1 ON m.movie_leadactor = p1.people_id
LEFT JOIN people AS p2 ON m.movie_director = p2.people_id
LIMIT $offset, $records_per_page";

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
$total_records_query = "SELECT COUNT(*) AS total_records FROM movie";
$total_records_result = mysqli_query($db, $total_records_query);
$total_records = mysqli_fetch_assoc($total_records_result)['total_records'];
$total_pages = ceil($total_records / $records_per_page);
echo "<div>";
for ($i = 1; $i <= $total_pages; $i++) {
    if ($i == $page) {
        echo "<strong>Pagina $i</strong> ";
    } else {
        echo "<a href='your_php_script.php?page=$i'>Pagina $i</a> ";
    }
}
echo "</div>";
mysqli_close($db);
?>