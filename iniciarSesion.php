<?php
session_unset();
setcookie("username","David",time()+60);
?>
<html>
 <head>
  <title>Porfavor entra con tu usuario</title>
 </head>
 <body>
  <form method="post" action="juegosUsuario.php">
   <p>Dime tu nombre: 
    <input type="text" name="usuario"/>
   </p>
   <p>Pont tu contraseña: 
    <input type="password" name="contrasenya"/>
   </p>
   <p>
    <input type="submit" name="submit" value="Submit"/>
   </p>
  </form>
 </body>
</html>

<?php
$juego = urlencode("Devil May Cry 3");
echo "<a href='juegosUsuario.php?juegos=$juego'>";
echo "Click para intentar entrar sin contraseña ni usuario INTENTALO"; 
echo "</a>";
echo'</br>';
$regaloLogin = $_GET['regalo'] ?? 'no hay un regalo';
echo $regaloLogin
?>