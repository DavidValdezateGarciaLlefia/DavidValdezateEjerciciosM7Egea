<html>
<head>
<title> Welcome!</title>
</head>
<body>



<?php
date_default_timezone_set("America/New_York");


echo "Two days ago it was ";
echo date('d', strtotime('-2 days'));

echo '</br>';
echo"The next month is ";
echo date('m', strtotime('+1 month'));

echo '</br>';
echo"There are ";

$fechaFinalMes=date('t');
$fechaActual=date('j');
$diferenciaFinal=$fechaFinalMes-$fechaActual;
echo $diferenciaFinal;
echo " days left in next month ";
echo date("Y");

echo '</br>';
echo "There are ";
$mesActual=date('n');
$mesesTotales=12;
$mesesRestantes=$mesesTotales-$mesActual;
echo $mesesRestantes;
echo ' months left in the current year';

?>
<br/>
</div>
<?php include('piePaginaValdezate24.php'); ?>
</body>

</html>

