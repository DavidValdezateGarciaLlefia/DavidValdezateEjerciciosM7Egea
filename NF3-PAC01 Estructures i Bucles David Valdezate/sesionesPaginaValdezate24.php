<?php

session_start();


if (!isset($_SESSION['visitas_de_pagina'])) {
    $_SESSION['visitas_de_pagina'] = 0;
}


$_SESSION['visitas_de_pagina']++;


$visitasPagina = $_SESSION['visitas_de_pagina'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contador visitas</title>
</head>
<body>
    <h1>Cuantas veces has visitado la pagina?</h1>
    <p>Has visto la pagina un total de: <?php echo $visitasPagina; ?> veces.</p>
</body>
</html>