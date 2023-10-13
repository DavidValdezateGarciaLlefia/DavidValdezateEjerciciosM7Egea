<?php
$mesGeneral = ('n');

if ($mesGeneral >= 6 && $mesGeneral <=8) {
    $mensajeEstacion = 'Good summer';
}
 elseif ($mesGeneral >= 12 || $mesGeneral <= 2) {
    $mensajeEstacion = 'Good winter';
    }

?>

<html>
<head>
   <title>¿Es verano o invierno?</title>
</head>
<body>
   <h1>Segun el mes estamos en: </h1>
   <p><?php echo $mensajeEstacion; ?></p>
</body>
</html>
