<html>
<head>
    <title>Texto cambiado</title>
</head>
<body>
    <h1>Texto cambiado</h1>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $text = $_POST["text"];
        $color = $_POST["color"];
        $font = $_POST["font"];
        $size = $_POST["size"];
	
	setcookie("text", $text, time() + 60 * 60 * 24 * 30); 
        setcookie("color", $color, time() + 60 * 60 * 24 * 30);
        setcookie("font", $font, time() + 60 * 60 * 24 * 30);
        setcookie("size", $size, time() + 60 * 60 * 24 * 30);

    ?>

    <div>
        <p style="color: <?php echo $color; ?>; fuente: <?php echo $font; ?>; tamaño fuente <?php echo $size; ?>px;">
            <?php echo $text; ?>
        </p>
    </div>

    <?php
    }
    ?>
</body>
</html>