<?php
session_start();
$_SESSION['username'] = $_POST['usuario'];
$_SESSION['userpass'] = $_POST['contrasenya'];
$_SESSION['authuser'] = 0;

//Check username and password information
if (($_SESSION['username'] == 'David') and
    ($_SESSION['userpass'] == '123456')) {
    $_SESSION['authuser'] = 1;
} else {
    echo 'Buen intento, pero no tienes ni usuario ni contraseña venga, intentalo de nuevo';
    echo '</br>';
    echo 'Un buen juego es: ';
    $juego = $_GET['juegos'];
    echo $juego;
$regalo = urlencode("Gracias por estar aqui");
echo "<a href='iniciarSesion.php?regalo=$regalo'>";
echo '</br>';
echo "Click para ver un regalo y logearte de nuevo"; 
echo "</a>";
   exit();
        
}
?>
<html>
 <head>
  <title>Mira mi juego favorito</title>

 </head>
 <body>
<?php

echo 'Mi usuario provenientede la cookie es: ';
echo $_COOKIE["username"];
echo '</br>';
echo "Mi juego favorito es ";



$regalo = urlencode("Gracias por estar aqui");
echo "<a href='iniciarSesion.php?regalo=$regalo'>";
echo "Click para ver un regalo y logearte de nuevo"; 
echo "</a>";

echo '</br>';
$dia = date("d-m-Y");
echo $dia
?>
 </body>
</html>